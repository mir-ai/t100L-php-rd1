<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\GomiItem;
use App\Models\User;
use App\Models\MirSerializedVar;
use \Illuminate\Http\UploadedFile;
use Database\Seeders\TestUserTableSeeder;
use Illuminate\Support\Facades\Route;

/**
 * ごみ分別 の登録、更新、一覧、詳細表示ページを http でアクセスしてエラーがないかを確認する。
 */
class GomiItemWebTest extends TestCase
{
    private $user;

    private string $string_column = 'memo';

    protected array $seeders = [
        TestUserTableSeeder::class,
        \Database\Seeders\GomiItemTableSeeder::class
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    // ダミーのユーザー情報作成(または更新)
    public function test_create_user()
    {
        GomiItem::query()->forceDelete();
        $this->seed($this->seeders);

        $this->assertTrue(true);
    }

    // 登録画面
    public function test_gomi_item_create()
    {
        if (Route::has('r4.gomi_items.create')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          GomiItem::where($this->string_column, 'UNITTEST')->forceDelete();
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.create'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 登録処理
    public function test_gomi_item_store()
    {
        if (Route::has('r4.gomi_items.store')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $item = [
            'kana1' => substr(fake()->word(), 0, 1),
            'name' => fake()->word(),
            'detail' => fake()->word(),
            'size' => fake()->word(),
            'gomi_type' => fake()->word(),
            'fee' => fake()->word(),
            'description' => fake()->text(),
            'howto' => fake()->text(),
            'words' => fake()->text(),
            'url' => fake()->text(),
            'memo' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';

          $response = $this->actingAs($user)->call('POST', route('r4.gomi_items.store'), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正画面
    public function test_gomi_item_edit()
    {
        if (Route::has('r4.gomi_items.edit')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.edit', ['gomi_item' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正処理
    public function test_gomi_item_update()
    {
        if (Route::has('r4.gomi_items.update')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = [
            'kana1' => substr(fake()->word(), 0, 1),
            'name' => fake()->word(),
            'detail' => fake()->word(),
            'size' => fake()->word(),
            'gomi_type' => fake()->word(),
            'fee' => fake()->word(),
            'description' => fake()->text(),
            'howto' => fake()->text(),
            'words' => fake()->text(),
            'url' => fake()->text(),
            'memo' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PUT', route('r4.gomi_items.update', ['gomi_item' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 表示
    public function test_gomi_item_show()
    {
        if (Route::has('r4.gomi_items.show')) {
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.show', ['gomi_item' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 直接編集フォーム
    public function test_gomi_item_edit_raw()
    {
        if (Route::has('r4.gomi_items.edit_raw')) {
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.edit_raw', ['gomi_item' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
    
    // 直接修正処理
    public function test_gomi_item_update_raw()
    {
        if (Route::has('r4.gomi_items.update_raw')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = [
            'kana1' => substr(fake()->word(), 0, 1),
            'name' => fake()->word(),
            'detail' => fake()->word(),
            'size' => fake()->word(),
            'gomi_type' => fake()->word(),
            'fee' => fake()->word(),
            'description' => fake()->text(),
            'howto' => fake()->text(),
            'words' => fake()->text(),
            'url' => fake()->text(),
            'memo' => fake()->text(),
          ];
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PATCH', route('r4.gomi_items.update_raw', ['gomi_item' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示画面
    public function test_gomi_item_index()
    {
        if (Route::has('r4.gomi_items.index')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.index'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え
    public function test_gomi_item_seq()
    {
        if (Route::has('r4.gomi_items.seq')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.seq'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え保存
    public function test_gomi_item_seq_save()
    {
        if (Route::has('r4.gomi_items.seq_save')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.gomi_items.seq_save', ['item_ids' => '1,2']), [], [], [], []);
          $response->assertStatus(302);
        } else {
          $this->assertTrue(true);
        }
    }

    // 削除
    public function test_gomi_item_destroy()
    {
        if (Route::has('r4.gomi_items.destroy')) {
          $id = GomiItem::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);

          $response = $this->actingAs($user)->call('DELETE', route('r4.gomi_items.destroy', ['gomi_item' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // ダウンロード
    public function test_gomi_item_download()
    {
        if (Route::has('r4.gomi_items.download')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.download'), [], [], [], []);
          $response->assertStatus(200);
          $this->assertTrue(strpos($response->headers->get('content-disposition'), 'attachment; filename=') !== false);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード画面
    public function test_gomi_item_uploader()
    {
        if (Route::has('r4.gomi_items.uploader')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.uploader'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード・差分表示（ファイルは testdata/gomi_item_unittest.xlsx を使用）
    public function test_gomi_item_upload_diff()
    {
        if (Route::has('r4.gomi_items.upload_diff')) {

          // 重複による削除を抑止。（ただし更新の試験ができないね）
          GomiItem::query()->forceDelete();

          // TODO: 
          $file = new UploadedFile(storage_path('testdata/ごみ分別_unittest.xlsx'), 'ごみ分別_unittest.xlsx', null, null, true);

          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.gomi_items.upload_diff'), ['excel' => $file], [], [], []);
          $response->assertStatus(200);
          $response->assertDontSeeText('アップロードエラー');
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード後保存
    public function test_gomi_item_upload_commit()
    {
        if (Route::has('r4.gomi_items.upload_commit')) {
          $data_key = MirSerializedVar::orderBy('id', 'desc')->value('var_name');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.gomi_items.upload_commit', ['data_key' => $data_key,]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
      }

    // 最後に指定した条件で遷移
    public function test_gomi_item_last_conds()
    {
        if (Route::has('r4.gomi_items.last_conds')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.last_conds'), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 左ナビ形式の一覧
    public function test_gomi_item_lnav()
    {
        if (Route::has('r4.gomi_items.lnav')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.lnav'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示の自動更新版
    public function test_gomi_item_index_live()
    {
        if (Route::has('r4.gomi_items.index_live')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.gomi_items.index_live'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
}
