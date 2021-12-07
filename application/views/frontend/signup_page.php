<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
?>
<!DOCTYPE html>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
  <link rel="canonical" href="<?= base_url('SignUp') ?>" />
  <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact banner"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
                <h1 class="text-transform-capitalize breadcrumbs-custom-title">Register</h1>
                <h5 class="breadcrumbs-custom-text">Sign up to connect with entertainers, escorts and clients all over the United Kingdom and Europe. By signing up, you agree to our terms and conditions, data policy and cookies policy.
                </h5>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li class="active">Register</li>
            </ul>
        </div>
    </div>
</section>
<section class="section section-xl bg-default text-md-left register-main">
    <div class="container">
      <div class="title-classic">
        <h3 class="title-classic-title">Register From Here</h3>
        <p class="title-classic-subtitle">Enter your credential to get access</p>
      </div>
      <div class="title-classic mt-2">
        <h4><?= $service_name ?></h4>
      </div>
      <form class="rd-form rd-mailform" id="signupForm" name="signupForm" action="<?php echo base_url('register');?>" method="post">
        <div class="row ">
          <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            <div class="row row-20 row-md-30">
                <div class="col-md-12">
                  <div class="radio-block-inner-custom">
                    <!-- <div class="radio-block-inner">
                        <div class="top-block-inner">
                          <div class="top-block-inner-custom">
                            <img src="<?=FRONT_ASSETS?>images/gallery-8.jpg" alt="">
                            <h4>Entertainment</h4>
                          </div>
                          <a href="javascript:void(0);" data-id="1" id="entertainment_user" class="button button-lg button-primary button-zakaria">Choose</a>
                        </div>
                        <div class="radio-block-content">
                          <h6>Independent Advertiser <span>(Escort, Masseuse, Dominatrix)</span></h6>
                          <p>Do you want to book a meeting with an escort?<br> Create an account and find what you want more easily.</p>
                        </div>
                        <ul>
                          <li>Enjoy our multilingual customer service team.</li>
                          <li>Join the biggest adult community in Ireland.</li>
                          <li>Manage your advert easily, at any time of any day.</li>
                          <li>Boost you advert to boost your business!</li>
                        </ul>
                    </div> -->
                    <!-- <div class="radio-block-inner">
                        <div class="top-block-inner">
                          <div class="top-block-inner-custom">
                            <img src="<?=FRONT_ASSETS?>images/profile-img.jpg" alt="">
                            <h4>Escorts</h4>
                          </div>
                          <a href="javascript:void(0);" data-id="2" id="escorts_user" class="button button-lg button-primary button-zakaria">Choose</a>
                        </div>
                        <div class="radio-block-content">
                          <h6>Independent Advertiser <span>(Escort, Masseuse, Dominatrix)</span></h6>
                          <p>Promote your services to millions of viewers a month!</p>
                        </div>
                        <ul>
                          <li>Enjoy our multilingual customer service team.</li>
                          <li>Join the biggest adult community in Ireland.</li>
                          <li>Manage your advert easily, at any time of any day.</li>
                          <li>Boost you advert to boost your business!</li>
                        </ul>
                    </div> -->
                    <!-- Hide Ancency -->
                    <!-- <div class="radio-block-inner">
                        <div class="top-block-inner">
                          <div class="top-block-inner-custom">
                            <img src="<?=FRONT_ASSETS?>images/profile-img.jpg" alt="">
                            <h4>Escort</h4>
                          </div>
                          <a href="javascript:void(0);" data-id="3" id="punter_user" class="button button-lg button-primary button-zakaria">Choose</a>
                        </div>
                        <div class="radio-block-content">
                          <h6>Independent Advertiser <span>(Escort, Masseuse, Dominatrix)</span></h6>
                          <p>Promote your services to millions of viewers a month!</p>
                        </div>
                        <ul>
                          <li>Enjoy our multilingual customer service team.</li>
                          <li>Join the biggest adult community in Ireland.</li>
                          <li>Manage your advert easily, at any time of any day.</li>
                          <li>Boost you advert to boost your business!</li>
                        </ul>
                    </div> -->
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-wrap">
                        <input class="form-input" id="user_role" type="hidden" name="user_role" value="<?= $user_role ?>">
                        <input class="form-input" id="email" type="email" name="email">
                        <label class="form-label rd-input-label" for="email">Enter Email Address</label>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-wrap">
                    <input class="form-input" id="password" type="password" name="password">
                    <label class="form-label rd-input-label" for="password">Password</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-wrap">
                    <input class="form-input" id="cpassword" type="password" name="cpassword">
                    <label class="form-label rd-input-label" for="cpassword">Confirm Password</label>
                  </div>
                </div>
                <div class="col-sm-6">
                <ul class="list-shop-filter">
                  <li>
                    <div class="checkbox-custom">
                          <label class="common-checkbox">
                          I have read the <a href="#">agreement</a>
                        <input type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                        <span class="checkmark"></span>
                      </label>
                  </div>
                  </li>
                </ul>
              </div>
              <div class="col-sm-8">
                    <div class="heading-3 text-transform-capitalize quote-classic-big-text login-text">
                        <div class="q">
                            Already have an account? <a href="<?php echo base_url("SignIn")?>"> Login</a>
                    </div>
                </div>
            </div>
          </div>
        <div class="btn-group-main">
            <button class="button button-lg button-primary button-zakaria" type="submit">Sign Up Now</button>
            <!-- <a href="javascript:;" onclick="loginwith_fb()" class="btn-social"><img src="<?php echo base_url().UPLOAD_DIR.'continue-with-fb.png';?>"></a>
            <a href="javascript:;" onclick="loginwith_gmail()" id="customBtn" class="btn-social"><img src="<?php echo base_url().UPLOAD_DIR.'google-sign-in-btn.png';?>"></a> -->
            <a href="javascript:;" onclick="loginwith_fb()" class="button button-lg button-primary button-zakaria btn-facebook mt-0"> <span>
                       <i class="fab fa-facebook-square"></i> <span>Continue with facebook</span></span>
                   </a> 
                   <a href="javascript:;" onclick="loginwith_gmail()" id="customBtn" class="button button-lg button-primary button-zakaria btn-facebook mt-0 btn-google"> <span>
                   <i class="fab fa-google"></i> <span>Sign in with Google</span></span>
                   </a> 
        </div>
      </form>
    </div>
</section>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script>

$( document ).ready(function() {
    $(".role_type").hide();
});

$("#entertainment_user").on("click", function(event) {
  id = $(this).attr("data-id");
  $("#user_role").val(id);
  $(".role_type").show();
})

$("#escorts_user").on("click", function(event) {
  id = $(this).attr("data-id");
  $("#user_role").val(id);
  $(".role_type").show();
})

/*$("#punter_user").on("click", function(event) {
  id = $(this).attr("data-id");
  $("#user_role").val(id);
})
*/
$('#signupForm').validate({ 
    rules:{
        email :{ required : true, email:true },
        password :{ required : true },
        cpassword:{required : true,equalTo: "#password"},
        agreement :{required : true},
    },
    messages:{
        email :{ required : "Email address is required" },
        password :{ required : "Password is required" },
        cpassword:{required:"Please enter confirm password.", equalTo:"Password and confirm password not matched."},
        agreement :{ required : "You must agree to the terms and conditions before submitting the details." },
    },
    errorPlacement: function (error, element) 
    {
        if (element.attr('name') == 'agreement')
        {
            error.insertAfter("#agreement_err");
        }
        else 
        {
            error.insertAfter(element);
        }
    }
});
</script>
</body>
</html>