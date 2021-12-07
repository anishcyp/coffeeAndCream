<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
?>
<!DOCTYPE html>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
  <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt=""></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
                <h2 class="text-transform-capitalize breadcrumbs-custom-title">Choose Service</h2>
                <h5 class="breadcrumbs-custom-text">Click on the (Button) that provides you with the services you're looking for.</h5>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li class="active">Choose Service</li>
            </ul>
        </div>
    </div>
</section>

<!-- <section class="section section-xl bg-default text-md-left register-main">
<div class="container">
  <div class="title-classic">
    <h3 class="title-classic-title">Choose Service</h3>
  </div>
  <form class="rd-form rd-mailform" id="signupForm" name="signupForm" action="<?php echo base_url('user-Updaterole');?>" method="post">
    <div class="row row-20 row-md-30">
      <div class="col-lg-12">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
        <div class="row row-20 row-md-30">
            <div class="col-md-12">
              <div class="radio-block-inner-custom">
                <div class="radio-block-inner">
                    <div class="top-block-inner">
                      <div class="top-block-inner-custom">
                        <img src="<?=FRONT_ASSETS?>images/gallery-8.jpg" alt="">
                        <h4>Entertainment</h4>
                      </div>
                      <a href="<?= base_url("user-Updaterole") ?>/1" data-id="1" id="entertainment_user" class="button button-lg button-primary button-zakaria">Choose</a>
                    </div>
                    <div class="radio-block-content">
                      <h6>Independent Advertiser <span>(Escort, Masseuse, Dominatrix)</span></h6>
                      <p>Do you want to book a meeting with an escort?<br> Create an account and find what you want more easily.</p>
                    </div>
                    <ul>
                      <li>Promote your services on a platform that gives you maximum exposure to potentialclients.</li>
                      <li>Update and manage your adverts anytime, anywhere.</li>
                      <li>Join the most flexible agency in adult entertainment</li>
                      <li>24/7 friendly customer service team</li>
                      <li>Select the membership plans that suit you</li>
                      <li>Cancel your membership anytime, anywhere.</li>
                      <li>Deactivate your account anytime, anywhere.</li>
                      <li>Select your most preferred city </li>
                    </ul>
                </div>
                <div class="radio-block-inner">
                    <div class="top-block-inner">
                      <div class="top-block-inner-custom">
                        <img src="<?=FRONT_ASSETS?>images/profile-img.jpg" alt="">
                        <h4>Escorts</h4>
                      </div>
                      <a href="<?= base_url("user-Updaterole") ?>/2" data-id="2" id="escorts_user" class="button button-lg button-primary button-zakaria">Choose</a>
                    </div>
                    <div class="radio-block-content">
                      <h6>Independent Advertiser <span>(Escort, Masseuse, Dominatrix)</span></h6>
                      <p>Promote your services to millions of viewers a month!</p>
                    </div>
                    <ul>
                      <li>Advertise your services on a platform that gives you maximum exposure to potentialclients</li>
                      <li>Select the membership plan that works best for you</li>
                      <li>Join one of the most flexible agencies in adult entertainment</li>
                      <li>Update and manage your adverts anytime, anywhere</li>
                      <li>Select as many cities as you want</li>
                      <li>24/7 friendly customer service team</li>
                      <li>Cancel your membership plan any time, anywhere.</li>
                      <li>Deactivate your plan anytime, anywhere.</li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</section> -->

