@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> {{ request()->is('settings/profile') ? 'Profile' : 'Account' }}</h4>

    <div class="row fv-plugins-icon-container">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('settings/profile') ? 'active' : '' }}" href="{{ route('settings.profile') }}"><i class="ti-xs ti ti-users me-1"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('settings/account') ? 'active' : '' }}" href="{{ route('settings.account') }}"><i class="ti-xs ti ti-lock me-1"></i> Account</a>
          </li>
        </ul>

        @if (request()->is('settings/profile'))
            @include('pages.settings.profile.profile')
        @elseif (request()->is('settings/account'))
            @include('pages.settings.account.account')
        @endif

      </div>
    </div>
</div>
@endsection