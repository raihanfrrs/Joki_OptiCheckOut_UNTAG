<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-icon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    @guest
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    @endguest

    <!-- Page CSS -->
    @auth
        @if (auth()->user()->level == 'admin')
        
        @elseif (auth()->user()->level == 'cashier')
            @if (request()->is('invoice/*'))
                <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
            @elseif (request()->is('invoice/*/print'))
                <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice-print.css') }}" />
            @endif
        @endif
        
        @if (request()->is('profile', 'teams'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
        @elseif (request()->is('404', '403'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}" />
        @endif
    @else
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    @endauth

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  </head>

  <body>

    @include('components.flasher.flasher')

    @include('components.modal.modal')

    @auth
        @if (request()->is('invoice/*/print') || request()->is('admin/sales-report-print/*/*') || request()->is('admin/invoice/*/*'))
            @yield('section-print')
        @elseif (request()->is('404', '403'))
            @yield('section-error')
        @else
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">
        
                @include('partials.sidebar')
        
                <div class="layout-page">
                
                    @include('partials.navbar')
        
                    <div class="content-wrapper">
        
                    @yield('section-content')
        
                    <div class="content-backdrop fade"></div>
                    </div>
                </div>
                </div>
        
                <div class="layout-overlay layout-menu-toggle"></div>
        
                <div class="drag-target"></div>
            </div>
        @endif
    @else
        @yield('section-authentication')
    @endauth

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    @auth
        <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    @else
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    @endauth
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/prev-image.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @auth
        @if (auth()->user()->level == 'admin')
            <script src="{{ asset('js/admin.js') }}"></script>
        @elseif (auth()->user()->level == 'cashier')
            <script src="{{ asset('js/cashier.js') }}"></script>
        @endif
    @endauth

    <!-- Page JS -->
    @auth
        @if (auth()->user()->level == 'admin')
            @if (request()->is('master/cashier', 'master/cashier/*'))
                <script src="{{ asset('assets/js/app-master-cashier-list.js') }}"></script>
                <script src="{{ asset('assets/js/wizard-ex-property-listing.js') }}"></script>
            @elseif (request()->is('master/product'))
                <script src="{{ asset('assets/js/app-master-product-list.js') }}"></script>
            @elseif (request()->is('master/category'))
                <script src="{{ asset('assets/js/app-master-category-list.js') }}"></script>
            @elseif (request()->is('admin/sales-report/daily'))
                <script src="{{ asset('assets/js/app-sales-report-admin-daily-list.js') }}"></script>
            @elseif (request()->is('admin/sales-report/monthly'))
                <script src="{{ asset('assets/js/app-sales-report-admin-monthly-list.js') }}"></script>
            @elseif (request()->is('admin/sales-report/yearly'))
                <script src="{{ asset('assets/js/app-sales-report-admin-yearly-list.js') }}"></script>
            @elseif (request()->is('admin/performance-report'))
                <script src="{{ asset('assets/js/app-performance-report-admin-list.js') }}"></script>
            @elseif (request()->is('admin/invoice'))
                <script src="{{ asset('assets/js/app-invoice-admin-list.js') }}"></script>
            @elseif (request()->is('admin/sales-report-print/*/*') || request()->is('admin/invoice/*/*'))
                <script src="{{ asset('assets/js/app-invoice-print.js') }}"></script>
            @endif
        @elseif (auth()->user()->level == 'cashier')
            @if (request()->is('inventory/product'))
                <script src="{{ asset('assets/js/app-inventory-product-list.js') }}"></script>
            @elseif (request()->is('invoice/*/print'))
                <script src="{{ asset('assets/js/app-invoice-print.js') }}"></script>
            @elseif (request()->is('cashier/sales-report'))
                <script src="{{ asset('assets/js/app-sales-report-cashier-list.js') }}"></script>
            @endif
        @endif

        @if (request()->is('settings/profile'))
            <script src="{{ asset('assets/js/pages-account-settings-account.js')  }}"></script>
        @elseif (request()->is('settings/account'))
            <script src="{{ asset('assets/js/pages-account-settings-security.js') }}"></script>
        @elseif (request()->is('profile', 'teams'))
            <script src="{{ asset('assets/js/app-admin-activity-list.js') }}"></script>
            <script src="{{ asset('assets/js/app-cashier-activity-list.js') }}"></script>
            <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
        @endif
    @else
        <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    @endauth
    
    @stack('scripts')
  </body>
</html>
