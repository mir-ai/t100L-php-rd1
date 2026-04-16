<?php

namespace Tests\Unit\U14_YMurakami;

use PHPUnit\Framework\TestCase;

class U370PopulationTest extends TestCase
{
    //
    public function test_370_010_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    // 実務課題 : 浜松市の高齢化上位の地区の抽出

    // tests/Unit/data/populations_utf8.csv または tests/Unit/data/populations_small_utf8.csv を読んで、
    // 浜松市で一番高齢化(65歳以上の人口の占める割合)の高い町名の上位３件を取得して下さい。
    // 以下のデータを作りたい。
    private function getOutput(): array
    {
        return [
            '浜松市天竜区春野地区春野町大時',
            '浜松市天竜区佐久間地区佐久間町戸口',
            '浜松市天竜区春野地区春野町花島',
        ];
    }

    // ヒント 要素分解1 ファイルから各項目を読んで取得する
    public function test_370_read_csv(): void
    {
        $filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

        // 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }

        $expected = [
            [
                "NO" => "53446",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9006",
                "大字" => "春野町大時",
                "年齢" => "0",
                "合計" => "0",
                "男性" => "0",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "53511",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9006",
                "大字" => "春野町大時",
                "年齢" => "65",
                "合計" => "100",
                "男性" => "1",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "55861",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "佐久間地区",
                "大字CD" => "10008",
                "大字" => "佐久間町戸口",
                "年齢" => "0",
                "合計" => "10",
                "男性" => "0",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "55926",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "佐久間地区",
                "大字CD" => "10008",
                "大字" => "佐久間町戸口",
                "年齢" => "65",
                "合計" => "100",
                "男性" => "1",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "54391",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9015",
                "大字" => "春野町花島",
                "年齢" => "0",
                "合計" => "20",
                "男性" => "0",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "54456",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9015",
                "大字" => "春野町花島",
                "年齢" => "65",
                "合計" => "100",
                "男性" => "0",
                "女性" => "0",
                "備考" => "",
            ]
        ];

        $this->assertSame($expected, $actual);
    }

