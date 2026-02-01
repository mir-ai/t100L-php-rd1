<?php

namespace App\Http\Controllers\V4;

use App\Models\Population;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ControllerSupports\PopulationCs;
use App\UseCases\PopulationUseCase;
use App\Http\Requests\V4\PopulationStoreRequest;
use App\Http\Requests\V4\PopulationUpdateRequest;
use App\Http\Requests\V4\PopulationUpdateRawRequest;
use Illuminate\Support\Facades\View;

/**
 * 人口のコントローラー
 */
class PopulationV4Controller extends Controller
{
    private PopulationCs $populationCs;
    private PopulationUseCase $populationUseCase;

    public function __construct(
    ) {
        // リクエスト情報から設置場所と事業者名を取得する。
        $this->middleware(function ($request, $next) {
            $this->init($request);
            return $next($request);
        });
    }

    // リクエスト情報から設置場所と事業者名を取得する。
    private function init($request)
    {
        // populationCs と populationUseCase を生成する
        $this->populationCs = new PopulationCs();

        $this->populationUseCase = new PopulationUseCase();
    }

    /**
     * 人口の一覧表示・検索画面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Population::class);

        $conds = $this->populationCs->getConds($request, [
            'd' => 'index',
        ]);
        $orders = $this->populationCs->getOrders();
        $populations = $this->populationCs->getSearch($conds);
        $search_description = $this->populationCs->getSearchDescription($conds);
        $this->populationCs->saveConds($request, $conds);

        return view('v4.populations.index', compact(
            'populations',
            'conds',
            'orders',
            'search_description',
        ));
    }

    /**
     * 人口の登録フォーム
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $conds = $this->populationCs->getConds($request);

        $this->authorize('create', Population::class);

        return view('v4.populations.create', compact([
            'conds'
        ]));
    }

    /**
     * 人口の登録処理
     *
     * @param  \App\Http\Requests\PopulationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PopulationStoreRequest $request)
    {
        $this->authorize('create', Population::class);
        $conds = $this->populationCs->getConds($request);

        $attributes = array_merge($request->validated(), [
        ]);

        logger("create populations attributes=", $attributes);

        $population = Population::create($attributes);

        // TODO: 次の行き先を決める
        $route = 'r4.populations.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['population' => $population]))
            ->with('flash_message',  "人口「{$population->ItemTitle}」を作成しました。");
    }

    /**
     * 人口の更新フォーム
     *
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Population $population)
    {
        $this->authorize('update', $population);

        $conds = $this->populationCs->getConds($request);

        return view('v4.populations.edit', compact(
            'population',
            'conds'
        ));
    }

    /**
     * 人口の更新処理
     *
     * @param  \App\Http\Requests\PopulationUpdateRequest  $request
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function update(PopulationUpdateRequest $request, Population $population)
    {
        $this->authorize('update', $population);

        $attributes = array_merge($request->validated(), []);
        $conds = $this->populationCs->getConds($request);

        $population->update($attributes);

        // TODO: 次の行き先を決める
        $route = 'r4.populations.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['population' => $population]))
            ->with('flash_message',  "人口「{$population->ItemTitle}」を更新しました。");
    }

    /**
     * 人口を１件削除
     *
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Population $population)
    {
        $conds = $this->populationCs->getConds($request);

        $this->authorize('delete', $population);

        $delete_id = $population->id;
        $item_title = $population->ItemTitle;

        // TODO: ユニークキーを持つモデルは forceDelete(); が好ましい。
        $population->delete();

        return redirect()
            ->route('r4.populations.last_conds')
            ->with('flash_message', "人口「{$item_title}」を削除しました。");
    }

    /**
     * 人口を１件表示
     *
     * @param  \App\Models\Population  $population
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Population $population)
    {
        $this->authorize('view', $population);

        $conds = $this->populationCs->getConds($request);
        $this->populationCs->saveConds($request, $conds);

        return view('v4.populations.show', compact(
            'population',
            'conds',
        ));
    }

    /**
     * 人口の前回の検索条件を再現して一覧表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function last_conds(Request $request)
    {
        return $this->populationCs->redirectToLastCondition($request);
    }

    /**
     * 人口のエクセル出力
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $new_excel_full_path = $this->populationCs->getDownloadFullPath(
            request: $request
        );

        $new_file_name = $this->populationCs->newDownloadFileName();

        return response()
            ->download(
                $new_excel_full_path,
                $new_file_name,
            )
            ->deleteFileAfterSend(true);
    }

    /**
     * 人口のアップロード画面
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploader(Request $request)
    {
        $this->authorize('upload', Population::class);

        $label = $this->populationCs->getUploadLabel();
        $prefix = $this->populationCs->getUploadPrefix();
        $input = $this->populationCs->getUploadInput();

        $next = route('r4.populations.upload_diff');
        $back = route('r4.populations.last_conds');

        return view('uploader.uploader', compact(
            'label',
            'prefix',
            'input',
            'next',
            'back',
        ));
    }

    /**
     * 人口のアップロードデータの現行との差分表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_diff(Request $request)
    {
        $this->authorize('upload', Population::class);

        $label = $this->populationCs->getUploadLabel();
        $back = route('r4.populations.uploader');

        $res = $this->populationCs->getUploadDiff($request);

        // アップロードされたファイル名に関するエラー
        $file_error = $res['file_error'] ?? '';
        if ($file_error) {
            return redirect($back)
            ->with('flash_warning', $file_error);
        }

        // アップロードされたファイルの内容に関するエラー
        $content_errors = $res['content_errors'] ?? '';
        if ($content_errors) {
            return view('uploader.upload_errors', [
                'label' => $label,
                'back' => $back,
                'errors' => $content_errors,
                'uploaded_matrix' => $res['uploaded_matrix']
            ]);
        }

        $next = route('r4.populations.upload_commit', ['data_key' => $res['data_key']]);

        $params = [
            'row_col_keys1' => $res['row_col_keys1'],
            'row_col_keys2' => $res['row_col_keys2'],
            'col_names' => $res['col_names'],
            'col_keys' => $res['col_keys'],
            'row_keys' => $res['row_keys'],
            'data_key' => $res['data_key'],
            'label' => $label,
            'next' => $next,
            'back' => $back,
        ];

        return view('uploader.upload_diff', $params);
    }

    /**
     * 人口のアップロード反映
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_commit(Request $request, string $data_key)
    {
        $this->authorize('upload', Population::class);

        $res = $this->populationCs->uploadCommit(
            request: $request,
            data_key: $data_key,
        );

        // エラー発生時
        if ($res['error_message'] ?? '') {
            return redirect(
                route('r4.populations.uploader')
            )->with('flash_warning', $res['error_message']);
        }

        // 正常完了時
        return redirect()
            ->route('r4.populations.last_conds', [
                
                'dest' => 'index',
            ])
            ->with('flash_modal', $res['msg']);
    }
}
