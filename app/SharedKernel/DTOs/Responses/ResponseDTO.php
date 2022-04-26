<?php

namespace App\SharedKernel\DTOs\Responses;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\DataTransferObject;

class ResponseDTO extends DataTransferObject
{
    public bool $ok = true;
    public int $status = Response::HTTP_OK;
    public array $headers = [];
    public MetaDTO $meta;
    public ?array $result;
    public ?array $errors;

    public function __construct(...$args)
    {
        $this->meta = new MetaDTO();

        parent::__construct(...$args);
    }

    public function failed(): static
    {
        $this->ok = false;

        return $this;
    }

    public function toResponse(): JsonResponse
    {
        $data = [
            'ok' => $this->ok,
            'meta' => $this->meta->toArray(),
        ];

        if (!count($data['meta'])) {
            unset($data['meta']);
        }

        if (isset($this->result) && count($this->result)) {
            $data['result'] = $this->result;
        }

        if (isset($this->errors) && count($this->errors)) {
            $data['errors'] = $this->errors;
        }


        return response()->json($data, $this->status, $this->headers);
    }
}
