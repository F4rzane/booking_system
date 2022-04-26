<?php

namespace App\SharedKernel\Exceptions;

use App\SharedKernel\Contracts\ExceptionInterface;
use League\OAuth2\Server\Exception\OAuthServerException as BaseOAuthServerException;

use App\SharedKernel\DTOs\Responses\MetaDTO;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\DTOs\Responses\ResponseDTO;
use App\SharedKernel\Responses\ResponseConstants;

use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class OAuthServerException extends BaseOAuthServerException implements ExceptionInterface
{
    /**
     * Invalid request error.
     *
     * @param string $parameter The invalid parameter
     * @param null|string $hint
     * @param Throwable|null $previous Previous exception
     *
     * @return static
     */
    public static function invalidRequest($parameter, ?string $hint = null, ?Throwable $previous = null): static
    {
        return parent::invalidRequest($parameter, $hint , $previous);
    }

    /**
     * Invalid client error.
     *
     * @param ServerRequestInterface $serverRequest
     *
     * @return static
     */
    public static function invalidClient(ServerRequestInterface $serverRequest): static
    {
        return parent::invalidClient($serverRequest);
    }

    /**
     * @throws UnknownProperties
     */
    public function response(): ResponseDTO
    {
        $response = new ResponseDTO();
        $response->failed();
        $response->meta = new MetaDTO(
            message: new MessageDTO(
                type: ResponseConstants::ERROR,
                body: $this->getMessage(),
                description: $this->getHint(),
            )
        );

        $response->status = $this->getHttpStatusCode();

        return $response;
    }
}
