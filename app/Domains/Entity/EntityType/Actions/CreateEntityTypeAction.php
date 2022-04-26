<?php

namespace App\Domains\Entity\EntityType\Actions;

use App\SharedKernel\Actions\Resources\AbstractCreateAction;

use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['entity_type' => EntityTypeDTO::class], description: 'create new entity type')]
class CreateEntityTypeAction extends AbstractCreateAction
{
    protected string $resourceName = 'entity_type';

    protected function getDTO(): string
    {
        return EntityTypeDTO::class;
    }

    public function __construct(
        EntityTypeRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function createResource(): BaseDTO|EntityTypeDTO
    {
        $model = DB::transaction(function () {
            return $this->repository->forceFillCreate(
                $this->safe()->only([
                    'name',
                    'description',
                ]),
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
