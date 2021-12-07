<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
        <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />

  <meta name="description" content="Coffee and Cream is committed to maintaining the privacy of our member's personal information under the UK Privacy Principles. This site is specifically designed for persons who are 18 years of age or older.">
    
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />

  <meta property="og:title" content="<?= $pageTitle ?>" />
  <meta property="og:description" content="Coffee and Cream is committed to maintaining the privacy of our member's personal information under the UK Privacy Principles. This site is specifically designed for persons who are 18 years of age or older." />
  <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

  <meta property="og:site_name" content="Coffee & Strippers" />
  <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:width" content="1457" />
  <meta property="og:image:height" content="461" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="Logo or Banner Image" />

  <meta name="twitter:title" content="Meta Title" />
  <meta name="twitter:description" content="Meta Description" />


  <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>


<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
      <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
        <div class="container">
          <h1 class="text-transform-capitalize breadcrumbs-custom-title">Privacy & Policies</h1>
          <h5 class="breadcrumbs-custom-text">
          </h5>
        </div>
      </div>
    </div>
    <div class="breadcrumbs-custom-footer">
      <div class="container">
        <ul class="breadcrumbs-custom-path">
          <li><a href="<?= base_url('') ?>">Home</a></li>
          <li class="active">Privacy & Policies</li>
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
      
    
        

<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>      
</html>