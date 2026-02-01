<?php

namespace App\Http\Requests\V4;

use App\Models\Population;
use Illuminate\Validation\Rule;
use App\UseCases\PopulationUseCase;
use Illuminate\Foundation\Http\FormRequest;

/**
  * 人口モデルのフォームからの直接更新時の値検証
  */
class PopulationUpdateRawRequest extends FormRequest
{
    private PopulationUseCase $populationUseCase;

    function __construct()
    {
        $this->populationUseCase = new PopulationUseCase();
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
            'pref_code' => ['required', 'integer'],
            'pref_name' => ['required', 'string', 'max:16'],
            'city_name' => ['required', 'string', 'max:16'],
            'yyyymm' => ['required', 'string', 'max:16'],
            'ward_code' => ['required', 'integer'],
            'ward_name' => ['required', 'string', 'max:16'],
            'district_name' => ['required', 'string', 'max:16'],
            'oaza_code' => ['required', 'integer'],
            'oaza_name' => ['required', 'string', 'max:16'],
            'age' => [
                'required',
                'string',
                'max:16',
                 Rule::unique('populations')
                ->where('pref_code', $this->pref_code)
                ->where('city_name', $this->city_name)
                ->where('ward_code', $this->ward_code)
                ->where('oaza_code', $this->oaza_code)
                ->where('age', $this->age)
                ->ignore($this->population->id, 'id')
            ],
            'total_count' => ['nullable', 'integer'],
            'male_count' => ['nullable', 'integer'],
            'female_count' => ['nullable', 'integer'],
            'description' => ['nullable', 'string', 'max:200'],
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
        return Population::$columns;
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        //
    }
}
