 <!-- BEGIN: Main Menu-->
 <div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <h5 class="side-menu-head-title">Admin Panel</h5>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (isset($menu) && ($menu == 'home')) ?'active':''}} ">
                <a href="{{ route('home') }}"><span class="menu-title" data-i18n="Dashboard"><i class="ft-home"></i>Dashboard</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'design-group')) ?'active':''}} ">
                <a href="{{ route('design-group') }}"><span class="menu-title" data-i18n="Design"><i class="ft-clipboard"></i>Design Groups</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->