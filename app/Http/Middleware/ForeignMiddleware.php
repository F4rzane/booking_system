<?php

namespace App\Http\Middleware;

use App\Responses\OperationFailed;
use App\Responses\ResourceNotFound;
use App\Responses\UnAuthorized;
use App\Responses\ValidationFailed;
use Closure;
use Exception;
use Facades\App\Responses\ApiResponse;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;

class ForeignMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $header = $request->header('drdr');
        if (!$header || $header != "XHsZTKXAZrL9ytAz")
            return ApiResponse::generate(ValidationFailed::class, null, 'Unauthorized');

        return $next($request);
    }
}
