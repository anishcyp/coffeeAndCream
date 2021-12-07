<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$SocialInfo = FrontSiteInfo(); 
$onpage_record      = 28;
$location_onpage_record = 8;
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
<link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
<meta name="description" content="<?= $description ?>">

<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />

<meta property="og:title" content="<?= $pageTitle ?>" />
<meta property="og:description" content="<?= $description ?>" />
<meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

<meta property="og:site_name" content="Coffee & Strippers" />
<meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:width" content="1457" />
<meta property="og:image:height" content="461" />

<meta name="twitter:card" content="<?=FRONT_ASSETS?>images/banner-img.jpg"/>
<meta name="twitter:image" content="<?=FRONT_ASSETS?>images/banner-img.jpg"/>

<meta name="twitter:title" content="<?= $pageTitle ?>" />
<meta name="twitter:description" content="<?= $description ?>" />

<?php $this->load->view(FRONTEND."include/include_css"); ?>

</head>
<body class="">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
  
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="parallax material"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark">
            <div class="container">
                <div class="directory-listing-form">
                    <h1><?=$pageTitle;?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?=base_url();?>">Home</a></li>
                <li class="active">Categories-<?=$pageTitle;?></li>
            </ul>
        </div>
    </div>
</section>

<!-- Category -->
 
<section class="post-ads-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 section-header">
				<h3>Recent Job</h3>
			</div>
		</div>
		<div class="row mt-0">
        <?php
            if(is_array($posts))
            {
                foreach ($posts as $post) 
                {
                    $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post->country_id."'");

                    $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post->state_id."'");
        
                    $image_path     = $post->image;
                    $prd_exist = UPLOAD_DIR.POST_IMG.$image_path;

                    if(file_exists($prd_exist) && $image_path!="") 
                    {
                        $prd_preview = base_url().UPLOAD_DIR.POST_IMG.$image_path;
                    } 
                    else 
                    {
                        $prd_preview = base_url().UPLOAD_DIR.'default.png';
                    }
                        $str = strtolower($post->slug);

                        $details_url  = base_url()."post-and-ads/details/".$str."/";                    
                    ?>
                    <div class="col-md-4 col-lg-3 col-sm-6 post-adsbox">
            <div class="adsbox-inner">
				<div class="post-image">
					<div class="image-inner">
						<a href="<?= $details_url ?>">
                            <img src="<?= $prd_preview ?>">
                            <span>click to see</span>
                            <h4 style="font-size: unset;text-transform: capitalize;"><?= $state_name.': '.$post->title ?></h4>
                        </a>
					</div>
				</div>
            </div>
        </div>
                    <?php
                }
            }
            ?>
		</div>
	</div>
</section>

<!-- End Category --> 

<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>

<?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>      
</html>
</body>
</html>
   