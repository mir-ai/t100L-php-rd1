<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Animal;
use App\Models\Owner;

class F510SqlEloquent2Test extends TestCase
{
    // insert
    public function test_510_010_sql_insert_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        // DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // TODO: animals テーブルに id = 1, name = 'やぎ' のレコードを登録する
        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()->get();

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
    public function test_510_020_sql_insert_3(): void
    {
        // 動物テーブルのデータをすべて削除する
        // DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // やぎとうさぎとひつじを登録する　 ← ★★★注目
        // DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        // DB::insert('insert into animals (id, name) values (?, ?)', [2, 'うさぎ']);
        // DB::insert('insert into animals (id, name) values (?, ?)', [3, 'ひつじ']);
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        $animals = ''; // TODO: animals テーブルから name を id 順に取得する
        // QUIZ
		$expected = null;
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
    public function test_510_030_sql_order_by_desc(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        $animals = ''; // TODO: animals テーブルから nameカラムを id の 逆順で取得する
        // QUIZ
		$expected = null;
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
    public function test_510_040_delete(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        $animals = ''; // TODO: animals テーブルの全件を削除する
        // QUIZ
		$expected = null;
        // /QUIZ

        // nameを取得する
        $animals = Animal::query()
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }


        $expected = [];

        // whereをつけないで delete をすると、全件消えてしまうことに注意。

        $this->assertSame($expected, $names);
    }

    // select (複数カラムを取得)
    public function test_510_050_select_multi_columns(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★idとnameを取得していることに注目)
        $animals = ''; // TODO: animals から id と name カラムを id順に取得する
        // QUIZ
		$expected = null;
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
    public function test_510_060_select_where(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = ''; // TODO: animals から id が 1より大きいレコードの name カラムを id順に取得する:
        // QUIZ
		$expected = null;
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
    public function test_510_070_select_where_match(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where name やぎに注目)
        $animals = ''; // TODO: animals から name が 'やぎ' に等しいレコードの name カラムを id順に取得する:
        // QUIZ
		$expected = null;
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
    public function test_510_071_select_where_and(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = ''; // TODO: animals から id が 1より大きく、かつ、id が 3より小さいレコードの name カラムを取得する。
        // QUIZ
		$expected = null;
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
    public function test_510_072_select_where_and(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where id > 1に注目)
        $animals = ''; // TODO: animals から id が 1と等しい、 または name が ひつじと等しい レコードの name カラムを id順に取得する: :
        // QUIZ
		$expected = null;
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
    public function test_510_073_select_where_null(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'type' => '四足'],
            ['id' => 2, 'name' => 'うさぎ', 'type' => '四足'],
            ['id' => 3, 'name' => 'とり', 'type' => null],
        ]);

        // nameをid順で取得する (★where type is null に注目)
        $animals = ''; // TODO: animals から type が null と等しいレコードの name カラムを取得する
        // QUIZ
		$expected = null;
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
    public function test_510_074_select_where_not_null(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'type' => '四足'],
            ['id' => 2, 'name' => 'うさぎ', 'type' => '四足'],
            ['id' => 3, 'name' => 'とり', 'type' => null],
        ]);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = ''; // TODO: animals から type が null と等しくないレコードの name カラムを id の逆順で取得する
        // QUIZ
		$expected = null;
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
    public function test_510_074_select_where_like_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'やっくる'],
            ['id' => 3, 'name' => 'やんばるくいな'],
            ['id' => 4, 'name' => 'ひつじ'],
            ['id' => 5, 'name' => 'うさぎ'],
        ]);


        $animals = ''; // TODO: animals から name が や で始まるレコードの name カラムを id の昇順で取得する
        // QUIZ
		$expected = null;
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
    public function test_510_074_select_where_like_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'かに'],
            ['id' => 2, 'name' => 'わに'],
            ['id' => 3, 'name' => 'うに'],
            ['id' => 4, 'name' => 'うさぎ'],
        ]);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = ''; // TODO: animals から name が に で終わりレコードの name カラムを id の昇順で取得する
        // QUIZ
		$expected = null;
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
    public function test_510_075_select_where_like_3(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'うさぎ'],
            ['id' => 2, 'name' => 'かささぎ'],
            ['id' => 3, 'name' => 'さる'],
            ['id' => 4, 'name' => 'あさ'],
            ['id' => 5, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where type is not null に注目)
        $animals = ''; // TODO: animals から name 中に さ を含むレコードの name カラムを id の昇順で取得する
        // QUIZ
		$expected = null;
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
    public function test_510_076_select_limit_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
            ['id' => 4, 'name' => 'はと'],
            ['id' => 5, 'name' => 'すずめ'],
        ]);

        $animals = ''; // TODO: animals id の昇順でレコードを２件だけ取得する
        // QUIZ
		$expected = null;
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
    public function test_510_076_select_offset_2(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
            ['id' => 4, 'name' => 'はと'],
            ['id' => 5, 'name' => 'すずめ'],
        ]);

        $animals = ''; // TODO: animals id の昇順で、先頭から２件とばして、レコードを２件だけ取得する
        // QUIZ
		$expected = null;
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
    public function test_510_080_select_count(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // nameをid順で取得する (★where id > 1に注目)
        $count = ''; // TODO: animals の件数を取得する
        // QUIZ
		$expected = null;
        // /QUIZ

        // 件数
        $expected = 3;


        $this->assertSame($expected, $count);
    }

    // select (sum)
    public function test_510_090_select_sum(): void
    {
        // 動物テーブルのデータをすべて削除する
        //DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'weight' => 2],
            ['id' => 2, 'name' => 'うさぎ', 'weight' => 3],
            ['id' => 3, 'name' => 'ひつじ', 'weight' => 1],
        ]);

        // ★★★ sum に注目
        $sum = ''; // TODO: animals 全レコードの weight カラムの合計を取得する
        // QUIZ
		$expected = null;
        // /QUIZ

        // sum(weight)
        $expected = 6.0;

        $this->assertSame($expected, $sum);
    }

    // select (average)
    public function test_510_100_select_average(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'speed' => 10],
            ['id' => 2, 'name' => 'うさぎ', 'speed' => 15],
            ['id' => 3, 'name' => 'ひつじ', 'speed' => 5],
        ]);

        $speed = ''; // TODO: animals 全レコードの speed カラムの平均を取得する
        // QUIZ
		$expected = null;
        // /QUIZ
        $speed = intval($speed);

        // avg(speed)
        $expected = 10;

        $this->assertSame($expected, $speed);
    }

    // select (average)
    public function test_510_101_select_max(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'speed' => 10],
            ['id' => 2, 'name' => 'うさぎ', 'speed' => 15],
            ['id' => 3, 'name' => 'ひつじ', 'speed' => 5],
        ]);

        // ★★★ max に注目
        $speed = ''; // TODO: animals 全レコードの speed カラムの最大値を取得する
        // QUIZ
		$expected = null;
        // /QUIZ


        // max(speed)
        $expected = 15;

        $this->assertSame($expected, $speed);
    }

    // select (average)
    public function test_510_102_select_min(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'speed' => 10],
            ['id' => 2, 'name' => 'うさぎ', 'speed' => 15],
            ['id' => 3, 'name' => 'ひつじ', 'speed' => 5],
        ]);

        $speed = ''; // TODO: animals 全レコードの speed カラムの最小値を取得する
        // QUIZ
		$expected = null;
        // /QUIZ

        // min(speed)
        $expected = 5;

        $this->assertSame($expected, $speed);
    }

    // group by count
    public function test_510_110_select_group_by_count(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ'],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ'],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ'],
            ['id' => 4, 'type' => '二足', 'name' => 'はと'],
        ]);

        // ★★★ group by type に注目
        $animals = ''; // TODO: animals レコードの タイプ別に 件数を取得する
        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()
            ->selectRaw('type, count(*) as cnt')
            ->groupBy('type')
            ->orderBy('type')
            ->get();

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
    public function test_510_120_select_group_by_weight(): void
    {
        // 動物テーブルのデータをすべて削除する
        //DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ', 'weight' => 3],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ', 'weight' => 4],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ', 'weight' => 2],
            ['id' => 4, 'type' => '二足', 'name' => 'はと', 'weight' => 1],
        ]);

        $animals = ''; // TODO: animals レコードの タイプ別の 重さの合計値を取得する
        // QUIZ
		$expected = null;
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
    public function test_510_125_select_distinct(): void
    {
        // 動物テーブルのデータをすべて削除する
        //DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ'],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ'],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ'],
            ['id' => 4, 'type' => '二足', 'name' => 'はと'],
        ]);

        // ★★★ distinct に注目
        $animals = ''; // TODO: animals レコードの タイプを一位にして返す
        // QUIZ
		$expected = null;
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

    public function test_510_130_update_names(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // 値を更新する
        $animals = ''; // TODO: 値を更新する
        // id = 1  name = 'やぎぴょん'
        // id = 2  name = 'うさぎぴょん'
        // id = 3  name = 'ひつじぴょん'

        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->get();

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

    public function test_510_135_upsert(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // 値を更新する
        $updates = [
            ['id' => 1, 'name' => 'やぎぴょん'],
            ['id' => 2, 'name' => 'うさぎぴょん'],
            ['id' => 3, 'name' => 'ひつじぴょん'],
        ];

        $animals = ''; // TODO: TODO: 値を更新する
        // id = 1  name = 'やぎぴょん'
        // id = 2  name = 'うさぎぴょん'
        // id = 3  name = 'ひつじぴょん'
        // $updates のデータそれぞれについて、 id カラムで検索し、name カラムを更新する。

        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->get();

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

    public function test_510_140_update_types_all(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ'],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ'],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ'],
        ]);

        // 値を更新する(whereをつけないことに注目)
        $animals = ''; // TODO: 全てのレコードの type を 哺乳類 にする
        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()
            ->select('name', 'type')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}は{$animal->type}です";
        }

        // ★ UPDATEにwhereをつけないと、全件更新してしまうことに注意。
        // これまでにたくさんのエンジニアが、本番DBでwhereをつけわすれて全件更新し、事故ったことと思います。。。

        $expected = [
            'やぎは哺乳類です',
            'うさぎは哺乳類です',
            'ひつじは哺乳類です'
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_510_150_update_types_where_gt(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ'],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ'],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ'],
        ]);

        $animals = ''; // TODO: animals テーブルの id が 1 より大きいレコードの type を 哺乳類 に更新する
        // QUIZ
		$expected = null;
        // /QUIZ
        Animal::query()
            ->where('id', '>', 1)
            ->update([
                'type' => '哺乳類'
            ]);

        $animals = Animal::query()
            ->select('name', 'type')
            ->orderBy('id')
            ->get();

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

    public function test_510_160_update_types_where_in(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'type' => '四足', 'name' => 'やぎ'],
            ['id' => 2, 'type' => '四足', 'name' => 'うさぎ'],
            ['id' => 3, 'type' => '四足', 'name' => 'ひつじ'],
        ]);

        $animals = ''; // TODO: animals テーブルの id が 1 または 3 のレコードの type を 哺乳類 に更新する
        // QUIZ
		$expected = null;
        // /QUIZ

        $animals = Animal::query()
            ->select('name', 'type')
            ->orderBy('id')
            ->get();

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

    public function test_510_170_select_inner_join(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 飼い主テーブルのデータをすべて削除する
        Owner::query()->forceDelete();

        // 飼い主を登録する
        Owner::insert([
            ['id' => 1, 'name' => 'たろう'],
            ['id' => 2, 'name' => 'はなこ'],
        ]);

        // 動物を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'owner_id' => 1],
            ['id' => 2, 'name' => 'うさぎ', 'owner_id' => 2],
            ['id' => 3, 'name' => 'ひつじ', 'owner_id' => 2],
            ['id' => 4, 'name' => 'とら', 'owner_id' => null],
        ]);

        $animals = ''; // TODO: join を使って animals.name と owners.name を取得する
        // QUIZ
		$expected = null;
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

    public function test_510_175_select_inner_join_with(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 飼い主テーブルのデータをすべて削除する
        Owner::query()->forceDelete();

        // 飼い主を登録する
        Owner::insert([
            ['id' => 1, 'name' => 'たろう'],
            ['id' => 2, 'name' => 'はなこ'],
        ]);

        // 動物を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'owner_id' => 1],
            ['id' => 2, 'name' => 'うさぎ', 'owner_id' => 2],
            ['id' => 3, 'name' => 'ひつじ', 'owner_id' => 2],
            ['id' => 4, 'name' => 'とら', 'owner_id' => null],
        ]);

        $animals = ''; // TODO: with を使って Animal と owner のレコードを取得する
        // QUIZ
		$expected = null;
        // /QUIZ


        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $owner_name = $animal?->owner?->name;
            if ($owner_name) {
                $actual[] = "{$animal->name}の飼い主は{$owner_name}さんです";
            }
        }

        $expected = [
            'やぎの飼い主はたろうさんです',
            'うさぎの飼い主ははなこさんです',
            'ひつじの飼い主ははなこさんです',
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_510_176_select_outer_join(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 飼い主テーブルのデータをすべて削除する
        Owner::query()->forceDelete();

        // 飼い主を登録する
        Owner::insert([
            ['id' => 1, 'name' => 'たろう'],
            ['id' => 2, 'name' => 'はなこ'],
        ]);

        // 動物を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'owner_id' => 1],
            ['id' => 2, 'name' => 'うさぎ', 'owner_id' => 2],
            ['id' => 3, 'name' => 'ひつじ', 'owner_id' => 2],
            ['id' => 4, 'name' => 'とら', 'owner_id' => null],
        ]);

        $animals = ''; // TODO: left join を使って animals.name と owners.name を取得する
        // QUIZ
		$expected = null;
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

    public function test_510_177_select_outer_join(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 飼い主テーブルのデータをすべて削除する
        Owner::query()->forceDelete();

        // 飼い主を登録する
        Owner::insert([
            ['id' => 1, 'name' => 'たろう'],
            ['id' => 2, 'name' => 'はなこ'],
        ]);

        // 動物を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ', 'owner_id' => 1],
            ['id' => 2, 'name' => 'うさぎ', 'owner_id' => 2],
            ['id' => 3, 'name' => 'ひつじ', 'owner_id' => 2],
            ['id' => 4, 'name' => 'とら', 'owner_id' => null],
        ]);

        $animals = ''; // TODO: with を使って Animalクラスと、それに紐づく ownerの情報を取得する
        // QUIZ
		$expected = null;
        // /QUIZ

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}の飼い主は{$animal?->owner?->name}さんです";
        }

        $expected = [
            'やぎの飼い主はたろうさんです',
            'うさぎの飼い主ははなこさんです',
            'ひつじの飼い主ははなこさんです',
            'とらの飼い主はさんです',
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_510_200_pluck(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        $actual = []; // TODO: Animalクラスから、 pluck と toArrayを使って expected と同じ配列を作る
        // QUIZ
		$expected = null;
        // /QUIZ

        $expected = [
            'やぎ',
            'うさぎ',
            'ひつじ'
        ];

        $this->assertSame($expected, $actual);
    }

    public function test_510_210_pluck2(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        $actual = []; // TODO: Animalクラスから、 pluck と toArrayを使って expected と同じ配列を作る
        // QUIZ
		$expected = null;
        // /QUIZ


        $expected = [
            1 => 'やぎ',
            2 => 'うさぎ',
            3 => 'ひつじ'
        ];

        $this->assertSame($expected, $actual);
    }
}
