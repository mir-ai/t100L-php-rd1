<?php

namespace App\Http\Controllers\V4;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ControllerSupports\EventCs;
use App\UseCases\EventUseCase;
use App\Http\Requests\V4\EventStoreRequest;
use App\Http\Requests\V4\EventUpdateRequest;
use App\Http\Requests\V4\EventUpdateRawRequest;
use Illuminate\Support\Facades\View;

/**
 * イベントのコントローラー
 */
class EventV4Controller extends Controller
{
    private EventCs $eventCs;
    private EventUseCase $eventUseCase;

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
        // eventCs と eventUseCase を生成する
        $this->eventCs = new EventCs();

        $this->eventUseCase = new EventUseCase();
    }

    /**
     * イベントの一覧表示・検索画面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Event::class);

        $conds = $this->eventCs->getConds($request, [
            'd' => 'index',
        ]);
        $orders = $this->eventCs->getOrders();
        $events = $this->eventCs->getSearch($conds);
        $search_description = $this->eventCs->getSearchDescription($conds);
        $this->eventCs->saveConds($request, $conds);

        return view('v4.events.index', compact(
            'events',
            'conds',
            'orders',
            'search_description',
        ));
    }

    /**
     * イベントの登録フォーム
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $conds = $this->eventCs->getConds($request);

        $this->authorize('create', Event::class);

        return view('v4.events.create', compact([
            'conds'
        ]));
    }

    /**
     * イベントの登録処理
     *
     * @param  \App\Http\Requests\EventStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        $this->authorize('create', Event::class);
        $conds = $this->eventCs->getConds($request);

        $attributes = array_merge($request->validated(), [
        ]);

        logger("create events attributes=", $attributes);

        $event = Event::create($attributes);

        // TODO: 次の行き先を決める
        $route = 'r4.events.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['event' => $event]))
            ->with('flash_message',  "イベント「{$event->ItemTitle}」を作成しました。");
    }

    /**
     * イベントの更新フォーム
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $conds = $this->eventCs->getConds($request);

        return view('v4.events.edit', compact(
            'event',
            'conds'
        ));
    }

    /**
     * イベントの更新処理
     *
     * @param  \App\Http\Requests\EventUpdateRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $attributes = array_merge($request->validated(), []);
        $conds = $this->eventCs->getConds($request);

        $event->update($attributes);

        // TODO: 次の行き先を決める
        $route = 'r4.events.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['event' => $event]))
            ->with('flash_message',  "イベント「{$event->ItemTitle}」を更新しました。");
    }

    /**
     * イベントの更新フォーム(直接編集)
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit_raw(Request $request, Event $event)
    {
        $this->authorize('update_raw', $event);

        $conds = $this->eventCs->getConds($request);
        
        return view('v4.events.edit_raw', compact(
            'event',
            'conds',
        ));
    }

    /**
     * イベントの直接更新処理
     *
     * @param  \App\Http\Requests\EventUpdateRawRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update_raw(EventUpdateRawRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $attributes = array_merge($request->validated(), []);
        $conds = $this->eventCs->getConds($request);
        $event_old = clone $event;
    
        $event->update($attributes);

        // TODO: 次の行き先を決める
        $route = 'r4.events.last_conds';

        return redirect()
            ->route($route, array_merge($conds, ['event' => $event]))
            ->with('flash_message',  "イベント「{$event->ItemTitle}」を直接更新しました。");
    }

    /**
     * イベントを１件削除
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $conds = $this->eventCs->getConds($request);

        $this->authorize('delete', $event);

        $delete_id = $event->id;
        $item_title = $event->ItemTitle;

        // TODO: ユニークキーを持つモデルは forceDelete(); が好ましい。
        $event->delete();

        return redirect()
            ->route('r4.events.last_conds')
            ->with('flash_message', "イベント「{$item_title}」を削除しました。");
    }

    /**
     * イベントを１件表示
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Event $event)
    {
        $this->authorize('view', $event);

        $conds = $this->eventCs->getConds($request);
        $this->eventCs->saveConds($request, $conds);

        return view('v4.events.show', compact(
            'event',
            'conds',
        ));
    }

    /**
     * イベントの前回の検索条件を再現して一覧表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function last_conds(Request $request)
    {
        return $this->eventCs->redirectToLastCondition($request);
    }

    /**
     * イベントのエクセル出力
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $new_excel_full_path = $this->eventCs->getDownloadFullPath(
            request: $request
        );

        $new_file_name = $this->eventCs->newDownloadFileName();

        return response()
            ->download(
                $new_excel_full_path,
                $new_file_name,
            )
            ->deleteFileAfterSend(true);
    }

    /**
     * イベントのアップロード画面
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploader(Request $request)
    {
        $this->authorize('upload', Event::class);

        $label = $this->eventCs->getUploadLabel();
        $prefix = $this->eventCs->getUploadPrefix();
        $input = $this->eventCs->getUploadInput();

        $next = route('r4.events.upload_diff');
        $back = route('r4.events.last_conds');

        return view('uploader.uploader', compact(
            'label',
            'prefix',
            'input',
            'next',
            'back',
        ));
    }

    /**
     * イベントのアップロードデータの現行との差分表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_diff(Request $request)
    {
        $this->authorize('upload', Event::class);

        $label = $this->eventCs->getUploadLabel();
        $back = route('r4.events.uploader');

        $res = $this->eventCs->getUploadDiff($request);

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

        $next = route('r4.events.upload_commit', ['data_key' => $res['data_key']]);

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
     * イベントのアップロード反映
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload_commit(Request $request, string $data_key)
    {
        $this->authorize('upload', Event::class);

        $res = $this->eventCs->uploadCommit(
            request: $request,
            data_key: $data_key,
        );

        // エラー発生時
        if ($res['error_message'] ?? '') {
            return redirect(
                route('r4.events.uploader')
            )->with('flash_warning', $res['error_message']);
        }

        // 正常完了時
        return redirect()
            ->route('r4.events.last_conds', [
                
                'dest' => 'index',
            ])
            ->with('flash_modal', $res['msg']);
    }
}
