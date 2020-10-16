<?php

namespace App\Services;

use App\Bus;
use App\Contracts\BookFacadeInterface;

class BookFacade implements BookFacadeInterface
{

    public function book(array $criteria): Bus
    {
        return Bus::find(1);
    }
}
