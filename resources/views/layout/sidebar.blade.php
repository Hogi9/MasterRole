<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{ url('/dashboard') }}" class="app-brand-link">
			<span class="app-brand-text demo menu-text text-capitalize fw-bolder ms-2">Master Login</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		<li class="menu-item {{ request()->is('dashboard') || request()->is('dashboard*') ? 'active' : '' }}">
			<a href="{{ url('/dashboard') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Analytics">Dashboard</div>
			</a>
		</li>

		@if (Auth::user()->hasAnyPermission(['role.create', 'role.update', 'role.view', 'role.delete']))
			<li class="menu-item {{ request()->is('hak-akses*') ? 'active open' : '' }}">
				<a href="javascript:void(0);" class="menu-link menu-toggle">
					<i class="menu-icon tf-icons bx bx-layout"></i>
					<div data-i18n="Hak Akses">Hak Akses</div>
				</a>

				<ul class="menu-sub">
					<li class="menu-item {{ request()->is('hak-akses/role*') ? 'active' : '' }}">
						<a href="{{ url('/hak-akses/role') }}" class="menu-link">
							<div data-i18n="Role">Role</div>
						</a>
					</li>
					<li class="menu-item {{ request()->is('hak-akses/permission*') ? 'active' : '' }}">
						<a href="{{ url('/hak-akses/permission') }}" class="menu-link">
							<div data-i18n="Permission">Permission</div>
						</a>
					</li>
				</ul>
			</li>
		@endif

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Authentication</span>
		</li>

		</li>
		<li class="menu-item">
			<a href="{{ url('logout') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-copy"></i>
				<div>Logout</div>
			</a>
		</li>
	</ul>
</aside>
