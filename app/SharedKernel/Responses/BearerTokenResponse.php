<?php

namespace App\SharedKernel\Responses;

use App\SharedKernel\DTOs\Responses\ResponseDTO;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse as LeagueBearerTokenResponse;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class BearerTokenResponse extends LeagueBearerTokenResponse
{
    /**
     * {@inheritdoc}
     */
    public function generateHttpResponse(PsrResponseInterface $response): PsrResponseInterface
    {
        $response = parent::generateHttpResponse($response);

        $body = $response->getBody();

        $content = (string) $response->getBody();

        $responseParams = json_decode($content);

        $responseDTO = new ResponseDTO([
            'result' => [
                'token' => $responseParams,
            ],
        ]);

        $responseParams = json_encode($responseDTO->toResponse()->getData());

        $body->rewind();

        $body->write($responseParams);

        $response->withBody($body);

        return $response;
    }
}
