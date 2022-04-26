<?php

namespace App\Exceptions;

use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\DTOs\Responses\MetaDTO;
use App\SharedKernel\DTOs\Responses\ResponseDTO;
use App\SharedKernel\Exceptions\UnexpectedException;
use App\SharedKernel\Responses\ResponseConstants;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e) {
       return parent::render($request, $e);
       $errors = [];
       $message = $e->getMessage();

       if (is_a($e, \Prettus\Validator\Exceptions\ValidatorException::class)) {
           $message = 'validation';
           $errors = $e->getMessageBag()->toArray();//$e->toArray()->error_description->getMessage();
       } elseif (is_a($e, UnexpectedException::class) && is_a($e->getPrevious(), ValidationException::class)) {
           $message = $e->getPrevious()->getMessage();
           $errors = $e?->getPrevious()?->errors();
       }

       $meta = new MetaDTO(
           message: new MessageDTO(body: $message, type: ResponseConstants::ERROR)
       );

       $responseDTO = new ResponseDTO(
           ok: false,
           meta: $meta,
           errors: $errors,
           status: $response->getStatusCode(),
           headers: $response->headers->all(),
       );

       return $responseDTO->toResponse();
   }
}
