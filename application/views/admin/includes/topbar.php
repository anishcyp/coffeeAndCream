<!-- Top Bar Start -->
<div class="topbar">
   <!-- LOGO -->
   <div class="topbar-left">
      <!-- <a href="index.html" class="logo"><span>G<span>B</span></span><i class="mdi mdi-cube"></i></a> --> 
      <!-- Image logo -->
      <a href="javascript:void(0)" class="logo">
      <span>
      <img src="<?php echo base_url('public/front/images/logo/'.$site_logo );?>" alt="" height="30">
      </span>
      <i>
      <img src="<?php echo base_url('public/front/images/logo/'.$site_favicon );?>" alt="" height="28">            </i>
      </a>
   </div>
   <!-- Button mobile view to collapse sidebar menu -->
   <div class="navbar navbar-default" role="navigation">
      <div class="container">
         <!-- Navbar-left -->
         <ul class="nav navbar-nav navbar-left">
            <li>
               <button class="button-menu-mobile open-left waves-effect waves-light">
               <i class="mdi mdi-menu"></i>
               </button>
            </li>
         </ul>
         <!-- Right(Notification) -->
         <ul class="nav navbar-nav navbar-right">
           <!--  <li>
               <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
               <i class="mdi mdi-bell"></i>
               <span class="badge up bg-primary">4</span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                  <li>
                     <h5>Notifications</h5>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="icon bg-info">
                           <i class="mdi mdi-account"></i>
                        </div>
                        <div class="user-desc">
                           <span class="name">New Signup</span>
                           <span class="time">5 hours ago</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="icon bg-danger">
                           <i class="mdi mdi-comment"></i>
                        </div>
                        <div class="user-desc">
                           <span class="name">New Message received</span>
                           <span class="time">1 day ago</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="icon bg-warning">
                           <i class="mdi mdi-settings"></i>
                        </div>
                        <div class="user-desc">
                           <span class="name">Settings</span>
                           <span class="time">1 day ago</span>
                        </div>
                     </a>
                  </li>
                  <li class="all-msgs text-center">
                     <p class="m-0"><a href="#">See all Notification</a></p>
                  </li>
               </ul>
            </li>
            <li>
               <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
               <i class="mdi mdi-email"></i>
               <span class="badge up bg-danger">8</span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                  <li>
                     <h5>Messages</h5>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="avatar">
                           <img src="<?php echo BACKEND; ?>assets/images/users/avatar-2.jpg" alt="">
                        </div>
                        <div class="user-desc">
                           <span class="name">Patricia Beach</span>
                           <span class="desc">There are new settings available</span>
                           <span class="time">2 hours ago</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="avatar">
                           <img src="<?php echo BACKEND; ?>assets/images/users/avatar-3.jpg" alt="">
                        </div>
                        <div class="user-desc">
                           <span class="name">Connie Lucas</span>
                           <span class="desc">There are new settings available</span>
                           <span class="time">2 hours ago</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="user-list-item">
                        <div class="avatar">
                           <img src="<?php echo BACKEND; ?>assets/images/users/avatar-4.jpg" alt="">
                        </div>
                        <div class="user-desc">
                           <span class="name">Margaret Becker</span>
                           <span class="desc">There are new settings available</span>
                           <span class="time">2 hours ago</span>
                        </div>
                     </a>
                  </li>
                  <li class="all-msgs text-center">
                     <p class="m-0"><a href="#">See all Messages</a></p>
                  </li>
               </ul>
            </li> -->
            <!-- <li>
               <a href="javascript:void(0);" class="right-bar-toggle right-menu-item">
                   <i class="mdi mdi-settings"></i>
               </a>
               </li> -->
            <li class="dropdown user-box">
               <a href="#" class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown" aria-expanded="true">
               <img src="<?php echo base_url().UPLOAD_DIR?>admin.jpg" alt="user-img" class="img-circle user-img">
               </a>
               <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                  <?php
                  $login_user_fname =  $this->crud->get_column_value_by_id("tbl_users","fname","id = '".$vendorId."'");
                  $login_user_role =  $this->crud->get_column_value_by_id("tbl_users","roleId","id = '".$vendorId."'");
                  $role_name = $this->crud->get_column_value_by_id("tbl_roles","role","id = '".$login_user_role."'");
                  ?>
                  <li>
                     <h5>Hi, <?php echo isset($login_user_fname) ? ucwords($login_user_fname) : "There!"; ?> (<?php echo isset($role_name) ? ucwords($role_name) : ""; ?>)</h5>
                  </li>
                  <!-- <li><a href="javascript:void(0)"><i class="mdi mdi-account m-r-5"></i> Profile</a></li> -->
                  <li><a href="<?php echo ADMIN_LINK; ?>sitesetting"><i class="mdi mdi-settings m-r-5"></i> Settings</a></li>
                  <li><a href="<?php echo base_url(); ?>admin/logout"><i class="mdi mdi-logout m-r-5"></i> Logout</a></li>
               </ul>
            </li>
         </ul>
         <!-- end navbar-right -->
      </div>
      <!-- end container -->
   </div>
   <!-- end navbar -->
</div>
<!-- Top Bar End