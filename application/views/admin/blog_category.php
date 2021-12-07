<!-- Start content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Blog Category</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="javascript:void(0);">Blog Category</a>
                        </li>
                        <li class="active">
                          Blog Category list
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-12">                
                <div class="card-box table-responsive">
                    <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Blog Category</button>
                    <div class="clearfix"></div>
                    <hr>

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                          <tr>
                              <th>Name</th>
                              <th width="15%">Status</th>
                              <th width="15%">Action</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- content -->

<div id="addpopUpmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title ">Add Blog Category</h4>
            </div>
         
            <form role="form" id="form-addNewRecord" name="form-addNewRecord" method="post"  role="form" enctype="multipart/form-data">

                  <div class="modal-body">  
                        <div class="box-body">
                            <div class="msg"></div>
                            <div class="row">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field-1" class="control-label">Name <code>*</code></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Service Type </label>
                                            <div class="radio">
                                                <input type="radio" name="service" id="entertainment_services" value="1" required="">
                                                <label for="entertainment_services">Entertainment Services</label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="service" id="escort_services" value="2">
                                                <label for="escort_services">Escort Services</label>
                                            </div>                    
                                        </div>
                                    
                                        <div class="form-group">
                                            <div>
                                                <label for="field-2" class="control-label">Active</label>
                                            </div>
                                            <br>
                                            <input type="checkbox" id="isActive" name="isActive"  switch="bool"/>
                                            <label for="isActive" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" id="type" name="type" value="add">
                      <input type="hidden" id="editid" name="editid">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary btn-submit" value="Submit" />
                      <input type="reset" class="btn btn-default" value="Reset" />
                  </div>

            </form>

        </div>
    </div><!-- /.modal -->
</div>
<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo COMMON; ?>validation.js" type="text/javascript"></script>

<script type="text/javascript">
  $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
      $("#type").val('add');
      $("#editid").val();
  });

  $(document).ready(function () {

      $('#datatable-scroller').DataTable({
          "serverSide": true,
          "ordering": true,
          "ajax": {
              "url": "<?php echo ADMIN_LINK ?>BlogController/ajax_datatable_blog_category",
              "type": "POST"
          },            
          "scroller": {
              "loadingIndicator": true
          },
          "columnDefs": [
              {"targets": 1, "orderable": false }
          ]

      });
    
  });


  $(document).on("click",".rowEdit",function(){
        
      $('#addpopUpmodal').modal('show');  
      var id = $(this).attr("data-id");      
      var field = $(this).attr("data-i");             
      var table = $(this).attr("data-td"); 

      $.ajax(
      {
        url: '<?php echo APP_URL ?>CommonController/getEditRecord',
        dataType: "JSON",
        method:"POST",
        data: {
            "id": id,
            "td": table,
            "i": field,
        },
        success: function (response)
        { 
          $("#type").val('edit');
          $("#editid").val(response.id);
          $("#name").val(response.name);
          var status = response.status == 'Y' ? true :  false;
          $("#isApproved").html(status);
          $("#isActive").prop('checked',status);
          if(response.service_type == '1')
          {
                ("#entertainment_services").prop("checked", true);
            }
            else
            {
                $("#escort_services").prop("checked", true);
            }
        }
      });
  });


  $('#form-addNewRecord').validate({ 
     rules:{
        name :{ required : true }
      },
      messages:{
        name :{ required : "Name is required" }
      },
      submitHandler: function (form) 
      {
        var formData = new FormData($(form)[0]);
        formData.append('td', '<?php echo base64_encode('blog_category') ?>');
        formData.append('i', '<?php echo base64_encode('id') ?>');
        $.ajax({
            url: '<?php echo APP_URL; ?>CommonController/insertRecord1',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            success: function (response) 
            {
              //return false;
              swal(response.msg);

              $('#datatable-scroller').DataTable().ajax.reload();
              $('#addpopUpmodal').modal('hide');
              $('#form-addNewRecord')[0].reset();
            }
        });
        return false;
      }
  });
</script>