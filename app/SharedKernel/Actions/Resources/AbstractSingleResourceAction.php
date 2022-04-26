<?php

namespace App\SharedKernel\Actions\Resources;

use Illuminate\Support\Str;
use App\SharedKernel\DTOs\BaseDTO;
use Illuminate\Database\Eloquent\Model;

use App\SharedKernel\Exceptions\BaseException;
use App\SharedKernel\Exceptions\AccessException;
use App\SharedKernel\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class AbstractSingleResourceAction extends AbstractResourceAction
{
    protected string $resourceKeyName;

    public function getResourceKeyName(): string
    {
        return $this->resourceKeyName ?? Str::camel($this->resourceName).'Id';
    }

    protected function getOwnerId(BaseDTO $dto): ?int
    {
        return isset($dto->user_id) ? ((int) $dto->user_id) : null;
    }


    protected function getResourceId(): ?int
    {
        if ($this->has($this->resourceName) && $this->get($this->resourceName) instanceof Model) {
            return $this->get($this->resourceName)->id;
        } elseif ($this->has($this->getResourceKeyName())) {
            return $this->get($this->getResourceKeyName());
        } else {
            return $this->get('id', null);
        }
    }

    /**
     * @throws BaseException
     */
    protected function getResource(): BaseDTO
    {
        try {
            if ($this->has($this->resourceName) && $this->get($this->resourceName) instanceof Model) {
                $model = $this->get($this->resourceName)?->loadMissing($this->relations);
            } elseif ($this->has($this->getResourceKeyName()) && is_numeric($this->get($this->getResourceKeyName()))) {

                $model = $this->repository->find($this->get($this->getResourceKeyName()));
            } elseif ($this->has('id') && is_numeric($this->get('id'))) {
                $model = $this->repository->find($this->get('id'));
            } else {
                throw NotFoundException::resource($this->resourceName);
            }
        } catch (ModelNotFoundException) {
            throw NotFoundException::resource($this->resourceName);
        }
        return $this->getDTOInstance($model->toArray());
    }


    protected function transformDTO(BaseDTO $dto): array
    {
        return [
            $this->resourceName => $dto->toArray(),
        ];
    }
}
