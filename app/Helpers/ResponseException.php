<?php

use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @param array $errors
 * @param string $message
 * @return void
 * @exception HttpResponseException
 */
function validationException(array $errors = null, string $message = null) : void
{
    throw new HttpResponseException(response()->json([
        'message' => $message ?? 'Validation failed',
        'status' => false,
        'errors' => $errors ?? [],
    ], 422));
}


/**
 * @return void
 * @exception HttpResponseException
 */
function serverException()
{
    throw new HttpResponseException(response()->json([
        'status' => false,
        'errors' => ['Something went wrong, contact support!'],
    ], 500));
}

