<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
<link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />

<meta name="description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment.">

<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />

<meta property="og:title" content="<?= $pageTitle ?>" />
<meta property="og:description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment." />
<meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

<meta property="og:site_name" content="Coffee & Strippers" />
<meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:width" content="1457" />
<meta property="og:image:height" content="461" />

<meta name="twitter:card" content="<?= base_url().UPLOAD_DIR.SLIDER_IMG.'banner.jpg' ?>" />
<meta name="twitter:image" content="<?= base_url().UPLOAD_DIR.SLIDER_IMG.'banner.jpg' ?>" />

<meta name="twitter:title" content="<?= $pageTitle ?>" />
<meta name="twitter:description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment." />

<?php $this->load->view(FRONTEND."include/include_css"); ?>
<link rel="preload" href="https://stripperpartybus.b-cdn.net/assets/stories/dist/zuck.min.css" as="style" 
onload="this.rel='stylesheet'"><noscript><link rel="stylesheet" href="https://stripperpartybus.b-cdn.net/assets/stories/dist/zuck.min.css"></noscript>
<link rel="preload" href="https://stripperpartybus.b-cdn.net/assets/stories/dist/skins/snapgram.css" as="style" 
onload="this.rel='stylesheet'"><noscript><link rel="stylesheet" href="https://stripperpartybus.b-cdn.net/assets/stories/dist/skins/snapgram.css"></noscript>

<style>
   
#suggesstion-box .search-list-inner-data ul{padding-left:15px;padding-top:10px}#suggesstion-box #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}#suggesstion-box-location .search-list-inner-data label{position:relative;font-size:12px;color:#000;top:0;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500;margin:0 auto;display:block;text-align:center}#suggesstion-box .search-list-inner-data label{position:relative;font-size:12px;color:#000;top:0;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500;margin:0 auto;display:block;text-align:center}#suggesstion-box .search-list-inner-data ul,#suggesstion-box-location .search-list-inner-data ul{padding-left:15px;padding-top:5px;background-color:rgba(0,0,0,.1);padding-bottom:5px;margin-left:15px;margin-top:5px;margin-bottom:0}#suggesstion-box .search-list-inner-data ul li a,#suggesstion-box-location .search-list-inner-data ul li a{color:#000}#suggesstion-box .search-list-inner-data ul li a:hover,#suggesstion-box-location .search-list-inner-data ul li a:hover{color:#3cc3c1}#suggesstion-box-location #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}.directory-listings-search #suggesstion-box #agency-list{left:-18px;min-width:290px;border-top-left-radius:5px}.directory-listings-search #suggesstion-box #agency-list li,.directory-listings-search #suggesstion-box-location #agency-list li{transition:all .25s ease-in-out}.directory-listings-search #suggesstion-box #agency-list>li:not(.search-list-inner-data):hover,.directory-listings-search #suggesstion-box-location #agency-list>li:not(.search-list-inner-data):hover{padding-left:10px;color:#fff;background-color:#3cc3c1}.directory-listings-search #suggesstion-box #agency-list li,.directory-listings-search #suggesstion-box-location #agency-list li{padding-bottom:0}.directory-listings-search #suggesstion-box #agency-list>li,.directory-listings-search #suggesstion-box-location #agency-list>li{padding-bottom:0;margin-bottom:5px}.testimonial-block-cnt{overflow-x:hidden}.testimonial-block-cnt .slick-next{right:30px}@media (max-width:991px){.directory-listings-search #suggesstion-box #agency-list{left:0;right:0}}

</style>

