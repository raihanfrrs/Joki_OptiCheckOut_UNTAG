<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bold text-uppercase">{{ auth()->user()->level }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ request()->is('/') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboards">Dashboards</div>
          <div class="badge bg-label-primary rounded-pill ms-auto">3</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="index.html" class="menu-link">
              <div data-i18n="Analytics">Analytics</div>
            </a>
          </li>
        </ul>
      </li>

      @if (auth()->user()->level == 'admin')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MASTER</span>
      </li>
      <li class="menu-item {{ request()->is('master/cashier', 'master/cashier/*') ? 'active' : '' }}">
        <a href="{{ route('master.cashier.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="Cashier">Cashier</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('master/product') ? 'active' : '' }}">
        <a href="{{ route('master.product.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-soup"></i>
          <div data-i18n="Product">Product</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('master/category') ? 'active' : '' }}">
        <a href="{{ route('master.category.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-box"></i>
          <div data-i18n="Category">Category</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">REPORTING</span>
      </li>
      <li class="menu-item">
        <a href="app-email.html" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
          <div data-i18n="Sales">Sales</div>
        </a>
      </li>
      @elseif (auth()->user()->level == 'cashier')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">INVENTORY</span>
      </li>
      <li class="menu-item">
        <a href="app-email.html" class="menu-link">
          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
          <div data-i18n="Product">Product</div>
        </a>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MENU</span>
      </li>
      <li class="menu-item">
        <a href="app-email.html" class="menu-link">
          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
          <div data-i18n="Transaction">Transaction</div>
        </a>
      </li>
      @endif
    </ul>
</aside>