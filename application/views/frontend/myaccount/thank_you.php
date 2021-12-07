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

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Thank you</h2>
              <h5 class="breadcrumbs-custom-text"> Thank you </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('profile-info') ?>">Acount</a></li>
              <li class="active">Thank you</li>
            </ul>
          </div>
        </div>
      </section>
       <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
               <div class="common-blocks-detail">
                 <h4></h4>
                   <div class="jumbotron text-center">
                  <h1 class="display-3">Thank You!</h1>
                  <p class="lead"><strong>Please check your email</strong>  successfull membership .</p>
                  <hr>
                  <?php 

                  $uid = $this->session->userdata('front_UserId');
                  $where = array('uid' => $uid,'status'=>1 );
       
                  $details = $this->crud->get_one_row("purchase_plan",$where );

                  if($details['plan_nickname'] != 'escorts')
                  {
                    $strippers = 'escorts';
                    $details_url  = base_url()."plan/".$strippers."/";
                  ?>
                  <p>
                    Coffee & Strippers provide other escorts services <a href="<?= $details_url ?>" target="_blank">Click Here</a>
                  </p>
                  <?php
                  }
                  else if($details['plan_nickname'] != 'strippers')
                  {
                    $strippers = 'strippers';
                    $details_url  = base_url()."plan/".$strippers."/";
                  ?>
                  <p>
                    Coffee & Strippers provide other strippers services <a href="<?= $details_url ?>" target="_blank">Click Here</a>
                  </p>
                  <?php
                  }
                  ?>
                  <p class="lead">
                    <a class="btn btn-primary btn-sm" href="<?= base_url('profile-info') ?>" role="button">Continue to my account</a>
                  </p>
                </div>
               </div>
            </div>
          </div>
      </div>
    </div>
<!-- Call rates End Here -->
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>
</html>