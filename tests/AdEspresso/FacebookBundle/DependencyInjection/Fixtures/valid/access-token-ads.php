<?php

return [
    'facebook' => [
        'sdk' => [
            'enabled' => false,
        ],
        'ads' => [
            'config' => [
                'app_id' => 'id',
                'app_secret' => 'secret',
                'default_access_token' => sha1(mt_rand()),
            ],
        ],
    ],
];
