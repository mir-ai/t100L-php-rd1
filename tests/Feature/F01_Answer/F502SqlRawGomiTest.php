<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * テーブル gomi_items にサンプルデータが入っています。
 * 
 * アプリ Sqlace でみたい場合は、 データベース _t100_php_quiz1 > テーブル gomi_items
 * 
 * MariaDB [_t100_php_quiz1]> desc gomi_items;
 * 
 *  +-------------+------------------+------+-----+---------------------+
 *  | Field       | Type             | Null | Key | Default             |
 *  +-------------+------------------+------+-----+---------------------+
 *  | id          | int(10) unsigned | NO   | PRI | NULL                |
 *  | kana1       | varchar(4)       | YES  |     | NULL                |
 *  | name        | varchar(64)      | NO   | MUL | NULL                |
 *  | detail      | varchar(64)      | YES  |     | NULL                |
 *  | size        | varchar(64)      | YES  |     | NULL                |
 *  | gomi_type   | varchar(64)      | YES  |     | NULL                |
 *  | fee         | int(11)          | YES  |     | NULL                |
 *  | description | text             | YES  |     | NULL                |
 *  | howto       | text             | YES  |     | NULL                |
 *  | words       | text             | YES  |     | NULL                |
 *  | url         | text             | YES  |     | NULL                |
 *  | memo        | text             | YES  |     | NULL                |
 *  | created_at  | datetime         | NO   |     | current_timestamp() |
 *  | updated_at  | datetime         | NO   |     | current_timestamp() |
 *  | deleted_at  | datetime         | YES  |     | NULL                |
 *  +-------------+------------------+------+-----+---------------------+
 * 
 */
class F502SqlRawGomiTest extends TestCase
{
    // アイロン(name)の連絡ごみ(gomi_type)の処理手数料(fee)を探してみよう
    public function test_502_010_iron_price(): void
    {
        $rows = [];

        // QUIZ
        $rows = DB::select('
           select name, fee
             from gomi_items
            where name = \'アイロン\'
              and gomi_type = \'連絡ごみ\'
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[$row->name] = $row->fee;
        }

        $expected = [
            'アイロン' => 310,
        ];

        $this->assertSame($expected, $actual);
    }

    // 上級課題2
    // 電池を取り外して排出する必要のある（howto）ごみ名称(hame)を抽出してみよう
    // 「排出方法･備考」(howto)に「電池類は取り外」と書かれているもの
    // name 順に、上位 3 件
    public function test_502_020_without_battery(): void
    {
        $rows = [];

        // QUIZ
        $rows = DB::select('
           select name
             from gomi_items
            where howto like \'%電池類は取り外%\'
            order by name
            limit 3
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[] = $row->name;
        }

        $expected = [
            'AED',
            'AVモニター',
            'CDプレーヤー',
        ];

        $this->assertSame($expected, $actual);
    }

    // 上級課題3
    // 全部の品目を１点ずつ排出したら、総額いくらになるかを求めてみよう
    public function test_502_030_total_prices(): void
    {
        $rows = [];

        // QUIZ
        $rows = DB::select('
           select sum(fee) as total_fee
             from gomi_items
        ');
        // /QUIZ

        $actual = [];
        foreach ($rows as $row) {
            $actual[] = $row->total_fee;
        }

        $expected = [
            '225370',
        ];

        $this->assertSame($expected, $actual);        
    }
}
