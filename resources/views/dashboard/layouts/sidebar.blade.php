<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar my-3">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (empty(Auth::guard('admin')->user()->image))
                    <img src="{{ asset('storage/avatars/default.png') }}"alt="User Image" class="img-circle elevation-2">
                @else
                    <img src="{{ asset('storage/avatars/'.Auth::guard('admin')->user()->image) }}"alt="User Image" class="img-circle elevation-2">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('view',  App\Models\Admin::class)
                    <li class="nav-item {{ Route::is('admin.admins.*')  ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('admin.admins.*')  ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Admins
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.admins.index') }}" class="nav-link {{ Route::is('admin.admins.index')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Show admins</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.admins.create') }}" class="nav-link {{ Route::is('admin.admins.create')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add an admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="nav-item {{ Route::is('admin.users.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.users.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Route::is('admin.users.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show users</p>
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.users.index') && request()->has('trashed')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ url('/dashboard/users?trashed') }}">
                                <i class="fa-solid fa-trash-can-arrow-up nav-icon"></i>
                                <p>Deleted users</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}" class="nav-link {{ Route::is('admin.users.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add an admin</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
               
                <li class="nav-item {{ Route::is('admin.orders.index') || Route::is('admin.orders.view')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.orders.index') || Route::is('admin.orders.view')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                           Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ !request()->has('history') && Route::is('admin.orders.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/orders?history') }}" class="nav-link @if (Route::is('admin.orders.index') && request()->has('history')) ? 'active' : '' bg-white @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show orders history</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.sections.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.sections.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Sections
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sections.index') }}" class="nav-link {{ Route::is('admin.sections.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show sections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sections.create') }}" class="nav-link {{ Route::is('admin.sections.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add a new section</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.categories.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.categories.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Route::is('admin.categories.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ Route::is('admin.categories.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add a new category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.brands.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.brands.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Brands
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.index') }}" class="nav-link {{ Route::is('admin.brands.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.create') }}" class="nav-link {{ Route::is('admin.brands.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add a new brand</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.products.*') || Route::is('admin.specs.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.products.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ Route::is('admin.products.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link {{ Route::is('admin.products.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add a new product</p>
                            </a>
                        </li>
                    </ul>
                    <li class="nav-item {{ Route::is('admin.specs.*')  ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('admin.specs.*')  ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Specs
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.specs.index') }}" class="nav-link {{ Route::is('admin.specs.index')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Show specs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.specs.create') }}" class="nav-link {{ Route::is('admin.specs.create')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add a new spec</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Route::is('admin.offers.*')  ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('admin.offers.*')  ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Offers
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.offers.index') }}" class="nav-link {{ Route::is('admin.offers.index')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Show offers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.offers.create') }}" class="nav-link {{ Route::is('admin.offers.create')  ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add a new offer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>

                <li class="nav-item {{ Route::is('admin.banners.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.banners.*')  ? 'active' : '' }}">
                        <i class="nav-icon fa-regular fa-image"></i>
                        <p>
                            Banners
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.index') }}" class="nav-link {{ Route::is('admin.banners.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show banners</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.create') }}" class="nav-link {{ Route::is('admin.banners.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add an banner</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>