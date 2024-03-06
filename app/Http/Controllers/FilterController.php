<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SizeRepository;
use App\Repositories\PriceRepository;
use App\Repositories\ToppingRepository;
use App\Repositories\TemperatureRepository;

class FilterController extends Controller
{
    protected $price, $temperature, $size, $topping;

    public function __construct(PriceRepository $priceRepository, TemperatureRepository $temperatureRepository, SizeRepository $sizeRepository, ToppingRepository $toppingRepository)
    {
        $this->price = $priceRepository;
        $this->temperature = $temperatureRepository;
        $this->size = $sizeRepository;
        $this->topping = $toppingRepository;
    }

    public function filter_index()
    {
        return view('pages.filter.index', [
            'prices' => $this->price->getAllPrices(),
            'temperatures' => $this->temperature->getAllTemperatures(),
            'sizes' => $this->size->getAllSizes(),
            'toppings' => $this->topping->getAllToppings()
        ]);
    }
}
