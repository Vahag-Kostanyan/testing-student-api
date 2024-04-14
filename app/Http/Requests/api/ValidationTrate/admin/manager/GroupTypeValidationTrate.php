<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;

trait GroupTypeValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function index_validation_rules(): array
    {
        return [
            'include' => [new UnknownProperties()],
        ];
    }
}
