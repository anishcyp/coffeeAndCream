<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage Membership Plan</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                           <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="active">
                            Manage Membership Plan
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">                
                                    
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Membership Plan</button>
                    
                    <div class="clearfix"></div>
                    <hr>


                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Plan Nickname</th>
                                <th>Price(£)</th>
                                <th>Billing Period</th>
                                <th>Number of cities</th>
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
            <form role="form" id="form-membership-plan" name="form-membership-plan" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Membership Plan Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Premium Plan, sunglasses, etc.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Plan Nickname</label>
                                <input type="text" class="form-control" id="plan_nickname" name="plan_nickname" placeholder="Enter Plan Nickname">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Price (<?=CURR_SYMBOL;?>)</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Billing period</label>
                                <select class="form-control" name="interval" id="interval">
                                    <option value="day">Daily</option>
                                    <option value="week">Weekly</option>
                                    <option value="month">Monthly</option>
                                    <option value="quarter">Every 3 months</option>
                                    <option value="semiannual">Every 6 months</option>
                                    <option value="year">Yearly</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div>
                        <div class="dis_cus_interval" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn waves-effect waves-light btn-primary">Every</button>
                                        </span>
                                        <input type="text" id="interval_count" maxlength="2" name="interval_count" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <select class="form-control" name="custom_interval" id="custom_interval">
                                    <option value="day">days</option>
                                    <option value="week">weeks</option>
                                    <option value="month">months</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Number of cities</label>
                                <input type="text" class="form-control" id="no_plan_cities" name="no_plan_cities" placeholder="Enter Number of cities">
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

                    <div class="form-group">
                            <label>Blog Description</label>
                            <textarea name="descr" id="descr" class="summernote"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="type" name="type" value="add">
                    <input type="hidden" id="stripe_product_id" name="stripe_product_id">
                    <input type="hidden" id="stripe_plan_id" name="stripe_plan_id">
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
<script src="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.min.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function(){

        $('.summernote').summernote({
        height: 240,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });

    });

    $('#interval').on('change', function() {
        var interval = $(this).val();
        if(interval == 'custom')
        {
           $(".dis_cus_interval").show(); 
        }
        else
        {
            $(".dis_cus_interval").hide();   
        }
    });

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
                "url": "<?php echo ADMIN_LINK ?>MembershipPlanController/ajax_advert_plan_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 0, "orderable": false },
                {"targets": 7, "orderable": false }
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
                $("#plan_nickname").val(response.plan_nickname);
                $("#amount").val(response.amount);
                $("#stripe_product_id").val(response.stripe_product_id);
                $("#stripe_plan_id").val(response.stripe_plan_id);
                $("#editid").val(response.id);
                if(response.interval == 'custom')
                {
                    $(".dis_cus_interval").show();
                    $('#interval option[value='+response.interval+']').attr('selected','selected');  
                    $("#interval_count").val(response.interval_count);
                    $('#custom_interval option[value='+response.custom_interval+']').attr('selected','selected');  
                }
                else
                {
                    $(".dis_cus_interval").hide();
                    $('#interval option[value='+response.interval+']').attr('selected','selected');
                }
                
                $("#no_plan_cities").val(response.no_plan_cities);
                var status = response.status == 'Y' ? true :  false;
                $("#isApproved").html(status);
                $("#isActive").prop('checked',status);
            }
        });
    });

    $('#form-membership-plan').validate({ // initialize the plugin
        rules:{
            name :{ required : true },
            amount  :{ required : true ,  digits: true },
            interval :{ required : true },
            interval_count :{ required : true , digits: true },
            no_plan_cities :{ required : true  },
        },
        messages:{
            name :{ required : "Plan name is required" },
            amount :{ required : "Amount is required", digits : 'Please enter digits only' },
            interval :{ required : "Billing period is required" },
            interval_count :{ required : "Interval count is required", digits : 'Please enter digits only' },
            no_plan_cities :{ required : "Number of cities include for this plan is required" },
        },
        submitHandler: function (form) 
        {
            var formData = new FormData($(form)[0]);
            formData.append('td', '<?php echo base64_encode('membership_plan') ?>');
            formData.append('i', '<?php echo base64_encode('id') ?>');

            $.ajax({
                url: '<?php echo ADMIN_LINK; ?>MembershipPlanController/insertRecord',
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
                    $('#form-membership-plan')[0].reset();
                }
            });
        }
    });


    $(document).on("click",".rowDeletePlan",function(){
    
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