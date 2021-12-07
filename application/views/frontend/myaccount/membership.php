<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        
         <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Membership Plan</h2>
              <h5>Click on purchase to choose the plan that suits. The free kit can only be use once after that you will have to select a plan.</h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Membership Plan</li>
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
                    <?php if($user_role == 1){ ?>
                    <div class="custom-member-table">
                       <h5>Membership Plan for Entertainment services</h5>
                       <ul>
                           <li>Click to purchase the plan that works best for you. Coffee n Cream provides a free welcome kit
where you get to advertise free for the first seven days. The free kit can only be used once then after that you will have to select a plan</li>
                          <li>Coffeencream is a nationwide company dealing with multiple location and we therefore charge by points.</li>
                          <li>1Points €1 or £1</li>
                          <li>Everyday charge is 10 points</li>
                          <li>Strippers will choose how long their wish to advertise on the coffeencream website and select a membership plan that works best for them. For instance to
                          advertise on the website for 1 week, you will be charged 70 points and have the
                          freedom to choose up to 10 cities that you wish to work in. We advise that you
                          choose locations that are close to each other so that it is easier to travel.</li>
                       </ul>
                       <div class="custom-member-block">
                          <div class="custom-member-block-inner">
                              <div class="custom-member-inner">
                                  <div class="inner-custom-member-inner">
                                    <h2>Membership/Cities/points</h2>
                                    <p><b>Welcome kit </b></p>
                                    <p><i class="fa fa-clock-o" aria-hidden="true"> <span>Free 7 Day's</span></i></p>
                                    <a href="javascript:void(0)" class="button button-shadow-2 button-zakaria button-md button-primary">Purchase</a>
                                  </div>
                              </div>
                              <?php 
                              foreach($plan as $Plans)
                              {
                              ?>
                              <div class="custom-member-inner">
                                  <div class="inner-custom-member-inner">
                                    <h2>Membership/Cities/points</h2>
                                    <div class="inner-custom-point">
                                      <p><i class="far fa-calendar-alt" aria-hidden="true"></i> <span><?= $Plans->interval_count ?> <?= $Plans->custom_interval ?></span></p>
                                      <p><i class="fas fa-map-marked-alt"></i> <span><?= $Plans->no_plan_cities ?> Cities</span> </p>
                                      <p><i class="fas fa-pound-sign"></i> <span><?= $Plans->amount ?> Points</span></p>
                                    </div>
                                    <a href="javascript:void(0);" id="plan_ship" data-id="<?= $Plans->id ?>" data-point="<?= $Plans->amount ?>" data-days="<?= $Plans->interval_count ?> <?= $Plans->custom_interval ?>" data-city="<?= $Plans->no_plan_cities ?> Cities" data-text="Membership Plan for Entertainment services" class="button button-shadow-2 button-zakaria button-md button-primary">Purchase</a>
                                  </div>
                              </div>
                              <?php
                              }
                              ?>
                          </div>
                       </div>
                    </div>

                  <?php } else if($user_role == 2){?>


                    <!-- **************Escorts Plan************* -->

                    <div class="custom-member-table">
                       <h5>Membership plan for escorts services</h5>
                       <ul>
                           <li>Click to purchase the plan that works best for you. Coffee n Cream provides a free welcome kitwhere you get to advertise free for the first seven days. The free kit can only be used once then after that you will have to select a plan</li>
                          <li>Coffeencream is a nationwide company dealing with multiple locations and currencies and will therefore charge by points.</li>
                          <li>1Points €1 or £1</li>
                          <li>Everyday charge is 10 points to advertise on the website</li>
                          <li>Escorts will choose how long their want to advertise on the coffeencream website and select a membership plan that works best for them. For instance to advertise on the website for 1 week, you will be charged 70 points and you will be required to select one major city you wish to work in.</li>
                       </ul>

                       <div class="custom-member-block">
                          <div class="custom-member-block-inner">
                              <div class="custom-member-inner">
                                  <div class="inner-custom-member-inner">
                                    <h2>Membership/Cities/points</h2>
                                    <p><i class="fa fa-clock-o" aria-hidden="true"> <span>Free 7 Day's</span></i></p>
                                    <a href="#" class="button button-shadow-2 button-zakaria button-md button-primary">Purchase</a>
                                  </div>
                              </div>
                              <?php 
                              foreach($plan as $Plans)
                              {
                              ?>
                              <div class="custom-member-inner">
                                  <div class="inner-custom-member-inner">
                                    <h2>Membership/Cities/points</h2>
                                    <div class="inner-custom-point">
                                      <p><i class="far fa-calendar-alt" aria-hidden="true"></i> <span><?= $Plans->interval_count ?> <?= $Plans->custom_interval ?></span></p>
                                      <p><i class="fas fa-map-marked-alt"></i> <span><?= $Plans->no_plan_cities ?> Cities</span> </p>
                                      <p><i class="fas fa-pound-sign"></i> <span><?= $Plans->amount ?> Points</span></p>
                                    </div>
                                    <a href="javascript:void(0);" id="plan_ship" data-id="<?= $Plans->id ?>" data-point="<?= $Plans->amount ?>" data-days="<?= $Plans->interval_count ?> <?= $Plans->custom_interval ?>" data-city="<?= $Plans->no_plan_cities ?> Cities" data-text="Membership plan for escorts" class="button button-shadow-2 button-zakaria button-md button-primary">Purchase</a>
                                  </div>
                              </div>
                              <?php
                              }
                              ?>
                          </div>
                       </div>
                    </div>
                  <?php } else if($user_role == 4){?>

                  
                    <!-- **************Escorts Plan************* -->

                    <div class="custom-member-table">
                       <h5>Membership plan for Agency advertisement</h5>
                       <ul>
                          <li>Coffee n cream is a nationwide company dealing with multiple locations and currencies and will therefore charge by points.</li>
                          <li>1Points €1 or £1</li>
                       </ul>

                       <div class="custom-member-block">
                          <div class="custom-member-block-inner">
                              
                              <?php 
                              foreach($plan as $Plans)
                              {
                              ?>
                              <div class="custom-member-inner agency_member">
                                  <div class="inner-custom-member-inner">
                                    <h2><?= $Plans->name ?></h2>
                                    <div class="inner-custom-point">
                                      <p><i class="far fa-calendar-alt" aria-hidden="true"></i> <span><?= $Plans->interval_count ?> <?= $Plans->custom_interval ?> advertisement</span></p>
                                      <p><i class="fas fa-map-marked-alt"></i> <span>Advertise in <?= $Plans->no_plan_cities ?> locations</span> </p>
                                      <p><i class="fas fa-pound-sign"></i> <span><?= $Plans->amount ?> Points</span></p>
                                      <div class="plan_desc">
                                      <?= $Plans->descr ?>
                                      </div>
                                    </div>
                                    <a href="javascript:void(0);" id="plan_ship" data-id="<?= $Plans->id ?>" data-point="<?= $Plans->amount ?>" data-days="<?= $Plans->interval_count ?> <?= $Plans->custom_interval ?>" data-city="<?= $Plans->no_plan_cities ?> Cities" data-text="Membership plan for escorts" class="button button-shadow-2 button-zakaria button-md button-primary">Purchase</a>
                                  </div>
                              </div>
                              <?php
                              }
                              ?>
                          </div>
                       </div>
                    </div>
                  <?php 
                  }
                  else if($user_role == 5)
                  {
                  ?>
                  <section class="price-section">
                  <div class="container">
                    <div class="section-header text-center">
                    <h5>Membership plan for hen stag accommodation</h5>
                    </div>
                      <div class="outer-box">
                        <div class="row">
                        <?php 
                        foreach($plan as $Plans)
                        {
                          if($Plans->name == 'Basic')
                          {
                            $class = "fas fa-paper-plane";
                          }
                          else
                          {
                            $class = "fas fa-gem";
                          }
                        ?>
                          <div class="price-block col-xl-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="icon-outer"><i class="<?= $class ?>"></i></div>
                                </div>
                                <div class="price-box">
                                    <div class="price-title"><?= $Plans->name ?></div>
                                    <h4 class="amout"><?= $Plans->amount ?></h4>
                                </div>
                                <ul class="features">
                                    <li class="true"><?= $Plans->interval_count.' '.$Plans->interval ?></li>
                                    <li class="true"><?= $Plans->amount ?> Pointse</li>
                                    <li class="true">Easy Access</li>
                                    <li class="true">Free Contacts</li>
                                </ul>
                                <div class="btn-box">
                                    <a href="#" id="plan_ship" data-id="<?= $Plans->id ?>" data-point="<?= $Plans->amount ?>" data-days="<?= $Plans->interval_count ?> <?= $Plans->custom_interval ?>" data-city="<?= $Plans->no_plan_cities ?> Cities" data-text="Membership plan for hen stag accommodation">Buy plan</a>
                                </div>
                            </div>
                          </div>
                          <?php
                          }
                          ?>
                      </div>
                      </div>
                    </div>
                </section>
                  <?php
                  }
                  ?>
                 </div>
              </div>
            </div>
        </div>
      </div>
	  
	<!-- <section class="price-section">
		<div class="container">
			<div class="outer-box">
				<div class="row">
					
					<div class="price-block col-xl-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
							</div>
							<div class="price-box">
								<div class="price-title">Standard package</div>
								<h4 class="amout">35.99</h4>
							</div>
							<ul class="features">
								<li class="true">1 month</li>
								<li class="true">20 Cities</li>
								<li class="true">300 Pointse</li>
								<li class="false">Easy Access</li>
								<li class="false">Free Contacts</li>
							</ul>
							<div class="btn-box">
								<a href="#">Buy plan</a>
							</div>
						</div>
					</div>

					
					<div class="price-block col-xl-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
							</div>
							<div class="price-box">
								<div class="price-title">Bronze package</div>
								<h4 class="amout">99.99</h4>
							</div>
							<ul class="features">
								<li class="true">3 month</li>
								<li class="true">30 Cities</li>
								<li class="true">500 Pointse</li>
								<li class="true">Easy Access</li>
								<li class="false">Free Contacts</li>
							</ul>
							<div class="btn-box">
								<a href="#">Buy plan</a>
							</div>
						</div>
					</div>

					
					<div class="price-block col-xl-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
							</div>
							<div class="price-box">
								<div class="price-title">Silver package</div>
								<h4 class="amout">199.99</h4>
							</div>
							<ul class="features">
                <li class="true">3 month</li>
                <li class="true">50 Cities</li>
                <li class="true">700 Pointse</li>
                <li class="true">Easy Access</li>
                <li class="ture">Free Contacts</li>
							</ul>
							<div class="btn-box">
                <a href="#">Buy plan</a>
							</div>
						</div>
					</div>
					
					<div class="price-block col-xl-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
							</div>
							<div class="price-box">
								<div class="price-title">Premium package</div>
								<h4 class="amout">199.99</h4>
							</div>
							<ul class="features">
                <li class="true">3 month</li>
                <li class="true">50 Cities</li>
                <li class="true">700 Pointse</li>
                <li class="true">Easy Access</li>
                <li class="ture">Free Contacts</li>
							</ul>
							<div class="btn-box">
                <a href="#">Buy plan</a>
							</div>
						</div>
					</div>
				
					<div class="price-block col-xl-4 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
							</div>
							<div class="price-box">
								<div class="price-title">Gold package</div>
								<h4 class="amout">199.99</h4>
							</div>
							<ul class="features">
                <li class="true">3 month</li>
                <li class="true">50 Cities</li>
                <li class="true">700 Pointse</li>
                <li class="true">Easy Access</li>
                <li class="ture">Free Contacts</li>
							</ul>
							<div class="btn-box">
                <a href="#">Buy plan</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </section> -->

	

