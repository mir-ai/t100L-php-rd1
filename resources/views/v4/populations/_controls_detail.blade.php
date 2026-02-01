{{-- PopulationV4Controller.php --}}

{{-- $show_edit_button --}}
{{-- $show_delete_button --}}
{{-- $show_date_range --}}

@php
  if (Route::has('r4.populations.edit')) {
    $edit_href = route('r4.populations.edit', ['population' => $population]);
  }

  if (Route::has('r4.populations.edit_raw')) {
    $edit_raw_href = route('r4.populations.edit_raw', ['population' => $population]);
  }

  if (Route::has('r4.populations.destroy')) {
    $destroy_href = route('r4.populations.destroy', ['population' => $population]);
  }

  // 左ナビ表示の場合はリンク先を変える
  if (isset($is_lnav)) {
    $edit_href = route('r4.populations.lnav', ['population' => $population, 'edit_mode' => 'edit'], $conds);
  }
@endphp

<div class="row mb-2">
  <div class="col">
  </div>
  @if ($show_edit_button ?? false)
    @if ($edit_raw_href ?? false)
      @can('update_raw', $population)
        <div class="col-auto">
          <a href="{{ $edit_raw_href }}" class="btn btn-outline-danger">直接編集</a>
        </div>
      @endif
    @endif

    @if ($edit_href ?? false)
      <div class="col-auto">
        <a href="{{ $edit_href }}" class="btn btn-success">編集</a>
      </div>
    @endif
  @endif
</div>

@if (($show_delete_button ?? false) && ($destroy_href ?? false))
  <div class="row mt-5">
    <div class="col">
    </div>
    <div class="col-auto">
      <x-button.destroy :url="$destroy_href" class="" label="この人口を削除" />
    </div>
  </div>
@endif
