<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function detail($slug)
    {
        $car = CarModel::with(['category', 'activeCarTypes', 'carColors'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('cars.detail', compact('car'));
    }
}
