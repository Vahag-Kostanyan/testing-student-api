<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;

/**
 * @param Collection $permissions
 * @param string $route
 * @return bool
 */

function hasPermission(Collection $permissions, string $route): bool
{
    foreach ($permissions as $permission) {
        if ($permission->permission->page === $route) {
            $access = array_map('intval', str_split($permission->permission->permission));

            switch (request()->method()) {
                case 'GET':
                    if ($access[1] == 1) {
                        return true;
                    }
                case 'POST':
                    if ($access[0] == 1) {
                        return true;
                    }
                case 'PUT':
                    if ($access[2] == 1) {
                        return true;
                    }
                case 'PUTCH':
                    if ($access[2] == 1) {
                        return true;
                    }
                case 'DELETE':
                    if ($access[3] == 1) {
                        return true;
                    }
            }
        }
    }

    return false;
}

function getModelsName()
{
    $modelDirectory = app_path('Models');

    // Get all PHP files in the model directory
    $files = File::files($modelDirectory);

    // Extract the class names from the file paths
    $modelNames = collect($files)->map(function ($file) {
        // Get the base name of the file (without the extension)
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // Build the fully qualified class name
        return 'App\\Models\\' . $fileName;
    })->toArray();

    // Output the model names
    return $modelNames;
}
