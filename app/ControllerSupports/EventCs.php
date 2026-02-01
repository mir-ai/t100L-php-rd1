<?php

namespace App\ControllerSupports;

use Carbon\Carbon;
use App\Lib\Mms\MmsCode;
use App\Models\Event;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\DataAccess\EventDa;
use \Illuminate\Support\Collection;
use App\UseCases\EventUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Lib\Mir\MirSearch;
use App\Lib\Mir\MirUtil;

/**
 * イベントのコントローラーの詳細処理
 * 条件検索、ソート等の詳細処理を行う。
 * ダウンロード、アップロード等は BaseCs に実体がある
 */
final class EventCs extends BaseCs
{
    protected string $model_label = 'イベント';
    protected string $model_name = 'event';
    protected string $upload_input = 'excel';
    protected string $default_order = 'sq-';
    private EventUseCase $eventUseCase;

    function __construct() {
        $this->eventUseCase = new EventUseCase();
    }

    /**
     * エクスポートするカラムキーとカラム名の連想配列を返す
     *
     * @return array
     */
    protected function getExportKvs(): array
    {
        return [
            'id' => 'id',
            'pref_code' => '都道府県コード又は市区町村コード',
            'record_id' => 'NO',
            'pref_name' => '都道府県名',
            'city_name' => '市区町村名',
            'event_name' => 'イベント名',
            'event_kana' => 'イベント名_カナ',
            'event_en' => 'イベント名_英語',
            'start_date' => '開始日',
            'end_date' => '終了日',
            'start_time' => '開始時間',
            'end_time' => '終了時間',
            'start_memo' => '開始日時特記事項',
            'description' => '説明',
            'fee_basic' => '料金(基本)',
            'fee_detail' => '料金(詳細)',
            'contact_name' => '連絡先名称',
            'contact_tel' => '連絡先電話番号',
            'contact_tel_ext' => '連絡先内線番号',
            'organizer' => '主催者',
            'location_name' => '場所名称',
            'address' => '住所',
            'address2' => '方書',
            'lat' => '緯度',
            'lng' => '経度',
            'access' => 'アクセス方法',
            'parking' => '駐車場情報',
            'capacity' => '定員',
            'entry_due_date' => '参加申込終了日',
            'entry_due_time' => '参加申込終了時間',
            'entry_method' => '参加申込方法',
            'entry_url' => 'URL',
            'memo' => '備考',
            'category' => 'カテゴリー',
            'ward_name' => '区',
            'open_date' => '公開日',
            'update_date' => '更新日',
            'is_childcare' => '子育て情報',
            'location_no' => '施設No.',
            'created_at' => '登録日時',
            'updated_at' => '更新日時'            
        ];
    }

