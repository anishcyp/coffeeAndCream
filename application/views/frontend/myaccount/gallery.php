<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>



    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Gallery</h2>
              <h5 class="breadcrumbs-custom-text">
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Gallery</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="diary-list">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <h3>Gallery:</h3>
                  <ul>
                      <li>Upload all the pictures and videos that will be visible on your profile.</li>
                      <li>Ensure you upload high-quality pictures and images because this is what many clients will look at before getting in touch with you.</li>
                      <li>Uploading may take a few minutes.</li>
                      <li>To verify your identity, you will be required to upload a photo that has today’s date and time</li>
                      <li>Please note that failure to do so, your image will not be verified and you will therefore not be able to get punters. </li>
                      <li>Ensure you verify your pictures to get more punters.</li>
                      <li>Remember to save before moving to the next step.</li>
                  </ul>
              </div>
          </div>
        </div>
      </section>

       <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
               <div class="common-blocks-detail">
                 <h4>Gallery</h4>
                  <form id="gallery-page-form" method="post" enctype="multipart/form-data" action="<?= base_url("gallery-store"); ?>">
                      <div class="blocks-information">
                       <div class="form-group">
                        <label class="form-label-custom">File Upload</label>
                        <input type="file" class="form-control" id="gallery_file" name="gallery_file">
                       </div>
                       <input type="hidden" name="type" value="add">
    		             <div class="last-btn-blocks">
    		              <button type="submit" name="submit" id="submit" value="submit" class="button button-lg button-shadow-2 button-primary button-zakaria">Save</button>
    		             </div>
  		              </div>   
                </form>
                  <div class="table-responsive mt-4">
                      <table id="datatable-scroller" class="table table-striped table-info">
                          <thead>
                            <tr>
                                <th width="45%">Uploaded Image</th>
                                <th width="45%">Status</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                      </table>
                  </div>       
               </div>
            </div>
          </div>
      </div>
    </div>
   	<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $("#gallery-page-form").validate({
         ignore: [],
         rules: {              
            gallery_file:{required : true},
         },
         messages: {
            gallery_file : { required:"required upload file" },                    
         }, 
         errorPlacement: function(error, element) {
            error.insertAfter(element);            
         }
      });
   });

$(document).ready(function () {

  $('#datatable-scroller').DataTable({
          "serverSide": true,
          "ordering": true,
          "ajax": {
              type: "POST",
              url: baseURL + "GalleryController/ajaxPaginationDataGallery",
          },            
          "scroller": {
              "loadingIndicator": true
          },
          "columnDefs": [
              {"targets": 2, "orderable": false },
          ]
    });    
});

$(document).on("click",".rowDelete",function(){
    
  var id = $(this).attr("data-id");             
  var field = $(this).attr("data-i");             
  var table = $(this).attr("data-td");  
  if(confirm("Are you sure you want to delete file?")){}
  else{return false;}
  $.ajax({
    url: baseURL+'CommonController/deleteData',
    dataType: "JSON",
    method:"POST",
    data: {
    "id": id,
    "td": table,
    "i": field,
  },
  success: function ()
  {
    $('#datatable-scroller').DataTable().ajax.reload();
    $.notify({message: 'Your file delete successfuly'},{ type: 'success'});
  }
  });
});
</script>
</body>
</html>