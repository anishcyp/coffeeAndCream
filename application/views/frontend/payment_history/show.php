<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        
        <section class="breadcrumbs-custom">
            <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                    <div class="container">
                        <h2 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h2>
                        <h5>Here you can monitor all your payment history on your account. Any deposit that is held by coffee n cream will all be refunded with a 10%charge. Deposits is only to keep our punters safe from fraud. Customers have a choice to secure deposit with us this will security for both customers and members of the site to show that there is a contact in place.  If a job is cancelled no fault of your own you still get your deposit</h5>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                        <li class="active"><?=$pageTitle;?></li>
                    </ul>
                </div>
            </div>
        </section>
        
        <div class="edit-main-block">
            <div class="container">
                <div class="row">
                    <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
                    <div class="col-lg-9 col-md-12 col-12">
                       <div class="common-blocks-detail">
                            <h4><?=$pageTitle;?></h4>
                            <div class="blocks-information">
                               <div class="table-responsive">
                                    <table id="datatable-scroller" class="table table-striped table-info">
                                        <thead>
                                            <tr>
                                                <th width="25%">Payment Type</th>
                                                <th width="30%">Payment Date</th>
                                                <th width="25%">User Details</th>
                                                <th width="15%">Amount</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> 
                            </div>   
                       </div>
                    </div>
                </div>
            </div>
        </div>
   
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    $('#datatable-scroller').DataTable({
          "serverSide": true,
          "ordering": true,
          "ajax": {
              type: "POST",
              url: baseURL + "PaymentController/ajaxPaginationDataPaymentHistory",
          },            
          "scroller": {
              "loadingIndicator": true
          },
          "columnDefs": [
              {"targets": 4, "orderable": false },
          ]
    });    
});
</script>
</body>
</html>