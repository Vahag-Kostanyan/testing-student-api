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
            "group_id" => "65f5d623a5205",
            "parent_group_id" => null
        ],
        [
            "title" => "Profile",
            'type' => Permission::TYPE_UNIQUE_MENU,
            "page" => "/profile",
            "method" => "read",
            "group_id" => "65f5d730a3322",
            "parent_group_id" => "65f5d623a5205"
        ],
        [
            "title" => "Admin",
            'type' => Permission::TYPE_MENU,
            "page" => "/admin",
            "method" => "read",
            "group_id" => "65f5d7860eaa0",
            "parent_group_id" => "65f5d623a5205"
        ],
        [
            "title" => "Role",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/admin/role",
            "method" => "read",
            "group_id" => "65f5d7cb37580",
            "parent_group_id" => "65f5d7860eaa0"
        ],
        [
            "title" => "Users",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/admin/users",
            "method" => "read",
            "group_id" => "65f5d7f2becde",
            "parent_group_id" => "65f5d7860eaa0"
        ],
        [
            "title" => "User",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/admin/users/:id",
            "method" => "read",
            "group_id" => "65f5d8296f35c",
            "parent_group_id" => "65f5d7f2becde"
        ],
        [
            "title" => "Manager",
            'type' => Permission::TYPE_MENU,
            "page" => "/manager",
            "method" => "read",
            "group_id" => "65f5d86ba2a3d",
            "parent_group_id" => "65f5d623a5205"
        ],
        [
            "title" => "Students",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/students",
            "method" => "read",
            "group_id" => "65f5d8da6b58c",
            "parent_group_id" => "65f5d86ba2a3d"
        ],
        [
            "title" => "Student",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/manager/students/:id",
            "method" => "read",
            "group_id" => "65f5d9083e8ff",
            "parent_group_id" => "65f5d8da6b58c"
        ],
        [
            "title" => "Groups",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/groups",
            "method" => "read",
            "group_id" => "65f5d933dbdb3",
            "parent_group_id" => "65f5d86ba2a3d"
        ],
        [
            "title" => "Group",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/manager/groups/:id",
            "method" => "read",
            "group_id" => "65f5d9722b20a",
            "parent_group_id" => "65f5d933dbdb3"
        ],
        [
            "title" => "Teachers",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/teachers",
            "method" => "read",
            "group_id" => "65f5d993595db",
            "parent_group_id" => "65f5d86ba2a3d"
        ],
        [
            "title" => "Subjects",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/manager/subjects",
            "method" => "read",
            "group_id" => "65f5d9af9074c",
            "parent_group_id" => "65f5d86ba2a3d"
        ],
        [
            "title" => "Teacher",
            'type' => Permission::TYPE_MENU,
            "page" => "/teacher",
            "method" => "read",
            "group_id" => "65f5d9ced57ff",
            "parent_group_id" => "65f5d623a5205"
        ],
        [
            "title" => "Tests",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/tests",
            "method" => "read",
            "group_id" => "65f5d9f2bd15c",
            "parent_group_id" => "65f5d9ced57ff"
        ],
        [
            "title" => "Questions",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/questions",
            "method" => "read",
            "group_id" => "65f5da158f0fb",
            "parent_group_id" => "65f5d9ced57ff"
        ],
        [
            "title" => "Groups",
            'type' => Permission::TYPE_SUB_MENU,
            "page" => "/teacher/groups",
            "method" => "read",
            "group_id" => "65f5da3678726",
            "parent_group_id" => "65f5d9ced57ff"
        ],
        [
            "title" => "Group",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/teacher/groups/:id",
            "method" => "read",
            "group_id" => "65f5da5da4b2f",
            "parent_group_id" => "65f5da3678726"
        ],
        [
            "title" => "Student",
            'type' => Permission::TYPE_SUB_MENU_CONTENT,
            "page" => "/teacher/groups/:id/:id",
            "method" => "read",
            "group_id" => "65f5da9b9d999",
            "parent_group_id" => "65f5da5da4b2f"
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

        foreach ($methods as $method) {
            $permission['method'] = $method;
            $fullPermissions[] = $permission;
        }
    }

    return $fullPermissions;
}



function getSubPermissions(): array
{
    $subPermissions = [];

    $permissions_for_role = Permission::where('page', '/admin/role')->get();
    $sub_permissions_for_role = ['admin/roles', 'admin/permissions', 'admin/subPermissions'];

    foreach ($permissions_for_role as $permission) {
        foreach ($sub_permissions_for_role as $sub_permission) {
            $subPermissions[] = [
                'permission_id' => $permission->id,
                'page' => $sub_permission,
                'method' => $permission->method,
            ];
        }
    }

    return $subPermissions;
}