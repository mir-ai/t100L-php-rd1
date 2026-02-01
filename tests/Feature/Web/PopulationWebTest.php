<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\Population;
use App\Models\User;
use App\Models\MirSerializedVar;
use \Illuminate\Http\UploadedFile;
use Database\Seeders\TestUserTableSeeder;
use Illuminate\Support\Facades\Route;

/**
 * 人口 の登録、更新、一覧、詳細表示ページを http でアクセスしてエラーがないかを確認する。
 */
class PopulationWebTest extends TestCase
{
    private $user;

    private string $string_column = 'description';

    protected array $seeders = [
        TestUserTableSeeder::class,
        \Database\Seeders\PopulationTableSeeder::class
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    // ダミーのユーザー情報作成(または更新)
    public function test_create_user()
    {
        Population::query()->forceDelete();
        $this->seed($this->seeders);

        $this->assertTrue(true);
    }

    // 登録画面
    public function test_population_create()
    {
        if (Route::has('r4.populations.create')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          Population::where($this->string_column, 'UNITTEST')->forceDelete();
          $response = $this->actingAs($user)->call('GET', route('r4.populations.create'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 登録処理
    public function test_population_store()
    {
        if (Route::has('r4.populations.store')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          // TODO:
          $item = [
            'pref_code' => fake()->randomNumber(4),
            'pref_name' => fake()->word(),
            'city_name' => fake()->word(),
            'yyyymm' => '20260201',
            'ward_code' => fake()->randomNumber(4),
            'ward_name' => fake()->word(),
            'district_name' => fake()->word(),
            'oaza_code' => fake()->randomNumber(4),
            'oaza_name' => fake()->word(),
            'age' => (string)fake()->randomNumber(4),
            'total_count' => fake()->randomNumber(4),
            'male_count' => fake()->randomNumber(4),
            'female_count' => fake()->randomNumber(4),
            'description' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';

          $response = $this->actingAs($user)->call('POST', route('r4.populations.store'), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正画面
    public function test_population_edit()
    {
        if (Route::has('r4.populations.edit')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $response = $this->actingAs($user)->call('GET', route('r4.populations.edit', ['population' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正処理
    public function test_population_update()
    {
        if (Route::has('r4.populations.update')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = [
              // TODO:
              'pref_code' => fake()->randomNumber(4),
            'pref_name' => fake()->word(),
            'city_name' => fake()->word(),
            'yyyymm' => '20260201',
            'ward_code' => fake()->randomNumber(4),
            'ward_name' => fake()->word(),
            'district_name' => fake()->word(),
            'oaza_code' => fake()->randomNumber(4),
            'oaza_name' => fake()->word(),
            'age' => (string)fake()->randomNumber(4),
            'total_count' => fake()->randomNumber(4),
            'male_count' => fake()->randomNumber(4),
            'female_count' => fake()->randomNumber(4),
            'description' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PUT', route('r4.populations.update', ['population' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 表示
    public function test_population_show()
    {
        if (Route::has('r4.populations.show')) {
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.show', ['population' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 直接編集フォーム
    public function test_population_edit_raw()
    {
        if (Route::has('r4.populations.edit_raw')) {
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.edit_raw', ['population' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
    
    // 直接修正処理
    public function test_population_update_raw()
    {
        if (Route::has('r4.populations.update_raw')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = [
              // TODO:
              'pref_code' => fake()->randomNumber(4),
            'pref_name' => fake()->word(),
            'city_name' => fake()->word(),
            'yyyymm' => '20260201',
            'ward_code' => fake()->randomNumber(4),
            'ward_name' => fake()->word(),
            'district_name' => fake()->word(),
            'oaza_code' => fake()->randomNumber(4),
            'oaza_name' => fake()->word(),
            'age' => (string)fake()->randomNumber(4),
            'total_count' => fake()->randomNumber(4),
            'male_count' => fake()->randomNumber(4),
            'female_count' => fake()->randomNumber(4),
            'description' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PATCH', route('r4.populations.update_raw', ['population' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示画面
    public function test_population_index()
    {
        if (Route::has('r4.populations.index')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.index'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え
    public function test_population_seq()
    {
        if (Route::has('r4.populations.seq')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.seq'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え保存
    public function test_population_seq_save()
    {
        if (Route::has('r4.populations.seq_save')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.populations.seq_save', ['item_ids' => '1,2']), [], [], [], []);
          $response->assertStatus(302);
        } else {
          $this->assertTrue(true);
        }
    }

    // 削除
    public function test_population_destroy()
    {
        if (Route::has('r4.populations.destroy')) {
          $id = Population::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);

          $response = $this->actingAs($user)->call('DELETE', route('r4.populations.destroy', ['population' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // ダウンロード
    public function test_population_download()
    {
        if (Route::has('r4.populations.download')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.download'), [], [], [], []);
          $response->assertStatus(200);
          $this->assertTrue(strpos($response->headers->get('content-disposition'), 'attachment; filename=') !== false);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード画面
    public function test_population_uploader()
    {
        if (Route::has('r4.populations.uploader')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.uploader'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード・差分表示（ファイルは testdata/population_unittest.xlsx を使用）
    public function test_population_upload_diff()
    {
        if (Route::has('r4.populations.upload_diff')) {

          // 重複による削除を抑止。（ただし更新の試験ができないね）
          Population::query()->forceDelete();

          // TODO: 
          $file = new UploadedFile(storage_path('testdata/人口_unittest.xlsx'), '人口_unittest.xlsx', null, null, true);

          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.populations.upload_diff'), ['excel' => $file], [], [], []);
          $response->assertStatus(200);
          $response->assertDontSeeText('アップロードエラー');
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード後保存
    public function test_population_upload_commit()
    {
        if (Route::has('r4.populations.upload_commit')) {
          $data_key = MirSerializedVar::orderBy('id', 'desc')->value('var_name');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.populations.upload_commit', ['data_key' => $data_key,]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
      }

    // 最後に指定した条件で遷移
    public function test_population_last_conds()
    {
        if (Route::has('r4.populations.last_conds')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.last_conds'), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 左ナビ形式の一覧
    public function test_population_lnav()
    {
        if (Route::has('r4.populations.lnav')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.lnav'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示の自動更新版
    public function test_population_index_live()
    {
        if (Route::has('r4.populations.index_live')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.populations.index_live'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
}