</head>
<body class="page_inde">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    
    <div class="slider-banner-main">
        <!-- Swiper-->
        <section class="section swiper-container swiper-slider swiper-slider-4" data-loop="true" data-autoplay="5000">
            <div class="swiper-wrapper context-dark">
                <?php 
                foreach ($slider as $sliders) 
                { 
                    $image_path     = $sliders->slider_image;

                    $prd_exist = UPLOAD_DIR.SLIDER_IMG.$image_path;

                    if(file_exists($prd_exist) && $image_path!="") 
                    {
                        $prd_preview = base_url().UPLOAD_DIR.SLIDER_IMG.$image_path;
                    } 
                    else 
                    {
                        $prd_preview = base_url().UPLOAD_DIR.'default.png';
                    }
                ?>
                <div class="swiper-slide swiper-slide-1" data-slide-bg="<?=$prd_preview;?>">
                    <div class="swiper-slide-caption section-md text-sm-left">
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- Swiper Pagination-->
            <div class="swiper-pagination"></div>
            <!-- Swiper Navigation-->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </section>
        <div class="directory-listing-form">
            <h1>Discover <br> Your Amazing City</h1>
            <div class="directory-listings-search" style="max-width: 700px; margin-left: auto; margin-right: auto;">
                <form>
                    <!-- <div class="row"> -->
                        <div class="">
                            <div class="form-group">
                                <label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
                                <input type="text" id="keywords" name="keywords" placeholder="Type in service or location you want." class="form-control" autocomplete="off">
                                <div id="suggesstion-box" class="suggest"></div>
                            </div>
                        </div>
                       
                    <div class="directory-search-btn">
                        <!--<button type="button" class="btn btn-primary">Geolocation <i class="fad fa-location"></i></button>-->
                        <button type="button" class="btn btn-primary seach_filter_block">Filter <i class="fal fa-filter"></i></button>
                        <button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search srch_button"  aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="stories" class="storiesWrapper"></div>

    <div id="resultList" > </div>
   
    <!-- New Flavors-->
    <section class="section section-xxl bg-default pt-4">
        <div class="container">
            <h2 class="text-transform-capitalize wow fadeScale">Our Gallery</h2>
            <div class="isotope-wrap">
                <div class="isotope-filters">
                    <button class="isotope-filters-toggle button button-sm button-icon button-icon-right button-default-outline" data-custom-toggle=".isotope-filters-list" data-custom-toggle-disable-on-blur="true" data-custom-toggle-hide-on-blur="true"><span class="icon mdi mdi-chevron-down"></span>Filter</button>
                    <div class="isotope-filters-list-wrap">
                        <ul class="isotope-filters-list">
                            <li><a class="active" href="#" data-isotope-filter="*">All</a></li>
                            <li><a href="#" data-isotope-filter="Type 1">Male</a></li>
                            <li><a href="#" data-isotope-filter="Type 2">Female</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row row-30 isotope isotope-custom-1" data-lightgallery="group" id="resultList">
                    <?php 
                    if(!empty($posts))
                    {

                        foreach($posts as $post)
                      {
                        if($post['call_type'] == '1')
                        {
                          $service = "Entertainment Service";
                        }
                        else if($post['call_type'] == '2')
                        {
                          $service = "Escort Service";
                        }
                        else
                        {
                          $service = "Entertainment & Escort";
                        }

                        $city = $post['city_id'];

                        $cite_n = $this->crud->get_column_value_by_id("city","name","id = ".$city);
                        
                        if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$post['profile_image']) && $post['profile_image']!="") 
                        {
                            $profile_image = APP_URL.UPLOAD_DIR.USER_PROFILE_IMG.$post['profile_image'];
                        } 
                        else 
                        {
                            $profile_image = base_url().UPLOAD_DIR.'default.png';
                        }

                        $str = strtolower($post['slug']);
                        $details_url1  = base_url()."user/details/".$str."/";

                        if($post['gender'] == 'male')
                        {
                        ?>

                        <div class="col-sm-6 col-lg-4 col-xl-3 isotope-item" data-filter="Type 1">
                            <article class="thumbnail-classic block-1">
                                <a href="<?= $details_url1 ?>" data-id="<?= md5($post['id']) ?>" data-action="<?= $details_url1 ?>" id="flashing">
                                    <div class="thumbnail-classic-figure"><img src="<?= $profile_image ?>" alt="<?=ucwords($post['fname'].' '.$post['lname']);?>" width="270" height="530" />
                                    </div>
                                    <div class="thumbnail-classic-caption">
                                        <div>
                                            <h5 class="thumbnail-classic-title"><?= $post['fname'].' '.$post['lname'] ?> <br> <?= $service; ; ?> <br> <?= $cite_n ?></h5>
                                        </div>
                                    </div>
                                    <div class="ribbon-wrapper-green">
                                      <div class="ribbon-green">New</div>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <?php
                        

                        }
                        elseif($post['gender'] == 'female')
                        {
                        ?>
                            <div class="col-sm-6 col-lg-4 col-xl-3 isotope-item" data-filter="Type 2">
                                <article class="thumbnail-classic block-1">
                                    <a href="<?= $details_url1 ?>" data-id="<?= md5($post['id']) ?>" data-action="<?= $details_url1 ?>" id="flashing">
                                    <div class="thumbnail-classic-figure"><img src="<?= $profile_image ?>" alt="<?=ucwords($post['fname'].' '.$post['lname']);?>" width="270" height="530"/>
                                    </div>
                                    <div class="thumbnail-classic-caption">
                                        <div>
                                            <h5 class="thumbnail-classic-title"><p  style="color: #01fffb;">Click here on image to view the profile.</p><?= $post['fname'].' '.$post['lname'] ?> <br> <?= $service; ; ?> <br> <?= $cite_n ?></h5>
                                        </div>
                                    </div>
                                    <div class="ribbon-wrapper-green">
                                        <div class="ribbon-green">New</div>
                                        </div>
                                    </a>
                                </article>
                            </div>

                        <?php
                        }

                      }

                    }
                    ?>
                </div>

                <p class="text-center"><a href="<?php echo base_url("gallery/male")?>" class="btn btn-primary mr-2"><i class="fas fa fa-eye"></i> View more</a></p>
            </div>
        </div>
    </section>
    <!-- Services-->

    <section class="section section-xxl bg-image-1">
        <div class="container">
            <div class="row row-xl row-30 row-md-40 row-lg-50 align-items-center">
                <div class="col-lg-12">
                    <h2 class="text-transform-capitalize wow fadeScale" style="visibility: visible; animation-name: fadeScale;">Our Adult Services</h2>
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="row row-30 row-md-40 row-lg-50 bordered-2">
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-right wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Female strippers</h4>
                                        <p class="box-icon-classic-text">The best female strippers in Ireland and Northern IrelandWe value professionalism and quality, so ou...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-right wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Male strippers</h4>
                                        <p class="box-icon-classic-text">The best male strippers in Ireland and Northern Ireland We value professionalism and quality, so ou...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-right wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Female kissograms</h4>
                                        <p class="box-icon-classic-text">The best female kissograms in Ireland and Northern Ireland We value professionalism and quality, so...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xl-4 d-none d-md-block wow fadeScale" style="visibility: visible; animation-name: fadeScale;"><img src="<?=FRONT_ASSETS?>images/lady-main.png" alt="lady main" width="399" height="407">
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="row row-30 row-md-40 row-lg-50 bordered-2">
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-left wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Male kissograms</h4>
                                        <p class="box-icon-classic-text">The best male kissograms in Ireland and Northern Ireland We value professionalism and quality, so o...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-left wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Topless butlers</h4>
                                        <p class="box-icon-classic-text">The best topless butlers in Ireland and Northern Ireland We value professionalism and quality, so o...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <article class="box-icon-classic box-icon-nancy-right text-center text-lg-left wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                                <div class="unit flex-column flex-lg-row-reverse">
                                    <div class="unit-body">
                                        <h4 class="box-icon-classic-title">Packages</h4>
                                        <p class="box-icon-classic-text">The best customized and standard offer of packages in Ireland and Northern Ireland Coffee’n Cream o...</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="home-bannner-content">
        <?php if($image != ''){
            foreach ($image as $images) {

        ?>
        <section class="section section-xxl bg-image-1 block-about-home p-0">
            <div class="col-lg-6">
                <p><?= $images->description ?> </p>
            </div>
            <div class="col-lg-6">
                <div class="backgound-image-block" style="background-image: url(public/front/assets/images/block-img.jpg);" ></div>
            </div>
        </section>
        <?php       
        }
        }
        ?>
    </div>
    <section class="section section-xxl testimonial-block-cnt">
        <div class="container">
            <h2 class="text-transform-capitalize wow fadeScale">What People Say</h2>
            <div class="row row-sm row-30 justify-content-center">
                <div class="col-xl-9">
                    <div class="slick-quote">
                        <!-- Slick Carousel-->
                        <div class="slick-slider carousel-parent" id="carousel-parent" data-autoplay="true" data-swipe="true" data-items="1" data-child="#child-carousel" data-for="#child-carousel">
                            <?php 
                            foreach ($descr as $value) { 
                              $image_path     = $value->page_image;

                          $prd_exist = UPLOAD_DIR.SLIDER_IMG.$image_path;

                          if(file_exists($prd_exist) && $image_path!="") 
                          {
                              $prd_preview = base_url().UPLOAD_DIR.SLIDER_IMG.$image_path;
                          } 
                          else 
                          {
                              $prd_preview = base_url().UPLOAD_DIR.'default.png';
                          }
                            ?>
                            <div class="item">
                                <p class="quote-minimal-text"><?= $value->description ?></p>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="slick-quote-nav">
                            <div class="slick-slider child-carousel" id="child-carousel" data-arrows="true" data-for="#carousel-parent" data-items="1" data-sm-items="1" data-md-items="3" data-lg-items="3" data-xl-items="3" data-xxl-items="3">
                                <?php foreach ($descr as $value) {  ?>
                                <div class="item">
                                    <div class="quote-minimal-figure"><img src="<?= $prd_preview ?>" alt="<?=ucwords($value->name." ".$value->designation);?>" width="87" height="87"/>
                                    </div>
                                    <div class="quote-minimal-author"><?= $value->designation ?></div>
                                    <div class="quote-minimal-status"><?= $value->name ?></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script type="text/javascript">
function searchFilter()
{
    $("#suggesstion-box").hide();
    $("#resultList").html("");
    getRecords(0);
}

function getRecords() 
{
    
  var keywords            = $('#keywords').val();
//   var keyword_location    = $('#keyword_location').val();

  $.ajax({
    type : 'POST',
    url : baseURL+'Home/home_search/',
    data:'keywords='+keywords,
    beforeSend: function(){
      $(".loading-div").show();
    },
    success:function(html) 
    {
        setTimeout(function(){
            $(".loading-div").hide();
            $('#resultList').append(html);
        },1500);
    }
  });
}
var website_slug = 'ireland';
    var ajax_base_data = {
    'ea_language_code' : 'en'
};
</script>
<script src="<?php echo SNAP_DIST;?>zuck.min.js"></script>
<script src="<?php echo SNAP_DEMO;?>script.js"></script>

<script>
var currentSkin = getCurrentSkin();
var response = $.ajax({ type: "GET",   
                        url: baseURL+"CommonController/get_story/",   
                        async: false
                      }).responseText;
    var response = JSON.parse(response)
    // console.log(response[0])

var stories = new Zuck('stories',{
    skin: "snapgram",
    avatars: !0,
    list: !1,
    openEffect: !0,
    cubeEffect: !1,
    autoFullScreen: !1,
    backButton: !0,
    backNative: !0,
    previousTap: !0,
    localStorage: !0,
    reactive: !1,
    rtl: !1,
    stories: response

});

function stroy(){
    $.ajax({
        url: baseURL+"CommonController/get_story/",
        type: 'GET',
        success: function(res) {
        var d = JSON.parse(res)
        d.map(function (story) { 
            return story
        });            
        }
    });

    $.get(baseURL+"CommonController/get_story/", function(data, status){
        return data[0];
    })
}
/* Story Section Slider */
	const scroll = document.querySelector(".storiesWrapper ");
	var isDown = false;
	var scrollX;
	var scrollLeft;

	scroll.addEventListener("mouseup", () => {
		isDown = false;
		scroll.classList.remove("active");
	});

	scroll.addEventListener("mouseleave", () => {
		isDown = false;
		scroll.classList.remove("active");
	});

	scroll.addEventListener("mousedown", (e) => {
		e.preventDefault();
		isDown = true;
		scroll.classList.add("active");
		scrollX = e.pageX - scroll.offsetLeft;
		scrollLeft = scroll.scrollLeft;
	});

	scroll.addEventListener("mousemove", (e) => {
		if (!isDown) return;
		e.preventDefault();
		var element = e.pageX - scroll.offsetLeft;
		var scrolling = (element - scrollX) * 2;
		scroll.scrollLeft = scrollLeft - scrolling;
	});

    //Touch ipad
    $(".isotope-item").on("click touchend", function(e) {
	var el = $(this);
    });

        
       
    //------------- Keywords suggesstion -------------------//
        
    $("#suggesstion-box").hide();

    $("#keywords").keyup(function(){
        $.ajax({
            type: "POST",
            url: baseURL+'CommonController/getServicesList/',
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
    
    //----- End Keywords ------//




</script>


</body>      
</html>