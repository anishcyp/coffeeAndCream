<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
    <meta name="description" content="Coffee n Cream is committed and dedicated to bringing you quality entertainment from some of the best entertainers you will find anywhere else in Europe.">
    
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="Best Entertainers Provider Agency - Stripper Party Bus" />
    <meta property="og:description" content="Coffee n Cream is committed and dedicated to bringing you quality entertainment from some of the best entertainers you will find anywhere else in Europe." />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

    <meta name="twitter:title" content="Best Entertainers Provider Agency - Stripper Party Bus" />
    <meta name="twitter:description" content="Coffee n Cream is committed and dedicated to bringing you quality entertainment from some of the best entertainers you will find anywhere else in Europe." />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>    
</head>


    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        <section class="breadcrumbs-custom">
            <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
                <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                    <div class="container">
                        <h1 class="text-transform-capitalize breadcrumbs-custom-title">About us</h1>
                        <h5 class="breadcrumbs-custom-text"> </h5>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section class="section section-xxl bg-default text-md-left terms-main-main">
        <div class="container">
          <div class="row">
          
            <div class="col-lg-12 col-xl-12">
            <div class="section-title-dark  mb-20">
                    <h3 class="text-left"><b><?= $result['title'] ?></b></h3>
            </div>
              <!-- Terms list-->
              <dl class="list-terms list-terms-1">
              <?= $result['descr'] ?>
            </div>
          </div>
        </div>
      </section>

       
        </div>
        <?php $this->load->view(FRONTEND."include/footer"); ?>
        <?php $this->load->view(FRONTEND."include/include_js"); ?>
        <script type="text/javascript">
        $(document).ready(function(){
            $("#contactus-form").validate({
                 ignore: [],
                 rules: {
                    department:{required : true},
                    name:{required : true},
                    email:{required : true,email:true},
                    phone:{required : true,number:true},
                    message:{required : true},
                 },
                 messages: {
                    department:{required:"Please select department."},
                    email:{required:"Please enter email.",email:"Please enter valid email address."},
                    name:{required:"Please enter name."},
                    phone:{required:"Please enter phone number.",number:"Please enter valid phone number."},
                    message:{required:"Please enter message."},
                 }, 
                
              });
           });
        </script>
    </body>
</html>