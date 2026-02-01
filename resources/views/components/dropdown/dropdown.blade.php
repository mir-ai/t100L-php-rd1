@props([''])

@auth
  <x-dropdown.dropdown-link href="/" label="ゲスト用トップ" />

  @if (Auth::user())
    <x-dropdown.dropdown-link :href="route('r4.samples.index')" label="サンプル" />
    <x-dropdown.dropdown-link :href="route('r4.gomi_items.index')" label="ごみ分別" />
    <x-dropdown.dropdown-link :href="route('r4.populations.index')" label="地区・人口" />

    
  @endif
@endauth

<div class="dropdown-divider"></div>

