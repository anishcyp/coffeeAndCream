<?php 
$SocialInfo = FrontSiteInfo(); 
$countrylists = $this->crud->get_result_where_array('country',array('status'=>'Y','isDelete'=>0) ); 
$serv_list = $this->crud->get_all_with_where('service','name','ASC',array('status'=>'Y','isDelete'=>0,'is_dis_on_menu'=>1));
?>

<div class="fiter-block-main">
   <div class="close-icon-main">
      <a href="#">
         <i class="far fa-times"></i>
      </a>
   </div>
   <form action="<?= base_url('search-filter') ?>"  role="form" id="" name="" method="post"  role="form">
   <div class="form-inner-sidebar">
      <div class="form-group">
         <label><i class="fas fa-flag"></i>  Country</label>
          <select class="form-control" name="country_id" id="country_id" onchange="getStateListbyCountry(this.value)">
            <option value="">Select Country</option>
            <?php foreach ($countrylists as $countrylist) { ?>
              <option value="<?php echo $countrylist->country_id; ?>"><?php echo $countrylist->name; ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="form-group">
         <label><i class="fas fa-flag-usa"></i> State</label>
         <select class="form-control" name="state_id" id="state_id" onchange="getCityByState(this.value)">
          <option value="">Select State</option>
        </select>
      </div>
      <div class="form-group">
         <label><i class="fas fa-city"></i> City</label>
          <select class="form-control" name="city_id" id="city_id">
            <option value="">Select City</option>
          </select>
      </div>
      <div class="form-group">
         <label><i class="far fa-users"></i> Advert type</label>
         <select class="form-control" name="gender" id="gender">
          <option value="">Select Gallery</option>
           <option value="male">Male</option>
           <option value="female">Female</option>
         </select>
      </div>
      <div class="form-group">
         <label><i class="far fa-cog"></i> Services</label>
         <select class="form-control" name="service_id" id="service_id" >
            <option value="">Select Service</option>
            <?php foreach ($serv_list as $serv_lists) { ?>
              <option value="<?php echo $serv_lists->name; ?>"><?php echo $serv_lists->name; ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="form-group">
         <label><i class="far fa-search"></i> Search Keyword</label>
         <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Search Keyword">
      </div>
      <div class="btn-last">
          <button class="button button-lg button-primary button-zakaria" name="submit" id="submit" value="search">Search</button>
      </div>
    </div>
   </form>
</div>


<div class="loading-div" style="display:none;">
   <div><img style="width:10%" src="<?php echo COMMON."loader.svg"?>" alt="Loader img"/></div>
</div>
<footer class="section footer-modern footer-modern-2">
    <div class="footer-modern-body section-xl context-dark">
        <div class="container">
            <div class="row row-40 row-md-50 justify-content-xl-between">
                <div class="col-md-10 col-lg-3 col-xl-4 wow fadeInRight">
                    <div class="inset-xl-right-70 block-1">
                        <h5 class="footer-modern-title">Subscribe to our newsletter</h5>
                        <!-- <form class="rd-form rd-mailform rd-form-inline form-lg rd-form-text-center"> -->
                            <div class="form-wrap wow fadeInUp">
                                <input class="form-input form-control-has-validation"  type="email" name="email_newsletter" id="email_newsletter" placeholder="Enter your e-mail address">
                            </div>
                            <div class="form-button wow fadeInRight">
                                <button class="button button-shadow-2 button-zakaria button-lg button-primary" type="submit" value="Submit" id="submit-newsletter">Subscribe</button>
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
                <div class="col-sm-6 col-md-7 col-lg-5 wow fadeInRight" data-wow-delay=".1s">
                    <h5 class="footer-modern-title">Quick Links</h5>
                    <ul class="footer-modern-list footer-modern-list-2 d-sm-inline-block d-md-block">
                        <li><a href="<?php echo base_url("terms") ?>">Terms & Conditions</a></li>
                        <li><a href="<?php echo base_url("privacy") ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url("faq") ?>">FAQs</a></li>
                        <li><a href="<?php echo base_url("") ?>">Home</a></li>
                        <li><a href="<?php echo base_url("contactus") ?>">Contact us</a></li>
                        <li><a href="javascript:void(0);">Packages</a></li>
                        <li><a href="<?= base_url("service/female-strippers") ?>">Entertainment Services</a></li>
                        <li><a href="<?= base_url("service/escort-and-domination-services") ?>">Escort Service</a></li>
                        <li><a href="<?= base_url("gallery/female") ?>">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3 wow fadeInRight" data-wow-delay=".2s">
                    <h5 class="footer-modern-title">Get in touch</h5>
                    <ul class="contacts-creative">
                        <li>
                            <div class="unit unit-spacing-sm flex-column flex-md-row">
                                <div class="unit-left"><i class="fal fa-map-marker-alt"></i></div>
                                <div class="unit-body"><?=$SocialInfo['site_address'];?></div>
                            </div>
                        </li>
                        <li>
                            <div class="unit unit-spacing-sm flex-column flex-md-row">
                                <div class="unit-left"><i class="fas fa-phone"></i></div>
                                <div class="unit-body"><a href="tel:<?=$SocialInfo['site_phone']?>"><?=$SocialInfo['site_phone']?></a></div>
                            </div>
                        </li>
                        <li>
                            <div class="unit unit-spacing-sm flex-column flex-md-row">
                                <div class="unit-left"><i class="far fa-envelope"></i></div>
                                <div class="unit-body"><a href="mailto:<?=$SocialInfo['site_email']?>"><?=$SocialInfo['site_email']?></a></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline list-social-3 list-inline-sm">
                        <?php
                            if($SocialInfo['fb_link']!="")
                            {
                            ?>
                            <li>
                               <a href="<?php echo $SocialInfo['fb_link']; ?>">
                                   <i class="fab fa-facebook-f"></i>
                               </a>
                            </li>
                            <?php
                            }

                            if($SocialInfo['google_plus_link']!="")
                            {
                            ?>
                            <li>
                               <a href="<?php echo $SocialInfo['google_plus_link']; ?>">
                                   <i class="fal fa-envelope"></i>
                               </a>
                            </li>
                            <?php
                            }

                            if($SocialInfo['twitter_link']!="")
                            {
                            ?>
                            <li>
                               <a href="<?php echo $SocialInfo['twitter_link']; ?>">
                                    <i class="fab fa-twitter"></i>  
                               </a>
                            </li>
                            <?php
                            }

                            if($SocialInfo['youtube_link']!="")
                            {
                            ?>
                            <li>
                               <a href="<?php echo $SocialInfo['youtube_link']; ?>">
                                    <i class="fab fa-youtube"></i>
                               </a>
                            </li>
                            <?php
                            }

                            if($SocialInfo['instagram_link']!="")
                            {
                            ?>
                            <li>
                               <a href="<?php echo $SocialInfo['instagram_link']; ?>">
                                    <i class="fab fa-instagram"></i>
                               </a>
                            </li>
                            <?php
                            }
                            ?>
                    </ul>
                </div>
            </div>
            <div class="our-logo-footer d-md-none">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="our-website-footer">
                        <h4 class="mt-4 text-center">Our Company</h4>
                            <ul>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://www.belfaststrippers.co.uk/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Belfaststrippers</span></a>
                                    </div>
                                </li>
                                <li>    
                                    <div class="brand_logo">
                                        <a href="https://irelandstrippers.ie/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Irelandstrippers</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://irelandstrippers.com/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Irelandstrippers</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://www.nakeddrawing.co.uk/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Nakeddrawing</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://toplessbuffbutlers.com/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Toplessbuffbutlers</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://partynbus.com/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Partynbus</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="brand_logo">
                                        <a href="https://lifedrawingclasses.ie/" target="_blank"><img src="<?=FRONT_ASSETS?>images/our-website-logo.png" alt="img-porfile"><span>Lifedrawingclasses</span></a>
                                    </div>
                                </li>      
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-modern-panel">
        <div class="container-fluid">
            <p class="row align-items-center rights"> 
            
                <span class="text-left col-md-4">Develop and Design By :  <a href="mailto:akash.asodariya1@gmail.com">Akash Asodariya</a></span> 
                
                <span class="col-md-8">&copy;&nbsp; 2006 to <span class="copyright-year"><?= date("Y");?></span><span>&nbsp; | <a href="<?= base_url();?>"><?php echo $SocialInfo['pageTitle']; ?></a> | All rights reserved.</span><span>&nbsp;</span><a href="<?php echo base_url("privacy")?>">Privacy Policy</a></span>
            </p>
        </div>
		<a href="#" id="scroll"><i class="fa fa-angle-up"></i></a>
    </div>
</footer>
