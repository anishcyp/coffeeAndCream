<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
  <meta name="description" content="See the video gallery of our entertainer party videos. Get in touch with us to enjoy for same!">
    
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />

  <meta property="og:title" content="Party Video | Stripper Life | Hen & Stag do Video | Stripper Party Bus" />
  <meta property="og:description" content="See the video gallery of our entertainer party videos. Get in touch with us to enjoy for same!" />
  <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

  <meta property="og:site_name" content="Coffee & Strippers" />
  <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:width" content="1457" />
  <meta property="og:image:height" content="461" />

  <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
  <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

  <meta name="twitter:title" content="Party Video | Stripper Life | Hen & Stag do Video | Stripper Party Bus " />
  <meta name="twitter:description" content="See the video gallery of our entertainer party videos. Get in touch with us to enjoy for same!" />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
</head>
<body>
    <?php $this->load->view(FRONTEND."include/menu"); ?>

<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
    <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
      <div class="container">
        <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 60px;"><?= $pageTitle ?></h1>
        <h5 class="breadcrumbs-custom-text">
        </h5>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="<?= base_url('') ?>">Home</a></li>
        <li class="active"><?= $pageTitle ?></li>
      </ul>
    </div>
  </div>
</section>


<section class="section section-sm section-last bg-default">
  <div class="container">
    <div class="card-group-custom card-group-corporate" id="accordion1" role="tablist" aria-multiselectable="false">
    <div class="row">

      <?php foreach($videos as $video) {
        $description  = $this->crud->limit_character($video->description,90);
      ?>
      <div class="col-lg-4">
        <div class="video-inner">
            
            <div class="embed-responsive embed-responsive-16by9">
                	<iframe class="embed-responsive-item" src="<?= base_url().UPLOAD_DIR.VIDEO.$video->video_path; ?>?autostart=false" sandbox  allowfullscreen></iframe>
            </div>
            
          <div class="video-content">
              <h5><?= $video->title ?></h5>
              <p><?= strip_tags($description) ?></p>
            </div>
        </div>
      </div>
      <?php } ?>
    </div>
    </div>
  </div>
</section>




<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
  $(document).ready(function() {
    $('.popup-video').magnificPopup({
      disableOn: 320,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      gallery:{
        enabled:true
      },

    });
  });
</script>
</body>
</html>