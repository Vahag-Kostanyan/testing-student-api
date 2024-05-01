<?php

namespace App\Http\Requests\api\ValidationTrate\admin\admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait RoleValidationTrate
{
    /**
     * @param Request $request
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(Request $request): array
    {
        return ['name' => ['required', 'string', 'unique:role']];
    }

    /**
     * @param int|null $id
     * @param Request $request
     * @return array
     */
    protected function update_validation_rules(Request $request, int|null $id): array
    {
        return ['name' => ['required', 'string', Rule::unique('role', 'name')->ignore($id)]];
    }
}
