<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profile;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profile = $profileRepository;
    }

    public function index()
    {
        $data = auth()->user()->level == 'admin' ? auth()->user()->admin : auth()->user()->cashier;

        return view('pages.profile.index', compact('data'));
    }
}
