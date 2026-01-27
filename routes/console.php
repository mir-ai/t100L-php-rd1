<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// M001. 東京電力の停電情報を実行する。
Schedule::command('m001_fetch_tokyo_power_outage')->everyMinute()->withoutOverlapping()->runInBackground();

// M002. JMA気象庁のEXTRAフィードを読み込み、子供の処理も実行する。
Schedule::command('m002_fetch_jma_xml_feed_extra')->everyMinute()->withoutOverlapping();

// M003. VPWW54 JMA気象庁のEXTRAフィードを読み込み、子供の処理も実行する。
Schedule::command('m003_fetch_jma_vpww54')->everyMinute()->withoutOverlapping();
