<?php

namespace App\Domains\Employee\Actions;

use App\SharedKernel\Actions\Resources\AbstractCreateAction;

use App\Domains\Employee\Contracts\EmployeeRepositoryContract;

use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Employee\EmployeeDTO;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['employee' => EmployeeDTO::class], description: 'create new employee')]
class CreateEmployeeAction extends AbstractCreateAction
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

    protected function createResource(): BaseDTO|EmployeeDTO
    {
        $model = DB::transaction(function () {
            return $this->repository->forceFillCreate(
                $this->safe()->only([
                    'name',
                    'user_name',
                    'email',
                    'mobile',
                ]),
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'user_name' => ['required', 'string', 'min:3', 'unique:employees,user_name'],
            'email' => ['nullable', 'email'],
            'mobile' => ['nullable', 'string'],
        ];
    }
}
