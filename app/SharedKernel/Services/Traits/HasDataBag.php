<?php

namespace App\SharedKernel\Services\Traits;

use App\SharedKernel\Services\DataBag;

trait HasDataBag
{
    protected DataBag $dataBag;

    public function initDataBag(array $data): self
    {
        $this->dataBag = new DataBag($data);

        return $this;
    }

    public function getDataBag(): DataBag
    {
        return $this->dataBag;
    }

    public function setDataBag(DataBag $dataBag): self
    {
        $this->dataBag = $dataBag;

        return $this;
    }
}
