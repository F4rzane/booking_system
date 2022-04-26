<?php

namespace App\SharedKernel\Tests;

use Illuminate\Routing\Middleware\ThrottleRequests;

class HttpTestCase extends BaseTestCase
{
    protected $defaultHeaders = [
        'content-type' => 'application/x-www-form-urlencoded',
        'accept' => 'application/json',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(
            ThrottleRequests::class
        );
    }
}
