<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$SocialInfo = FrontSiteInfo(); 
$onpage_record      = 8;
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
    <meta name="description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event.">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="Advertise with us | Post an Ads | Advertisement | Stripper Party Bus" />
    <meta property="og:description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event." />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />

    <meta name="twitter:title" content="Advertise with us | Post an Ads | Advertisement | Stripper Party Bus" />
    <meta name="twitter:description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event." />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>
    <style>
      #suggesstion-box .search-list-inner-data ul{padding-left:15px;padding-top:10px}#suggesstion-box #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}#suggesstion-box-location .search-list-inner-data label{position:relative;font-size:12px;color:#000;top:0;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500;margin:0 auto;display:block;text-align:center}#suggesstion-box .search-list-inner-data label{position:relative;font-size:12px;color:#000;top:0;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500;margin:0 auto;display:block;text-align:center}#suggesstion-box .search-list-inner-data ul,#suggesstion-box-location .search-list-inner-data ul{padding-left:15px;padding-top:5px;background-color:rgba(0,0,0,.1);padding-bottom:5px;margin-left:15px;margin-top:5px;margin-bottom:0}#suggesstion-box .search-list-inner-data ul li a,#suggesstion-box-location .search-list-inner-data ul li a{color:#000}#suggesstion-box .search-list-inner-data ul li a:hover,#suggesstion-box-location .search-list-inner-data ul li a:hover{color:#3cc3c1}#suggesstion-box-location #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}.directory-listings-search #suggesstion-box #agency-list{left:-18px;min-width:290px;border-top-left-radius:5px}.directory-listings-search #suggesstion-box #agency-list li,.directory-listings-search #suggesstion-box-location #agency-list li{transition:all .25s ease-in-out}.directory-listings-search #suggesstion-box #agency-list>li:not(.search-list-inner-data):hover,.directory-listings-search #suggesstion-box-location #agency-list>li:not(.search-list-inner-data):hover{padding-left:10px;color:#fff;background-color:#3cc3c1}.directory-listings-search #suggesstion-box #agency-list li,.directory-listings-search #suggesstion-box-location #agency-list li{padding-bottom:0}.directory-listings-search #suggesstion-box #agency-list>li,.directory-listings-search #suggesstion-box-location #agency-list>li{padding-bottom:0;margin-bottom:5px}.testimonial-block-cnt{overflow-x:hidden}.testimonial-block-cnt .slick-next{right:30px}@media (max-width:991px){.directory-listings-search #suggesstion-box #agency-list{left:0;right:0}}
    </style>
</head>

<body class="">    
<?php $this->load->view(FRONTEND."include/menu"); ?>
  <section class="breadcrumbs-custom post-agencies-breadcrumbs">
    
    <div class="parallax-container parallax-agencies" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg" style="background-image:url(<?=FRONT_ASSETS?>images/banner-img.jpg);">
          <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img"></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark">
                <div class="container">
                    <div class="directory-listing-form">
                        <h1>Looking For A Job?</h1>
                        <div class="directory-listings-search" style="max-width: 750px; margin-left: auto; margin-right: auto;">
                            <form id="service_search" class="service_search" method="post" action="javascript:void(0);">
                                <div class="">
                                    <div class="form-group">
                                        <label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
                                        <input type="text" id="keywords" name="keywords" placeholder="Type in service or location you want." class="form-control" autocomplete="off">
                                        <div id="suggesstion-box" class="suggest"></div>
                                    </div>
                                </div>
                                <div class="directory-search-btn">
                                    <button type="button" class="btn btn-primary seach_filter_block">Filter <i class="fal fa-filter"></i></button>
                                    <button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?=base_url();?>">Home</a></li>
                <li class="active">Looking For A Job?</li>
            </ul>
        </div>
    </div>
</section>

<?php
$job  = $this->crud->get_data("post",array("isDelete" =>0,"status" =>'Y'));
$total_jobs = count($job);

$entr=$this->crud->get_data("post",array("isDelete" =>0,"status" =>'Y','category'=>'Entertainment'));
$entertainment = count($entr);

$ecrt  = $this->crud->get_data("post",array("isDelete" =>0,"status" =>'Y','category'=> 'Escorts'));
$escorts = count($ecrt);

$member = $this->crud->get_data("apply_job",array("isDelete" =>0,"status" =>'Y'));
$members = count($member);

?>
<div id="projectFacts" class="sectionClass">
  <div class="projectFactsWrap ">
      <div class="item wow fadeInUpBig animated animated" data-number="<?= $entertainment ?>" style="visibility: visible;">
          <i class="fa fa-venus"></i>
          <p id="number1" class="number"><?= $entertainment ?></p>
          <span></span>
          <p>Entertainment</p>
      </div>
      <div class="item wow fadeInUpBig animated animated" data-number="<?= $total_jobs ?>" style="visibility: visible;">
          <i class="fa fa-venus"></i>
          <p id="number2" class="number"><?= $total_jobs ?></p>
          <span></span>
          <p>Agency</p>
      </div>
      <div class="item wow fadeInUpBig animated animated" data-number="<?= $total_jobs ?>" style="visibility: visible;">
          <i class="fa fa-briefcase"></i>
          <p id="number3" class="number"><?= $total_jobs ?></p>
          <span></span>
          <p>Jobs</p>
      </div>
      <div class="item wow fadeInUpBig animated animated" data-number="<?= $members ?>" style="visibility: visible;">
          <i class="fa fa-user"></i>
          <p id="number4" class="number"><?= $members ?></p>
          <span></span>
          <p>Members</p>
      </div>
  </div>
</div>



<!-- ************ Category ************ -->

<div class="col-md-12 mb-4 section-header">
	<h3>Categories</h3>
