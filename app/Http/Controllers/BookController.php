<?php

namespace App\Http\Controllers;

use App\Contracts\BookFacadeInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookFacade;

    public function __construct(BookFacadeInterface $bookFacade)
    {
        $this->bookFacade = $bookFacade;
    }

    public function book(Request $request)
    {
        try {
            $isValidated = $request->validate([
                'pickup_station_id' => 'required|integer',
                'destination_station_id' => 'required|integer',
                'user_id' => 'required|integer',
            ]);
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }

        return [
            'booked' => $this->bookFacade->book($request->all()) ? 'booked' : 'canceled'
        ];
    }
}
