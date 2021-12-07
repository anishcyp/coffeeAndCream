<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id         = $blog_details['blog_id'];
$content    = $blog_details['content'];
$title      = $blog_details['title'];
$date       = $blog_details['blog_date'];
$meta_des   = $blog_details['meta_des'];
$created_at = date("M d, Y",strtotime($blog_details['created_at']));
$image_path = $blog_details['blog_image'];
$prd_exist  = UPLOAD_DIR.BLOG_IMG.$image_path;

if(file_exists($prd_exist) && $image_path!="") 
{
    $prd_preview = base_url().UPLOAD_DIR.BLOG_IMG.$image_path;
} 
else 
{
    $prd_preview = base_url().UPLOAD_DIR.'default.png';
}

$details_url = base_url()."blog/details/".md5($id)."/";
$dis_author  = $blog_details['author'];

$dis_cate = $this->crud->get_column_value_by_id("blog_category","name","id='".$blog_details['blog_cate']."'");
$dis_comments = $this->crud->total_record("blog_comment",array("blog_id" => $blog_details['blog_id'],"isDelete" => 0, "status" => 'Y'));
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
  <meta name="description" content="<?= $meta_des ?>">

  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />

  <meta property="og:title" content="<?= $title ?>" />
  <meta property="og:description" content="<?= $meta_des ?>" />
  <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

  <meta property="og:site_name" content="Coffee & Strippers" />
  <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
  <meta property="og:image:width" content="1457" />
  <meta property="og:image:height" content="461" />

  <meta name="twitter:card" content="<?= $prd_preview ?>" />
  <meta name="twitter:image" content="<?= $prd_preview ?>" />

  <meta name="twitter:title" content="<?= $title ?>" />
  <meta name="twitter:description" content="<?= $meta_des ?>" />

  <?php $this->load->view(FRONTEND."include/include_css"); ?>
  <link href="<?php echo FRONT_ASSETS?>css/blog.css" rel="stylesheet">
  <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>"
  },
  "headline": "<?php echo $title ?>",
  "description": "<?php echo $meta_des ?>",
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo $prd_preview ?>",
    "width": "1030",
    "height": "737"
  },
  "author": {
    "@type": "Organization",
    "name": "Coffee & Cream"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Coffee & Cream",
    "logo": {
      "@type": "ImageObject",
      "url": "https://stripperpartybus.com/public/front/images/logo/logo.png",
      "width": "600",
      "height": "60"
    }
  },
  "datePublished": "<?php echo $date ?>",
  "dateModified": "<?php echo $date ?>"
  
}
</script>

</head>
<body>
  <?php $this->load->view(FRONTEND."include/menu"); ?> 
<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
    <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
      <div class="container">
        <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 60px;"><?=$pageTitle;?></h1>
        <h5 class="breadcrumbs-custom-text">
        </h5>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="<?= base_url('') ?>">Home</a></li>
        <li><a href="<?= base_url('blog') ?>">Blog</a></li>
        <li class="active"><?=$pageTitle;?></li>
      </ul>
    </div>
  </div>
</section>
   
<section class="section section-xl bg-default text-md-left">
    <div class="container">
        <div class="row row-50 row-md-60">
            <div class="col-lg-8 col-xl-9">
                <div class="inset-xl-right-100">
                  <div class="row row-50 row-md-60 row-lg-80">
               
                    <div class="col-12"> 
                      <div class="row row-30">
                        <div class="col-sm-12">
                          <!-- Post Classic-->
                          <article class="post post-classic box-md"><a class="post-classic-figure post-ads" href="javascript:void(0)"><img src="<?= $prd_preview ?>" alt="" width="370" height="239"></a>
                            <div class="post-classic-content">
                              <h3 class="post-classic-title"><?= $title ?></h3>
                             
                              <a href="javascript:void(0);"><i class="far fa-folder"></i> <?php echo $dis_cate;?></a>&nbsp;&nbsp;
                              <a href="javascript:void(0);"><i class="fal fa-calendar"></i> <?php echo $created_at;?></a>&nbsp;&nbsp;
                              <a href="javascript:void(0);"><i class="fal fa-user"></i> <?php echo $dis_author;?></a>&nbsp;&nbsp;
                              <a href="javascript:void(0);"><i class="fal fa-comment"></i> (<?=$dis_comments?>) Comments</a>&nbsp;&nbsp;
                              <div class="post-content">
                                <p><span style="font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;"><?= $content ?></span><br></p>
                              </div>
                            </div>
                          </article>
                        </div>
                      </div>
                    </div>
                 
                  </div>
                </div>
                <br>
                <div id="comments">
                    <h5>Comments</h5>
                    <ul id="comment_history">
                        
                    </ul>
                    <ul id="comment_button" style="display: none;">
                        <li>
                            <button type="button" id="load_more" data-val="0" class="btn_1 add_bottom_15">view more</button> 
                        </li>
                    </ul>
                </div>
                <br><br>
                <hr>
                <br>
                    <h5>Leave a comment</h5>
                    <br>

                    <form action="javascript:void(0);" method="post" name="myForm" id="myForm">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="6" placeholder="Type your comment..."></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="blog_id" id="blog_id" value="<?php echo $id;?>">
                            <input type="hidden" name="type" id="type" value="add">
                      
                            <button class="button button-lg button-primary button-zakaria" name="submit" id="submit" type="submit">Submit</button>
                        </div>
                    </form>


            </div>
            <?php $this->load->view(FRONTEND."include/blog_rightside"); ?>
        </div>
    </div>
