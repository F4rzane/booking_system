<?php

namespace App\SharedKernel\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class AugmentConditionsCriteria implements CriteriaInterface
{
    public function __construct(
        protected array $where
    ) {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        foreach ($this->where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $model = $model->where($field, $condition, $val);
            } else {
                $model = $model->where($field, '=', $value);
            }
        }

        return $model;
    }
}
