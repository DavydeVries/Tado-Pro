<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tado Email Address
    |--------------------------------------------------------------------------
    |
    | This value is the email address of your tado account. This value will be
    | used for authentication.
    |
    */

    'email' => env('TADO_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Tado Password
    |--------------------------------------------------------------------------
    |
    | This value is the password of your tado account. This value will be
    | used for authentication.
    |
    */

    'password' => env('TADO_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Celsius or Fahrenheit
    |--------------------------------------------------------------------------
    |
    | This value sets the unit for the application. This value is used when the
    | framework needs to place the celsius or fahrenheit in a text or
    | any other location as required by the application or its packages.
    |
    */

    'unit' => env('TADO_UNIT', 'celsius'),

];
