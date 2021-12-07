<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">ADD BLOG</h2>
              <h5 class="breadcrumbs-custom-text">
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">ADD BLOG</li>
            </ul>
          </div>
        </div>
      </section>

      <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
                <div class="common-blocks-detail">
                 <h4>ADD BLOG</h4>
                   <form role="form" action="<?= base_url("insertrecord-blog/"); ?>" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <div class="blocks-information"> 
                        

                        
                        <div class="form-group">
                            <label class="form-label-custom">Blog Title</label>  
                            <input type="text" name="title" value="<?= $profile['title'] ?>" id="title" class="form-control" placeholder="Short title for your job" />  
                        </div>
                        
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Blog Description</label>
                            <textarea name="description" id="summernote" class="form-control" ><?= $profile['description'] ?></textarea>
                        </div>

                        <div class="row" >
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Blog Date</label>  
                                <input type="date" name="date" value="<?= $profile['date'] ?>" id="date" class="form-control" />  
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Author name</label>  
                                <input type="text" name="name" value="<?= $profile['name'] ?>" id="name" class="form-control" placeholder="Author name" />  
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Upload (Blog - image)</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                            </div>

                            <input type="hidden" id="old_profile_image" name="old_profile_image" value="<?= $profile['image']; ?>">
                            <div class="form-group col-md-6">
                                <?php if(file_exists(UPLOAD_DIR.BLOG_IMG.$profile['image']) && $profile['image']!='')  { ?>
                                    <img style="width: 119px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.BLOG_IMG.$profile['image']) ?>">  
                                <?php } else{ ?>
                                <?php }  ?> 
                            </div>
                        </div>

                        <?php 
                        if($profile['id'] != "")
                        {
                          $mode = 'edit';
                        }
                        else
                        {
                          $mode = "add";
                        }

                        ?>
                        
                        <input type="hidden" id="type" name="type" value="<?= $mode ?>">
                        <input type="hidden" id="editid" name="editid" value="<?= $profile['id'] ?>">
                        
                    </div>
                  </div>  
                    <div class="last-btn-blocks">
                        <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Submit</button>
                    </div>
                  </form>   
               </div>
            </div>
          </div>
      </div>
    </div>
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script type="text/javascript">

$('#summernote').summernote({
    placeholder: 'Blog Description',
    tabsize: 2,
    height: 100,
});


$('#form-addModels').on('submit', function(e) {
  
  if($('#summernote').summernote('isEmpty')) 
  {
    alert('Description is required')
    e.preventDefault();
  }
})
  



$('#form-addModels').validate({ // initialize the plugin
    rules:{
    services_id :{ required : true },
    title :{ required : true },
    phone_no :{ required : true , number:true},
    work_system : { required : true },
    work_hours : { required : true },
    earnings  : { required : true },
    requirements : { required : true },
    selection : { required : true },
    more_info : { required : true },
    country_id : { required : true },
    state_id : { required : true },
    
    },
    messages:{
        services_id :{ required : "Select service is required" },
    title :{ required : "Title is required" },
    phone_no :{required : "Phone number is required", number: "Please enter numbers Only"},
    work_system : { required : "Work system is required"},
    work_hours : { required : "Working hours is required" },
    earnings : { required : "Earnings is required" },
    requirements : { required : "Requirements is required" },
    selection : { required : "Selection is required" },
    more_info : { required : "More info is required" },
    country_id : { required : "Country is required" },
    state_id : { required : "State is required" },
    },
    
});



function check_is_add_or_edit() 
{
  if($("#type").val()=="add" && $("#page_image").val()=="") 
  {
      return true;
  } 
  else 
  {
      return false;
  }
}

</script>
</body>
</html>