    // ヒント 要素分解2
    // データを中間配列1に入れる
    // $data['市区町村名'] = [
    //   'total_count' => 100,
    //   'elder_count' => 60,
    // ]
    public function test_370_030_make_array_1(): void
    {
        $v = [
            [
                "NO" => "53446",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9006",
                "大字" => "春野町大時",
                "年齢" => "0",
                "合計" => "30",
                "男性" => "30",
                "女性" => "0",
                "備考" => "",
            ],
            [
                "NO" => "53511",
                "都道府県コード又は市区町村コード" => "221309",
                "都道府県" => "静岡県",
                "市区町村名" => "浜松市",
                "対象年月" => "202409",
                "区CD" => "22140",
                "区" => "天竜区",
                "地区" => "春野地区",
                "大字CD" => "9006",
                "大字" => "春野町大時",
                "年齢" => "65",
                "合計" => "70",
                "男性" => "70",
                "女性" => "0",
                "備考" => "",
            ],
        ];

        $r = [];
        foreach ($v as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] >= 65) {
                $elder_count = $r[$town_name]['elder_count'] ?? 0;
                $r[$town_name]['elder_count'] = $elder_count + intval($item['合計']);
            }
        }

        $actual = $r;
        $expected = [
            "浜松市天竜区春野地区春野町大時" => [
                "total_count" => 100,
                "elder_count" => 70
            ]
        ];

        $this->assertSame($expected, $actual);
    }

    // ヒント 要素分解3 中間配列１から各町の人数と高齢者数を読んで、高齢者率を計算する
    public function test_370_040_test(): void
    {
        $v = [
            "浜松市天竜区春野地区春野町大時" => [
                "total_count" => 100,
                "elder_count" => 70
            ]
        ];

        $r = [];
        foreach ($v as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $elder_count = $count_item['elder_count'];
            if ($total_count) {
                $elder_rate = ($elder_count / $total_count);
            }

            $r[$city_name] = $elder_rate;
        }

        $actual = $r;
        $expected = [
            '浜松市天竜区春野地区春野町大時' => 0.7
        ];

        $this->assertSame($expected, $actual);
    }

    // ヒント 要素分解4 高齢化率の多い順に並べ替える
    // ヒント 要素分解5 上位3件を取得
    public function test_370_050_orders()
    {
        $v = [
            'みらい市' => 60.0,
            'こだい市'  => 80.0,
            'かこ市'  => 70.0,
        ];

        // 高齢化率の多い順に並べ替える
        arsort($v);

        // 上位2件を取得
        $actual = array_slice($v, 0, 2);

        $expected = [
            'こだい市'  => 80.0,
            'かこ市'  => 70.0,
        ];

        $this->assertSame($expected, $actual);
    }

    // じぶんでやってみよう
    public function test_370_060_highest_elder_town(): void
    {
        // 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

        // QUIZ
		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] >= 65) {
                $elder_count = $r[$town_name]['elder_count'] ?? 0;
                $r[$town_name]['elder_count'] = $elder_count + intval($item['合計']);
            }
        }
        // 要素分解3 中間配列１から各町の人数と高齢者数を読んで、高齢者率を計算する
        foreach ($r as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $elder_count = $count_item['elder_count'];
            if ($total_count) {
                $elder_rate = ($elder_count / $total_count);
            }

            $r[$city_name] = $elder_rate;
        }

        // 高齢化率の多い順に並べ替える
        arsort($r);

        // 上位3件を取得
        $actual = array_slice($r, 0, 3);
        $actual = array_keys($actual);

        // /QUIZ
        $expected = $this->getOutput();

        $this->assertSame($expected, $actual);
    }


    // さらに以下の課題にチャレンジしてみよう
    // これができると、実際の業務に携わることができるようになります。

    // 上級課題１
    // 高齢化率の低い順に町を３件出力してみよう
    public function test_370_070_youngest_town(): void
    {
        // QUIZ
		// 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] >= 65) {
                $elder_count = $r[$town_name]['elder_count'] ?? 0;
                $r[$town_name]['elder_count'] = $elder_count + intval($item['合計']);
            }
        }
        // 要素分解 中間配列１から各町の人数と高齢者数を読んで、高齢者率を計算する
        foreach ($r as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $elder_count = $count_item['elder_count'];
            if ($total_count) {
                $elder_rate = ($elder_count / $total_count);
            }

            $r[$city_name] = $elder_rate;
        }

        // 高齢化率の低い順に並べ替える
        asort($r);

        // 上位3件を取得
        $actual = array_slice($r, 0, 3);
        $actual = array_keys($actual);
        // dump($actual);
        // /QUIZ
        $this->assertTrue(true);
    }



    // 上級課題２
    // 0歳児の多い順に町を３件出力してみよう
    public function test_370_080_happy_newborn_town(): void
    {
        // QUIZ
		// 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] == 0) {
                $new_baby = $r[$town_name]['baby_count'] ?? 0;
                $r[$town_name]['baby_count'] = $new_baby;
            }
        }
        // 要素分解 中間配列１から各町の人数と0歳児人数を読んで、0歳児の割合を計算する
        foreach ($r as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $new_baby = $count_item['baby_count'];
            if ($total_count) {
                $new_baby_rate = ($new_baby / $total_count);
            }

            $r[$city_name] = $new_baby_rate;
        }

        // 0歳児率の高い順に並べ替える
        arsort($r);

        // 上位3件を取得
        $actual = array_slice($r, 0, 3);
        $actual = array_keys($actual);
        // dump($actual);
        // /QUIZ
        $this->assertTrue(true);
    }



    // 上級課題3
    // 町ごとの平均年齢を算出してみよう
    public function test_380_090_average_age_by_town(): void
    {
        // QUIZ
		// 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] >= 0) {
                $age_count = $r[$town_name]['age_count'] ?? 0;
                $r[$town_name]['age_count'] = $age_count + (intval($item['合計'] * intval($item['年齢'])));
            }
        }
        // 要素分解 中間配列１から各町の人数と年齢＊人数の総和を読んで、平均年齢を計算する
        foreach ($r as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $age_count = $count_item['age_count'];
            if ($total_count) {
                $average_age = ($age_count / $total_count);
            }

            $r[$city_name] = $average_age;
        }

        // 平均年齢の高い順に並べ替える
        arsort($r);

        // 上位3件を取得
        $actual = array_slice($r, 0, 3);
        // dump($actual);
        // /QUIZ
        $this->assertTrue(true);
    }




    // 上級課題4
    // 男性と女性の平均年齢差を算出してみよう
    public function test_390_100_average_age_by_gender(): void
    {
        // QUIZ
        //データ出力設定
        $want_abs  = 0; //(1：絶対値で返す(男女どちらが高いかを出さずに純粋な差分で表示) ※下の設定に問わず差分が大きい順に3つ表示, その他（数字に限る）：下記の条件に沿って出力)
        $want_data = 1; //(1：男性基準, その他（数字に限る）：女性基準　※値が大きいほど指定した性別の平均年齢が、もう一方の性別よりも高いことを意味する)
        $data_type = 1; //(1：上位3件, その他（数字に限る）：全て)
        
		// 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}{$item['地区']}{$item['大字']}";

            $man_total_count = $r[$town_name]['man_total_count'] ?? 0;
            $r[$town_name]['man_total_count'] = $man_total_count + intval($item['男性']);
            $woman_total_count = $r[$town_name]['woman_total_count'] ?? 0;
            $r[$town_name]['woman_total_count'] = $woman_total_count + intval($item['女性']);

            if ($item['年齢'] >= 0) {
                $man_age_count = $r[$town_name]['man_age_count'] ?? 0;
                $r[$town_name]['man_age_count'] = $man_age_count + (intval($item['男性'] * intval($item['年齢'])));
                $woman_age_count = $r[$town_name]['woman_age_count'] ?? 0;
                $r[$town_name]['woman_age_count'] = $woman_age_count + (intval($item['女性'] * intval($item['年齢'])));
            }
        }

        // 要素分解 中間配列から各町の男性と女性の各人数と、年齢＊各性別の総和をもとにそれぞれの平均年齢を計算し、最後に男性と女性の平均年齢差を算出する（）
        foreach ($r as $city_name => $count_item) {
            $man_total_count = $count_item['man_total_count'];
            $woman_total_count = $count_item['woman_total_count'];
            $man_age_count = $count_item['man_age_count'];
            $woman_age_count = $count_item['woman_age_count'];
            if ($man_total_count) {
                $man_average_age = ($man_age_count / $man_total_count);
            }
            if ($woman_total_count) {
                $woman_average_age = ($woman_age_count / $woman_total_count);
            }

            if($want_data ==1){ //指定された性別を基準にして平均年齢差の算出
                $man_woman_average_gap = $man_average_age - $woman_average_age;
            }else{
                $man_woman_average_gap = $woman_average_age - $man_average_age;
            }

            if($want_abs == 1){ //絶対値基準なら
                $r[$city_name] = abs($man_woman_average_gap);
            }else{
                $r[$city_name] = $man_woman_average_gap;
            }
        }

        if($want_abs == 1){
            arsort($r);
            // 上位3件を取得
            $actual = array_slice($r, 0, 3);
            // 表示
            // dump($actual);
        }else{
            // 平均年齢差の高い順に並べ替える
            arsort($r);
            if($data_type == 1){
                // 上位3件を取得
                $actual = array_slice($r, 0, 3);
                // 表示
                // dump($actual);
            }else{
                // dump($r);
            } 
        }
        // /QUIZ
        $this->assertTrue(true);
    }

    // 上級課題5
    // 中央区、浜名区、天竜区の平均年齢を算出する
    public function test_400_110_average_age_by_ward(): void
    {
        // QUIZ
		// 元データを読み込む
        $filename = 'tests/Unit/data/populations_utf8.csv'; // ←これはファイルサイズが大きいので、_small でもよい。
        //$filename = 'tests/Unit/data/populations_small_utf8.csv';
        $contents = file_get_contents($filename);
        if (! $contents) {
            echo "{$filename} を読み込めません。";
        }

		// 要素分解 ファイルから各項目を読んで取得する
        $lines = explode("\n", $contents);
        $col_names = [];
        $actual = []; // 2次元配列。
        foreach ($lines as $no => $line) {
            if (! $line) {
                continue;
            }
            $line = trim($line);
            $cols = explode(',', $line);

            if ($no == 0) {
                $col_names = $cols;
                continue;
            }

            $item = [];
            foreach ($col_names as $x => $col_name) {
                $item[$col_name] = $cols[$x] ?? '';
            }
            $actual[] = $item;
        }
        $r = [];
        foreach ($actual as $item) {
            $town_name = "{$item['市区町村名']}{$item['区']}";
            

            $total_count = $r[$town_name]['total_count'] ?? 0;
            $r[$town_name]['total_count'] = $total_count + intval($item['合計']);

            if ($item['年齢'] >= 0) {
                $age_count = $r[$town_name]['age_count'] ?? 0;
                $r[$town_name]['age_count'] = $age_count + (intval($item['合計'] * intval($item['年齢'])));
            }
        }
        // 要素分解 中間配列１から各区の人数と年齢＊人数の総和を読んで、平均年齢を計算する
        foreach ($r as $city_name => $count_item) {
            $total_count = $count_item['total_count'];
            $age_count = $count_item['age_count'];
            if ($total_count) {
                $average_age = ($age_count / $total_count);
            }

            $r[$city_name] = $average_age;
        }

        // 平均年齢の高い順に並べ替える
        arsort($r);
        // 上位3件を取得
        $actual = array_slice($r, 0, 3);
        // dump($actual);
        // /QUIZ

        $this->assertTrue(true);
    }
}
