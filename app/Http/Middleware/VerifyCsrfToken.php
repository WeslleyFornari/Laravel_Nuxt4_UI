<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
    //  */
    // protected $except = [

    //     'api/*' // Isso aqui libera o Nuxt para enviar POST sem precisar de token
    // ];
    
}
