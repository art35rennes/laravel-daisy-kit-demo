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

    protected function prepareForValidation(): void
    {
        $columnFilters = $this->decodeStructuredQuery($this->query('columnFilters'));

        if (is_array($columnFilters) && array_is_list($columnFilters)) {
            $columnFilters = collect($columnFilters)
                ->filter(static fn (mixed $filter): bool => is_array($filter)
                    && is_string($filter['id'] ?? null)
                    && array_key_exists('value', $filter))
                ->mapWithKeys(static fn (array $filter): array => [$filter['id'] => $filter['value']])
                ->all();
        }

        $this->merge([
            'columnFilters' => $columnFilters,
            'columnPinning' => $this->decodeStructuredQuery($this->query('columnPinning')),
            'columnVisibility' => $this->decodeStructuredQuery($this->query('columnVisibility')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filter' => ['nullable', 'string', 'max:80'],
            'columnFilters' => ['nullable', 'array'],
            'columnFilters.name' => ['nullable', 'string', 'max:80'],
            'columnFilters.role' => ['nullable', Rule::in(['Maintainer', 'Reviewer', 'Contributor'])],
            'columnFilters.status' => ['nullable', Rule::in(['active', 'invited', 'paused'])],
            'sort' => ['nullable', Rule::in(['name', 'role', 'status'])],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'pageSize' => ['nullable', 'integer', Rule::in([2, 5, 10, 25, 50, 100])],
            'columnPinning' => ['nullable', 'array'],
            'columnVisibility' => ['nullable', 'array'],
        ];
    }

    private function decodeStructuredQuery(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }
}
