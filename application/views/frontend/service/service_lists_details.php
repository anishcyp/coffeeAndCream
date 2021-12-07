<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?>
    <link rel="stylesheet" href="<?php echo SNAP_DIST;?>zuck.min.css">
    <link rel="stylesheet" href="<?php echo SNAP_DIST;?>skins/snapgram.css"> 
    <link rel="stylesheet" href="<?php echo SNAP_DIST;?>skins/vemdezap.css">
    <link rel="stylesheet" href="<?php echo SNAP_DIST;?>skins/facesnap.css">
    <link rel="stylesheet" href="<?php echo SNAP_DIST;?>skins/snapssenger.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .user_images{
  /* float:left not working in mozilla*/
    min-width: 170px;
    display: inline-block;
    padding: 6%;
    background-color: #fff;
    margin: 1%;
    box-shadow: 8px 6px 4px rgb(0 0 0 / 60%);
    text-align: center;
    border: 1px solid #d2d8d8;
    cursor: pointer;
}

.user_images figure{
  width: 100%;
  margin-bottom: 5px;
}

.user_images figure img{
  width: 100%;
}

figcaption{
  background-color: rgba(0,0,0,0.8);
  text-transform: uppercase;
  text-align: center;
  padding: 5px;
  font-size: 16px;
  font-family: sans-serif;
  cursor: pointer;
  color: slategrey;
  max-width:100%;
  font-weight: bold;
}

figcaption:hover{
  color: #fff;
}

* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
    </style>
