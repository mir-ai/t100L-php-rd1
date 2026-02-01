{{-- EventV4Controller.php --}}

@extends('layouts.app')

@section('js')
  @relativeInclude('_javascripts')
  <x-js.js-input-len-count />
@endsection

{{-- イベント編集フォーム --}}
@section('content')

  {{-- 水平ナビ --}}
  @include('_inc.hnav')
  {{-- SUB_NAVI --}}

  {{-- 件名 --}}
  <h2 class="miraie5">
    <x-headline.back :href="route('r4.events.last_conds')" />
    {{ $event->ItemTitle }}の編集
  </h2>

  {{-- フォーム本体 --}}
  {{-- TODO: ファイルをアップロードする場合は enctype="multipart/form-data" をつける --}}
  <x-form.open id="form_event" method="PATCH" :action="route('r4.events.update', ['event' => $event])" enctype="" class="" />
  @relativeInclude('_form', ['submitButton' => '保存', 'back_url' => route('r4.events.last_conds')])
  <x-form.close />

  {{-- 削除ボタン --}}
  @if (Route::has('r4.events.destroy'))
    <div class="row mt-5">
      <div class="col">
      </div>
      <div class="col-auto">
        <x-button.destroy :url="route('r4.events.destroy', ['event' => $event])" class="btn-lg" label="このイベントを削除" />
      </div>
    </div>
  @endif

@endsection
