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
        //
        'maintenance/*',
        'rekap_medik/simpanP1/*',
        'rekap_medik/simpanP3/*',
        'rekap_medik/simpanP5/*',
    ];
}
