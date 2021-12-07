<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?> 
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/beach_resort.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/beach_resort.jpg" alt="contact-banner"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 50px;"><?= $pageTitle ?> Details</h1>
                    <h5 class="breadcrumbs-custom-text text-effect-contact">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?= base_url('') ?>">Home</a></li>
					<li><a href="<?= base_url('hen-stag-accommodation') ?>">Hen stag accommodation</a></li>
                    <li class="active"><?= $pageTitle ?></li>
                </ul>
            </div>
        </div>
    </section>
	
	<section class="accommodation-details">
		<div class="service-include" style="background-image: url(../../../../<?php echo UPLOAD_DIR.USER_PROFILE_IMG.$user_d['profile_image'] ?>);">
			<div class="service-content">
				<div class="review">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<p><?= $user_d['review'] ?> Review</p>
				</div>
				<h5>Includes</h5>
				<p><?= $user_d['includes'] ?></p>
				<?php
					$str = $user_d['slug'];
					$add_stag_url  = base_url()."adds-package/".$city_slug."/".$str."/";
				?>
				<a href="<?= $add_stag_url ?>" class="scroll-fixed-btn button button-shadow-2 button-primary">
					Add Package <?= $user_d['compnay_name'] ?>
				</a>
				
				
				<div class="more-link">
					<a href="<?= base_url('accommodation/location/'.$city_slug) ?>" style="margin-top: 15px;font-size: larger;font-weight: 700;display: block;"> View all <?= $city_name ?> Hen stag Ideas</a>
				</div>
			</div>
		</div>
		
		<div class="overview-section">
			<div class="container">
				<div class="section-header">
					<h4>Overview</h4>
				</div>
				<div class="overview-content">
					<p><?= $user_d['introduction'] ?></p>
				</div>
			</div>
		</div>
		<?php
		$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$user_d['country_id']."'");

		$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");

		$city_name = $this->crud->get_column_value_by_id("city","name","id = '".$user_d['city_id']."'");
		?>
		<div class="details-block">
			<div class="container">
				<h4>Details</h4>
				<div class="row">
					<div class="col-md-6">
						<p><strong>Useful Info:</strong> <?= $user_d['use_info'] ?></p>
						<p><strong>Start Times:</strong> <?= $user_d['start_time'] ?></p>
						<p> <strong>Minimum People:</strong> <?= $user_d['minimum_p'] ?></p>
						<p> <strong>Maximum People:</strong> <?= $user_d['maximum_p'] ?></p>
					</div>
					
					<div class="col-md-4">
						<p><strong>ID Required:</strong> <?= $user_d['id_required'] ?></p>
						<p><strong>Minimum Age:</strong> <?= $user_d['age'] ?></p>
						<p><strong>Runs:</strong> <?= $user_d['runs'] ?></p>
						<p><strong>Location:</strong> <?= $country_name.' , '.$state_name ?></p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="section-header">
					<h4>More Details</h4>
				</div>
				<div class="overview-content" style="text-align: center;">
					<p><?= $user_d['extra_details'] ?></p>
				</div>
			</div>
		
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade model-form" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	   		<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	     		 </div>
		      	<div class="modal-body">
		        	<div class="form-book">
		        		<form>
		        			<div class="row">

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Email Address:</label>
		        						<input type="email" placeholder="Email Address" class="form-control">
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Size of group</label>
		        						<select class="form-control">
		        							<option value="1">1</option>
		        							<option value="2">2</option>
		        							<option value="3">3</option>
		        							<option value="4">4</option>
		        							<option value="5">5</option>
		        						</select>
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Arrival Date:</label>
		        						<input type="text" id="start_date" class="form-control">
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Number of Nights</label>
		        						<select class="form-control">
		        							<option value="1">1</option>
		        							<option value="2">2</option>
		        							<option value="3">3</option>
		        							<option value="4">4</option>
		        							<option value="5">5</option>
		        						</select>
		        					</div>
		        				</div>
		        				
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Budget (per person):</label>
		        						<input type="text" placeholder="Budget (per person)" class="form-control">
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Status</label>
		        						<select class="form-control">
		        							<option value="Ready to Book ASAP">Ready to Book ASAP</option>
		        							<option value="Ready to Book Soon">Ready to Book Soon</option>
		        						</select>
		        					</div>
		        				</div>
		        				<div class="col-md-12">
		        					<div class="form-group">
		        						<div class="check-forget">
											<input type="checkbox" id="remember" name="remember-1">
											<label for="remember">Are you happy to receive future offers and information from us?</label>
										</div>
		        					</div>
		        				</div>
		        				<div class="submit-btn d-block text-center ml-auto mr-auto">
		        					<button type="button" class="button button-shadow-2 button-primary">Submit</button>
		        				</div>
		        			</div>
		        		</form>	
		        	</div>
		      	</div>
	    	</div>
	  	</div>
	</div>
	<?php 
	if(is_array($gallerylists))
	{
	?>
	<div class="image-gallery mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="section-header mb-4">
					<h3>Gallery</h3>
				</div>
				<div class="gallery-carousel">
					<?php
					foreach ($gallerylists as $gallerylist) 
					{
						$image_path     = $gallerylist->gallery_file;

						$prd_exist = UPLOAD_DIR.GALLERY_IMG.$image_path;

						if(file_exists($prd_exist) && $image_path!="") 
						{
							$prd_preview = base_url().UPLOAD_DIR.GALLERY_IMG.$image_path;
						} 
						else 
						{
							$prd_preview = base_url().UPLOAD_DIR.'default.png';
						}
					?>
					<div class="gallery-item">
						<img src="<?= $prd_preview ?>" alt="<?= ucwords($user_d['compnay_name']);?>">
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script>
	$( "#start_date" ).datepicker();
	$('.gallery-carousel').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();
		
		if(scroll >= 700) {
			$(".scroll-fixed-btn").addClass("fixed-btn");
		} else {
			$(".scroll-fixed-btn").removeClass("fixed-btn");
		}
	} );

	$( document ).ready(function() {
    	
	});
</script>
</body>
</html>