<?php

return [
    'default' => 'file',
    'path' => storage_path('framework/filesystems'),
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'private',
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
    ],
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
];
