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
        
         <!-- <section class="diary-list">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Payment history:</h3>
                    <ul>
                        <li>Here, you can monitor all your payment history and past transactions.</li>
                        <li>Please understand that all deposits are held by coffee n cream and will be refunded after a 10% fee has been charged.</li>
                        <li>All deposits are meant to keep our punters safe from fraud.</li>
                        <li>Customers will have to secure deposits with coffee n cream as this will ensure the security of both the customer and members.</li>
                        <li>If a client cancels a job, their initial deposits will still be credited to your account.</li>
                    </ul>
                </div>
            </div>
          </div>
        </section> -->
        
        <div class="edit-main-block">
            <div class="container">
                <div class="row">
                    <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
                    <div class="col-lg-9 col-md-9 col-12">
                       <div class="common-blocks-detail">
                            <h4><?=$pageTitle;?></h4>
                            <div class="blocks-information">
                               <table class="table">
                                  <tr>
                                    <th>Plan Name :</th>
                                    <td><?= $details['plan_nickname'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Amount :</th>
                                    <td><?= $details['amount'] ?> Points</td>
                                  </tr>
                                  <tr>
                                    <th>Plan Days :</th>
                                    <td><?= $details['interval_count'] ?> <?= $details['custom_interval'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Cites :</th>
                                     <td><?= $details['no_plan_cities'] ?></td>
                                  </tr>
                                  <?php
                                  if($details['status'] == 1)
                                  {
                                  ?>  
                                  <tr>
                                    <th>Current time</th>
                                    <td><span id='ct6' style="background-color: #FFFF00"><?= date("Y-m-d H:i:s") ?></span></td>
                                  </tr> 
                                  <?php
                                  }
                                  else
                                  {
                                    ?>
                                    <tr>
                                      <th>Status</th>
                                      <td><span style="background-color: #ff0000">Plan is Expired</span></td>
                                    </tr>
                                  <?php
                                  }
                                  ?>
                                  <tr>
                                    <th>End</th>
                                    <td><?=$details['end_date'] ?></td>
                                  </tr> 
                                  <?php
                                  $ischecked = $details['status'] == '1' ? 'checked="checked"' : '';
                                  $status = $details['status'] == '2' ? '2' : '1';
                                  $tablename = 'purchase_plan';

                                  ?>
                                  <tr>
                                    <th><p>Notice :-</p></th>
                                    <th>Staus is deactive your plan is close.</th>
                                    
                                  </tr>
                                  <?php
                                  if($details['status'] == 1)
                                  {
                                  ?>  
                                  <tr>
                                    <th>Status</th>
                                    <td><a class="active btn btn-danger" data-status="<?= $details['stripe_sub_id'] ?>" data-id="<?= $details['id'] ?>" href="javascript:void(0)" >Active</a></td>
                                  </tr>
                                  <?php
                                   }
                                  else if($details['status'] == 2)
                                  {
                                    ?>
                                     <tr>
                                      <th>Status</th>
                                      <td><a href="javascript:void(0);" class="Deactive btn">Deactive</a></td>
                                    </tr>
                                    <?php
                                  }
                                  ?>
                                  
                                </table>

                            </div>   

                       </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script>
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


$(document).on("click",".Deactive",function(){
   $.notify({message: 'Do not access this button.'},{ type: 'danger'});
});


$(document).on("click",".active",function(){
  if(confirm("Are you sure you want to Deactive?"))
  {

  }
  else
  {
      return false;
  }
  var id = $(this).attr("data-id");
  var sub = $(this).attr("data-status");
   
    if(confirm("your plan is permanently close ?"))
  {

  }
  else
  {
      return false;
  }
  $(".loading-div").show();
  $.ajax({
        url: '<?php echo APP_URL ?>CommonController/active_deactive',
        dataType: "JSON",
        method:"POST",
        data: {
            "id": id,
            "sub": sub,
        },
        success: function (response)
        { 
          location.reload();
          $(".loading-div").hide();
          $.notify({message: 'Membership plan is close'},{ type: 'success'});
        }
    });

});

</script>



</body>
</html>