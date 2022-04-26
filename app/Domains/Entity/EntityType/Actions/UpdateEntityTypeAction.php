<?php

namespace App\Domains\Entity\EntityType\Actions;

use App\SharedKernel\Actions\Resources\AbstractUpdateAction;

use App\Domains\Entity\EntityType\Contracts\EntityTypeRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\EntityType\EntityTypeDTO;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['employee' => EntityTypeDTO::class], description: 'update entity types')]
class UpdateEntityTypeAction extends AbstractUpdateAction
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

    protected function updateResource(BaseDTO|EntityTypeDTO $dto): BaseDTO|EntityTypeDTO
    {
        $model = DB::transaction(function () use ($dto) {

            return $this->repository->forceFillUpdate(

                    $this->safe()->only([
                        'name',
                        'description',
                    ]),
                $dto->id
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
