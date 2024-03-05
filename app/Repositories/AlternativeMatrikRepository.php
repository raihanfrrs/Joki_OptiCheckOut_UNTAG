<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\AlternativeMatriks;
use Illuminate\Support\Facades\DB;
use App\Repositories\NormalizationMatrikRepository;

class AlternativeMatrikRepository
{
    protected $product, $normalizationMatrik;

    public function __construct(ProductRepository $productRepository, NormalizationMatrikRepository $normalizationMatrikRepository)
    {
        $this->product = $productRepository;
        $this->normalizationMatrik = $normalizationMatrikRepository;
    }

    public function getAlternativeMatrik($id)
    {
        return AlternativeMatriks::find($id);
    }

    public function getAllAlternativeMatriks()
    {
        return AlternativeMatriks::orderBy('name')->get();
    }

    public function getAllAlternativeMatriksByUser()
    {
        return AlternativeMatriks::where('user_id', auth()->user()->id)->orderBy('created_at')->get();
    }

    public function getAllAlternativeMatriksWhereNotProductAndUser()
    {
        $product_id = [];
        foreach (self::getAllAlternativeMatriksByUser(auth()->user()->id) as $key => $product) {
            $product_id[] = $product->product_id;
        }

        return $this->product->getAllProducts()->whereNotIn('id', $product_id);
    }

    public function storeAlternativeMatrik($data)
    {
        $alternative_matrik_id = Uuid::uuid4()->toString();
        $product = $this->product->getProduct($data['product_id']);

        DB::transaction(function () use ($data, $product, $alternative_matrik_id) {
            AlternativeMatriks::create([
                'id' => $alternative_matrik_id,
                'user_id' => auth()->user()->id,
                'product_id' => $data['product_id'],
                'price_id' => $product->price_id
            ]);

            $this->normalizationMatrik->storeNormalizationMatrik($alternative_matrik_id, $product);
        });

        return true;
    }

    public function updateAlternativeMatrik($data, $alternative_matrik)
    {
        DB::transaction(function () use ($data, $alternative_matrik) {
            self::getAlternativeMatrik($alternative_matrik->id)->update([
                'price_id' => $data['price_id'],
                'temperature_id' => $data['temperature_id'],
                'size_id' => $data['size_id'],
                'topping_id' => $data['topping_id']
            ]);

            $this->normalizationMatrik->updateNormalizationMatrik($data, $alternative_matrik);
        });

        return true;
    }

    public function deleteAlternativeMatrik($id)
    {
        return self::getAlternativeMatrik($id)->delete();
    }
}