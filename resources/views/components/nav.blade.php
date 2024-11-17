<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
        {{-- @dd($item); --}}
        <li class="nav-item">
            <a href="{{ route($item['route']) }}" class="nav-link {{ Route::Is($item['active']) ? 'active' : '' }}">
                <i class="{{ $item['icon'] }}"></i>
                <p>
                    {{ $item['title'] }}
                    @isset($item['badge'])
                        <span class="right badge badge-danger">New</span>
                    @endisset
                </p>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
<!-- /.sidebar-menu -->

