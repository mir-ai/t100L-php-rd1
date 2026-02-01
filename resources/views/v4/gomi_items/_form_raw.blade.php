{{-- GomiItemV4Controller.php --}}

{{-- ごみ分別 編集フォーム(直接編集) --}}

<div class="mt-4">

  {{-- 検索条件を次に引き継ぐhiddenタグ --}}
  <x-form.conds-to-hidden :conds="$conds" />

  @php
    // 直接編集編集項目
    $column_kvs = [
        'kana1' => '行',
        'name' => '品目',
        'detail' => '詳細',
        'size' => '大きさ・長さ',
        'gomi_type' => '分別品目',
        'fee' => '処理手数料',
        'description' => '連絡ごみ備考',
        'howto' => '排出方法･備考',
        'words' => 'URLに関連するワード',
        'url' => '浜松市公式Webサイト 参考ページURL',
        'memo' => '分別品目の補足',
        'created_at' => '登録日時',
        'updated_at' => '更新日時'
    ];
  @endphp

  {{-- 直接編集フォーム --}}
  @foreach ($column_kvs as $key => $label) 
    <x-input.open :key="$key" :label="$label" class="lg-1" />
    @php
      $v = $announcement[$key] ?? '';
      if (is_array($v)) {
        $v = json_encode($v);
      }
    @endphp
    <x-input.text :key="$key" :default="old($key, $v)" class="form-control-lg" />
    <x-input.close :key="$key" :desc="$key" />
  @endforeach

  <div class="mt-4 mb-2">
    <x-input.submit-back :label="$submitButton" :backUrl="$back_url ?? ''" class="btn-lg" />
  </div>

</div>