<div id="addpopUpmodal" class="modal fade">  
  <div class="modal-dialog">  
    <div class="modal-content">  
      <div class="modal-header">  
           <button type="button" class="close button button-shadow-2 button-primary button-zakaria" data-dismiss="modal">&times;</button>  
           <h5 class="modal-title" id="plan_name"></h5>  
      </div>  
      <form role="form" action="#" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">
        <div class="modal-body">  
             <div class="blocks-information"> 
              <div class="text-left">
                <p><b>Plan details</b></p>
                <p><i class="far fa-calendar-alt" aria-hidden="true"></i> <span id="day"></span></p>
                <p><i class="fas fa-pound-sign"></i> <span id="point"></span></p>
              </div>
                <div class="row">
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
                   <input type="hidden" id="member_id" name="member_id" >
                   <div class="form-group col-md-12">
                   <p><b>Recurring (If you select your plan will automatically renew went it will expires.)</b></p>
                    <div class="common-radio-main">
                        <div class="common-radio-inner">
                           <input type="radio"  name="recurring" class="call_type" checked value="Yes" id="radio-1">
                           <label for="radio-1">
                               <span></span>
                               <p>Yes</p>
                           </label>
                        </div>
                        <div class="common-radio-inner">
                           <input type="radio" name="recurring" class="call_type" value="No" id="radio-2">
                           <label for="radio-2">
                               <span></span>
                               <p>No</p>
                           </label>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>  
        <div class="modal-footer"> 
            <button type="submit" name="submit" id="submit" value="submit" class="button button-shadow-2 button-primary button-zakaria">Submit</button> 
             <button type="button" class="button button-shadow-2 button-primary button-zakaria mt-0" data-dismiss="modal">Close</button>  
        </div> 
      </form>   
    </div>  
  </div>  
