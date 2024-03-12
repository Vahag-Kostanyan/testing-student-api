<?php

namespace App\Http\Controllers\api\admin\admin;

use App\Http\Controllers\core\ApiCrudController;
use App\Http\Controllers\core\ApiCrudInterface;
use App\Models\UserProfile;

class UserProfileConntroller extends ApiCrudController implements ApiCrudInterface
{
    protected $modelClass = UserProfile::class;
}
