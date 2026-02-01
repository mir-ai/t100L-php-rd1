{{-- EventV4Controller.php --}}

{{-- イベント １件詳細表示フォーム --}}

        <div class="card mb-4">
          <div class="card-body">
            <div class="fs-5 mb-3 fw-bold">詳細情報</div>
        {{-- id  --}}
        <x-show.open class="ms-5" label="id" />
        <x-show.show :value="$event->id" /> 
        <x-show.close  />

        {{-- 都道府県コード又は市区町村コード  --}}
        <x-show.open class="ms-5" label="都道府県コード又は市区町村コード" />
        <x-show.show :value="$event->pref_code" /> 
        <x-show.close  />

        {{-- NO  --}}
        <x-show.open class="ms-5" label="NO" />
        <x-show.show :value="$event->record_id" /> 
        <x-show.close  />

        {{-- 都道府県名  --}}
        <x-show.open class="ms-5" label="都道府県名" />
        <x-show.show :value="$event->pref_name" /> 
        <x-show.close  />

        {{-- 市区町村名  --}}
        <x-show.open class="ms-5" label="市区町村名" />
        <x-show.show :value="$event->city_name" /> 
        <x-show.close  />

        {{-- イベント名  --}}
        <x-show.open class="ms-5" label="イベント名" />
        <x-show.show :value="$event->event_name" /> 
        <x-show.close  />

        {{-- イベント名_カナ  --}}
        <x-show.open class="ms-5" label="イベント名_カナ" />
        <x-show.show :value="$event->event_kana" /> 
        <x-show.close  />

        {{-- イベント名_英語  --}}
        <x-show.open class="ms-5" label="イベント名_英語" />
        <x-show.show :value="$event->event_en" /> 
        <x-show.close  />

        {{-- 開始日  --}}
        <x-show.open class="ms-5" label="開始日" />
        <x-show.show :value="MirUtil::hilightDt($event->start_date)" /> 
        <x-show.close  />

        {{-- 終了日  --}}
        <x-show.open class="ms-5" label="終了日" />
        <x-show.show :value="MirUtil::hilightDt($event->end_date)" /> 
        <x-show.close  />

        {{-- 開始時間  --}}
        <x-show.open class="ms-5" label="開始時間" />
        <x-show.show :value="$event->start_time" /> 
        <x-show.close  />

        {{-- 終了時間  --}}
        <x-show.open class="ms-5" label="終了時間" />
        <x-show.show :value="$event->end_time" /> 
        <x-show.close  />

        {{-- 開始日時特記事項  --}}
        <x-show.open class="ms-5" label="開始日時特記事項" />
        <x-show.show :value="$event->start_memo" /> 
        <x-show.close  />

        {{-- 説明  --}}
        <x-show.open class="ms-5" label="説明" />
        <x-show.show :value="$event->description" /> 
        <x-show.close  />

        {{-- 料金(基本)  --}}
        <x-show.open class="ms-5" label="料金(基本)" />
        <x-show.show :value="$event->fee_basic" /> 
        <x-show.close  />

        {{-- 料金(詳細)  --}}
        <x-show.open class="ms-5" label="料金(詳細)" />
        <x-show.show :value="$event->fee_detail" /> 
        <x-show.close  />

        {{-- 連絡先名称  --}}
        <x-show.open class="ms-5" label="連絡先名称" />
        <x-show.show :value="$event->contact_name" /> 
        <x-show.close  />

        {{-- 連絡先電話番号  --}}
        <x-show.open class="ms-5" label="連絡先電話番号" />
        <x-show.show :value="$event->contact_tel" /> 
        <x-show.close  />

        {{-- 連絡先内線番号  --}}
        <x-show.open class="ms-5" label="連絡先内線番号" />
        <x-show.show :value="$event->contact_tel_ext" /> 
        <x-show.close  />

        {{-- 主催者  --}}
        <x-show.open class="ms-5" label="主催者" />
        <x-show.show :value="$event->organizer" /> 
        <x-show.close  />

        {{-- 場所名称  --}}
        <x-show.open class="ms-5" label="場所名称" />
        <x-show.show :value="$event->location_name" /> 
        <x-show.close  />

        {{-- 住所  --}}
        <x-show.open class="ms-5" label="住所" />
        <x-show.show :value="$event->address" /> 
        <x-show.close  />

        {{-- 方書  --}}
        <x-show.open class="ms-5" label="方書" />
        <x-show.show :value="$event->address2" /> 
        <x-show.close  />

        {{-- 緯度  --}}
        <x-show.open class="ms-5" label="緯度" />
        <x-show.show :value="$event->lat" /> 
        <x-show.close  />

        {{-- 経度  --}}
        <x-show.open class="ms-5" label="経度" />
        <x-show.show :value="$event->lng" /> 
        <x-show.close  />

        {{-- アクセス方法  --}}
        <x-show.open class="ms-5" label="アクセス方法" />
        <x-show.show :value="$event->access" /> 
        <x-show.close  />

        {{-- 駐車場情報  --}}
        <x-show.open class="ms-5" label="駐車場情報" />
        <x-show.show :value="$event->parking" /> 
        <x-show.close  />

        {{-- 定員  --}}
        <x-show.open class="ms-5" label="定員" />
        <x-show.show :value="$event->capacity" /> 
        <x-show.close  />

        {{-- 参加申込終了日  --}}
        <x-show.open class="ms-5" label="参加申込終了日" />
        <x-show.show :value="$event->entry_due_date" /> 
        <x-show.close  />

        {{-- 参加申込終了時間  --}}
        <x-show.open class="ms-5" label="参加申込終了時間" />
        <x-show.show :value="$event->entry_due_time" /> 
        <x-show.close  />

        {{-- 参加申込方法  --}}
        <x-show.open class="ms-5" label="参加申込方法" />
        <x-show.show :value="$event->entry_method" /> 
        <x-show.close  />

        {{-- URL  --}}
        <x-show.open class="ms-5" label="URL" />
        <x-show.show :value="$event->entry_url" /> 
        <x-show.close  />

        {{-- 備考  --}}
        <x-show.open class="ms-5" label="備考" />
        <x-show.show :value="$event->memo" /> 
        <x-show.close  />

        {{-- カテゴリー  --}}
        <x-show.open class="ms-5" label="カテゴリー" />
        <x-show.show :value="$event->category" /> 
        <x-show.close  />

        {{-- 区  --}}
        <x-show.open class="ms-5" label="区" />
        <x-show.show :value="$event->ward_name" /> 
        <x-show.close  />

        {{-- 公開日  --}}
        <x-show.open class="ms-5" label="公開日" />
        <x-show.show :value="MirUtil::hilightDt($event->open_date)" /> 
        <x-show.close  />

        {{-- 更新日  --}}
        <x-show.open class="ms-5" label="更新日" />
        <x-show.show :value="MirUtil::hilightDt($event->update_date)" /> 
        <x-show.close  />

        {{-- 子育て情報  --}}
        <x-show.open class="ms-5" label="子育て情報" />
        <x-show.show :value="$event->is_childcare" /> 
        <x-show.close  />

        {{-- 施設No.  --}}
        <x-show.open class="ms-5" label="施設No." />
        <x-show.show :value="$event->location_no" /> 
        <x-show.close  />

        {{-- 登録日時  --}}
        <x-show.open class="ms-5" label="登録日時" />
        <x-show.show :value="MirUtil::hilightDt($event->created_at)" /> 
        <x-show.close  />

        {{-- 更新日時  --}}
        <x-show.open class="ms-5" label="更新日時" />
        <x-show.show :value="MirUtil::hilightDt($event->updated_at)" /> 
        <x-show.close  />

          </div>
        </div>

