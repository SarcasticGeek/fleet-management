<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function book(Request $request)
    {
        return [
            'oke' => true
        ];
    }
}
