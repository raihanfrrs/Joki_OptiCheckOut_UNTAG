<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternativeMatriks;
use App\Repositories\AlternativeMatrikRepository;
use App\Repositories\PreferencesMatrikRepository;
use App\Repositories\NormalizationMatrikRepository;

class CashierCalculationController extends Controller
{
    protected $alternativeMatrik, $normalizationMatrik, $preferenceMatrik;

    public function __construct(AlternativeMatrikRepository $alternativeMatrikRepository, NormalizationMatrikRepository $normalizationMatrikRepository, PreferencesMatrikRepository $preferencesMatrikRepository)
    {
        $this->alternativeMatrik = $alternativeMatrikRepository;
        $this->normalizationMatrik = $normalizationMatrikRepository;
        $this->preferenceMatrik = $preferencesMatrikRepository;
    }

    public function cashier_matrik_index()
    {
        return view('pages.cashier.saw.matrik.index', [
            'alternative_matriks' => $this->alternativeMatrik->getAllAlternativeMatriksByUser(),
            'normalization_matriks' => $this->normalizationMatrik->getAllNormalizationMatriksByUser()
        ]);
    }

    public function cashier_matrik_store(Request $request)
    {
        try {
            if ($this->alternativeMatrik->storeAlternativeMatrik($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Matrik Berhasil Ditambahkan!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => "Matrik Gagal Disimpan: {$th->getMessage()}"
            ]);
        }
    }

    public function cashier_matrik_update(Request $request, AlternativeMatriks $alternative_matrik)
    {
        if ($this->alternativeMatrik->updateAlternativeMatrik($request, $alternative_matrik)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => "{$alternative_matrik->product->name} Berhasil Diubah!"
            ]);
        }
    }

    public function cashier_matrik_delete(AlternativeMatriks $alternative_matrik)
    {
        if ($this->alternativeMatrik->deleteAlternativeMatrik($alternative_matrik->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => "{$alternative_matrik->product->name} Berhasil Dihapus!"
            ]);
        }
    }

    public function cashier_preference_index()
    {
        return view('pages.cashier.saw.preference.index', [
            'preferences_matriks' => $this->preferenceMatrik->getAllPreferencesMatriksByUser(),
            'preferences_matrik_ranks' => $this->preferenceMatrik->getAllPreferencesMatrikRanksByUser()
        ]);
    }
}