<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\Event;
use App\Models\User;
use App\Models\MirSerializedVar;
use \Illuminate\Http\UploadedFile;
use Database\Seeders\TestUserTableSeeder;
use Illuminate\Support\Facades\Route;

/**
 * イベント の登録、更新、一覧、詳細表示ページを http でアクセスしてエラーがないかを確認する。
 */
class EventWebTest extends TestCase
{
    private $user;

    private string $string_column = 'memo';

    protected array $seeders = [
        TestUserTableSeeder::class,
        \Database\Seeders\EventTableSeeder::class
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    // ダミーのユーザー情報作成(または更新)
    public function test_create_user()
    {
        Event::query()->forceDelete();
        $this->seed($this->seeders);

        $this->assertTrue(true);
    }

    // 登録画面
    public function test_event_create()
    {
        if (Route::has('r4.events.create')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          Event::where($this->string_column, 'UNITTEST')->forceDelete();
          $response = $this->actingAs($user)->call('GET', route('r4.events.create'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 登録処理
    public function test_event_store()
    {
        if (Route::has('r4.events.store')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $item = Event::factory()->make()->toArray();
          $item[$this->string_column] = 'UNITTEST';

          $response = $this->actingAs($user)->call('POST', route('r4.events.store'), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正画面
    public function test_event_edit()
    {
        if (Route::has('r4.events.edit')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $response = $this->actingAs($user)->call('GET', route('r4.events.edit', ['event' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 修正処理
    public function test_event_update()
    {
        if (Route::has('r4.events.update')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = Event::factory()->make()->toArray();
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PUT', route('r4.events.update', ['event' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 表示
    public function test_event_show()
    {
        if (Route::has('r4.events.show')) {
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.show', ['event' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 直接編集フォーム
    public function test_event_edit_raw()
    {
        if (Route::has('r4.events.edit_raw')) {
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.edit_raw', ['event' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
    
    // 直接修正処理
    public function test_event_update_raw()
    {
        if (Route::has('r4.events.update_raw')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          $item = Event::factory()->make()->toArray();
          $item[$this->string_column] = 'UNITTEST';
          $response = $this->actingAs($user)->call('PATCH', route('r4.events.update_raw', ['event' => $id,]), $item, [], [], []);
          $response->assertStatus(302);
          $response->assertSessionHasNoErrors();
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示画面
    public function test_event_index()
    {
        if (Route::has('r4.events.index')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.index'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え
    public function test_event_seq()
    {
        if (Route::has('r4.events.seq')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.seq'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 並べ替え保存
    public function test_event_seq_save()
    {
        if (Route::has('r4.events.seq_save')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.events.seq_save', ['item_ids' => '1,2']), [], [], [], []);
          $response->assertStatus(302);
        } else {
          $this->assertTrue(true);
        }
    }

    // 削除
    public function test_event_destroy()
    {
        if (Route::has('r4.events.destroy')) {
          $id = Event::where($this->string_column, 'UNITTEST')->orderBy('id', 'desc')->value('id');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);

          $response = $this->actingAs($user)->call('DELETE', route('r4.events.destroy', ['event' => ($id ?? 1),]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // ダウンロード
    public function test_event_download()
    {
        if (Route::has('r4.events.download')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.download'), [], [], [], []);
          $response->assertStatus(200);
          $this->assertTrue(strpos($response->headers->get('content-disposition'), 'attachment; filename=') !== false);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード画面
    public function test_event_uploader()
    {
        if (Route::has('r4.events.uploader')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.uploader'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード・差分表示（ファイルは testdata/event_unittest.xlsx を使用）
    public function test_event_upload_diff()
    {
        if (Route::has('r4.events.upload_diff')) {

          // 重複による削除を抑止。（ただし更新の試験ができないね）
          Event::query()->forceDelete();

          // TODO: 
          $file = new UploadedFile(storage_path('testdata/イベント_unittest.xlsx'), 'イベント_unittest.xlsx', null, null, true);

          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.events.upload_diff'), ['excel' => $file], [], [], []);
          $response->assertStatus(200);
          $response->assertDontSeeText('アップロードエラー');
        } else {
            $this->assertTrue(true);
        }        
    }

    // アップロード後保存
    public function test_event_upload_commit()
    {
        if (Route::has('r4.events.upload_commit')) {
          $data_key = MirSerializedVar::orderBy('id', 'desc')->value('var_name');
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('POST', route('r4.events.upload_commit', ['data_key' => $data_key,]), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
      }

    // 最後に指定した条件で遷移
    public function test_event_last_conds()
    {
        if (Route::has('r4.events.last_conds')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.last_conds'), [], [], [], []);
          $response->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 左ナビ形式の一覧
    public function test_event_lnav()
    {
        if (Route::has('r4.events.lnav')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.lnav'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }

    // 一覧表示の自動更新版
    public function test_event_index_live()
    {
        if (Route::has('r4.events.index_live')) {
          /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
          $user = User::find(1);
          $response = $this->actingAs($user)->call('GET', route('r4.events.index_live'), [], [], [], []);
          $response->assertStatus(200);
        } else {
            $this->assertTrue(true);
        }        
    }
}
