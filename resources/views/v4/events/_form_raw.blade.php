{{-- EventV4Controller.php --}}

{{-- イベント 編集フォーム(直接編集) --}}

<div class="mt-4">

  {{-- 検索条件を次に引き継ぐhiddenタグ --}}
  <x-form.conds-to-hidden :conds="$conds" />

  @php
    // 直接編集編集項目
    $column_kvs = [
        'pref_code' => '都道府県コード又は市区町村コード',
        'record_id' => 'NO',
        'pref_name' => '都道府県名',
        'city_name' => '市区町村名',
        'event_name' => 'イベント名',
        'event_kana' => 'イベント名_カナ',
        'event_en' => 'イベント名_英語',
        'start_date' => '開始日',
        'end_date' => '終了日',
        'start_time' => '開始時間',
        'end_time' => '終了時間',
        'start_memo' => '開始日時特記事項',
        'description' => '説明',
        'fee_basic' => '料金(基本)',
        'fee_detail' => '料金(詳細)',
        'contact_name' => '連絡先名称',
        'contact_tel' => '連絡先電話番号',
        'contact_tel_ext' => '連絡先内線番号',
        'organizer' => '主催者',
        'location_name' => '場所名称',
        'address' => '住所',
        'address2' => '方書',
        'lat' => '緯度',
        'lng' => '経度',
        'access' => 'アクセス方法',
        'parking' => '駐車場情報',
        'capacity' => '定員',
        'entry_due_date' => '参加申込終了日',
        'entry_due_time' => '参加申込終了時間',
        'entry_method' => '参加申込方法',
        'entry_url' => 'URL',
        'memo' => '備考',
        'category' => 'カテゴリー',
        'ward_name' => '区',
        'open_date' => '公開日',
        'update_date' => '更新日',
        'is_childcare' => '子育て情報',
        'location_no' => '施設No.',
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
