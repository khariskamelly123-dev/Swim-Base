<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as BaseTrustProxies;

class TrustProxies extends BaseTrustProxies
{
    /**
     * The trusted proxies for this application.
     * Use '*' to trust all proxies if needed for local/dev.
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = \Illuminate\Http\Request::HEADER_X_FORWARDED_ALL;
}
