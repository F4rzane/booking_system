<?php

namespace App\SharedKernel\Exceptions;

use Throwable;
use Exception;
use App\SharedKernel\Contracts\ExceptionInterface;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

use Illuminate\Http\Response;
use App\SharedKernel\DTOs\Responses\MetaDTO;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\DTOs\Responses\ResponseDTO;
use App\SharedKernel\Responses\ResponseConstants;

class BaseException extends Exception implements ExceptionInterface
{
    protected array $result = [];
    protected array $errors = [];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }

    public function setResult(array $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function setErrors(array $errors): static
    {
        $this->errors = $errors;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @throws UnknownProperties
     */
    public function response(): ResponseDTO
    {
        $response = new ResponseDTO();
        $response->failed();
        $response->status = $this->getStatusCode();
        $response->result = $this->getResult();
        $response->errors = $this->getErrors();
        $response->meta = new MetaDTO(
            message: new MessageDTO(
                type: ResponseConstants::ERROR,
                body: $this->getMessage()
            )
        );

        if (!in_array($response->status, [
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_UNAUTHORIZED,
            Response::HTTP_PAYMENT_REQUIRED,
            Response::HTTP_FORBIDDEN,
            Response::HTTP_NOT_FOUND,
            Response::HTTP_METHOD_NOT_ALLOWED,
            Response::HTTP_NOT_ACCEPTABLE,
            Response::HTTP_PROXY_AUTHENTICATION_REQUIRED,
            Response::HTTP_REQUEST_TIMEOUT,
            Response::HTTP_CONFLICT,
            Response::HTTP_GONE,
            Response::HTTP_LENGTH_REQUIRED,
            Response::HTTP_PRECONDITION_FAILED,
            Response::HTTP_REQUEST_ENTITY_TOO_LARGE,
            Response::HTTP_REQUEST_URI_TOO_LONG,
            Response::HTTP_UNSUPPORTED_MEDIA_TYPE,
            Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE,
            Response::HTTP_EXPECTATION_FAILED,
            Response::HTTP_I_AM_A_TEAPOT,
            Response::HTTP_MISDIRECTED_REQUEST,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            Response::HTTP_LOCKED,
            Response::HTTP_FAILED_DEPENDENCY,
            Response::HTTP_TOO_EARLY,
            Response::HTTP_UPGRADE_REQUIRED,
            Response::HTTP_PRECONDITION_REQUIRED,
            Response::HTTP_TOO_MANY_REQUESTS,
            Response::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE,
            Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS,
            Response::HTTP_INTERNAL_SERVER_ERROR,
            Response::HTTP_NOT_IMPLEMENTED,
            Response::HTTP_BAD_GATEWAY,
            Response::HTTP_SERVICE_UNAVAILABLE,
            Response::HTTP_GATEWAY_TIMEOUT,
            Response::HTTP_VERSION_NOT_SUPPORTED,
            Response::HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL,
            Response::HTTP_INSUFFICIENT_STORAGE,
            Response::HTTP_LOOP_DETECTED,
            Response::HTTP_NOT_EXTENDED,
            Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED,
        ])) {
            $response->status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $response;
    }
}
