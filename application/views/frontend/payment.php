<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <link rel="canonical" href="<?= base_url('deposit/'.$uid.'') ?> " />
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        <section class="breadcrumbs-custom">
            <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
                <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                    <div class="container">
                        <h1 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h1>
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
                    <div class="col-lg-2 col-md-2 col-10">
                    </div>
                    <div class="col-lg-9 col-md-12 col-12">
                        <div class="common-blocks-detail">
                            <h4>Payment Information</h4>
                            <form id="paymentFrm" name="paymentFrm" action="javascript:void(0);" method="post">
                                <input type="hidden" name="UserId" id="UserId" value="<?= $uid; ?>">
                                
                                <div class="blocks-information">
                                    
                                        <div class="form-group">
                                            <label class="form-label-custom">Select Service</label>
                                            <select class="form-control" onchange="showService();" name="payment_service" id="payment_service">
                                                <option value="">Select Service</option>
                                                <?php 
                                                $selected_service = explode(",",$user_d['service_id']);

                                                if($selected_service != '')
                                                {
                                                    foreach ($selected_service as $service) 
                                                    {
                                                        $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$service."'"); 
                                                        $service_type = $this->crud->get_column_value_by_id("service","service_type","service_id = '".$service."'"); ?>?>
                                                        <option data-id = "<?= $service_type ?>" value="<?php echo $service ?>"><?php echo $service_name; ?></option><?php      
                                                    } 
                                                } ?>
                                            </select>
                                        </div>  
                                        <div class="payment-services" style="display: none;">
                                        <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Time You Want Entertainer</label>
                                            <input type="text" class="form-control" id="time_entertainer" name="time_entertainer" placeholder="Enter Time You Want Entertainer" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Venue/Location of booking</label>
                                            <input type="text" class="form-control" id="location_booking" name="location_booking" placeholder="Enter Venue/Location of booking" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">What is the celebration?</label>
                                            <input type="text" class="form-control" id="celebration" name="celebration" placeholder="Enter What is the celebration?" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Total cost agreed by entertainer and customer?</label>
                                            <input type="text" class="form-control" id="agreed_enter_cust" name="agreed_enter_cust" placeholder="Enter Total cost agreed by entertainer and customer" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Balance to paid in cash after deposit</label>
                                            <input type="text" class="form-control" id="cash_balance" name="cash_balance" placeholder="Enter Balance to paid in cash after deposit" value="">
                                        </div>
                                       
                                        <div class="form-group col-md-6">
                                            <label class="form-label-custom">Deposit Amount (£ - GBP)</label>
                                            <input type="text" class="form-control" id="deposit_amt" name="deposit_amt" placeholder="Enter Deposit Amount" >
                                        </div>
                                    </div>
                                    
                                    <h4>PAYMENT METHOD</h4>
                                    <div class="payment-image mb-4 text-left" style="float:none">
                                            <img src="<?php echo base_url(UPLOAD_DIR.'cardicon.png') ?>" alt="cardicon display">
                                        </div>
                                    <div class="row col-md-12 mt-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay_method" id="paypal_method" checked value="paypal" onchange="show2();"> Paypal
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pay_method" id="credit_card_method" value="credit_card" onchange="show2();"> Credit Card
                                        </div>
                                    </div>
                                    <div class="payment-information" style="display: none;">
                                        <div class="row mt-4">
                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Card Number</label>
                                                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Card Number" onkeypress="return checkOnlyDigits(event)" maxlength="16">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Month</label>
                                                <select class="form-control" id="mm" name="mm">
                                                    <option value="" >Select Month</option>
                                                    <?php for($mm = 1 ; $mm <=12 ; $mm++) {?>
                                                    <option value="<?php echo sprintf("%02d", $mm) ?>" ><?php echo sprintf("%02d", $mm) ?></option>
                                                    <?php  }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Year</label>
                                                <select class="form-control" id="yy" name="yy">
                                                    <option value="" >Select Year</option>
                                                    <?php for($yy = date("y") ; $yy <= date("y")+50 ; $yy++) {?>
                                                    <option value="<?php echo $yy ?>" ><?php echo 2000+$yy ?></option>
                                                    <?php  }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">CVC</label>
                                                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="CVC" onkeypress="return checkOnlyDigits(event)" maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="last-btn-blocks">
                                        <button type="submit" name="submit" class="button button-lg button-shadow-2 button-primary button-zakaria" id="pay_now">Pay Now</button>
                                    </div>
                                </div>
                                </div>
                                <div class="escort-service" ></div>
                            </form>

                            <form method="post" action="<?=PAYPAL_URL?>" name="frmPayPal" id="frmPayPal">
                                <input type="hidden" name="business" value="<?=PAYPAL_BUSINESS_EMAIL?>">
                                <input type="hidden" name="amount" id="amount" value="">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="item_name" id="item_name" value="<?=$pageTitle;?>">
                                <input type="hidden" name="item_number" value="1">
                                <input name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" type="hidden">
                                <input type="hidden" name="currency_code" value="GBP">
                                <input type="hidden" name="rm" value="2">
                                <input type="hidden" name="return" value="<?php echo base_url(); ?>payment-succcess/">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>payment-cancel/<?php echo $user_d['id']; ?>">
                                <input type="hidden" name="notify_url" value="<?php echo base_url(); ?>payment-notify">
                                <input type="hidden" name="custom" id="custom" value="">
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load->view(FRONTEND."include/footer"); ?>
    <?php $this->load->view(FRONTEND."include/include_js"); ?>
    <script type="text/javascript">

    function show2()
    {
        var get_st_needs = $('input[name=pay_method]:checked').val();
        
        if(get_st_needs == "credit_card")
        {
            $(".payment-information").show();
        }
        else if(get_st_needs == "paypal")
        {
            $(".payment-information").hide();
        }
    }

    function showService()
    {
       var OptVal = $('#payment_service').find(':selected').attr('data-id');
       
       if(OptVal == 1)
       {
        $(".payment-services").show();
       }
       else
       {
        $(".payment-services").hide();
        $.notify({message: ' Coffee & Strippers not provided deposit facility for escort service'},{ type: 'danger'});
       }
    }
    
    $('#paymentFrm').validate({ 
        rules: {
            fname:{required : true},
            lname:{required : true},
            email:{required : true, email : true},
            phone:{required : true, number : true},
            deposit_amt:{required : true,  min: 1},
            card_number:{required : true,number : true, minlength:16},
            mm:{required : true},
            yy:{required : true},
            cvv:{required : true,number : true, minlength:3},
        },
        messages: {
            fname:{required:"Please enter first name."},
            lname:{required:"Please enter last name."},
            email:{required:"Please enter email address.", email : "Please enter valid email address."},
            phone:{required:"Please enter phone number.", number : "Please enter valid phone number."},
            deposit_amt:{required:"Please enter amount."},
            card_number:{required:"Please enter card number."},
            mm:{required:"Please select month."},
            yy:{required:"Please select year."},
            cvv:{required:"Please enter CVC.",number:"Only Digits Allowed",minlength:"Only three digits allowed"},
        },
        submitHandler: function (form) 
        {
            $(".loading-div").show();
            var formData = new FormData($(form)[0]);
            $("#pay_now").attr("disabled", true);
            
            $.ajax({
                url: '<?= base_url("payment-process"); ?>',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'json',
                success: function (response) 
                {
                    console.log(response);
                    if(response.error == 1)
                    {
                        $("#pay_now").attr("disabled", false);
                        $.notify({message: response.msg},{ type: 'danger'});
                    }
                    else if(response.error == 0)
                    {

                        if(response.pay_method == "paypal")
                        {
                            $("#amount").val($("#deposit_amt").val());
                            var last_id = response.last_id+"##"+response.user_id;
                            $("#custom").val(last_id);
                            $("#frmPayPal").submit();
                        }
                        else if(response.pay_method == "credit_card")
                        {
                            $.notify({message: response.msg},{ type: 'success'});
                            location.reload();
                        }
                    }
                    $(".loading-div").hide();
                }
            });

            return false;
          }
    });
    </script>
</body>
</html>