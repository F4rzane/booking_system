<?php

namespace App\SharedKernel\Contracts;

use App\SharedKernel\DTOs\Responses\ResponseDTO;

interface ExceptionInterface
{
    public function response(): ResponseDTO;
}
