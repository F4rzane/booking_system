<?php

namespace App\SharedKernel\Actions\Resources;

use App\SharedKernel\Exceptions\BaseException;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\Responses\ResponseConstants;

use Illuminate\Support\Facades\Lang;

abstract class AbstractUpdateAction extends AbstractSingleResourceAction
{
    abstract protected function updateResource(BaseDTO $dto): BaseDTO;

    protected function responseMessage(): ?MessageDTO
    {
        return new MessageDTO(
            type: ResponseConstants::SUCCESS,
            body: __('messages.resources.actions.update', [
                'resource' => Lang::has('messages.resources.'.$this->resourceName)
                    ? __('messages.resources.'.$this->resourceName)
                    : $this->resourceName
            ]),
        );
    }

    /**
     * @throws BaseException
     */
    protected function controller(): array
    {
        $this->addRelations();

        $dto = $this->getResource();

        $dto = $this->updateResource(dto: $dto);

        return $this->transformDTO($dto);
    }
}
