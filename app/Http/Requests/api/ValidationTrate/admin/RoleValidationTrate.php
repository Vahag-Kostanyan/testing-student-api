<?php

namespace App\Http\Requests\api\ValidationTrate\admin;

use App\Models\Role;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    /**
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function update_before_validation(int|null $id): void
    {
        if (!Role::find($id)) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid role id'],
            ], 422));
        }
    }


    /**
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function destroy_before_validation(int|null $id): void
    {
        if (!Role::find($id)) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => ['Invalid role id'],
            ], 422));
        }
    }
}
