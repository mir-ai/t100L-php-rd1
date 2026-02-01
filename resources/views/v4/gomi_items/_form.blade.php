{{-- GomiItemV4Controller.php --}}

{{-- ごみ分別 登録・編集フォーム --}}

{{-- 検索条件を次に引き継ぐhiddenタグ --}}
<x-form.conds-to-hidden :conds="$conds" />

<div class="mt-4 lg-1">
{{-- 行 --}}
<x-input.open key="kana1" label="行" required="N" />
<x-input.text key="kana1" :default="old('kana1', $gomi_item->kana1 ?? '')" maxlen="4" class="form-control-lg" />
<x-input.close key="kana1" desc="行を入力します。" maxlen="4" />

{{-- 品目 --}}
<x-input.open key="name" label="品目" required="N" />
<x-input.text key="name" :default="old('name', $gomi_item->name ?? '')" maxlen="64" class="form-control-lg" />
<x-input.close key="name" desc="品目を入力します。" maxlen="64" />

{{-- 詳細 --}}
<x-input.open key="detail" label="詳細" required="N" />
<x-input.text key="detail" :default="old('detail', $gomi_item->detail ?? '')" maxlen="64" class="form-control-lg" />
<x-input.close key="detail" desc="詳細を入力します。" maxlen="64" />

{{-- 大きさ・長さ --}}
<x-input.open key="size" label="大きさ・長さ" required="N" />
<x-input.text key="size" :default="old('size', $gomi_item->size ?? '')" maxlen="64" class="form-control-lg" />
<x-input.close key="size" desc="大きさ・長さを入力します。" maxlen="64" />

{{-- 分別品目 --}}
<x-input.open key="gomi_type" label="分別品目" required="N" />
<x-input.text key="gomi_type" :default="old('gomi_type', $gomi_item->gomi_type ?? '')" maxlen="64" class="form-control-lg" />
<x-input.close key="gomi_type" desc="分別品目を入力します。" maxlen="64" />

{{-- 処理手数料 --}}
<x-input.open key="fee" label="処理手数料" required="N" />
<x-input.text key="fee" :default="old('fee', $gomi_item->fee ?? '')" maxlen="64" class="form-control-lg" />
<x-input.close key="fee" desc="処理手数料を入力します。" maxlen="64" />

{{-- 連絡ごみ備考 --}}
<x-input.open key="description" label="連絡ごみ備考" required="N" />
<x-input.text key="description" :default="old('description', $gomi_item->description ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="description" desc="連絡ごみ備考を入力します。" maxlen="" />

{{-- 排出方法･備考 --}}
<x-input.open key="howto" label="排出方法･備考" required="N" />
<x-input.text key="howto" :default="old('howto', $gomi_item->howto ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="howto" desc="排出方法･備考を入力します。" maxlen="" />

{{-- URLに関連するワード --}}
<x-input.open key="words" label="URLに関連するワード" required="N" />
<x-input.text key="words" :default="old('words', $gomi_item->words ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="words" desc="URLに関連するワードを入力します。" maxlen="" />

{{-- 浜松市公式Webサイト 参考ページURL --}}
<x-input.open key="url" label="浜松市公式Webサイト 参考ページURL" required="N" />
<x-input.text key="url" :default="old('url', $gomi_item->url ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="url" desc="浜松市公式Webサイト 参考ページURLを入力します。" maxlen="" />

{{-- 分別品目の補足 --}}
<x-input.open key="memo" label="分別品目の補足" required="N" />
<x-input.text key="memo" :default="old('memo', $gomi_item->memo ?? '')" maxlen="" class="form-control-lg" />
<x-input.close key="memo" desc="分別品目の補足を入力します。" maxlen="" />


  <div class="mt-4 mb-2">
    <x-input.submit-back :label="$submitButton" :backUrl="$back_url ?? ''" class="btn-lg" />
  </div>

</div>
