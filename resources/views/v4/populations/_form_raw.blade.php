{{-- PopulationV4Controller.php --}}

{{-- 人口 編集フォーム(直接編集) --}}

<div class="mt-4">

  {{-- 検索条件を次に引き継ぐhiddenタグ --}}
  <x-form.conds-to-hidden :conds="$conds" />

  @php
    // 直接編集編集項目
    $column_kvs = [
        'pref_code' => '都道府県コード又は市区町村コード',
        'pref_name' => '都道府県',
        'city_name' => '市区町村名',
        'yyyymm' => '対象年月',
        'ward_code' => '区CD',
        'ward_name' => '区',
        'district_name' => '地区',
        'oaza_code' => '大字CD',
        'oaza_name' => '大字',
        'age' => '年齢',
        'total_count' => '合計',
        'male_count' => '男性',
        'female_count' => '女性',
        'description' => '備考',
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
