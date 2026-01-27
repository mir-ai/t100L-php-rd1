<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\V4\UserV4Controller;
use App\Http\Controllers\V4\PasswordUpdateV4Controller;
use App\Http\Middleware\MirAudioLogMiddleware;
use App\Http\Controllers\V4\MonitorWarningV4Controller;
use App\Http\Controllers\V4\AlertMessageV4Controller;
use App\Http\Controllers\V4\AlertV4Controller;
use App\Http\Controllers\V4\ClientV4Controller;
use App\Http\Controllers\V4\SubscriptionV4Controller;
use App\Http\Controllers\V4\DeliveryV4Controller;
use App\Http\Controllers\V4\LineDeliveryV4Controller;
use App\Http\Controllers\V4\ClientInboxV4Controller;
use App\Http\Controllers\V4\SkipTimeV4Controller;
use App\Http\Controllers\V4\DeliveryJobV4Controller;
use App\Http\Controllers\V4\ClientAlertMessageV4Controller;
use App\Http\Controllers\V4\QueuedUrlV4Controller;
use App\Http\Controllers\V4\CityV4Controller;
use App\Http\Controllers\V4\JmaAreaCodeV4Controller;
use App\Http\Controllers\V4\AreaCityV4Controller;
use App\Http\Controllers\V4\GuestAreaCityV4Controller;
use App\Http\Controllers\V4\CityWeather27AlertV4Controller;


