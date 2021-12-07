<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>

  <section class="breadcrumbs-custom">
      <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt=""></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
          <div class="container">
            <h2 class="text-transform-capitalize breadcrumbs-custom-title"><?= $pageTitle ?></h2>
          </div>
        </div>
      </div>
      <div class="breadcrumbs-custom-footer">
        <div class="container">
          <ul class="breadcrumbs-custom-path">
            <li><a href="index.html">Home</a></li>
            <li class="active"><?= $pageTitle ?></li>
          </ul>
        </div>
      </div>
    </section>

    <section class="section bg-default mb-5 mt-5 p-0">
      <div class="container">
        <div class="row row-40 row-md-60 justify-content-center">
          <div class="col-md-12 col-lg-12 col-xl-12">
            <p>
              <?= $language['description'] ?>
            </p>
          </div>
        </div>
      </div>
    </section>
    
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

