<?php

namespace App\Services;

use App\Bus;
use App\Constant\BusesCapacity;
use App\Contracts\BookFacadeInterface;
use App\Contracts\CustomerManagerInterface;
use App\Contracts\RouteRepositoryInterface;
use App\Route;

class BookFacade implements BookFacadeInterface
{
    /**
     * @var RouteRepositoryInterface
     */
    protected $routeRepository;

    /**
     * @var CustomerManagerInterface
     */
    protected $customerManager;

    public function __construct(RouteRepositoryInterface $routes, CustomerManagerInterface $customerManager)
    {
        $this->routeRepository = $routes;
        $this->customerManager = $customerManager;
    }

    public function book(array $criteria): ?bool
    {
        $bus = $this->routeRepository->searchBuses($criteria['pickup_station_id'], $criteria['destination_station_id']);

        $routes = $this->routeRepository->getRoutesTree($bus->getAttribute('id'), $criteria['pickup_station_id'], $criteria['destination_station_id']);

        if (!$this->checkIfBusAvailable($routes)) {
            $this->customerManager->cancel($criteria['user_id']);
            return false;
        }

        return $this->addCustomerToRoute($criteria['user_id'], $criteria['destination_station_id'], $routes);
    }

    private function checkIfBusAvailable(array $routes): bool
    {
        foreach ($routes as $route)
        {
            if ($route['is_passed'] || $route['capacity'] >= BusesCapacity::MINI_BUS) {
                return false;
            }
        }

        return true;
    }

    private function addCustomerToRoute(int $user, int $destinationStation, array $routes)
    {
        foreach ($routes as $route)
        {
            $this->routeRepository->incrementCapacity($route['id']);
            if ($route['station_id'] === $destinationStation) {
                $this->customerManager->addToRoute($user, $route['id']);
                continue;
            }
        }

        return true;
    }

}
