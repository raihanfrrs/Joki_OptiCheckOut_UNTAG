<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\Models\NormalizationMatriks;
use App\Repositories\SizeRepository;
use App\Repositories\PriceRepository;
use App\Repositories\ToppingRepository;
use App\Repositories\TemperatureRepository;

class NormalizationMatrikRepository
{
    protected $price, $temperature, $size, $topping, $preferencesMatrik;
    
    public function __construct(PriceRepository $priceRepository, TemperatureRepository $temperatureRepository, SizeRepository $sizeRepository, ToppingRepository $toppingRepository, PreferencesMatrikRepository $preferencesMatrikRepository)
    {
        $this->price = $priceRepository;
        $this->temperature = $temperatureRepository;
        $this->size = $sizeRepository;
        $this->topping = $toppingRepository;
        $this->preferencesMatrik = $preferencesMatrikRepository;
    }

    public function getNormalizationMatrik($id)
    {
        return NormalizationMatriks::find($id);
    }

    public function getNormalizationMatrikByAlternativeMatrik($id)
    {
        return NormalizationMatriks::where('alternative_matrik_id', $id)->first();
    }
    
    public function getAllNormalizationMatriks()
    {
        return NormalizationMatriks::orderBy('name')->get();
    }

    public function getAllNormalizationMatriksByUser()
    {
        return NormalizationMatriks::where('user_id', auth()->user()->id)->orderBy('created_at')->get();
    }

    public function storeNormalizationMatrik($alternative_matrik_id, $product)
    {
        $normalization_matrik_id = Uuid::uuid4()->toString();
        $minimun_price = $this->price->getMinimumPrice();

        DB::transaction(function () use ($alternative_matrik_id, $product, $minimun_price, $normalization_matrik_id) {
            NormalizationMatriks::create([
                'id' => $normalization_matrik_id,
                'user_id' => auth()->user()->id,
                'alternative_matrik_id' => $alternative_matrik_id,
                'price' => $product->price->rating->rating / $minimun_price
            ]);

            $this->preferencesMatrik->storePreferencesMatrik($minimun_price / $product->price->rating->rating, $normalization_matrik_id);
        });

        return true;
    }

    public function storeNormalizationMatrikFormFilter($alternative_matrik_id, $product)
    {
        $normalization_matrik_id = Uuid::uuid4()->toString();
        $minimun_price = $this->price->getMinimumPrice();
        $maximum_temperature = $this->temperature->getMaximumTemperature();
        $maximum_size = $this->size->getMaximumSize();
        $maximum_topping = $this->topping->getMaximumTopping();

        $normalization_matrik_query = NormalizationMatriks::create([
            'id' => $normalization_matrik_id,
            'user_id' => auth()->user()->id,
            'alternative_matrik_id' => $alternative_matrik_id,
            'price' => $product->price->rating->rating / $minimun_price,
            'temperature' => $maximum_temperature / $product->temperature->rating->rating,
            'size' => $maximum_size / $product->size->rating->rating,
            'topping' => $maximum_topping / $product->topping->rating->rating
        ]);

        $preferences_matrik_query = $this->preferencesMatrik->storePreferencesMatrikFormFilter($normalization_matrik_query, $normalization_matrik_id);

        if ($normalization_matrik_query && $preferences_matrik_query) {
            return true;
        }

        return false;
    }

    public function updateNormalizationMatrik($data, $alternative_matrik)
    {
        $minimun_price = $this->price->getMinimumPrice();
        $maximum_temperature = $this->temperature->getMaximumTemperature();
        $maximum_size = $this->size->getMaximumSize();
        $maximum_topping = $this->topping->getMaximumTopping();

        $price = $this->price->getPrice($data['price_id']);
        $temperature = $this->temperature->getTemperature($data['temperature_id']);
        $size = $this->size->getSize($data['size_id']);
        $topping = $this->topping->getTopping($data['topping_id']);

        DB::transaction(function () use ($alternative_matrik, $minimun_price, $maximum_temperature, $maximum_size, $maximum_topping, $price, $temperature, $size, $topping) {
            self::getNormalizationMatrikByAlternativeMatrik($alternative_matrik->id)->update([
                'price' => ($price->rating->rating ?? 0) / $minimun_price,
                'temperature' => $maximum_temperature / ($temperature->rating->rating ?? 0),
                'size' => $maximum_size / ($size->rating->rating ?? 0),
                'topping' => $maximum_topping / ($topping->rating->rating ?? 0)
            ]);

            $this->preferencesMatrik->updatePreferencesMatrik([
                'price' => ($price->rating->rating ?? 0) / $minimun_price,
                'temperature' => $maximum_temperature / ($temperature->rating->rating ?? 0),
                'size' => $maximum_size / ($size->rating->rating ?? 0),
                'topping' => $maximum_topping / ($topping->rating->rating ?? 0)
            ], self::getNormalizationMatrikByAlternativeMatrik($alternative_matrik->id)->id);
        });

        return true;
    }
}