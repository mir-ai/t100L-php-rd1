<?php namespace App\DataAccess;

use App\Models\Population;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ResourceNotFoundException;

// 人口のデータアクセス処理
class PopulationDa
{
    /**
     * レコードを作成し、作成されたモデルを返す
     *
     * @param array $attributes
     * @return Population|null
     */
    public static function create(array $attributes): Population|null
    {
        $population = Population::create($attributes);
        return $population;
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
        $rows_affected = Population::where('id', $id)->update($attributes);

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
        $db_matrix_raw = Population::query()
        ->whereIn($key, $ids)
        ->orderBy($key)
        ->get();

        return $db_matrix_raw;
    }

    /**
     * 指定された id の人口を返す。見つからないリソースが見つからないエラー
     *
     * @param int $id
     * @return Population
     */
    public static function findOrFail(int $id): Population
    {
        $population = Population::find($id);

        if (! $population) {
            throw new ResourceNotFoundException("Populations id={$id} not found.");
        }

        return $population;
    }    
}
