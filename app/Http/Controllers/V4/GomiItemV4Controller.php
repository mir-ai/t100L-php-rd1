<?php

namespace App\Http\Controllers\V4;

use App\Models\GomiItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ControllerSupports\GomiItemCs;
use App\UseCases\GomiItemUseCase;
use App\Http\Requests\V4\GomiItemStoreRequest;
use App\Http\Requests\V4\GomiItemUpdateRequest;
use App\Http\Requests\V4\GomiItemUpdateRawRequest;
use Illuminate\Support\Facades\View;

/**
 * ごみ分別のコントローラー
 */
class GomiItemV4Controller extends Controller
{
    private GomiItemCs $gomiItemCs;
    private GomiItemUseCase $gomiItemUseCase;

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
        // gomiItemCs と gomiItemUseCase を生成する
        $this->gomiItemCs = new GomiItemCs();

        $this->gomiItemUseCase = new GomiItemUseCase();
    }

    /**
     * ごみ分別の一覧表示・検索画面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', GomiItem::class);

        $conds = $this->gomiItemCs->getConds($request, [
            'd' => 'index',
        ]);
        $orders = $this->gomiItemCs->getOrders();
        $gomi_items = $this->gomiItemCs->getSearch($conds);
        $search_description = $this->gomiItemCs->getSearchDescription($conds);
        $this->gomiItemCs->saveConds($request, $conds);

        return view('v4.gomi_items.index', compact(
            'gomi_items',
            'conds',
            'orders',
            'search_description',
        ));
    }

    /**
     * ごみ分別の登録フォーム
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $conds = $this->gomiItemCs->getConds($request);

        $this->authorize('create', GomiItem::class);

        return view('v4.gomi_items.create', compact([
            'conds'
        ]));
    }

    /**
     * ごみ分別の登録処理
     *
     * @param  \App\Http\Requests\GomiItemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GomiItemStoreRequest $request)
    {
        $this->authorize('create', GomiItem::class);
        $conds = $this->gomiItemCs->getConds($request);

        $attributes = array_merge($request->validated(), [
        ]);

        logger("create gomi_items attributes=", $attributes);

        $gomi_item = GomiItem::create($attributes);

        $route = 'r4.gomi_items.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['gomi_item' => $gomi_item]))
            ->with('flash_message',  "ごみ分別「{$gomi_item->ItemTitle}」を作成しました。");
    }

    /**
     * ごみ分別の更新フォーム
     *
     * @param  \App\Models\GomiItem  $gomi_item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, GomiItem $gomi_item)
    {
        $this->authorize('update', $gomi_item);

        $conds = $this->gomiItemCs->getConds($request);

        return view('v4.gomi_items.edit', compact(
            'gomi_item',
            'conds'
        ));
    }

    /**
     * ごみ分別の更新処理
     *
     * @param  \App\Http\Requests\GomiItemUpdateRequest  $request
     * @param  \App\Models\GomiItem  $gomi_item
     * @return \Illuminate\Http\Response
     */
    public function update(GomiItemUpdateRequest $request, GomiItem $gomi_item)
    {
        $this->authorize('update', $gomi_item);

        $attributes = array_merge($request->validated(), []);
        $conds = $this->gomiItemCs->getConds($request);

        $gomi_item->update($attributes);

        $route = 'r4.gomi_items.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['gomi_item' => $gomi_item]))
            ->with('flash_message',  "ごみ分別「{$gomi_item->ItemTitle}」を更新しました。");
    }

    /**
     * ごみ分別を１件削除
     *
     * @param  \App\Models\GomiItem  $gomi_item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GomiItem $gomi_item)
    {
        $conds = $this->gomiItemCs->getConds($request);

        $this->authorize('delete', $gomi_item);

        $delete_id = $gomi_item->id;
        $item_title = $gomi_item->ItemTitle;

        $gomi_item->delete();

        return redirect()
            ->route('r4.gomi_items.last_conds')
            ->with('flash_message', "ごみ分別「{$item_title}」を削除しました。");
    }

    /**
     * ごみ分別を１件表示
     *
     * @param  \App\Models\GomiItem  $gomi_item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GomiItem $gomi_item)
    {
        $this->authorize('view', $gomi_item);

        $conds = $this->gomiItemCs->getConds($request);
        $this->gomiItemCs->saveConds($request, $conds);

        return view('v4.gomi_items.show', compact(
            'gomi_item',
            'conds',
        ));
    }

    /**
     * ごみ分別の前回の検索条件を再現して一覧表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function last_conds(Request $request)
    {
        return $this->gomiItemCs->redirectToLastCondition($request);
    }

    /**
     * ごみ分別のエクセル出力
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $new_excel_full_path = $this->gomiItemCs->getDownloadFullPath(
            request: $request
        );

        $new_file_name = $this->gomiItemCs->newDownloadFileName();

        return response()
            ->download(
                $new_excel_full_path,
                $new_file_name,
            )
            ->deleteFileAfterSend(true);
    }

    /**
     * ごみ分別のアップロード画面
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploader(Request $request)
    {
        $this->authorize('upload', GomiItem::class);

        $label = $this->gomiItemCs->getUploadLabel();
        $prefix = $this->gomiItemCs->getUploadPrefix();
        $input = $this->gomiItemCs->getUploadInput();

        $next = route('r4.gomi_items.upload_diff');
        $back = route('r4.gomi_items.last_conds');

        return view('uploader.uploader', compact(
            'label',
            'prefix',
            'input',
            'next',
            'back',
        ));
    }

    /**
     * ごみ分別のアップロードデータの現行との差分表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_diff(Request $request)
    {
        $this->authorize('upload', GomiItem::class);

        $label = $this->gomiItemCs->getUploadLabel();
        $back = route('r4.gomi_items.uploader');

        $res = $this->gomiItemCs->getUploadDiff($request);

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

        $next = route('r4.gomi_items.upload_commit', ['data_key' => $res['data_key']]);

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
     * ごみ分別のアップロード反映
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_commit(Request $request, string $data_key)
    {
        $this->authorize('upload', GomiItem::class);

        $res = $this->gomiItemCs->uploadCommit(
            request: $request,
            data_key: $data_key,
        );

        // エラー発生時
        if ($res['error_message'] ?? '') {
            return redirect(
                route('r4.gomi_items.uploader')
            )->with('flash_warning', $res['error_message']);
        }

        // 正常完了時
        return redirect()
            ->route('r4.gomi_items.last_conds', [
                
                'dest' => 'index',
            ])
            ->with('flash_modal', $res['msg']);
    }
}