<section class="section section-xl bg-default text-md-left register-main choose-service">
       
          <div class="title-classic">
            <h3 class="title-classic-title">Choose Service</h3>
          </div>
          <form class="rd-form rd-mailform" id="signupForm" name="signupForm" action="<?php echo base_url('user-Updaterole');?>" method="post">
            <div class="row row-20 row-md-30">
              <div class="col-lg-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                <div class="row row-20 row-md-30">
                    <div class="col-md-12">

                      <div class="radio-block-inner-custom row">
                        <div class="col-xl-3 col-md-6 col-sm-6 choose-box">
                          <div class="radio-block-inner">
                              <div class="top-block-inner">
                                <div class="top-block-inner-custom">
                                  <img src="<?=FRONT_ASSETS?>images/gallery-8.jpg" alt="gallery images">
                                  <h4>Entertainment  <a href="<?= base_url("user-Updaterole") ?>/1" data-id="1" id="entertainment_user" class="button button-lg button-primary button-zakaria">Choose</a></h4>
                                </div>
                               
                              </div>
                              <div class="radio-block-content">
                                <h6>Select the membership plan that works best for you</h6>
                              </div>
                              <ul>
                                <li>Join one of the most flexible agencies in adult entertainment</li>
                                <li>Update and manage your adverts anytime, anywhere</li>
                                <li>Select as many cities as you want</li>
                                <li>24/7 friendly customer service team</li>
                                <li>Cancel your membership plan any time, anywhere.</li>
                                <li>Deactivate your plan anytime, anywhere.</li>
                              </ul>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 choose-box">
                          <div class="radio-block-inner">
                              <div class="top-block-inner">
                                <div class="top-block-inner-custom">
                                  <img src="<?=FRONT_ASSETS?>images/profile-img.jpg" alt="profile-img">
                                  <h4>Escorts   <a href="<?= base_url("user-Updaterole") ?>/2" data-id="2" id="escorts_user" class="button button-lg button-primary button-zakaria">Choose</a></h4>
                                </div>
                               
                              </div>
                              <div class="radio-block-content">
                                <h6>Update and manage your adverts anytime, anywhere.</h6>
                              </div>
                              <ul>
                                <li>Join the most flexible agency in adult entertainment</li>
                                <li>24/7 friendly customer service team</li>
                                <li>Select the membership plans that suit you</li>
                                <li>Cancel your membership anytime, anywhere.</li>
                                <li>Deactivate your account anytime, anywhere.</li>
                                <li>Select your most preferred city </li>
                              </ul>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 choose-box">
                          <div class="radio-block-inner">
                              <div class="top-block-inner">
                                <div class="top-block-inner-custom">
                                  <img src="<?=FRONT_ASSETS?>images/agency.jpg" alt="profile-img">
                                  <h4>Agency   <a href="<?= base_url("user-Updaterole") ?>/4" data-id="4" id="escorts_user" class="button button-lg button-primary button-zakaria">Choose</a></h4>
                                </div>
                               
                              </div>
                              <div class="radio-block-content">
                                <h6>Get optimal exposure for your business on the industry traffic leader’s website.</h6>
                              </div>
                              <ul>
                                <li>Promote your agency with a business advert.</li>
                                <li>Add multiple Entertainment & escort adverts and manage them as you please.</li>
                                <li>Enjoy our multilingual customer service team.</li>
                              </ul>
                          </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 choose-box">
                          <div class="radio-block-inner">
                              <div class="top-block-inner">
                                <div class="top-block-inner-custom">
                                  <img src="<?=FRONT_ASSETS?>images/hen_stag.jpg" alt="profile-img">
                                  <h4>ACCOMMODATION  <a href="<?= base_url("user-Updaterole") ?>/5" data-id="5" id="escorts_user" class="button button-lg button-primary button-zakaria">Choose</a></h4>
                                </div>
                               
                              </div>
                              <div class="radio-block-content">
                                <h6>Get optimal exposure for your business on the industry traffic leader’s website.</h6>
                              </div>
                              <ul>
                                <li>Promote your agency with a business advert.</li>
                                <li>Add multiple Entertainment & escort adverts and manage them as you please.</li>
                                <li>Enjoy our multilingual customer service team.</li>
                              </ul>
                          </div>
                        </div>

                        <input type="hidden" name="user_role" id="user_role">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="btn-group-main">
                <button class="button button-lg button-primary button-zakaria" type="submit">Submit</button>
                </div> -->
              </form>
           
        </section>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

</body>
</html>