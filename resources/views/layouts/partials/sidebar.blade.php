<div class="sidebar" id="sidebar">
    <div class="text-center mb-4">
        <h4 class="text-white mb-0" id="sidebar-title">SPM Electro</h4>
    </div>
    <ul class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>



        <!-- Home Menu -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.hero-sliders.*', 'admin.home-contents.*', 'admin.global-partners.*', 'admin.satisfied-clients.*', 'admin.certifications.*') ? '' : 'collapsed' }}"
               href="#" data-bs-toggle="collapse" data-bs-target="#collapseHome" aria-expanded="false">
                <span><i class="bi bi-house me-2"></i>Home</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div id="collapseHome" class="collapse {{ request()->routeIs('admin.hero-sliders.*', 'admin.home-contents.*', 'admin.global-partners.*', 'admin.satisfied-clients.*', 'admin.certifications.*') ? 'show' : '' }}">
                <ul class="nav flex-column ms-4">
                    @can('hero_sliders.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.hero-sliders.*') ? 'active' : '' }}" href="{{ route('admin.hero-sliders.index') }}">
                            Hero Sliders
                        </a>
                    </li>
                    @endcan
                    @can('home_contents.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.home-contents.*') ? 'active' : '' }}" href="{{ route('admin.home-contents.index') }}">
                            Content
                        </a>
                    </li>
                    @endcan
                    @can('global_partners.view')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.global-partners.*') ? 'active' : '' }}" href="{{ route('admin.global-partners.index') }}">
                                Global Partners
                            </a>
                        </li>
                    @endcan
                    @can('satisfied_clients.view')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.satisfied-clients.*') ? 'active' : '' }}" href="{{ route('admin.satisfied-clients.index') }}">
                                Satisfied Clients
                            </a>
                        </li>
                    @endcan
                    @can('certifications.view')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}" href="{{ route('admin.certifications.index') }}">
                                Certifications
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>

        <!-- About Us Menu -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.board-members.*') ? '' : 'collapsed' }}"
               href="#" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false">
                <span><i class="bi bi-info-circle me-2"></i>About Us</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div id="collapseAbout" class="collapse {{ request()->routeIs('admin.board-members.*') ? 'show' : '' }}">
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.board-members.*') ? 'active' : '' }}" href="{{ route('admin.board-members.index') }}">
                            Board of Directors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.office-locations.*') ? 'active' : '' }}" href="{{ route('admin.office-locations.index') }}">
                            Footer Offices
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Others Menu (Services & Page Settings) -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.services.*', 'admin.page-contents.*', 'admin.contacts.*') ? '' : 'collapsed' }}"
               href="#" data-bs-toggle="collapse" data-bs-target="#collapseOthers" aria-expanded="false">
                <span><i class="bi bi-sliders me-2"></i>Others</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div id="collapseOthers" class="collapse {{ request()->routeIs('admin.services.*', 'admin.page-contents.*', 'admin.contacts.*') ? 'show' : '' }}">
                <ul class="nav flex-column ms-4">
                    @can('services.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">Services</a>
                    </li>
                    @endcan
                    @can('page_contents.edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.page-contents.*') ? 'active' : '' }}" href="{{ route('admin.page-contents.edit') }}">Page Settings</a>
                    </li>
                    @endcan
                    @can('contacts.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">Contacts</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>

        <!-- User Management Menu -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.users.*', 'admin.roles.*') ? '' : 'collapsed' }}"
               href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false">
                <span><i class="bi bi-people me-2"></i>User Management</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div id="collapseUsers" class="collapse {{ request()->routeIs('admin.users.*', 'admin.roles.*') ? 'show' : '' }}">
                <ul class="nav flex-column ms-4">
                    @can('users.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                    @endcan
                    @can('roles.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">Roles</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>

        <!-- Product Management Menu -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.product-categories.*', 'admin.products.*') ? '' : 'collapsed' }}"
               href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false">
                <span><i class="bi bi-box-seam me-2"></i>Product Management</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div id="collapseProducts" class="collapse {{ request()->routeIs('admin.product-categories.*', 'admin.products.*') ? 'show' : '' }}">
                <ul class="nav flex-column ms-4">
                    @can('product_categories.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}" href="{{ route('admin.product-categories.index') }}">{{ __('common.product_categories') }}</a>
                    </li>
                    @endcan
                    @can('products.view')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">{{ __('common.products') }}</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
    </ul>
</div>
