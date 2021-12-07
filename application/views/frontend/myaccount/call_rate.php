<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
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
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Call Rate</h2>
              <h5 class="breadcrumbs-custom-text">Call rate bullet point 👉  let customers know your prices or you can just put a notice for them to call for more information. Don't forget to save  before moving on next step
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Call Rate</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="diary-list">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Call rate:</h3>
                    <ul>
                        <li>Indicate how much your services will cost.</li>
                        <li>If you are not sure how much to charge, put a notice that lets the clients know they can call youfor more information.</li>
                        <li>Don�t forget to save before moving to the next step.</li>
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
                 <h4>Call Rate</h4>
                  <form id="rates-page-form" method="post" action="<?= base_url("insert-rates/"); ?>">
                    <div class="blocks-information">
                      <div class="form-group">
                        <label class="form-label-custom">Call Type</label>
                        <select name="call_type" id="call_type" class="form-control ">
                            <option value="">Choose call type</option>
                            <option value="In Call">In Call</option>
                            <option value="Out Call">Out Call</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="form-label-custom">Description</label>
                        <textarea class="form-control" id="discription" name="discription" placeholder="Hours"></textarea>
                     </div>
                     <div class="form-group">
                      <label class="form-label-custom">Call Rate</label>
                      <input type="text" class="form-control" id="rates" name="rates" placeholder="Call Rate">
                    </div>
                      <div class="last-btn-blocks">
                        <button type="submit" name="submit" id="submit" value="submit" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                      </div>
                    </div>   
                  </form>
                  <div class="table-responsive mt-4">
                      <table id="datatable-scroller" class="table table-striped table-info">
                          <thead>
                            <tr>
                                <th width="45%">Decscription</th>
                                <th width="45%">Call Rates</th>
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
              url: baseURL + "MyAccountController/ajaxPaginationDataCallRates",
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