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
use App\Traits\EventObservable;
use \DateTimeInterface;

/**
  * イベントモデルのオブジェクト定義
  */
class Event extends Model
{
    use HasFactory;
    //use SoftDeletes;
    //use EventObservable; # ←TODO: モデル変更を監視したい場合はコメントを外す

    protected $fillable = [
        'id',
        'pref_code',
        'record_id',
        'pref_name',
        'city_name',
        'event_name',
        'event_kana',
        'event_en',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'start_memo',
        'description',
        'fee_basic',
        'fee_detail',
        'contact_name',
        'contact_tel',
        'contact_tel_ext',
        'organizer',
        'location_name',
        'address',
        'address2',
        'lat',
        'lng',
        'access',
        'parking',
        'capacity',
        'entry_due_date',
        'entry_due_time',
        'entry_method',
        'entry_url',
        'memo',
        'category',
        'ward_name',
        'open_date',
        'update_date',
        'is_childcare',
        'location_no',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'open_date' => 'datetime',
        'update_date' => 'datetime',
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
    public static $columns = [
        'id' => 'id',
        'pref_code' => '都道府県コード又は市区町村コード',
        'record_id' => 'NO',
        'pref_name' => '都道府県名',
        'city_name' => '市区町村名',
        'event_name' => 'イベント名',
        'event_kana' => 'イベント名_カナ',
        'event_en' => 'イベント名_英語',
        'start_date' => '開始日',
        'end_date' => '終了日',
        'start_time' => '開始時間',
        'end_time' => '終了時間',
        'start_memo' => '開始日時特記事項',
        'description' => '説明',
        'fee_basic' => '料金(基本)',
        'fee_detail' => '料金(詳細)',
        'contact_name' => '連絡先名称',
        'contact_tel' => '連絡先電話番号',
        'contact_tel_ext' => '連絡先内線番号',
        'organizer' => '主催者',
        'location_name' => '場所名称',
        'address' => '住所',
        'address2' => '方書',
        'lat' => '緯度',
        'lng' => '経度',
        'access' => 'アクセス方法',
        'parking' => '駐車場情報',
        'capacity' => '定員',
        'entry_due_date' => '参加申込終了日',
        'entry_due_time' => '参加申込終了時間',
        'entry_method' => '参加申込方法',
        'entry_url' => 'URL',
        'memo' => '備考',
        'category' => 'カテゴリー',
        'ward_name' => '区',
        'open_date' => '公開日',
        'update_date' => '更新日',
        'is_childcare' => '子育て情報',
        'location_no' => '施設No.',
        'created_at' => '登録日時',
        'updated_at' => '更新日時'
    ];
}

