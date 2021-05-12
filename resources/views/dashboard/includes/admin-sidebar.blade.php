<!-- Main Sidebar Container -->
<?php
$userDetails = getUserDetails();
//prd($userDetails);
$imgFolder = 'users';
$segment2 = Request::segment(2);
$segment3 = Request::segment(3);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #001f3f;">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <h4 class="admn-title">EmptyTruck100</h4>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(!empty($userDetails->avatar))
                <img src="{{ asset('storage/uploads/sites/users/')}}/{{@$userDetails['id'] . '/' . @$userDetails['avatar'] }}" class="img-circle elevation-2" >
                @else
                <img src="{{ asset('public/sites/users/images/default_profile_user_img.png')}}" class="img-circle elevation-2" >
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= @$userDetails['name']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview {{$segment2=='betting'?'menu-open':""}} {{$segment2=='addBetting'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='betting'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                             Account settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('profile')}}" class="nav-link {{$segment2=='settings'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('change_password')}}" class="nav-link {{$segment2=='change_password'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{$segment2=='betting'?'menu-open':""}} {{$segment2=='addBetting'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='betting'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                             Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('dealervehicles')}}" class="nav-link {{$segment2=='dealers'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>vehicles List</p>
                            </a>
                        </li>
<!--                        <li class="nav-item">
                            <a href="{{url('trucks')}}" class="nav-link {{$segment2=='trucks'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Truck List</p>
                            </a>
                        </li>-->
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{url('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
