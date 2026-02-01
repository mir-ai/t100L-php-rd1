<?php

namespace App\Traits;

use App\Observers\EventObserver;

/**
 * イベントモデルのObserver登録用トレイト
 *
 */
trait EventObservable
{
  public static function bootEventObservable()
  {
    self::observe(EventObserver::class);
  }
}