</div> 
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script type="text/javascript">

$('.modal').on('hidden.bs.modal', function(){
  $(this).find('form')[0].reset();
  $("#member_id").val('');
});

$(document).on("click","#plan_ship",function(){
  var id = $(this).attr("data-id");
  $('#member_id').val(id);
  var point = $(this).attr("data-point");
  var days = $(this).attr("data-days");
  var city = $(this).attr("data-city");
  var text = $(this).attr("data-text");

  $('#day').text(days);
  $('#city').text(city);
  $('#point').text(point);
  $('#plan_name').text(text);

  $('#addpopUpmodal').modal('show');
});


$('#form-addModels').validate({

  rules:{
    card_number :{ required: true,minlength: 16,maxlength:16 },
    mm :{ required : true },
    yy :{ required : true },
    cvv :{required : true , minlength:3 , maxlength : 3},
  },
  messages:{
    card_number :{ required : "Card no is required.",minlength:"Please enter valid card number.",maxlength: "Please enter valid card number." },
    mm :{ required : "Expiry Mouth is required." },
    yy :{ required : "Expiry Year is required." },
    cvv :{required:"CVC is required.",minlength : "Please enter valid CVC",maxlength:"Please enter valid CVC"},
  },
  submitHandler: function (form) 
    {
      var formData = new FormData($(form)[0]);
      $('#addpopUpmodal').modal('hide'); 
      $(".loading-div").show();
      $.ajax({
          url: '<?php echo APP_URL ?>MembershipPlanController/Plan_Create',
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          dataType:'json',
          success: function (response) 
          {
            setTimeout(function(){
              console.log(response);
                if(response.error == 1)
                {
                  $.notify({message: response.msg},{ type: 'danger'});
                }
                else if(response.error == 0)
                {
                  $.notify({message: response.msg},{ type: 'success'});
                  location.reload();
                  window.location = '<?php echo base_url('thank-you') ?>';
                }
              $(".loading-div").hide();  
              $('#addpopUpmodal').modal('hide'); 
            },2000);
          }
      });
    }
});

</script>