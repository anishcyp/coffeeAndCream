<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Contact Method</h2>
              <h5 class="breadcrumbs-custom-text">

              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Contact Method</li>
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
                 <h4>Contact Method</h4>
                  <form id="login-page-form" method="post" action="<?= base_url("store-contact/"); ?>">
                    <div class="blocks-information">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Phone Number</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" value="<?= $profile['phone'] ?>" placeholder="Enter Phone Number" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="<?= $profile['whatsapp_number'] ?>" placeholder="Enter WhatsApp Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $profile['email'] ?>" placeholder="Email Address" required readonly>
                        </div>
                        <?php 
                        $web = array();
                        if($profile['website'] != ""){
                          $web = explode(",",$profile['website']);
                        }

                        ?>
                        <input type="hidden" id="email_count" value="<?php echo !empty($web) ? count($web) : 1; ?>">
                        <div id="email_result">
                         <?php if(!empty($web) && count($web) > 0){ 
                            $w_i = 1;
                            foreach($web as $w){ ?>
                                <div class="row <?php echo $w_i == 1 ? "" : "mt-0"; ?>" id="email_<?= $w_i ?>"> 
                                  <div class="form-group col-md-8">
                                      <?php if($w_i == 1){ ?> 
                                        <label class="form-label-custom">Website</label>
                                      <?php } ?>
                                      <input type="text" name="website[]" id="website" class="form-control" value="<?=  $w ?>" placeholder="Website">
                                  </div>
                                  <div class="col-md-1">
                                      <div class="form-group <?php echo $w_i == 1 ? "mt-2" : " "; ?>">
                                          <?php if($w_i == 1){ ?> 
                                            <a class="button button-shadow-2 button-primary add_email_button mt-4"><i class="fa fa-plus"></i></a>
                                          <?php }else{ ?> 
                                            <a class="button button-shadow-2 button-primary remove_email_button" data-id="<?= $w_i ?>"><i class="fa fa-minus"></i></a>
                                          <?php } ?>
                                      </div>
                                  </div>
                                </div>
                               
                          <?php $w_i++; } 
                        }else{ ?> 
                          <div class="row" id="email_1"> 
                                  <div class="form-group col-md-8">
                                        <label class="form-label-custom">Website</label>
                                      <input type="text" name="website[]" id="website" class="form-control" value="" placeholder="Website">
                                  </div>
                                  <div class="col-md-1">
                                      <div class="form-group mt-2">
                                               <a class="button button-shadow-2 button-primary add_email_button mt-4"><i class="fa fa-plus"></i></a>
                                      </div>
                                  </div>
                                </div>
                        <?php } ?>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Facebook</label>
                                <input type="text" id="facebook" name="facebook" value="<?= $profile['facebook'] ?>" class="form-control" placeholder="Facebook">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Pinterest</label>
                                <input type="text" id="pinterest" name="pinterest" value="<?= $profile['pinterest'] ?>" class="form-control" placeholder="Pinterest">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Twitter</label>
                                <input type="text" id="twitter" name="twitter" value="<?= $profile['twitter'] ?>" class="form-control" placeholder="Twitter">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Instagram</label>
                                <input type="text" id="instagram" name="instagram" value="<?= $profile['instagram'] ?>" class="form-control" placeholder="Instagram">
                            </div>
                        </div>
                        <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                   </div>
                  </form>
               </div>
            </div>
          </div>
      </div>
    </div>

  
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js"></script>
<script type="text/javascript">
// $(document).ready(function(){
//     $("#rates-page-form").validate({
//         ignore: [],
//         rules: {              
//         discription:{required : true},
//         rates:{required : true},
//         },
//         messages: {
//         discription : { required:"Please enter description" },
//         rates : { required:"Please enter rates" },                       
//         }, 
//         errorPlacement: function(error, element) {
//         error.insertAfter(element);            
//         }
//     });
// });

var input = document.querySelector("#phone_no");
intlTelInput(input, {
  initialCountry: "auto",
  geoIpLookup: function (success, failure) {
    $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
      var countryCode = (resp && resp.country) ? resp.country : "uk";
      success(countryCode);
    });
  },
});

var input = document.querySelector("#whatsapp_number");
intlTelInput(input, {
  initialCountry: "auto",
  geoIpLookup: function (success, failure) {
    $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
      var countryCode = (resp && resp.country) ? resp.country : "uk";
      success(countryCode);
    });
  },
});


$(document).on("click", ".add_email_button", function () {
  $count = $("#email_count").val();
  $count++;
  $("#email_result").append(`<div class="row mt-0" id="email_`+$count+`"> 
                              <div class="form-group col-md-8">
                                  <input type="text" name="website[]" id="website" class="form-control" value="" placeholder="Website">
                              </div>
                              <div class="col-md-1">
                                  <div class="form-group">
                                      <!-- <a type="button" class="btn btn-primary waves-effect waves-light btn-success add_button"></a> -->
                                      <a class="button button-shadow-2 button-primary button-zakaria remove_email_button" data-id="`+$count+`"><i class="fa fa-minus"></i></a>
                                  </div>
                              </div>
                          </div>`);
});


$(document).on("click", ".remove_email_button", function () {
  $id = $(this).data('id');
    $("#email_"+$id+"").remove();
}); 






</script>
</body>
</html>