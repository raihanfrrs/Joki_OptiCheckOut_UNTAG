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
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
              <div data-i18n="Analitik">Analitik</div>
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
          <div data-i18n="Kasir">Kasir</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('master/product') ? 'active' : '' }}">
        <a href="{{ route('master.product.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-soup"></i>
          <div data-i18n="Produk">Produk</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('master/category') ? 'active' : '' }}">
        <a href="{{ route('master.category.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-box"></i>
          <div data-i18n="Kategori">Kategori</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SPESIAL</span>
      </li>
      <li class="menu-item {{ request()->is('admin/matrik') ? 'active' : '' }}">
        <a href="{{ route('admin.matrik.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-hexagons"></i>
          <div data-i18n="Matrik">Matrik</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/preference') ? 'active' : '' }}">
        <a href="{{ route('admin.preference.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-arrows-vertical"></i>
          <div data-i18n="Nilai Preferensi">Nilai Preferensi</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">LAPORAN</span>
      </li>
      <li class="menu-item {{ request()->is('admin/sales-report/*') ? 'active open' : '' }}" style="">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-chart-pie"></i>
          <div data-i18n="Penjualan">Penjualan</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('admin/sales-report/daily') ? 'active' : '' }}">
            <a href="{{ route('admin.sales.report.daily') }}" class="menu-link">
              <div data-i18n="Harian">Harian</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('admin/sales-report/monthly') ? 'active' : '' }}">
            <a href="{{ route('admin.sales.report.monthly') }}" class="menu-link">
              <div data-i18n="Bulanan">Bulanan</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('admin/sales-report/yearly') ? 'active' : '' }}">
            <a href="{{ route('admin.sales.report.yearly') }}" class="menu-link">
              <div data-i18n="Tahunan">Tahunan</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ request()->is('admin/performance-report') ? 'active' : '' }}">
        <a href="{{ route('admin.performance.report') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
          <div data-i18n="Performa">Performa</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('admin/invoice', 'admin/invoice/*') ? 'active' : '' }}">
        <a href="{{ route('admin.invoice') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-checklist"></i>
          <div data-i18n="Faktur">Faktur</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">LAINNYA</span>
      </li>
      <li class="menu-item {{ request()->is('filter', 'filter/*') ? 'active' : '' }}">
        <a href="{{ route('filter.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-list-search"></i>
          <div data-i18n="Filter">Filter</div>
        </a>
      </li>
      @elseif (auth()->user()->level == 'cashier')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">PERSEDIAAN</span>
      </li>
      <li class="menu-item {{ request()->is('inventory/product') ? 'active' : '' }}">
        <a href="{{ route('inventory.product.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
          <div data-i18n="Produk">Produk</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MENU</span>
      </li>
      <li class="menu-item {{ request()->is('products', 'products/*') ? 'active' : '' }}">
        <a href="{{ route('products.index', 'all') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-basket"></i>
          <div data-i18n="Transaksi">Transaksi</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SPESIAL</span>
      </li>
      <li class="menu-item {{ request()->is('cashier/matrik') ? 'active' : '' }}">
        <a href="{{ route('cashier.matrik.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-hexagons"></i>
          <div data-i18n="Matrik">Matrik</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('cashier/preference') ? 'active' : '' }}">
        <a href="{{ route('cashier.preference.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-arrows-vertical"></i>
          <div data-i18n="Nilai Preferensi">Nilai Preferensi</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">LAPORAN</span>
      </li>
      <li class="menu-item {{ request()->is('cashier/sales-report', 'cashier/sales-report/*') ? 'active' : '' }}">
        <a href="{{ route('sales.report.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
          <div data-i18n="Penjualan">Penjualan</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">LAINNYA</span>
      </li>
      <li class="menu-item {{ request()->is('filter', 'filter/*') ? 'active' : '' }}">
        <a href="{{ route('filter.index') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-list-search"></i>
          <div data-i18n="Filter">Filter</div>
        </a>
      </li>
      @endif
    </ul>
</aside>