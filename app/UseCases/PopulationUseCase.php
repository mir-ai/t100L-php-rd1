<?php namespace App\UseCases;

use \App\DataAccess\PopulationDa;

use Carbon\Carbon;
use App\Lib\CityUtil;
use App\Models\Population;
use App\DataAccess\ChangeLogDa;

/**
 * 人口のユースケース
 */
class PopulationUseCase
{
    function __construct() {}

    // TODO: 変更点を記録する場合はコメントアウトする。
//    /**
//     * 人口テーブルへの変更点を記録する
//     *
//     * @param int $target_id,
//     * @param array $attributes_old
//     * @param array $attributes_new
//     * @return void
//     */
//    public function recordChanges(int $target_id, array $attributes_old, array $attributes_new)
//    {
//        ChangeLogDa::recordChanges(
//            table_name: 'populations',
//            target_id: $target_id,
//            attributes_old: $attributes_old,
//            attributes_new: $attributes_new,
//        );
//    }
//
//    /**
//     * 人口の設定変更履歴を取得する
//     *
//     * @param integer $population_id
//     * @return void
//     */
//    public function getChangeLog(int $population_id)
//    {
//        $change_logs = ChangeLogDa::getSimplePagenamegetById(
//            table_name: 'populations',
//            target_id: $population_id
//        );
//
//        return $change_logs;
//    }
//
//    /**
//     * 人口レポートを作成
//     *
//     * @param string $mode
//     * @param [type] $populations
//     * @return array
//     */
//    public function makeReport(string $mode, $populations)
//    {
//        $count_by = match ($mode) {
//            'hourly' => $this->countByDateFormat($populations, 'Y年m月d日 H時'),
//            'daily' => $this->countByDateFormat($populations, 'Y年m月d日'),
//            'monthly' => $this->countByDateFormat($populations, 'Y年m月'),
//            default => $this->countByDateFormat($populations, 'Y年m月d日'),
//        };
//
//        return $count_by;
//    }
//
//    /**
//     * 時間、日、月ごとに集計
//     *
//     * @param [type] $populations
//     * @param string $date_format
//     * @return array
//     */
//    private function countByDateFormat($populations, string $date_format)
//    {
//        $count_by = [];
//        foreach ($populations as $population) {
//            $key1 = $population->created_at->format($date_format);
//            $key2 = $population->type ?? '';
//
//            if (! isset($count_by[$key1])) {
//                $count_by[$key1] = [];
//                $count_by[$key1]['total'] = 0;
//            }
//            if (! isset($count_by[$key1][$key2])) {
//                $count_by[$key1][$key2] = 0;
//            }
//            
//            $count_by[$key1][$key2]++;
//            $count_by[$key1]['total']++;
//        }
//
//        return $count_by;
//    }
//
//    public function makeReportHeader()
//    {
//        // id, type の連想配列を取得
//        // TODO: タイプを取得
//        $key2_kvs = ['japan' => '日本', 'china' => '中国', 'korea' => '韓国'];
//
//        // 合計カラムを追加
//        $key2_kvs['total'] = '合計';
//
//        return $key2_kvs;
//    }    

}
