<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <link rel="canonical" href="<?= base_url('faq') ?>" />

  <meta name="description" content="If you have any questions regard our serving locations area or service which we offer, kindly refer to our FAQs guide. You will get your all answers from our FAQ guide.">
    
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />

  <meta property="og:title" content="<?= $pageTitle ?>" />
  <meta property="og:description" content="If you have any questions regard our serving locations area or service which we offer, kindly refer to our FAQs guide. You will get your all answers from our FAQ guide." />
  <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

  <meta property="og:site_name" content="Coffee & Strippers" />
  <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:width" content="1457" />
  <meta property="og:image:height" content="461" />

  <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
  <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

  <meta name="twitter:title" content="<?= $pageTitle ?>" />
  <meta name="twitter:description" content="If you have any questions regard our serving locations area or service which we offer, kindly refer to our FAQs guide. You will get your all answers from our FAQ guide." />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>

</head>


<body>
    <?php $this->load->view(FRONTEND."include/menu"); ?>

     <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h1 class="text-transform-capitalize breadcrumbs-custom-title">FAQ's</h1>
              <h5 class="breadcrumbs-custom-text">
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Faq</li>
            </ul>
          </div>
        </div>
      </section>


       <section class="section section-sm section-last bg-default">
        <div class="container">
          <!-- Bootstrap collapse-->
          <div class="card-group-custom card-group-corporate" id="accordion1" role="tablist" aria-multiselectable="false">
            <div class="row">
              <?php foreach ($result as $value) {  ?>
              <div class="col-lg-6">
                <!-- Bootstrap card-->
                <article class="card card-custom card-corporate">
                  <div class="card-header" role="tab">
                    <div class="card-title">
                       <h3><?= $value['title'] ?></h3>
                    <a id="accordion1-card-head-<?= $value['id'] ?>" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-card-body-<?= $value['id'] ?>" aria-controls="accordion1-card-body-<?= $value['id'] ?>" aria-expanded="true" role="button" class="">
                      <?= $value['question'] ?>
                        <div class="card-arrow">
                          <div class="icon"><i class="far fa-chevron-down"></i></div>
                        </div></a></div>
                  </div>
                  <div class="collapse" id="accordion1-card-body-<?= $value['id'] ?>" aria-labelledby="accordion1-card-head-<?= $value['id'] ?>" data-parent="#accordion1" role="tabpanel" style="">
                    <div class="card-body">
                      <?= $value['descr'] ?>
                    </div>
                  </div>
                </article>
              </div>
              <?php } ?>
              
            </div>
          </div>
        </div>
      </section>
      
      </div>




<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

</body>
</html>