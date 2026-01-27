@props([''])

@auth
  <x-dropdown.dropdown-link href="/" label="ゲスト用トップ" />

  @if (Auth::user())
    <x-dropdown.dropdown-link :href="route('r4.alert_messages.index')" label="警報メッセージ" />
    <x-dropdown.dropdown-link :href="route('r4.monitor_warnings.index')" label="監視警告" />
    <x-dropdown.dropdown-link :href="route('r4.alerts.index')" label="警報マスタ" />
    <x-dropdown.dropdown-link :href="route('r4.clients.index')" label="受信者" />
    <x-dropdown.dropdown-link :href="route('r4.subscriptions.index')" label="購読" />
    <x-dropdown.dropdown-link :href="route('r4.deliveries.index')" label="配信指示" />
    <x-dropdown.dropdown-link :href="route('r4.line_deliveries.index')" label="LINE配信指示" />
    <x-dropdown.dropdown-link :href="route('r4.client_inboxes.index')" label="受信簿" />
    <x-dropdown.dropdown-link :href="route('r4.skip_times.index')" label="配信抑止" />
    <x-dropdown.dropdown-link :href="route('r4.delivery_jobs.index')" label="配信ジョブ" />
    <x-dropdown.dropdown-link :href="route('r4.client_alert_messages.index')" label="利用者別配信状況" />
    <x-dropdown.dropdown-link :href="route('r4.cities.index')" label="市区町村" />
    <x-dropdown.dropdown-link :href="route('r4.jma_area_codes.index')" label="JMA地域階層" />
    <x-dropdown.dropdown-link :href="route('r4.area_cities.index')" label="地域階層と市区町村連携" />
    <x-dropdown.dropdown-link :href="route('r4.city_weather27_alerts.index')" label="市区町村の気象警報(H27)" />
    
  @endif
@endauth

<div class="dropdown-divider"></div>

<x-dropdown.dropdown-link :href="route('r4.my.edit_password')" label="パスワード変更" />
