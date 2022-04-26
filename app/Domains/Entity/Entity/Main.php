<?php

namespace App\Domains\Entity\Entity;

use App\SharedKernel\Contracts\Domains\EntityDomainContract;

use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;

use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\Exceptions\NotFoundException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Main implements EntityDomainContract
{
    public function __construct(
        protected EntityRepositoryContract $entityRepository
    ) {
    }

    /**
     * @throws NotFoundException|UnknownProperties
     */
    public function getEntityById(string|int $id): EntityDTO
    {
        $entity = $this->entityRepository->find($id);

        if (!isset($entity)) {
            throw NotFoundException::resource('entity');
        }

        return new EntityDTO($entity->toArray());
    }

    public function entityExists(array $where): bool
    {
        if (!count($where)) {
            return false;
        }

        return $this->entityRepository->count($where) > 0;
    }
}
