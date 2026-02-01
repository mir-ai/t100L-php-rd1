{{-- GomiItemV4Controller.php --}}

{{-- $show_edit_button --}}
{{-- $show_delete_button --}}
{{-- $show_date_range --}}

@php
  if (Route::has('r4.gomi_items.edit')) {
    $edit_href = route('r4.gomi_items.edit', ['gomi_item' => $gomi_item]);
  }

  if (Route::has('r4.gomi_items.edit_raw')) {
    $edit_raw_href = route('r4.gomi_items.edit_raw', ['gomi_item' => $gomi_item]);
  }

  if (Route::has('r4.gomi_items.destroy')) {
    $destroy_href = route('r4.gomi_items.destroy', ['gomi_item' => $gomi_item]);
  }

  // 左ナビ表示の場合はリンク先を変える
  if (isset($is_lnav)) {
    $edit_href = route('r4.gomi_items.lnav', ['gomi_item' => $gomi_item, 'edit_mode' => 'edit'], $conds);
  }
@endphp

<div class="row mb-2">
  <div class="col">
  </div>
  @if ($show_edit_button ?? false)
    @if ($edit_raw_href ?? false)
      @can('update_raw', $gomi_item)
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
      <x-button.destroy :url="$destroy_href" class="" label="このごみ分別を削除" />
    </div>
  </div>
@endif
