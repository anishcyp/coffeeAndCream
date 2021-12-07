<!DOCTYPE html>
<html class="account-pages-bg">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('public/front/images/logo/'.$site_favicon );?>">
        <!-- App title -->
        <title><?php echo $site_name; ?> -  Set New Password</title>
        <link href="<?php echo BACKEND; ?>custom.css?x=2" rel="stylesheet">
        <!-- App css -->
        <link href="<?php echo BACKEND; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BACKEND; ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />


        <script src="<?php echo BACKEND; ?>assets/js/modernizr.min.js"></script>


    </head>


    <body class="bg-transparent">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="wrapper-page">
                            
                            <div class=" m-t-40 account-pages">
                                <!-- Start : Error msg -->
                                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                 <?php
                                  $error = $this->session->flashdata('error');
                                  if($error)
                                  {?>
                                      <div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $error; ?>                    
                                      </div>
                                  <?php } 

                                  $success = $this->session->flashdata('success');
                                  if($success)
                                  {
                                      ?>
                                      <div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $success; ?>                    
                                      </div>
                                  <?php } ?>
                                <!-- End : Error msg -->
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="<?=base_url('admin');?>" class="text-success">
                                            <span><img src="<?php echo base_url('public/front/images/logo/'.$site_logo );?>" alt="" height="36"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <h2>Set New Password</h2>

                                    <form method="post" class="form-horizontal" action="<?php echo base_url("admin/reset/".$token)?>" name="MyForm" id="MyForm">

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="New Password">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>">
                                        <div class="form-group account-btn text-center m-t-40">
                                            <div class="col-xs-12">
                                                <button type="submit" name="submit" id="submit" class="btn w-md btn-bordered btn-success waves-effect waves-light">Submit</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo BACKEND; ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/detect.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/waves.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?php echo BACKEND; ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.app.js"></script>

        <script src="<?php echo COMMON;?>jquery.validate.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          $("#MyForm").validate({
            rules:{                           
               password : { required : true},
               confirm_password:{required : true,equalTo: "#password"},
             },
             messages:{
               password :{ required : "Enter new password is required" },
               confirm_password:{
                   required:"Please enter your retype password.",
                   equalTo:"Confirm password is not match."
               },
             }
         });
        });
        </script>
    </body>

</html>









