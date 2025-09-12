<?php
return [
    /*
    |--------------------------------------------------------------------------
    | JWT Time To Live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 60 minutes.
    |
    | You can also set this to null, to yield a never expiring token. Some
    | people may want this behaviour for e.g. a mobile app. This is not
    | recommended though, especially if you don't have an appropriate
    | token revocation strategy in place.
    |
    */
    'ttl' => env('JWT_TTL', 60),
];
