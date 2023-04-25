<?php declare(strict_types=1);

use App\Http\Filament\General\Health;

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
        'health' => Health::class,
    ],

];
