<?php
	$segment1 = $this->uri->segment(1);
	$segment2 = $this->uri->segment(2);
	$segment3 = $this->uri->segment(3); 
?>

<div class="col-lg-3 col-md-12 col-12">
    <div class="sidebar-box">
        <ul class="nav tab-nav ">
        <?php
        $user_id = $this->session->userdata('front_UserId');
        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);

            if($user_role == 1 || $user_role == 2)
            {
            ?>
            <li class="nav-item">
            	<a class="<?=isset($segment1) && $segment1 == 'profile-info' ? 'active' : '' ?>" href="<?=base_url('profile-info');?>"> My Account </a>
            </li>
            <li class="nav-item">
            	<a class="<?=isset($segment1) && $segment1 == 'change-password' ? 'active' : '' ?>" href="<?=base_url('change-password');?>"> Change Password</a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'add-stories' ? 'active' : '' ?>" href="<?=base_url('add-stories');?>"> Add Stories </a>
            </li>
            
            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'membership-plan' ? 'active' : '' ?>" href="<?=base_url('membership-plan');?>"> Membership Plan </a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'review' ? 'active' : '' ?>" href="<?=base_url('review');?>"> Review </a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'payment-history' ? 'active' : '' ?>" href="<?=base_url('payment-history');?>"> Payment History</a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'my-diary' ? 'active' : '' ?>" href="<?=base_url('my-diary');?>"> My Diary </a>
            </li> 
                
            <li class="nav-item">
            	<a class="<?=isset($segment1) && $segment1 == 'call-rates' ? 'active' : '' ?>" href="<?=base_url('call-rates');?>"> Call Rates </a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'location' ? 'active' : '' ?>" href="<?=base_url('location');?>"> Location </a>
            </li> 

            <li class="nav-item">
            <a class="<?=isset($segment1) && $segment1 == 'payment-info' ? 'active' : '' ?>" href="<?=base_url('payment-info');?>"> Payment Info </a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'my-gallery' ? 'active' : '' ?>" href="<?=base_url('my-gallery');?>"> Gallery </a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'membership-details' ? 'active' : '' ?>" href="<?=base_url('membership-details');?>"> Membership plan Details</a>
            </li> 
            <?php 
            }
            else if($user_role == 5)
            {
            ?>
                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'profile-info' ? 'active' : '' ?>" href="<?=base_url('profile-info');?>"> My Account </a>
                </li>

                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'packages' ? 'active' : '' ?>" href="<?=base_url('packages');?>">Create Packages</a>
                </li>

                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'change-password' ? 'active' : '' ?>" href="<?=base_url('change-password');?>"> Change Password</a>
                </li>

                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'membership-plan' ? 'active' : '' ?>" href="<?=base_url('membership-plan');?>"> Membership Plan </a>
                </li>

                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'membership-details' ? 'active' : '' ?>" href="<?=base_url('membership-details');?>"> Membership plan Details</a>
                </li> 

                <li class="nav-item">
                    <a class="<?=isset($segment1) && $segment1 == 'my-gallery' ? 'active' : '' ?>" href="<?=base_url('my-gallery');?>"> Gallery </a>
                </li>

            <?php 
            }

            else
            {
            ?>
            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'profile-info' ? 'active' : '' ?>" href="<?=base_url('profile-info');?>"> My Account </a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'contact-methods' ? 'active' : '' ?>" href="<?=base_url('contact-methods');?>"> Contact Methods </a>
            </li>


            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'post' ? 'active' : '' ?>" href="<?=base_url('post');?>"> Create Post </a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'job-application' ? 'active' : '' ?>" href="<?=base_url('job-application');?>">Applying jobs</a>
            </li>

           

            <!-- <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'adver-blog' ? 'active' : '' ?>" href="<?=base_url('adver-blog');?>">Advertise Blog</a>
            </li> -->
            
            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'membership-plan' ? 'active' : '' ?>" href="<?=base_url('membership-plan');?>"> Membership Plan </a>
            </li>

            <li class="nav-item">
            	<a class="<?=isset($segment1) && $segment1 == 'call-rates' ? 'active' : '' ?>" href="<?=base_url('call-rates');?>"> Call Rates </a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'location' ? 'active' : '' ?>" href="<?=base_url('location');?>"> Location </a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'my-gallery' ? 'active' : '' ?>" href="<?=base_url('my-gallery');?>"> Gallery </a>
            </li>

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'membership-details' ? 'active' : '' ?>" href="<?=base_url('membership-details');?>"> Membership plan Details</a>
            </li> 

            <li class="nav-item">
                <a class="<?=isset($segment1) && $segment1 == 'change-password' ? 'active' : '' ?>" href="<?=base_url('change-password');?>"> Change Password</a>
            </li>

            <?php
            }
            ?>
        </ul>
    </div>
</div>


            