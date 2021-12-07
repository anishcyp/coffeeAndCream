<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage Our Contact </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="active">
                        Manage Our Contact
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">                
                                    
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Contact</button>
                    
                    <div class="clearfix"></div>
                    <hr>


                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Value 1</th>
                            <th>Value 2</th>
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
            <form role="form" id="form-addlanguage" name="form-addlanguage" method="post"   >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Contact Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Title</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Contact Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Number-1</label>
                                <input type="text" class="form-control" id="number_1" name="number_1" placeholder="Enter Number 1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Number-2</label>
                                <input type="text" class="form-control" id="number_2" name="number_2" placeholder="Enter Number 2">
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
                "url": "<?php echo ADMIN_LINK ?>ContactController/ajax_our_contact_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 0, "orderable": false },
                {"targets": 5, "orderable": false }
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
                $("#name").val(response.name);
                $("#number_1").val(response.number_1);
                $("#number_2").val(response.number_2);
                var status = response.status == 'Y' ? true :  false;
                $("#isApproved").html(status);
                $("#isActive").prop('checked',status);
                
            }
        });
                  
    });


    $('#form-addlanguage').validate({ // initialize the plugin
         rules:{
            name :{ required : true },
            number_1 :{ required : true, digits: true  },
            number_2 :{ required : true, digits: true },
          },
          messages:{
            name :{ required : "Language is required" },
            number_1 :{ required : "Number is required", digits: "Enter valid number"  },
            number_2 :{ required : "Number is required", digits: "Enter valid number"  },
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('our_contact') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo ADMIN_LINK; ?>ContactController/insertRecord',
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
                    $('#form-addlanguage')[0].reset();
                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
          }
    });


</script>