<?php

namespace App\SharedKernel\Actions\Resources;

use App\SharedKernel\Exceptions\BaseException;

abstract class AbstractReadAction extends AbstractSingleResourceAction
{
    /**
     * @throws BaseException
     */
    protected function controller(): array
    {
        $this->addRelations();

        $dto = $this->getResource();

        return $this->transformDTO($dto);
    }
}
