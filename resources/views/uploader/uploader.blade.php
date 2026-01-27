@extends('layouts.app')

@section('content')
  <h2 class="miraie5">{{ $label }} ファイルアップロード</h2>

  <div class="row">
    <div class="col-lg-12">
      <x-form.open :action="$next" method="POST" class="form-horizontal" enctype="multipart/form-data" />
      @csrf

      <label for="{{ $input }}" class="form-label mt-2">
        <p><span class="text-danger">{{ $prefix }}</span>で始まる、{{ $label }}のファイルをアップロードします。</p>
      </label>

      <input class="form-control form-control-lg" type="file" id="{{ $input }}" name="{{ $input }}" accept=".xls,.xlsx">

      <p class="text-secondary mt-1">※ 直前にエクセルをダウンロードして、それを修正してアップロードして下さい。（そうしないと、誰かの別の変更が上書きされてしまう恐れがあります。）</p>

      <div class="row mt-5">
        <div class="col-sm-9 order-sm-2">
          <button class="btn btn-success form-control btn-lg mb-3">アップロード</button>
        </div>
        <div class="col-sm-3 order-sm-1">
          <a href="{{ $back }}" class="btn btn-warning form-control btn-lg mb-3">戻る</a>
        </div>
      </div>

      <x-form.close />
    </div>
  </div>
@endsection
