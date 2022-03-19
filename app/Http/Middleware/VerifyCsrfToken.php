<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*',
        'admin/uploads',
        'admin/banners/order',
        'admin/floaters/order',
        'admin/players/order',
        'admin/biddings/order',
        'admin/pages/order',
        'admin/posts/order',
        'admin/categories/order',
        'admin/biddings/*/attachments/order',
    ];
}
