<?php

namespace App\Domains\Entity\Facility\Actions;

use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;
use App\SharedKernel\Actions\Resources\AbstractListAction;

use App\SharedKernel\Attributes\ResponseType;
use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;

#[ResponseType(response: ['facility' => FacilityDTO::class], collection: true, description: 'facility list')]
class ListFacilityAction extends AbstractListAction
{
    protected string $resourceName = 'entity';

    protected array $relations = ['entityType'];

    protected bool $authority = true;

    protected bool $public = true;

    protected function getDTO(): string
    {
        return FacilityDTO::class;
    }

    public function __construct(FacilityRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
