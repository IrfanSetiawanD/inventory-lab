<?php

return [

    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    'default_log_name' => 'default',

    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    'table_name' => 'activity_log',

    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),

    'subject_returns_soft_deleted_models' => false,

    'causer_returns_soft_deleted_models' => false,

    'locale' => env('APP_LOCALE', 'en'),

    'log_authentication_exception' => true,

    'default_auth_driver' => null,

    'default_guard' => null,

    'ip_address' => [
        'enabled' => true,
        'resolvable' => true,
    ],

    'user_agent' => [
        'enabled' => true,
    ],

    'log_when_attributes_change_only' => false,

    'submit_empty_logs' => false,
];
