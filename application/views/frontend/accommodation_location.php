<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
    $sum=0;
    foreach($review as $count)
    {
        $sum+= $count->review;
    }
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
    <meta name="description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com.">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com." />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/747f879655e7564f63ce565ae5e0e471.jpg" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/747f879655e7564f63ce565ae5e0e471.jpg" />

    <meta name="twitter:title" content="<?= $pageTitle ?>" />
    <meta name="twitter:description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com" />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>    
    <style>

.ribbon {
  width: 100px;
  height: 100px;
  overflow: hidden;
  position: absolute;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 3px solid #1eb5ff;
}
.ribbon span {
  position: absolute;
  display: block;
  width: 165px;
  padding: 5px 0;
  background-color: #1eb5ff;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
}
.wdp-ribbon{
	display: inline-block;
    padding: 2px 15px;
	position: absolute;
    right: 0px;
    top: 20px;
    line-height: 24px;
	height:24px;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
	border-radius: 0;
    text-shadow: none;
    font-weight: normal;
    background-color: #1eb5ff !important;
}
.wdp-ribbon-two:before, .wdp-ribbon-two:before {
    display: inline-block;
    content: "";
    position: absolute;
    left: -14px;
    top: 0;
    border: 9px solid transparent;
    border-width: 14px 8px;
    border-right-color: #1eb5ff;
}
.wdp-ribbon-two:before {
    border-color: #1eb5ff;
    border-left-color: transparent!important;
    left: -9px;
}


