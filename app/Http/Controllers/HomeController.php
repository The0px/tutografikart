<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Weather;

class HomeController extends Controller
{
    public function __construct(private Weather $weather) {}

    public function index()
    {
        // dd($this->weather);
        $properties = Property::available()->recent()->limit(4)->get();

        return view('home', ['properties' => $properties]);
    }
}
