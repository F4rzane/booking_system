<?php

namespace App\SharedKernel\Repositories;

use App\SharedKernel\Contracts\RepositoryInterface;
use App\SharedKernel\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Eloquent\BaseRepository as L5BaseRepository;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Repository\Events\RepositoryEntityUpdated;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityDeleted;
use Prettus\Repository\Events\RepositoryEntityUpdating;
use Prettus\Repository\Events\RepositoryEntityCreating;
use Prettus\Repository\Events\RepositoryEntityDeleting;

abstract class BaseRepository extends L5BaseRepository implements RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function forceFillCreate(array $attributes): mixed
    {
        if (!is_null($this->validator)) {
            $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        event(new RepositoryEntityCreating($this, $attributes));

        $model = $this->model->newInstance();
        $model->forceFill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * Update an entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     * @return mixed
     * @throws RepositoryException
     * @throws ValidatorException
     */
    public function forceFillUpdate(array $attributes, $id): mixed
    {
        $this->applyScope();

        if (!is_null($this->validator)) {
            $model = $this->model->newInstance();
            $model->setRawAttributes([]);
            $model->setAppends([]);

            $attributes = $model->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();

            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($id);

        event(new RepositoryEntityUpdating($this, $model));

        $model->forceFill($attributes);
        $model->save();

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * Update an entity in repository by id
     *
     * @param array $where
     * @param array $data
     * @return bool
     * @throws RepositoryException
     */
    public function massUpdate(array $where, array $data): bool
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $this->applyConditions($where);

        $updated = $this->model->update($data);

        event(new RepositoryEntityUpdating($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $this->model->getModel()));

        return $updated;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function firstWhere(array $where, array $columns = ['*']): mixed
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Force deletes an entity in repository by id
     *
     * @param $id
     *
     * @return int
     * @throws RepositoryException
     */
    public function forceDelete($id): int
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        event(new RepositoryEntityDeleting($this, $model));

        $deleted = $model->forceDelete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }

    /**
     * Delete multiple entities by given criteria.
     *
     * @param array $where
     *
     * @return int
     * @throws RepositoryException
     */
    public function forceDeleteWhere(array $where): int
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $this->applyConditions($where);

        event(new RepositoryEntityDeleting($this, $this->model->getModel()));

        $deleted = $this->model->forceDelete();

        event(new RepositoryEntityDeleted($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        return $deleted;
    }
}
