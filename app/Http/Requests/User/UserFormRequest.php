<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed file
 * @property mixed campaign_info
 * @property mixed address
 * @property mixed url
 */
class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'unique:users,email,'. request()->user()->id,
        ];
    }
}
