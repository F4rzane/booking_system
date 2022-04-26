<?php

namespace App\SharedKernel\Actions\Resources;

use App\SharedKernel\DTOs\BaseDTO;
use Illuminate\Support\Facades\Lang;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\Responses\ResponseConstants;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class AbstractCreateAction extends AbstractSingleResourceAction
{
    abstract protected function createResource(): BaseDTO;

    /**
     * @throws UnknownProperties
     */
    protected function responseMessage(): ?MessageDTO
    {
        return new MessageDTO(
            type: ResponseConstants::SUCCESS,
            body: __('messages.resources.actions.create', [
                'resource' => Lang::has('messages.resources.'.$this->resourceName)
                    ? __('messages.resources.'.$this->resourceName)
                    : $this->resourceName
            ]),
        );
    }

    protected function controller(): array
    {
        $dto = $this->createResource();

        return $this->transformDTO($dto);
    }
}
