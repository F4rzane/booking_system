<?php

namespace App\SharedKernel\Actions\Resources;

use Throwable;
use App\SharedKernel\Exceptions\BaseException;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\SharedKernel\DTOs\Responses\PaginatedDTO;
use App\SharedKernel\Repositories\Criteria\RestrictOwnerCriteria;
use App\SharedKernel\Repositories\Criteria\AugmentConditionsCriteria;

abstract class AbstractListAction extends AbstractResourceAction
{
    protected string $pluralResourceName;

    /**
     * @throws Throwable
     */
    protected function restrictResult(): void
    {
        $this->repository->pushCriteria(new RestrictOwnerCriteria($this->getAuthenticatedUserId()));
    }

    protected function augmentConditions(): array
    {
        return [];
    }

    /**
     * @throws BaseException|Throwable
     */
    protected function controller(): array
    {
        $this->addRelations();

        if (!$this->public && !$this->isAdminAuthenticated()) {
            $this->restrictResult();
        }

        return $this->listResources();
    }

    protected function listResources(): array
    {
        $this->repository->pushCriteria(new AugmentConditionsCriteria($this->augmentConditions()));

        $result = $this->repository->paginate()->toArray();

        $collection = $this->dataCollection($result['data']);
        unset($result['data']);
        $paginatedDTO = new PaginatedDTO($result);

        return $this->transformDTO($collection, $paginatedDTO);
    }

    protected function transformDTO(Collection $collection, PaginatedDTO $paginatedDTO): array
    {
        return [
            'pagination' => $paginatedDTO->toArray(),
            $this->pluralResourceName ?? Str::plural($this->resourceName) => $collection->toArray(),
        ];
    }

    protected function dataCollection(array $data): Collection
    {
        return call_user_func([$this->getDTO(), 'asCollection'], $data);
    }
}
