<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


/**
 * Get the validation rules that apply to the request.
 *
 * @return array<string, Rule|array|string>
 */
class StoreUserRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|max:255|min:5|required_with:confirm-password|same:confirm-password',
            'email' => 'required',
            'confirm-password' => 'required'
        ];
    }
}
