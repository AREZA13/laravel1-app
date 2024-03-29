<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePetPutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'alias' => 'required|max:50',
            'owner_id' => 'required|int',
            'breed_id' => 'required|int',
            'type_id' => 'required|int',
            'weight' => 'numeric|nullable',
            'sex' => 'max:50',
            'birthday' => 'date|nullable'

        ];
    }
}
