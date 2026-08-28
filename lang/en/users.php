<?php

return [

    'title' => 'Users & Members',
    'description' => 'Manage registered users, roles, and access permissions.',

    'table' => [
        'title' => 'Users & Members',
        'description' => 'Registered users and their assigned roles.',
        'user' => 'User',
        'email' => 'Email',
        'role' => 'Role',
        'registered' => 'Registered',
        'action' => 'Action',
    ],

    'roles' => [
        'admin' => 'Admin',
        'team_manager' => 'Team Manager',
        'member' => 'Member',
        'no_role' => 'No Role',
    ],

    'actions' => [
        'edit_role' => 'Edit Role',
        'current_account' => 'Current Account',
        'back' => 'Back to Users',
        'cancel' => 'Cancel',
        'save_role' => 'Save Role',
    ],

    'edit' => [
        'title' => 'Edit User Role',
        'description' => 'Update the role and access level assigned to this user.',

        'role_access' => 'Role & Access',
        'role_access_description' => 'Choose the access level for this account.',

        'user_role' => 'User Role',
        'user_role_required' => 'User Role is required.',
        'role_description' => 'This role determines what the user can access in VolunTeams.',

        'role_information' => 'Role Information',

        'member' => 'Member',
        'member_description' => 'Can participate in volunteer opportunities.',

        'team_manager' => 'Team Manager',
        'team_manager_description' => 'Can manage assigned teams, opportunities and applications.',

        'admin' => 'Admin',
        'admin_description' => 'Has administrative access according to the system permissions.',

        'select_role' => '-- Select Role --',
        'you' => 'You',
    ],

    'messages' => [
        'no_users' => 'No users found.',
        'users_will_appear' => 'Registered users will appear here.',
    ],

];