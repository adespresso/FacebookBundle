<?php

return [
    'facebook' => [
        'sdk' => [
            'config' => [
                'app_id' => 'id',
                'app_secret' => 'secret',
                'default_access_token' => sha1(mt_rand()),
            ],
        ],
        'ads' => [
            'enabled' => false,
        ],
    ],
];
