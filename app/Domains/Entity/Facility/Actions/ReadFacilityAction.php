<?php

namespace App\Domains\Entity\Facility\Actions;

use App\SharedKernel\Actions\Resources\AbstractReadAction;

use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use App\SharedKernel\Attributes\ResponseType;
use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;

#[ResponseType(response: ['facility' => FacilityDTO::class], description: 'Read facility')]
class ReadFacilityAction extends AbstractReadAction
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
