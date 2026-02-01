<?php

namespace App\Observers;

use App\Models\Population;
use App\DataAccess\ChangeLogDa;

/**
  * 人口モデルのイベント監視クラス
  *
  */
class PopulationObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    private $table_name = 'populations';

    /**
     * 人口 の登録イベント
     */
    public function created(Population $population): void
    {
        // logger("Created Population [{$population->id}]", $population->toArray());

        ChangeLogDa::record(
            op_mode: 'CREATED',
            table_name: $this->table_name,
            primary_id: $population->id,
            attributes: $population->toArray(),
        );

    }

    /**
     * 人口 の更新イベント
     */
    public function updating(Population $population): void
    {
        // logger("Updating Population [{$population->id}]", $this->getDiffs($population));

        ChangeLogDa::record(
            op_mode: 'UPDATED',
            table_name: $this->table_name,
            primary_id: $population->id,
            attributes: $this->getDiffs($population),
        );        
    }

    /**
     * 人口 の削除イベント
     */
    public function deleted(Population $population): void
    {
        // logger("Deleted Population [{$population->id}]", $population->toArray());

        ChangeLogDa::record(
            op_mode: 'DELETED',
            table_name: $this->table_name,
            primary_id: $population->id,
            attributes: $population->toArray(),
        );

    }

    /**
     * 人口 の削除取消イベント
     */
    public function restored(Population $population): void
    {
        // logger("Restored Population [{$population->id}]");

        ChangeLogDa::record(
            op_mode: 'RESTORED',
            table_name: $this->table_name,
            primary_id: $population->id,
            attributes: $population->toArray(),
        );        
    }

    /**
     * 人口 の強制削除イベント
     */
    public function forceDeleted(Population $population): void
    {
        // logger("ForceDeleted Population [{$population->id}]", $population->toArray());

        ChangeLogDa::record(
            op_mode: 'FORCE_DELETED',
            table_name: $this->table_name,
            primary_id: $population->id,
            attributes: $population->toArray(),
        );        
    }

    /**
     * 人口  の変更差分を取得
     *
     * @param Population $population
     * @return array
     *
     *
     * $diffs = [
     *   'age' => [
     *      'old' => 16,
     *      'new' => 17,
     *   ],
     *   'height' => [
     *      'old' => 157,
     *      'new' => 160,
     *   ],     
     * ]
     * 
     */
    private function getDiffs(Population $population): array
    {
        $diffs = [];

        if ($population->isDirty()) {
            $changed_attributes = $population->getDirty();
            $original_values = $population->getOriginal();

            foreach ($changed_attributes as $attribute => $new_value) {
                $old_value = $original_values[$attribute] ?? null;
            }

            $diffs[$attribute]['old'] = $old_value;
            $diffs[$attribute]['new'] = $new_value;
        }

        return $diffs;
    }    
}
