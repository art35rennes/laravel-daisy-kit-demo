<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class MapWmsFixtureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service' => ['nullable', Rule::in(['WMS'])],
            'request' => ['nullable', Rule::in(['GetMap'])],
            'layers' => ['nullable', 'string', 'max:80'],
            'styles' => ['nullable', 'string', 'max:80'],
            'format' => ['nullable', Rule::in(['image/png'])],
            'transparent' => ['nullable', Rule::in(['true', 'false', '1', '0'])],
            'version' => ['nullable', Rule::in(['1.1.1', '1.3.0'])],
            'srs' => ['nullable', 'string', 'max:32'],
            'crs' => ['nullable', 'string', 'max:32'],
            'bbox' => ['nullable', 'string', 'max:160'],
            'width' => ['nullable', 'integer', 'between:1,2048'],
            'height' => ['nullable', 'integer', 'between:1,2048'],
        ];
    }
}
