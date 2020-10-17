<?php

namespace App\Services;

use App\Constant\CustomerStatus;
use App\Contracts\CustomerManagerInterface;
use App\Customer;

class CustomerManager implements CustomerManagerInterface
{
    public function addToRoute(int $user, int $route): void
    {
        Customer::where('id', $user)
            ->update(['route_id' => $route, 'status' => CustomerStatus::BOOKED]);
    }

    public function cancel(int $user): void
    {
        Customer::where('id', $user)
            ->update(['status' => CustomerStatus::CANCELLED]);
    }
}
