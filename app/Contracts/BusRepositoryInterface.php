<?php

namespace App\Contracts;

use App\Bus;

interface BusRepositoryInterface
{
    public function incrementCapacity(int $id): void;
}
