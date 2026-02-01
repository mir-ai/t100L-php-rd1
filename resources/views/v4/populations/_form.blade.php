{{-- PopulationV4Controller.php --}}

{{-- 人口 登録・編集フォーム --}}

{{-- 検索条件を次に引き継ぐhiddenタグ --}}
<x-form.conds-to-hidden :conds="$conds" />

<div class="mt-4 lg-1">
{{-- 都道府県コード又は市区町村コード --}}
<x-input.open key="pref_code" label="都道府県コード又は市区町村コード" required="N" />
<x-input.text key="pref_code" :default="old('pref_code', $population->pref_code ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="pref_code" desc="都道府県コード又は市区町村コードを入力します。" maxlen="16" />

{{-- 都道府県 --}}
<x-input.open key="pref_name" label="都道府県" required="N" />
<x-input.text key="pref_name" :default="old('pref_name', $population->pref_name ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="pref_name" desc="都道府県を入力します。" maxlen="16" />

{{-- 市区町村名 --}}
<x-input.open key="city_name" label="市区町村名" required="N" />
<x-input.text key="city_name" :default="old('city_name', $population->city_name ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="city_name" desc="市区町村名を入力します。" maxlen="16" />

{{-- 対象年月 --}}
<x-input.open key="yyyymm" label="対象年月" required="N" />
<x-input.text key="yyyymm" :default="old('yyyymm', $population->yyyymm ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="yyyymm" desc="対象年月を入力します。" maxlen="16" />

{{-- 区CD --}}
<x-input.open key="ward_code" label="区CD" required="N" />
<x-input.text key="ward_code" :default="old('ward_code', $population->ward_code ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="ward_code" desc="区CDを入力します。" maxlen="" />

{{-- 区 --}}
<x-input.open key="ward_name" label="区" required="N" />
<x-input.text key="ward_name" :default="old('ward_name', $population->ward_name ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="ward_name" desc="区を入力します。" maxlen="16" />

{{-- 地区 --}}
<x-input.open key="district_name" label="地区" required="N" />
<x-input.text key="district_name" :default="old('district_name', $population->district_name ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="district_name" desc="地区を入力します。" maxlen="16" />

{{-- 大字CD --}}
<x-input.open key="oaza_code" label="大字CD" required="N" />
<x-input.text key="oaza_code" :default="old('oaza_code', $population->oaza_code ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="oaza_code" desc="大字CDを入力します。" maxlen="" />

{{-- 大字 --}}
<x-input.open key="oaza_name" label="大字" required="N" />
<x-input.text key="oaza_name" :default="old('oaza_name', $population->oaza_name ?? '')" maxlen="16" class="form-control-lg" />
<x-input.close key="oaza_name" desc="大字を入力します。" maxlen="16" />

{{-- 年齢 --}}
<x-input.open key="age" label="年齢" required="N" />
<x-input.text key="age" :default="old('age', $population->age ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="age" desc="年齢を入力します。" maxlen="" />

{{-- 合計 --}}
<x-input.open key="total_count" label="合計" required="N" />
<x-input.text key="total_count" :default="old('total_count', $population->total_count ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="total_count" desc="合計を入力します。" maxlen="" />

{{-- 男性 --}}
<x-input.open key="male_count" label="男性" required="N" />
<x-input.text key="male_count" :default="old('male_count', $population->male_count ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="male_count" desc="男性を入力します。" maxlen="" />

{{-- 女性 --}}
<x-input.open key="female_count" label="女性" required="N" />
<x-input.text key="female_count" :default="old('female_count', $population->female_count ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="female_count" desc="女性を入力します。" maxlen="" />

{{-- 備考 --}}
<x-input.open key="description" label="備考" required="N" />
<x-input.text key="description" :default="old('description', $population->description ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="description" desc="備考を入力します。" maxlen="" />


  <div class="mt-4 mb-2">
    <x-input.submit-back :label="$submitButton" :backUrl="$back_url ?? ''" class="btn-lg" />
  </div>

</div>
