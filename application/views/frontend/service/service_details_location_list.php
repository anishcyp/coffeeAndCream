<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$onpage_record      = 10;
$location_onpage_record = 8;
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>

  <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
    <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<body class="">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
  
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="material-parallax"></div>
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
                    <li class="active"><?=$pageTitle;?></li>
                </ul>
            </div>
        </div>
    </section>
    
    <section class="section section-xl bg-default text-md-left block-profile-main" style="padding: 0;">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
                <h4>Cities Profiles</h4>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <ul id="resultList">
                        
                    </ul>

                    <?php if($total_record > $onpage_record){ ?>
                        <p class="text-center"><button class="btn btn-primary" id="load_more" data-val="0" type="button" style="display: none;">Load more</button></p>
                    <?php } ?> 
                </div>
            </div>
        </div>
    </section>

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

    $("#load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getRecords(page);
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
    var total_record        = '<?php echo $total_record; ?>';
    var onpage_record       = '<?php echo $onpage_record;?>';
    var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record       = parseInt(total_record) - parseInt(curr_disp);
    var keywords            = $('#keywords').val();

    $.ajax({
        type : 'POST',
        url : baseURL+'ServicesController/serviceListajaxLocationData/',
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


</script>
</body>
</html>
   