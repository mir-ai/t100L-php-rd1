{{-- PopulationV4Controller.php --}}

{{-- 人口 １件詳細表示フォーム --}}

        <div class="card mb-4">
          <div class="card-body">
            <div class="fs-5 mb-3 fw-bold">詳細情報</div>
        {{-- NO  --}}
        <x-show.open class="ms-5" label="NO" />
        <x-show.show :value="$population->id" /> 
        <x-show.close  />

        {{-- 都道府県コード又は市区町村コード  --}}
        <x-show.open class="ms-5" label="都道府県コード又は市区町村コード" />
        <x-show.show :value="$population->pref_code" /> 
        <x-show.close  />

        {{-- 都道府県  --}}
        <x-show.open class="ms-5" label="都道府県" />
        <x-show.show :value="$population->pref_name" /> 
        <x-show.close  />

        {{-- 市区町村名  --}}
        <x-show.open class="ms-5" label="市区町村名" />
        <x-show.show :value="$population->city_name" /> 
        <x-show.close  />

        {{-- 対象年月  --}}
        <x-show.open class="ms-5" label="対象年月" />
        <x-show.show :value="$population->yyyymm" /> 
        <x-show.close  />

        {{-- 区CD  --}}
        <x-show.open class="ms-5" label="区CD" />
        <x-show.show :value="$population->ward_code" /> 
        <x-show.close  />

        {{-- 区  --}}
        <x-show.open class="ms-5" label="区" />
        <x-show.show :value="$population->ward_name" /> 
        <x-show.close  />

        {{-- 地区  --}}
        <x-show.open class="ms-5" label="地区" />
        <x-show.show :value="$population->district_name" /> 
        <x-show.close  />

        {{-- 大字CD  --}}
        <x-show.open class="ms-5" label="大字CD" />
        <x-show.show :value="$population->oaza_code" /> 
        <x-show.close  />

        {{-- 大字  --}}
        <x-show.open class="ms-5" label="大字" />
        <x-show.show :value="$population->oaza_name" /> 
        <x-show.close  />

        {{-- 年齢  --}}
        <x-show.open class="ms-5" label="年齢" />
        <x-show.show :value="$population->age" /> 
        <x-show.close  />

        {{-- 合計  --}}
        <x-show.open class="ms-5" label="合計" />
        <x-show.show :value="$population->total_count" /> 
        <x-show.close  />

        {{-- 男性  --}}
        <x-show.open class="ms-5" label="男性" />
        <x-show.show :value="$population->male_count" /> 
        <x-show.close  />

        {{-- 女性  --}}
        <x-show.open class="ms-5" label="女性" />
        <x-show.show :value="$population->female_count" /> 
        <x-show.close  />

        {{-- 備考  --}}
        <x-show.open class="ms-5" label="備考" />
        <x-show.show :value="$population->description" /> 
        <x-show.close  />

        {{-- 登録日時  --}}
        <x-show.open class="ms-5" label="登録日時" />
        <x-show.show :value="MirUtil::hilightDt($population->created_at)" /> 
        <x-show.close  />

        {{-- 更新日時  --}}
        <x-show.open class="ms-5" label="更新日時" />
        <x-show.show :value="MirUtil::hilightDt($population->updated_at)" /> 
        <x-show.close  />

          </div>
        </div>

