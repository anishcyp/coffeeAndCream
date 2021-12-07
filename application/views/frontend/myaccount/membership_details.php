<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
    </head>
    <body class="">
    <?php $this->load->view(FRONTEND."include/menu"); ?>
    <!-- Profile Start Here -->
   <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title"><?= $pageTitle ?></h2>
              <h5 class="breadcrumbs-custom-text"></h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active"><?= $pageTitle ?></li>
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
                                                <th width="25%">Plan Name</th>
                                                <th width="30%">Start Date</th>
                                                <th width="25%">End Date</th>
                                                <th width="15%">Status</th>
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
              url: baseURL + "MembershipPlanController/ajaxPaginationDatamembership_details",
          },            
          "scroller": {
              "loadingIndicator": true
          },
          "columnDefs": [
              {"targets": 4, "orderable": false },
          ]
    });    
});


function display_ct6() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
document.getElementById('ct6').innerHTML = x1;
display_c6();
 }
 function display_c6(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct6()',refresh)
}
display_c6()


</script>