<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class F500SqlRaw2 extends TestCase
{
    // insert
    public function test_500_010_sql_insert_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        $animals = ''; // TODO: animals テーブルに id = 1, name = 'やぎ' を登録する
        // QUIZ
        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        // /QUIZ

        $animals = DB::select('
           select name
             from animals
        ');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = [
            'やぎ'
        ];

        $this->assertSame($expected, $names);
    }

    // insert x 3 & order by id
    public function test_500_020_sql_insert_3(): void
    {
        // 動物テーブルのデータをすべて削除する
        DB::delete('delete from animals');

        DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);

        $animals = ''; // TODO: animals テーブルから name を id 順に取得する
        // QUIZ
        $animals = DB::select('
          select name
            from animals
           order by id
        ');
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'うさぎ',
            'ひつじ'
        ];

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

        $animals = ''; // TODO: animals テーブルから nameカラムを id の 逆順で取得する
        // QUIZ
        $animals = DB::select('
           select name
             from animals
            order by id desc
        ');
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        $expected = [
            'ひつじ',
            'うさぎ',
            'やぎ'
        ];

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

        $animals = ''; // TODO: animals テーブルの全件を削除する
        // QUIZ
        DB::delete('
          delete from animals
        ');
        // /QUIZ

        // nameを取得する
        $animals = DB::select('
          select name
            from animals
           order by id
        ');

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

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

        $animals = ''; // TODO: animals から id と name カラムを id順に取得する
        // QUIZ
        $animals = DB::select('
           select id, name
             from animals
            order by id
        ');
        // /QUIZ


        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->id},{$animal->name}";
        }

        $expected = [
            '1,やぎ',
            '2,うさぎ',
            '3,ひつじ'
        ];

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

        $animals = ''; // TODO: animals から id が 1より大きいレコードの name カラムを id順に取得する: 
        // QUIZ
        $animals = DB::select('
          select name
            from animals
           where id > 1
           order by id
        ');
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'うさぎ',
            'ひつじ'
        ];

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
        $animals = ''; // TODO: animals から name が 'やぎ' に等しいレコードの name カラムを id順に取得する: 
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           where name = 'やぎ'
           order by id
        ");
        // /QUIZ


        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ'
        ];

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

        $animals = ''; // TODO: animals から id が 1より大きく、かつ、id が 3より小さいレコードの name カラムを取得する。
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           where id > 1
             and id < 3
        ");
        // /QUIZ


        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'うさぎ'
        ];

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

        $animals = ''; // TODO: animals から id が 1と等しい、 または name が ひつじと等しい レコードの name カラムを id順に取得する: : 
        // QUIZ
        $animals = DB::select("
           select name
             from animals
            where id = 1 or name = 'ひつじ'
            order by id
        ");
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'ひつじ'
        ];

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
        DB::insert('insert into animals (id, name, type) values (?, ?, ?)', [3, 'とり', null]);

        // nameをid順で取得する (★where type is null に注目)
        $animals = ''; // TODO: animals から type が null と等しいレコードの name カラムを取得する
        // QUIZ
        $animals = DB::select("
           select name
             from animals
            where type is null");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'とり'
        ];

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
        $animals = ''; // TODO: animals から type が null と等しくないレコードの name カラムを id の逆順で取得する
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           where type is not null
           order by id
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'うさぎ'
        ];

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

        $animals = ''; // TODO: animals から name が や で始まるレコードの name カラムを id の昇順で取得する
        // QUIZ
        $animals = DB::select("
           select name
             from animals
            where name like 'や%'
            order by id
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'やっくる',
            'やんばるくいな'
        ];

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
        $animals = ''; // TODO: animals から name が に で終わりレコードの name カラムを id の昇順で取得する
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           where name like '%に'
           order by id
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'かに',
            'わに',
            'うに'
        ];

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
        $animals = ''; // TODO: animals から name 中に さ を含むレコードの name カラムを id の昇順で取得する
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           where name like '%さ%'
           order by id
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'うさぎ',
            'かささぎ',
            'さる',
            'あさ'
        ];

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
        $animals = ''; // TODO: animals id の昇順でレコードを２件だけ取得する
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           order by id
           limit 2
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'うさぎ'
        ];

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
        $animals = ''; // TODO: animals id の昇順で、先頭から２件とばして、レコードを２件だけ取得する
        // QUIZ
        $animals = DB::select("
          select name
            from animals
           order by id
           limit 2
           offset 2
        ");
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'ひつじ',
            'はと'
        ];

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
        $count = ''; // TODO: animals の件数を取得する
        // QUIZ
        $count = DB::scalar("
          select count(*)
            from animals
        ");
        // /QUIZ        

        // 件数
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
        $sum = ''; // TODO: animals 全レコードの weight カラムの合計を取得する
        // QUIZ
        $sum = DB::scalar("
          select sum(weight)
            from animals
        ");
        // /QUIZ        

        // sum(weight)
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

        $speed = ''; // TODO: animals 全レコードの speed カラムの平均を取得する
        // QUIZ
        $speed = DB::scalar("
          select avg(speed)
            from animals
        ");
        // /QUIZ        
        $speed = intval($speed);

        // avg(speed)
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
        $speed = ''; // TODO: animals 全レコードの speed カラムの最大値を取得する
        // QUIZ
        $speed = DB::scalar("
          select max(speed)
            from animals
        ");
        // /QUIZ        

        // max(speed)
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

        $speed = ''; // TODO: animals 全レコードの speed カラムの最小値を取得する
        // QUIZ
        $speed = DB::scalar("
          select min(speed)
            from animals
        ");
        // /QUIZ        

        // min(speed)
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

        $animals = ''; // TODO: animals レコードの タイプ別に 件数を取得する
        // QUIZ
        $animals = DB::select("
           select type, count(*) as cnt
             from animals
            group by type
            order by type
        ");
        // /QUIZ        

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->type}x{$animal->cnt}種類";
        }

        // 
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

        $animals = ''; // TODO: animals レコードの タイプ別の 重さの合計値を取得する

        // QUIZ
        $animals = DB::select("
          select type, sum(weight) as weight_sum
            from animals
           group by type
           order by type
        ");
        // /QUIZ        

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

        $animals = ''; // TODO: animals レコードの タイプを一位にして返す
        // QUIZ
        $animals = DB::select("
           select distinct type
             from animals
            order by type
        ");
        // /QUIZ        

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

        // TODO: 値を更新する
        // id = 1  name = 'やぎぴょん'
        // id = 2  name = 'うさぎぴょん'
        // id = 3  name = 'ひつじぴょん'

        // QUIZ
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);
        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);
        // /QUIZ        

        // nameをid順で取得する
        $animals = DB::select("
          select name
            from animals
           order by id
        ");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎぴょん',
            'うさぎぴょん',
            'ひつじぴょん'
        ];

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


        $animals = ''; // TODO: 全てのレコードの type を 哺乳類 にする
        // QUIZ
        DB::update("update animals set type = '哺乳類'");
        // /QUIZ        

        // nameをid順で取得する
        $animals = DB::select("
           select name, type
             from animals
            order by id
        ");

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

        // 値を更新する(whereをつけたことに注目)
        $animals = ''; // TODO: animals テーブルの id が 1 より大きいレコードの type を 哺乳類 に更新する
        // QUIZ
        DB::update("
          update animals
             set type = '哺乳類'
           where id > 1
        ");
        // /QUIZ        

        // nameをid順で取得する
        $animals = DB::select("
          select name, type
            from animals
           order by id
        ");

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

        // 値を更新する
        $animals = ''; // TODO: animals テーブルの id が 1 または 3 のレコードの type を 哺乳類 に更新する
        // QUIZ
        DB::update("
          update animals
             set type = '哺乳類'
           where id in (1, 3)
        ");
        // /QUIZ        

        // nameをid順で取得する
        $animals = DB::select("
           select name, type
             from animals
            order by id
        ");

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

        $animals = ''; // TODO: animals.name と owners.name を返す。(owners.name がある animals のみが表示される )
        // QUIZ
        $animals = DB::select("
            select animals.name as animals_name,
                   owners.name as owners_name 
              from animals
             inner join owners on animals.owner_id = owners.id
             order by animals.id
        ");
        // /QUIZ        

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

    public function test_500_175_select_outer_join(): void
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

        $animals = ''; // TODO: animals.name と owners.name を返す。(owners.name の有無にかかわらず すべての animals が表示される。)
        // QUIZ
        $animals = DB::select("
            select animals.name as animals_name,
                   owners.name as owners_name
              from animals
              left join owners on animals.owner_id = owners.id
             order by animals.id
        ");
        // /QUIZ        

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
        $animals = ''; // TODO: トランザクションを開始する
        // QUIZ
        DB::beginTransaction();
        // /QUIZ        

        // 値を更新する
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);

        $animals = ''; // TODO: トランザクションをロールバックする
        // QUIZ
        DB::rollBack();
        // /QUIZ        

        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);


        // nameをid順で取得する
        $animals = DB::select("
          select name
            from animals
           order by id
        ");

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎ',
            'うさぎ',
            'ひつじぴょん'
        ];

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
        $animals = ''; // TODO: トランザクションを開始する
        // QUIZ
        DB::beginTransaction();
        // /QUIZ        

        // 値を更新する
        DB::update('update animals set name = ? where id = ?', ['やぎぴょん', 1]);
        DB::update('update animals set name = ? where id = ?', ['うさぎぴょん', 2]);
        DB::update('update animals set name = ? where id = ?', ['ひつじぴょん', 3]);

        $animals = ''; // TODO: トランザクションをコミットする
        // QUIZ
        DB::commit();
        // /QUIZ

        // nameをid順で取得する
        $animals = DB::select("
          select name
            from animals
           order by id
        ");

        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        $expected = [
            'やぎぴょん',
            'うさぎぴょん',
            'ひつじぴょん'
        ];

        $this->assertSame($expected, $actual);
    }        
}
