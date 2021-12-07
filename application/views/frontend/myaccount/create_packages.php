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

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Hen stag accommodation </h2>
              <h5 class="breadcrumbs-custom-text">Hen/stag accommodation  
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Hen/stag accommodation</li>
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
               <div class="blocks-information">
                        <div class="last-btn-blocks row">
                        <h4 class="col-md-9">Create Hen Stage Package</h4>
                            <a href="<?= base_url('packages/add') ?>" class="col-md-3 mt-0 button button-lg button-shadow-2 button-primary button-zakaria">
                                Add Package
                            </a>
                        </div>
                    </div>   
                  <div class="table-responsive mt-4">
                      <table id="datatable-scroller" class="table table-striped table-info">
                          <thead>
                            <tr>
                                <th width="">Package name</th>
                                <th width="">Category</th>
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
<!-- Call rates End Here -->
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $("#rates-page-form").validate({
         ignore: [],
         rules: {              
            discription:{required : true},
            rates:{required : true},
         },
         messages: {
            discription : { required:"Please enter description" },
            rates : { required:"Please enter rates" },                       
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
              url: baseURL + "MyAccountController/ajaxPaginationDataPackages",
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
  if(confirm("Are you sure you want to delete file?"))
  {

  }
  else
  {
      return false;
  }
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
          $.notify({message: 'Call record deleted successfully.'},{ type: 'success'});
        }
  });
});
</script>
</body>
</html>