<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
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

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

    <meta name="twitter:title" content="<?= $pageTitle ?>" />
    <meta name="twitter:description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com" />

    <?php $this->load->view(FRONTEND."include/include_css"); ?> 
    <style>
        .more-content {
            display: none;
        }
        
    </style>
</head>
<body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    <section class="breadcrumbs-custom hen-tag">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/Emerald-Bay-Resort-Pool.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/Emerald-Bay-Resort-Pool.jpg" alt="contact-banner"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title">Hen Stag Accommodation</h1>
                    <h5 class="breadcrumbs-custom-text text-effect-contact" style="font-weight: 600;">
                        For everything stag and hen do, stag and hen accommodation, stag and hen parties, transportation for hire, party venues and airport transfers, talk to us today!!!
                    </h5>
					<button type="button btn" class="button button-shadow-2 button-primary button-popup scroll-fixed-btn" data-toggle="modal" data-target="#exampleModal">
						Select A Destination
					</button>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="active">Hen Stag Accommodation</li>
                </ul>
            </div>
        </div>
    </section>
	
	<div class="destination-banner">
		<div class="banner-inner" style="background-image:url(<?=FRONT_ASSETS?>images/scottdalearizonabachelorettepoolparty-1.jpg);">
			<div class="content-box">
				<div class="content-inner">
					<h2><?= $profile['title'] ?></h2>
					<p><?= $profile['descr'] ?></p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="top-destinations">
		<div class="section-header">
			<h2 class="heading-2">Top Destinations</h2>
		</div>
		<div class="destination-slider">
			<div class="slide-item">
				<a href="<?php echo base_url('accommodation/location/london') ?>">
					<img src="<?=FRONT_ASSETS?>images/32545.jpg" alt="london">
					 <div class="hover-btn"><span>Top to see</span></div>
					<div class="slide-content">
						<h5>London</h5>
					</div>
				</a>
			</div>
			<div class="slide-item">
				<a href="<?php echo base_url('accommodation/location/brighton-hove') ?>">
					<img src="<?=FRONT_ASSETS?>images/wp3104988.jpg" alt="brighton-hove">
					 <div class="hover-btn"><span>Top to see</span></div>
					<div class="slide-content">
						<h5>Brighton & Hove</h5>
					</div>
				</a>
			</div>
			<div class="slide-item">
				<a href="<?php echo base_url('accommodation/location/liverpool') ?>">
					<img src="<?=FRONT_ASSETS?>images/Liverpool_wakeyfan-pixabay-lic.jpg" alt="Image">
				     <div class="hover-btn"><span>Top to see</span></div>
					<div class="slide-content">
						<h5>liverpool</h5>
					</div>
				</a>
			</div>
			<div class="slide-item">
				<a href="<?php echo base_url('accommodation/location/bristol') ?>">
					<img src="<?=FRONT_ASSETS?>images/Bristol-vista.jpg" alt="Image">
					<div class="hover-btn"><span>Top to see</span></div>
					<div class="slide-content">
						<h5>Bristol</h5>
					</div>
				</a>
			</div>
			<div class="slide-item">
				<a href="<?php echo base_url('accommodation/location/newcastle') ?>">
					<img src="<?=FRONT_ASSETS?>images/newcastle-cities-of-the-north_626b41ef3e.jpeg" alt="Image">
					<div class="hover-btn"><span>Top to see</span></div>
					<div class="slide-content">
						<h5>Newcastle</h5>
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<div class="destination-variation">
		<div class="row m-0">
			<div class="col-md-6 p-0 image-box">
				<img src="<?=FRONT_ASSETS?>images/Hosting-a-fun-pool-party.jpeg" alt="Image">
			</div>
			<div class="col-md-6 p-0 content-box">
				<div class="inner-content">
					<h2><?= $profile['second_title'] ?></h2>
					<p><?= $profile['second_descr'] ?></p>
				</div>
			</div>
		</div>
		<div class="row m-0">
			<div class="col-md-6 p-0 content-box">
				<div class="inner-content">
					<h2><?= $profile['third_title'] ?></h2>
					<p><?= $profile['third_descr'] ?></p>
				</div>
			</div>
			<div class="col-md-6 p-0 image-box">
				<img src="<?=FRONT_ASSETS?>images/Best-Man-Guide-01.jpg" alt="Image">
			</div>
		</div>
	</div>

	<section class="section bg-default list-type-diff mb-5 p-0">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center"> 
                <div class="col-md-12 col-lg-12 col-xl-12"> 
                    <div class="col-xs-12 col-sm-12">
                        <div class="panel-home panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title" style="text-transform: capitalize;">&#xFEFF; <?= $profile['footer_title'] ?></h4><br>
                            </div>
                            <div class="panel-body text-justify">
								<?= $profile['footer_descr']; ?> <a class="moreless-button" href="javascript:void(0)">Read more</a>
								
                            </div>
                        </div>
                    </div>
                 </div>
             </div> 
        </div>
    </section>
	
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
								<li class="city-list"><a href="javascript:viod(0)" data-isotope-filter="Type 1">UK</a>
								<div class="form-group">
									<label class="form-label-custom">UK State</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" onchange="getCityDetails(this.value,this);">
										<option value="">State</option>
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
									<label class="form-label-custom">Europe State</label>
									<select name="state_id" id="state_id"  class="form-control selectpicker" onchange="getCityDetailsEurope(this.value,this);">
										<option value="">State</option>
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
									<label class="form-label-custom">Worldwide State</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" onchange="getCityDetailsWorldwide(this.value,this);">
										<option value="">State</option>
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
				
				<div class="model-body">
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

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script>
$(document).on("ready", function() {
	$( "#datepicker" ).datepicker({ 
		minDate: "+7"
	});
	$( "#start_date" ).datepicker();
	
	$(".destination-slider .slider-item").on("click touchend", function(e) {
    	var el = $(this);
    });
});

$('.moreless-button').click(function() {
    $('.more-content').slideToggle();
    if ($('.moreless-button').text() == "Read more") {
        $(this).text("Read less")
    } else {
        $(this).text("Read more")
    }
});

if($('.destination-slider').length) {

	var slider2 = $('.destination-slider').slick({
		infinite: false,
		autoplay: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		draggable: true,
		swipe: true,
		touchMove: true,
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
	});

	/* Hide the Previous button. */
	$('.slick-prev').hide();

	slider2.on('afterChange', function(event, slick, currentSlide) {
		console.log(currentSlide);
		/* If we're on the first slide hide the Previous button and show the Next */
		if (currentSlide === 0) {
		  $('.slick-prev').hide();
		  $('.slick-next').show();
		}
		else {
			$('.slick-prev').show();
		}

		/* If we're on the last slide hide the Next button. */
		if (slick.slideCount === currentSlide + 1) {
			$('.slick-next').hide();
		}
	});
}

if($('.scroll-fixed-btn').length) {
	
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();
		
		if(scroll >= 200) {
			$(".scroll-fixed-btn").addClass("fixed-btn");
		} else {
			$(".scroll-fixed-btn").removeClass("fixed-btn");
		}
	} );
}

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