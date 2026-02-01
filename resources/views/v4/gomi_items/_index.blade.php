{{-- GomiItemV4Controller.php --}}

{{-- ごみ分別 一覧表示用テーブル --}}

@php
    $route = 'r4.gomi_items.index';
    if (isset($is_livewire)) {
        $route = 'r4.gomi_items.index_live';
    }
@endphp

{{-- インデックス上部のタブ --}}
@relativeInclude('_index_tab')

@forelse ($gomi_items as $gomi_item)
  @if ($loop->first)
    {{-- テーブル開く --}}
    <div class="table-responsive">
      <table class="table table-responsive table-bordered">
        <thead>
          <tr class="table-success">
            <th nowrap>ID <x-ui.sort-arrow column="id" :conds="$conds" :route="$route" /></th>
            <th nowrap>品目 <x-ui.sort-arrow column="nm" :conds="$conds" :route="$route" /></th>
            <th nowrap>詳細 <x-ui.sort-arrow column="dt" :conds="$conds" :route="$route" /></th>
            <th nowrap>大きさ・長さ <x-ui.sort-arrow column="sz" :conds="$conds" :route="$route" /></th>
            <th nowrap>分別品目 <x-ui.sort-arrow column="gtp" :conds="$conds" :route="$route" /></th>
            <th nowrap>処理手数料 <x-ui.sort-arrow column="fe" :conds="$conds" :route="$route" /></th>
            <th nowrap>更新日時 <x-ui.sort-arrow column="uat" :conds="$conds" :route="$route" /></th>
        </thead>
        <tbody>
  @endif

  {{-- 情報を１件表示 --}}
  @php
    // TODO: show を実装しない場合は除去する
    $href = route('r4.gomi_items.edit', array_merge($conds, ['gomi_item' => $gomi_item]));
  @endphp
  <tr>
    <td nowrap><a href="{{ $href }}">{{ $gomi_item->id }}</a></td>
    <td>{{ $gomi_item->name }}</td>
    <td>{{ $gomi_item->detail }}</td>
    <td>{{ $gomi_item->size }}</td>
    <td>{{ $gomi_item->gomi_type }}</td>
    <td>{{ $gomi_item->fee }}</td>
    <td nowrap>{!! MirUtil::hilightDt($gomi_item->updated_at) !!}</td>

  </tr>

  {{-- テーブル閉じる --}}
  @if ($loop->last)
    </tbody>
    </table>
    </div>
  @endif

@empty

  {{-- 見つからなかった --}}
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">条件に合うごみ分別は見つかりません。</h4>
    </div>
  </div>
@endforelse
