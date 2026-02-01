{{-- GomiItemV4Controller.php --}}

@extends('layouts.app')

@section('js')
  @relativeInclude('_javascripts')
@endsection

{{-- ごみ分別情報一覧表示画面 --}}
@section('content')

  {{-- 水平ナビ --}}
  @include('_inc.hnav')
  {{-- SUB_NAVI --}}

  {{-- 件名 --}}
  <h2 class="miraie5">ごみ分別</h2>
  <p class="text-secondary">ごみ品目の分類データです。</p>

  {{-- 検索ボックス、登録・ダウンロード・アップロードボタン --}}
  @relativeInclude('_controls_index')

  {{-- ページネーション --}}
  <div class="row d-flex justify-content-center">
    <div class="col col-auto">
      <div class="text-center">{{ $gomi_items->links() }}</div>
    </div>
  </div>

  {{-- 一覧表示テーブル本体 --}}
  @relativeInclude('_index')

  {{-- ページネーション --}}
  <div class="row d-flex justify-content-center">
    <div class="col col-auto">
      <div class="text-center">{{ $gomi_items->links() }}</div>
    </div>
  </div>
@endsection
