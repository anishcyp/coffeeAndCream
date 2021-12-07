<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Navigation</li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>dashboard" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>
                
                <li class="menu-title">More</li>

                <?php 
                $admin_id = $this->session->userdata('userId');
                $admin_q  = $this->crud->get_one_row("tbl_users",array("isDeleted" =>0,"id"=>$admin_id));
                // print_r($admin_q['sub_admin']); exit();
                if($admin_q['roleId'] == '1')
                {
                ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-sub-admin" class="waves-effect  "><i class="mdi mdi-account-plus"></i><span> Manage Sub Admin </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-user" class="waves-effect  "><i class="mdi mdi-account-settings-variant"></i><span> Manage Users </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-agency" class="waves-effect"><i class="mdi mdi-account-star"></i><span> Manage Agency </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-hen-stag-accommodation" class="waves-effect"><i class="mdi mdi-account-star"></i><span> Manage Hen Stag Accommodation User</span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-hen-stag" class="waves-effect  "><i class="mdi mdi-format-indent-decrease"></i><span> Manage Hen stag </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-videos" class="waves-effect  "><i class="mdi mdi-file-video"></i><span> Manage Videos </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>send-mail-list" class="waves-effect"><i class="mdi mdi-email"></i><span> Send Mail </span></a>
                </li>
                

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect "><i class="mdi mdi-newspaper "></i><span> Blog</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-blog-category"> Category</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-blog"> Listing</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>about-us" class="waves-effect  "><i class="mdi mdi-package"></i><span> About us </span></a>
                </li>
                
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-advert-plan" class="waves-effect  "><i class="mdi mdi-file-document-box"></i><span>Manage Advert Plan </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-membership-plan" class="waves-effect  "><i class="mdi mdi-wallet-membership"></i><span>Manage Membership Plan </span></a>
                </li>
                
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-service" class="waves-effect  "><i class="mdi mdi-octagon"></i><span> Service </span></a>
                </li>
                
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-favourite" class="waves-effect  "><i class="mdi mdi-star"></i><span> Favourite </span></a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-language" class="waves-effect  "><i class="mdi mdi-wan"></i><span> Language </span></a>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker"></i><span> Location </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-country">Manage Country</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-state">Manage State</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-city"> Manage City</a></li>
                        <!-- <li><a href="<?php echo ADMIN_LINK; ?>manage-city-area">Manage City Area</a></li> -->
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i><span> Contact </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>contact"> Contact</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>our-contact">Mange Our Contact</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>description-contact">Description Contact</a></li>
                        
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-home"></i><span> Home </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>home-page-banner">Home Page Banner</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-testimonial">Manage Testimonium</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-service-image">Manage Service Image</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>home-page-service-content">Home Page Service Content</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>subscriber" class="waves-effect text-bold "><i class="mdi mdi-contact-mail "></i><span> Subscriber </span> <!-- <span class="menu-arrow"></span> --></a>
                </li>
                
                
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i><span> Setting </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-faq"> Manage FAQ</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-terms">Manage Terms</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>cms/privacy"> Manage Privacy</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>loadChangePass">Change Password</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>sitesetting">General Setting</a></li>
                    </ul>
                </li>
                <?php
                }
                else
                {
                ?>
                <?php if($admin_q['sub_admin'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-sub-admin" class="waves-effect  "><i class="mdi mdi-account-plus"></i><span> Manage Sub Admin </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['user_list'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-user" class="waves-effect  "><i class="mdi mdi-account-settings-variant"></i><span> Manage Users </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['manage_agency'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-agency" class="waves-effect"><i class="mdi mdi-account-star"></i><span> Manage Agency </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['manage_hen_stag'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-hen-stag" class="waves-effect  "><i class="mdi mdi-format-indent-decrease"></i><span> Manage Hen stag </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['blog'] == '1'){ ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect "><i class="mdi mdi-newspaper "></i><span> Blog</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-blog-category"> Category</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-blog"> Listing</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php if($admin_q['send_mail'] == '1' ){ ?>
                    <li class="has_sub">
                        <a href="<?php echo ADMIN_LINK; ?>send-mail-list" class="waves-effect"><i class="mdi mdi-email"></i><span> Send Mail </span></a>
                    </li>
                <?php } ?>


                <?php if($admin_q['about'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>about-us" class="waves-effect  "><i class="mdi mdi-package"></i><span> About us </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['video'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-videos" class="waves-effect  "><i class="mdi mdi-file-video"></i><span> Manage Videos </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['advert_plan'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-advert-plan" class="waves-effect  "><i class="mdi mdi-file-document-box"></i><span>Manage Advert Plan </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['membership_Plan'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-membership-plan" class="waves-effect  "><i class="mdi mdi-wallet-membership"></i><span>Manage Membership Plan </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['service'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-service" class="waves-effect  "><i class="mdi mdi-octagon"></i><span> Service </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['favorite'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-favourite" class="waves-effect  "><i class="mdi mdi-star"></i><span> Favourite </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['language'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>manage-language" class="waves-effect  "><i class="mdi mdi-wan"></i><span> Language </span></a>
                </li>
                <?php } ?>

                <?php if($admin_q['location'] == '1'){ ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map-marker"></i><span> Location </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-country">Manage Country</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-state">Manage State</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-city"> Manage City</a></li>
                        <!-- <li><a href="<?php echo ADMIN_LINK; ?>manage-city-area">Manage City Area</a></li> -->
                    </ul>
                </li>
                <?php } ?>


                <?php if($admin_q['contact'] == '1'){ ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i><span> Contact </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>contact"> Contact</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>our-contact">Mange Our Contact</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>description-contact">Description Contact</a></li>
                        
                    </ul>
                </li>
                <?php } ?>


                <?php if($admin_q['home'] == '1'){ ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-home"></i><span> Home </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>home-page-banner">Home Page Banner</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-testimonial">Manage Testimonium</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-service-image">Manage Service Image</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>home-page-service-content">Home Page Service Content</a></li>
                    </ul>
                </li>
                <?php } ?>


                <?php if($admin_q['subscriber'] == '1'){ ?>
                <li class="has_sub">
                    <a href="<?php echo ADMIN_LINK; ?>subscriber" class="waves-effect text-bold "><i class="mdi mdi-contact-mail "></i><span> Subscriber </span> <!-- <span class="menu-arrow"></span> --></a>
                </li>
                <?php } ?>
                
                <?php if($admin_q['setting'] == '1'){ ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i><span> Setting </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-faq"> Manage FAQ</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>manage-terms">Manage Terms</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>cms/privacy"> Manage Privacy</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>loadChangePass">Change Password</a></li>
                        <li><a href="<?php echo ADMIN_LINK; ?>sitesetting">General Setting</a></li>
                    </ul>
                </li>
                <?php } ?>

                <?php 
                }
                ?>

                <li class="has_sub">
                    <a href="<?php echo base_url(); ?>admin/logout" class="waves-effect  "><i class="mdi mdi-logout m-r-5"></i> <span>Logout</span></a>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>