<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Customer;

class UpdateCustomerRequest extends FormRequest
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
          'name' => ['required', 'max:50'],
          'kana' => ['required', 'regex:/^[ァ-ヾ]+$/u','max:50'],
          'tel' => ['required', 'max:20'],
          'email' => ['required', 'email', 'max:255'],
          'postcode' => ['required', 'max:7'],
          'address' => ['required', 'max:100'],
          'birthday' => ['date'],
          'gender' => ['required'],
          'memo' => ['max:1000']
        ];

    }
}
