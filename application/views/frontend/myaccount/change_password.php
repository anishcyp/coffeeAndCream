<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
    
   <!-- Profile Start Here -->
   <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Change Password</h2>
              <h5 class="breadcrumbs-custom-text">FEEL FREE TO CHANGE YOUR PASSWORD TO KEEP YOUR ACCOUNT  SAFE AND DONT FORGET TO PRESS SAVE
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Change Password</li>
            </ul>
          </div>
        </div>
      </section>
      
       <section class="diary-list">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Change password:</h3>
                    <ul>
                        <li>Feel free to change your password to keep your account safe.</li>
                        <li>Remember to save before moving to the next step.</li>
                    </ul>
                </div>
            </div>
          </div>
        </section>
      
      <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
               <div class="common-blocks-detail">
                 <h4>Change Password</h4>
                  <form id="login-page-form" method="post" action="<?= base_url("update-password/"); ?>">
                    <div class="blocks-information">
                      <div class="form-group">
                        <label class="form-label-custom">Old Password</label>
                        <input type="password" id="currant_password" name="currant_password"  class="form-control" placeholder="Enter Old Password">
                     </div>
                     <div class="form-group">
                      <label class="form-label-custom">New Password</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password">
                   </div>
                   <div class="form-group">
                      <label class="form-label-custom">Confirm Password</label>
                      <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password">
                   </div>
                    <button type="submit" name="submit" id="submit" value="submit" class="button button-lg button-shadow-2 button-primary button-zakaria">Change Password</button>
                   </div>
                      
                     
                  </form>
               </div>
            </div>
          </div>
      </div>

    </div>

   <!-- profile End Here -->

<!-- footer -->
        <?php $this->load->view(FRONTEND."include/footer"); ?>
         <?php $this->load->view(FRONTEND."include/include_js"); ?>
<script type="text/javascript">
   $(document).ready(function(){
      $("#login-page-form").validate({
         ignore: [],
         rules: {              
            currant_password:{required : true},
            password:{required : true},
            confirm_password:{required : true,equalTo: "#password"},
         },
         messages: {
            currant_password : { required:"Please enter Old Password" },
            password : { required:"Please enter New Password" },
            confirm_password : { required:"Please enter New Password" },                        
         }, 
         errorPlacement: function(error, element) {
            error.insertAfter(element);            
         }
      });
   });
</script>
</body>
</html>
