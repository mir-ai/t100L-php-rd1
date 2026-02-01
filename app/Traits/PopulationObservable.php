<?php

namespace App\Traits;

use App\Observers\PopulationObserver;

/**
 * 人口モデルのObserver登録用トレイト
 *
 */
trait PopulationObservable
{
  public static function bootPopulationObservable()
  {
    self::observe(PopulationObserver::class);
  }
}
