<?php

return [
    // 市区町村名
    'CITY_NAME' => env('CITY_NAME', ''),

    // 市区町村コード
    'CITY_CODE' => env('CITY_CODE', ''),

    // 市区町村コード+名称ローマ字
    'CITY_LONG_CODE' => env('CITY_LONG_CODE', ''),
    
    // 発信元電話番号(Twilio)
    'TWILIO_NUMBER' => env('TWILIO_NUMBER'),

    // NGROKのアクセス用URL（ローカルテスト用）
    'LOCAL_NGROK_ENDPOINT' => env('LOCAL_NGROK_ENDPOINT'),

    // Twilioの電話発信・着信
    'TWILIO_ACCOUNT_SID' => env('TWILIO_ACCOUNT_SID'),
    'TWILIO_AUTH_TOKEN' => env('TWILIO_AUTH_TOKEN'),
    
    // SMSユーザー名
    'SMS_USERNAME' => env('SMS_USERNAME', ''),

    // SMSパスワード
    'SMS_PASSWORD' => env('SMS_PASSWORD', ''),

    // SMS 送信API URL
    'SMS_API_SEND' => env('SMS_API_SEND', ''),

    // SMS 結果取得API URL
    'SMS_API_RESULT' => env('SMS_API_RESULT', ''),

    // SMS 送信元番号
    'SMS_FROM_NUMBER' => env('SMS_FROM_NUMBER', ''),
    
    // 会社名
    'CONTACT_COMPANY' => env('CONTACT_COMPANY'),

    // 会社住所
    'CONTACT_ADDRESS' => env('CONTACT_ADDRESS'),

    // 会社地図URL
    'CONTACT_MAP_URL' => env('CONTACT_MAP_URL'),

    // お問い合わせ電話番号
    'CONTACT_TEL' => env('CONTACT_TEL'),

    // お問い合わせメールアドレス
    'CONTACT_EMAIL' => env('CONTACT_EMAIL'),

    // 電気通信事業者届出
    'CONTACT_DENKI_TUUSHIN' => env('CONTACT_DENKI_TUUSHIN'),

    // ISO27001
    'CONTACT_ISO_27001' => env('CONTACT_ISO_27001'),
    'CONTACT_ISO_27001_REGNO' => env('CONTACT_ISO_27001_REGNO'),
    'CONTACT_ISO_LINK' => env('CONTACT_ISO_LINK'),

    // 管理者のメール
    'MAIL_ADMIN_TO' => env('MAIL_ADMIN_TO', 'ss@mir-ai.co.jp'),

    // フッタークレジット
    'FOOTER_CREDIT' => env('FOOTER_CREDIT'),

    // favicon
    'FAVICON_FORCE_URL' => env('FAVICON_FORCE_URL'),

    // アプリコード
    'APP_CODE' => env('APP_CODE', ''),

    // アプリ名称(内部用)
    'APP_NAME' => env('APP_NAME', ''),

    // サイト名(外部公開用)
    'APP_NAME_JP' => env('APP_NAME_JP'),

    // タイトル(外部公開用)
    'APP_TITLE_JP' => env('APP_TITLE_JP'),

    // ヘッダー画像URL
    'HEAD_LOGO_IMG_URL' => env('HEAD_LOGO_IMG_URL'),

    // Laravelのログを保存するDBテーブル
    'DB_LOG_TABLE' => env('DB_LOG_TABLE'),

    // Laravelのログを保存するコネクション
    'DB_LOG_CONNECTION' => env('DB_LOG_CONNECTION'),

    // Laravelのログを保存するコネクション
    'DB_LOG_CONNECTION' => env('DB_LOG_CONNECTION'),

    // CloudFront版のS3プレフィックス
    'CLOUD_FRONT_PREFIX' => env('CLOUD_FRONT_PREFIX'),

    // S3版のURLプレフィックス
    'S3_PREFIX' => env('S3_PREFIX'),

    // OpenAIのAPIキー
    'OPENAI_API_KEY' => env('OPENAI_API_KEY'),
    
    // OpenAIのトークン
    'OPENAI_API_MAX_TOKENS' => env('OPENAI_API_MAX_TOKENS', 300),

    // SanctumのBearerトークン
    'SANCTUM_BEARER_TOKEN' => env('SANCTUM_BEARER_TOKEN'),
    
    // Laravelのログを保存するレベル
    //   DEBUG (100): Detailed debug information.
    //   INFO (200): Interesting events. Examples: User logs in, SQL logs.
    //   NOTICE (250): Normal but significant events.
    //   WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated
    //   APIs, poor use of an API, undesirable things that are not necessarily wrong.
    //   ERROR (400): Runtime errors that do not require immediate action but should typically be
    //   logged and monitored.
    //   CRITICAL (500): Critical conditions. Example: Application component unavailable,
    //   unexpected exception.
    //   ALERT (550): Action must be taken immediately. Example: Entire website down, database
    //   unavailable, etc. This should trigger the SMS alerts and wake you up.
    //   EMERGENCY (600): Emergency: system is unusable.
    'DB_LOG_LEVEL' => env('DB_LOG_LEVEL', 250),

    // MIRAiE Yomigana Server
    'MECAB_API_URL' => env('MECAB_API_URL', ''),

    // ffmpeg binary path in mac local.
    'LOCAL_FFMPEG_BIN'                           => env('LOCAL_FFMPEG_BIN', ''),

    // MIRAiE Polly Server
    'POLLY_SERVER' => env('POLLY_SERVER', ''),

    // 日本語のAmazon Pollyの音声
    'VOICE_HIGH_JA_JP' => env('VOICE_HIGH_JA_JP', 'Takumi'),

    // 日本語のAmazon Pollyの読み上げ速度
    'VOICE_RATE_JA_JP' => env('VOICE_RATE_JA_JP', 95),
    
    // 配信料金単価

    // Eメール 1通あたり単価
    'UNITPRICE_EMAIL' => env('UNITPRICE_EMAIL', 1),

    // SMS 1文字あたり単価
    'UNITPRICE_SMS' => env('UNITPRICE_SMS', 0.3),

    // FAX A4 １毎あたり単価
    'UNITPRICE_FAX' => env('UNITPRICE_FAX', 15),

    // 携帯電話１分あたり単価
    'UNITPRICE_PHONE_MOBILE' => env('UNITPRICE_PHONE_MOBILE', 35),

    // 固定電話1分あたり単価
    'UNITPRICE_PHONE_PSTN' => env('UNITPRICE_PHONE_PSTN', 15),

    // LINE1通あたり単価
    'UNITPRICE_LINE' => env('UNITPRICE_LINE', 3),

    // ミライエの職員参集API連携用ハッシュ
    'DIRECT_SEND_SALT' => env('DIRECT_SEND_SALT', 'DEFINE_ME'),
];

