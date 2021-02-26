<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
        'photos' => [
            'driver' => 'local',
            'root' => storage_path('app/photos'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'chat' => [
            'driver' => 'local',
            'root' => storage_path('app/chat'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'user' => [
            'driver' => 'local',
            'root' => storage_path('app/user'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],


    ],

     # links make asset function to front end  http:blog.test/image.png
     # when use image in front end must write driver before it
      # php artisan storage:link     when add any link
      /* when update
      * 1- cd public
      * 2- rm storage
      */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('photos') => storage_path('app/photos'),
        public_path('chat') => storage_path('app/chat'),
        public_path('user') => storage_path('app/user'),

    ],

];
