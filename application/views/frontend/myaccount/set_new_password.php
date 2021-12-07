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
            <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <h2 class="text-transform-capitalize breadcrumbs-custom-title">Set New Password</h2>
                    <h5 class="breadcrumbs-custom-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius
                        mod tempor incididunt ut labore et dolore magna aliqua.
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li class="active">Set New Password</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section section-xl bg-default text-md-left">
        <div class="container">
            <div class="title-classic">
                <h3 class="title-classic-title">Set New Password</h3>
            </div>
            <form class="rd-form rd-mailform" id="frm" name="frm" method="post" action="<?= base_url("reset/".$token) ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>">
                <div class="row row-20 row-md-30">
                    <div class="col-lg-12">

                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

                        <div class="row row-20 row-md-30">
                            <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" type="password" id="password" name="password">
                                    <label class="form-label rd-input-label" for="password">Password</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-wrap">
                                    <input class="form-input" type="password" id="confirm_password" name="confirm_password">
                                    <label class="form-label rd-input-label" for="confirm_password">Confirm Password</label>
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
        rules:{                           
            password : { required : true},
            confirm_password:{required : true,equalTo: "#password"},
        },
        messages:{
            password :{ required : "New password is required" },
            confirm_password:{
                required:"Confirm password is required",
                equalTo:"Confirm password is not match."
            },
        }
    });
});
</script>
</body>
</html>