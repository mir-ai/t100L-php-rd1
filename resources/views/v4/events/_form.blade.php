{{-- EventV4Controller.php --}}

{{-- イベント 登録・編集フォーム --}}

{{-- 検索条件を次に引き継ぐhiddenタグ --}}
<x-form.conds-to-hidden :conds="$conds" />

<div class="mt-4 lg-1">
  {{-- 都道府県コード又は市区町村コード --}}
  <x-input.open key="pref_code" label="都道府県コード又は市区町村コード" required="N" />
  <x-input.text key="pref_code" :default="old('pref_code', $event->pref_code ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="pref_code" desc="都道府県コード又は市区町村コードを入力します。" maxlen="" />

  {{-- NO --}}
  <x-input.open key="record_id" label="NO" required="N" />
  <x-input.text key="record_id" :default="old('record_id', $event->record_id ?? '')" maxlen="16" class="form-control-lg" />
  <x-input.close key="record_id" desc="NOを入力します。" maxlen="16" />

  {{-- 都道府県名 --}}
  <x-input.open key="pref_name" label="都道府県名" required="N" />
  <x-input.text key="pref_name" :default="old('pref_name', $event->pref_name ?? '')" maxlen="8" class="form-control-lg" />
  <x-input.close key="pref_name" desc="都道府県名を入力します。" maxlen="8" />

  {{-- 市区町村名 --}}
  <x-input.open key="city_name" label="市区町村名" required="N" />
  <x-input.text key="city_name" :default="old('city_name', $event->city_name ?? '')" maxlen="12" class="form-control-lg" />
  <x-input.close key="city_name" desc="市区町村名を入力します。" maxlen="12" />

  {{-- イベント名 --}}
  <x-input.open key="event_name" label="イベント名" required="N" />
  <x-input.text key="event_name" :default="old('event_name', $event->event_name ?? '')" maxlen="255" class="form-control-lg" />
  <x-input.close key="event_name" desc="イベント名を入力します。" maxlen="255" />

  {{-- イベント名_カナ --}}
  <x-input.open key="event_kana" label="イベント名_カナ" required="N" />
  <x-input.text key="event_kana" :default="old('event_kana', $event->event_kana ?? '')" maxlen="255" class="form-control-lg" />
  <x-input.close key="event_kana" desc="イベント名_カナを入力します。" maxlen="255" />

  {{-- イベント名_英語 --}}
  <x-input.open key="event_en" label="イベント名_英語" required="N" />
  <x-input.text key="event_en" :default="old('event_en', $event->event_en ?? '')" maxlen="255" class="form-control-lg" />
  <x-input.close key="event_en" desc="イベント名_英語を入力します。" maxlen="255" />

  {{-- 開始日 --}}
  <x-input.open key="start_date" label="開始日" required="N" />
  <x-input.text key="start_date" :default="old('start_date', $event->start_date ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="start_date" desc="開始日を入力します。" maxlen="" />

  {{-- 終了日 --}}
  <x-input.open key="end_date" label="終了日" required="N" />
  <x-input.text key="end_date" :default="old('end_date', $event->end_date ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="end_date" desc="終了日を入力します。" maxlen="" />

  {{-- 開始時間 --}}
  <x-input.open key="start_time" label="開始時間" required="N" />
  <x-input.text key="start_time" :default="old('start_time', $event->start_time ?? '')" maxlen="8" class="form-control-lg" />
  <x-input.close key="start_time" desc="開始時間を入力します。" maxlen="8" />

  {{-- 終了時間 --}}
  <x-input.open key="end_time" label="終了時間" required="N" />
  <x-input.text key="end_time" :default="old('end_time', $event->end_time ?? '')" maxlen="8" class="form-control-lg" />
  <x-input.close key="end_time" desc="終了時間を入力します。" maxlen="8" />

  {{-- 開始日時特記事項 --}}
  <x-input.open key="start_memo" label="開始日時特記事項" required="N" />
  <x-input.text key="start_memo" :default="old('start_memo', $event->start_memo ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="start_memo" desc="開始日時特記事項を入力します。" maxlen="" />

  {{-- 説明 --}}
  <x-input.open key="description" label="説明" required="N" />
  <x-input.text key="description" :default="old('description', $event->description ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="description" desc="説明を入力します。" maxlen="" />

  {{-- 料金(基本) --}}
  <x-input.open key="fee_basic" label="料金(基本)" required="N" />
  <x-input.text key="fee_basic" :default="old('fee_basic', $event->fee_basic ?? '')" maxlen="20" class="form-control-lg" />
  <x-input.close key="fee_basic" desc="料金(基本)を入力します。" maxlen="20" />

  {{-- 料金(詳細) --}}
  <x-input.open key="fee_detail" label="料金(詳細)" required="N" />
  <x-input.text key="fee_detail" :default="old('fee_detail', $event->fee_detail ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="fee_detail" desc="料金(詳細)を入力します。" maxlen="" />

  {{-- 連絡先名称 --}}
  <x-input.open key="contact_name" label="連絡先名称" required="N" />
  <x-input.text key="contact_name" :default="old('contact_name', $event->contact_name ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="contact_name" desc="連絡先名称を入力します。" maxlen="" />

  {{-- 連絡先電話番号 --}}
  <x-input.open key="contact_tel" label="連絡先電話番号" required="N" />
  <x-input.text key="contact_tel" :default="old('contact_tel', $event->contact_tel ?? '')" maxlen="64" class="form-control-lg" />
  <x-input.close key="contact_tel" desc="連絡先電話番号を入力します。" maxlen="64" />

  {{-- 連絡先内線番号 --}}
  <x-input.open key="contact_tel_ext" label="連絡先内線番号" required="N" />
  <x-input.text key="contact_tel_ext" :default="old('contact_tel_ext', $event->contact_tel_ext ?? '')" maxlen="20" class="form-control-lg" />
  <x-input.close key="contact_tel_ext" desc="連絡先内線番号を入力します。" maxlen="20" />

  {{-- 主催者 --}}
  <x-input.open key="organizer" label="主催者" required="N" />
  <x-input.text key="organizer" :default="old('organizer', $event->organizer ?? '')" maxlen="64" class="form-control-lg" />
  <x-input.close key="organizer" desc="主催者を入力します。" maxlen="64" />

  {{-- 場所名称 --}}
  <x-input.open key="location_name" label="場所名称" required="N" />
  <x-input.text key="location_name" :default="old('location_name', $event->location_name ?? '')" maxlen="128" class="form-control-lg" />
  <x-input.close key="location_name" desc="場所名称を入力します。" maxlen="128" />

  {{-- 住所 --}}
  <x-input.open key="address" label="住所" required="N" />
  <x-input.text key="address" :default="old('address', $event->address ?? '')" maxlen="128" class="form-control-lg" />
  <x-input.close key="address" desc="住所を入力します。" maxlen="128" />

  {{-- 方書 --}}
  <x-input.open key="address2" label="方書" required="N" />
  <x-input.text key="address2" :default="old('address2', $event->address2 ?? '')" maxlen="32" class="form-control-lg" />
  <x-input.close key="address2" desc="方書を入力します。" maxlen="32" />

  {{-- 緯度 --}}
  <x-input.open key="lat" label="緯度" required="N" />
  <x-input.text key="lat" :default="old('lat', $event->lat ?? '')" maxlen="14" class="form-control-lg" />
  <x-input.close key="lat" desc="緯度を入力します。" maxlen="14" />

  {{-- 経度 --}}
  <x-input.open key="lng" label="経度" required="N" />
  <x-input.text key="lng" :default="old('lng', $event->lng ?? '')" maxlen="14" class="form-control-lg" />
  <x-input.close key="lng" desc="経度を入力します。" maxlen="14" />

  {{-- アクセス方法 --}}
  <x-input.open key="access" label="アクセス方法" required="N" />
  <x-input.text key="access" :default="old('access', $event->access ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="access" desc="アクセス方法を入力します。" maxlen="" />

  {{-- 駐車場情報 --}}
  <x-input.open key="parking" label="駐車場情報" required="N" />
  <x-input.text key="parking" :default="old('parking', $event->parking ?? '')" maxlen="60" class="form-control-lg" />
  <x-input.close key="parking" desc="駐車場情報を入力します。" maxlen="60" />

  {{-- 定員 --}}
  <x-input.open key="capacity" label="定員" required="N" />
  <x-input.text key="capacity" :default="old('capacity', $event->capacity ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="capacity" desc="定員を入力します。" maxlen="" />

  {{-- 参加申込終了日 --}}
  <x-input.open key="entry_due_date" label="参加申込終了日" required="N" />
  <x-input.text key="entry_due_date" :default="old('entry_due_date', $event->entry_due_date ?? '')" maxlen="10" class="form-control-lg" />
  <x-input.close key="entry_due_date" desc="参加申込終了日を入力します。" maxlen="10" />

  {{-- 参加申込終了時間 --}}
  <x-input.open key="entry_due_time" label="参加申込終了時間" required="N" />
  <x-input.text key="entry_due_time" :default="old('entry_due_time', $event->entry_due_time ?? '')" maxlen="32" class="form-control-lg" />
  <x-input.close key="entry_due_time" desc="参加申込終了時間を入力します。" maxlen="32" />

  {{-- 参加申込方法 --}}
  <x-input.open key="entry_method" label="参加申込方法" required="N" />
  <x-input.text key="entry_method" :default="old('entry_method', $event->entry_method ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="entry_method" desc="参加申込方法を入力します。" maxlen="" />

  {{-- URL --}}
  <x-input.open key="entry_url" label="URL" required="N" />
  <x-input.text key="entry_url" :default="old('entry_url', $event->entry_url ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="entry_url" desc="URLを入力します。" maxlen="" />

  {{-- 備考 --}}
  <x-input.open key="memo" label="備考" required="N" />
  <x-input.text key="memo" :default="old('memo', $event->memo ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="memo" desc="備考を入力します。" maxlen="" />

  {{-- カテゴリー --}}
  <x-input.open key="category" label="カテゴリー" required="N" />
  <x-input.text key="category" :default="old('category', $event->category ?? '')" maxlen="12" class="form-control-lg" />
  <x-input.close key="category" desc="カテゴリーを入力します。" maxlen="12" />

  {{-- 区 --}}
  <x-input.open key="ward_name" label="区" required="N" />
  <x-input.text key="ward_name" :default="old('ward_name', $event->ward_name ?? '')" maxlen="12" class="form-control-lg" />
  <x-input.close key="ward_name" desc="区を入力します。" maxlen="12" />

  {{-- 公開日 --}}
  <x-input.open key="open_date" label="公開日" required="N" />
  <x-input.text key="open_date" :default="old('open_date', $event->open_date ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="open_date" desc="公開日を入力します。" maxlen="" />

  {{-- 更新日 --}}
  <x-input.open key="update_date" label="更新日" required="N" />
  <x-input.text key="update_date" :default="old('update_date', $event->update_date ?? '')" maxlen="" class="form-control-lg" />
  <x-input.close key="update_date" desc="更新日を入力します。" maxlen="" />

  {{-- 子育て情報 --}}
  <x-input.open key="is_childcare" label="子育て情報" required="N" />
  <x-input.text key="is_childcare" :default="old('is_childcare', $event->is_childcare ?? '')" maxlen="4" class="form-control-lg" />
  <x-input.close key="is_childcare" desc="子育て情報を入力します。" maxlen="4" />

  {{-- 施設No. --}}
  <x-input.open key="location_no" label="施設No." required="N" />
  <x-input.text key="location_no" :default="old('location_no', $event->location_no ?? '')" maxlen="16" class="form-control-lg" />
  <x-input.close key="location_no" desc="施設No.を入力します。" maxlen="16" />

  <div class="mt-4 mb-2">
    <x-input.submit-back :label="$submitButton" :backUrl="$back_url ?? ''" class="btn-lg" />
  </div>

</div>
