<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$onpage_record      = 16;
$location_onpage_record = 8;

if($type == 'male')
{
    $title = "Male Strippers Images | Kissogram Photos | Stripper Party Bus";
}
else
{
    $title = "Sexy Pic of Female Strippers | Kissograms at Coffee & Cream";
}

?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
    <meta name="description" content="Check out our <?= ucwords($type) ?> entertainer gallery to see how much fun people have had at our previous events! Watch now!">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="<?= $title ?>" /> 
    <meta property="og:description" content="Check out our <?= ucwords($type) ?> entertainer gallery to see how much fun people have had at our previous events! Watch now!" />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />

    <meta name="twitter:title" content="<?= $title ?>" />
    <meta name="twitter:description" content="Check out our <?= ucwords($type) ?> entertainer gallery to see how much fun people have had at our previous events! Watch now!" />
    
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
            <div class="breadcrumbs-custom-body parallax-content context-dark" style="z-index: 2;">
                <div class="container">
                    <div class="directory-listing-form">
                        <h2><?=$pageTitle;?></h2>
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
                <?php
                if($type != "")
                {
                    $url = base_url('gallery/').$this->slug->create_slug($pageTitle1);
                    $path = "<a href='".$url."'>".$pageTitle1."</a>";
                } 
                if($country_id != "")
                {
                    $c_name = $coutry_n;

                    $url .= "/".$this->slug->create_slug($c_name);
                    $path = $path." /<a href='".$url."'>".$c_name."</a>";
                    
                }
                if($state_id != "")
                {
                    $c_name = $coutry_n;
                    $s_name = $state_n;
                    $url .= "/".$this->slug->create_slug($s_name);
                    $path = $path." /<a href='".$url."'>".$s_name."</a>";
                }
                if($city_id != "")
                {
                    $c_name = $coutry_n;
                    $s_name = $state_n;
                    $sy_name = $city_n;

                    $url .= "/".$this->slug->create_slug($sy_name);
                    $path = $path." /<a href='".$url."'>".$sy_name."</a>";
                }
                ?>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?=base_url();?>">Home</a></li>
                    <li class="active"><?=$path;?></li>
                </ul>
            </div>
        </div>
    </section>
    <?php if($location_total_record != "no_more"){ ?>
    <section class="section bg-default list-type-diff mb-5 padding-custom-main">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!-- <h2>Location</h2> -->
                    <ul class="mt-5 list-main-location list-custom-location-main" id="locationResultList">
                        
                    </ul>

                    <?php
                    // echo $location_total_record; exit();
                    if($location_total_record > $location_onpage_record){ ?>
                        <p class="text-center"><button class="btn btn-primary" id="location_load_more" data-val="0" type="button" style="display: none;"> Load more</button></p>
                    <?php }?> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>


    <section class="section bg-default text-md-left block-profile-main block-img-full">
        <h4 class="text-center" style="margin-bottom: revert;"><?= $total_record2 ?></h4>
        <div class="container">
            <!-- <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
                <div class="col-md-12 col-lg-12 col-xl-12"> -->
                    <ul id="resultList">
                        
                    </ul>
                    <?php if($total_record > $onpage_record){ ?>
                        <p class="text-center"><button class="btn btn-primary" id="load_more" data-val="0" type="submit" style="display: none;"><i class="fa fa-user-plus" aria-hidden="true"></i> More <?= $btnname ?></button></p>
                    <?php } ?> 
                <!-- </div>
            </div> -->
        </div>
    </section>

    
    <!-- <section class="section section-xl bg-default text-md-left block-profile-main">
        <h4 class="text-center" style="margin-bottom: revert;"><?= $description_profiles ?></h4>
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <ul id="resultList1">
                        
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    


    <?php 
    if(isset($state_id) || isset($country_id))
    {
    ?>
    <section class="section bg-default list-type-diff mb-5 p-0">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <?php if($country_id != ''){ ?>
                    <h2><?=$curr_location_name." ".$pageTitle;?></h2>
                    <p><?=$curr_location_desc;?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
    }
    ?>

    <!-- footer -->
    <?php $this->load->view(FRONTEND."include/footer"); ?>

    <?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>      
</html>
<script type="text/javascript">

// $(document).on("click","#flashing",function(){

//     var id = $(this).attr("data-id");
//     var action = $(this).attr("data-action");
//     $('#ids').val(id);
//     // alert(action);
//     $('#frm').attr('action', action).submit();
//     document.getElementById("frm").submit();

// });
    
$(document).ready(function(){
    getRecords(0);
    getLocationRecords(0);
    getRecords1();

    $("#load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getRecords(page);
    });

    $("#location_load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getLocationRecords(page);
    });
});

