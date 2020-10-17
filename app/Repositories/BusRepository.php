<?php

namespace App\Repositories;

use App\Bus;
use App\Constant\BusesCapacity;
use App\Contracts\BusRepositoryInterface;

class BusRepository implements BusRepositoryInterface
{
    protected $model;

    public function __construct(Bus $bus)
    {
        $this->model = $bus;
    }

    public function incrementCapacity(int $id): void
    {
        $bus = $this->model->find($id);
        $bus->capacity = $bus->capacity + 1;
        if ($bus->capacity == BusesCapacity::MINI_BUS) {
            $bus->isFull = true;
        }

        $bus->save();
    }
}
