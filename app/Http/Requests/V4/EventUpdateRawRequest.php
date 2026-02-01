<?php

namespace App\Http\Requests\V4;

use App\Models\Event;
use App\UseCases\EventUseCase;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
  * イベントモデルのフォームからの直接更新時の値検証
  */
class EventUpdateRawRequest extends FormRequest
{
    private EventUseCase $eventUseCase;

    function __construct()
    {
        $this->eventUseCase = new EventUseCase();
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
        return Event::$columns;
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        //
    }
}
