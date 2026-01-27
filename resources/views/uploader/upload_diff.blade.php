@extends('layouts.app')

@section('content')
  <h2 class="miraie5">{{ $label }} アップロード 変更点</h2>

  <div class="alert alert-warning" role="alert">
    まだ保存されていません。差分を確認して「保存」を押して下さい。
  </div>

  <p class="text-secondary">現在の登録内容とアップロードされたファイルとの差分を表示します。黒字は変更なし。緑字は追加、赤字は削除。黒背景の行は削除を意味します。</p>

  <div class="row mt-3">
    <div class="col-lg-12">

      @relativeInclude('_upload_diff_control')

      <x-ui.matrix-diff :$row_keys :$col_keys :$col_names :$row_col_keys1 :$row_col_keys2 />

      @relativeInclude('_upload_diff_control')

    </div>
  </div>
@endsection
