<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use App\Repositories\CashierRepository;
use App\Repositories\ProfileRepository;

class ProfileController extends Controller
{
    protected $profile, $cashier, $activity;

    public function __construct(ProfileRepository $profileRepository, CashierRepository $cashierRepository, ActivityRepository $activityRepository)
    {
        $this->profile = $profileRepository;
        $this->cashier = $cashierRepository;
        $this->activity = $activityRepository;
    }

    public function profile()
    {
        $data = auth()->user()->level == 'admin' ? auth()->user()->admin : auth()->user()->cashier;
        $activity = $this->activity->getTodayActivitesCountByUserId();
        $cashier = $this->cashier->getAllCashiers();

        return view('pages.profile.index', compact('data', 'activity', 'cashier'));
    }

    public function teams()
    {
        if (auth()->user()->level == 'cashier') {
            return redirect()->route('403');
        }

        $data = auth()->user()->level == 'admin' ? auth()->user()->admin : auth()->user()->cashier;
        $teams = $this->cashier->getAllCashiers();

        return view('pages.profile.index', compact('data', 'teams'));
    }
}
