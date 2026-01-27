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
 * 警報モデルのオブジェクト定義
 *
 * @property int $id
 * @property \App\Enum\AlertCode $alert_code
 * @property string $name
 * @property int|null $seq
 * @property string $active
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\AlertFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereAlertCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereSeq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alert whereUpdatedAt($value)
 */
	class Alert extends \Eloquent {}
}

namespace App\Models{
/**
 * 通知イベントモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property \App\Enum\AlertCode $alert_code
 * @property array<array-key, mixed>|null $alert_kinds
 * @property string|null $publish_office
 * @property \Illuminate\Support\Carbon|null $publish_at
 * @property string $city_code_5
 * @property int $score
 * @property string $is_processed
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property string $title
 * @property string $body_disp
 * @property string|null $url
 * @property string|null $body_voice
 * @property string|null $body_voice_mp3_url
 * @property \Illuminate\Support\Carbon $open_at
 * @property string $is_test
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property string|null $uniq_key
 * @property string|null $original_area_code
 * @property string|null $original_area_name
 * @property-read mixed $city_name_label
 * @property-read mixed $item_title
 * @method static \Database\Factories\AlertMessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereAlertCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereAlertKinds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereBodyDisp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereBodyVoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereBodyVoiceMp3Url($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereIsProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereIsTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereOpenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereOriginalAreaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereOriginalAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage wherePublishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage wherePublishOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereUniqKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlertMessage whereYymm($value)
 */
	class AlertMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * 地域階層と市区町村の連携モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $jma_area5_code
 * @property string $city_code_7_jma
 * @property string $city_area_name
 * @property string $city_code_5
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\AreaCityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereCityAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereCityCode7Jma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereJmaArea5Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AreaCity whereUpdatedAt($value)
 */
	class AreaCity extends \Eloquent {}
}

namespace App\Models{
/**
 * 変更履歴モデルのオブジェクト定義
 *
 * @property int $id
 * @property int|null $revision_id_base
 * @property int|null $revision_id_applied
 * @property int $user_id
 * @property string $table_name
 * @property int $primary_id
 * @property string $op_mode
 * @property array<array-key, mixed> $attributes
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @property-read mixed $op_mode_label
 * @property-read mixed $table_name_label
 * @property-read mixed $user_name_label
 * @method static \Database\Factories\ChangeLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereOpMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog wherePrimaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereRevisionIdApplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereRevisionIdBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChangeLog whereUserId($value)
 */
	class ChangeLog extends \Eloquent {}
}

namespace App\Models{
/**
 * 市区町村モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $pref_code
 * @property string $city_code_5
 * @property string $city_code_6
 * @property string $city_name
 * @property string $city_yomi_katakana
 * @property string $has_takashio
 * @property string $has_harou
 * @property string $has_power_outage
 * @property string|null $pref_name
 * @property string|null $cc_02
 * @property string|null $cc_03
 * @property string|null $cc_04
 * @property string|null $cc_05
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\CityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCc02($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCc03($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCc04($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCc05($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCityCode6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCityYomiKatakana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereHasHarou($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereHasPowerOutage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereHasTakashio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City wherePrefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City wherePrefName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * 気象警報(H27)モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $city_code_5
 * @property string|null $city_name
 * @property \Illuminate\Support\Carbon|null $reported_at
 * @property string|null $has_active_alert
 * @property array<array-key, mixed>|null $data
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\CityWeather27AlertFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereHasActiveAlert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereReportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CityWeather27Alert whereUpdatedAt($value)
 */
	class CityWeather27Alert extends \Eloquent {}
}

