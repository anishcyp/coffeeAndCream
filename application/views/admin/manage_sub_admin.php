<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage Sub Admin  </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                           <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="active">
                            Manage Sub Admin
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-sm-12">                
                <div class="card-box table-responsive">
                         <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Sub Admin</button>
                    <div class="clearfix"></div>
                    <hr>
                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Admin Name</th>
                                <th>Number</th>
                                <th>Role</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form-addadmin" name="form-addadmin" method="post"   >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Sub Admin Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Sub Admin Email">
                            </div>
                        </div>
                        <div class="col-md-6 hideP">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Sub Admin Password">
                            </div>
                        </div>
                        <div class="col-md-6 hideC">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Sub Admin Confirm Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Sub Admin First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Sub Admin last Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Mobile no</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile no">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_admin" class="control-label">Manage Sub Admin</label>
                                <input type="checkbox" id="sub_admin" name="sub_admin">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_list" class="control-label">Manage Users</label>
                                <input type="checkbox" id="user_list" name="user_list">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="blog" class="control-label">Manage Blog</label>
                                <input type="checkbox" id="blog" name="blog">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="send_mail" class="control-label">Send Mail</label>
                                <input type="checkbox" id="send_mail" name="send_mail">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="send_mail" class="control-label">Manage Agency</label>
                                <input type="checkbox" id="manage_agency" name="manage_agency">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="send_mail" class="control-label">Manage Hen Stag</label>
                                <input type="checkbox" id="manage_hen_stag" name="manage_hen_stag">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about" class="control-label">About us</label>
                                <input type="checkbox" id="about" name="about">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="video" class="control-label">Manage Videos</label>
                                <input type="checkbox" id="video" name="video">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="advert_plan" class="control-label">Manage Advert Plan</label>
                                <input type="checkbox" id="advert_plan" name="advert_plan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="membership_Plan" class="control-label">Membership plan</label>
                                <input type="checkbox" id="membership_Plan" name="membership_Plan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service" class="control-label">Service</label>
                                <input type="checkbox" id="service" name="service">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="favorite" class="control-label">Favourite</label>
                                <input type="checkbox" id="favorite" name="favorite">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="language" class="control-label">Language</label>
                                <input type="checkbox" id="language" name="language">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location" class="control-label">Location</label>
                                <input type="checkbox" id="location" name="location">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact" class="control-label">Contact</label>
                                <input type="checkbox" id="contact" name="contact">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="home" class="control-label">Home</label>
                                <input type="checkbox" id="home" name="home" placeholder="Enter phone no">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subscriber" class="control-label">Subscriber</label>
                                <input type="checkbox" id="subscriber" name="subscriber">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="setting" class="control-label">Setting</label>
                                <input type="checkbox" id="setting" name="setting">
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
            "url": "<?php echo ADMIN_LINK ?>ManageSubAdmin/ajax_datatable",
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
            $("#email").val(response.email);
             $("#email").attr("readonly","readonly");
            $(".hideP").hide();
            $(".hideC").hide();
            $("#fname").val(response.fname);
            $("#lname").val(response.lname);
            $("#mobile").val(response.mobile);
            if(response.sub_admin == '1')
            {
                $("#sub_admin").prop("checked", true);
            }

            if(response.user_list == '1')
            {
                $("#user_list").prop("checked", true);
            }
            if(response.advert_plan == '1')
            {
                $("#advert_plan").prop("checked", true);
            }
            if(response.membership_Plan == '1')
            {
                $("#membership_Plan").prop("checked", true);
            }
            if(response.about == '1')
            {
                $("#about").prop("checked", true);
            }
            
            if(response.blog == '1')
            {
                $("#blog").prop("checked", true);
            }
            if(response.send_mail == '1')
            {
                $("#send_mail").prop("checked", true);
            }
             if(response.video == '1')
            {
                $("#video").prop("checked", true);
            }
            if(response.service == '1')
            {
                $("#service").prop("checked", true);
            }
            if(response.favorite == '1')
            {
                $("#favorite").prop("checked", true);
            }
            if(response.language == '1')
            {
                $("#language").prop("checked", true);
            }
            if(response.location == '1')
            {
                $("#location").prop("checked", true);
            }
            if(response.contact == '1')
            {
                $("#contact").prop("checked", true);
            }
            if(response.manage_agency == '1')
            {
                $("#manage_agency").prop("checked", true);
            }
            if(response.manage_hen_stag == '1')
            {
                $("#manage_hen_stag").prop("checked", true);
            }
            if(response.home == '1')
            {
                $("#home").prop("checked", true);
            }
            if(response.subscriber == '1')
            {
                $("#subscriber").prop("checked", true);
            }
            if(response.setting == '1')
            {
                $("#setting").prop("checked", true);
            }

        }
    });
              
});


$('#form-addadmin').validate({ // initialize the plugin
     rules:{
        fname :{ required : true },
        lname :{ required : true },
        email:{required : true,email:true},
        password:{required : true},
        cpassword:{required : true,equalTo: "#password"},
        mobile:{required : true},
      },
      messages:{
        fname :{ required : "First name is required" },
        lname :{ required : "Last name is required" },
        email:{required:"Please enter your email.",email:"Please enter valid email address."},
        password:{required:"Please enter your password."},
        cpassword:{required:"Please enter confirm password.", equalTo:"Password and confirm password not matched."},
        mobile :{ required : "Number is required" },
      },
      submitHandler: function (form) {

        //return false;
        var formData = new FormData($(form)[0]);
        formData.append('td', '<?php echo base64_encode('tbl_users') ?>');
        formData.append('i', '<?php echo base64_encode('id') ?>');
        $.ajax({
            url: '<?php echo ADMIN_LINK; ?>ManageSubAdmin/store',
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
                $('#form-addfavorite')[0].reset();
            },
            error: function(){
              //  alert("error in ajax form submission");
            }
        });

        return false;
      }
});

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
                  url: '<?php echo ADMIN_LINK; ?>ManageSubAdmin/AdminDeleted',
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