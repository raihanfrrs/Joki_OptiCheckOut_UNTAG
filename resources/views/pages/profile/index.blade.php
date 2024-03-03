@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">My Profile /</span> Profile</h4>

    <!-- Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                @if (auth()->user()->level == 'admin')
                    @if (auth()->user()->admin->getFirstMediaUrl('admin_images'))
                        <img src="{{ auth()->user()->admin->getFirstMediaUrl('admin_images') }}" alt="user-avatar" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                    @endif
                @else
                    @if (auth()->user()->cashier->getFirstMediaUrl('cashier_images'))
                        <img src="{{ auth()->user()->cashier->getFirstMediaUrl('cashier_images') }}" alt="user-avatar" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                    @else
                        <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                    @endif
                @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4 class="text-capitalize">{{ $data->first_name . ' ' . $data->last_name }}</h4>
                  <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                    <li class="list-inline-item text-capitalize"><i class="ti ti-color-swatch"></i> {{ $data->user->level }}</li>
                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Joined {{ \Carbon\Carbon::parse($data->created_at)->format('F Y') }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}"><i class="ti ti-user-check ti-xs me-1"></i> Profile</a>
          </li>
          @if (auth()->user()->level == 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('teams') ? 'active' : '' }}" href="{{ route('teams') }}"><i class="ti ti-users ti-xs me-1"></i> Teams</a>
          </li>
          @endif
        </ul>
      </div>
    </div>

    @if (request()->is('profile'))
      @include('pages.profile.profile')
    @elseif (request()->is('teams'))
      @include('pages.profile.teams')
    @endif
</div>
@endsection