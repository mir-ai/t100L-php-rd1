<?php namespace App\DataAccess;

use App\Models\GomiItem;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ResourceNotFoundException;

// ごみ分別のデータアクセス処理
class GomiItemDa
{
    /**
     * id と name の連想配列を返す
     * 同じリクエスト中は、１度しか実行せず、結果はキャッシュされる
     *
     * @return array
     */
    public static function getNamesByIds(): array
    {
        // TODO: 'name' を適切なカラム名に書き換える
        return once(function () {
            $names_by_id = GomiItem::query()
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
     * @return GomiItem|null
     */
    public static function create(array $attributes): GomiItem|null
    {
        $gomi_item = GomiItem::create($attributes);
        return $gomi_item;
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
        $rows_affected = GomiItem::where('id', $id)->update($attributes);

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
        $db_matrix_raw = GomiItem::query()
        ->whereIn($key, $ids)
        ->orderBy($key)
        ->get();

        return $db_matrix_raw;
    }

    /**
     * 指定された id のごみ分別を返す。見つからないリソースが見つからないエラー
     *
     * @param int $id
     * @return GomiItem
     */
    public static function findOrFail(int $id): GomiItem
    {
        $gomi_item = GomiItem::find($id);

        if (! $gomi_item) {
            throw new ResourceNotFoundException("GomiItems id={$id} not found.");
        }

        return $gomi_item;
    }    
}
