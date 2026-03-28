<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 動物モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property int|null $speed
 * @property float|null $weight
 * @property int|null $owner_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Animal whereWeight($value)
 */
	class Animal extends \Eloquent {}
}

namespace App\Models{
/**
 * イベントモデルのオブジェクト定義
 *
 * @property int $id
 * @property int|null $pref_code
 * @property string $record_id
 * @property string|null $pref_name
 * @property string|null $city_name
 * @property string $event_name
 * @property string|null $event_kana
 * @property string|null $event_en
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $start_memo
 * @property string|null $description
 * @property string|null $fee_basic
 * @property string|null $fee_detail
 * @property string|null $contact_name
 * @property string|null $contact_tel
 * @property string|null $contact_tel_ext
 * @property string|null $organizer
 * @property string|null $location_name
 * @property string|null $address
 * @property string|null $address2
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $access
 * @property string|null $parking
 * @property string|null $capacity
 * @property string|null $entry_due_date
 * @property string|null $entry_due_time
 * @property string|null $entry_method
 * @property string|null $entry_url
 * @property string|null $memo
 * @property string|null $category
 * @property string|null $ward_name
 * @property \Illuminate\Support\Carbon|null $open_date
 * @property \Illuminate\Support\Carbon|null $update_date
 * @property string|null $is_childcare
 * @property string|null $location_no
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereContactTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereContactTelExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEntryDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEntryDueTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEntryMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEntryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEventName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereFeeBasic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereFeeDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereIsChildcare($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLocationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereOpenDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereOrganizer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event wherePrefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event wherePrefName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStartMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereWardName($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * ごみ分別モデルのオブジェクト定義
 *
 * @property int $id
 * @property string|null $kana1
 * @property string $name
 * @property string|null $detail
 * @property string|null $size
 * @property string|null $gomi_type
 * @property int|null $fee
 * @property string|null $description
 * @property string|null $howto
 * @property string|null $words
 * @property string|null $url
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\GomiItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereGomiType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereHowto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereKana1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GomiItem whereWords($value)
 */
	class GomiItem extends \Eloquent {}
}

namespace App\Models{
/**
 * アップロードファイルモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $var_yymm
 * @property string $var_name
 * @property string $serialized_var
 * @property int $user_id
 * @property string|null $original_file_name
 * @property int|null $file_size
 * @property \Illuminate\Support\Carbon $expired_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read mixed $item_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereOriginalFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereSerializedVar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereVarName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirSerializedVar whereVarYymm($value)
 */
	class MirSerializedVar extends \Eloquent {}
}

namespace App\Models{
/**
 * 飼い主モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Owner whereUpdatedAt($value)
 */
	class Owner extends \Eloquent {}
}

namespace App\Models{
/**
 * 人口モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $pref_code
 * @property string $pref_name
 * @property string $city_name
 * @property string $yyyymm
 * @property int $ward_code
 * @property string $ward_name
 * @property string $district_name
 * @property int $oaza_code
 * @property string|null $oaza_name
 * @property string $age
 * @property int $total_count
 * @property int $male_count
 * @property int $female_count
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\PopulationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereDistrictName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereFemaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereMaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereOazaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereOazaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population wherePrefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population wherePrefName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereWardCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereWardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Population whereYyyymm($value)
 */
	class Population extends \Eloquent {}
}

namespace App\Models{
/**
 * サンプルテーブルモデルのオブジェクト定義
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $memo
 * @property int $seq
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\SampleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereSeq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sample whereUpdatedAt($value)
 */
	class Sample extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_admin
 * @property-read mixed $item_title
 * @property-read mixed $role_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

