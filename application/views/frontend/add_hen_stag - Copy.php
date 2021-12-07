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
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
                <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 50px;">Add Hen Stag</h1>
                <h5 class="breadcrumbs-custom-text text-effect-contact">
                    Add Hen Stag
                </h5>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?= base_url('') ?>">Home</a></li>
                <li><a href="<?= base_url('hen-stag-accommodation') ?>">Hen stag accommodation</a></li>
                <li class="active">Add Hen Stag</li>
            </ul>
        </div>
    </div>
</section>
<div class="filter-activity">
	<div class="container">
		<div class="row">
			<button type="button btn" class="col-3 button-popup" data-toggle="modal" data-target="#exampleModal">
				Brighton
			</button>
			
			<select class="selectpicker col-3 select-btn">
				<option value="5">5 People</option>
				<option value="6">6 People</option>
				<option value="7">7 People</option>
				<option value="8">8 People</option>
				<option value="9">9 People</option>
				<option value="10">10 People</option>
				<option value="11">11 People</option>
				<option value="12">12 People</option>
				<option value="13">13 People</option>
				<option value="14">14 People</option>
				<option value="15">15 People</option>
				<option value="16">16 People</option>
				<option value="17">17 People</option>
				<option value="18">18 People</option>
				<option value="19">19 People</option>
				<option value="20">20 People</option>
			</select>
			
			<div class="col-3 select-date">
				<input type="text" placeholder="Select Date" class="form-control" id="datepicker">
			</div>
			
			<select class="selectpicker col-3 select-night">
				<option>0 Nights</option>
				<option>1 Nights</option>
				<option>2 Nights</option>
				<option>3 Nights</option>
				<option>4 Nights</option>
				<option>5 Nights</option>
				<option>6 Nights</option>
				<option>7 Nights</option>
			</select>
			
		</div>
	</div>
</div>

<section class="select-packages">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="package-box">
					<div class="package-date">
						<p>Day 1</p>
					</div>
					<div class="more-link">
						<a href="#" class="btn">Add More to This Day</a> 
					</div>
				</div>
				<div class="package-box package-content">
					<div class="package-date">
						<p>Day 2</p>
					</div>
					<div class="content-box">
						<div class="inner-content">
							<div class="image-box">
								<img src="<?=FRONT_ASSETS?>images/sample.jpg" alt="image">
							</div>
							<div class="box-content">
								<h3>Classic Cocktail Making</h3>
								<p><i class="fas fa-map-marker-alt"></i>Steinbeck & Shaw - Brighton </p>
								<p><i class="fa fa-user"></i>18 People</p>
								<p><i class="fas fa-clock"></i>Start Time: 12:00</p>
							</div>
							<div class="show-more">
								<a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>
							</div>
							<div class="hide-show-content">
								<div class="more-content">
									<div class="more-data select-people">
										<button type="button" class="" data-toggle="modal" data-target="#morepeople"><i class="fas fa-ellipsis-h"></i> <span>More</span></button>
									</div>
									<div class="more-data select-time">
										<button type="button" class="" data-toggle="modal" data-target="#modelday-time"><i class="fas fa-clock"></i> <span>Start Time</span></button>
									</div>
									<div class="more-data remove-day">
										<a href="javascript:void(0);"><i class="fas fa-trash-alt"></i><span>Remove</span></a>
									</div>
									<!--div class="more-data move-day">
										<a class="move-up" href="javascript:void(0);"><i class="fas fa-angle-up"></i></a>
										<span>Move Day</span>
										<a class="move-down" href="javascript:void(0);"><i class="fas fa-angle-down"></i></a>
									</div-->
									<div class="more-data view-day">
										<a href="javascript:void(0);"><i class="far fa-eye"></i><span>View</span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="more-link">
						<a href="#" class="btn">Add More to This Day</a> 
					</div>
					
				</div>

			</div>
			<div class="col-md-5">
				<button type="button" class="button button-shadow-2 button-zakaria button-lg button-primary" data-toggle="modal" data-target="#exampleModalCenter">
					Add To Enquiry
				</button>
			</div>
		</div>
	</div>
</section>

	<!-- Modal Enquiry -->
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
		        						<input type="text" placeholder="Select Date" id="start_date" class="form-control">
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

	<!-- Modal More People-->
	<div class="modal fade morepeople-model" id="morepeople" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">EDIT GUESTS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="d-block mb-2">People</label>
						<select class="selectpicker select-btn popup-user">
							<option value="5">5 People</option>
							<option value="6">6 People</option>
							<option value="7">7 People</option>
							<option value="8">8 People</option>
							<option value="9">9 People</option>
							<option value="10">10 People</option>
							<option value="11">11 People</option>
							<option value="12">12 People</option>
							<option value="13">13 People</option>
							<option value="14">14 People</option>
							<option value="15">15 People</option>
							<option value="16">16 People</option>
							<option value="17">17 People</option>
							<option value="18">18 People</option>
							<option value="19">19 People</option>
							<option value="20">20 People</option>
						</select>
					</div>
					<button data-dismiss="modal" type="button" class="button button-shadow-2 button-primary btn-sm w-100">Ok</button>
				</div>
				
			</div>
		</div>
	</div>

<!-- Modal Time -->
<div class="modal fade modelday-time" id="modelday-time" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">PREFERRED START TIME</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="d-block mb-2">Start Time Preference</label>
					<select class="selectpicker select-btn popup-user">
						<option value="9">9:00</option>
						<option value="9:15">9:15</option>
						<option value="9:30">9:30</option>
						<option value="9:45">9:45</option>
						<option value="10:00">10:00</option>
						<option value="10:15">10:15</option>
						<option value="10:30">10:30</option>
						<option value="11">11:00</option>
						<option value="11:15">11:15</option>
						<option value="11:30">11:30</option>
						<option value="11:45">11:45</option>
						<option value="12">12:00</option>
						<option value="12:15">12:15</option>
						<option value="12:30">12:30</option>
						<option value="12:45">12:45</option>
						<option value="13">13:00</option>
						<option value="13:15">13:15</option>
						<option value="13:30">13:30</option>
						<option value="14">14:00</option>
						<option value="14:15">14:15</option>
						<option value="14:30">14:30</option>
						<option value="14:45">14:45</option>
						<option value="15">15:00</option>
						<option value="15:15">15:15</option>
						<option value="15:30">15:30</option>
						<option value="15:45">15:45</option>
						<option value="16:15">16:15</option>
						<option value="16:30">16:30</option>
						<option value="16:45">16:45</option>
						<option value="17">17:00</option>
					</select>
				</div>
				<div class="form-group">
					<p class="mr-1">+/-</p>
					<select class="selectpicker select-btn popup-time">
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<p class="ml-1">Hour</p>
				</div>
				<button data-dismiss="modal" type="button" class="button button-shadow-2 button-primary btn-sm w-100">Ok</button>
			</div>
			
		</div>
	</div>
</div>


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

</script>