</div>
<?php
$topless_url  = base_url()."post-and-ads/categories/topless-waitress/";
$promoters_url  = base_url()."post-and-ads/categories/promoters/";
$malestriper_url  = base_url()."post-and-ads/categories/male-kissograms/";
$entr_url  = base_url()."post-and-ads/categories/entertainment-transportation/";
$lifedrive_url  = base_url()."post-and-ads/categories/life-drawing-and-nude-painting-models/";
$female_url  = base_url()."post-and-ads/categories/female-strippers/";
$model_url  = base_url()."post-and-ads/categories/models/";
$drag_url  = base_url()."post-and-ads/categories/drag-queens/";
$dj_url  = base_url()."post-and-ads/categories/dj-live-band/";
$cooktail_url  = base_url()."post-and-ads/categories/cocktail-classes-nude-painting/";
$bunny_url  = base_url()."post-and-ads/categories/bunny-girls/";
$buff_url  = base_url()."post-and-ads/categories/buff-butlers/";
?>
<div class="category-grid-view">
	<div class="container">
		<div class="row">
			<div class="col-xl-2 col-md-4 col-6 box-img">
				<div class="image-content">
					<a href="<?= $topless_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/topless.jfif">
						<h2>Topless Waitress</h2>
					</a>
				</div>
			</div>
			<div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $promoters_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/male-stripper.jpg">
						<h2>Promoters</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $malestriper_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/promoter.jpg">
						<h2>Male Strippers</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $entr_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/drag-queen.jpg">
						<h2>Entertainment Transportation</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $lifedrive_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/drawing.jpg">
						<h2>Life Drawing And Nude Painting Models</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $female_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/female-stripper.jpg">
						<h2>Female Strippers</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $model_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/kisso.jfif">
						<h2>Models</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $drag_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/quuen.jfif">
						<h2>Drag Queens</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $dj_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/dj-live.jpg">
						<h2>DJ & Live Band </h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $cooktail_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/nude-paint.jfif">
						<h2>Cocktail Classes & Nude Painting</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $bunny_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/bunny.jpg">
						<h2>Bunny Girls</h2>
					</a>
				</div>
			</div>
      <div class="col-xl-2 col-6 col-md-4 box-img">
				<div class="image-content">
					<a href="<?= $buff_url ?>">
						<img src="<?= FRONT_ASSETS ?>images/buff.jfif">
						<h2>Buff Butlers</h2>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!--******************* Resent job *******************-->
<section class="post-ads-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 section-header">
				<h3>Recent Job</h3>
			</div>
		</div>
		<div class="row mt-0 resultList">
      <!-- Job listing  -->
		</div>
    <?php if($total_record > $onpage_record){ ?>
        <p class="text-center"><button class="btn btn-primary" id="load_more" data-val="0" type="submit" style="display: none;"><i class="fas fa-chevron-circle-down"></i>  Load more posts... </button></p>
    <?php } ?>
	</div>
</section>
<!-- End Resent job-->	

	
 <!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="https://pagead2.googlesyndication.com/pagead/js/r20210701/r20190131/show_ads_impl_fy2019.js" id="google_shimpl"></script>
<script>


$.fn.jQuerySimpleCounter = function( options ) {
  var settings = $.extend({
      start:  0,
      end:    100,
      easing: 'swing',
      duration: 400,
      complete: ''
  }, options );

  var thisElement = $(this);

  $({count: settings.start}).animate({count: settings.end}, {
    duration: settings.duration,
    easing: settings.easing,
    step: function() {
      var mathCount = Math.ceil(this.count);
      thisElement.text(mathCount);
    },
    complete: settings.complete
  });
};


$('#number1').jQuerySimpleCounter({end: <?php echo $entertainment ?>,duration: 5000});
$('#number2').jQuerySimpleCounter({end: <?php echo $total_jobs ?>,duration: 5000});
$('#number3').jQuerySimpleCounter({end: <?php echo $total_jobs ?>,duration: 2000});
$('#number4').jQuerySimpleCounter({end: <?php echo $members ?>,duration: 2500});

/* AUTHOR LINK */
$('.about-me-img').hover(function(){
    $('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
}, function(){
  $('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
});
  
$(document).ready(function(){
    getRecords(0);

    $("#load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getRecords(page);
    });
});

function searchFilter()
{
    $(".resultList").html("");
    getRecords(0);
}

function getRecords(page_num) 
{
  var total_record        = '<?php echo $total_record; ?>';
  var onpage_record       = '<?php echo $onpage_record;?>';
  var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
  var remain_record       = parseInt(total_record) - parseInt(curr_disp);
  var keywords            = $('#keywords').val();

  $.ajax({
      type : 'POST',
      url : baseURL+'AgencyControler/PostListajaxPaginationData/',
      data:'page='+page_num+'&keywords='+keywords,
      beforeSend: function(){
        $(".loading-div").show();
      },	
      success:function(html) 
      {
        setTimeout(function()
        {
          $(".loading-div").hide();
          $('.resultList').append(html);

          var new_count = parseInt($('#load_more').attr('data-val')) + parseInt(1);
          $('#load_more').attr('data-val',new_count);

          if(remain_record <= 0)
          {
            $('#load_more').hide();
          }
          else
          {
            $('#load_more').show();
          }
        },1500);
      }
  });
}


//------------- Keywords suggesstion -------------------//
        
$("#suggesstion-box").hide();

$("#keywords").keyup(function(){
    $.ajax({
        type: "POST",
        url: baseURL+'AgencyControler/getPostList/',
        data:'keyword='+$(this).val(),
        
        success: function(data){ 
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
        }
    });
});

function Select(name){
    $("#keywords").val(name);
    $("#suggesstion-box").hide();
}



</script>

</body>      
</html>