Route::name('guest.')->group(function () {
    // ゲスト用の市区町村選択画面
    // トップから県を選択
    Route::get('/', [GuestAreaCityV4Controller::class, 'index'])->name('top');

    // 県から地域を選択
    Route::get('/p/{pref_code}', [GuestAreaCityV4Controller::class, 'pref'])->name('pref');

    // 地域から市区町村を選択
    Route::get('/a/{area5_code}', [GuestAreaCityV4Controller::class, 'area'])->name('area');

    // 市区町村のページ
    Route::get('/c/{city_code_5}', [GuestAreaCityV4Controller::class, 'city'])->name('city');




    // 県から地域を選択
    Route::get('/pref/{pref_code}', [GuestAreaCityV4Controller::class, 'pref'])->name('pref_long');

    // 地域から市区町村を選択
    Route::get('/area/{area5_code}', [GuestAreaCityV4Controller::class, 'area'])->name('area_long');

    // 市区町村のページ
    Route::get('/city/{city_code_5}', [GuestAreaCityV4Controller::class, 'city'])->name('city_long');

    // 市区町村の履歴ページ
    Route::get('/city/{city_code_5}/history', [GuestAreaCityV4Controller::class, 'city_history'])->name('city_history');

    // 市区町村名の検索の後にジャンプ
    Route::post('/city/redir', [GuestAreaCityV4Controller::class, 'city_redir'])->name('city_redir');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// デモ架電管理
if (Route::group(['middleware' => 'auth.very_basic'], function () {

    // アクセスをデーターベースに記録する
    Route::middleware([MirAudioLogMiddleware::class])->group(function () {
        Route::group(['middleware' => 'auth'], function () {
            // admin
            Route::prefix('admin')->name('r4.')->group(function () {

                // アカウント管理
                Route::controller(UserV4Controller::class)->group(function () {
                    // アカウント管理
                    Route::prefix('/users')->name('users.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // パスワード変更
                        Route::get('/edit_password/{user}', 'edit_password')->name('edit_password');

                        // パスワード変更実行
                        Route::patch('/update_password/{user}', 'update_password')->name('update_password');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('users', UserV4Controller::class);
                })->whereNumber('user');

                // 自分のパスワード変更
                Route::get('my/edit_password', [PasswordUpdateV4Controller::class, 'edit_password'])->name('my.edit_password');
                Route::patch('my/update_password', [PasswordUpdateV4Controller::class, 'update_password'])->name('my.update_password');

                // 監視警告管理
                Route::controller(MonitorWarningV4Controller::class)->group(function () {
                    // 監視警告管理
                    Route::prefix('/monitor_warnings')->name('monitor_warnings.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('monitor_warnings', MonitorWarningV4Controller::class)->only(['index', 'show']);
                })->whereNumber('monitor_warning');

                // 通知イベント管理
                Route::controller(AlertMessageV4Controller::class)->group(function () {
                    // 通知イベント管理
                    Route::prefix('/alert_messages')->name('alert_messages.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{alert_message}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{alert_message}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('alert_messages', AlertMessageV4Controller::class);
                })->whereNumber('alert_message');

                // 警報管理
                Route::controller(AlertV4Controller::class)->group(function () {
                    // 警報管理
                    Route::prefix('/alerts')->name('alerts.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{alert}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{alert}', 'update_raw')->name('update_raw');

                        // 並べ替え
                        Route::get('/seq', 'seq')->name('seq');

                        // 並べ替え保存
                        Route::post('/seq_save', 'seq_save')->name('seq_save');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('alerts', AlertV4Controller::class);
                })->whereNumber('alert');

                // 受信者管理
                Route::controller(ClientV4Controller::class)->group(function () {
                    // 受信者管理
                    Route::prefix('/clients')->name('clients.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{client}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{client}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('clients', ClientV4Controller::class);
                })->whereNumber('client');

                // 購読管理
                Route::controller(SubscriptionV4Controller::class)->group(function () {
                    // 購読管理
                    Route::prefix('/subscriptions')->name('subscriptions.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{subscription}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{subscription}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('subscriptions', SubscriptionV4Controller::class);
                })->whereNumber('subscription');

                // 配信指示管理
                Route::controller(DeliveryV4Controller::class)->group(function () {
                    // 配信指示管理
                    Route::prefix('/deliveries')->name('deliveries.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{delivery}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{delivery}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('deliveries', DeliveryV4Controller::class);
                })->whereNumber('delivery');

                // LINE配信指示管理
                Route::controller(LineDeliveryV4Controller::class)->group(function () {
                    // LINE配信指示管理
                    Route::prefix('/line_deliveries')->name('line_deliveries.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{line_delivery}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{line_delivery}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('line_deliveries', LineDeliveryV4Controller::class);
                })->whereNumber('line_delivery');

                // 受信簿管理
                Route::controller(ClientInboxV4Controller::class)->group(function () {
                    // 受信簿管理
                    Route::prefix('/client_inboxes')->name('client_inboxes.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{client_inbox}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{client_inbox}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('client_inboxes', ClientInboxV4Controller::class);
                })->whereNumber('client_inbox');

                // 配信抑止管理
                Route::controller(SkipTimeV4Controller::class)->group(function () {
                    // 配信抑止管理
                    Route::prefix('/skip_times')->name('skip_times.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{skip_time}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{skip_time}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('skip_times', SkipTimeV4Controller::class);
                })->whereNumber('skip_time');

                // 配信ジョブ管理
                Route::controller(DeliveryJobV4Controller::class)->group(function () {
                    // 配信ジョブ管理
                    Route::prefix('/delivery_jobs')->name('delivery_jobs.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('delivery_jobs', DeliveryJobV4Controller::class)->only(['index', 'show']);
                })->whereNumber('delivery_job');

                // 利用者別配信状況管理
                Route::controller(ClientAlertMessageV4Controller::class)->group(function () {
                    // 利用者別配信状況管理
                    Route::prefix('/client_alert_messages')->name('client_alert_messages.')->group(function () {
                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('client_alert_messages', ClientAlertMessageV4Controller::class)->only(['index']);
                })->whereNumber('client_alert_message');

                // 処理するURL管理
                Route::controller(QueuedUrlV4Controller::class)->group(function () {
                    // 処理するURL管理
                    Route::prefix('/queued_urls')->name('queued_urls.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{queued_url}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{queued_url}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('queued_urls', QueuedUrlV4Controller::class);
                })->whereNumber('queued_url');

                // 市区町村管理
                Route::controller(CityV4Controller::class)->group(function () {
                    // 市区町村管理
                    Route::prefix('/cities')->name('cities.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{city}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{city}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('cities', CityV4Controller::class);
                })->whereNumber('city');

                // JMAの地域階層管理
                Route::controller(JmaAreaCodeV4Controller::class)->group(function () {
                    // JMAの地域階層管理
                    Route::prefix('/jma_area_codes')->name('jma_area_codes.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{jma_area_code}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{jma_area_code}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('jma_area_codes', JmaAreaCodeV4Controller::class);
                })->whereNumber('jma_area_code');

                // 地域階層と市区町村の連携管理
                Route::controller(AreaCityV4Controller::class)->group(function () {
                    // 地域階層と市区町村の連携管理
                    Route::prefix('/area_cities')->name('area_cities.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{area_city}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{area_city}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('area_cities', AreaCityV4Controller::class);
                })->whereNumber('area_city');

                // 市区町村別気象警報(H27)管理
                Route::controller(CityWeather27AlertV4Controller::class)->group(function () {
                    // 気象警報(H27)管理
                    Route::prefix('/city_weather27_alerts')->name('city_weather27_alerts.')->group(function () {
                        // ダウンロード画面
                        Route::get('/download', 'download')->name('download');

                        // アップロード画面
                        Route::get('/uploader', 'uploader')->name('uploader');
                        
                        // アップロードファイルと現在の内容との差分表示
                        Route::post('/upload_diff/wfps', 'upload_diff')->name('upload_diff');

                        // アップロード情報で更新
                        Route::post('/upload_commit/{data_key}', 'upload_commit')->name('upload_commit');

                        // 最後の検索条件で一覧に戻る
                        Route::get('/last_conds', 'last_conds')->name('last_conds');

                        // 一覧表示の自動更新版
                        Route::get('/index_live', 'index_live')->name('index_live');

                        // 全項目編集フォーム
                        Route::get('/edit_raw/{city_weather27_alert}', 'edit_raw')->name('edit_raw');

                        // 直接内容更新
                        Route::patch('/update_raw/{city_weather27_alert}', 'update_raw')->name('update_raw');
                    });

                    // 一覧、詳細、登録、修正、削除はここに
                    Route::resource('city_weather27_alerts', CityWeather27AlertV4Controller::class);
                })->whereNumber('city_weather27_alert');

            });
        });

        Auth::routes();
    });                    

}));
