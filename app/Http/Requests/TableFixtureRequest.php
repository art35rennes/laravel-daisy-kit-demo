<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class TableFixtureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:80'],
            'role' => ['nullable', Rule::in(['Maintainer', 'Reviewer', 'Contributor'])],
            'status' => ['nullable', Rule::in(['active', 'invited', 'paused'])],
            'sort' => ['nullable', Rule::in(['name', 'role', 'status'])],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'page' => ['nullable', 'integer', 'min:1', 'max:10'],
            'per_page' => ['nullable', 'integer', Rule::in([2, 5, 10])],
        ];
    }
}
