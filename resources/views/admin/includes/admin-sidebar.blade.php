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
    <a href="{{url('/admin/dashboard')}}" class="brand-link">
<!--        <img src="{{url('sites/users/images/small-logo.png')}}" alt="Tutify" class="brand-image img-circle elevation-3"
   style="opacity: .8">-->
        <h4 class="admn-title">EMPTYTRUCK100 Admin</h4>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(!empty($userDetails->avatar))
                <img src="{{ asset('public/sites/images/')}}/{{$imgFolder}}/{{@$userDetails['id'] . '/' . @$userDetails['avatar'] }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('public/sites/users/images/default_profile_user_img.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{asset('editprofile')}}/<?= @$userDetails['id']; ?>" class="d-block"><?= @$userDetails['name']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link {{$segment2=='dashboard'?'active':""}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{$segment2=='user'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='user'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/user')}}" class="nav-link {{$segment3==''?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/user/create')}}" class="nav-link {{$segment3=='create'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{$segment2=='betting'?'menu-open':""}} {{$segment2=='addBetting'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='betting'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/companies')}}" class="nav-link {{$segment2=='companies'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Truck Company Master</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/vehicles')}}" class="nav-link {{$segment2=='vehicles'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Truck(Vehicles) Master List</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{url('admin/testimonials')}}" class="nav-link {{$segment2=='testimonials'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Testimonial List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/blogs')}}" class="nav-link {{$segment2=='blogs'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/advertisements')}}" class="nav-link {{$segment2=='advertisements'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advertisement List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                  <li class="nav-item has-treeview {{$segment2=='business'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='business'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                           Business
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       <li class="nav-item">
                            <a href="{{url('admin/dealers')}}" class="nav-link {{$segment2=='dealers'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company/Driver List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/trucks')}}" class="nav-link {{$segment2=='trucks'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advertise Truck List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview {{$segment2=='enquiries'?'menu-open':""}}">
                    <a href="#" class="nav-link {{$segment2=='enquiries'?'active':""}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Enquiry History
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/enquiries')}}" class="nav-link {{$segment2=='enquiries'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enquiry List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/quotes')}}" class="nav-link {{$segment2=='quotes'?'active':""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quotes List</p>
                            </a>
                        </li>
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
