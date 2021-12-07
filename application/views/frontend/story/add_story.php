<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>



    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Stories</h2>
              <h5 class="breadcrumbs-custom-text">
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Stories</li>
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
                 <h4>Stories</h4>
                  <form id="stories" method="post" enctype="multipart/form-data" action="<?= base_url("stories-store"); ?>">
                      <div class="blocks-information">
                       <div class="form-group">
                        <label class="form-label-custom">File Upload</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                       </div>
                      
                       <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Description</label>
                            <textarea name="description" id="summernote" class="form-control" ></textarea>
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
                                <th width="45%">Files</th>
                                <th width="45%">Upload time</th>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>>

<script type="text/javascript">

  $('#summernote').summernote({
      placeholder: 'Story description',
      tabsize: 2,
      height: 100,
  });

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
              url: baseURL + "MyAccountController/ajaxPaginationDataStory",
          },            
          "scroller": {
              "loadingIndicator": true
          },
          "columnDefs": [
              {"targets": 1, "orderable": false },
          ]
    });    
});

$(document).on("click",".rowDelete",function(){
    
  var id = $(this).attr("data-id");             
  var field = $(this).attr("data-i");             
  var table = $(this).attr("data-td");  
  var user = $(this).attr("data-user");
  if(confirm("Are you sure you want to delete file?")){}
  else{return false;}
  $.ajax({
    url: baseURL+'CommonController/story_delete',
    dataType: "JSON",
    method:"POST",
    data: {
    "id": id,
    "td": table,
    "i": field,
    "user" : user,
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