</head>
<body class="">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h1>
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
                    <!-- <div class="profile-item">
                        <video width="100" height="100" controls>
                            <source src="<?=$prd_preview;?>">
                        </video>
                    </div> -->
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="profile-item">
                        <div class="profile-item-inner">
                           <img src="<?=$prd_preview?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>">
                        </div>
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
                            <div class="q"><?=ucwords($user_d['fname']." ".$user_d['lname']);?> - ready to give you a show you wont forget
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
                        <div class="alert alert-primary binlk-text" role="alert">
                          <?php echo $site_settings['gallery_massage_details'].' '.$user_d['fname'].' '.$user_d['lname']; ?>
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
                                        <div class="unit-left deposit-section">
                                            <div class="user_images">
                                                <figure>
                                                        <img src="<?= $prd_preview ?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>" style="max-width: 170px;"/>
                                                </figure>
                                                <figcaption>
                                                <?=ucwords($user_d['fname']." ".$user_d['lname']);?>
                                                </figcaption>  
                                            </div>
                                            
                                            <div class="deposit-info">
                                                <?php
                                                if($user_d['call_type'] == 1)
                                                {
                                                    $str = strtolower($user_d['slug']);
                                                    $details_url1  = base_url()."deposit/".$str."/";
                                                ?>
                                                    <a href="<?= $details_url1 ?>" class="button button-lg button-shadow-2 button-primary button-zakaria">Deposit Now</a>
                                                    <p>(Deposit is secure~arrange booking directly)</p>
                                                    <a href="<?php echo base_url("payment-guidelines")?>" target="_blank"><b>Payment Guidelines</b></a>
                                                <?php 
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="unit-body">
                                        <div class="group-sm group-justify">
                                            <?php 
                                            if(is_array($diary))
                                            {
                                                $diary_count = 0;
                                                foreach ($diary as $diary_details) 
                                                {
                                                if($diary_details->from_date != date("Y-m-d"))
                                                {
                                                $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$diary_details->country_id."'");
                                                $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$diary_details->state_id."'");

                                                $diary_city = explode(",", $diary_details->city_id);
                                            foreach ($diary_city as $diary_city_val) 
                                            {
                                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$diary_city_val."'");
                                               
                                            }
                                            ?>
                                               
                                                <div class="box-comment-time">
                                                    <p><?= $country_name .' , '. $state_name .' , '. $city_name ?></p>
                                                    <time datetime="2020-11-30"><?php echo date('D  m  Y', strtotime($diary_details->from_date)); ?> → <?php echo date('D  m  Y', strtotime($diary_details->to_date)); ?></time>
                                                </div>
                                            <?php
                                            }
                                            }
                                            }
                                            ?>
                                            </div>

                                            <div class="block-shadow-profile social-section">
                                                <ul>
                                                    <li><a href="javascript:void(0);"><i class="fas fa-phone-alt" data-toggle="modal" data-target="#phoneModal"></i><span>Call</span></a></li>

                                                    <li><a href="mailto:<?=$user_d['email'];?>"><i class="fas fa-envelope"></i><span>Email</span></a></li>
                                                    <?php
                                                    if($user_d['whatsapp_number']!="")
                                                    {
                                                    ?>
                                                    <li><a href="https://api.whatsapp.com/send?phone=<?=$user_d['whatsapp_number']?>"><i class="fab fa-whatsapp"></i><span>WhatsApp</span></a></li>
                                                    <?php 
                                                    }
                                                    ?>
                                                    
                                                    <li><a href="javascript:void(0)" id="btn"><i class="fas fa-link"></i><span id="copied">Copy Url</span></a></li>
                                                    <?php if($user_d['Verifygallery'] == '1'){ ?>
                                                    <li><a href="javascript:void(0);"><i class="fas fa-check-square"></i><span>Photos verified</span></a></li>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <li><a href="javascript:void(0);" style="color: red;"><i class="fas fa-times-square"></i><span>Photos unverified</span></a></li>
                                                    <?php 
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="block-shadow-profile">
                                            <h4 style="text-align: center;letter-spacing: .0.00em;font-weight: 450; color: #3cc3c1;"><i class="fas fa-photo-video" style="color: #3cc3c1;"></i> My Stories</h4>
                                                <div id="stories" class="storiesWrapper"></div>
                                            </div>

                                            <div class="block-shadow-profile">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450; color: #3cc3c1;"><i class="fas fa-align-justify" style="color: #3cc3c1;"></i> INTRODUCTION</h4>
                                                <p class="box-comment-text"><?=$user_d['Introduction'];?>
                                                </p>
                                            </div>
                                            <div class="block-shadow-profile block-profile row ml-0 mr-0">
												<div class="info-box col-6 pl-0">
													<div class="block-shadow-profile-inner">
													<?php
														$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$user_d['country_id']."'");

														$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");

														$city_name = $this->crud->get_column_value_by_id("city","name","id = '".$user_d['city_id']."'");
														?>
														<h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;">General</h4>
														<p><span>Location</span><span><?php 
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
																	<span>Entertainment & Escort Services</span>
																	<?php
																}
															?>, <?= $city_name ?></span></p>
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
																	<span>Entertainment & Escort Services</span>
																	<?php
																}
															?>
														</p>
														<p><span>Withheld numbers</span><span> <?=$user_d['withheld_numbers'];?></span></p>
														<p><span>Text messages</span><span> <?=$user_d['text_massage'];?></span></p>
														<p><span>Out of hour calls</span><span> <?=$user_d['out_of_hour_calls'];?></span></p>
													</div>
                                                </div>
												
												<div class="info-box col-6 pr-0">
													<div class="block-shadow-profile-inner">
														<?php
														if($call_rateslists != '')
														{
															if($call_rateslists != '')
															{ 
																?> <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;text-transform: revert;font-size: 20px;">In Call Rates</h4> <?php
																foreach ($call_rateslists as $call_rateslist) 
																{
																	if($call_rateslist->call_type == "In Call")
																	{
																?>
																	<p><span><?=$call_rateslist->decscription;?></span><span><?=$call_rateslist->rates;?></span></p>
																<?php
																	}
																	
																}
															}
														   
															if($call_rateslists != '')
															{ 
															    ?> 
                                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;text-transform: revert;font-size: 20px;">Out Call Rates</h4> <?php
																foreach ($call_rateslists as $call_rateslist) 
																{
																	if($call_rateslist->call_type == "Out Call")
																	{
																?>
																	<p><span><?=$call_rateslist->decscription;?></span><span><?=$call_rateslist->rates;?></span></p>
																<?php
																	}
																	
																}
															}
															
														}
														else
														{
															
														}
														?>
													</div>
												</div>
                                            </div>
                                            
                                            <div class="block-shadow-profile">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;"><i class="fas fa-cog" style="color: #3cc3c1;"></i> Services</h4>
                                                <div class="list-favaourites-block">
                                                <?php 
                                                    $exp_service_ids = explode(",", $user_d['service_id']);
                                                    foreach ($exp_service_ids as $exp_service_id)
                                                    {
                                                        $service_name = $this->crud->get_one_value("service",array("service_id" => $exp_service_id),"name");
                                                        $slug = $this->crud->get_one_value("service",array("service_id" => $exp_service_id),"slug");
                                                        ?>
                                                        #<?= $service_name." , " ?>
                                                        <?php
                                                    }
                                                ?>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="block-shadow-profile">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;"><i class="fas fa-language" style="color: #3cc3c1;"></i> My Language</h4>
                                                <div class="list-favaourites-block">
                                                    <?php
                                                    if($user_d['language_id'] != '')
                                                    {
                                                    ?>
                                                    <ul>
                                                        <?php 
                                                        $exp_language_ids = explode(",", $user_d['language_id']);
                                                        foreach ($exp_language_ids as $exp_language_id)
                                                        {
                                                            $language_name = $this->crud->get_one_value("language",array("language_id" => $exp_language_id),"name");
                                                            $slug = $this->crud->get_one_value("language",array("language_id" => $exp_language_id),"slug");
                                                            ?>
                                                            <li><a class="button button-lg button-shadow-2 button-primary button-zakaria" href="<?=base_url();?>language/<?=$slug;?>"><?=$language_name;?></a></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                         echo "<p align='center'>Language not found.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            <div class="block-shadow-profile location-list-main">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;"><i class="fas fa-map-marker-alt" style="color: #3cc3c1;"></i> My Locations</h4>
                                                <div class="list-favaourites-block">
                                                    <?php
                                                    if(is_array($location))
                                                    { ?>
                                                        <div class="row">
                                                            
                                                        <div class="form-group col-md-12">
                                                            <label class="control-label"><b>Put Here Cities</b></label>

                                                        <?php 
                                                        foreach ($location as $location_details)
                                                        {
                                                            $country_slug = $this->crud->get_column_value_by_id("country","slug","country_id = '".$location_details->country_id."'");
                                                            $state_slug = $this->crud->get_column_value_by_id("state","slug","state_id = '".$location_details->state_id."'");
                                                            $exp_city = explode(",", $location_details->city_id);
                                                            foreach ($exp_city as $exp_city_val) 
                                                            {
                                                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$exp_city_val."'");
                                                                $city_slug = $this->crud->get_column_value_by_id("city","slug","id = '".$exp_city_val."'");
                                                                $city_url  = base_url()."detail/".$country_slug.'/'.$state_slug.'/'.$city_slug
                                                                ?>
                                                                <a style="color: black;" class="list-location" href="<?= $city_url ?>"><?= $city_name.' , '; ?></a>
                                                                <?php
                                                            }
                                                                
                                                        }
                                                        ?>
                                                        </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        echo "<p align='center'>Location not found.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="block-shadow-profile">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;"><i class="fas fa-star" style="color: #3cc3c1;"></i> MY FAVOURITES</h4>
                                                <div class="list-favaourites-block">
                                                    <?php
                                                    if($user_d['favorite_id'] != '')
                                                    {
                                                    ?>
                                                    <ul>
                                                        <?php 
                                                        $exp_favorite_ids = explode(",", $user_d['favorite_id']);
                                                        foreach ($exp_favorite_ids as $exp_favorite_id)
                                                        {
                                                            $favorite_name = $this->crud->get_one_value("favorite",array("favorite_id" => $exp_favorite_id),"name");
                                                            $slug = $this->crud->get_one_value("favorite",array("favorite_id" => $exp_favorite_id),"slug");
                                                        ?>
                                                        <li><a class="button button-lg button-shadow-2 button-primary button-zakaria" href="<?=base_url();?>favorite/<?=$slug;?>"><?=$favorite_name;?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                        echo "<p align='center'>Favaourites not found.</p>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="block-shadow-profile">
                                                <h4 style="text-align: center;letter-spacing: .075em;font-weight: 450;color: #3cc3c1;"><i class="fas fa-asterisk" style="color: #3cc3c1;"></i>  MY PREFERENCES
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
                                <div class="block-profile-main gallery_video">
                                    <ul>
                                        <?php
                                        if($gallerylists)
                                        {
                                            foreach ($gallerylists as $gallerylist) 
                                            {
                                            ?>
                                            <li>
                                                <div class="inner_link">
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
                                                    $ext = pathinfo($prd_preview, PATHINFO_EXTENSION);
                                                    $video= array("webm","mkv","flv","gif","m4p","mp4");

                                                    if (in_array($ext, $video))
                                                    {
                                                    ?>
                                                    <video width="300" height="300" controls>
                                                          <source src="<?= $prd_preview; ?>?autostart=false" type="video/mp4">
                                                    </video>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    
                                                    <a href="<?=$prd_preview;?>" data-lightbox="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>" target="_blank">
                                                        <img src="<?=$prd_preview?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>">
                                                    </a>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            </div>
                                            </li>
                                            <?php
                                            }
                                        }
                                        else
                                        {
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
                                        <div class="block-shadow-profile d-flex two-part-flex">
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
                                                <?php
                                                $from_date = $diary_details->from_date;
                                                ?>
                                                <p><span>From:</span><span><?php echo date('d, F, Y', strtotime($from_date)); ?></span></p>
                                                <?php
                                                $to_date = $diary_details->to_date;
                                                ?>
                                                <p><span>To:</span><span><?php echo date('d, F, Y', strtotime($to_date)); ?></span></p>
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
                                                
                                                <p><span><?= $diary_details->start_time ?> - <?= $diary_details->end_time ?></span></p>
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

                                                <p><span><?= $country_name .' , '. $state_name; ?> , 

                                                <?php $diary_city = explode(",", $diary_details->city_id);
                                                foreach ($diary_city as $diary_city_val) 
                                                {
                                                    $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$diary_city_val."'");
                                                   
                                                }
                                                ?><?= $city_name ?></span></p>
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

                            <!-- **** Reviews Section  **** -->

                            <div class="tab-pane fade" id="reviews">

                                <!-- *** Write a reviews *** -->
                                
                                <div class="col-md-12 review-progressbar-main">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            
                                            <div class="row">
                                                <?php 

                                                //accuracy of photos avg
                                                $accuracy_of_photos = "SELECT avg(accuracy_of_photos) AS accuracy_of_photos FROM review WHERE user_id='".$user_d['id']."'";
                                                $accuracy_of_photos = $this->crud->getFromSQL($accuracy_of_photos);
                                                $accuracy_of_photos= ceil($accuracy_of_photos['0']->accuracy_of_photos);


                                                //location avg
                                                $location = "SELECT avg(location) AS location FROM review WHERE user_id='".$user_d['id']."'";
                                                $location = $this->crud->getFromSQL($location);
                                                $location= ceil($location['0']->location);


                                                //physical appearance avg
                                                $physical_appearance = "SELECT avg(physical_appearance) AS physical_appearance FROM review WHERE user_id='".$user_d['id']."'";
                                                $physical_appearance_avarge = $this->crud->getFromSQL($physical_appearance);
                                                $physical_appearance_avarge= ceil($physical_appearance_avarge['0']->physical_appearance);


                                                //services receive avg
                                                $received_avarge = "SELECT avg(services_received) AS services_received FROM review WHERE user_id='".$user_d['id']."'";
                                                $services_received_avarge = $this->crud->getFromSQL($received_avarge);
                                                $services_received_avarge= ceil($services_received_avarge['0']->services_received);

                                                //value for money avg
                                                $value_for_money = "SELECT avg(value_for_money) AS value_for_money FROM review WHERE user_id='".$user_d['id']."'";
                                                $value_for_money = $this->crud->getFromSQL($value_for_money);
                                                $value_for_money= ceil($value_for_money['0']->value_for_money);


                                                //overall experience avg
                                                $overall_experience = "SELECT avg(overall_experience) AS overall_experience FROM review WHERE user_id='".$user_d['id']."'";
                                                $overall_experience = $this->crud->getFromSQL($overall_experience);
                                                $overall_experience= ceil($overall_experience['0']->overall_experience);

                                                ?>
                                            
                                                <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>Accuracy Of Photos</h5>
                                                        <p>
                                                           
                                                            <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$accuracy_of_photos){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>LOCATION</h5>
                                                        <p>
                                                            
                                                            <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$location){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                            
                                                <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>PHYSICAL APPEARANCE</h5>
                                                        <p>
                                                         
                                                            <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$physical_appearance_avarge){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                                 <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>SATISFACTION</h5>
                                                        <p>
                                                          
                                                             <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$services_received_avarge){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>VALUE FOR MONEY</h5>
                                                        <p>
                                                            
                                                            <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$value_for_money){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-4 col-sm-6 profiles-star-count">
                                                    <div class="profile-count-box">
                                                        <h5>OVERALL EXPERIENCE</h5>
                                                        <p>

                                                            <?php
                                                              
                                                              for($i=1; $i <= 5 ; $i++) {
                                                                  if($i>$overall_experience){
                                                                  ?>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                  <?php
                                                                  } else{
                                                                  ?> <i class="rating_count fa fa-star"></i>
                                                                  <?php } 
                                                              } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4 progress-round-count">
                                            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 roundbar-count">
                                                    <div class="progressbar-count">
                                                        <h5>Would Recommend</h5>
                                                        <svg class="progress-cust blue noselect" data-progress="100" x="0px" y="0px" viewBox="0 0 80 80">
                                                                <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                                <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                                <text class="value" x="50%" y="55%">0%</text>
                                                        </svg>
                                                  
                                                      
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-sm-6 roundbar-count">
                                                    <div class="progressbar-count">
                                                        <h5>Would Repeat</h5>
                                                        <svg class="progress-cust blue noselect" data-progress="100" x="0px" y="0px" viewBox="0 0 80 80">
                                                                <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                                <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                                <text class="value" x="50%" y="55%">0%</text>
                                                        </svg>
                                                      
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <?php 

                                if($user_d['call_type'] == '1')
                                {
                                    $service = 'Entertainment Reviews';
                                }
                                else if($user_d['call_type'] == '2')
                                {    
                                    $service = 'Escort Reviews';
                                }
                                else if($user_d['call_type'] == '3')
                                {    
                                    $service = 'Escorts & Entertainment Reviews';
                                }


                                $review_c  = $this->crud->get_data("review",array("isDelete" =>0,'user_id'=>$user_d['id']));
                                $reviews_q = count($review_c);


                                ?>
                               
                                     <div class="review-main-title">
                                    <div class="row">
                                        <div class="col-lg-6 review-count">
                                            <p><?= $reviews_q .' '. $service ?></p>
                                        </div>
                                        <div class="col-lg-6 review-btn">
                                            <a href="javascript:void(0)" class="btn btn-ea-primary btn-lg text-uppercase write_review">
                                            Write a review
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-ea-primary btn-lg text-uppercase reviewbutton">Write a review</a>
                                        </div>
                                    </div>
                                </div>


                                <div id="reviewsTEST">
                                <form id="regForm" method="post" action="<?= base_url("review-store"); ?>" enctype="multipart/form-data">
                                  <h4>LEAVE A REVIEW FOR <?= $user_d['fname'].' '.$user_d['lname'] ?></h4>
                                  <!-- One "tab" for each step in the form: -->
                                  <input type="hidden" name="user_id" value="<?= $user_d['id'] ?>">
                                  <div class="tab">
                                        <div class="row">
                                            <div class="col-md-12 write-review-section">
                                                <h5>What happened</h5>

                                                <div class="row">
                                                    <div class="col-sm-4 small-btn-box">
                                                        <div class="radio-custom">
                                                            <input type="radio" id="radio1" oninput="this.className = ''" name='outcome' value='completed' class="btn-ea-radio"  />
                                                             <label for="radio1">
                                                                Completed 
                                                            </label>
                                                            <p class="visible-lg what-happened-description">We met and service was performed</p>
                                                        </div>
                                                    </div>
                                                   <div class="col-sm-4 small-btn-box">     
                                                        <div class="radio-custom">
                                                            <input type="radio" id="radio2" oninput="this.className = ''" name='outcome' value='failed_meeting' class="btn-ea-radio"  />
                                                             <label for="radio2">
                                                               Failed booking 
                                                            </label>
                                                            <p class="visible-lg what-happened-description">Made a booking but we did not met</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 small-btn-box">
                                                         <div class="radio-custom">
                                                            <input type="radio" id="radio3" oninput="this.className = ''" name='outcome' value='no_service' class="btn-ea-radio"  />
                                                             <label for="radio3">
                                                                No service 
                                                            </label>
                                                            <p class="visible-lg what-happened-description">We met but no service was performed</p>
                                                        </div>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                  <div class="tab">
                                      <div class="row">
                                            <div class="col-md-12 write-review-section">
                                            <br><br>
                                            <input type="date" name="date" id="date">

                                            <br><br>
                                            <div class="form-group col-md-4">
                                            <label class="form-label-custom">We met at about</label>
                                            <select class="form-control" name="hour" id="hour">
                                                <option value="">Hour&nbsp;</option>
                                                <option value="0:00">0:00</option>
                                                <option value="0:30">0:30</option>
                                                <option value="1:00">1:00</option>
                                                <option value="1:30">1:30</option>
                                                <option value="2:00">2:00</option>
                                                <option value="2:30">2:30</option>
                                                <option value="3:00">3:00</option>
                                                <option value="3:30">3:30</option>
                                                <option value="4:00">4:00</option>
                                                <option value="4:30">4:30</option>
                                                <option value="5:00">5:00</option>
                                                <option value="5:30">5:30</option>
                                                <option value="6:00">6:00</option>
                                                <option value="6:30">6:30</option>
                                                <option value="7:00">7:00</option>
                                                <option value="7:30">7:30</option>
                                                <option value="8:00">8:00</option>
                                                <option value="8:30">8:30</option>
                                                <option value="9:00">9:00</option>
                                                <option value="9:30">9:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
        
                                            <br>
                                            <div class="form-group col-md-4">
                                            <label class="form-label-custom">For</label>
                                            <select class="form-control" name="time" id="time">
                                                <option value="">Time&nbsp;</option>
                                                <option value="0">Less than 30 mins</option>
                                                <option value="30">30 minutes</option>
                                                <option value="45">45 minutes</option>
                                                <option value="60">1 hour</option>
                                                <option value="120">2 hours</option>
                                                <option value="180">3 hours</option>
                                                <option value="240">4 hours</option>
                                                <option value="300">5 hours</option>
                                                <option value="360">6 hours</option>
                                                <option value="420">7 hours</option>
                                                <option value="480">8 hours</option>
                                                <option value="540">9 hours</option>
                                                <option value="600">10 hours</option>
                                                <option value="660">11 hours</option>
                                                <option value="720">12 hours</option>
                                                <option value="780">13 hours</option>
                                                <option value="840">14 hours</option>
                                                <option value="900">15 hours</option>
                                                <option value="960">16 hours</option>
                                                <option value="1020">17 hours</option>
                                                <option value="1080">18 hours</option>
                                                <option value="1140">19 hours</option>
                                                <option value="1200">20 hours</option>
                                                <option value="1260">21 hours</option>
                                                <option value="1320">22 hours</option>
                                                <option value="1380">23 hours</option>
                                                <option value="1440">24 hours</option>
                                            </select>
                                        </div>
                                         </div>
                                    </div>
                                  </div>


                                  <div class="tab">
                                    <div class="row">
                                        <div class="col-md-12 write-review-section">
                                        <h5 class="visible-lg text-gray text-center">Where was it?</h5>
                                
                                          <select class="form-control" name="city_id" id="city_id">
                                            <option value="">SELECT LOCATION</option>
                                            <?php

                                            foreach ($location as $location_details)
                                            {
                                                $exp_city = explode(",", $location_details->city_id);

                                                foreach ($exp_city as $exp_city_val) 
                                                {
                                                    $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$exp_city_val."'");
                                                    $city_id = $this->crud->get_column_value_by_id("city","id","id = '".$exp_city_val."'");
                                                    ?>
                                                    <option value="<?=$city_id?>"><?=$city_name;?></option>
                                                    <?php
                                                }
                                            
                                            }
                                            
                                            ?>
                                          </select>
                                   

                                            <!-- <div class="row flex pretty-checkbox-container" role="group" aria-label="...">
                                                <div class="pretty success smooth">
                                                    <input type="checkbox" name="location_visibility">
                                                    <label class="flex vcenter"><i class="icon icon-just-tick"></i>Do not show the location in the review</label>
                                                </div>
                                            </div>
                                            <br> -->
                                            <hr>

                                    
                                            <h5>What happened</h5>
                                            <div class="row">
                                                <div class="col-sm-4 small-btn-box">
                                                    <div class="radio-custom">
                                                        <input type="radio" id="radio4" oninput="this.className = ''" name='call_type' value='INCALL' class="btn-ea-radio"  />
                                                        <label for="radio4">
                                                            INCALL
                                                        </label>
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4 small-btn-box">
                                                    <div class="radio-custom">
                                                        <input type="radio" id="radio5" oninput="this.className = ''" name='call_type' value='OUTCALL' class="btn-ea-radio"  />
                                                         <label for="radio5">
                                                            OUTCALL
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <br>

                                            <h5>What happened</h5>
                                            <div class="row">
                                                <!--div class="col-sm-4 small-btn-box">
                                                    <label class="btn btn-ea-radio-label text-uppercase ">
                                                        <input type="radio" oninput="this.className = ''" name='currency' value='eur' class="btn-ea-radio"  />
                                                        EUR
                                                    </label>
                                                </div-->
                                                
                                                 <div class="col-sm-4 small-btn-box">
                                                    <div class="radio-custom">
                                                        <input type="radio" id="radio6" oninput="this.className = ''" name='currency' value='gbp' class="btn-ea-radio" checked />
                                                         <label for="radio6">
                                                            GBP
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                                                            
                                                <div class="col-sm-4 small-btn-box">
                                                    <input type="text" class="required currency col-xs-6" placeholder="Enter price" name="review_cost" style="width: 159%;height: 41.5px;" value="" maxlength="5"/>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>




                                  <div class="tab">
                                    <div class="row">  
                                        <div class="col-md-12 write-review-section">
                                        <h5 class="visible-lg text-gray text-center">Questions over, let&#039;s get creative!</h5>
                                            <div class="col-xs-12 col-lg-10 col-lg-offset-1">

                                            <textarea name="introduction" rows="10" cols="60" placeholder="Enter Your profile introduction here..." id="introduction" class="form-control"></textarea>

                                            <div>Write in between 100 and 3000 chars. Now are <span id="chars_count_display">0</span></div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>


                                  <div class="tab">
                                    <div class="row">  
                                        <div class="col-md-12 write-review-section">
                                            <h4 class="text-center title-ratings"><i class="icon-review"></i>Ratings</h4>
                                            <div class="row ratings">
                                                <div class="col-xs-12 col-sm-12 col-lg-12 text-center rate-stars">
                                                    
                                                    <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Accuracy of photos</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_accuracy" id="rating1-none" value="0" type="radio">
                                                                <label aria-label="1 star" class="rating__label" for="rating1-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_accuracy" id="rating1-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating1-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_accuracy" id="rating1-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating1-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_accuracy" id="rating1-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating1-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_accuracy" id="rating1-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating1-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_accuracy" id="rating1-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Location</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_loaction" id="rating2-none" value="0" type="radio">
                                                                
                                                                <label aria-label="1 star" class="rating__label" for="rating2-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_loaction" id="rating2-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating2-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_loaction" id="rating2-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating2-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_loaction" id="rating2-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating2-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_loaction" id="rating2-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating2-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_loaction" id="rating2-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Physical appearance</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_physical" id="rating3-none" value="0" type="radio">
                                                                
                                                                <label aria-label="1 star" class="rating__label" for="rating3-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_physical" id="rating3-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating3-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_physical" id="rating3-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating3-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_physical" id="rating3-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating3-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_physical" id="rating3-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating3-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_physical" id="rating3-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Services received</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_servicerec" id="rating4-none" value="0" type="radio">
                                                                
                                                                <label aria-label="1 star" class="rating__label" for="rating4-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_servicerec" id="rating4-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating4-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_servicerec" id="rating4-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating4-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_servicerec" id="rating4-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating4-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_servicerec" id="rating4-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating4-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_servicerec" id="rating4-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Value for money</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_valuemoney" id="rating5-none" value="0" type="radio">
                                                                
                                                                <label aria-label="1 star" class="rating__label" for="rating5-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_valuemoney" id="rating5-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating5-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_valuemoney" id="rating5-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating5-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_valuemoney" id="rating5-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating5-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_valuemoney" id="rating5-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating5-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_valuemoney" id="rating5-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                      <div class="star-rating row">
                                                        <h4 class="title col-xs-12 col-md-6">Overall experience</h4>
                                                        <div class="col-md-6 star-icons-list">
                                                            <div class="rating-group">
                                                                <input disabled checked class="rating__input rating__input--none" name="review_overallexp" id="rating6-none" value="0" type="radio">
                                                                
                                                                <label aria-label="1 star" class="rating__label" for="rating6-1">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_overallexp" id="rating6-1" value="1" type="radio">
                                                                <label aria-label="2 stars" class="rating__label" for="rating6-2">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_overallexp" id="rating6-2" value="2" type="radio">
                                                                <label aria-label="3 stars" class="rating__label" for="rating6-3">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_overallexp" id="rating6-3" value="3" type="radio">
                                                                <label aria-label="4 stars" class="rating__label" for="rating6-4">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_overallexp" id="rating6-4" value="4" type="radio">
                                                                <label aria-label="5 stars" class="rating__label" for="rating6-5">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                                <input class="rating__input" name="review_overallexp" id="rating6-5" value="5" type="radio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <!--div class="small-btn-box">
                                                    <label><b>Enter</b></label>
                                                    <input type="text" oninput="this.className = ''" class="required currency col-xs-6" placeholder="Enter price" name="reates" style="width: 130%;height: 42.5px;" value="" maxlength="5"/>
                                                </div-->
                                        </div>
                                    </div>
                                  </div>



                                  <div class="button-section-wizard">
                                      <div style="overflow:auto;">
                                        <div class="button-nextprev">
                                          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                        </div>
                                      </div>
                                      <!-- Circles which indicates the steps of the form: -->
                                      <div class="process-step" style="text-align:center;margin-top:10px; margin-bottom:5px">
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                      </div>
                                    </div>
                                </form>
                                </div>
                                
                                
                                <div class="review-main-title">
                                <div class="review-panel">
                                    <div class="panel-list">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3">Reviewer</div>
                                                <div class="col-lg-2 col-md-3">Location</div>
                                                <div class="col-lg-2 col-md-3">Date</div>
                                                <div class="col-lg-2 offset-lg-1 mob-none">Rating</div>
                                                <div class="col-md-2 mob-none"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion review-accordion" id="accordion" role="tablist" aria-multiselectable="true">

                                    

                                    </div>

                                 </div>
                                </div>
                                <div id="load_button">

                                </div>
                                 <!-- <a class="button button-lg button-shadow-2 button-primary button-zakaria mt-5 margin-auto-custom" href="#">View More</a> -->
                                </div>
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

    <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="phoneModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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

$(document).ready(function()
{
    $('#reviewsTEST').hide();
    $('.reviewbutton').hide();
    
     /* $(".write-review-section .small-btn-box .btn-ea-radio-label").on("click", function(event) {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
      } else {
        $(".write-review-section .small-btn-box .btn-ea-radio-label ").parent().removeClass("active");
       $(this).addClass("active");
      }
      event.preventDefault();
    }); */
    
    $(".write-review-section .small-btn-box span.radio-custom-dummy").remove();
     $(".write-review-section .star-rating span.radio-custom-dummy").remove();
    
});

// $(document).on("click","#flashing",function(){

//     var id = $(this).attr("data-id");
//     var action = $(this).attr("data-action");
//     $('#ids').val(id);
//     // alert(action);
//     $('#frm').attr('action', action).submit();
//     document.getElementById("frm").submit();

// });


$(document).on('click','.write_review',function()
{
    $('.reviewbutton').show();
    $('#reviewsTEST').show();
    $('.write_review').hide();

});

$(document).on('click','.reviewbutton',function()
{
   $('#reviewsTEST').hide();
   $('.reviewbutton').hide();
    $('.write_review').show();
});


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
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }
  }
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}

var forEach = function (array, callback, scope) {
    for (var i = 0; i < array.length; i++) {
        callback.call(scope, i, array[i]);
    }
};
window.onload = function(){
    var max = -219.99078369140625;
    forEach(document.querySelectorAll('.progress-cust'), function (index, value) {
    percent = value.getAttribute('data-progress');
        value.querySelector('.fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
        value.querySelector('.value').innerHTML = percent + '%';
    });
}
getReview(10);
function getReview(count){
    $.ajax({
        type : 'POST',
        url : baseURL+'ServicesController/getreview',
        data: { count : count,user_id : <?= $user_d['id']; ?>},
        dataType: 'json',
        success:function(response) 
        {
            $('#accordion').html(response.html);
            $('#load_button').html(response.load_button);
        }
    });
}

$(document).ready(function(){
    var $temp = $("<input>");
    var $url = $(location).attr('href');
    $('#btn').click(function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    $("#copied").text("URL copied!");
    });
});
</script>

<script src="<?php echo SNAP_DIST;?>zuck.min.js"></script>
<script src="<?php echo SNAP_DEMO;?>script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
<script>
var currentSkin = getCurrentSkin();
var response = $.ajax({ type: "POST",
                        data: { user_id : <?= $user_d['id']; ?>},
                        url: baseURL+"CommonController/story/",   
                        async: false
                      }).responseText;
    var response = JSON.parse(response)
    // console.log(response[0])

var stories = new Zuck('stories',{
    skin: "snapgram",
    avatars: !0,
    list: !1,
    openEffect: !0,
    cubeEffect: !1,
    autoFullScreen: !1,
    backButton: !0,
    backNative: !0,
    previousTap: !0,
    localStorage: !0,
    reactive: !1,
    rtl: !1,
    stories: response

});

</script>
</body>
</html>
   