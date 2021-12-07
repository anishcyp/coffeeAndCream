<?php 
$FrontSiteInfo = FrontSiteInfo(); 

$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);

$enter_serv_lists = $this->crud->get_all_with_where('service','name','desc',array('status'=>'Y','isDelete'=>0,'is_dis_on_menu'=>1,'service_type'=>1));

$escort_serv_lists = $this->crud->get_all_with_where('service','name','desc',array('status'=>'Y','isDelete'=>0,'is_dis_on_menu'=>1,'service_type'=>2));
?>
<header class="section page-header header-creative-wrap context-dark">
    <!-- RD Navbar-->
    <?php 

    $UserId = $this->session->userdata('front_UserId');
    if($UserId)
    {
       
        $con = 'nav-user-login';
    }
    else
    {
        $con = ' ';
    }

    ?>
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-creative rd-navbar-creative-2 <?= $con ?>" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="100px" data-xl-stick-up-offset="112px" data-xxl-stick-up-offset="132px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-aside-outer">
                <div class="rd-navbar-aside">
                    <div class="rd-navbar-collapse">
                        <ul class="contacts-classic">
                        <li><span class="contacts-classic-title">Call us:</span> <a href="tel:<?=$FrontSiteInfo['site_phone']?>"> <?=$FrontSiteInfo['site_phone']?></a>
                        </li>
                        </ul>
                    </div>
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a class="brand" href="<?php echo base_url();?>">
                                <img class="brand-logo-dark" src="<?php echo base_url('public/front/images/logo/'.$FrontSiteInfo['site_sticky_logo'] );?>" alt="<?php echo $FrontSiteInfo['pageTitle'];?>" width="117" height="41"/>
                                <img class="brand-logo-light" src="<?php echo base_url('public/front/images/logo/'.$FrontSiteInfo['site_logo'] );?>" alt="<?php echo $FrontSiteInfo['pageTitle'];?>" width="117" height="41"/>
                            </a>
                        </div>
                    </div>
                    <div class="rd-navbar-aside-element">
                        <!-- RD Navbar Search-->
                        <div class="rd-navbar-search rd-navbar-search-2 align-items-center d-flex">
                            <a href="javascript:void(0);" class="btn btn-primary mr-2">ADVERTISE WITH US</a>
                            <button class="rd-navbar-search-toggle rd-navbar-fixed-element-3 seach_filter_block" data-rd-navbar-toggle=".rd-navbar-search">
                            <i class="far fa-search"></i>
                            </button>
                            <!-- <form class="rd-search" action="search-results.html" data-search-live="rd-search-results-live" method="GET">
                                <div class="form-wrap">
                                    <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off"/>
                                    <button onclick="searchFilter();"></button>
                                    <label class="form-label" for="rd-navbar-search-form-input">Search...</label>
                                    <div class="rd-search-results-live" id="rd-search-results-live"></div>
                                    <button class="rd-search-form-submit"><i class="far fa-search"></i></button>
                                </div>
                            </form> -->
                        </div>
                        <?php
                              if ($this->session->userdata('customer_is_logged_in') == ''){
                        ?>
                        <div class="btn-login-main">
                            <a href="<?php echo base_url("SignIn")?>" class="btn btn-primary mr-2"><i class="fas fa-sign-in-alt"></i> Log In</a>
                            <a href="<?php echo base_url("choose-user")?>" class="btn btn-primary mr-2"><i class="far fa-user-plus"></i> Register</a>
                        </div> 
                        <?php
                        } ?>
                        
                        <?php
                              if ($this->session->userdata('customer_is_logged_in')){

                                $profile_image = $this->crud->get_one_value("tbl_customer",array("id"=>$this->session->userdata['customer_is_logged_in']['id']),"profile_image");
                                if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile_image) && $profile_image!="")
                                { 
                                    $user_profile_img = base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile_image);
                                }
                                else
                                {
                                    $user_profile_img = base_url(UPLOAD_DIR."user_default.jpg");
                                }

                            ?>
                            <ul class="desktop-view-user">
                            <li class="rd-nav-item user-dropdown <?=isset($segment1) && $segment1 == "profile-info" ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="javascript:void(0);"><img src="<?= $user_profile_img ?>" alt=""> <?php echo isset($this->session->userdata['customer_is_logged_in']['fname']) ? $this->session->userdata['customer_is_logged_in']['fname'] : '';?></a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                    <li class="rd-dropdown-item">
                                        <a href="<?php echo base_url("profile-info");?>" class="rd-dropdown-link"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
                                    </li>
                                    <li class="rd-dropdown-item">
                                        <a href="<?php echo base_url("logout"); ?>" class="rd-dropdown-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            </ul>
                            <?php
                            }
                            else
                            {
                            ?>
                            <!-- <li class="rd-nav-item"><a class="rd-nav-link" href="<?php echo base_url("SignIn")?>"><i class="fa fa-sign-in"></i> Login</a></li> -->
                            <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
            <?php
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
            ?>
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <div class="rd-navbar-nav-wrap">
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item <?php if ($segment1=="") {echo "active"; } else  {echo "noactive";}?>"><a class="rd-nav-link" href="<?=base_url('/');?>">Home</a>
                            </li>

                            <li class="rd-nav-item class_manu <?=isset($segment1) && $segment1 == 'service' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="javascript:void(0);">Entertainment Service</a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                    <?php 
                                    foreach ($enter_serv_lists as $enter_serv_list) 
                                    {
                                        $serv_name      = ucwords($enter_serv_list->name);
                                        $serv_slug      = $enter_serv_list->slug;
                                        $image_path     = $enter_serv_list->service_icon;

                                        $prd_exist = UPLOAD_DIR.SERVICE_ICON.$image_path;

                                        if(file_exists($prd_exist) && $image_path!="") 
                                        {
                                            $prd_preview = base_url().UPLOAD_DIR.SERVICE_ICON.$image_path;
                                        } 
                                        else 
                                        {
                                            $prd_preview = base_url().UPLOAD_DIR.'default.png';
                                        }
                                    ?>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="<?=base_url();?>service/<?=$serv_slug;?>"><img src="<?=$prd_preview;?>" alt="<?=$serv_name;?>"><?=$serv_name;?></a>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="rd-nav-item">
                                <a class="rd-nav-link" target="_blank" href="https://www.stripperpartybus.ie/service/escort-services">Escort Service</a>
                            </li>
                           
                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'gallery' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="javascript:void(0);">Gallery</a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="<?php echo base_url("gallery/male");?>"><img src="<?=FRONT_ASSETS?>images/male-stripper-icon-2.png" alt="Male Gallery">Male Gallery</a>
                                    </li>
                                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="<?php echo base_url("gallery/female");?>"><img src="<?=FRONT_ASSETS?>images/icon-5.png" alt="Female Gallery">Female Gallery</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'videos' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("videos")?>">Videos</a>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'agencies' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("agencies")?>">AGENCIES</a>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'post-and-ads' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("post-and-ads")?>">POST AND ADS/Jobs</a>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'blog' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("blog")?>">Blogs</a>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'maps' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("maps")?>">Map/pornstar profiles</a>
                            </li>
                            
                            <!-- <li class="rd-nav-item">
                                <a class="rd-nav-link" href="javascript:void(0);">Entertainment packages </a>
                            </li> -->
                            
                            <!-- <li class="rd-nav-item">
                                <a class="rd-nav-link" href="javascript:void(0);">Hen/stag accommodation </a>
                            </li> -->

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'hen-stag-accommodation' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("hen-stag-accommodation")?>">Hen/stag accommodation  </a>
                            </li>

                            <li class="rd-nav-item <?=isset($segment1) && $segment1 == 'about-us' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("about-us")?>">About us</a>
                            </li>
                            
                            <li class="rd-nav-item user-drodwon <?=isset($segment1) && $segment1 == 'contactus' ? 'active' : '' ?>">
                                <a class="rd-nav-link" href="<?php echo base_url("contactus")?>">Contact us</a>
                            </li>

                            <?php
                            if ($this->session->userdata('customer_is_logged_in')){

                                $profile_image = $this->crud->get_one_value("tbl_customer",array("id"=>$this->session->userdata['customer_is_logged_in']['id']),"profile_image");
                                if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile_image) && $profile_image!="")
                                { 
                                $user_profile_img = base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile_image);
                                }
                                else
                                {
                                $user_profile_img = base_url(UPLOAD_DIR."user_default.jpg");
                                }
                                 
                            ?>
                            <li class="rd-nav-item user-dropdown">
                                <a class="rd-nav-link" href="javascript:void(0);"><img src="<?= $user_profile_img ?>" alt=""> <?php echo isset($this->session->userdata['customer_is_logged_in']['fname']) ? $this->session->userdata['customer_is_logged_in']['fname'] : '';?></a>
                                <ul class="rd-menu rd-navbar-dropdown">
                                  <li class="rd-dropdown-item">
                                    <a href="<?php echo base_url("profile-info");?>" class="rd-dropdown-link"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
                                  </li>
                                  <li class="rd-dropdown-item">
                                      <a href="<?php echo base_url("logout"); ?>" class="rd-dropdown-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
                                  </li>
                                </ul>
                            </li>
                            <?php
                            }
                            else
                            {
                            ?>
                            <!-- <li class="rd-nav-item"><a class="rd-nav-link" href="<?php echo base_url("SignIn")?>"><i class="fa fa-sign-in"></i> Login</a></li> -->
                            <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>