<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class F500SqlBasic extends TestCase
{
    // insert
    public function test_500_010_sql_insert_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // やぎを追加する ← ★★★注目
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);

        // nameをid順で取得する
        $animals = DB::select('select name from animals');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = ['やぎ'];

        $this->assertSame($expected, $names);
    }

    // insert x 3 & order by id
    public function test_500_020_sql_insert_3(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // やぎとうさぎとひつじを登録する　 ← ★★★注目
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する
        $animals = DB::select('select name from animals order by id');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = ['やぎ', 'うさぎ', 'ひつじ'];

        $this->assertSame($expected, $names);
    }

    // order by desc
    public function test_500_030_sql_order_by_desc(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをidの逆順で取得する　(order by id desc ← ★★★注目)
        $animals = DB::select('select name from animals order by id desc');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = ['ひつじ', 'うさぎ', 'やぎ'];

        $this->assertSame($expected, $names);
    }

    // delete
    public function test_500_040_delete(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // 動物テーブルのデータをすべて削除する ← ★★★注目
        DB::delete('delete from animals');

        // nameを取得する
        $animals = DB::select('select name from animals order by id');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        // 結果はナシになる
        $expected = [];

        $this->assertSame($expected, $names);
    }

    // select (複数カラムを取得)
    public function test_500_050_select_multi_columns(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★idとnameを取得していることに注目)
        $animals = DB::select('select id, name from animals order by id');

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->id}★{$animal->name}";
        }

        $expected = ['1★やぎ', '2★うさぎ', '3★ひつじ'];

        $this->assertSame($expected, $actual);
    }

    // select (where)
    public function test_500_060_select_where(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = DB::select('select name from animals where id > 1 order by id');

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['うさぎ', 'ひつじ'];

        $this->assertSame($expected, $actual);
    }

    // select (where)
    public function test_500_070_select_where_match(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = DB::select("select name from animals where name = 'やぎ' order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ'];

        $this->assertSame($expected, $actual);
    }

    // select (where and)
    public function test_500_071_select_where_and(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = DB::select("select name from animals where id > 1 and id < 3");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['うさぎ'];

        $this->assertSame($expected, $actual);
    }

    // select (where or)
    public function test_500_072_select_where_and(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = DB::select("select name from animals where id = 1 or name = 'ひつじ' order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ', 'ひつじ'];

        $this->assertSame($expected, $actual);
    }

    // select (where null)
    public function test_500_073_select_where_null(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [1, 'やぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [2, 'うさぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'ひつじ', null]);

        // nameをid順で取得する (★where type is null に注目)
        $animals = DB::select("select name from animals where type is null");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['ひつじ'];

        $this->assertSame($expected, $actual);
    }

    // select (where not null)
    public function test_500_074_select_where_not_null(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [1, 'やぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [2, 'うさぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'ひつじ', null]);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals where type is not null order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ', 'うさぎ'];

        $this->assertSame($expected, $actual);
    }

    // select (where like)
    public function test_500_074_select_where_like_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'やっくる']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'やんばるくいな']);
        DB::insert('insert into animals (id, name) values (?, ?)', [4, 'ひつじ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [5, 'うさぎ']);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals where name like 'や%' order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ', 'やっくる', 'やんばるくいな'];

        $this->assertSame($expected, $actual);
    }

    // select (where like 2)
    public function test_500_074_select_where_like_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'かに']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'わに']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'うに']);
        DB::insert('insert into animals (id, name) values (?, ?)', [4, 'うさぎ']);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals where name like '%に' order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['かに', 'わに', 'うに'];

        $this->assertSame($expected, $actual);
    }

    // select (where like 2)
    public function test_500_075_select_where_like_3(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'かささぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'さる']);
        DB::insert('insert into animals (id, name) values (?, ?)', [4, 'あさ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [5, 'ひつじ']);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals where name like '%さ%' order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['うさぎ', 'かささぎ', 'さる', 'あさ'];

        $this->assertSame($expected, $actual);
    }

    // select (where limit 2)
    public function test_500_076_select_limit_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [4, 'はと']);
        DB::insert('insert into animals (id, name) values (?, ?)', [5, 'すずめ']);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals order by id limit 2");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ', 'うさぎ'];

        $this->assertSame($expected, $actual);
    }

    // select (where offset 2)
    public function test_500_076_select_offset_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [4, 'はと']);
        DB::insert('insert into animals (id, name) values (?, ?)', [5, 'すずめ']);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = DB::select("select name from animals order by id limit 2 offset 2");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['ひつじ', 'はと'];

        $this->assertSame($expected, $actual);
    }

    // select (count)
    public function test_500_080_select_count(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // nameをid順で取得する (★where id > 1に注目)
        $count = DB::scalar("select count(*) from animals");

        $expected = 3;

        $this->assertSame($expected, $count);
    }

    // select (sum)
    public function test_500_090_select_sum(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, weight) values (?, ?, ?)', [1, 'やぎ', 2]);
        DB::insert('insert into animals (id, name, weight) values (?, ?, ?)', [2, 'うさぎ', 3]);
        DB::insert('insert into animals (id, name, weight) values (?, ?, ?)', [3, 'ひつじ', 1]);

        // ★★★ sum に注目
        $sum = DB::scalar("select sum(weight) from animals");

        $expected = 6.0;

        $this->assertSame($expected, $sum);
    }

    // select (average)
    public function test_500_100_select_average(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [1, 'やぎ', 10]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [2, 'うさぎ', 15]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [3, 'ひつじ', 5]);

        // ★★★ average に注目
        $speed = DB::scalar("select avg(speed) from animals");
        $speed = intval($speed);

        $expected = 10;

        $this->assertSame($expected, $speed);
    }

    // select (average)
    public function test_500_101_select_max(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [1, 'やぎ', 10]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [2, 'うさぎ', 15]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [3, 'ひつじ', 5]);

        // ★★★ max に注目
        $speed = DB::scalar("select max(speed) from animals");

        $expected = 15;

        $this->assertSame($expected, $speed);
    }

    // select (average)
    public function test_500_102_select_min(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [1, 'やぎ', 10]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [2, 'うさぎ', 15]);
        DB::insert('insert into animals (id, name, speed) values (?, ?, ?)', [3, 'ひつじ', 5]);

        // ★★★ min に注目
        $speed = DB::scalar("select min(speed) from animals");

        $expected = 5;

        $this->assertSame($expected, $speed);
    }

    // group by count
    public function test_500_110_select_group_by_count(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [1, '四足', 'やぎ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [2, '四足', 'うさぎ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [3, '四足', 'ひつじ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [4, '二足', 'はと']);

        // ★★★ group by type に注目
        $animals = DB::select("select type, count(*) as cnt from animals group by type order by type");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->type}x{$animal->cnt}種類";
        }

        $expected = [
            '二足x1種類',
            '四足x3種類',
        ];

        $this->assertSame($expected, $actual);
    }

    // group by weight
    public function test_500_120_select_group_by_weight(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, type, name, weight) values (?, ?, ?, ?)', [1, '四足', 'やぎ',   3]);
        DB::insert('insert into animals (id, type, name, weight) values (?, ?, ?, ?)', [2, '四足', 'うさぎ', 4]);
        DB::insert('insert into animals (id, type, name, weight) values (?, ?, ?, ?)', [3, '四足', 'ひつじ', 2]);
        DB::insert('insert into animals (id, type, name, weight) values (?, ?, ?, ?)', [4, '二足', 'はと',  1]);

        // ★★★ group by type に注目
        $animals = DB::select("select type, sum(weight) as weight_sum from animals group by type order by type");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->type}x{$animal->weight_sum}kg";
        }

        $expected = [
            '二足x1kg',
            '四足x9kg',
        ];

        $this->assertSame($expected, $actual);
    }

    // group by count
    public function test_500_125_select_distinct(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [1, '四足', 'やぎ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [2, '四足', 'うさぎ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [3, '四足', 'ひつじ']);
        DB::insert('insert into animals (id, type, name) values (?, ?, ?)', [4, '二足', 'はと']);

        // ★★★ group by type に注目
        $animals = DB::select("select distinct type from animals order by type");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->type;
        }

        $expected = [
            '二足',
            '四足',
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_130_update_names(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // 値を更新する
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);
        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);

        // nameをid順で取得する
        $animals = DB::select("select name from animals order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎぴょん', 'うさぎぴょん', 'ひつじぴょん'];

        $this->assertSame($expected, $actual);
    }

    public function test_500_140_update_types_all(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [1, 'やぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [2, 'うさぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'ひつじ', '四足']);

        // 値を更新する(whereをつけないことに注目)
        DB::update("update animals set type = '哺乳類'");

        // nameをid順で取得する
        $animals = DB::select("select name, type from animals order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}は{$animal->type}です";
        }

        $expected = [
            'やぎは哺乳類です',
            'うさぎは哺乳類です',
            'ひつじは哺乳類です'
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_150_update_types_where_gt(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [1, 'やぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [2, 'うさぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'ひつじ', '四足']);

        // 値を更新する(whereをつけないことに注目)
        DB::update("update animals set type = '哺乳類' where id > 1");

        // nameをid順で取得する
        $animals = DB::select("select name, type from animals order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}は{$animal->type}です";
        }

        $expected = [
            'やぎは四足です',
            'うさぎは哺乳類です',
            'ひつじは哺乳類です'
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_160_update_types_where_in(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [1, 'やぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [2, 'うさぎ', '四足']);
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'ひつじ', '四足']);

        // 値を更新する(whereをつけないことに注目)
        DB::update("update animals set type = '哺乳類' where id in (1, 3)");

        // nameをid順で取得する
        $animals = DB::select("select name, type from animals order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}は{$animal->type}です";
        }

        $expected = [
            'やぎは哺乳類です',
            'うさぎは四足です',
            'ひつじは哺乳類です'
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_170_select_inner_join(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 飼い主テーブルのデータをすべて削除する
        DB::delete('delete from owners');

        // 飼い主を登録する
        DB::insert('insert into owners (id, name) values (?, ?)', [1, 'たろう']);
        DB::insert('insert into owners (id, name) values (?, ?)', [2, 'はなこ']);

        // 動物を登録する
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [1, 'やぎ', 1]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [2, 'うさぎ', 2]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [3, 'ひつじ', 2]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [4, 'とら', null]);

        $animals = DB::select(
            "select animals.name as animals_name," .
            "       owners.name as owners_name " .
            "  from animals" .
            " inner join owners on animals.owner_id = owners.id" .
            " order by animals.id"
        );

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->animals_name}の飼い主は{$animal->owners_name}さんです";
        }

        $expected = [
            'やぎの飼い主はたろうさんです',
            'うさぎの飼い主ははなこさんです',
            'ひつじの飼い主ははなこさんです',
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_170_select_outer_join(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 飼い主テーブルのデータをすべて削除する
        DB::delete('delete from owners');

        // 飼い主を登録する
        DB::insert('insert into owners (id, name) values (?, ?)', [1, 'たろう']);
        DB::insert('insert into owners (id, name) values (?, ?)', [2, 'はなこ']);

        // 動物を登録する
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [1, 'やぎ', 1]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [2, 'うさぎ', 2]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [3, 'ひつじ', 2]);
        DB::insert('insert into animals (id, name, owner_id) values (?, ?, ?)', [4, 'とら', null]);

        $animals = DB::select(
            "select animals.name as animals_name," .
            "       owners.name as owners_name " .
            "  from animals" .
            "  left join owners on animals.owner_id = owners.id" .
            " order by animals.id"
        );

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->animals_name}の飼い主は{$animal->owners_name}さんです";
        }

        $expected = [
            'やぎの飼い主はたろうさんです',
            'うさぎの飼い主ははなこさんです',
            'ひつじの飼い主ははなこさんです',
            'とらの飼い主はさんです',
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_500_180_transaction_rollback(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // トランザクション開始
        DB::beginTransaction();

        // 値を更新する
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);

        DB::rollBack();

        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);

        // nameをid順で取得する
        $animals = DB::select("select name from animals order by id");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎ', 'うさぎ', 'ひつじぴょん'];

        $this->assertSame($expected, $actual);
    }    

    public function test_500_190_transaction_commit(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        // 値を登録する
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        // トランザクション開始
        DB::beginTransaction();

        // 値を更新する
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);
        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);

        DB::commit();

        // nameをid順で取得する
        $animals = DB::select("select name from animals order by id");

        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = ['やぎぴょん', 'うさぎぴょん', 'ひつじぴょん'];

        $this->assertSame($expected, $actual);
    }        
}
