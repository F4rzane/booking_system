<?php

namespace App\Domains\Entity\Entity\Actions;

use App\SharedKernel\Actions\Resources\AbstractUpdateAction;

use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['employee' => EntityDTO::class], description: 'update entity types')]
class UpdateEntityAction extends AbstractUpdateAction
{
    protected string $resourceName = 'entity';
    protected array $relations = ['entityType'];

    protected function getDTO(): string
    {
        return EntityDTO::class;
    }

    public function __construct(

        EntityRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function updateResource(BaseDTO|EntityDTO $dto): BaseDTO|EntityDTO
    {
        $entityType = new ($this->getDTO())($this->get('entity_type'));
        $model = DB::transaction(function () use ($dto, $entityType) {
            $attributes['entity_type_id'] = $entityType->id;

            return $this->repository->forceFillUpdate(
                array_merge(
                    $this->safe()->only([
                        'name',
                        'description',
                        'max_simultaneous_booking',
                        'available_in_holidays',
                    ]),
                    $attributes
                ),
                $dto->id
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'entity_type' => ['required'],
            'max_simultaneous_booking' => ['nullable', 'int'],
            'available_in_holidays' => ['nullable', 'boolean'],
        ];
    }
}
