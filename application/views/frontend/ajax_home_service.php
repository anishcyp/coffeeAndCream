<section class="section section-xl bg-default text-md-left block-profile-main block-img-full" style="padding: 0;">
    <div class="container">
        <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <ul class="searchresult">
                    <?php 
                    if(!empty($posts))
                    {
                        foreach($posts as $key => $post)
                        {
                            $id             = $post['id'];
                            $phone          = $post['phone'];
                            $image_path     = $post['profile_image'];
                            $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

                            $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

                            $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

                            $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                            if(file_exists($prd_exist) && $image_path!="") 
                            {
                                $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                            } 
                            else 
                            {
                                $prd_preview = base_url().UPLOAD_DIR.'default.png';
                            }

                            $str = strtolower($post['slug']);
                            $details_url1  = base_url()."user/details/".$str."/";
                            if($key == 0)
                            {
                                ?>
                                <li>
                                    <div class="inner_link">
                                        <a href="javascript:void(0)">
                                            <div class="blog-img-main" style="background-image: url(<?=FRONT_ASSETS?>images/orangebg.jpg">
                                                <!-- <p>JOIN TODAY</p> -->
                                                <p>ARE YOU LOOKING FOR SOMEONE RIGHT NOW? CLICK ON ANY PROFILE IMAGE OR LOCATION.</p>
                                                <p>GET INTOUCH WITH THEM DIRECTLY. CALL ICON 📞 ON THEIR PROFILE.</p>
                                                <label class="pulse call-icon-main"><i class="fas fa-phone-alt"></i></label>
                                                
                                            </div>
                                        </a>  
                                    </div>
                                </li>
                                <?php
                            }
                            else if($key == 3)
                            {
                                ?>
                                <li>
                                <a href="<?= base_url('terms') ?>">
                                <div class="blog-img-main" style="background-image: url(<?=FRONT_ASSETS?>images/terams.jpg">
                                    <!-- <a href="<?= base_url('terms') ?>"> -->
                                    <p>Want a second opinion before making a booking, read reviews all entertainment deposit secure with us</p>
                                    <label>Terms & condition</label>
                                    <!-- </a> -->
                                </div>
                                </a>
                                </li>
                                <?php
                            }
                            else if($key == 8)
                            {
                                ?>
                                <li>
                                <a href="<?= base_url('choose-user') ?>">
                                <div class="blog-img-main" style="background-image: url(<?=FRONT_ASSETS?>images/registerbg.jpg">
                                    <!-- <a href="<?= base_url('choose-user') ?>"> -->
                                    <p>JOIN TODAY</p>
                                    <p>Register as a member enjoy 7days free listing</p>
                                    <label>Register</label>
                                    <!-- </a> -->
                                </div>
                                </a>  
                                </li>
                                <?php
                            }
                            else if($key == 11)
                            {
                                $SocialInfo = FrontSiteInfo(); 
                                ?>
                                    <li>
                                    <div class="blog-img-main blog-with-social" style="background-image: url(<?=FRONT_ASSETS?>images/social-media-icons-background_23-2147511281.jpg">
                                        <p>Follow us on social media</p>
                                        <ul class="list-inline list-social-3 list-inline-sm">
                                        <li>
                                        <a href="<?php echo $SocialInfo['fb_link']; ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        </li>
                                    
                                        <li>
                                        <a href="<?php echo $SocialInfo['google_plus_link']; ?>">
                                            <i class="fal fa-envelope"></i>
                                        </a>
                                        </li>
                                        
                                        <li>
                                        <a href="<?php echo $SocialInfo['twitter_link']; ?>">
                                                <i class="fab fa-twitter"></i>  
                                        </a>
                                        </li>
                                    
                                        <li>
                                        <a href="<?php echo $SocialInfo['youtube_link']; ?>">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                        </li>
                                        
                                        <li>
                                        <a href="<?php echo $SocialInfo['instagram_link']; ?>">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        </li>
                                        </ul>
                                        <label>Social Media</label>
                                    </div>
                                    </li>
                                <?php
                            }
                            ?> 
                            <li class="overlay-link-gallery">
                                <div class="inner_link">
                                    <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing">
                                        <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                                        <div class="gallery-content">
                                            <h4><?=$post['fname']?></h4>
                                            <!--<p><?= $city_name ?></p>-->
                                        </div>
                                    </a>
                                </div>
                            </li>
                        <?php 
                        }                                                                        
                    } 
                    else
                    {
                        if(!empty($users))
                        {
                            ?>
                            <div class="block-no-record">
                                <div class="col-md-12 text-center">
                                    <h4><strong class="text-center" style="text-transform: capitalize;">
                                    Your searching keywords <?= $service_name ?> and <?= $location_name ?> have no results found. <br> 
                                    provide other <?= $service_name ?> from seraching keywords !
                                </strong></h4>
                                </div>
                            </div>
                            <?php
                            foreach($users as $post)
                            {
                                $id             = $post['id'];
                                $phone          = $post['phone'];
                                $image_path     = $post['profile_image'];
                                $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

                                $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

                                $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                                if(file_exists($prd_exist) && $image_path!="") 
                                {
                                    $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                                } 
                                else 
                                {
                                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                                }

                                $str = strtolower($post['slug']);
                                $details_url1  = base_url()."user/details/".$str."/"
                                ?> 
                                <li class="overlay-link-gallery">
                                    <div class="inner_link">
                                        <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing">
                                            <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                                            <div class="gallery-content">
                                                <h4><?=$post['fname']?></h4>
                                                <!--<p><?= $city_name ?></p>-->
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            <?php 
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>