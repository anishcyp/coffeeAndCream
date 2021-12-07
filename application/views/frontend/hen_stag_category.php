<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();

	if($name == "day")
	{
		$act = $city_name." All Daytime's Activities";
	}
	else if($name == "evening")
	{
		$act = $city_name." All Evening Activities";
	}
	else if($name == "accommodation")
	{
		$act = $city_name." All Hotels";
	}
	else if($name == "transfer")
	{
		$act = $city_name." All Air transport's";
	}
	
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?>    
</head>
<body class="">
<?php $this->load->view(FRONTEND."include/menu"); ?>
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/most-beuti.jpg">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/most-beuti.jpg" alt="contact-banner"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
                <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 50px;">Hen Stag Accommodation</h1>
                <h5 class="breadcrumbs-custom-text text-effect-contact">
                    Hen Stag Accommodation
                </h5>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?= base_url('') ?>">Home</a></li>
				<li><a href="<?= base_url('hen-stag-accommodation') ?>">Hen stag accommodation</a></li>
                <li class="active"><?= $act ?></li>
            </ul>
        </div>
    </div>
</section>

<section class="activitie-section all-activitie">
	<div class="section-header">
		<h2><?= $act ?></h2>
	</div>
	<div class="row">
		<?php 
		foreach($stag as $stags)
		{
			$str = $stags->slug;
        	$details_url  = base_url()."hen-stag-accommodation/details/".$location_slug."/".$str."/";
			$image_path     = $stags->profile_image;

			$prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

			if(file_exists($prd_exist) && $image_path!="") 
			{
				$prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
			} 
			else 
			{
				$prd_preview = base_url().UPLOAD_DIR.'default.png';
			}
		?>
		<div class="slider-item col-xl-2 col-lg-3 col-md-3 col-sm-4 col-4">
			<div class="inner-content" style="background-image:url(<?= $prd_preview ?>);">
				<a href="<?= $details_url ?>">
				    <div class="hover-btn"><span>click to see</span></div>
					<div class="item-content">
						<h4><?= $stags->compnay_name ?></h4>
						<div class="star-count">
							<span>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</span>
							<p><?= $stags->review ?> Reviews</p>
						</div>
						<div class="bottom-content">
							<h6><?= $stags->compnay_name ?></h6>
						</div>
					</div>
				</a>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</section>

<div class="modal fade daytime-model" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
			<div class="isotope-wrap custom-tab">
				<div class="modal-header p-0">
					<div class="isotope-filters">
						<div class="isotope-filters-list-wrap">
							<ul class="isotope-filters">
								<li><a class="active" href="#" data-isotope-filter="*">All</a></li>
								<li><a href="#" data-isotope-filter="Type 1">UK</a></li>
								<li><a href="#" data-isotope-filter="Type 2">US</a></li>
							</ul>
						</div>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="model-content">
					<div class="row ml-0 isotope d-flex isotope-custom-1" data-lightgallery="group" id="resultList">
						<div class="isotope-item" data-filter="Type 1">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="isotope-item" data-filter="Type 2">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="isotope-item" data-filter="Type 2">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="isotope-item" data-filter="Type 2">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="isotope-item" data-filter="Type 2">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="isotope-item" data-filter="Type 2">
							<div class="list-box">
								<div class="inner-box">
									<a href="#">
										<div class="list-content">
											<div class="image-box">
												<img src="<?=FRONT_ASSETS?>images/sample.jpg">
											</div>
											<div class="box-content">
												<h5>Albufeira</h5>
												<p>Portugal</p>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
                        
						
					</div>
				</div>
			</div>
    	</div>
  	</div>
</div>


<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script type="text/javascript">
	$(document).on("ready", function() {
		$( "#datepicker" ).datepicker({ 
   			minDate: "+7"
		});
		$( "#start_date" ).datepicker();
	});
	
	$(".package-box .show-more a").on("click", function() {
		$(".package-box .hide-show-content").toggleClass("active");
		$(".package-box .inner-content .image-box").toggleClass("hide");
		$(".package-box .inner-content .box-content").toggleClass("hide");
	});
	$(".hide-show-content .more-content").on("click", function() {
		$(".package-box .hide-show-content").removeClass("active");
		$(".package-box .inner-content .image-box").removeClass("hide");
		$(".package-box .inner-content .box-content").removeClass("hide");
	});
	
	$(".more-data.remove-day a").on("click", function() {
		$(".package-box .content-box").remove();
	});
	
	var height	=	$(".package-box .content-box").height();
	
	$(".package-box .content-box .hide-show-content").css('height',height);
	
	$(".activitie-section .slider-item").on("click touchend", function(e) {
    	var el = $(this);
    });

</script>