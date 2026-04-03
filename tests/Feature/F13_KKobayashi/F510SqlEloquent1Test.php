<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Animal;
use App\Models\Owner;

class F510SqlEloquent1Test extends TestCase
{
    // insert
    public function test_510_010_sql_insert_1(): void
    {
        // 動物テーブルのデータをすべて削除する
        // DB::delete('delete from animals');
        Animal::query()->forceDelete();

        // やぎを追加する ← ★★★注目
        // DB::insert('insert into animals (id, name) values (?, ?)', [1, 'やぎ']);
        Animal::create([
            'id' => 1,
            'name' => 'やぎ',
        ]);

        // nameをid順で取得する
        // $animals = DB::select('
        //    select name
        //      from animals
        // ');
        $animals = Animal::query()->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // nameをid順で取得する
        // $animals = DB::select('
        //   select name
        //     from animals
        //    order by id
        // ');
        $animals = Animal::query()
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // nameをidの逆順で取得する　(order by id desc ← ★★★注目)
        $animals = Animal::query()
            ->orderBy('id', 'desc')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // 動物テーブルのデータをすべて削除する ← ★★★注目
        Animal::query()->delete();

        // nameを取得する
        $animals = Animal::query()
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $names = [];
        foreach ($animals as $animal) {
            $names[] = $animal->name;
        }


        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->id},{$animal->name}";
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->where('id', '>', 1)
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->where('name', 'やぎ')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->where('id', '>', 1)
            ->where('id', '<', 3)
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->where('id', 1)
            ->orWhere('name', 'ひつじ')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->whereNull('type')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->whereNotNull('type')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // nameをid順で取得する (★where type is not null に注目)
        $animals = Animal::query()
            ->select('name')
            ->where('name', 'like', 'や%')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->where('name', 'like', '%に')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('name')
            ->where('name', 'like', '%さ%')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->limit(2)
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->limit(2)
            ->offset(2)
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $count = Animal::query()->count();

        // 件数
        // QUIZ
		$expected = null;
        // /QUIZ

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
        $sum = Animal::query()->sum('weight');

        // sum(weight)
        // QUIZ
		$expected = null;
        // /QUIZ

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

        // ★★★ average に注目
        $speed = Animal::query()->average('speed');
        $speed = intval($speed);

        // avg(speed)
        // QUIZ
		$expected = null;
        // /QUIZ

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
        $speed = Animal::query()->max('speed');

        // max(speed)
        // QUIZ
		$expected = null;
        // /QUIZ

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

        // ★★★ min に注目
        $speed = Animal::query()->min('speed');

        // min(speed)
        // QUIZ
		$expected = null;
        // /QUIZ

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
        // QUIZ
		$expected = null;
        // /QUIZ

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

        // ★★★ group by type に注目
        $animals = Animal::query()
            ->selectRaw('type, sum(weight) as weight_sum')
            ->groupBy('type')
            ->orderBy('type')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->type}x{$animal->weight_sum}kg";
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animals = Animal::query()
            ->select('type')
            ->distinct('type')
            ->orderBy('type')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->type;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        $animal = Animal::where('id', 1)->update(['name' => 'やぎぴょん']);
        $animal = Animal::where('id', 2)->update(['name' => 'うさぎぴょん']);
        $animal = Animal::where('id', 3)->update(['name' => 'ひつじぴょん']);

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // $updates のデータそれぞれについて、 id カラムで検索し、name カラムを更新する。
        $animal = Animal::upsert($updates, ['id'], ['name']);

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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
        Animal::query()->update(['type' => '哺乳類']);

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

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $animals = Animal::query()
            ->whereIn('id', [1, 3])
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

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $animals = Animal::query()
            ->join('owners', 'animals.owner_id', 'owners.id')
            ->select(
                'animals.name as animals_name',
                'owners.name as owners_name'
            )
            ->orderBy('animals.id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->animals_name}の飼い主は{$animal->owners_name}さんです";
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        // App\Models\Animal.php の owner 関数に注目
        $animals = Animal::query()
            ->with('owner')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $owner_name = $animal?->owner?->name;
            if ($owner_name) {
                $actual[] = "{$animal->name}の飼い主は{$owner_name}さんです";
            }
        }

        // QUIZ
		$expected = null;
        // /QUIZ

        $this->assertSame($expected, $actual);
    }

    public function test_510_170_select_outer_join(): void
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

        $animals = Animal::query()
            ->leftJoin('owners', 'animals.owner_id', 'owners.id')
            ->select(
                'animals.name as animals_name',
                'owners.name as owners_name'
            )
            ->orderBy('animals.id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->animals_name}の飼い主は{$animal->owners_name}さんです";
        }

        // QUIZ
		$expected = null;
        // /QUIZ

        $this->assertSame($expected, $actual);
    }

    public function test_510_175_select_outer_join(): void
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

        $animals = Animal::query()
            ->with('owner')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = "{$animal->name}の飼い主は{$animal?->owner?->name}さんです";
        }

        // QUIZ
		$expected = null;
        // /QUIZ

        $this->assertSame($expected, $actual);
    }

    public function test_510_180_transaction_rollback(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // トランザクション開始
        DB::beginTransaction();

        // 値を更新する
        Animal::query()->where('id', 1)->update(['name' => 'やぎぴょん']);
        Animal::query()->where('id', 2)->update(['name' => 'うさぎぴょん']);

        DB::rollBack();

        Animal::query()->where('id', 3)->update(['name' => 'ひつじぴょん']);

        $animals = Animal::query()
            ->select('name')
            ->orderBy('id')
            ->get();

        // 取得結果をforeachで回して、nameを配列に追加する
        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

        $this->assertSame($expected, $actual);
    }

    public function test_510_190_transaction_commit(): void
    {
        // 動物テーブルのデータをすべて削除する
        Animal::query()->forceDelete();

        // 値を登録する
        Animal::insert([
            ['id' => 1, 'name' => 'やぎ'],
            ['id' => 2, 'name' => 'うさぎ'],
            ['id' => 3, 'name' => 'ひつじ'],
        ]);

        // トランザクション開始
        DB::beginTransaction();

        // 値を更新する
        Animal::query()->where('id', 1)->update(['name' => 'やぎぴょん']);
        Animal::query()->where('id', 2)->update(['name' => 'うさぎぴょん']);
        Animal::query()->where('id', 3)->update(['name' => 'ひつじぴょん']);

        DB::commit();

        $animals = Animal::query()
            ->orderBy('id')
            ->get();

        $actual = [];
        foreach ($animals as $animal) {
            $actual[] = $animal->name;
        }

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $actual = Animal::query()
            ->orderBy('id')
            ->pluck('name')
            ->toArray();

        // QUIZ
		$expected = null;
        // /QUIZ

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

        $actual = Animal::query()
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        // QUIZ
		$expected = null;
        // /QUIZ

        $this->assertSame($expected, $actual);
    }
}
