<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage Service </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="active">
                            Manage Service
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">                
                                    
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Service</button>
                    
                    <div class="clearfix"></div>
                    <hr>


                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Service Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- container -->

</div>




<div id="addpopUpmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form-addService" name="form-addService" method="post"   >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Service Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                        <div class="form-group col-md-6">
                            <label>Is Display Menu ? </label>
                            <div class="radio">
                                <input type="radio" name="add_menu" id="add_menu_yes" value="1" required="">
                                <label for="add_menu_yes">Yes</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="add_menu" id="add_menu_no" value="0">
                                <label for="add_menu_no">No</label>
                            </div>                    
                        </div>            

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Service Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Service Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Add Image</label>
                            <input type="file" class="filestyle" name="page_image" id="page_image" data-placeholder="No file" required="">
                            <input type="hidden" id="old_page_image" name="old_page_image">
                        </div>
                        <div class="image-errors"></div>
                        </div>


                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" id="img_label_name"></label>
                                <img id="uploaded_image" class="media-object text-center" style="width: 150px; height: auto;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Service Meta Title</label>
                                <input type="text" class="form-control" id="service_meta_title" name="service_meta_title" placeholder="Enter Service Meta Title">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Service Meta Description</label>
                                <input type="text" class="form-control" id="service_meta_description" name="service_meta_description" placeholder="Enter Service Meta Description">
                            </div>
                        </div>
                
                        <div class="col-md-6">
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
                <div class="modal-footer">
                      <input type="hidden" id="type" name="type" value="add">
                      <input type="hidden" id="editid" name="editid">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary btn-submit" value="Submit" />
                      <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<!-- Jquery validation -->
<script src="<?php echo BACKEND ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
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
                "url": "<?php echo ADMIN_LINK ?>ServiceController/ajax_service_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 0, "orderable": false },
                {"targets": 4, "orderable": false }
            ],
            "order": [[0, 'desc']],

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
                $("#editid").val(response.service_id);
                $("#name").val(response.name);
                $("#service_meta_title").val(response.service_meta_title);
                $("#service_meta_description").val(response.service_meta_description);
                var status = response.status == 'Y' ? true :  false;
                $("#img_label_name").html("Uploaded Image");
                if(response.service_type == '1'){
                    $("#entertainment_services").prop("checked", true);
                }else{
                    $("#escort_services").prop("checked", true);
                }
                if(response.is_dis_on_menu == '1'){
                    $("#add_menu_yes").prop("checked", true);
                }else{
                    $("#add_menu_no").prop("checked", true);
                }
                $("#uploaded_image").attr('src','<?php echo APP_URL.UPLOAD_DIR.SERVICE_ICON ?>'+response.service_icon);
                $("#old_page_image").val(response.service_icon);
                $("#isApproved").html(status);
                $("#isActive").prop('checked',status);
                
            }
        });
                  
    });


    $('#form-addService').validate({ // initialize the plugin
         rules:{
            name :{ required : true },
            page_image:{ required: check_is_add_or_edit  },
            
          },
          messages:{
            name :{ required : "Service is required" },
            page_image :{ required : "Please upload image." },
            
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('service') ?>');
            formData.append('i', '<?php echo base64_encode('service_id') ?>');
            $.ajax({
                url: '<?php echo ADMIN_LINK; ?>ServiceController/insertRecord',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'json',
                success: function (response) 
                {
                    swal(response.msg);

                    $('#datatable-scroller').DataTable().ajax.reload();
                    $('#addpopUpmodal').modal('hide');
                    $('#form-addService')[0].reset();
                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
          }
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

$(document).on("click",".rowDeleted",function(){

    var id = $(this).attr("data-id");             
    var field = $(this).attr("data-i");             
    var table = $(this).attr("data-td");  
    
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel Please!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        
        if (isConfirm) {
            
            $.ajax({
                  url: baseURL+'CommonController/deleteDataPlan',
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
                      swal("Deleted!", "Record has been deleted successfully", "success");
                  }
            });
        }
    });                   
});

</script>