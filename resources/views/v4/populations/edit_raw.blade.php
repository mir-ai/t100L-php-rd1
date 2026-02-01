{{-- PopulationV4Controller.php --}}

@extends('layouts.app')

@section('js')
  @relativeInclude('_javascripts')
  <x-js.js-input-len-count />
@endsection

{{-- 人口編集フォーム --}}
@section('content')

  {{-- 水平ナビ --}}
  @include('_inc.hnav')
  {{-- SUB_NAVI --}}

  {{-- 件名 --}}
  <h2 class="miraie5">
    <x-headline.back :href="route('r4.populations.last_conds')" />
    {{ $population->ItemTitle }}の直接編集
  </h2>

  {{-- フォーム本体 --}}
  <x-form.open id="form_population" method="PATCH" :action="route('r4.populations.update_raw', ['population' => $population])" class="" />
  @relativeInclude('_form_raw', ['submitButton' => '保存', 'back_url' => route('r4.populations.last_conds')])
  <x-form.close />

  {{-- 削除ボタン --}}
  <div class="row mt-5">
    <div class="col"></div>
    <div class="col-auto">
      <x-button.destroy :url="route('r4.populations.destroy', ['population' => $population])" class="btn-lg" label="この人口を削除" />
    </div>
  </div>  
@endsection
