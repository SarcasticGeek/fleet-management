<?php

namespace App\Contracts;

use App\Bus;
use App\Route;

interface RouteRepositoryInterface
{
    public function getRoutesTree(int $bus, int $pickupLocation, int $destinationLocation): array;

    public function findById(int $id): ?Route;

    public function searchBuses(int $pickupLocation, int $destinationLocation): ?Bus;

    public function incrementCapacity(int $id): void;
}
