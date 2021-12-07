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
<style>
    /* common */
.ribbon{width:100px;height:100px;overflow:hidden;position:absolute}.ribbon::after,.ribbon::before{position:absolute;z-index:-1;content:'';display:block;border:3px solid #1eb5ff}.ribbon span{position:absolute;display:block;width:165px;padding:5px 0;background-color:#1eb5ff;box-shadow:0 5px 10px rgba(0,0,0,.1)}.wdp-ribbon{display:inline-block;padding:2px 15px;position:absolute;right:0;top:20px;line-height:24px;height:24px;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;border-radius:0;text-shadow:none;font-weight:400;background-color:#1eb5ff!important}.wdp-ribbon-two:before{display:inline-block;content:"";position:absolute;left:-14px;top:0;border:9px solid transparent;border-width:14px 8px;border-right-color:#1eb5ff}.wdp-ribbon-two:before{border-color:#1eb5ff;border-left-color:transparent!important;left:-9px}.wdp-ribbon-six{background:0 0!important;position:relative;box-sizing:border-box;position:absolute;width:65px;height:65px;top:0;right:0;padding:0;overflow:hidden}.wdp-ribbon-inner-wrap{-ms-transform:rotateX(0) rotateY(0) rotateZ(0);-webkit-transform:rotateX(0) rotateY(0) rotateZ(0);transform:rotateX(0) rotateY(0) rotateZ(0)}.wdp-ribbon-border{width:0;height:0;border-right:51px solid #000;border-bottom:47px solid transparent;z-index:12;position:relative;top:-31px}.wdp-ribbon-text{font-size:11px;color:#fff;font-weight:900;line-height:13px;position:absolute;z-index:14;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg);top:9px;left:-1px;width:93px;text-align:center}#suggesstion-box .search-list-inner-data label{position:relative;font-size:12px;color:#fff;top:0;background-color:#000;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500}#suggesstion-box .search-list-inner-data ul{padding-left:15px;padding-top:10px}#suggesstion-box #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}#suggesstion-box-location .search-list-inner-data label{position:relative;font-size:12px;color:#fff;top:0;background-color:#000;max-width:100%;display:inline-block;padding:4px 8px;border-radius:11px;font-weight:500}#suggesstion-box-location .search-list-inner-data ul{padding-left:15px;padding-top:10px}#suggesstion-box-location #agency-list::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar{width:6px;background-color:rgba(0,0,0,.5)}#suggesstion-box-location #agency-list::-webkit-scrollbar-thumb{background-color:#3cc3c1}.parallax-content{z-index:99}
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
                        <h1><?=$pageTitle1;?></h1>
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
                if($service_id != "")
                {
                    $url = base_url('service/').$this->slug->create_slug($pageTitle1);
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
                    <ul class="mt-5 list-main-location list-custom-location-main" id="locationResultList"></ul>
                    <?php
                    if($location_total_record > $location_onpage_record){ ?>
                        <p class="text-center"><button class="btn btn-primary" id="location_load_more" data-val="0" type="button" style="display: none;"> Load more</button></p>
                    <?php }?> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <section class="section bg-default text-md-left block-profile-main block-img-full">
        <div class="container">
            <ul id="resultList"></ul>
            <?php if($total_record > $onpage_record){ ?>
                <p class="text-center"><button class="btn btn-primary" id="load_more" data-val="0" type="submit" style="display: none;"><i class="fa fa-user-plus" aria-hidden="true"></i> More <?= $btnname ?></button></p>
            <?php } ?> 
        </div>
    </section>
    
   <?php 
    if(isset($state_id) || isset($country_id))
    {
    ?>
    <section class="section bg-default list-type-diff mb-5 p-0">
        <div class="container">
            <?php if($country_id != ''){ ?>
            <div class="col-xs-12 col-sm-12">
                <div class="panel-home panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="text-transform: capitalize;">&#xFEFF;<?=$curr_location_name." ".$pageTitle1;?></h2><br>
                    </div>
                    <div class="panel-body text-justify">
                        <p><?=$curr_location_desc;?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
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


<script>
    
</script>

<script type="text/javascript">

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

function getRecords(page_num) 
{
    var state_id            = '<?php echo $state_id; ?>';
    var country_id          = '<?php echo $country_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var service_id          = '<?php echo $service_id; ?>';
    var total_record        = '<?php echo $total_record; ?>';
    var onpage_record       = '<?php echo $onpage_record;?>';
    var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record       = parseInt(total_record) - parseInt(curr_disp);
    var keywords            = $('#keywords').val();
    

    $.ajax({
        type : 'POST',
        url : baseURL+'ServicesController/serviceListajaxPaginationData/',
        data:'page='+page_num+'&service_id='+service_id+'&keywords='+keywords+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
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


function getRecords1() 
{
    var state_id            = '<?php echo $state_id; ?>';
    var country_id          = '<?php echo $country_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var service_id          = '<?php echo $service_id; ?>';
    var total_record        = '<?php echo $total_record; ?>';
    var keywords            = $('#keywords').val();
    var keyword_location    = $('#keyword_location').val();

    $.ajax({
        type : 'POST',
        url : baseURL+'ServicesController/serviceListajaxPaginationData1/',
        data:'service_id='+service_id+'&keywords='+keywords+'&keyword_location='+keyword_location+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
        success:function(html) 
        {
            setTimeout(function(){
                $(".loading-div").hide();
                $('#resultList1').append(html);
            },1500);
        }
    });
}

function getLocationRecords(page_num) 
{
    var state_id            = '<?php echo $state_id; ?>';
    var country_id          = '<?php echo $country_id; ?>';
    var service_id          = '<?php echo $service_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var total_record        = '<?php echo $location_total_record; ?>';
    var onpage_record       = '<?php echo $location_onpage_record;?>';
    var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record       = parseInt(total_record) - parseInt(curr_disp);
    // alert(city_id);
    $.ajax({
        type : 'POST',
        url : baseURL+'ServicesController/locationListajaxPaginationData/',
        data:'page='+page_num+'&service_id='+service_id+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
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
    var service_id = '<?php echo $service_id ?>';
    $.ajax({
        type: "POST",
        url: baseURL+'CommonController/getServicesList/',
        data:'keyword='+$(this).val()+'&service_id='+service_id,
        
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
   