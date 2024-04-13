<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;

trait SubjectsValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:subject'],
            'id' => [new UnknownProperties()],
        ];
    }

    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules() : array
    {
        return [
            'name' => ['sometimes', 'unique:subject'],
            'id' => [new UnknownProperties()],
        ];        
    }
}
