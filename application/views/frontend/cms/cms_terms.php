<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
   <link rel="canonical" href="<?= base_url('terms') ?>" />

   <meta name="description" content="Terms and conditions for use of the Coffee and Cream website. This page also contains our Terms and Conditions – please read carefully and check frequently for updates.">
    
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />

  <meta property="og:title" content="<?= $pageTitle ?>" />
  <meta property="og:description" content="Terms and conditions for use of the Coffee and Cream website. This page also contains our Terms and Conditions – please read carefully and check frequently for updates." />
  <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

  <meta property="og:site_name" content="Coffee & Strippers" />
  <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:width" content="1457" />
  <meta property="og:image:height" content="461" />

  <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
  <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

  <meta name="twitter:title" content="<?= $pageTitle ?>" />
  <meta name="twitter:description" content="Terms and conditions for use of the Coffee and Cream website. This page also contains our Terms and Conditions – please read carefully and check frequently for updates." />

  <?php $this->load->view(FRONTEND."include/include_css"); ?>

</head>

<body>
  <?php $this->load->view(FRONTEND."include/menu"); ?>
        
      <section class="breadcrumbs-custom">
      <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="material parallax"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
          <div class="container">
            <h1 class="text-transform-capitalize breadcrumbs-custom-title">Terms And Conditions</h1>
            <h5 class="breadcrumbs-custom-text">
            </h5>
          </div>
        </div>
      </div>
      <div class="breadcrumbs-custom-footer">
        <div class="container">
          <ul class="breadcrumbs-custom-path">
            <li><a href="<?= base_url('') ?>">Home</a></li>
            <li class="active">Terms And Conditions</li>
          </ul>
        </div>
      </div>
    </section>
      
    <section class="terms-section">
        <div class="container">
        	<div class="accordion terms-text" id="accordion-terms">
				<?php 
				foreach ($result as $results)
				{
				?>
        		<div class="card">
        			<div class="card-header" id="heading-<?= $results->id ?>">
        				<h2 class="mb-0">
        					<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?= $results->id ?>" aria-expanded="true" aria-controls="collapse-<?= $results->id ?>">
        						<?= $results->title ?>
        					</button>
        				</h2>
        			</div>
        			<div id="collapse-<?= $results->id ?>" class="collapse collapsed" aria-labelledby="heading-<?= $results->id ?>" data-parent="#accordion-terms">
        				<div class="card-body">
        					<?= $results->descr ?>
        				</div>
        			</div>
        		</div>
        		<?php
				}
				?>
        		
        	</div>
        </div>
    </section>
        
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

</body>      
</html>