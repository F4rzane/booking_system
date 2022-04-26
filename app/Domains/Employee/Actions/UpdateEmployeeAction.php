<?php

namespace App\Domains\Employee\Actions;

use App\SharedKernel\Actions\Resources\AbstractUpdateAction;

use App\Domains\Employee\Contracts\EmployeeRepositoryContract;
use App\SharedKernel\Contracts\Domains\MediaDomainContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Employee\EmployeeDTO;

use App\SharedKernel\Constants\EmployeeConstants;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['employee' => EmployeeDTO::class], description: 'update employee')]
class UpdateEmployeeAction extends AbstractUpdateAction
{
    protected string $resourceName = 'employee';

    protected function getDTO(): string
    {
        return EmployeeDTO::class;
    }

    public function __construct(

        EmployeeRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function updateResource(BaseDTO|EmployeeDTO $dto): BaseDTO|EmployeeDTO
    {
        $model = DB::transaction(function () use ($dto) {

            return $this->repository->forceFillUpdate(

                    $this->safe()->only([
                        'name',
                        'email',
                        'mobile',
                    ]),
                $dto->id
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:3'],
            'email' => ['nullable', 'email'],
            'mobile' => ['nullable', 'string'],
        ];
    }
}
