<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage City </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">Manage Location</a>
                        </li>
                        <li class="active">
                          Manage  City
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">                
                <div class="card-box table-responsive">
                    
                    <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add City</button>
                    
                    <div class="clearfix"></div>
                    <hr>

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Country Name</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>Description</th>
                            <th>Hen stag Descrip..</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div> 

</div> 

<div id="addpopUpmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
                <h4 class="modal-title ">Add City</h4>                
            </div>
         
            <form role="form" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">
                <div class="modal-body">  
                      <div class="box-body">
                          <div class="msg"></div>
                          <div class="row">  
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="field-1" class="control-label">Select Country</label>
                                      <select class="form-control" name="country_id" id="country_id" onchange="getStateListbyCountry()">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countrylists as $countrylist) { ?>
                                          <option value="<?php echo $countrylist->country_id; ?>"><?php echo $countrylist->name; ?></option>
                                        <?php } ?>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="field-1" class="control-label">Select State</label>
                                      <select class="form-control" name="state_id" id="state_id">
                                        <option value="">Select State</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="field-1" class="control-label">City Name</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter City name" required>
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
                <div class="modal-footer">
                    <input type="hidden" id="type" name="type" value="add">
                    <!-- <input type="hidden" id="city_num" name="city_num" value=""> -->
                    <input type="hidden" id="editid" name="editid">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary btn-submit" value="Submit" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>

            </form>

        </div>
    </div>
</div>

<!---------- Description Modal  -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form role="form1" id="page_description" name="page_description" method="post"   >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Description Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="summernote" required=""></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="editidDes" name="editidDes">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>


<!---------- Description Modal  -->
<div class="modal fade" id="HenstagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form role="form1" id="hen_stag_description" name="hen_stag_description" method="post"   >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Hen stag do Description Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Hen stag Description</label>
                <textarea name="stag_description" id="stag_description" class="summernote" required=""></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="editidDesHen" name="editidDesHen">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
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
                "url": "<?php echo ADMIN_LINK ?>ManageLocation/ajax_city_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 4, "orderable": false },
                {"targets": 6, "orderable": false }
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
              $('#country_id option[value='+response.country_id+']').attr('selected','selected');
              $("#name").val(response.name);
              var status = response.status == 'Y' ? true :  false;
              $("#isApproved").html(status);
              $("#isActive").prop('checked',status);
              getStateListbyCountry(response.state_id);
            }
        });
                  
    });

    $('#form-addModels').validate({ // initialize the plugin
         rules:{
            country_id :{ required : true },
            state_id :{ required : true },
            name :{ required : true },
          },
          messages:{
            country_id :{ required : "Country is required" },
            state_id :{ required : "State is required" },
            name :{ required : "City is required" },
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('city') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo APP_URL; ?>CommonController/insertRecord',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'json',
                success: function (response) {

                  swal(response.msg);

                  $('#datatable-scroller').DataTable().ajax.reload();
                  $('#addpopUpmodal').modal('hide');
                  $('#form-addModels')[0].reset();

                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
             
          }
    });


    function getStateListbyCountry(state_id = "")
    {
        var id = $("#country_id").find('option:selected').val();
        $.ajax({
            url: baseURL+'CommonController/getStateByCountry',
            type: "POST",
            data: "id="+id,
            success: function (data) {
                data = JSON.parse(data);
                var list = '<option value="">No state found</option>';
                if( data != 'blank' )
                {
                    list = '<option value="">Select State</option>';
                    $.each( data, function(index, item) {
                        list += '<option value="'+item.state_id+'">'+item.name+'</option>';
                    });
                }
                $("#state_id").html(list);
                if(state_id!="")
                {
                    $('#state_id option[value='+state_id+']').attr('selected','selected');
                }
            },
        });
    }

    // =========== Descr ==============

    $(document).on("click",".rowDes",function(){
        
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
                $("#editidDes").val(response.id);
                $('#description').summernote('code', response.description);
            }
        });

    });
    
    $(document).on("click",".rowDesHen",function(){
       
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
                $("#editidDesHen").val(response.id);
                $('#stag_description').summernote('code', response.hen_description);
            }
        });

    });


    $('#page_description').validate({ 
         rules:{
            description :{ required : true }
          },
          messages:{
            description :{ required : "description is required" }
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('city') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo APP_URL; ?>CommonController/DescriptionInsert',
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
                    $('#exampleModal').modal('hide');
                   
                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
          }
    });
    
    
    $('#hen_stag_description').validate({ 
         rules:{
            stag_description :{ required : true }
          },
          messages:{
            stag_description :{ required : "description is required" }
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('city') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');
            $.ajax({
                url: '<?php echo APP_URL; ?>CommonController/HenstagDescrInsert',
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
                    $('#HenstagModal').modal('hide');
                   
                },
                error: function(){
                  //  alert("error in ajax form submission");
                }
            });

            return false;
          }
    });

</script>
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


