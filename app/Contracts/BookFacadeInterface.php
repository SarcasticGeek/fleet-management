<?php

namespace App\Contracts;

use App\Bus;

interface BookFacadeInterface
{
    public function book(array $criteria): Bus;
}
