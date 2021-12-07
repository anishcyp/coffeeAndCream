<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage City Area</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">Manage Location</a>
                        </li>
                        <li class="active">
                          Manage  City Area
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">                
                                 
                <div class="card-box table-responsive">
                    
                    <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add City Area</button>
                    
                    <div class="clearfix"></div>
                    <hr>

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Country Name</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>Area Name</th>
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
                <h4 class="modal-title ">Add City Area</h4>                
            </div>
         
            <form role="form" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">

                <div class="modal-body">  
                      <div class="box-body">
                          <div class="msg"></div>
                          <div class="row">  
                              <div class="col-md-12">
                                <div class="form-group">
                                      <label for="field-1" class="control-label">Select Country</label>
                                      <select class="form-control" name="country_id" id="country_id" onchange="getStateListbyCountry(this.value)">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countrylists as $countrylist) { ?>
                                          <option value="<?php echo $countrylist->country_id; ?>"><?php echo $countrylist->name; ?></option>
                                        <?php } ?>
                                      </select>
                                  </div>

                                   <div class="form-group">
                                      <label for="field-1" class="control-label">Select State</label>
                                      <select class="form-control" name="state_id" id="state_id" onchange="getCityByState(this.value)">
                                        <option value="">Select State</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="field-1" class="control-label">Select City</label>
                                      <select class="form-control" name="city_id" id="city_id">
                                        <option value="">Select City</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="field-1" class="control-label">City Area Name</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter City Name" >
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
                    <input type="hidden" id="editid" name="editid">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary btn-submit" value="Submit" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>

            </form>

        </div>
    </div>
</div>



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
                "url": "<?php echo ADMIN_LINK ?>ManageLocation/ajax_city_area_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 3, "orderable": false },
                {"targets": 4, "orderable": false }
            ],
            "order": [[0, 'desc']],

        });
      
    });


    function getStateListbyCountry(country_id, state_id = "")
    {
        var id = country_id;
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
                      //alert(item.state_id);
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

    function getCityByState(state_id,city_id="")
    {
      if(state_id!="")
      {
        var id = state_id;
      }
      
      $.ajax({
            url: baseURL+'CommonController/getCityByState',
            type: "POST",
            data: "id="+id,
            success: function (data) {
                data = JSON.parse(data);
                var list = '<option value="">No City found</option>';
                if( data != 'blank' )
                {
                    list = '<option value="">Select City</option>';
                    $.each( data, function(index, item) {
                      // alert(item.city_id);
                        list += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                }
                $("#city_id").html(list);

                if(city_id!="")
                {
                    $('#city_id option[value='+city_id+']').attr('selected','selected');
                }
            },
        });
    }



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
              getStateListbyCountry(response.country_id,response.state_id);
              getCityByState(response.state_id,response.city_id);
            }
        });
                  
    });


    $('#form-addModels').validate({ // initialize the plugin
         rules:{
            country_id :{ required : true },
            state_id :{ required : true },
            city_id : { required : true },
            name :{ required : true },
          },
          messages:{
            country_id :{ required : "Country is required" },
            state_id :{ required : "State is required" },
            city_id  : { required : "City is required" },
            name :{ required : "City area name is required" }
          },
          submitHandler: function (form) {

            //return false;
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('city_area') ?>');
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

    
</script>


