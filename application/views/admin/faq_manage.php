<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />

<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">FAQ's list </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li class="active">
                            Faq list
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">                
                                    
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add FAQ</button>
                    
                    <div class="clearfix"></div>
                    <hr>


                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th width="15%">Title</th>
                            <th width="30%">Question</th>
                            <th width="30%">Answer</th>
                            <th width="10%">Status</th>
                            <th width="15">Action</th>
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
            <form role="form" id="form-addCountry" name="form-addCountry"  method="post"   >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add FAQ's Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group">
                            <label for="field-1" class="control-label">Title :</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="control-label">Question :</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question">
                        </div>
                           
                        <div class="form-group">
                              <label>Answer</label>
                              <textarea name="descr" id="descr" class="summernote" required=""></textarea>
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
          $('#descr').summernote('code', '');

    });

    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>ManageLocation/ajax_faq_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 4, "orderable": false },
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
                $("#title").val(response.title);
                $("#question").val(response.question);
                $("#title").val(response.title);
                $('#descr').summernote('code', response.descr);
                var status = response.status == 'Y' ? true :  false;
                $("#isApproved").html(status);
                $("#isActive").prop('checked',status);
                
            }
        });
                  
    });


    $('#form-addCountry').validate({ // initialize the plugin
         rules:{
            name :{ required : true }
          },
          messages:{
            name :{ required : "Country is required" }
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('faq') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo APP_URL; ?>CommonController/store',
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
                    $('#form-addCountry')[0].reset();
                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
          }
    });


</script>

<script src="<?php echo BACKEND ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.min.js"></script>

<script>
    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,                 // set focus to editable area after initializing summernote
            toolbar:[
            
              ['style', ['bold', 'italic', 'underline']],              
              ['fontsize', ['fontsize']],
              
            ],
            height:200,
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
       
    });

   
</script>
