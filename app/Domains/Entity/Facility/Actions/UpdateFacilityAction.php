<?php

namespace App\Domains\Entity\Facility\Actions;

use App\SharedKernel\Actions\Resources\AbstractUpdateAction;

use App\Domains\Entity\Facility\Contracts\FacilityRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Entity\Facility\FacilityDTO;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['facility' => FacilityDTO::class], description: 'update facility types')]
class UpdateFacilityAction extends AbstractUpdateAction
{
    protected string $resourceName = 'entity';
    protected array $relations = ['entityType'];

    protected function getDTO(): string
    {
        return FacilityDTO::class;
    }

    public function __construct(

        FacilityRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function updateResource(BaseDTO|FacilityDTO $dto): BaseDTO|FacilityDTO
    {
        $entityType = new ($this->getDTO())($this->get('entity_type'));
        $model = DB::transaction(function () use ($dto, $entityType) {
            $attributes['entity_type_id'] = $entityType->id;

            return $this->repository->forceFillUpdate(
                array_merge(
                    $this->safe()->only([
                        'name',
                        'description',
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
        ];
    }
}
