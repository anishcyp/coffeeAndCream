<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt=""></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h2>
                    <h5 class="breadcrumbs-custom-text">I am a very professional, experienced, and reliable entertainer committed to exceeding my client’s  expectations. I offer quality, friendly and professional entertainment and you can be sure to enjoy my  services. For more inquiries and clarification, click on my profile and get in touch. I'm available via email  and phone. So, don’t be shy, talk to me, and together, let us create the best moments of your life.
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?=base_url();?>">Home</a></li>
                    <li class="active"><?=$pageTitle;?></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="slider-profile">
        <div class="slider-profile-main">
            <?php
            if($gallerylists){
            foreach ($gallerylists as $gallerylist) 
            {
                $image_path     = $gallerylist->gallery_file;

                $prd_exist = UPLOAD_DIR.GALLERY_IMG.$image_path;

                if(file_exists($prd_exist) && $image_path!="") 
                {
                    $prd_preview = base_url().UPLOAD_DIR.GALLERY_IMG.$image_path;
                } 
                else 
                {
                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                }

                if(file_exists(UPLOAD_DIR.GALLERY_IMG.$image_path) && $image_path!='')  
                {
                    $ext = pathinfo($image_path, PATHINFO_EXTENSION);
                    $video= array("webm","mkv","flv","gif","m4p","mp4");

                    if (in_array($ext, $video))
                    {
                    ?>
                    <div class="profile-item">
                        <video width="100" height="100" controls>
                            <source src="<?=$prd_preview;?>">
                        </video>
                    </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="profile-item">
                        <img src="<?=$prd_preview?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>">
                    </div>
                    <?php
                    }
                }
            }

            }
            ?>
        </div>
    </section>
    <section class="section section-xl bg-default text-md-left block-diff-profile">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!-- Quote Classic Big-->
                    <article class="quote-classic-big inset-xl-right-30">
                        <div class="heading-3 text-transform-capitalize quote-classic-big-text">
                            <div class="q"><?=ucwords($user_d['fname']." ".$user_d['lname']);?> - This gorgeous Blonde stripper is ready to give you a show you wont forget
                            </div>
                        </div>
                    </article>
                    <!-- Bootstrap tabs-->
                    <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
                        <!-- Nav tabs-->
                        <div class="nav-tabs-wrap">
                            <ul class="nav nav-tabs">
                                <li class="nav-item" role="presentation"><a class="nav-link active show" href="#profile" data-toggle="tab"><i class="fas fa-user"></i> <span>Profile</span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link " href="#gallery" data-toggle="tab"><i class="fas fa-camera-retro"></i> <span>Gallery</span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#diary" data-toggle="tab"><i class="fas fa-book"></i> <span>Diary</span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#reviews" data-toggle="tab"><i class="fas fa-star"></i> <span>Reviews</span></a></li>
                            </ul>
                        </div>
                        <br>
                        <div class="alert alert-primary" role="alert">
                          <?php echo $site_settings['gallery_massage_details']; ?>
                        </div>

                        <!-- Tab panes-->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="profile">
                                <div class="box-comment">
                                    <div class="unit flex-column flex-sm-row unit-spacing-md">
                                        <?php 
                                        $image_path     = $user_d['profile_image'];

                                        $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                                        if(file_exists($prd_exist) && $image_path!="") 
                                        {
                                            $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                                        } 
                                        else 
                                        {
                                            $prd_preview = base_url().UPLOAD_DIR.'default.png';
                                        }
                                        ?>
                                        <div class="unit-left">
                                            <a class="box-comment-figure" href="<?=$prd_preview;?>"><img src="<?=$prd_preview;?>" alt="" width="119" height="119"></a>
                                            <br>
                                            <?php 
                                                $id= $this->session->userdata('front_UserId');
                                                $payment_url  = base_url()."payment/".md5($id)."/"; 
                                            ?>
                                            <a href="<?=$payment_url ;?>" class="button button-lg button-shadow-2 button-primary button-zakaria">Deposit Now</a>
                                            <p>(Deposit is secure~arrange booking directly)</p>
                                            
                                        </div>

                                        <div class="unit-body">
                                            <div class="group-sm group-justify">
                                                <div>
                                                    <div class="group-xs group-middle">
                                                        <h5 class="box-comment-author"><?=ucwords($user_d['fname']." ".$user_d['lname']);?></h5>
                                                    </div>
                                                </div>
                                                <div class="box-comment-time">
                                                    <p>Dublin, Dublin 1, IFSC</p>
                                                    <time datetime="2020-11-30">Sat 30th January → Fri 5th Feb</time>
                                                </div>
                                            </div>
                                           
                                            <div class="block-shadow-profile">
                                                <ul>
                                                    <li><a href="javascript:void(0);"><i class="fas fa-phone-alt" data-toggle="modal" data-target="#phoneModal"></i><span>Show</span></a></li>
                                                    <li><a href="mailto:<?=$user_d['email'];?>"><i class="fas fa-envelope"></i><span>Email</span></a></li>
                                                    <li><a href="javascript:void(0);"><i class="fas fa-comments"></i><span>PM me</span></a></li>
                                                    <li><a href="javascript:void(0);"><i class="far fa-heart"></i><span>Fav</span></a></li>
                                                    <!-- <li><a href="javascript:void(0);"><i class="fas fa-check"></i><span>Shortlist</span></a></li> -->
                                                    <li><a href="javascript:void(0);"><i class="fas fa-check-square"></i><span>Photos verified</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="block-shadow-profile">
                                                <h4>INTRODUCTION</h4>
                                                <p class="box-comment-text"><?=$user_d['Introduction'];?>
                                                </p>
                                            </div>
                                            <div class="block-shadow-profile d-flex">
                                                <div class="block-shadow-profile-inner">
                                                <?php
                                                    $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$user_d['country_id']."'");

                                                    $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");

                                                    $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$user_d['city_id']."'");
                                                ?>
                                                    <h4>General</h4>
                                                    <p><span>Location</span><span><?php echo $country_name." , ". $state_name." , ".$city_name; ?></span></p>
                                                    <p><span>Age</span><span><?=$user_d['age'];?></span></p>
                                                    <p><span>Facilities</span><span><?=$user_d['facilities'];?> </span></p>
                                                    <p><span>Disabled friendly</span><span> <?=$user_d['friendly'];?></span></p>
                                                    <p><span>Showers available</span><span> <?=$user_d['showers_available'];?></span></p>
                                                    <p><span>Will travel to</span><span> <?=$user_d['will_travel_to'];?></span></p>
                                                    <p><span>Call type</span>
                                                        <?php 
                                                            if($user_d['call_type'] == '1'){
                                                                ?>
                                                                <span>Entertainment Services</span>
                                                                <?php
                                                            }
                                                            else if($user_d['call_type'] == '2'){
                                                                ?>
                                                                <span>Escort Services</span>
                                                                <?php
                                                            }
                                                            else if($user_d['call_type'] == '3'){
                                                                ?>
                                                                <span>Escort Services , Entertainment Services</span>
                                                                <?php
                                                            }
                                                        ?>
                                                        <!-- <span> <?=$user_d['call_type'];?></span> -->
                                                    </p>
                                                    <p><span>Withheld numbers</span><span> <?=$user_d['withheld_numbers'];?></span></p>
                                                    <p><span>Text messages</span><span> <?=$user_d['text_massage'];?></span></p>
                                                    <p><span>Out of hour calls</span><span> <?=$user_d['out_of_hour_calls'];?></span></p>
                                                </div>
                                                <!-- <div class="block-shadow-profile-inner">
                                                    <h4> Communication</h4>
                                                    <p><span>Nationality</span><span>Slovenia</span></p>
                                                    <p><span>Responsiveness</span><span>Usually responds within a week</span></p>
                                                    <p><span>Speaks</span><span>English</span></p>
                                                </div> -->
                                                <div class="block-shadow-profile-inner">
                                                    <h4> In Call Rates</h4>
                                                    <?php
                                                    if($call_rateslists != '')
                                                    { 
                                                        foreach ($call_rateslists as $call_rateslist) 
                                                        {
                                                        ?>
                                                        <p><span><?=$call_rateslist->decscription;?></span><span><?=$call_rateslist->rates;?></span></p>
                                                        <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<h5>No call rates !</h5>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="block-shadow-profile">
                                                <h4>Entertainment Services</h4>
                                                <div class="list-favaourites-block">
                                                    <ul>
                                                        <?php 
                                                        $exp_service_ids = explode(",", $user_d['service_id']);
                                                        foreach ($exp_service_ids as $exp_service_id)
                                                        {
                                                            $service_name = $this->crud->get_one_value("service",array("service_id" => $exp_service_id),"name");
                                                        ?>
                                                        <li><a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?=$service_name;?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="block-shadow-profile">
                                                <h4>Language</h4>
                                                <div class="list-favaourites-block">
                                                    <ul>
                                                        <?php 
                                                        $exp_language_ids = explode(",", $user_d['language_id']);
                                                        foreach ($exp_language_ids as $exp_language_id)
                                                        {
                                                            $language_name = $this->crud->get_one_value("language",array("language_id" => $exp_language_id),"name");
                                                        ?>
                                                        <li><a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?=$language_name;?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="block-shadow-profile">
                                                <h4>Locations</h4>
                                                <div class="list-favaourites-block">
                                                    <?php
                                                    if(is_array($location))
                                                    {
                                                        foreach ($location as $location_details) 
                                                        {
                                                            $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$location_details->country_id."'");
                                                            $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$location_details->state_id."'");
                                                            ?>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label">Country Name</label>
                                                                <a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?= $country_name; ?></a>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="control-label">State Name</label>
                                                                <a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?= $state_name; ?></a>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="control-label">City Name</label><br>
                                                                <?php 
                                                                $exp_city = explode(",", $location_details->city_id);
                                                                foreach ($exp_city as $exp_city_val) 
                                                                {
                                                                    $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$exp_city_val."'");
                                                                    ?>
                                                                    <a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?= $city_name; ?></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="block-shadow-profile">
                                                <h4>MY FAVOURITES</h4>
                                                <div class="list-favaourites-block">
                                                    <ul>
                                                        <?php 
                                                        $exp_favorite_ids = explode(",", $user_d['favorite_id']);
                                                        foreach ($exp_favorite_ids as $exp_favorite_id)
                                                        {
                                                            $favorite_name = $this->crud->get_one_value("favorite",array("favorite_id" => $exp_favorite_id),"name");
                                                        ?>
                                                        <li><a class="button button-lg button-shadow-2 button-primary button-zakaria" href="javascript:void(0);"><?=$favorite_name;?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="block-shadow-profile">
                                                <h4> MY PREFERENCES
                                                </h4>
                                                <p class="box-comment-text">
                                                    <?=$user_d['my_preferences'];?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="gallery">
                                <div class="block-profile-main">
                                    <ul>
                                        
                                            <?php
                                            if($gallerylists){
                                            foreach ($gallerylists as $gallerylist) 
                                            {
                                            ?>
                                            <li>
                                            <?php
                                                $image_path     = $gallerylist->gallery_file;

                                                $prd_exist = UPLOAD_DIR.GALLERY_IMG.$image_path;

                                                if(file_exists($prd_exist) && $image_path!="") 
                                                {
                                                    $prd_preview = base_url().UPLOAD_DIR.GALLERY_IMG.$image_path;
                                                } 
                                                else 
                                                {
                                                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                                                }

                                                if(file_exists(UPLOAD_DIR.GALLERY_IMG.$image_path) && $image_path!='')  
                                                {
                                                    $ext = pathinfo($image_path, PATHINFO_EXTENSION);
                                                    $video= array("webm","mkv","flv","gif","m4p","mp4");

                                                    if (in_array($ext, $video))
                                                    {
                                                    ?>
                                                    <video width="100" height="100" controls>
                                                        <source src="<?=$prd_preview;?>">
                                                    </video>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <a href="<?=$prd_preview;?>">
                                                        <img src="<?=$prd_preview?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>">
                                                    </a>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            </li>
                                            <?php
                                            }
                                        }else{
                                            echo "<h4>Record not found</h4>";
                                        }

                                            ?>
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="diary">
                                <p>These are the times that <?=ucwords($user_d['fname']." ".$user_d['lname']);?> will make appointments to meet you.
                                    <?=ucwords($user_d['fname']." ".$user_d['lname']);?> may not always be available at the specified times.
                                </p>
                                    <?php
                                    if(is_array($diary))
                                    {
                                        $diary_count = 0;
                                        foreach ($diary as $diary_details) 
                                        {
                                        ?>
                                        <div class="block-shadow-profile d-flex">
                                        <?php
                                            $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$diary_details->country_id."'");
                                            $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$diary_details->state_id."'");
                                            ?>
                                            <div class="block-shadow-profile-inner">
                                                <?php 
                                                if($diary_count == 0)
                                                {
                                                ?>
                                                <h4><i class="far fa-calendar"></i> DATE</h4>
                                                <?php
                                                }
                                                ?>

                                                <p><span>From:</span><span><?php echo date("d-m-Y",strtotime($diary_details->from_date)); ?></span></p>
                                                <p><span>To:</span><span><?php echo date("d-m-Y",strtotime($diary_details->to_date)); ?></span></p>
                                            </div>
                                            <div class="block-shadow-profile-inner">
                                                <?php 
                                                if($diary_count == 0)
                                                {
                                                ?>
                                                <h4><i class="fal fa-clock"></i>  TIME</h4>
                                                <?php
                                                }
                                                ?>

                                                <p><span>00:00 </span><span> 23:59</span></p>
                                            </div>
                                            <div class="block-shadow-profile-inner">
                                                <?php 
                                                if($diary_count == 0)
                                                {
                                                ?>
                                                <h4><i class="fal fa-map-marker-alt"></i> LOCATION</h4>
                                                <?php
                                                }
                                                ?>

                                                <p><span><?= $country_name; ?>,<?= $state_name; ?>,<?php 
                                                $diary_city = explode(",", $diary_details->city_id);
                                                foreach ($diary_city as $diary_city_val) 
                                                {
                                                    $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$diary_city_val."'");
                                                    echo $city_name."<br>";
                                                }
                                                ?>Cork City</span></p>
                                            </div>
                                        <?php
                                        $diary_count++; 
                                        ?>
                                        </div>
                                        <?php
                                        }
                                    }
                                    ?>
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <div class="review-tab-block">
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus accusamus, cum, rerum, iusto facilis eveniet alias numquam culpa commodi consequuntur vero quaerat? Aspernatur vero dolorum, blanditiis libero eveniet quasi ratione.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, natus, labore similique architecto praesentium libero iste aperiam dolores eum minima quasi maiores odio nemo. Et aut ab modi error reprehenderit?</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, laboriosam eaque eligendi quae sed nesciunt cupiditate facere provident non assumenda, molestias dignissimos asperiores. Asperiores autem voluptate commodi corporis eaque reiciendis.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="review-inner-block">
                                        <article class="quote-creative">
                                            <div class="quote-creative-text">
                                                <div class="q">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                            </div>
                                            <div class="rating-block">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                                                <div class="unit-left">
                                                    <div class="quote-creative-figure"><img src="<?=FRONT_ASSETS?>images/gallery-10.jpg" alt="" width="62" height="62">
                                                    </div>
                                                </div>
                                                <div class="unit-body">
                                                    <div class="quote-creative-author">John Deo</div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <a class="button button-lg button-shadow-2 button-primary button-zakaria mt-5 margin-auto-custom" href="#">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <div id="phoneModal" class="modal fade">  
        <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close button button-shadow-2 button-primary button-zakaria" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">CALL NOW!</h4>  
                </div>  
                <div class="modal-body">  
                    <div class="blocks-information"> 
                        <div id="card">
                            <div class="row">
                                <div class="form-group col-md-12 text-left">
                                    <label class="form-label-custom">Choose a phone number to call</label>  
                                    <h3><a href="tel:<?=$user_d['phone'];?>"><i class="fas fa-phone-alt"></i><?=$user_d['phone'];?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
           </div>  
        </div>  
    </div> 


    <!-- footer -->
    <?php $this->load->view(FRONTEND."include/footer"); ?>

    <?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>      
</html>
<script type="text/javascript">
    $('.slider-profile-main').slick({
        infinite: true,
        dots: false,
        arrows: true,
        centerMode: true,
        centerPadding: '20',
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
    });
</script>
</body>
</html>
   