<?php

namespace App\Observers;

use App\Models\Event;
use App\DataAccess\ChangeLogDa;

/**
  * イベントモデルのイベント監視クラス
  *
  */
class EventObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    private $table_name = 'events';

    /**
     * イベント の登録イベント
     */
    public function created(Event $event): void
    {
        // logger("Created Event [{$event->id}]", $event->toArray());

        ChangeLogDa::record(
            op_mode: 'CREATED',
            table_name: $this->table_name,
            primary_id: $event->id,
            attributes: $event->toArray(),
        );

    }

    /**
     * イベント の更新イベント
     */
    public function updating(Event $event): void
    {
        // logger("Updating Event [{$event->id}]", $this->getDiffs($event));

        ChangeLogDa::record(
            op_mode: 'UPDATED',
            table_name: $this->table_name,
            primary_id: $event->id,
            attributes: $this->getDiffs($event),
        );        
    }

    /**
     * イベント の削除イベント
     */
    public function deleted(Event $event): void
    {
        // logger("Deleted Event [{$event->id}]", $event->toArray());

        ChangeLogDa::record(
            op_mode: 'DELETED',
            table_name: $this->table_name,
            primary_id: $event->id,
            attributes: $event->toArray(),
        );

    }

    /**
     * イベント の削除取消イベント
     */
    public function restored(Event $event): void
    {
        // logger("Restored Event [{$event->id}]");

        ChangeLogDa::record(
            op_mode: 'RESTORED',
            table_name: $this->table_name,
            primary_id: $event->id,
            attributes: $event->toArray(),
        );        
    }

    /**
     * イベント の強制削除イベント
     */
    public function forceDeleted(Event $event): void
    {
        // logger("ForceDeleted Event [{$event->id}]", $event->toArray());

        ChangeLogDa::record(
            op_mode: 'FORCE_DELETED',
            table_name: $this->table_name,
            primary_id: $event->id,
            attributes: $event->toArray(),
        );        
    }

    /**
     * イベント  の変更差分を取得
     *
     * @param Event $event
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
    private function getDiffs(Event $event): array
    {
        $diffs = [];

        if ($event->isDirty()) {
            $changed_attributes = $event->getDirty();
            $original_values = $event->getOriginal();

            foreach ($changed_attributes as $attribute => $new_value) {
                $old_value = $original_values[$attribute] ?? null;
            }

            $diffs[$attribute]['old'] = $old_value;
            $diffs[$attribute]['new'] = $new_value;
        }

        return $diffs;
    }    
}
