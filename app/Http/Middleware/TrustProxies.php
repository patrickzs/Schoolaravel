<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware; // [UPGRADE-FIX]

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = // [UPGRADE-FIX]
        Request::HEADER_X_FORWARDED_FOR | // [UPGRADE-FIX]
        Request::HEADER_X_FORWARDED_HOST | // [UPGRADE-FIX]
        Request::HEADER_X_FORWARDED_PORT | // [UPGRADE-FIX]
        Request::HEADER_X_FORWARDED_PROTO | // [UPGRADE-FIX]
        Request::HEADER_X_FORWARDED_AWS_ELB; // [UPGRADE-FIX]
}
