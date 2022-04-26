<?php

namespace App\SharedKernel\Actions\Resources;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\Responses\ResponseConstants;

use App\SharedKernel\Exceptions\BaseException;
use Prettus\Repository\Exceptions\RepositoryException;

use Illuminate\Support\Facades\Lang;

abstract class AbstractDeleteAction extends AbstractSingleResourceAction
{
    protected function responseMessage(): ?MessageDTO
    {
        return new MessageDTO(
            type: ResponseConstants::SUCCESS,
            body: __('messages.resources.actions.delete', [
                'resource' => Lang::has('messages.resources.'.$this->resourceName)
                    ? __('messages.resources.'.$this->resourceName)
                    : $this->resourceName
            ]),
        );
    }

    /**
     * @throws BaseException|RepositoryException
     */
    protected function controller(): void
    {
        $dto = $this->getResource();
        $this->deleteResource(dto: $dto, force: $this->safe()->get('force', false));
    }

    /**
     * @throws RepositoryException
     */
    protected function deleteResource(BaseDTO $dto, bool $force = false): void
    {
        if ($force) {
            $this->repository->forceDelete($dto->id);
        } else {
            $this->repository->delete($dto->id);
        }
    }

    public function rules(): array
    {
        return [
            'force' => ['sometimes', 'boolean'],
        ];
    }
}
