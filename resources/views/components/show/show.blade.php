@props(['value'])

@if ($value instanceof \UnitEnum)
  {{-- enumは値を表示 --}}
  {!! $value->value ?? '' !!}
@elseif (is_array($value))
  {{-- 配列はJSONにして表示 --}}
  {!! json_encode($value, JSON_UNESCAPED_UNICODE) !!}
@else
  {{-- 通常変数 --}}
  {!! $value ?? '' !!}
@endif
