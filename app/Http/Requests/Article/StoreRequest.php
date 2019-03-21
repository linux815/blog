<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed category_id
 * @property mixed article
 */
class StoreRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'article' => 'required|string|min:1|max:1000',
            'category_id' => 'required|exists:categories,id|integer|min:1',
        ];
    }
}
