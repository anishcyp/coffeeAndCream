<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
?>
<!DOCTYPE html>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
  <link rel="canonical" href="<?= base_url('forgot-password') ?>" />

  <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact banner"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title">Forgot Password</h1>
                    <h5 class="breadcrumbs-custom-text">
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li class="active">Forgot Password</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section section-xl bg-default text-md-left">
        <div class="container">
            <div class="title-classic">
                <h3 class="title-classic-title">Forgot Password</h3>
                <p class="title-classic-subtitle">Enter your email address below and we'll send you a link to reset your password.</p>
            </div>
            <form class="rd-form rd-mailform" id="frm" name="frm" method="post" action="<?= base_url("forgot-password-send") ?>">
                <div class="row row-20 row-md-30">
                    <div class="col-lg-12">

                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

                        <div class="row row-20 row-md-30">
                            <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" type="email" id="email" name="email">
                                    <label class="form-label rd-input-label" for="email">Enter Email address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="button button-lg button-primary button-zakaria" type="submit">Submit</button>
            </form>
        </div>
    </section>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script>

$(document).ready(function(){
  $("#frm").validate({
     ignore: [],
     rules: {              
        email:{required : true,email:true},
     },
     messages: {
        email : { required:"Please enter email address.",email : "Please enter your valid email address." },
     }, 
     errorPlacement: function(error, element) {
        error.insertAfter(element);            
     }
  });
});

</script>

</body>
</html>