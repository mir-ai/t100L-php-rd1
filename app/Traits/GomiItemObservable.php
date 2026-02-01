<?php

namespace App\Traits;

use App\Observers\GomiItemObserver;

/**
 * ごみ分別モデルのObserver登録用トレイト
 *
 */
trait GomiItemObservable
{
  public static function bootGomiItemObservable()
  {
    self::observe(GomiItemObserver::class);
  }
}
