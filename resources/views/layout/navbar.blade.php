 <!-- Sidebar - Brand -->
 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('/')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item 
    @if($page === "dashboard")
        active
    @endif
">
    <a class="nav-link" href="{{route('/')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item
    @if($page === "category")
        active
    @endif
">
    <a class="nav-link" href="{{route('category/index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Categories</span>
    </a>
</li>
<li class="nav-item
    @if($page === "product")
        active
    @endif
">
    <a class="nav-link" href="{{route('product/index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Products</span>
    </a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>