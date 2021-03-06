<?php

namespace App\Contracts;

use App\Bus;

interface BookFacadeInterface
{
    public function book(array $criteria): ?bool;

    public function getAvailableSeats(int $startStation, int $endStation): int;
}
