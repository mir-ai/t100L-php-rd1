<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V4\Api\TwilioApiV4Controller;
use App\Http\Controllers\V4\Api\ReplaceApiV4Controller;
use App\Http\Controllers\V4\Api\DemoCallApiV4Controller;
use App\Http\Controllers\V4\Api\GuestAreaCityApiV4Controller;

Route::name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    // 日本語テキストを読み上げるSSMLを生成する
    Route::post('replace/ssml', [ReplaceApiV4Controller::class, 'ssml'])->name('yomi_ssml');

    // 日本語の単語を入れると、登録されているヨミを返す
    Route::post('replace/get', [ReplaceApiV4Controller::class, 'yomi_get'])->name('yomi_get');

    // 日本語の単語に対してヨミを登録する
    Route::post('replace/set', [ReplaceApiV4Controller::class, 'yomi_set'])->name('yomi_set');

    // 市区町村名での検索用
    Route::get('search/city_name/{pref_code?}', [GuestAreaCityApiV4Controller::class, 'search_city_name'])->name('search_city_name');

    // Twilio応答管理
    Route::controller(TwilioApiV4Controller::class)->group(function () {
        // Twilio管理
        Route::prefix('/twilio')->name('twilio.')->group(function () {
            // 発話2
            Route::post('/talk/{call_id}/talk2', 'talk2')->name('talk2');

            // 発話3
            Route::post('/talk/{call_id}/talk3', 'talk3')->name('talk3');
            
            // ステータスコールバック
            Route::post('/callback/{call_id}/status', 'callback_status')->name('callback_status');

            // 留守電・FAX判別コールバック
            Route::post('/callback/{call_id}/callback_amd', 'callback_amd')->name('callback_amd');

            // 録音コールバック1
            Route::post('/callback/{call_id}/record/{question_id}', 'callback_record')->name('callback_record');

            // 文字起こしコールバック1
            Route::post('/callback/{call_id}/transcribe/{question_id}', 'callback_transcribe')->name('callback_transcribe');         
        });
    })->whereNumber('call_id');

    // デモ架電のAPIコントローラー
    Route::controller(DemoCallApiV4Controller::class)->group(function () {

        Route::prefix('/demo_call')->name('demo_call.')->group(function () {
            // 会話ステップ2
            Route::post('/step2/{demo_call}/{question_id}', 'step2')->name('step2');

            // 会話ステップ３
            Route::post('/step3/{demo_call}/{question_id}', 'step3')->name('step3');
            
            // ステータスコールバック
            Route::post('/callback_status/{demo_call}', 'callback_status')->name('callback_status');

            // 留守電・FAX判別コールバック
            Route::post('/callback_amd/{demo_call}', 'callback_amd')->name('callback_amd');

            // 録音コールバック1
            Route::post('/callback_record/{demo_call}/{question_id}', 'callback_record')->name('callback_record');

            // 電話着信(POST)
            Route::post('/inbound_call', 'inbound_call')->name('callback_inbound');

            // 電話着信(GET)
            Route::get('/inbound_call', 'inbound_call')->name('callback_inbound_get');
        });
    })->whereNumber('demo_call');

});
