<?php

namespace App\Http\Requests\api\ValidationTrait\admin\teacher;

use App\Models\Group;
use App\Models\GroupTeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

trait GroupValidationTrait
{
    
    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function show_before_validation(Request $request, int|null $id): void 
    {
        parent::show_before_validation($request, $id);
        
        if(!$group = Group::find($id)){
           validationException(['Invalid Group id']); 
        }
        if(
            !auth()->user()->isSuperAdmin() &&
            $group->user_id != auth()->user()->id &&
            !GroupTeacherSubject::where('user_id', auth()->user()->id)->where('group_id', $id)->first()
        )
        {
            permissionException('The user does not have permission to this record');
        }
    }
}
