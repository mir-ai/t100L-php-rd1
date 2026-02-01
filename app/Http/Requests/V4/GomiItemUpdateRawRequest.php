<?php

namespace App\Http\Requests\V4;

use App\Models\GomiItem;
use Illuminate\Validation\Rule;
use App\UseCases\GomiItemUseCase;
use Illuminate\Foundation\Http\FormRequest;

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
            'fee' => ['nullable', 'numeric'],
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
        return GomiItem::$columns;
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        //
    }
}
