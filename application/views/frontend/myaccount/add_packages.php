<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Add Hen Stage Package</h2>
              <h5 class="breadcrumbs-custom-text">

              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Add Hen Stage Package</li>
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
                 <h4>Add Hen Stage Package</h4>
                 <form id="login-page-form" name="login-page-form" method="post" action="<?= base_url("packages/store"); ?>" enctype="multipart/form-data">
                      <div class="blocks-information">
                          <div class="form-group">
                              <label class="form-label-custom">Package name</label>
                              <input type="text" name="compnay_name" id="compnay_name" class="form-control" value="<?= $profile['compnay_name']; ?>" placeholder="Compnay name">
                          </div>
                          
                          <div class="row" >
                              <div class="form-group col-md-6">
                                <label class="form-label-custom">Profile</label>
                                <!-- <input type="file"  id="profile_image" name="profile_image"> -->
                                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                <input type="hidden" name="old_profile_image" value="<?= $profile['profile_image']; ?>">
                              </div>
                              <div class="form-group col-md-6">
                              <?php if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) && $profile['profile_image']!='')  { ?>
                                  <img style="width: 115px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) ?>">  
                              <?php } else{ ?>
                                  <img style="width: 115px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.'default.png') ?>">
                              <?php }  ?> 
                              </div>
                          </div>
                          <div class="row" >
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Accommodation Category</label>
                                  <select class="form-control" name="category" id="category">
                                      <option>Select Category</option>
                                      <option <?php echo $profile['category'] == 'day' ? 'selected' : ''; ?> value="day">Daytime Activities</option>
                                      <option <?php echo $profile['category'] == 'evening' ? 'selected' : ''; ?> value="evening">Evening Activities</option>
                                      <option <?php echo $profile['category'] == 'transfer' ? 'selected' : ''; ?> value="transfer">Airport Transfers</option>
                                      <option <?php echo $profile['category'] == 'accommodation' ? 'selected' : ''; ?> value="accommodation">Accommodation</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Coutry</label>
                                  <select class="form-control" name="country_id" id="country_id" onchange="getStateListbyCountry1(this.value)">
                                  <option value="">Select Country</option>
                                  <?php foreach ($countrylists as $countrylist) {
                                      $country_select = ($countrylist->country_id==$profile['country_id']) ? 'selected' : '';
                                      ?>
                                      <option <?php echo $country_select; ?> value="<?php echo $countrylist->country_id; ?>"><?php echo $countrylist->name; ?></option>
                                  <?php } ?>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">State</label>
                                  <select class="form-control" name="state_id" id="state_id" onchange="getCityByState(this.value)">
                                  <option value="">Select State</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">City</label>
                                  <select class="form-control" name="city_id" id="city_id">
                                  <option value="">Select City</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Review</label>
                                  <input type="text" name="review" id="review" class="form-control" value="<?= $profile['review'] ?>" placeholder="Enter statice review">
                              </div>  
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Per person charge</label>
                                  <input type="text" name="charge" id="charge" class="form-control" value="<?= $profile['charge'] ?>" placeholder="Enter per person charge">
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Minimum People</label>
                                  <input type="text" name="minimum_p" id="minimum_p" class="form-control" value="<?= $profile['minimum_p'] ?>" placeholder="Enter minimum people">
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Maximum People</label>
                                  <input type="text" name="maximum_p" id="maximum_p" class="form-control" value="<?= $profile['maximum_p'] ?>" placeholder="Enter maximum people">
                              </div>  
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">ID Required</label>
                                  <input type="text" name="id_required" id="id_required" class="form-control" value="<?= $profile['id_required'] ?>" placeholder="Enter ID Photos ..">
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Start Times</label>
                                  <input type="text" name="start_time" id="start_time" class="form-control" value="<?= $profile['start_time'] ?>" placeholder="Enter Start times">
                              </div>  
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Minimum Age:</label>
                                  <select name="age" id="age">
                                      <option value="">Please select your age</option>
                                      <?php
                                      for ($i=18; $i <= 50 ; $i++) { 
                                      $sel = ($i==$profile['age']) ? 'selected' : '';
                                      ?>
                                      <option <?php echo $sel; ?> value="<?php echo $i ?>" ><?php echo $i ?></option>
                                      <?php
                                      }
                                      ?>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label-custom">Runs</label>
                                  <input type="text" name="runs" id="runs" class="form-control" value="<?= $profile['runs'] ?>" placeholder="EX: 1 jan - 31 dec">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="form-label-custom">Useful Info</label>
                              <input type="text" name="use_info" id="use_info" class="form-control" value="<?= $profile['use_info'] ?>" placeholder="Enter useful inforamtion">
                          </div>
                          <div class="form-group" style="text-align: left;">
                              <label class="form-label-custom">Extra Details</label>
                              <textarea name="extra_details" id="extra_details" class="form-control"><?= $profile['extra_details'] ?></textarea>
                          </div>
                          <div class="form-group" style="text-align: left;">
                              <label class="form-label-custom">Includes</label>
                              <textarea name="includes" id="includes" class="form-control"><?= $profile['includes'] ?></textarea>
                          </div>
                          <div class="form-group">
                              <label class="form-label-custom">Overview</label>
                              <textarea name="introduction" placeholder="Enter Overview..." id="introduction" class="form-control"><?= $profile['introduction'] ?></textarea>
                          </div>
                          <?php 
                            if($profile['id'] != "")
                            {
                              $mode = 'edit';
                            }
                            else
                            {
                              $mode = "add";
                            }

                            ?>
                            
                            <input type="hidden" id="type" name="type" value="<?= $mode ?>">
                            <input type="hidden" id="editid" name="editid" value="<?= $profile['id'] ?>">

                          <div class="last-btn-blocks">
                              <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                          </div>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>>