    protected function getUploadRules(string $id = '0', array $item = []): array
    {
        $rules = [
            'id' => ['nullable', 'integer'],
            'pref_code' => ['nullable', 'integer'],
            'record_id' => ['required', 'string', 'max:16'],
            'pref_name' => ['nullable', 'string', 'max:8'],
            'city_name' => ['nullable', 'string', 'max:12'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_kana' => ['nullable', 'string', 'max:255'],
            'event_en' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'start_time' => ['nullable', 'string', 'max:8'],
            'end_time' => ['nullable', 'string', 'max:8'],
            'start_memo' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'fee_basic' => ['nullable', 'string', 'max:20'],
            'fee_detail' => ['nullable', 'string'],
            'contact_name' => ['nullable', 'string'],
            'contact_tel' => ['nullable', 'string', 'max:64'],
            'contact_tel_ext' => ['nullable', 'string', 'max:20'],
            'organizer' => ['nullable', 'string', 'max:64'],
            'location_name' => ['nullable', 'string', 'max:128'],
            'address' => ['nullable', 'string', 'max:128'],
            'address2' => ['nullable', 'string', 'max:32'],
            'lat' => ['nullable', 'string', 'max:14'],
            'lng' => ['nullable', 'string', 'max:14'],
            'access' => ['nullable', 'string'],
            'parking' => ['nullable', 'string', 'max:60'],
            'capacity' => ['nullable', 'string', 'max:4000'],
            'entry_due_date' => ['nullable', 'string', 'max:10'],
            'entry_due_time' => ['nullable', 'string', 'max:32'],
            'entry_method' => ['nullable', 'string'],
            'entry_url' => ['nullable', 'string'],
            'memo' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:12'],
            'ward_name' => ['nullable', 'string', 'max:12'],
            'open_date' => ['nullable', 'date'],
            'update_date' => ['nullable', 'date'],
            'is_childcare' => ['nullable', 'string', 'max:4'],
            'location_no' => ['nullable', 'string', 'max:16'],
            'created_at' => ['nullable', 'date'],
            'updated_at' => ['nullable', 'date']            
        ];

        return $rules;        
    }

    /**
     * エクセルでアップロードされた値を整形する
     * 0000 がほしいのに エクセルが 0 にしてしまう場合などがあるので、
     * それを整形する。
     *
     * @param string $key
     * @param string $val
     * @return void
     */
    public function formatUploadedItem(string $key, string $val)
    {
        $ret = $val;

        /*
        if ($key == 'id') {
            $ret = $ret
        }
        */

        return $ret;
    }

    /**
     * クエリー文字列に応じた検索条件の配列を作成する
     *
     * @param Request $request
     * @param array $conds_merge 追加したい検索条件
     * @return array 検索条件の配列
     */
    public function getConds($request, array $merge = []): array
    {
        if ($request->last_conds) {
            $last_conds = MirSearch::getLast($request, 'event');

            if ($last_conds) {
                $conds = array_merge($last_conds, $merge);
                return $conds;
            }
        }

        $conds = [
            'id' => $request->input('id'), // id,
            'pcd' => $request->input('pcd'), // 都道府県コード又は市区町村コード,
            'rid' => $request->input('rid'), // NO,
            'pnm' => $request->input('pnm'), // 都道府県名,
            'cnm' => $request->input('cnm'), // 市区町村名,
            'enm' => $request->input('enm'), // イベント名,
            'ekn' => $request->input('ekn'), // イベント名_カナ,
            'een' => $request->input('een'), // イベント名_英語,
            'stdt' => $request->input('stdt'), // 開始日,
            'eddt' => $request->input('eddt'), // 終了日,
            'sttm' => $request->input('sttm'), // 開始時間,
            'edtm' => $request->input('edtm'), // 終了時間,
            'smm' => $request->input('smm'), // 開始日時特記事項,
            'dcp' => $request->input('dcp'), // 説明,
            'fbc' => $request->input('fbc'), // 料金(基本),
            'fdt' => $request->input('fdt'), // 料金(詳細),
            'ctnm' => $request->input('ctnm'), // 連絡先名称,
            'cttl' => $request->input('cttl'), // 連絡先電話番号,
            'cttlx' => $request->input('cttlx'), // 連絡先内線番号,
            'og' => $request->input('og'), // 主催者,
            'lnm' => $request->input('lnm'), // 場所名称,
            'adr' => $request->input('adr'), // 住所,
            'adr2' => $request->input('adr2'), // 方書,
            'lt' => $request->input('lt'), // 緯度,
            'lg' => $request->input('lg'), // 経度,
            'acc' => $request->input('acc'), // アクセス方法,
            'pk' => $request->input('pk'), // 駐車場情報,
            'cpc' => $request->input('cpc'), // 定員,
            'etdd' => $request->input('etdd'), // 参加申込終了日,
            'ettm' => $request->input('ettm'), // 参加申込終了時間,
            'emd' => $request->input('emd'), // 参加申込方法,
            'eur' => $request->input('eur'), // URL,
            'mm' => $request->input('mm'), // 備考,
            'cgr' => $request->input('cgr'), // カテゴリー,
            'wdnm' => $request->input('wdnm'), // 区,
            'opdt' => $request->input('opdt'), // 公開日,
            'updt' => $request->input('updt'), // 更新日,
            'iscd' => $request->input('iscd'), // 子育て情報,
            'lcno' => $request->input('lcno'), // 施設No.,
            'catf' => $request->input('catf'), // 登録日時以降,
            'catt' => $request->input('catt'), // 登録日時以前,
            'uatf' => $request->input('uatf'), // 更新日時以降,
            'uatt' => $request->input('uatt'), // 更新日時以前

            'catf' => $request->input('catf'), // 登録日From
            'catt' => $request->input('catt'), // 登録日To

            's'   => $request->input('s'), // 検索文字列
            'o'   => $request->input('o', $this->default_order),   // 順番
            'n'   => $request->integer('n', 100),   // 件数

            // 最後にいたインデックスページ(index, lnav, index_live)
            'd'   => $request->input('d'),

            // ビューの種類 ('edit', 'edit_raw')
            'v'   => $request->input('v'),
        ];

        $conds = array_merge($conds, $merge);

        // 各データはすべて文字列に直して記録する。
        // 配列のままで保持する案もあったが、
        // select multiで「すべて 0=>'' 」を選んだ際に来る [0=>null] を false とみなすのが難しかったため
        // 配列も文字列に直して保持する。
        $conds = MirUtil::stringifyCondsElements($conds);

        return $conds;
    }

    /**
     * 並べ替え順序の一覧を返す
     *
     * @return array
     */
    public function getOrders(): array
    {
        return [
            'id' => 'id(昇順)',
            'id-' => 'id(降順)',
            'pcd' => '都道府県コード又は市区町村コード(昇順)',
            'pcd-' => '都道府県コード又は市区町村コード(降順)',
            'rid' => 'NO(昇順)',
            'rid-' => 'NO(降順)',
            'pnm' => '都道府県名(昇順)',
            'pnm-' => '都道府県名(降順)',
            'cnm' => '市区町村名(昇順)',
            'cnm-' => '市区町村名(降順)',
            'enm' => 'イベント名(昇順)',
            'enm-' => 'イベント名(降順)',
            'ekn' => 'イベント名_カナ(昇順)',
            'ekn-' => 'イベント名_カナ(降順)',
            'een' => 'イベント名_英語(昇順)',
            'een-' => 'イベント名_英語(降順)',
            'stdt' => '開始日(昇順)',
            'stdt-' => '開始日(降順)',
            'eddt' => '終了日(昇順)',
            'eddt-' => '終了日(降順)',
            'sttm' => '開始時間(昇順)',
            'sttm-' => '開始時間(降順)',
            'edtm' => '終了時間(昇順)',
            'edtm-' => '終了時間(降順)',
            'smm' => '開始日時特記事項(昇順)',
            'smm-' => '開始日時特記事項(降順)',
            'dcp' => '説明(昇順)',
            'dcp-' => '説明(降順)',
            'fbc' => '料金(基本)(昇順)',
            'fbc-' => '料金(基本)(降順)',
            'fdt' => '料金(詳細)(昇順)',
            'fdt-' => '料金(詳細)(降順)',
            'ctnm' => '連絡先名称(昇順)',
            'ctnm-' => '連絡先名称(降順)',
            'cttl' => '連絡先電話番号(昇順)',
            'cttl-' => '連絡先電話番号(降順)',
            'cttlx' => '連絡先内線番号(昇順)',
            'cttlx-' => '連絡先内線番号(降順)',
            'og' => '主催者(昇順)',
            'og-' => '主催者(降順)',
            'lnm' => '場所名称(昇順)',
            'lnm-' => '場所名称(降順)',
            'adr' => '住所(昇順)',
            'adr-' => '住所(降順)',
            'adr2' => '方書(昇順)',
            'adr2-' => '方書(降順)',
            'lt' => '緯度(昇順)',
            'lt-' => '緯度(降順)',
            'lg' => '経度(昇順)',
            'lg-' => '経度(降順)',
            'acc' => 'アクセス方法(昇順)',
            'acc-' => 'アクセス方法(降順)',
            'pk' => '駐車場情報(昇順)',
            'pk-' => '駐車場情報(降順)',
            'cpc' => '定員(昇順)',
            'cpc-' => '定員(降順)',
            'etdd' => '参加申込終了日(昇順)',
            'etdd-' => '参加申込終了日(降順)',
            'ettm' => '参加申込終了時間(昇順)',
            'ettm-' => '参加申込終了時間(降順)',
            'emd' => '参加申込方法(昇順)',
            'emd-' => '参加申込方法(降順)',
            'eur' => 'URL(昇順)',
            'eur-' => 'URL(降順)',
            'mm' => '備考(昇順)',
            'mm-' => '備考(降順)',
            'cgr' => 'カテゴリー(昇順)',
            'cgr-' => 'カテゴリー(降順)',
            'wdnm' => '区(昇順)',
            'wdnm-' => '区(降順)',
            'opdt' => '公開日(昇順)',
            'opdt-' => '公開日(降順)',
            'updt' => '更新日(昇順)',
            'updt-' => '更新日(降順)',
            'iscd' => '子育て情報(昇順)',
            'iscd-' => '子育て情報(降順)',
            'lcno' => '施設No.(昇順)',
            'lcno-' => '施設No.(降順)',
            'cat' => '登録日時(昇順)',
            'cat-' => '登録日時(降順)',
            'uat' => '更新日時(昇順)',
            'uat-' => '更新日時(降順)'
        ];
    }

    /**
     * 条件 $conds をもとに順序のカラムを返す
     *
     * @param array $conds
     * @return string $column
     */
    protected function orderColumn(array $conds): string
    {
        $column = 'id';

        if ($conds['o']) {
            $o = $conds['o'];
            $o = str_replace(['-'], '', $o);

            $column = match ($o) {
                'id' => 'id',
                'pcd' => 'pref_code',
                'rid' => 'record_id',
                'pnm' => 'pref_name',
                'cnm' => 'city_name',
                'enm' => 'event_name',
                'ekn' => 'event_kana',
                'een' => 'event_en',
                'stdt' => 'start_date',
                'eddt' => 'end_date',
                'sttm' => 'start_time',
                'edtm' => 'end_time',
                'smm' => 'start_memo',
                'dcp' => 'description',
                'fbc' => 'fee_basic',
                'fdt' => 'fee_detail',
                'ctnm' => 'contact_name',
                'cttl' => 'contact_tel',
                'cttlx' => 'contact_tel_ext',
                'og' => 'organizer',
                'lnm' => 'location_name',
                'adr' => 'address',
                'adr2' => 'address2',
                'lt' => 'lat',
                'lg' => 'lng',
                'acc' => 'access',
                'pk' => 'parking',
                'cpc' => 'capacity',
                'etdd' => 'entry_due_date',
                'ettm' => 'entry_due_time',
                'emd' => 'entry_method',
                'eur' => 'entry_url',
                'mm' => 'memo',
                'cgr' => 'category',
                'wdnm' => 'ward_name',
                'opdt' => 'open_date',
                'updt' => 'update_date',
                'iscd' => 'is_childcare',
                'lcno' => 'location_no',
                'cat' => 'created_at',
                'uat' => 'updated_at',

                default => $column
            };
        }

        return $column;
    }

    /**
     * その時の検索条件に従ってプログラムの一覧を取得する 
     *
     * @param Request $request
     * @param array $conds
     * @param array $addConds
     * @param boolean $forMap
     * @return Collection
     */
    public function getSearch(array $conds, array $addConds = [], bool $forMap = false)
    {
        $conds = array_merge($conds, $addConds);

        $results = Event::query()

            // id
            ->when($conds['id'], fn($results) => $results->where(
                'id',
                $conds['id']
            ))

            // キーワード
            ->when($conds['s'], fn($results) => $results->where(
                fn($q) => $q->where(
                    // ID
                    'ID',
                    'like',
                    "%{$conds['s']}%",
                )
                /*
                ->orWhere(
                    // 詳細説明
                    'description',
                    'like',
                    "%{$conds['s']}%",
                )
                */
            ))

            // 登録期間From
            ->when($conds['catf'], fn($results) => $results->where(
                'created_at',
                '>=',
                $conds['catf']
            ))

            // 登録期間To
            ->when($conds['catt'], fn($results) => $results->where(
                'created_at',
                '<=',
                MirUtil::parseDt($conds['catt'])?->endOfDay()
            ))

            // 順序を指定(NULLは常に後ろにする)
            ->orderByRaw(
                $this->orderColumn($conds) . " is null asc, " . $this->orderColumn($conds) . " " . MirSearch::orderDirection($conds, 'desc')
            );

        $count = $results->count();

        // $results->dd();

        $n = ($forMap) ? 200 : $conds['n'];

        $results = $results->simplePaginate($n);

        // ページネーションに現状の検索条件を引き継ぎ
        $conds = Arr::where($conds, fn($value, $key) => $value);
        $results->appends($conds);

        return $results;
    }

    /**
     * 検索条件の説明文を作成する
     *
     * @param array $conds
     * @return string
     */
    public function getSearchDescription(array $conds): string
    {
        $descriptions = [];
        $orders = $this->getOrders();

        // ID
        if ($conds['id']) {
            $descriptions[] = "IDが{$conds['id']}";
        }

        // キーワード
        if ($conds['s']) {
            $descriptions[] = "「{$conds['s']}」を含む";
        }

        // 開始日
        if ($conds['catf']) {
            $descriptions[] = "登録日が{$conds['catf']}以降";
        }

        // 終了日
        if ($conds['catt']) {
            $descriptions[] = "登録日が{$conds['catt']}以前";
        }

        if ($conds['o']) {
            $orderDesc = $orders[$conds['o']] ?? '';
            if ($orderDesc) {
                // TODO: seq順の場合はここをコメントすれば非表示に
                // $descriptions[] = "{$orderDesc}";
            }
        }

        if (empty($descriptions)) {
            return '';
        }

        return implode('、', $descriptions);
    }

    public function redirectToLastCondition(Request $request)
    {
        $last_conds = MirSearch::getLast($request, $this->model_name);
        $last_conds = array_merge($last_conds);
        $last_conds = array_merge($last_conds, $request->all());

        // フラッシュデータを次のセッションまで持ち越し
        $request->session()->reflash();

        $dest = $last_conds['d'] ?? '';

        $destRoute = match ($dest) {
            'index'  => 'r4.events.index',
            'lnav'  => 'r4.events.lnav',
            'index_live'  => 'r4.events.index_live',
            default  => 'r4.events.index',
        };

        return redirect()
            ->route($destRoute, $last_conds);
    }

    /**
     * Save sort order
     *
     * @param array $item_ids
     * @return void
     */
    public function saveSortOrder(array $item_ids, string $order_column = 'seq'): void
    {
        $seq = 100000;
        foreach ($item_ids as $id) {
            EventDa::update($id, [
                $order_column => $seq
            ]);
            $seq -= 2;
        }
        return;
    }

    /**
     * Find Record for BaseCs
     *
     * @param integer $id
     * @return Event|null
     */
    protected function find(int $id, string $key = 'id'): Event|null
    {
        return Event::find($id);
    }

    /**
     * Create Record for BaseCs
     *
     * @param array $item
     * @return int
     */
    protected function create(array $item): int
    {
        $id = Event::create($item)->id;
        return $id;
    }

    /**
     * 一次元配列で指定されたIDの配列に応じてレコードを取得する。最大1000件まで。
     *
     * アップロード時の差分比較用に BaseCs の getMatrixFromDbByIds から
     * 1000件ごとに分割して呼び出されている。
     *
     * @param array $ids
     * @return Collection|null
     */
    protected function findByIds(array $ids)
    {
        $collections = EventDa::getMatrixByIds(
            ids: $ids,
        );
        return $collections;
    }
}
