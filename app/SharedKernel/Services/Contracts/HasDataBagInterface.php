<?php

namespace App\SharedKernel\Services\Contracts;

use App\SharedKernel\Services\DataBag;

interface HasDataBagInterface
{
    public function getDataBag(): DataBag;

    public function setDataBag(DataBag $dataBag): self;

    public function initDataBag(array $data): self;
}