<script type="text/javascript">

$('#summernote').summernote({
    placeholder: 'Hen stag accommodation Description',
    tabsize: 2,
    height: 100,
});


$('#form-addModels').on('submit', function(e) {
  
  if($('#summernote').summernote('isEmpty')) 
  {
    alert('Description is required')
    e.preventDefault();
  }
});

function getStateListbyCountry1(country_id, state_id = "")
{
    var id = country_id;
    
    $.ajax({
        url: baseURL+'CommonController/getStateByCountry',
        type: "POST",
        data: "id="+id,
        success: function (data) {
            data = JSON.parse(data);
            var list = '<option value="">No state found</option>';
            if( data != 'blank' )
            {
                list = '<option value="">Select State</option>';
                $.each( data, function(index, item) {
                  //alert(item.state_id);
                    list += '<option value="'+item.state_id+'"';
                    if(item.state_id == state_id){
                        list += 'selected';
                    }
                    list += '>'+item.name+'</option>';
                });
            }

          $("#state_id").html(list);
        }
    });
}

function getCityByState1(state_id,city_id="")
{
    if(state_id!="")
    {
    var id = state_id;
    }
    
    $.ajax({
        url: baseURL+'CommonController/getCityByState',
        type: "POST",
        data: "id="+id,
        success: function (data) {
            data = JSON.parse(data);
            var list = '<option value="">No City found</option>';
            if( data != 'blank' )
            {
                list = '<option value="">Select City</option>';
                $.each( data, function(index, item) {
                    // alert(item.city_id);
                    list += '<option value="'+item.id+'"';
                    if(item.id == city_id){
                        list += 'selected';
                    }
                    list += '>'+item.name+'</option>';
                });
            }
            $("#city_id").html(list);
        },
    });
}

<?php 
    $country_id = isset($profile['country_id']) && $profile['country_id'] > 0 ? $profile['country_id'] : "";
    $state_id = isset($profile['state_id']) && $profile['state_id'] > 0 ? $profile['state_id'] : "";
    $city_id = isset($profile['city_id']) && $profile['city_id'] > 0 ? $profile['city_id'] : "";

    if($state_id > 0 && $country_id > 0){ ?>
        getStateListbyCountry1(<?= $country_id ?>, <?= $state_id ?>);
    <?php } 
    if($state_id > 0 && $city_id > 0){ ?>
        getCityByState1(<?= $state_id ?>,<?= $city_id ?>);
    <?php } ?>
    

</script>
</body>
</html>