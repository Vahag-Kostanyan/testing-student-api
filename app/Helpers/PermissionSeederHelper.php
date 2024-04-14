<?php
use App\Models\Permission;


/**
 * @return array
 */
function permissions(): array
{

    // Sitebar tree
    // [
    //     ['page' => '/', 'name' => 'main'],
    //     ['page' => '/profile', 'name' => 'profile'],
    //     'admin' => [
    //         ['page' => '/admin/role', 'name' => 'admin_role'],
    //         ['page' => '/admin/users', 'name' => 'admin_users'],
    //         ['page' => '/admin/users/:id', 'name' => 'admin_users_user'],
    //     ],
    //     'manager' => [
    //         ['page' => '/manager/students', 'name' => 'manager_students'],
    //         ['page' => '/manager/students/:id', 'name' => 'manager_students_student'],
    //         ['page' => '/manager/groups', 'name' => 'manager_groups'],
    //         ['page' => '/manager/groups/:id', 'name' => 'manager_groups_group'],
    //         ['page' => '/manager/teachers', 'name' => 'manager_teachers'],
    //         ['page' => '/manager/subjects', 'name' => 'manager_subjects'],
    //     ],
    //     'teacher' => [
    //         ['page' => '/teacher/tests', 'name' => 'teacher_tests'],
    //         ['page' => '/teacher/questions', 'name' => 'teacher_questions'],
    //         ['page' => '/teacher/groups', 'name' => 'teacher_groups'],
    //         ['page' => '/teacher/groups/:id', 'name' => 'teacher_groups_group'],
    //         ['page' => '/teacher/groups/:id/:id', 'name' => 'teacher_groups_group_student'],
    //     ],
    // ];

    return [
        [
            "title" => "Main",
            'type' => Permission::TYPE_MENU,
            "page" => "/",
            "method" => "read",
        ],
        [
            "title" => "Profile",
            'type' => Permission::TYPE_UNIQUE_MENU,
            "page" => "/profile",
            "method" => "read",
        ],
        [
            "title" => "Admin",
            'type' => Permission::TYPE_MENU,
            "page" => "/admin",
            "method" => "read",
        ],
        [
            "title" => "Role",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/admin/roles",
            "method" => "read",
        ],
        [
            "title" => "Users",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/admin/users",
            "method" => "read",
        ],
        [
            "title" => "User",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/admin/users/:id",
            "method" => "read",
        ],
        [
            "title" => "Manager",
            'type' => Permission::TYPE_MENU,
            "page" => "/manager",
            "method" => "read",
        ],
        [
            "title" => "Students",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/students",
            "method" => "read",
        ],
        [
            "title" => "Student",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/manager/students/:id",
            "method" => "read",
        ],
        [
            "title" => "Groups",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/groups",
            "method" => "read",
        ],
        [
            "title" => "Group",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/manager/groups/:id",
            "method" => "read",
        ],
        [
            "title" => "Teachers",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/teachers",
            "method" => "read",
        ],
        [
            "title" => "Subjects",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/subjects",
            "method" => "read",
        ],
        [
            "title" => "Teacher",
            'type' => Permission::TYPE_MENU,
            "page" => "/teacher",
            "method" => "read",
        ],
        [
            "title" => "Tests",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/tests",
            "method" => "read",
        ],
        [
            "title" => "Questions",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/questions",
            "method" => "read",
        ],
        [
            "title" => "Groups",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/groups",
            "method" => "read",
        ],
        [
            "title" => "Group",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/teacher/groups/:id",
            "method" => "read",
        ],
        [
            "title" => "Student",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/teacher/groups/:id/:id",
            "method" => "read",
        ],
    ];
}


/**
 * @return array
 */
function getPermissions(): array
{
    $permissions = permissions();
    $fullPermissions = [];
    $methods = ['create', 'update', 'delete'];

    foreach ($permissions as $permission) {
        $fullPermissions[] = $permission;

        if($permission['type'] !== Permission::TYPE_MENU){
            foreach ($methods as $method) {
                if($permission['page'] != '/profile' || $method != 'create'){
                    $permission['method'] = $method;
                    $fullPermissions[] = $permission;
                }
            }
        }
    }

    return $fullPermissions;
}



function getSubPermissions(): array
{
    $admin_role_read = Permission::where('page', '/admin/roles')->where('method', 'read')->first();
    $admin_role_create = Permission::where('page', '/admin/roles')->where('method', 'create')->first();
    $profile_role_update = Permission::where('page', '/profile')->where('method', 'update')->first();
    $group_role_read = Permission::where('page', '/manager/groups')->where('method', 'read')->first();

    return [
        [
            "permission_id" => $admin_role_read->id,
            "page" => '/admin/permissions',
            "method" => "read"
        ],
        [
            "permission_id" => $admin_role_create->id,
            "page" => '/admin/rolePermissions',
            "method" => "create"
        ],
        [
            "permission_id" => $profile_role_update->id,
            "page" => '/profile/changePassword',
            "method" => "update"
        ],
        [
            "permission_id" => $group_role_read->id,
            "page" => '/manager/group_types',
            "method" => "read"
        ]
    ];
}