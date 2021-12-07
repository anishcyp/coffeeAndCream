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
                        <!-- <div class="directory-listings-search">
                            <form id="service_search" class="service_search" method="post" action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="form-group">
                                            <label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
                                            <input type="text" id="keywords" name="keywords" placeholder="Whar are you looking for?" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-location-arrow" aria-hidden="true"></i></label>
                                            <input type="text" id="keyword_location" name="keyword_location" placeholder="Location" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="directory-search-btn">
                                    <button type="button" class="btn btn-primary">Geolocation <i class="fad fa-location"></i></button>
                                    <button type="button" class="btn btn-primary seach_filter_block">Filter <i class="fal fa-filter"></i></button>
                                    <button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div> -->
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
    <?php
    
    $gallerylists = $this->crud->get_all_with_where('gallery','id','desc',array('status'=>'Y','isDelete'=>0,'user_id'=>$agency_id));
    
    $names = $this->crud->get_column_value_by_id("tbl_customer","agency_name","id = '".$agency_id."'");
    
    ?>
    <section class="slider-profile">
        <div class="slider-profile-main">
            <?php
            if($gallerylists){
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

                    if(file_exists(UPLOAD_DIR.GALLERY_IMG.$image_path) && $image_path!='')  
                    {
                        $ext = pathinfo($image_path, PATHINFO_EXTENSION);
                        $video= array("webm","mkv","flv","gif","m4p","mp4");

                        if (in_array($ext, $video))
                        {
                        ?>
                        <!-- <div class="profile-item">
                            <video width="100" height="100" controls>
                                <source src="<?=$prd_preview;?>">
                            </video>
                        </div> -->
                        <?php
                        }
                        else
                        {
                        ?>
                        <div class="profile-item">
                            <div class="profile-item-inner">
                            <img src="<?=$prd_preview?>" alt="<?=ucwords($names);?>">
                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }
        
            ?>
        </div>
    </section>
  
    <section class="section section-xl bg-default text-md-left block-profile-main">
        <div class="container">
            <div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <ul>
                        <!--  Near located user profile   -->
                        <?php 
                        if(!empty($posts))
                        {
                            foreach($posts as $post)
                            {
                                $id             = $post['id'];
                                $phone          = $post['phone'];
                                $image_path     = $post['profile_image'];
                                $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

                                $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

                                $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                                if(file_exists($prd_exist) && $image_path!="") 
                                {
                                    $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                                } 
                                else 
                                {
                                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                                }

                                $str = strtolower($post['slug']);
                                $details_url1  = base_url()."user/details/".$str."/";
                                ?> 
                                <li class="overlay-link-gallery">
                                    <div class="inner_link">
                                        <a href="<?= $details_url1 ?>">
                                            <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                                            <div class="gallery-content">
                                                <h4><?=$post['fname']." ".$post['lname']?></h4>
                                                <p><?= $city_name ?></p>
                                                <p><?= $names ?></p>
                                            </div>
                                        </a>
                                        <div class="overlay-blocks-open">
                                            <div class="overlay-blocks-open-inner">
                                                <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing" class="title-main">Are you looking for somebody right now? Look for the flashing icon.</a>
                                                <a href="tel:+<?=$phone;?>" class="pulse call-icon-main"><i class="fas fa-phone-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                          
                            }
                            echo '<form name="frm" id="frm" method="post" action="">
                                    <input type="hidden" name="ids" id="ids" />
                                  </form>';
                        }
                        else
                        {
                            echo "<h3>Escorts records not found</h3>";
                        }
                        ?>
                    </ul>
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

$('.slider-profile-main').slick({
    infinite: true,
    dots: false,
    arrows: true,
    centerMode: true,
    centerPadding: '20',
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    autoplay: true,
});

    
</script>
</body>
</html>
   