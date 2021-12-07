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
                        <h5>Here you will find your membership history.   When a customer place a deposit to book a entertainment services a comfrimation email will be sent to the customer and the entertainer with all details of booking information and the deposit they secure with coffee n cream. Only for entertainment services we have provided this facility because bookings made in advance.</h5>
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
                               <table class="table">
                                  <tr>
                                    <th>User Name :</th>
                                    <td><?= $user_details['fname'].' '.$user_details['lname'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Email id :</th>
                                    <td><?= $user_details['email'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Phone no :</th>
                                    <td><?= $user_details['phone'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Payment Date :</th>
                                     <td><?= $details['payment_date'] ?></td>
                                  </tr>
                                              
                                  <tr>
                                    <?php 
                                    if($details['payment_type'] == 'credit_card')
                                    {
                                      $type ="Credit Card";
                                    }
                                    else
                                    {
                                      $type ="PayPal";
                                    }
                                    ?>
                                    <th>Payment Type :</th>
                                    <td><?= $type ?></td>
                                  </tr>
                                  <tr>
                                    <th>Amount :</th>
                                    <td>(<?= $details['currency'] ?>) <?= $details['amount'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Transaction id :</th>
                                    <td><?= $details['stripe_charge_id'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Service name :</th>
                                    <td><?= $service['name'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Time You Want Entertainer :</th>
                                    <td><?= $details['time_entertainer'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Venue/Location of booking :</th>
                                    <td><?= $details['location_booking'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>What is the celebration? :</th>
                                    <td><?= $details['celebration'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Total cost agreed by entertainer and customer? :</th>
                                    <td><?= $details['agreed_enter_cust'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Balance to paid in cash after deposit :</th>
                                    <td><?= $details['cash_balance'] ?></td>
                                  </tr>
                                </table>
                            </div>   
                       </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

</body>
</html>