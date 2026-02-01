<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * イベントの画面別アクセス権限規定
 */
class EventPolicy
{
    /**
     * イベントの権限設定。Adminユーザーの場合すべてアクセス可能
     */
    public function before(User $user)
    {
        return true;
    }

    /**
     * イベントの参照権限
     */
    public function viewAny(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 削除済のイベントの参照権限
     */
    public function viewTrashed(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * イベントの閲覧権限
     */
    public function view(User $user, Event $event): bool
    {
        // TODO:
        return true;
    }

    /**
     * イベントの作成権限
     */
    public function create(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * イベントの更新権限
     */
    public function update(User $user, Event $event): bool
    {
        // TODO:
        // return $event->user()->is($user);
        return true;
    }

    /**
     * イベントの更新権限(全項目)
     */
    public function update_raw(User $user, Event $event): bool
    {
        // TODO:
        // return $event->user()->is($user);
        return true;
    }

    /**
     * イベントの削除権限
     */
    public function delete(User $user, Event $event): bool
    {
        // TODO:
        // return $event->user()->is($user);
        return true;
    }

    /**
     * 削除済のイベントの復旧権限
     */
    public function restore(User $user, Event $event): bool
    {
        // TODO:
        // return $event->user()->is($user);
        return true;
    }

    /**
     * 削除済のイベントの完全削除権限
     */
    public function force(User $user, Event $event): bool
    {
        // TODO:
        // return $event->user()->is($user);
        return true;
    }

    /**
     * イベントのアップロード権限
     */
    public function upload(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * イベントの並べ替え権限
     */
    public function seq(User $user): bool
    {
        // TODO:
        return true;
    }
}
