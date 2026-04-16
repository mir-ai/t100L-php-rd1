<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * テーブル populations にサンプルデータが入っています。
 * 
 * populations
 * 
 * MariaDB [_t100_php_quiz1]> desc populations;
 * 
 * +---------------+------------------+------+-----+---------------------+
 * | Field         | Type             | Null | Key | Default             |
 * +---------------+------------------+------+-----+---------------------+
 * | id            | int(10) unsigned | NO   | PRI | NULL                |
 * | pref_code     | int(11)          | NO   | MUL | NULL                |
 * | pref_name     | varchar(16)      | NO   |     | NULL                |
 * | city_name     | varchar(16)      | NO   |     | NULL                |
 * | yyyymm        | varchar(16)      | NO   |     | NULL                |
 * | ward_code     | int(11)          | NO   |     | NULL                |
 * | ward_name     | varchar(16)      | NO   |     | NULL                |
 * | district_name | varchar(16)      | NO   |     | NULL                |
 * | oaza_code     | int(11)          | NO   |     | NULL                |
 * | oaza_name     | varchar(16)      | YES  |     | NULL                |
 * | age           | varchar(16)      | NO   |     | NULL                |
 * | total_count   | int(11)          | NO   |     | 0                   |
 * | male_count    | int(11)          | NO   |     | 0                   |
 * | female_count  | int(11)          | NO   |     | 0                   |
 * | description   | text             | YES  |     | NULL                |
 * | created_at    | datetime         | NO   |     | current_timestamp() |
 * | updated_at    | datetime         | NO   |     | current_timestamp() |
 * | deleted_at    | datetime         | YES  |     | NULL                |
 * +---------------+------------------+------+-----+---------------------+
 * 
 */
class F504SqlRawPopoulationTest extends TestCase
{
    // 0歳児の多い順に町を３件出力してみよう
    public function test_504_010_happy_newborn_town(): void
    {
        $rows = [];
        // QUIZ
        $rows = DB::select('
           select oaza_name, total_count
             from populations
            where age = 0
            order by total_count desc
            limit 3
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->oaza_name] = $row->total_count;
        }

        $expected = [
            '三方原町' => 101,
            '富塚町' => 99,
            '初生町' => 99,
        ];

        $this->assertSame($expected, $actual);
    }

    // 平均年齢の高い町(oaza_name)上位３件を算出してみよう。小数点１位まで。
    public function test_504_020_oldest_city_ranking(): void
    {
        $rows = [];
        // QUIZ
        $rows = DB::select('
           select oaza_name, (sum(total_count * age) / sum(total_count)) as avg_age
             from populations
            group by oaza_name
            order by avg_age desc
            limit 3
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->oaza_name] = sprintf("%.1f", $row->avg_age);
        }

        $expected = [
            '水窪町山住' => '77.3',
            '春野町花島' => '77.3',
            '佐久間町上平山' => '77.0',
        ];

        $this->assertSame($expected, $actual);
    }

    // 上級課題4
    // 男性(male_count)と女性(female_count)の平均年齢差(女性-男性)を算出してみよう
    public function test_504_030_average_age_by_gender(): void
    {
        $rows = [];
        // QUIZ
        $rows = DB::select('
           select (sum(male_count * age) / sum(male_count)) as avg_male_age, 
                  (sum(female_count * age) / sum(female_count)) as avg_female_age
             from populations
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual['男性平均年齢'] = sprintf("%.1f", $row->avg_male_age);
            $actual['女性平均年齢'] = sprintf("%.1f", $row->avg_female_age);
            $actual['平均年齢差'] = sprintf("%.1f", $row->avg_female_age - $row->avg_male_age);
        }

        $expected = [
            '男性平均年齢' => '46.2',
            '女性平均年齢' => '49.2',
            '平均年齢差' => '3.0',
        ];

        $this->assertSame($expected, $actual);
    }

    // 上級課題5
    // 中央区、浜名区、天竜区(ward_name)の平均年齢を算出してみよう
    public function test_504_040_average_age_by_ward(): void
    {
        $rows = [];

        // QUIZ
        $rows = DB::select('
           select ward_name, (sum(total_count * age) / sum(total_count)) as avg_age
             from populations
            group by ward_name
            order by ward_name
        ');
        // /QUIZ

        $actual = [];

        foreach ($rows as $row) {
            $actual[$row->ward_name] = sprintf("%.1f", $row->avg_age);
        }

        $expected = [
            '中央区' => '47.2',
            '天竜区' => '57.6',
            '浜名区' => '48.0',
        ];

        $this->assertSame($expected, $actual);
    }

}
