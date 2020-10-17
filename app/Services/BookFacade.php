<?php

namespace App\Services;

use App\Bus;
use App\Constant\BusesCapacity;
use App\Contracts\BookFacadeInterface;
use App\Contracts\BusRepositoryInterface;
use App\Contracts\CustomerManagerInterface;
use App\Contracts\RouteRepositoryInterface;
use App\Route;

/**
 * Class BookFacade
 * @package App\Services
 */
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

    /**
     * @var BusRepositoryInterface
     */
    protected $busRepository;

    /**
     * BookFacade constructor.
     * @param RouteRepositoryInterface $routes
     * @param CustomerManagerInterface $customerManager
     * @param BusRepositoryInterface $busRepository
     */
    public function __construct(RouteRepositoryInterface $routes, CustomerManagerInterface $customerManager, BusRepositoryInterface $busRepository)
    {
        $this->routeRepository = $routes;
        $this->customerManager = $customerManager;
        $this->busRepository = $busRepository;
    }

    /**
     * @param array $criteria
     * @return bool|null
     */
    public function book(array $criteria): ?bool
    {
        $bus = $this->routeRepository->searchBuses($criteria['pickup_station_id'], $criteria['destination_station_id']);

        $routes = $this->routeRepository->getRoutesTree($bus->getAttribute('id'), $criteria['pickup_station_id'], $criteria['destination_station_id']);

        if (!$this->checkIfBusAvailable($routes)) {
            $this->customerManager->cancel($criteria['user_id']);
            return false;
        }

        $this->busRepository->incrementCapacity($bus->getAttribute('id'));

        return $this->addCustomerToRoute($criteria['user_id'], $criteria['destination_station_id'], $routes);
    }

    /**
     * @param int $startStation
     * @param int $endStation
     * @return int
     */
    public function getAvailableSeats(int $startStation, int $endStation): int
    {
        $bus = $this->routeRepository->searchBuses($startStation, $endStation);

        return BusesCapacity::MINI_BUS - intval($bus->getAttribute('capacity'));
    }

    /**
     * @param array $routes
     * @return bool
     */
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

    /**
     * @param int $user
     * @param int $destinationStation
     * @param array $routes
     * @return bool
     */
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
