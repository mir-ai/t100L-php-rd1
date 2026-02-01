{{-- EventV4Controller.php --}}

@extends('layouts.app')

@section('js')
  @relativeInclude('_javascripts')
  <x-js.js-input-len-count />
@endsection

{{-- イベント情報作成用フォーム表示画面 --}}
@section('content')

  {{-- 水平ナビ --}}
  @include('_inc.hnav')
  {{-- SUB_NAVI --}}

  {{-- 件名 --}}
  <h2 class="miraie5">
    <x-headline.back :href="route('r4.events.last_conds')" />
    新しいイベントを登録
  </h2>

  {{-- フォーム本体 --}}
  {{-- TODO: ファイルをアップロードする場合は enctype="multipart/form-data" をつける --}}
  <x-form.open id="form_event" method="POST" :action="route('r4.events.store')" enctype="" class="" />
  @relativeInclude('_form', ['submitButton' => '保存', 'back_url' => route('r4.events.last_conds')])
  <x-form.close />
@endsection
