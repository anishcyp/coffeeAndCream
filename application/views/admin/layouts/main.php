<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('public/front/images/logo/'.$site_favicon );?>">
    <!-- App title -->
    <title><?php echo $pageTitle; ?></title>

    <!-- date range picker -->
    <link rel="stylesheet" type="text/css" href="<?php echo COMMON;?>developer.css">
    <link href="<?php echo BACKEND; ?>custom.css?x=2" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="<?php echo BACKEND; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- App css -->
    <link href="<?php echo BACKEND; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BACKEND; ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo BACKEND; ?>assets/plugins/switchery/switchery.min.css">
    <script src="<?php echo BACKEND; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BACKEND; ?>assets/js/modernizr.min.js"></script>

    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>


    <link href="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo COMMON; ?>bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">
    <link href="<?php echo COMMON; ?>bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

</head>
<body class="fixed-left">

    

	<!-- Loader all pages-->
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




    <!-- Loader for ajax requesttable -->
 <!--    <div id="preloader-ajax">
        <div id="status">
            <div class="spinner">
              <div class="spinner-wrapper-ajax">
                <div class="rotator">
                  <div class="inner-spin"></div>
                  <div class="inner-spin"></div>
                </div>
              </div>
            </div>
        </div>
    </div> -->

    <!-- Begin page -->
        <div id="wrapper">

            
        	<?php echo $topbar; ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $leftbar; ?>
            
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                
                <?php echo $content_body ?>
                <!-- content -->

                <?php echo  $footer; ?>
                

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <?php echo  $rightbar; ?>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->




	    <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        
        <script src="<?php echo BACKEND; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/detect.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/waves.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/plugins/switchery/switchery.min.js"></script>

        <!-- Counter js  -->
        <script src="<?php echo BACKEND; ?>assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Flot chart js -->
        

        <script src="<?php echo BACKEND; ?>assets/plugins/moment/moment.js"></script>
        <script src="<?php echo BACKEND; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>



        <!-- App js -->
        <script src="<?php echo BACKEND; ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo BACKEND; ?>assets/js/jquery.app.js"></script>

        
        <!-- Sweet-Alert  -->
        <script src="<?php echo COMMON; ?>bootstrap-sweetalert/sweet-alert.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/pages/jquery.sweet-alert.init.js"></script>

        <script src="<?php echo COMMON;?>bootstrap-notify.js" type="text/javascript"></script>
        <script src="<?php echo COMMON;?>custom.js" type="text/javascript"></script>

        <!-- init -->
        <script src="<?php echo BACKEND; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <script>
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2016',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-success',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });
        </script>

        <script type="text/javascript">
         $(document).ready(function() {
          
                var url = window.location;
                var urlnew = window.location.href;

                 urlnew = urlnew.replace(/^(.+)(\/[^\/]+)$/g, '$1');
                // Will only work if string in href matches with location
                $('.has_sub li a[href="' + url + '"]').parent().addClass('active');
                // Will also work for relative and absolute hrefs
                $('.has_sub li a').filter(function() {
                    return this.href == url || this.href == urlnew;
                }).parent().parent().parent().addClass('active');


                $('.has_sub li a[href="' + url + '"]').parent().addClass('active');
                // Will also work for relative and absolute hrefs
                $('.has_sub li a').filter(function() {
                    return this.href == url || this.href == urlnew;
                }).parent().parent().prev().addClass('active');


                $('.has_sub li a[href="' + url + '"]').parent().parent().addClass('active');
                // Will also work for relative and absolute hrefs
                $('.has_sub li a').filter(function() {
                    return this.href == url || this.href == urlnew;
                }).parent().parent().parent().parent().parent().addClass('active');



                // for open sub menu for detail page
                /*$('.has_sub li a[href="' + url + '"]').parent().parent().addClass('active');
                // Will also work for relative and absolute hrefs
                $('.has_sub li a').filter(function() {
                    return  this.href == urlnew;
                }).parent().parent().prev().click();*/ 



                urlnew.replace(/\/$/, "");
                $('.has_sub li a[href="' + urlnew + '"]').parent().parent().addClass('active');
                // Will also work for relative and absolute hrefs
                $('.has_sub li a').filter(function() {
                    return  this.href == urlnew;
                }).parent().parent().prev().click();



            });
    </script>
    
    <!-- For default image validation -->
    <script type="text/javascript">
      $("#demo-form").submit(function(e){
        return chk_img_val();
        });

      function chk_img_val()
      {

        var hidden_fi=$('#hidden_fi').val();
        
        if (hidden_fi == '') 
        {
        
          $('.files_error').css('display','block');
            return false;
        }
        else 
        {
            $('.files_error').css('display','none');
            
           return chk_def_val();
            
        }
      }
    </script>
    <script type="text/javascript">
      function chk_def_val()
      {
        
          var checkbox_val= $("input[name=default_images_value]").val();
            if(checkbox_val=="")
            {
              $('.default_image_error').css('display','block');
              return false;
            }
            else{
              $('.default_image_error').css('display','none');
              return true;
            }
      }
    </script>

</body>
</html>