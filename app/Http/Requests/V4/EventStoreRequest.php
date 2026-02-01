<?php

namespace App\Http\Requests\V4;

use App\Models\Event;
use App\UseCases\EventUseCase;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
  * イベントモデルのフォームからの登録時の値検証
  */
class EventStoreRequest extends FormRequest
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
            'seq' => time(),

        ];
        $this->merge($merge);
    }

    public function rules()
    {
        return [
            'pref_code' => ['nullable', 'integer'],
            'record_id' => ['required', 'string', 'max:16'],
            'pref_name' => ['nullable', 'string', 'max:8'],
            'city_name' => ['nullable', 'string', 'max:12'],
            'event_name' => ['required', 'string', 'max:255'],
            'event_kana' => ['nullable', 'string', 'max:255'],
            'event_en' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'start_time' => ['nullable', 'string', 'max:8'],
            'end_time' => ['nullable', 'string', 'max:8'],
            'start_memo' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'fee_basic' => ['nullable', 'string', 'max:20'],
            'fee_detail' => ['nullable', 'string'],
            'contact_name' => ['nullable', 'string'],
            'contact_tel' => ['nullable', 'string', 'max:64'],
            'contact_tel_ext' => ['nullable', 'string', 'max:20'],
            'organizer' => ['nullable', 'string', 'max:64'],
            'location_name' => ['nullable', 'string', 'max:128'],
            'address' => ['nullable', 'string', 'max:128'],
            'address2' => ['nullable', 'string', 'max:32'],
            'lat' => ['nullable', 'string', 'max:14'],
            'lng' => ['nullable', 'string', 'max:14'],
            'access' => ['nullable', 'string'],
            'parking' => ['nullable', 'string', 'max:60'],
            'capacity' => ['nullable', 'string', 'max:4000'],
            'entry_due_date' => ['nullable', 'string', 'max:10'],
            'entry_due_time' => ['nullable', 'string', 'max:32'],
            'entry_method' => ['nullable', 'string'],
            'entry_url' => ['nullable', 'string'],
            'memo' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:12'],
            'ward_name' => ['nullable', 'string', 'max:12'],
            'open_date' => ['nullable', 'date'],
            'update_date' => ['nullable', 'date'],
            'is_childcare' => ['nullable', 'string', 'max:4'],
            'location_no' => ['nullable', 'string', 'max:16'],
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
