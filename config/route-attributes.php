<?php declare(strict_types=1);

return [

    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        app_path('Web'),
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => ['web']
];
