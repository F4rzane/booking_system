<?php

namespace App\SharedKernel\Actions\Resources;

use App\SharedKernel\Actions\AbstractAction;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\Repositories\BaseRepository;

abstract class AbstractResourceAction extends AbstractAction
{
    protected bool $public = false;

    protected array $relations = [];

    protected string $resourceName = 'resource';

    protected BaseRepository $repository;

    abstract protected function getDTO(): string;

    /**
     * @param array $parameters
     * @return BaseDTO
     */
    protected function getDTOInstance(array $parameters): BaseDTO
    {
        return new ($this->getDTO())($parameters);
    }

    protected function addRelations(): void
    {
        if (count($this->relations)) {
            $this->repository->with($this->relations);
        }
    }
}
