 <!-- BEGIN: Main Menu-->
 <div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <di class="d-flex align-items-center justify-content-between side-menu-head-title-wrap">
            <h5 class="side-menu-head-title p-0">Admin Panel</h5>
            <a onclick="toggleMenu()" class="nav-link nav-menu-main menu-toggle p-0 m-0 text-white " href="javascript:;"><i class="ft-menu"></i></a>
        </di>
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
@push('scripts');
<script type="text/javascript">
    if(window.innerWidth > 768){
        $('body').addClass('menu-open');
    }
    else{
        $('body').addClass('menu-hide');
    }
    function toggleMenu() {
        if ($('body').hasClass('menu-open')) {
            $('body').removeClass('menu-open').addClass('menu-hide');
        } else {
            $('body').addClass('menu-open').removeClass('menu-hide');
        }
    }
</script>
@endpush