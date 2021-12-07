<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
?>
<!DOCTYPE html>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
  <link rel="canonical" href="<?= base_url('SignIn') ?>" />
  <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="banner parallax"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title">Login</h1>
                    <h5 class="breadcrumbs-custom-text">Manage your account, Check notifications, stay in touch with clients and more. Enter your credentials to gain access and stay updated.
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section section-xl bg-default text-md-left">
        <div class="container">
            <div class="title-classic">
                <h3 class="title-classic-title">Login From Here</h3>
                <p class="title-classic-subtitle">Enter your credential to get access</p>
            </div>
            <form class="rd-form rd-mailform" id="loginForm" name="loginForm" action="<?php echo base_url('login');?>" method="post">
                <div class="row row-20 row-md-30">
                    <div class="col-lg-12">

                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

                        <div class="row row-20 row-md-30">
                            <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" type="email" id="lemail" name="lemail">
                                    <label class="form-label rd-input-label" for="lemail">Enter Email address</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" type="password" id="lpassword" name="lpassword">
                                    <label class="form-label rd-input-label" for="lpassword">Password</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                               <div class="row">
                                <div class="col-sm-6">
                                    <div class="heading-3 text-transform-capitalize quote-classic-big-text login-text">
                                        <div class="q">
                                            New to Coffee n Cream? <a href="<?php echo base_url("choose-user")?>"> Signup</a><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="heading-3 text-transform-capitalize quote-classic-big-text login-text">
                                        <div class="q">
                                            <a href="<?=base_url('forgot-password');?>"> Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                                    <!-- OR 

                                    <a href="javascript:;" onclick="loginwith_fb()" class="btn-facebook"><img class="w-50" src="<?php echo base_url().UPLOAD_DIR.'continue-with-fb.png';?>"></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group-main">
                   <button class="button button-lg button-primary button-zakaria" type="submit">Login Now</button>
                   <!-- <button class="button button-lg button-primary button-zakaria btn-facebook" type="submit"><i class="fab fa-facebook-f mr-2"></i> Login With Facebook</button> -->
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

$('#loginForm').validate({ 
        rules:{            
            lemail :{ required : true, email:true },
            lpassword :{ required : true },
        },
        messages:{
            lemail :{ required : "Email is required" },
            lpassword :{ required : "Password is required" },
        }
    });

</script>

</body>
</html>
