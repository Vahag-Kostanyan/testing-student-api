<?php


/**
 * @return array
 */
function getPages(): array
{
    return [
        ['page' => '/', 'name' => 'main'],
        ['page' => '/profile', 'name' => 'profile'],
        'admin' => [
            ['page' => '/admin/role', 'name' => 'admin_role'],
            ['page' => '/admin/users', 'name' => 'admin_users'],
            ['page' => '/admin/users/:id', 'name' => 'admin_users_user'],
        ],
        'manager' => [
            ['page' => '/manager/students', 'name' => 'manager_students'],
            ['page' => '/manager/students/:id', 'name' => 'manager_students_student'],
            ['page' => '/manager/groups', 'name' => 'manager_groups'],
            ['page' => '/manager/groups/:id', 'name' => 'manager_groups_group'],
            ['page' => '/manager/teachers', 'name' => 'manager_teachers'],
            ['page' => '/manager/subjects', 'name' => 'manager_subjects'],
        ],
        'teacher' => [
            ['page' => '/teacher/tests', 'name' => 'teacher_tests'],
            ['page' => '/teacher/questions', 'name' => 'teacher_questions'],
            ['page' => '/teacher/groups', 'name' => 'teacher_groups'],
            ['page' => '/teacher/groups/:id', 'name' => 'teacher_groups_group'],
            ['page' => '/teacher/groups/:id/:id', 'name' => 'teacher_groups_group_student'],
        ],
    ];
}


function getPermissions()
{
    $pages = getPages();
    $permission = [];

    foreach ($pages as $key => $page) {
        if (in_array($key, ['admin', 'manager', 'teacher'])) {
            foreach ($page as $item) {
                $permission = [...$permission, ...generateRouteWithMethods($item)];
            }
        } else {
            $permission = [...$permission, ...generateRouteWithMethods($page)];
        }
    }

    return $permission;
}


/**
 * @param array $page
 * @return array
 */
function generateRouteWithMethods(array $page): array
{
    $methods = ['create', 'read', 'update', 'delete'];
    $permissions = [];

    foreach ($methods as $method) {
        $permissions[] = [
            "name" => $page['name'] . '_' . $method,
            "page" => $page['page'],
            "method" => $method,
        ];
    }

    return $permissions;
}