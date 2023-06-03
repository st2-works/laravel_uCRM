<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //trueに変更
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'name' => ['required', 'max:255'],
          'memo' => ['required', 'max:255'],
          'price' => ['required', 'numeric'],
          'is_selling' => ['required', 'boolean']
        ];
    }
}
