<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\BelongsToMany;
//use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Relations\HasManyThrough;
//use Illuminate\Database\Eloquent\Relations\HasOne;
//use Illuminate\Database\Eloquent\Relations\HasOneThrough;
//use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\GomiItemObservable;
use \DateTimeInterface;

/**
  * ごみ分別モデルのオブジェクト定義
  */
class GomiItem extends Model
{
    use HasFactory;
    //use SoftDeletes;
    //use GomiItemObservable; # ←TODO: モデル変更を監視したい場合はコメントを外す

    protected $fillable = [
        'id',
        'kana1',
        'name',
        'detail',
        'size',
        'gomi_type',
        'fee',
        'description',
        'howto',
        'words',
        'url',
        'memo',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // レコードの件名
    public function getItemTitleAttribute()
    {
        return trim("[{$this->id}] {$this->name}");
    }

    // アクセサのサンプル
    // id getter
    /*
    public function getIdDispAttribute()
    {
        return "第{$this->id}番";
    }
    */

    // リレーション定義のサンプル

    /**
     * Get the phone associated with the user.
     */

    /*
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }
    */

    /**
     * Get the user that owns the phone.
     */

    /*
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    */

    /**
     * Get the comments for the blog post.
     */

    /*
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    */

    /**
     * Get the user's most recent order.
     */

    /*
    public function latestOrder(): HasOne
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }
    */

    /**
     * Get the user's oldest order.
     */

    /*
    public function oldestOrder(): HasOne
    {
        return $this->hasOne(Order::class)->oldestOfMany();
    }
    */

    /**
     * Get the car's owner.
     */

    /*
    public function carOwner(): HasOneThrough
    {
        return $this->hasOneThrough(Owner::class, Car::class);
    }
    */

    /**
     * Get all of the deployments for the project.
     */

    /*
    public function deployments(): HasManyThrough
    {
        return $this->hasManyThrough(Deployment::class, Environment::class);
    }
    */

    /**
     * The roles that belong to the user.
     */

    /*
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    */

    /**
     * モデルをtoArrayで出力する際の日付の形式を定義する
     * エクセルアップロード時の変更履歴を取得する際に日付カラムを
     * エクセルからと現DBのtoArrayで比較一致させるために必要
     *
     * @param DateTimeInterface $date
     * @return void
     */
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y/m/d H:i:s');
    }

    // 変更履歴等で表示するため、カラム名とラベルの配列を保持
    public $columns = [
        'id' => 'ID',
        'kana1' => '行',
        'name' => '品目',
        'detail' => '詳細',
        'size' => '大きさ・長さ',
        'gomi_type' => '分別品目',
        'fee' => '処理手数料',
        'description' => '連絡ごみ備考',
        'howto' => '排出方法･備考',
        'words' => 'URLに関連するワード',
        'url' => '浜松市公式Webサイト 参考ページURL',
        'memo' => '分別品目の補足',
        'created_at' => '登録日時',
        'updated_at' => '更新日時'
    ];
}

