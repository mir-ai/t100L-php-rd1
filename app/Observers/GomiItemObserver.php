<?php

namespace App\Observers;

use App\Models\GomiItem;
use App\DataAccess\ChangeLogDa;

/**
  * ごみ分別モデルのイベント監視クラス
  *
  */
class GomiItemObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    private $table_name = 'gomi_items';

    /**
     * ごみ分別 の登録イベント
     */
    public function created(GomiItem $gomi_item): void
    {
        // logger("Created GomiItem [{$gomi_item->id}]", $gomi_item->toArray());

        ChangeLogDa::record(
            op_mode: 'CREATED',
            table_name: $this->table_name,
            primary_id: $gomi_item->id,
            attributes: $gomi_item->toArray(),
        );

    }

    /**
     * ごみ分別 の更新イベント
     */
    public function updating(GomiItem $gomi_item): void
    {
        // logger("Updating GomiItem [{$gomi_item->id}]", $this->getDiffs($gomi_item));

        ChangeLogDa::record(
            op_mode: 'UPDATED',
            table_name: $this->table_name,
            primary_id: $gomi_item->id,
            attributes: $this->getDiffs($gomi_item),
        );        
    }

    /**
     * ごみ分別 の削除イベント
     */
    public function deleted(GomiItem $gomi_item): void
    {
        // logger("Deleted GomiItem [{$gomi_item->id}]", $gomi_item->toArray());

        ChangeLogDa::record(
            op_mode: 'DELETED',
            table_name: $this->table_name,
            primary_id: $gomi_item->id,
            attributes: $gomi_item->toArray(),
        );

    }

    /**
     * ごみ分別 の削除取消イベント
     */
    public function restored(GomiItem $gomi_item): void
    {
        // logger("Restored GomiItem [{$gomi_item->id}]");

        ChangeLogDa::record(
            op_mode: 'RESTORED',
            table_name: $this->table_name,
            primary_id: $gomi_item->id,
            attributes: $gomi_item->toArray(),
        );        
    }

    /**
     * ごみ分別 の強制削除イベント
     */
    public function forceDeleted(GomiItem $gomi_item): void
    {
        // logger("ForceDeleted GomiItem [{$gomi_item->id}]", $gomi_item->toArray());

        ChangeLogDa::record(
            op_mode: 'FORCE_DELETED',
            table_name: $this->table_name,
            primary_id: $gomi_item->id,
            attributes: $gomi_item->toArray(),
        );        
    }

    /**
     * ごみ分別  の変更差分を取得
     *
     * @param GomiItem $gomi_item
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
    private function getDiffs(GomiItem $gomi_item): array
    {
        $diffs = [];

        if ($gomi_item->isDirty()) {
            $changed_attributes = $gomi_item->getDirty();
            $original_values = $gomi_item->getOriginal();

            foreach ($changed_attributes as $attribute => $new_value) {
                $old_value = $original_values[$attribute] ?? null;
            }

            $diffs[$attribute]['old'] = $old_value;
            $diffs[$attribute]['new'] = $new_value;
        }

        return $diffs;
    }    
}
