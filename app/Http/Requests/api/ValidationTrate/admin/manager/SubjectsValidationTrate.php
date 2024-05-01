<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait SubjectsValidationTrate
{
    /**
     * @param Request $request
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(Request $request): array
    {
        return [
            'name' => ['required', 'string', 'unique:subject'],
            'id' => [new UnknownProperties()],
        ];
    }

    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return [
            'name' => ['sometimes', Rule::unique('subject', 'name')->ignore($id)],
            'id' => [new UnknownProperties()],
        ];        
    }
}
