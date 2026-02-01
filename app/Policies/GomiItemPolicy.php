<?php

namespace App\Policies;

use App\Models\GomiItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * ごみ分別の画面別アクセス権限規定
 */
class GomiItemPolicy
{
    /**
     * ごみ分別の権限設定。Adminユーザーの場合すべてアクセス可能
     */
    public function before(User $user)
    {
        return true;
    }

    /**
     * ごみ分別の参照権限
     */
    public function viewAny(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 削除済のごみ分別の参照権限
     */
    public function viewTrashed(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * ごみ分別の閲覧権限
     */
    public function view(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        return true;
    }

    /**
     * ごみ分別の作成権限
     */
    public function create(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * ごみ分別の更新権限
     */
    public function update(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        // return $gomi_item->user()->is($user);
        return true;
    }

    /**
     * ごみ分別の更新権限(全項目)
     */
    public function update_raw(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        // return $gomi_item->user()->is($user);
        return true;
    }

    /**
     * ごみ分別の削除権限
     */
    public function delete(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        // return $gomi_item->user()->is($user);
        return true;
    }

    /**
     * 削除済のごみ分別の復旧権限
     */
    public function restore(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        // return $gomi_item->user()->is($user);
        return true;
    }

    /**
     * 削除済のごみ分別の完全削除権限
     */
    public function force(User $user, GomiItem $gomi_item): bool
    {
        // TODO:
        // return $gomi_item->user()->is($user);
        return true;
    }

    /**
     * ごみ分別のアップロード権限
     */
    public function upload(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * ごみ分別の並べ替え権限
     */
    public function seq(User $user): bool
    {
        // TODO:
        return true;
    }
}