</section>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        view_comment(0);
        $("#load_more").on("click",function(e){
            e.preventDefault();
            var page = $(this).attr('data-val');
            view_comment(page);
            alert('j');
        });
    });

    function view_comment(page)
    {
      var id = '<?php echo $id; ?>';

        $.ajax({
            type: "POST",
            cache: false,
            url: baseURL + 'BlogController/viewComment',
            data: "blog_id="+id+"&page="+page,
            dataType: 'json',
            success: function(result) 
            {
                if(result['msg']=="Something_Wrong")
                {
                    $("#comment_button").hide();
                }
                else if(result!='null' && result!='')
                {
                    var dis_html= "";
                    var luser = '<?php echo ($this->session->userdata('front_UserId')) ? $this->session->userdata('front_UserId') : '0';?>';
                    var total_count     = result[0]['tot_count'];
                    for (i = 0; i < result.length; ++i) 
                    {
                        var type        = result[i].type;
                        var nm          = result[i].nm;
                        var dt          = result[i].dt;
                        var msg         = result[i].msg;
                        var uid         = result[i].uid;
                        var dis_img     = result[i].user_img;
                        var url         = result[i].user_url;

                        if(type==0)
                        {
                            dis_html+= '<li><div class="avatar"><a href="javascript:void(0);"><img src="'+dis_img+'" alt=""></a></div><div class="comment_right clearfix"><div class="comment_info">By <a href="'+url+'">'+nm+'</a><span>|</span>'+dt+'</div><p>'+msg+'</p></div></li>';
                        }
                        else
                        {
                            
                        }
                    }

                    $('#comment_history').append(dis_html);
                    $("#comment_button").show();
                    var new_count = parseInt($('#load_more').attr('data-val')) + parseInt(1);
                    $('#load_more').attr('data-val',new_count);

                    var displayed_record = parseInt(new_count) * 10;

                    if(total_count <= displayed_record)
                    {
                        $('#load_more').hide();
                    }
                }
                else
                {
                    dis_html = '';
                }
     
                
            }
        });
    }

    $('#myForm').validate({ // initialize the plugin
      rules:{
         message :{ required : true },
      },
      messages:{
         message :{ required : "Please enter your comment." },
      },
      errorPlacement: function(error, element) {
                        
        if (element.attr('name') == 'message')
        {
            error.insertAfter("#message");
        }
        else 
        {
            error.insertAfter(element);
        }                     
      },
      submitHandler: function (form) 
      {
        var formData = new FormData($(form)[0]);
        
        $.ajax({
            url : baseURL+'BlogController/saveComment/',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            success: function (response) 
            {
               if(response['msg']=="invalid_data")
               {
                    $.notify({message: 'Please enter your comment.'},{ type: 'danger'});
               }
               else if(response['msg']=="success_insert")
               {
                    $.notify({message: 'Your comment is under review, once is approved it will be appear.'},{ type: 'success'});
               }
               else if(response['msg']=="something_wrong")
               {
                    $.notify({message: 'Something went wrong...Please try again.'},{ type: 'danger'});
               }
               else if(response['msg']=="login")
               {
                    window.location = "<?php echo base_url(); ?>SignIn";
                    /*$.notify({message: 'Something went wrong...Please try again.'},{ type: 'danger'});*/
               }
               
               $('#myForm')[0].reset();
            },
            error: function()
            {
              $.notify({message: 'Something went wrong...Please try again.'},{ type: 'danger'});
            }
        });
        return false;
       }
    });
</script>
</body>
</html>