@extends('layouts.app')

@section('content')
  <h2 class="miraie5">{{ $label }}アップロードエラー</h2>

  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-sm-6 mt-4">
          <a href="{{ $back }}"
            class="btn btn-warning form-control btn-lg">戻る</a>
        </div>
        <div class="col-sm-6 mt-4">
          <a href="{{ $back }}"
            class="btn btn-success form-control btn-lg">再アップロード</a>
        </div>
        <div class="col-sm-6">
        </div>
      </div>

      <p class="text-danger">
        以下のエラーが見つかりました。ファイルを修正して、またアップロードして下さい。
      </p>

      <ul class="text-danger">

        @foreach ($errors as $k => $v)
          @php
            [$y, $x] = explode(',', $k);
          @endphp
          <li>{{ $y }}行目{{ $x }}カラム目: {{ $v }}</li>
        @endforeach
      </ul>

      <div class="row mb-4">
        <div class="col-sm-6">
          <a href="{{ $back }}"
            class="btn btn-warning form-control">戻る</a>
        </div>
        <div class="col-sm-6">
          <a href="{{ $back }}"
            class="btn btn-success form-control">再アップロード</a>
        </div>
        <div class="col-sm-6">
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <tbody>
            @for ($y = 0; $y < count($uploaded_matrix); $y++)
              @if (str_starts_with($uploaded_matrix[$y][0] ?? '', '##'))
                @continue
              @endif
              <tr>
                @for ($x = 0; $x < count($uploaded_matrix[$y]); $x++)
                  @if (!empty($errors["{$y},{$x}"]))
                    <td class="table-danger">
                      {{ $uploaded_matrix[$y][$x] }}<br />
                      <small class="text-danger">{{ $errors["{$y},{$x}"] }}</small>
                    </td>
                  @else
                    <td>
                      {{ $uploaded_matrix[$y][$x] }}
                    </td>
                  @endif
                @endfor
              </tr>
            @endfor
          </tbody>
        </table>
      </div>

    </div>
  </div>

@endsection
