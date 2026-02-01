<?php

namespace App\ControllerSupports;

use Carbon\Carbon;
use App\Lib\Mms\MmsCode;
use App\Models\GomiItem;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\DataAccess\GomiItemDa;
use \Illuminate\Support\Collection;
use App\UseCases\GomiItemUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Lib\Mir\MirSearch;
use App\Lib\Mir\MirUtil;

/**
 * ごみ分別のコントローラーの詳細処理
 * 条件検索、ソート等の詳細処理を行う。
 * ダウンロード、アップロード等は BaseCs に実体がある
 */
final class GomiItemCs extends BaseCs
{
    protected string $model_label = 'ごみ分別';
    protected string $model_name = 'gomi_item';
    protected string $upload_input = 'excel';
    protected string $default_order = 'sq-';
    private GomiItemUseCase $gomiItemUseCase;

    function __construct() {
        $this->gomiItemUseCase = new GomiItemUseCase();
    }

    /**
     * エクスポートするカラムキーとカラム名の連想配列を返す
     *
     * @return array
     */
    protected function getExportKvs(): array
    {
        return [
            'id' => 'ID',
            'kana1' => '行',
            'name' => '品目',
            'detail' => '詳細',
            'size' => '大きさ・長さ',
            'gomi_type' => '分別品目',
            'fee' => '処理手数料',
            'description' => '連絡ごみ備考',
            'howto' => '排出方法･備考',
            'words' => 'URLに関連するワード',
            'url' => '浜松市公式Webサイト 参考ページURL',
            'memo' => '分別品目の補足',
            'created_at' => '登録日時',
            'updated_at' => '更新日時'            
        ];
    }

    protected function getUploadRules(string $id = '0', array $item = []): array
    {
        $rules = [
            'id' => ['nullable', 'integer'],
            'kana1' => ['nullable', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:64'],
            'detail' => ['nullable', 'string', 'max:64'],
            'size' => ['nullable', 'string', 'max:64'],
            'gomi_type' => ['nullable', 'string', 'max:64'],
            'fee' => ['nullable', 'string', 'max:64'],
            'description' => ['nullable', 'string', 'max:4000'],
            'howto' => ['nullable', 'string', 'max:4000'],
            'words' => ['nullable', 'string', 'max:4000'],
            'url' => ['nullable', 'string', 'max:4000'],
            'memo' => ['nullable', 'string', 'max:4000'],
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
            $last_conds = MirSearch::getLast($request, 'gomi_item');

            if ($last_conds) {
                $conds = array_merge($last_conds, $merge);
                return $conds;
            }
        }

        $conds = [
            'id' => $request->input('id'), // ID,
            'kn1' => $request->input('kn1'), // 行,
            'nm' => $request->input('nm'), // 品目,
            'dt' => $request->input('dt'), // 詳細,
            'sz' => $request->input('sz'), // 大きさ・長さ,
            'gtp' => $request->input('gtp'), // 分別品目,
            'fe' => $request->input('fe'), // 処理手数料,
            'dc' => $request->input('dc'), // 連絡ごみ備考,
            'hw' => $request->input('hw'), // 排出方法･備考,
            'wd' => $request->input('wd'), // URLに関連するワード,
            'ul' => $request->input('ul'), // 浜松市公式Webサイト 参考ページURL,
            'mm' => $request->input('mm'), // 分別品目の補足,
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
            'id' => 'ID(昇順)',
            'id-' => 'ID(降順)',
            'kn1' => '行(昇順)',
            'kn1-' => '行(降順)',
            'nm' => '品目(昇順)',
            'nm-' => '品目(降順)',
            'dt' => '詳細(昇順)',
            'dt-' => '詳細(降順)',
            'sz' => '大きさ・長さ(昇順)',
            'sz-' => '大きさ・長さ(降順)',
            'gtp' => '分別品目(昇順)',
            'gtp-' => '分別品目(降順)',
            'fe' => '処理手数料(昇順)',
            'fe-' => '処理手数料(降順)',
            'dc' => '連絡ごみ備考(昇順)',
            'dc-' => '連絡ごみ備考(降順)',
            'hw' => '排出方法･備考(昇順)',
            'hw-' => '排出方法･備考(降順)',
            'wd' => 'URLに関連するワード(昇順)',
            'wd-' => 'URLに関連するワード(降順)',
            'ul' => '浜松市公式Webサイト 参考ページURL(昇順)',
            'ul-' => '浜松市公式Webサイト 参考ページURL(降順)',
            'mm' => '分別品目の補足(昇順)',
            'mm-' => '分別品目の補足(降順)',
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
                'kn1' => 'kana1',
                'nm' => 'name',
                'dt' => 'detail',
                'sz' => 'size',
                'gtp' => 'gomi_type',
                'fe' => 'fee',
                'dc' => 'description',
                'hw' => 'howto',
                'wd' => 'words',
                'ul' => 'url',
                'mm' => 'memo',
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

        $results = GomiItem::query()

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
                ->orWhere(
                    // 詳細説明
                    'name',
                    'like',
                    "%{$conds['s']}%",
                )
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
            'index'  => 'r4.gomi_items.index',
            'lnav'  => 'r4.gomi_items.lnav',
            'index_live'  => 'r4.gomi_items.index_live',
            default  => 'r4.gomi_items.index',
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
            GomiItemDa::update($id, [
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
     * @return GomiItem|null
     */
    protected function find(int $id, string $key = 'id'): GomiItem|null
    {
        return GomiItem::find($id);
    }

    /**
     * Create Record for BaseCs
     *
     * @param array $item
     * @return int
     */
    protected function create(array $item): int
    {
        $id = GomiItem::create($item)->id;
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
        $collections = GomiItemDa::getMatrixByIds(
            ids: $ids,
        );
        return $collections;
    }
}
