<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Home Page Banner</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="active">
                            Home Page Banner
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">                
                                    
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Banner</button>
                    
                    <div class="clearfix"></div>
                    <hr>


                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Slider Image</th>
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
            <form role="form" id="form-addhome_page" name="form-addhome_page" method="post"   >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Banner Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">          
                        <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Sub Title</label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Enter Sub Title">
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Slider Image</label>
                                <input type="file" class="filestyle" name="page_image" id="page_image" data-placeholder="No file" required="">
                                <input type="hidden" id="old_page_image" name="old_page_image">
                            </div>
                            <div class="image-errors"></div>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" id="img_label_name"></label>
                                <img id="uploaded_image" class="media-object text-center" style="width: 150px; height: auto;">
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
        $("#img_label_name").html("");
        $("#uploaded_image").attr('src','');
        $("#old_page_image").val("");
    });

    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>HomepageController/ajax_home_page_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 0, "orderable": false },
                {"targets": 3, "orderable": false }
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
                $("#editid").val(response.id);
                var status = response.status == 'Y' ? true :  false;
                $("#img_label_name").html("Uploaded Image");
                $("#uploaded_image").attr('src','<?php echo APP_URL.UPLOAD_DIR.SLIDER_IMG ?>'+response.slider_image);
                $("#old_page_image").val(response.slider_image);
                $("#isApproved").html(status);
                $("#isActive").prop('checked',status);
                
            }
        });
                  
    });


    $('#form-addhome_page').validate({ // initialize the plugin
         rules:{
            title :{ required : true },
            sub_title :{ required : true },
            page_image:{ required: check_is_add_or_edit  },
            
          },
          messages:{
            title :{ required : "Title is required" },
            sub_title :{ required : "Sub Title is required" },
            page_image :{ required : "Please upload image." },
            
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('home_page') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo ADMIN_LINK; ?>HomepageController/insertRecord',
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
                    $('#form-addhome_page')[0].reset();
                },
                error: function(){
                  
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
</script>