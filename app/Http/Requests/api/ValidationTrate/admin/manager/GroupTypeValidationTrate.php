<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;
use Illuminate\Http\Request;

trait GroupTypeValidationTrate
{
    /**
     * @param Request $request
     * @return array
     * @inheritDoc
     */
    protected function index_validation_rules(Request $request): array
    {
        return [
            'include' => [new UnknownProperties()],
        ];
    }
}