namespace App\Models{
/**
 * 受信者モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $city_code_5
 * @property string $reg_type
 * @property string|null $uniq_email
 * @property string|null $uniq_sms
 * @property string|null $city_name
 * @property string|null $name
 * @property string|null $email
 * @property string|null $email_alt
 * @property string $email_verified
 * @property string $email_receive
 * @property \Illuminate\Support\Carbon|null $email_status_at
 * @property string|null $email_status_desc
 * @property string|null $sms
 * @property string $sms_verified
 * @property string $sms_receive
 * @property \Illuminate\Support\Carbon|null $sms_status_at
 * @property string|null $sms_status_desc
 * @property string|null $fax
 * @property string $fax_verified
 * @property string $fax_receive
 * @property \Illuminate\Support\Carbon|null $fax_status_at
 * @property string|null $fax_status_desc
 * @property string|null $tel
 * @property string $tel_verified
 * @property string $tel_receive
 * @property \Illuminate\Support\Carbon|null $tel_status_at
 * @property string|null $tel_status_desc
 * @property string|null $tel_verifiy_call_completed
 * @property string|null $line_user_id
 * @property string $line_receive
 * @property \App\Enum\ApiType|null $api_type
 * @property string|null $api_url
 * @property string $is_non_resident
 * @property string $is_test_user
 * @property string $is_no_charge_user
 * @property string|null $auth_key
 * @property string $active
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $api_type_text
 * @property-read mixed $item_title
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereApiType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereApiUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAuthKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmailAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmailReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmailStatusAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmailStatusDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmailVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFaxReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFaxStatusAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFaxStatusDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFaxVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereIsNoChargeUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereIsNonResident($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereIsTestUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLineReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLineUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereRegType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSmsReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSmsStatusAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSmsStatusDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSmsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelStatusAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelStatusDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTelVerifiyCallCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUniqEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUniqSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * 利用者別配信状況モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $alert_message_id
 * @property int $client_id
 * @property int $client_delivery_status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\ClientAlertMessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereAlertMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereClientDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientAlertMessage whereUpdatedAt($value)
 */
	class ClientAlertMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * 受信簿モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $client_id
 * @property int $yymm
 * @property string $city_code_5
 * @property int $alert_message_id
 * @property array<array-key, mixed>|null $channels
 * @property \Illuminate\Support\Carbon|null $send_at
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\ClientInboxFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereAlertMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereChannels($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientInbox whereYymm($value)
 */
	class ClientInbox extends \Eloquent {}
}

namespace App\Models{
/**
 * 配信指示モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property int $delivery_job_id
 * @property string $city_code_5
 * @property int $client_id
 * @property int $alert_message_id
 * @property string $is_test
 * @property \App\Enum\DeliveryStatus $delivery_status
 * @property int $progress
 * @property \App\Enum\Channel $channel
 * @property string|null $sub_type
 * @property string $sendto
 * @property \Illuminate\Support\Carbon|null $send_request_at
 * @property \Illuminate\Support\Carbon|null $success_at
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $failed_at
 * @property string|null $result_code
 * @property string|null $result_message
 * @property int $retry_count
 * @property string|null $retry_key
 * @property float|null $unit_price
 * @property int|null $qty
 * @property int|null $busy_seconds
 * @property float|null $amount
 * @property string $charge_flg
 * @property string $balanced_flg
 * @property string $no_charge_flg
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\DeliveryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereAlertMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereBalancedFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereBusySeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereChargeFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereDeliveryJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereIsTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereNoChargeFlg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereResultCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereRetryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereRetryKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereSendRequestAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereSendto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereSubType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereSuccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Delivery whereYymm($value)
 */
	class Delivery extends \Eloquent {}
}

namespace App\Models{
/**
 * 配信ジョブモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $priority
 * @property \App\Enum\DeliveryJobStatus $delivery_job_status
 * @property \App\Enum\Channel $channel
 * @property int $number_of_client
 * @property string|null $result_code
 * @property string|null $result_message
 * @property int $retry_count
 * @property \Illuminate\Support\Carbon|null $deliver_start_at
 * @property \Illuminate\Support\Carbon|null $deliver_success_at
 * @property \Illuminate\Support\Carbon|null $deliver_failed_at
 * @property \Illuminate\Support\Carbon $open_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\DeliveryJobFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereDeliverFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereDeliverStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereDeliverSuccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereDeliveryJobStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereNumberOfClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereOpenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereResultCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereRetryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryJob whereUpdatedAt($value)
 */
	class DeliveryJob extends \Eloquent {}
}

namespace App\Models{
/**
 * JMAの地域階層モデルのオブジェクト定義
 *
 * @property int $id
 * @property string $jma_area1_code
 * @property string $jma_area1_name
 * @property string $jma_area2_code
 * @property string $jma_area2_name
 * @property string $jma_area3_code
 * @property string $jma_area3_name
 * @property string $jma_area4_code
 * @property string $jma_area4_name
 * @property string $jma_area5_code
 * @property string $jma_area5_name
 * @property string|null $city_names
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\JmaAreaCodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereCityNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea1Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea1Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea2Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea2Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea3Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea3Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea4Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea4Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea5Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereJmaArea5Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JmaAreaCode whereUpdatedAt($value)
 */
	class JmaAreaCode extends \Eloquent {}
}

namespace App\Models{
/**
 * LINE配信指示モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $delivery_job_id
 * @property int $delivery_status
 * @property int $progress
 * @property int $yymm
 * @property string $city_code_5
 * @property int $alert_message_id
 * @property array<array-key, mixed> $client_ids
 * @property string $is_test
 * @property array<array-key, mixed> $line_ids
 * @property int $chunk
 * @property int $number_of_client
 * @property int $retry_count
 * @property string|null $retry_key
 * @property \Illuminate\Support\Carbon|null $send_request_at
 * @property \Illuminate\Support\Carbon|null $success_at
 * @property \Illuminate\Support\Carbon|null $failed_at
 * @property string|null $result_code
 * @property string|null $result_message
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\LineDeliveryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereAlertMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereChunk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereClientIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereDeliveryJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereDeliveryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereIsTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereLineIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereNumberOfClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereResultCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereRetryCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereRetryKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereSendRequestAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereSuccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineDelivery whereYymm($value)
 */
	class LineDelivery extends \Eloquent {}
}

namespace App\Models{
/**
 * ユーザーアクセスログモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property int|null $user_id
 * @property string|null $route
 * @property string|null $domain
 * @property string $url
 * @property string $method
 * @property int $status
 * @property string|null $message
 * @property string $remote_addr
 * @property string $user_agent
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read mixed $item_title
 * @property-read mixed $user_name_label
 * @method static \Database\Factories\MirAuditLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirAuditLog whereYymm($value)
 */
	class MirAuditLog extends \Eloquent {}
}

namespace App\Models{
/**
 * アプリログモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property int|null $user_id
 * @property string|null $instance
 * @property string|null $channel
 * @property string|null $level
 * @property string|null $level_name
 * @property string|null $message
 * @property string|null $context
 * @property int|null $remote_addr
 * @property string|null $user_agent
 * @property string|null $http_host
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read mixed $ip_address_label
 * @property-read mixed $item_title
 * @property-read mixed $user_name_label
 * @method static \Database\Factories\MirLaravelLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereHttpHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereInstance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereLevelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MirLaravelLog whereYymm($value)
 */
	class MirLaravelLog extends \Eloquent {}
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
 * 監視警告モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property string $module
 * @property string|null $data_key
 * @property \App\Enum\MonitorWarningCode $warning_code
 * @property string|null $url
 * @property string|null $detail
 * @property string $reported
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\MonitorWarningFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereDataKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereReported($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereWarningCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MonitorWarning whereYymm($value)
 */
	class MonitorWarning extends \Eloquent {}
}

namespace App\Models{
/**
 * 停電情報モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property string $yymmddhhmiss
 * @property string $city_code_tepco
 * @property string $city_code_5
 * @property string $city_name
 * @property int $outage_count
 * @property int $source_html_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereCityCodeTepco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereOutageCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereSourceHtmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereYymm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PowerOutage whereYymmddhhmiss($value)
 */
	class PowerOutage extends \Eloquent {}
}

namespace App\Models{
/**
 * 処理するURLモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property string $module
 * @property \App\Enum\DataTypeCode $data_type_code
 * @property string $url
 * @property string $is_processed
 * @property \Illuminate\Support\Carbon $data_updated_at
 * @property \Illuminate\Support\Carbon|null $data_processed_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\QueuedUrlFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereDataProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereDataTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereDataUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereIsProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QueuedUrl whereYymm($value)
 */
	class QueuedUrl extends \Eloquent {}
}

namespace App\Models{
/**
 * 配信抑止モデルのオブジェクト定義
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $skip_start_at
 * @property \Illuminate\Support\Carbon $skip_end_at
 * @property array<array-key, mixed>|null $skip_channels
 * @property string $city_code_5
 * @property string|null $memo
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Database\Factories\SkipTimeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereSkipChannels($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereSkipEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereSkipStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkipTime whereUserId($value)
 */
	class SkipTime extends \Eloquent {}
}

namespace App\Models{
/**
 * 証拠HTMLモデルのオブジェクト定義
 *
 * @property int $id
 * @property int $yymm
 * @property string $html
 * @property string|null $json
 * @property string $url
 * @property string $module
 * @property string $data_key
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $item_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereDataKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SourceHtml whereYymm($value)
 */
	class SourceHtml extends \Eloquent {}
}

namespace App\Models{
/**
 * 購読モデルのオブジェクト定義
 *
 * @property int $id
 * @property int $client_id
 * @property \App\Enum\AlertCode $alert_code
 * @property string $city_code_5
 * @property string $send_email
 * @property string $send_fax
 * @property string $send_sms
 * @property string $send_tel
 * @property string $send_line
 * @property string $send_api
 * @property string $active
 * @property string $dryrun
 * @property array<array-key, mixed>|null $alert_kind_settings
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $alert_kind_settings_json_string
 * @property-read mixed $item_title
 * @method static \Database\Factories\SubscriptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereAlertCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereAlertKindSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereCityCode5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereDryrun($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereSendTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereUpdatedAt($value)
 */
	class Subscription extends \Eloquent {}
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
 * @property int $role
 * @property-read mixed $is_admin
 * @property-read mixed $item_title
 * @property-read mixed $role_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

