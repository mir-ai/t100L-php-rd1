<?php

namespace App\Http\Requests\V4;

use Illuminate\Foundation\Http\FormRequest;
use App\UseCases\GomiItemUseCase;
use Illuminate\Validation\Rule;

/**
  * ごみ分別モデルのフォームからの直接更新時の値検証
  */
class GomiItemUpdateRawRequest extends FormRequest
{
    private GomiItemUseCase $gomiItemUseCase;

    function __construct()
    {
        $this->gomiItemUseCase = new GomiItemUseCase();
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $merge = [

        ];
        $this->merge($merge);
    }

    public function rules()
    {
        return [
            'kana1' => ['nullable', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:64'],
            'detail' => ['nullable', 'string', 'max:64'],
            'size' => ['nullable', 'string', 'max:64'],
            'gomi_type' => ['nullable', 'string', 'max:64'],
            'fee' => ['nullable', 'string', 'max:64'],
            'description' => ['nullable', 'string', 'max:4000'],
            'howto' => ['nullable', 'string', 'max:4000'],
            'words' => ['nullable', 'string', 'max:4000'],
            'url' => ['nullable', 'string', 'max:4000'],
            'memo' => ['nullable', 'string', 'max:4000'],
            'created_at' => ['nullable', 'date'],
            'updated_at' => ['nullable', 'date']
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [
            'id' => 'ID',
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
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        //
    }
}
