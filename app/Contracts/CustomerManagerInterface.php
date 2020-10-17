<?php

namespace App\Contracts;

interface CustomerManagerInterface
{
    public function addToRoute(int $user, int $route): void;

    public function cancel(int $user): void;
}
