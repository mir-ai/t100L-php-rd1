{{-- PopulationV4Controller.php --}}

{{-- 人口 一覧表示用テーブル --}}

@php
    $route = 'r4.populations.index';
    if (isset($is_livewire)) {
        $route = 'r4.populations.index_live';
    }
@endphp

{{-- インデックス上部のタブ --}}
@relativeInclude('_index_tab')

@forelse ($populations as $population)
  @if ($loop->first)
    {{-- テーブル開く --}}
    <div class="table-responsive">
      <table class="table table-responsive table-bordered">
        <thead>
          <tr class="table-success">
            <th nowrap>ID <x-ui.sort-arrow column="id" :conds="$conds" :route="$route" /></th>
            <th nowrap>区 <x-ui.sort-arrow column="wnm" :conds="$conds" :route="$route" /></th>
            <th nowrap>大字 <x-ui.sort-arrow column="onm" :conds="$conds" :route="$route" /></th>
            <th nowrap>年齢 <x-ui.sort-arrow column="ag" :conds="$conds" :route="$route" /></th>
            <th nowrap>合計 <x-ui.sort-arrow column="tct" :conds="$conds" :route="$route" /></th>
            <th nowrap>男性 <x-ui.sort-arrow column="mct" :conds="$conds" :route="$route" /></th>
            <th nowrap>女性 <x-ui.sort-arrow column="fct" :conds="$conds" :route="$route" /></th>
            <th nowrap>登録日時 <x-ui.sort-arrow column="cat" :conds="$conds" :route="$route" /></th>
            <th nowrap>更新日時 <x-ui.sort-arrow column="uat" :conds="$conds" :route="$route" /></th>
        </thead>
        <tbody>
  @endif

  {{-- 情報を１件表示 --}}
  @php
    // TODO: show を実装しない場合は除去する
    $href = route('r4.populations.edit', array_merge($conds, ['population' => $population]));
  @endphp
  <tr>
    <td nowrap><a href="{{ $href }}">{{ $population->id }}</a></td>
    <td>{{ $population->ward_name }}</td>
    <td>{{ $population->oaza_name }}</td>
    <td nowrap>{{ $population->age }}</td>
    <td nowrap>{{ $population->total_count }}</td>
    <td nowrap>{{ $population->male_count }}</td>
    <td nowrap>{{ $population->female_count }}</td>
    <td nowrap>{!! MirUtil::hilightDt($population->created_at) !!}</td>
    <td nowrap>{!! MirUtil::hilightDt($population->updated_at) !!}</td>

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
      <h4 class="card-title">条件に合う人口は見つかりません。</h4>
    </div>
  </div>
@endforelse
