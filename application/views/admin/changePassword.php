<div class="content">
    <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Change Password</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Setting</a>
                            </li>
                            <li class="active">
                                Change Password
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="card-box">

                        <div class="row">

                            <div class="col-md-6">
                                <?php
                                
                                    $this->load->helper('form');
                                    $error = $this->session->flashdata('error');
                                    if($error)
                                    {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('error'); ?>                    
                                </div>
                                <?php } ?>
                                <?php  
                                    $success = $this->session->flashdata('success');
                                    if($success)
                                    {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php } ?>
                                
                                <?php  
                                    $noMatch = $this->session->flashdata('nomatch');
                                    if($noMatch)
                                    {
                                ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('nomatch'); ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <!-- general form elements -->
                                <div class="box box-primary">
                                  
                                    <!-- form start -->
                                    <form role="form" id="form-changepassword" action="<?php echo ADMIN_LINK; ?>changePassword" method="post">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPassword1">Old/Current Password</label>
                                                        <input type="password" class="form-control" id="inputOldPassword" placeholder="Enter your current password" name="oldPassword" maxlength="20" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPassword1">New Password</label>
                                                        <input type="password" class="form-control" id="newpass" placeholder="Enter your new password" name="newPassword" maxlength="20" 
                                                        data-parsley-minlength="8"
                                                        data-parsley-required-message="Please enter your new password."
                                                        data-parsley-required 
                                                        >
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label for="inputPassword1">New Password</label>
                                                        <input type="password" class="form-control" id="newpass" placeholder="Enter your new password" name="newPassword" maxlength="20" 
                                                        data-parsley-minlength="8"
                                                        data-parsley-required-message="Please enter your new password."
                                                        data-parsley-uppercase="1"
                                                        data-parsley-lowercase="1"
                                                        data-parsley-number="1"
                                                        data-parsley-special="1"
                                                        data-parsley-required 
                                                        >
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputPassword2">Confirm New Password</label>
                                                        <input type="password" class="form-control" id="confirmpass" placeholder="Enter your confirm new password" name="cNewPassword" maxlength="20" 
                                                        data-parsley-required-message="Please re-enter your new password."
                                                        data-parsley-equalto="#newpass"
                                                        data-parsley-required >
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                    
                                        <div class="box-footer">
                                            <input type="submit" class="btn btn-primary" value="Submit" />
                                            <input type="reset" class="btn btn-default" value="Reset" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo BACKEND ?>assets/plugins/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
    $(function () {
        $('#form-changepassword').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            
            $('.alert-info').toggleClass('hidden', !ok);
            $('.alert-warning').toggleClass('hidden', ok);
        })
        .on('form:submit', function () {
            return true; // Don't submit form for this demo
        });
    });



    //has uppercase
    window.Parsley.addValidator('uppercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var uppercases = value.match(/[A-Z]/g) || [];
        return uppercases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) uppercase letter.'
      }
    });

    //has lowercase
    window.Parsley.addValidator('lowercase', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var lowecases = value.match(/[a-z]/g) || [];
        return lowecases.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) lowercase letter.'
      }
    });

    //has number
    window.Parsley.addValidator('number', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var numbers = value.match(/[0-9]/g) || [];
        return numbers.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) number.'
      }
    });

    //has special char
    window.Parsley.addValidator('special', {
      requirementType: 'number',
      validateString: function(value, requirement) {
        var specials = value.match(/[^a-zA-Z0-9]/g) || [];
        return specials.length >= requirement;
      },
      messages: {
        en: 'Your password must contain at least (%s) special characters.'
      }
    });
</script>