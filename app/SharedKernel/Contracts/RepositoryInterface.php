<?php

namespace App\SharedKernel\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Repository\Exceptions\RepositoryException;

interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function forceFillCreate(array $attributes): mixed;

    /**
     * Update an entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     * @return mixed
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function forceFillUpdate(array $attributes, $id): mixed;

    /**
     * Update an entity in repository by id
     *
     * @param array $where
     * @param array $data
     * @return mixed
     * @throws RepositoryException
     */
    public function massUpdate(array $where, array $data): bool;

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function firstWhere(array $where, array $columns = ['*']): mixed;

    /**
     * Delete multiple entities by given criteria.
     *
     * @param array $where
     *
     * @return int
     */
    public function deleteWhere(array $where);

    /**
     * Force deletes an entity in repository by id
     *
     * @param $id
     *
     * @return int
     * @throws RepositoryException
     */
    public function forceDelete($id): int;

    /**
     * Delete multiple entities by given criteria.
     *
     * @param array $where
     *
     * @return int
     * @throws RepositoryException
     */
    public function forceDeleteWhere(array $where): int;
}
