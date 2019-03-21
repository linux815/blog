<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'a,c,r,u,d,b',
            'articles' => 'a,c,r,u',
            'articles.comments' => 'a,c,r,u,d',
            'categories' => 'a,c,r,u,d',
            'comments' => 'a,r,u,d',
        ],
        'editor' => [
            'articles' => 'a,c,r,u',
            'articles.comments' => 'a,c,r,u',
            'users' => 'a,c,r,u,d,b',
            'categories' => 'a,c,r,u,d',
            'comments' => 'a,r'
        ],
    ],
    'permission_structure' => [
    ],
    'permissions_map' => [
        'a' => 'access',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'b' => 'block',
    ]
];
