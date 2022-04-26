<?php

namespace App\SharedKernel\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RestrictOwnerCriteria implements CriteriaInterface
{
    public function __construct(
        protected int $id,
        protected string $key = 'user_id',
    ) {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where($this->key, '=', $this->id);
    }
}
