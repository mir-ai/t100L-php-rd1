{{-- EventV4Controller.php --}}

{{-- イベント 一覧表示用テーブル --}}

@php
    $route = 'r4.events.index';
    if (isset($is_livewire)) {
        $route = 'r4.events.index_live';
    }
@endphp

{{-- インデックス上部のタブ --}}
@relativeInclude('_index_tab')

@forelse ($events as $event)
  @if ($loop->first)
    {{-- テーブル開く --}}
    <div class="table-responsive">
      <table class="table table-responsive table-bordered">
        <thead>
          <tr class="table-success">
            <th nowrap>ID <x-ui.sort-arrow column="id" :conds="$conds" :route="$route" /></th>
            <th nowrap>イベント名 <x-ui.sort-arrow column="enm" :conds="$conds" :route="$route" /></th>
            <th nowrap>開始日 <x-ui.sort-arrow column="stdt" :conds="$conds" :route="$route" /></th>
            <th nowrap>連絡先名称 <x-ui.sort-arrow column="ctnm" :conds="$conds" :route="$route" /></th>
            <th nowrap>登録日時 <x-ui.sort-arrow column="cat" :conds="$conds" :route="$route" /></th>
            <th nowrap>更新日時 <x-ui.sort-arrow column="uat" :conds="$conds" :route="$route" /></th>
        </thead>
        <tbody>
  @endif

  {{-- 情報を１件表示 --}}
  @php
    // TODO: show を実装しない場合は除去する
    $href = route('r4.events.edit', array_merge($conds, ['event' => $event]));
  @endphp
  <tr>
    <td nowrap><a href="{{ $href }}">{{ $event->id }}</a></td>
    <td>{{ $event->event_name }}</td>
    <td nowrap>{{ $event->start_date }}</td>
    <td>{{ $event->contact_name }}</td>
    <td nowrap>{!! MirUtil::hilightDt($event->created_at) !!}</td>
    <td nowrap>{!! MirUtil::hilightDt($event->updated_at) !!}</td>

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
      <h4 class="card-title">条件に合うイベントは見つかりません。</h4>
    </div>
  </div>
@endforelse
