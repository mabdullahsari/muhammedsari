<?php declare(strict_types=1);

use App\UI\Http\Admin\General\ApplicationHealth;

return [

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the general appearance of the page
    | in admin panel.
    |
    */

    'pages' => [
        'health' => ApplicationHealth::class,
    ],

];
