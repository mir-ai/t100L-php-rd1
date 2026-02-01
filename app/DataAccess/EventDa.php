<?php namespace App\DataAccess;

use App\Models\Event;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ResourceNotFoundException;

// イベントのデータアクセス処理
class EventDa
{
    /**
     * id と name の連想配列を返す
     * 同じリクエスト中は、１度しか実行せず、結果はキャッシュされる
     *
     * @return array
     */
    public static function getNamesByIds(): array
    {
        // 同じリクエスト中は、１度しか実行せず、結果をキャッシュしておく。
        return once(function () {
            $names_by_id = Event::query()
            ->select('name', 'id')
            ->pluck('name', 'id')
            ->toArray();
    
            return $names_by_id;
        });
    }

    /**
     * id から name を取得する
     *
     * @param integer $id
     * @return string|null
     */
    public static function getNameById(int $id): string|null
    {
        $names_by_id = Self::getNamesByIds();

        return $names_by_id[$id] ?? '';
    }

    /**
     * レコードを作成し、作成されたモデルを返す
     *
     * @param array $attributes
     * @return Event|null
     */
    public static function create(array $attributes): Event|null
    {
        $event = Event::create($attributes);
        return $event;
    }

    /**
     * IDで指定されたレコードを１件更新する。
     *
     * @param integer $id
     * @param array $attributes
     * @return integer
     */
    public static function update(int $id, array $attributes): int
    {
        $rows_affected = Event::where('id', $id)->update($attributes);

        return $rows_affected;
    }

    /**
     * エクセルアップロード時の処理のため、指定されたIDのレコードを返す
     * 最大1000件まで。
     *
     * @param array $ids
     * @param string $key
     * @return Collection|null
     */
    public static function getMatrixByIds(array $ids, string $key = 'id'): Collection|null
    {
        $db_matrix_raw = Event::query()
        ->whereIn($key, $ids)
        ->orderBy($key)
        ->get();

        return $db_matrix_raw;
    }

    /**
     * 指定された id のイベントを返す。見つからないリソースが見つからないエラー
     *
     * @param int $id
     * @return Event
     */
    public static function findOrFail(int $id): Event
    {
        $event = Event::find($id);

        if (! $event) {
            throw new ResourceNotFoundException("Events id={$id} not found.");
        }

        return $event;
    }    
}