function searchFilter()
{
    $("#resultList").html("");
    getRecords(0);
}

function getRecords1(page_num) 
{
    var state_id        = '<?php echo $state_id; ?>';
    var country_id      = '<?php echo $country_id; ?>';
    var type            = '<?php echo $type; ?>';
    var city_id         = '<?php echo $city_id; ?>';
    var total_record    = '<?php echo $total_record; ?>';
    var onpage_record   = '<?php echo $onpage_record;?>';
    var curr_disp       = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record   = parseInt(total_record) - parseInt(curr_disp);
    var keywords            = $('#keywords').val();
    var keyword_location    = $('#keyword_location').val();

    $.ajax({
        type : 'POST',
        url : baseURL+'GalleryController/galleryListajaxPaginationData1/',
        data:'page='+page_num+'&type='+type+'&country_id='+country_id+'&state_id='+state_id+'&keywords='+keywords+'&keyword_location='+keyword_location+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
       success:function(html) 
       {
          setTimeout(function(){
            $(".loading-div").hide();
            $('#resultList1').append(html);

            var new_count = parseInt($('#load_more').attr('data-val')) + parseInt(0);
            $('#load_more').attr('data-val',new_count);

            if(remain_record <= 0)
            {
              $('#load_more').hide();
            }else{
              $('#load_more').show();
            }

          },1500);


       }
    });
}


function getRecords(page_num) 
{
    var state_id        = '<?php echo $state_id; ?>';
    var country_id      = '<?php echo $country_id; ?>';
    var type            = '<?php echo $type; ?>';
    var city_id         = '<?php echo $city_id; ?>';
    var total_record    = '<?php echo $total_record; ?>';
    var onpage_record   = '<?php echo $onpage_record;?>';
    var curr_disp       = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record   = parseInt(total_record) - parseInt(curr_disp);
    var keywords            = $('#keywords').val();
   

    $.ajax({
        type : 'POST',
        url : baseURL+'GalleryController/galleryListajaxPaginationData/',
        data:'page='+page_num+'&type='+type+'&country_id='+country_id+'&state_id='+state_id+'&keywords='+keywords+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
       success:function(html) 
       {
          setTimeout(function(){
            $(".loading-div").hide();
            $('#resultList').append(html);

            var new_count = parseInt($('#load_more').attr('data-val')) + parseInt(1);
            $('#load_more').attr('data-val',new_count);

            if(remain_record <= 0)
            {
              $('#load_more').hide();
            }else{
              $('#load_more').show();
            }

          },1500);


       }
    });
}

function getLocationRecords(page_num) 
{
    var state_id        = '<?php echo $state_id; ?>';
    var country_id      = '<?php echo $country_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var type            = '<?php echo $type; ?>';
    var total_record    = '<?php echo $location_total_record; ?>';
    var onpage_record   = '<?php echo $location_onpage_record;?>';
    var curr_disp       = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record   = parseInt(total_record) - parseInt(curr_disp);

    $.ajax({
        type : 'POST',
        url : baseURL+'GalleryController/locationListajaxPaginationData/',
        data:'page='+page_num+'&type='+type+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
        success:function(html) 
        {
            setTimeout(function(){
                $(".loading-div").hide();
                $('#locationResultList').append(html);

                var new_count = parseInt($('#location_load_more').attr('data-val')) + parseInt(1);
                $('#location_load_more').attr('data-val',new_count);

                if(remain_record <= 0)
                {
                  $('#location_load_more').hide();
                }else{
                  $('#location_load_more').show();
                }

            },1500);
        }
    });
}


// Keywords suggesstion
        
$("#suggesstion-box").hide();

$("#keywords").keyup(function(){
    var type            = '<?php echo $type; ?>';
    $.ajax({
        type: "POST",
        url: baseURL+'GalleryController/getUsersList/',
        data:'keyword='+$(this).val()+'&type='+type,
        
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