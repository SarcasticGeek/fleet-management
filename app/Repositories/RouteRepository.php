<?php

namespace App\Repositories;

use App\Bus;
use App\Contracts\RouteRepositoryInterface;
use App\Route;

class RouteRepository implements RouteRepositoryInterface
{
    /**
     * @var Route
     */
    protected $model;

    public function __construct(Route $model)
    {
        $this->model = $model;
    }

    public function getRoutesTree(int $bus, int $pickupLocation, int $destinationLocation): array
    {
        /** @var Route $node */
        $node = $this->model->where(['station_id' => $destinationLocation, 'bus_id' => $bus])->firstOrFail();
        $nodes = [$node->getAttributes()];
        while ($parent = $node->getParentId()) {
            $node = $this->findById($parent);
            $nodes []= $node->getAttributes();
        }

        return array_reverse($nodes);
    }

    public function findById(int $id): ?Route
    {
        return $this->model->where(['id' => $id])->firstOrFail();
    }

    public function searchBuses(int $pickupLocation, int $destinationLocation): ?Bus
    {
        return Bus::find(1);
    }

    public function incrementCapacity(int $id): void
    {
        $route = $this->model->find($id);
        $route->capacity = $route->capacity + 1;
        $route->save();
    }
}
