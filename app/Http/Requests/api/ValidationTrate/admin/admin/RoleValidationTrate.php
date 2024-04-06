<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;

trait RoleValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return ['name' => ['required', 'string', 'unique:role']];
    }

    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules(): array
    {
        return ['name' => ['required', 'string', 'unique:role']];
    }
}
