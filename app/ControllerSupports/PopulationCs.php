<?php

namespace App\ControllerSupports;

use Carbon\Carbon;
use App\Lib\Mms\MmsCode;
use App\Models\Population;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\DataAccess\PopulationDa;
use \Illuminate\Support\Collection;
use App\UseCases\PopulationUseCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Lib\Mir\MirSearch;
use App\Lib\Mir\MirUtil;

/**
 * 人口のコントローラーの詳細処理
 * 条件検索、ソート等の詳細処理を行う。
 * ダウンロード、アップロード等は BaseCs に実体がある
 */
final class PopulationCs extends BaseCs
{
    protected string $model_label = '人口';
    protected string $model_name = 'population';
    protected string $upload_input = 'excel';
    protected string $default_order = 'sq-';
    private PopulationUseCase $populationUseCase;

    function __construct() {
        $this->populationUseCase = new PopulationUseCase();
    }

    /**
     * エクスポートするカラムキーとカラム名の連想配列を返す
     *
     * @return array
     */
    protected function getExportKvs(): array
    {
        return [
            'id' => 'NO',
            'pref_code' => '都道府県コード又は市区町村コード',
            'pref_name' => '都道府県',
            'city_name' => '市区町村名',
            'yyyymm' => '対象年月',
            'ward_code' => '区CD',
            'ward_name' => '区',
            'district_name' => '地区',
            'oaza_code' => '大字CD',
            'oaza_name' => '大字',
            'age' => '年齢',
            'total_count' => '合計',
            'male_count' => '男性',
            'female_count' => '女性',
            'description' => '備考',
            'created_at' => '登録日時',
            'updated_at' => '更新日時'            
        ];
    }

    protected function getUploadRules(string $id = '0', array $item = []): array
    {
        $rules = [
            'id' => ['nullable', 'integer'],
            'pref_code' => ['required', 'integer'],
            'pref_name' => ['required', 'string', 'max:16'],
            'city_name' => ['required', 'string', 'max:16'],
            'yyyymm' => ['required', 'string', 'max:16'],
            'ward_code' => ['required', 'integer'],
            'ward_name' => ['required', 'string', 'max:16'],
            'district_name' => ['required', 'string', 'max:16'],
            'oaza_code' => ['required', 'integer'],
            'oaza_name' => ['required', 'string', 'max:16'],
            'age' => ['required', 'string', 'max:16'],
            'total_count' => ['nullable', 'integer'],
            'male_count' => ['nullable', 'integer'],
            'female_count' => ['nullable', 'integer'],
            'description' => ['nullable', 'string', 'max:200'],
        ];

        // Unique check
        if ($id) {
            $rules['age'][] = Rule::unique('populations')
            ->where('pref_code', $item['pref_code'])
            ->where('city_name', $item['city_name'])
            ->where('ward_code', $item['ward_code'])
            ->where('oaza_code', $item['oaza_code'])
            ->where('age', $item['age'])
            ->ignore($id, 'id');
        } else {
            if ($item) {
              $rules['age'][] = Rule::unique('populations')
                ->where('pref_code', $item['pref_code'])
                ->where('city_name', $item['city_name'])
                ->where('ward_code', $item['ward_code'])
                ->where('oaza_code', $item['oaza_code'])
                ->where('age', $item['age']);
            }
        }

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
            $last_conds = MirSearch::getLast($request, 'population');

            if ($last_conds) {
                $conds = array_merge($last_conds, $merge);
                return $conds;
            }
        }

        $conds = [
            'id' => $request->input('id'), // NO,
            'pfcd' => $request->input('pfcd'), // 都道府県コード又は市区町村コード,
            'pfnm' => $request->input('pfnm'), // 都道府県,
            'ctcd' => $request->input('ctcd'), // 市区町村名,
            'yym' => $request->input('yym'), // 対象年月,
            'wcd' => $request->input('wcd'), // 区CD,
            'wnm' => $request->input('wnm'), // 区,
            'dnm' => $request->input('dnm'), // 地区,
            'ocd' => $request->input('ocd'), // 大字CD,
            'onm' => $request->input('onm'), // 大字,
            'ag' => $request->input('ag'), // 年齢,
            'tct' => $request->input('tct'), // 合計,
            'mct' => $request->input('mct'), // 男性,
            'fct' => $request->input('fct'), // 女性,
            'dsc' => $request->input('dsc'), // 備考,
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
            'id' => 'NO(昇順)',
            'id-' => 'NO(降順)',
            'pfcd' => '都道府県コード又は市区町村コード(昇順)',
            'pfcd-' => '都道府県コード又は市区町村コード(降順)',
            'pfnm' => '都道府県(昇順)',
            'pfnm-' => '都道府県(降順)',
            'ctcd' => '市区町村名(昇順)',
            'ctcd-' => '市区町村名(降順)',
            'yym' => '対象年月(昇順)',
            'yym-' => '対象年月(降順)',
            'wcd' => '区CD(昇順)',
            'wcd-' => '区CD(降順)',
            'wnm' => '区(昇順)',
            'wnm-' => '区(降順)',
            'dnm' => '地区(昇順)',
            'dnm-' => '地区(降順)',
            'ocd' => '大字CD(昇順)',
            'ocd-' => '大字CD(降順)',
            'onm' => '大字(昇順)',
            'onm-' => '大字(降順)',
            'ag' => '年齢(昇順)',
            'ag-' => '年齢(降順)',
            'tct' => '合計(昇順)',
            'tct-' => '合計(降順)',
            'mct' => '男性(昇順)',
            'mct-' => '男性(降順)',
            'fct' => '女性(昇順)',
            'fct-' => '女性(降順)',
            'dsc' => '備考(昇順)',
            'dsc-' => '備考(降順)',
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
                'pfcd' => 'pref_code',
                'pfnm' => 'pref_name',
                'ctcd' => 'city_name',
                'yym' => 'yyyymm',
                'wcd' => 'ward_code',
                'wnm' => 'ward_name',
                'dnm' => 'district_name',
                'ocd' => 'oaza_code',
                'onm' => 'oaza_name',
                'ag' => 'age',
                'tct' => 'total_count',
                'mct' => 'male_count',
                'fct' => 'female_count',
                'dsc' => 'description',
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

        $results = Population::query()

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
                    'oaza_name',
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
            'index'  => 'r4.populations.index',
            'lnav'  => 'r4.populations.lnav',
            'index_live'  => 'r4.populations.index_live',
            default  => 'r4.populations.index',
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
            PopulationDa::update($id, [
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
     * @return Population|null
     */
    protected function find(int $id, string $key = 'id'): Population|null
    {
        return Population::find($id);
    }

    /**
     * Create Record for BaseCs
     *
     * @param array $item
     * @return int
     */
    protected function create(array $item): int
    {
        $id = Population::create($item)->id;
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
        $collections = PopulationDa::getMatrixByIds(
            ids: $ids,
        );
        return $collections;
    }
}
