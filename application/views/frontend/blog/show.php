<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$dis_cate_slug = "";
if(isset($cate_slug))
{
  $dis_cate_slug = $cate_slug; 
}

$dis_search_keyword = "";
if(isset($search_keyword))
{
  $dis_search_keyword = $search_keyword; 
}
?>

<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
<link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
<meta name="description" content="Latest Posts: Blog on Strippers, Kissograms Bunny Girls, Hen Parties, Private parties in UK, Ireland, and Northern Ireland.">

<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />

<meta property="og:title" content="Latest Stripper, Kissograms, Hen Party Blogs at Coffee & Cream" />
<meta property="og:description" content="Latest Posts: Blog on Strippers, Kissograms Bunny Girls, Hen Parties, Private parties in UK, Ireland, and Northern Ireland." />
<meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

<meta property="og:site_name" content="Coffee & Strippers" />
<meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:width" content="1457" />
<meta property="og:image:height" content="461" />

<meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
<meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

<meta name="twitter:title" content="Latest Stripper, Kissograms, Hen Party Blogs at Coffee & Cream" />
<meta name="twitter:description" content="Latest Posts: Blog on Strippers, Kissograms Bunny Girls, Hen Parties, Private parties in UK, Ireland, and Northern Ireland." />

<?php $this->load->view(FRONTEND."include/include_css"); ?>

</head>
  
<body class="">    
<?php $this->load->view(FRONTEND."include/menu"); ?>
  
<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
    <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
      <div class="container">
        <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 60px;"><?=$pageTitle;?></h1>
        <h5 class="breadcrumbs-custom-text">
            Here you get the latest adult and entertainment news as well as tips and tricks to help you attract more punters.
          Make sure to leave a comment, to help us know how we are doing and how we can serve you better!
          Click on the image to view the full blog post.
        </h5>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="<?= base_url('') ?>">Home</a></li>
        <li class="active"><?=$pageTitle;?></li>
      </ul>
    </div>
  </div>
</section>

<section class="section section-xl bg-default text-md-left custom-blog-main">
  <div class="container">
    <div class="row row-50 row-md-60">
      <div class="col-lg-8 col-xl-9">
         <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-12">
          <form class="form-inline" action="javascript:void(0);">
            <div class="form-group">
              <label>Rows Limit : &nbsp;</label>
              <select class="form-control" name="PerPage" id="PerPage" onchange="searchFilter()">
                <?php $this->load->view(FRONTEND."include/row_display"); ?>
              </select>
              <?php
              if($dis_search_keyword!="")
              {
              ?>
              <label>&nbsp;Search By : &nbsp;<button class="btn_1 small"><?=rawurldecode($dis_search_keyword);?><a href="<?=base_url("blog")?>" class="cus_small_btn">&nbsp;&nbsp;X</a></button></label>
              <?php
              }
              ?>
            </div>
          </form>
        </div>
      </div>
      <div class="pro-table" id="resultList">
        
      </div>
      </div>
      <?php $this->load->view(FRONTEND."include/blog_rightside"); ?>
    </div>
  </div>
</section>


<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>
    <script type="text/javascript">
      searchFilter(0);
      function searchFilter(page_num) 
      {
        page_num = page_num?page_num:0;
        var perpage = $('#PerPage').val();
        $(".loading").show();
        $.ajax({
            type : 'POST',
            url : baseURL+'BlogController/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&perpage='+perpage+'&keywords=<?php echo $dis_search_keyword;?>&cate_slug=<?php echo $dis_cate_slug;?>',
            beforeSend: function(){
              $(".loading-div").show();
            },
           success:function(html) 
           {
              setTimeout(function(){
                $(".loading-div").hide();
                $('#resultList').html(html);
              },1500);
           }
        });
      }

    //   //------------- Keywords suggesstion -------------------//
        
    // $("#suggesstion-box").hide();

    // $("#search").keyup(function(){
    //     $.ajax({
    //         type: "POST",
    //         url: baseURL+'BlogController/getBlogList',
    //         data:'keyword='+$(this).val(),

    //         success: function(data){
    //             $("#suggesstion-box").show();
    //             $("#suggesstion-box").html(data);
    //         }
    //     });
    // });

    // function Select(name){
    //     $("#search").val(name);
    //     $("#suggesstion-box").hide();
    // }


    </script>

</body>      
</html>

