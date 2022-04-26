<?php

namespace App\SharedKernel\Exceptions;

use Illuminate\Support\Facades\Lang;
use Throwable;

class NotFoundException extends BaseException
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $name
     * @return static
     */
    public static function resource(string $name): self
    {
        return new self(__('messages.resources.notfound', [
            'resource' => Lang::has('messages.resources.'.$name)
                ? __('messages.resources.'.$name)
                : $name
        ]));
    }
}
