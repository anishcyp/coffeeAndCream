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
      <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt=""></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
          <div class="container">
            <h1 class="text-transform-capitalize breadcrumbs-custom-title"><?= $pageTitle ?></h1>
            <h5 class="breadcrumbs-custom-text">Payments Guidelines
            </h5>
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

      <section class="section section-xl bg-default text-md-left">
        <div class="container">
          <div class="row row-40 row-md-60 justify-content-center">
            <div class="col-md-11 col-lg-6 col-xl-5">
              <!-- Quote Classic Big-->
              <article class="quote-classic-big inset-xl-right-30">
                <div class="heading-3 text-transform-capitalize quote-classic-big-text">
                  <div class="q">For entertainers</div>
                </div>
                <p>To reduce the risk of fraud, Coffeencream will use two payment options which are PayPal and our bank accounts. Only the two options will be applicable for all entertainers, escorts, agencies and client payment.</p>
                <p>All deposits will be held securely for 30 days by coffee cream, and a 5% admin fee will be deducted on top of the amount PayPal will deduct for using their services.</p>
                <p>For entertainers with no access to PayPal, our bank account may be used for deposits from clients.</p>
                <p>The funds will be deposited into your bank account from our account.</p>
                <p>Should a client cancel a service, their initial deposit will be deposited to you regardless but will still be viable for a 5% deduction fee by the admin.</p>
                <p>Giving personal bank details to clients will lead to the culprits being banned from using our services for a lifetime</p>
                <p>We understand that the payment methods may not be very convenient for you, but it is the only way to protect you and your customers from fraud.</p>
                <p>We are committed to serving you better, and we will continue to establish better ways to serve you and your customers better.</p>
                <p>To help us serve you better and efficiently, log in to your account and record every deposit on the spreadsheet account so that it’s easier to calculate the total amount at the end of every month.</p>
                <p>Should a dispute arise between you and the clients, we will help you resolve the issue.</p>
              </article>
              <!-- Bootstrap tabs-->
            </div>
            <div class="col-md-11 col-lg-6 col-xl-7">
              <div class="full-img">
                <img src="<?=FRONT_ASSETS?>images/payment.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-xl bg-default text-md-left">
        <div class="container">
          <div class="row row-40 row-md-60 justify-content-center">
            <div class="col-md-11 col-lg-6 col-xl-5">
              <!-- Quote Classic Big-->
              <article class="quote-classic-big inset-xl-right-30">
                <div class="heading-3 text-transform-capitalize quote-classic-big-text">
                  <div class="q">For customers</div>
                </div>
                <p>All deposit payments will be made through the coffee cream bank account or our PayPal account only. </p>
                <p>No deposits shall be made to an entertainer's account directly. Anyone caught doing this will be banned from using our services again as it violates our company policy.</p>
                <p>Once a deposit has been made, you may take a screenshot as proof of payment and send it to the entertainer.</p>
                <p>In case of cancellation, deposits are non-refundable unless the entertainer approves of it.</p>
              <p>All disputes should be put forward within three days of booking and will only be resolved once both sides of the party have put their issues across.</p>
              <p>We are committed to serving you better, and all these steps are to protect you from fraud. </p>
              </article>
              <!-- Bootstrap tabs-->
            </div>
            <div class="col-md-11 col-lg-6 col-xl-7">
              <div class="full-img">
                <img src="<?=FRONT_ASSETS?>images/payment2.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </section>

  

<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>