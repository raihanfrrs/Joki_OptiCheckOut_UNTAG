<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\PreferencesMatriks;
use Illuminate\Support\Facades\DB;

class PreferencesMatrikRepository
{
    public function getAllPreferencesMatriksByUser()
    {
        return PreferencesMatriks::where('user_id', auth()->user()->id)->orderBy('created_at')->get();
    }

    public function getAllPreferencesMatrikRanksByUser()
    {
        return PreferencesMatriks::where('user_id', auth()->user()->id)->orderBy('value', 'desc')->get();
    }

    public function getPreferencesMatrikByNormalizationMatrik($id)
    {
        return PreferencesMatriks::where('normalization_matrik_id', $id)->first();
    }

    public function storePreferencesMatrik($price, $normalization_matrik_id)
    {   
        $preferences_matrik_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($price, $normalization_matrik_id, $preferences_matrik_id) {
            PreferencesMatriks::create([
                'id' => $preferences_matrik_id,
                'user_id' => auth()->user()->id,
                'normalization_matrik_id' => $normalization_matrik_id,
                'value' => ($price * 4) + (0 * 3) + (0 * 3) + (0 * 3),
            ]);
        });

        return true;
    }   

    public function updatePreferencesMatrik($data, $normalization_matrik_id)
    {
        DB::transaction(function () use ($data, $normalization_matrik_id) {
            PreferencesMatriks::where('normalization_matrik_id', $normalization_matrik_id)->update([
                'value' => ($data['price'] * 4) + ($data['temperature'] * 3) + ($data['size'] * 3) + ($data['topping'] * 3),
            ]);
        });
    }
}