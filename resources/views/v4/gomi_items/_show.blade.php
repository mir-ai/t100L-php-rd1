{{-- GomiItemV4Controller.php --}}

{{-- ごみ分別 １件詳細表示フォーム --}}

        <div class="card mb-4">
          <div class="card-body">
            <div class="fs-5 mb-3 fw-bold">詳細情報</div>
        {{-- ID  --}}
        <x-show.open class="ms-5" label="ID" />
        <x-show.show :value="$gomi_item->id" /> 
        <x-show.close  />

        {{-- 行  --}}
        <x-show.open class="ms-5" label="行" />
        <x-show.show :value="$gomi_item->kana1" /> 
        <x-show.close  />

        {{-- 品目  --}}
        <x-show.open class="ms-5" label="品目" />
        <x-show.show :value="$gomi_item->name" /> 
        <x-show.close  />

        {{-- 詳細  --}}
        <x-show.open class="ms-5" label="詳細" />
        <x-show.show :value="$gomi_item->detail" /> 
        <x-show.close  />

        {{-- 大きさ・長さ  --}}
        <x-show.open class="ms-5" label="大きさ・長さ" />
        <x-show.show :value="$gomi_item->size" /> 
        <x-show.close  />

        {{-- 分別品目  --}}
        <x-show.open class="ms-5" label="分別品目" />
        <x-show.show :value="$gomi_item->gomi_type" /> 
        <x-show.close  />

        {{-- 処理手数料  --}}
        <x-show.open class="ms-5" label="処理手数料" />
        <x-show.show :value="$gomi_item->fee" /> 
        <x-show.close  />

        {{-- 連絡ごみ備考  --}}
        <x-show.open class="ms-5" label="連絡ごみ備考" />
        <x-show.show :value="$gomi_item->description" /> 
        <x-show.close  />

        {{-- 排出方法･備考  --}}
        <x-show.open class="ms-5" label="排出方法･備考" />
        <x-show.show :value="$gomi_item->howto" /> 
        <x-show.close  />

        {{-- URLに関連するワード  --}}
        <x-show.open class="ms-5" label="URLに関連するワード" />
        <x-show.show :value="$gomi_item->words" /> 
        <x-show.close  />

        {{-- 浜松市公式Webサイト 参考ページURL  --}}
        <x-show.open class="ms-5" label="浜松市公式Webサイト 参考ページURL" />
        <x-show.show :value="$gomi_item->url" /> 
        <x-show.close  />

        {{-- 分別品目の補足  --}}
        <x-show.open class="ms-5" label="分別品目の補足" />
        <x-show.show :value="$gomi_item->memo" /> 
        <x-show.close  />

        {{-- 登録日時  --}}
        <x-show.open class="ms-5" label="登録日時" />
        <x-show.show :value="MirUtil::hilightDt($gomi_item->created_at)" /> 
        <x-show.close  />

        {{-- 更新日時  --}}
        <x-show.open class="ms-5" label="更新日時" />
        <x-show.show :value="MirUtil::hilightDt($gomi_item->updated_at)" /> 
        <x-show.close  />

          </div>
        </div>