.wdp-ribbon-six{
	background: none !important;
    position: relative;
    box-sizing: border-box;
    position: absolute;
    width: 50px;
    height: 50px;
	top:0px;
	right:0px;
	padding:0px;
	overflow: hidden;
}
.wdp-ribbon-inner-wrap{
    -ms-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
    -webkit-transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
    transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
}
.wdp-ribbon-border{
    width: 0;
    height: 0;
    border-right: 51px solid #000;
    border-bottom: 47px solid transparent;
    z-index: 12;
	position:relative;
	top:-31px;
}
.wdp-ribbon-text {
    font-size: 11px;
    color: white;
    font-weight: 900;
    line-height: 13px;
    position: absolute;
    z-index: 14;
    -webkit-transform: rotate( 
45deg
 );
    -ms-transform: rotate(45deg);
    transform: rotate( 
45deg
 );
    top: 6px;
    left: -2px;
    width: 81px;
    text-align: center;
}
</style>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    <section class="breadcrumbs-custom hen-tag post-agencies-breadcrumbs">
		<div class="parallax-container parallax-agencies" data-parallax-img="<?=FRONT_ASSETS?>images/747f879655e7564f63ce565ae5e0e471.jpg" style="background-image:url(<?=FRONT_ASSETS?>images/747f879655e7564f63ce565ae5e0e471.jpg);">
			<div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/747f879655e7564f63ce565ae5e0e471.jpg" alt="banner-img"></div>
			<div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
				<div class="container">
					<h1 class="text-transform-capitalize breadcrumbs-custom-title">New <?= $pageTitle ?></h1>
					<br>
					<div class="star-count">
						<span>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</span>
						<p><?= $sum ?> Reviews</p>
					</div>
				</div>
			</div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li><a href="<?= base_url('hen-stag-accommodation') ?>">Hen Stag Accommodation</a></li>
                    <li class="active"><?= $pageTitle ?></li>
                </ul>
            </div>
        </div>
    </section>
	
	<?php $details_url  = base_url()."hen-stag-accommodation/details"; ?>
	<div class="section-bg-color">
		<section class="activitie-section no-slider">
			<div class="section-header">
				<h2><?= $l_name ?> New Daytime Activities</h2>
			</div>
        <?php
        if(is_array($day))
        {
        ?>
			<div id="day-activitie" class="activities-carousel row">
				<?php
				foreach ($day as $days) 
				{
					$str = $days->slug;
					$city_slug = $this->crud->get_column_value_by_id("city","slug","id = '".$days->city_id."'");
					
        			$day_url  = base_url()."hen-stag-accommodation/details/".$city_slug."/".$str."/";
					$image_path     = $days->profile_image;

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
						<a href="<?= $day_url ?>">
							<div class="hover-btn"><span>click to see</span></div>
							<div class="overlay"></div>
							<div class="item-content">
								<h4><?= $days->compnay_name ?></h4>
								<div class="star-count">
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</span>
									<p><?= $days->review ?> Reviews</p>
								</div>
								<div class="bottom-content">
									<h6><?= $days->compnay_name ?></h6>
								</div>
							</div>
						</a>
						<span class="wdp-ribbon wdp-ribbon-six"><span class="wdp-ribbon-inner-wrap"><span class="wdp-ribbon-border"></span><span class="wdp-ribbon-text">NEW</span></span>
                            </span>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<div class="more-link">
				<a href="<?= base_url('hen-stag-accommodation/'.$location_slug.'/day') ?>"> View All Daytime Ideas <i class="fa fa-arrow-circle-right"></i></a>
			</div>
            <?php
            }
            else
            {
            ?>
                <div class="block-no-record">
                    <div class="col-md-12 text-center">
                        <hr>
                        <h4><strong class="text-center" style="text-transform: capitalize;">
                        <?= $l_name ?> location are not provide Daytime Activities service. have a check other location.</strong></h4>
                    </div>
                </div>
            <?php
            }
            ?>
		</section>
		

		<section class="activitie-section no-slider">
			<div class="section-header">
				<h2><?= $l_name ?> New Evening Activities</h2>
			</div>
        <?php
		if(is_array($evening))
		{
		?>
			<div id="evening-activitie" class="activities-carousel row">
				<?php
				foreach ($evening as $evenings) 
				{
					$str = $evenings->slug;
        			$evening_url  = base_url()."hen-stag-accommodation/details/".$city_slug."/".$str."/";

					$image_path     = $evenings->profile_image;

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
						<a href="<?= $evening_url ?>">
							<div class="hover-btn"><span>click to see</span></div>
							<div class="item-content">
								<h4><?= $evenings->compnay_name ?></h4>
								<div class="star-count">
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</span>
									<p><?= $evenings->review ?> Reviews</p>
								</div>
								<div class="bottom-content">
									<h6><?= $evenings->compnay_name ?></h6>
								</div>
							</div>
						</a>
						<span class="wdp-ribbon wdp-ribbon-six"><span class="wdp-ribbon-inner-wrap"><span class="wdp-ribbon-border"></span><span class="wdp-ribbon-text">NEW</span></span>
                            </span>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<div class="more-link">
				<a href="<?= base_url('hen-stag-accommodation/'.$location_slug.'/evening') ?>">View All Evening Activities<i class="fa fa-arrow-circle-right"></i></a>
			</div>
            <?php
		}
		else
        {
        ?>
            <div class="block-no-record">
                <div class="col-md-12 text-center">
                    <hr>
                    <h4><strong class="text-center" style="text-transform: capitalize;">
                    <?= $l_name ?> location are not provide Evening Activities service. have a check other location.</strong></h4>
                </div>
            </div>
        <?php
        }
		?>
		</section>

		
		<section class="activitie-section no-slider">
			<div class="section-header">
				<h2><?= $l_name ?> New Accommodation</h2>
			</div>
        <?php
		if(is_array($accommodation))
		{
		?>
			<div id="accommodation" class="activities-carousel row">
				<?php
				foreach ($accommodation as $accommodations) 
				{
					$str = $accommodations->slug;
        			$accommodations_url  = base_url()."hen-stag-accommodation/details/".$city_slug."/".$str."/";
					
					$image_path     = $accommodations->profile_image;

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
						<a href="<?= $accommodations_url ?>">
						    <div class="hover-btn"><span>click to see</span></div>
							<div class="item-content">
								<h4><?= $accommodations->compnay_name ?></h4>
								<div class="star-count">
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</span>
									<p><?= $accommodations->review ?> Reviews</p>
								</div>
								<div class="bottom-content">
									<h6><?= $accommodations->compnay_name ?></h6>
								</div>
							</div>
						</a>
						<span class="wdp-ribbon wdp-ribbon-six"><span class="wdp-ribbon-inner-wrap"><span class="wdp-ribbon-border"></span><span class="wdp-ribbon-text">NEW</span></span>
                            </span>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<div class="more-link">
				<a href="<?= base_url('hen-stag-accommodation/'.$location_slug.'/accommodation') ?>">VIEW ALL ACCOMMODATION<i class="fa fa-arrow-circle-right"></i></a>
			</div>
        <?php
		}
        else
        {
        ?>
            <div class="block-no-record">
                <div class="col-md-12 text-center">
                    <hr>
                    <h4><strong class="text-center" style="text-transform: capitalize;">
                    <?= $l_name ?> location are not Accommodation service. have a check other location.</strong></h4>
                </div>
            </div>
        <?php
        }
		?>
		</section>
		

		
		<section class="activitie-section no-slider">
			<div class="section-header">
				<h2><?= $l_name ?> New Airport Transfers</h2>
			</div>
            <?php
		if(is_array($transfer))
		{
		?>
			<div id="accommodation" class="activities-carousel row">
				<?php
				foreach ($transfer as $transfers) 
				{
					$str = $transfers->slug;
        			$transfers_url  = base_url()."hen-stag-accommodation/details/".$city_slug."/".$str."/";

					$image_path     = $transfers->profile_image;
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
						<a href="<?= $transfers_url ?>">
							<div class="hover-btn"><span>click to see</span></div>
							<div class="item-content">
								<h4><?= $transfers->compnay_name ?></h4>
								<div class="star-count">
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</span>
									<p><?= $transfers->review ?> Reviews</p>
								</div>
								<div class="bottom-content">
									<h6><?= $transfers->compnay_name ?></h6>
								</div>
							</div>
						</a>
						<span class="wdp-ribbon wdp-ribbon-six"><span class="wdp-ribbon-inner-wrap"><span class="wdp-ribbon-border"></span><span class="wdp-ribbon-text">NEW</span></span>
                            </span>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<div class="more-link">
				<a href="<?= base_url('hen-stag-accommodation/'.$location_slug.'/transfer') ?>">VIEW ALL AIR TRANSPOSRT<i class="fa fa-arrow-circle-right"></i></a>
			</div>
            <?php
            }
            else
            {
            ?>
                <div class="block-no-record">
                    <div class="col-md-12 text-center">
                        <hr>
                        <h4><strong class="text-center" style="text-transform: capitalize;">
                        <?= $l_name ?> location are not provide Airport Transfers service. have a check other location.</strong></h4>
                    </div>
                </div>
            <?php
            }
            ?>
		</section>
	</div>
	
	
	<!-- Modal -->
<div class="modal fade daytime-model" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
			<div class="isotope-wrap custom-tab">
				<div class="modal-header p-0">
					<div class="isotope-filters">
						<div class="isotope-filters-list-wrap">
							<ul class="isotope-filters">
								<!-- <li><a class="active" href="javascript:viod(0)" data-isotope-filter="*">All</a></li> -->
								<li class="city-list"><a href="javascript:viod(0)" data-isotope-filter="Type 1">United Kingdom</a>
								<div class="form-group">
									<label class="form-label-custom">State</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" onchange="getCityDetails(this.value,this);">
										<option value="">Please select option</option>
										<?php
										foreach($statelists_united as $statelist) 
										{
										?>
										<option <?php if($statelist->state_id==$state_id){?> selected <?php } ?> value="<?=$statelist->state_id?>"><?=$statelist->name;?></option>
										<?php
										}
										?>
									</select>
								</div>
							</li>
								<li class="city-list"><a href="javascript:viod(0)" data-isotope-filter="Type 2">Europe</a>
								<div class="form-group">
									<label class="form-label-custom">State</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" onchange="getCityDetailsEurope(this.value,this);">
										<option value="">Please select option</option>
										<?php
										foreach($statelists_europe as $statelist) 
										{
										?>
										<option <?php if($statelist->state_id==$state_id){?> selected <?php } ?> value="<?=$statelist->state_id?>"><?=$statelist->name;?></option>
										<?php
										}
										?>
									</select>
								</div>
							</li>
								<li class="city-list"><a href="javascript:viod(0)" data-isotope-filter="Type 3">Worldwide</a>
								<div class="form-group">
									<label class="form-label-custom">State</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" onchange="getCityDetailsWorldwide(this.value,this);">
										<option value="">Please select option</option>
										<?php
										foreach($worldwide as $statelist) 
										{
										?>
										<option <?php if($statelist->state_id==$state_id){?> selected <?php } ?> value="<?=$statelist->state_id?>"><?=$statelist->name;?></option>
										<?php
										}
										?>
									</select>
								</div>
							</li>
							</ul>
						</div>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="model-content">
					<div class="row ml-0 isotope d-flex isotope-custom-1" data-lightgallery="group" id="resultList">
						<div id="city_field_val" style="display: flex;flex-wrap: wrap;">
							<!-- ===================== -->
						</div>
					</div>
				</div>
			</div>
    	</div>
  	</div>
</div>
<hr>
<section class="section bg-default list-type-diff mb-5 p-0">
        <div class="container">
           <!--  <div class="row row-40 row-md-60 justify-content-center"> -->
                <!-- <div class="col-md-12 col-lg-12 col-xl-12"> -->
                    
                    <div class="col-xs-12 col-sm-12">
                        <div class="panel-home panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title" style="text-transform: capitalize;">&#xFEFF; <?= $l_name ?></h2>
                            </div>
                            <div class="panel-body text-justify">
                                <p><?= $descr_city; ?></p>
                            </div>
                        </div>
                    </div>
                    
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </section>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script>
$(document).on("ready", function() {
	$( "#datepicker" ).datepicker({ 
		minDate: "+7"
	});
	$( "#start_date" ).datepicker();
	
	$(".activitie-section .slider-item").on("click touchend", function(e) {
    	var el = $(this);
    });
});

/* $('.activities-carousel').slick({
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
		{
			breakpoint: 992,
			settings: {
			slidesToShow: 4,
			slidesToScroll: 1
			}
		},
		{
			breakpoint: 991,
			settings: {
			slidesToShow: 3,
			slidesToScroll: 1
			}
		},
		{
			breakpoint: 768,
			settings: {
			slidesToShow: 2,
			slidesToScroll: 1
			}
		},
		{
			breakpoint: 575,
			settings: {
			slidesToShow: 1,
			slidesToScroll: 1
			}
		}

	]
}); */

function getCityDetails(state_id,all_details)
{
	var tmp = $(all_details).attr("id");
	var res = tmp.split("state_id");
	var curr_pos = res[1];

	$.ajax({
		url: baseURL+'CommonController/getCityByState',
		type: "POST",
		data: "id="+state_id,
		success: function (data) {
			data = JSON.parse(data);
			var list = "";
			if( data != 'blank' )
			{
				$.each( data, function(index, item) {					
					list += '<div class="isotope-item" data-filter="Type 1"><div class="list-box"><div class="inner-box" ><a href="<?php echo base_url('accommodation/location/') ?>'+item.slug+'"><div class="list-content"><div class="box-content"><h5>'+item.name+'</h5><p>'+item.name+'</p></div></div></div></div></div></a>';
				});
			}
			else
			{
				list = 'No city found for selected state';
			}
			$("#city_field_val"+curr_pos).html(list);
		},
	});
}


function getCityDetailsEurope(state_id,all_details)
{
	var tmp = $(all_details).attr("id");
	var res = tmp.split("state_id");
	var curr_pos = res[1];

	$.ajax({
		url: baseURL+'CommonController/getCityByState',
		type: "POST",
		data: "id="+state_id,
		success: function (data) {
			data = JSON.parse(data);
			var list = "";
			if( data != 'blank' )
			{
				$.each( data, function(index, item) {
					list += '<div class="isotope-item" data-filter="Type 1"><div class="list-box"><div class="inner-box" ><a href="<?php echo base_url('accommodation/location/') ?>'+item.slug+'"><div class="list-content"><div class="box-content"><h5>'+item.name+'</h5><p>'+item.name+'</p></div></div></div></div></div></a>';
				});
			}
			else
			{
				list = 'No city found for selected state';
			}
			$("#city_field_val"+curr_pos).html(list);
		},
	});
}


function getCityDetailsWorldwide(state_id,all_details)
{
	var tmp = $(all_details).attr("id");
	var res = tmp.split("state_id");
	var curr_pos = res[1];

	$.ajax({
		url: baseURL+'CommonController/getCityByState',
		type: "POST",
		data: "id="+state_id,
		success: function (data) {
			data = JSON.parse(data);
			var list = "";
			if( data != 'blank' )
			{
				$.each( data, function(index, item) {
					list += '<div class="isotope-item" data-filter="Type 1"><div class="list-box"><div class="inner-box" ><a href="<?php echo base_url('accommodation/location/') ?>'+item.slug+'"><div class="list-content"><div class="box-content"><h5>'+item.name+'</h5><p>'+item.name+'</p></div></div></div></div></div></a>';
				});
			}
			else
			{
				list = 'No city found for selected state';
			}
			$("#city_field_val"+curr_pos).html(list);
		},
	});
}

</script>

</body>
</html>