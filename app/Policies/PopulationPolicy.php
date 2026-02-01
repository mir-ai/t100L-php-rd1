<?php

namespace App\Policies;

use App\Models\Population;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * 人口の画面別アクセス権限規定
 */
class PopulationPolicy
{
    /**
     * 人口の権限設定。Adminユーザーの場合すべてアクセス可能
     */
    public function before(User $user)
    {
        return true;
    }

    /**
     * 人口の参照権限
     */
    public function viewAny(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 削除済の人口の参照権限
     */
    public function viewTrashed(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 人口の閲覧権限
     */
    public function view(User $user, Population $population): bool
    {
        // TODO:
        return true;
    }

    /**
     * 人口の作成権限
     */
    public function create(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 人口の更新権限
     */
    public function update(User $user, Population $population): bool
    {
        // TODO:
        // return $population->user()->is($user);
        return true;
    }

    /**
     * 人口の更新権限(全項目)
     */
    public function update_raw(User $user, Population $population): bool
    {
        // TODO:
        // return $population->user()->is($user);
        return true;
    }

    /**
     * 人口の削除権限
     */
    public function delete(User $user, Population $population): bool
    {
        // TODO:
        // return $population->user()->is($user);
        return true;
    }

    /**
     * 削除済の人口の復旧権限
     */
    public function restore(User $user, Population $population): bool
    {
        // TODO:
        // return $population->user()->is($user);
        return true;
    }

    /**
     * 削除済の人口の完全削除権限
     */
    public function force(User $user, Population $population): bool
    {
        // TODO:
        // return $population->user()->is($user);
        return true;
    }

    /**
     * 人口のアップロード権限
     */
    public function upload(User $user): bool
    {
        // TODO:
        return true;
    }

    /**
     * 人口の並べ替え権限
     */
    public function seq(User $user): bool
    {
        // TODO:
        return true;
    }
}
