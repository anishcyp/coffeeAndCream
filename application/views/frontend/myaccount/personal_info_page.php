<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        <section class="breadcrumbs-custom">
            <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp">
                <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                    <div class="container">
                        <h2 class="text-transform-capitalize breadcrumbs-custom-title">My Account</h2>
                        <h5 class="breadcrumbs-custom-text">
                        </h5>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                        <li class="active">My Account</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section class="diary-list">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <h3>Profile:</h3>
                  <ul>
                      <li>Select the profile photo that you want clients to see</li>
                      <li>Alias name (choose the name you want your clients to see)</li>
                      <li>Please note that anything you fill out in this section is what clients will see. Double-check and
ensure that all information is correct before uploading it.</li>
                      <li>Remember to save before moving to the next step.</li>
                  </ul>
              </div>
          </div>
        </div>
      </section>
        
        <div class="edit-main-block">
        <div class="container">
            <div class="row">
                <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="common-blocks-detail">
                        <?php
                        $user_id = $this->session->userdata('front_UserId');
                        $user_role = $this->crud->get_column_value_by_id("tbl_customer","user_role","id = ".$user_id);
                        if($user_role == 1 || $user_role == 2)
                        {
                        ?>
                        <h4>profile information</h4>
                        <form id="login-page-form" name="login-page-form" method="post" action="<?= base_url("update-profile/"); ?>" enctype="multipart/form-data">
                            <div class="blocks-information">
                              <div class="row" >
                                     <div class="form-group col-md-6">
                                      <label class="form-label-custom">Profile Photo</label>
                                      <!-- <input type="file"  id="profile_image" name="profile_image"> -->
                                      <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                      <input type="hidden" name="old_profile_image" value="<?= $profile['profile_image']; ?>">
                                   </div>
                                   <div class="form-group col-md-6">
                                    <?php if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) && $profile['profile_image']!='')  { ?>
                                        <img style="width: 119px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) ?>">  
                                    <?php } else{ ?>
                                            <h5>Enter Profile Photo</h5>
                                    <?php }  ?> 
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="form-label-custom">Alias Name</label>
                                    <input type="text" name="alias_name" id="alias_name" class="form-control" value="<?= $profile['alias_name'] ?>" placeholder="Enter Alias Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-custom">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" value="<?= $profile['fname'] ?>" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-custom">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" value="<?= $profile['lname'] ?>" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-custom">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" value="<?= $profile['email'] ?>" placeholder="Email Address" required readonly>
                                </div>
                                <div class="row" >
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="<?= $profile['whatsapp_number'] ?>" placeholder="Enter WhatsApp Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control" value="<?= $profile['phone'] ?>" placeholder="Enter Phone Number" required >
                                </div>
                                </div>
                            <div class="row" >
                                <div class="form-group col-md-6">
                                  <label class="form-label-custom">Gender</label>
                                  <select name="gender" id="gender" class="form-control ">
                                      <option value="">Please select your gender</option>
                                      <option <?php echo $profile['gender'] == 'male' ? 'selected' : ''; ?>  value="male">Male</option>
                                      <option <?php echo $profile['gender'] == 'female' ? 'selected' : ''; ?> value="female">Female</option>
                                      <option <?php echo $profile['gender'] == 'other' ? 'selected' : ''; ?> value="other">Other</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Age:</label>
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
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Facilities</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="facilities" <?php echo ($profile['facilities'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="facilities" <?php echo ($profile['facilities'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->
                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="facilities" <?php echo ($profile['facilities'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-1">
                                           <label for="radio-yes-1">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="facilities" <?php echo ($profile['facilities'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-1">
                                           <label for="radio-no-1">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Disabled friendly</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="friendly" <?php echo ($profile['friendly'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="friendly" <?php echo ($profile['friendly'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="friendly" <?php echo ($profile['friendly'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-2">
                                           <label for="radio-yes-2">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="friendly" <?php echo ($profile['friendly'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-2">
                                           <label for="radio-no-2">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Showers available</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="showers_available" <?php echo ($profile['showers_available'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="showers_available" <?php echo ($profile['showers_available'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="showers_available" <?php echo ($profile['showers_available'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-3">
                                           <label for="radio-yes-3">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="showers_available" <?php echo ($profile['showers_available'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-3">
                                           <label for="radio-no-3">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Will travel to</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="will_travel_to" <?php echo ($profile['will_travel_to'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="will_travel_to" <?php echo ($profile['will_travel_to'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="will_travel_to" <?php echo ($profile['will_travel_to'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-4">
                                           <label for="radio-yes-4">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio" name="will_travel_to" <?php echo ($profile['will_travel_to'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-4">
                                           <label for="radio-no-4">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Withheld numbers</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="withheld_numbers" <?php echo ($profile['withheld_numbers'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="withheld_numbers" <?php echo ($profile['withheld_numbers'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="withheld_numbers" <?php echo ($profile['withheld_numbers'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-5">
                                           <label for="radio-yes-5">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio" name="withheld_numbers" <?php echo ($profile['withheld_numbers'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-5">
                                           <label for="radio-no-5">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Text messages</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="text_massage" <?php echo ($profile['text_massage'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="text_massage" <?php echo ($profile['text_massage'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio"  name="text_massage" <?php echo ($profile['text_massage'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-6">
                                           <label for="radio-yes-6">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio" name="text_massage" <?php echo ($profile['text_massage'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-6">
                                           <label for="radio-no-6">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label-custom">Out of hour calls</label>
                                    <!-- <div class="custom-radio" >
                                    <input type="radio" name="out_of_hour_calls" <?php echo ($profile['out_of_hour_calls'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes">Yes
                                    <input type="radio" name="out_of_hour_calls" <?php echo ($profile['out_of_hour_calls'] == "No" ? 'checked="checked"': ''); ?> value="No">No
                                    </div> -->

                                    <div class="common-radio-main">
                                        <div class="common-radio-inner">
                                           <input type="radio" name="out_of_hour_calls" <?php echo ($profile['out_of_hour_calls'] == "Yes" ? 'checked="checked"': ''); ?> value="Yes" id="radio-yes-7">
                                           <label for="radio-yes-7">
                                               <span></span>
                                               <p>Yes</p>
                                           </label>
                                        </div>
                                        <div class="common-radio-inner">
                                           <input type="radio" name="out_of_hour_calls" <?php echo ($profile['out_of_hour_calls'] == "No" ? 'checked="checked"': ''); ?> value="No" id="radio-no-7">
                                           <label for="radio-no-7">
                                               <span></span>
                                               <p>No</p>
                                           </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                
                                <div class="form-group col-md-4">
                                    <label class="form-label-custom">Country</label>
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
                                    <label class="form-label-custom">Select State</label>
                                    <select class="form-control" name="state_id" id="state_id" onchange="getCityByState1(this.value)">
                                        <option value="">Select State</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                <label class="form-label-custom">Select City</label>
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="">Select City</option>
                                </select>
                                </div>
                            </div>                   

                            <div class="form-group" style="text-align: left;">
                                <label class="form-label-custom">Introduction</label>
                                <textarea name="introduction" id="summernote" class="form-control"><?= $profile['Introduction'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label-custom">My Preferences</label>
                                <textarea name="my_preferences" placeholder="Enter preferences here..." id="my_preferences" class="form-control"><?= $profile['my_preferences'] ?></textarea>
                            </div>
                            <div class="form-group">
                            <h5>Call type</h5>
                                <div class="common-radio-main">
                                    <div class="common-radio-inner">
                                    <input type="radio"  name="call_type" <?php echo ($profile['call_type'] == "1" ? 'checked="checked"': ''); ?> class="call_type" value="1" id="radio-1">
                                    <label for="radio-1">
                                        <span></span>
                                        <p>Entertainment Services</p>
                                    </label>
                                    </div>
                                    <div class="common-radio-inner">
                                    <input type="radio" name="call_type" <?php echo ($profile['call_type'] == "2" ? 'checked="checked"': ''); ?> class="call_type" value="2" id="radio-2">
                                    <label for="radio-2">
                                        <span></span>
                                        <p>Escort Services</p>
                                    </label>
                                    </div>
                                    <div class="common-radio-inner">
                                    <input type="radio" name="call_type" <?php echo ($profile['call_type'] == "3" ? 'checked="checked"': ''); ?> class="call_type" value="3" id="radio-3">
                                    <label for="radio-3">
                                        <span></span>
                                        <p>Both Services</p>
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div <?php if($profile['call_type'] == 1){?>style="display:block" <?php  }?> class="form-group div_entertainment_serv" style="display:none">
                                <h5>Entertainment Services</h5>
                                <ul class="list-check">
                                
                                <?php 
                                foreach ($entertainment_service as $entertainment_ser) {
                                    $selected_service = explode(",",$profile['service_id']);


                                    ?>
                                    <li>
                                        <div class="checkbox-custom" >
                                            <label class="common-checkbox">
                                            <?php echo $entertainment_ser->name ?>
                                            <input name="service[]" value="<?php echo $entertainment_ser->service_id; ?>" <?php echo in_array($entertainment_ser->service_id, $selected_service) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    
                                </ul>
                                <div id ="servrice_error"></div>
                            </div>

                            <div <?php if($profile['call_type'] == 2){?>style="display:block" <?php  }?> class="form-group div_escort_serv" style="display:none">
                                <h5>Escort Services</h5>
                                <ul class="list-check">
                                
                                <?php foreach ($escort_service as $service) {
                                    $selected_service = explode(",",$profile['service_id']);


                                    ?>
                                    <li>
                                        <div class="checkbox-custom" >
                                            <label class="common-checkbox">
                                            <?php echo $service->name ?>
                                            <input name="service[]" value="<?php echo $service->service_id; ?>" <?php echo in_array($service->service_id, $selected_service) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    
                                </ul>
                                <div id ="escort_serv_error"></div>
                            </div>
                            
                            <div class="form-group">
                                <h5>Language</h5>
                                <ul class="list-check">
                                <?php foreach ($language as $language) {
                                    $sel = ($language->language_id==$profile['language_id']) ? 'selected' : '';

                                    $selected_language = explode(",",$profile['language_id']);

                                    ?>
                                    <li>
                                        <div class="checkbox-custom">
                                            <label class="common-checkbox">
                                            <?php echo $language->name ?>
                                            <input name="language[]" value="<?php echo $language->language_id; ?>" <?php echo in_array($language->language_id, $selected_language) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                <?php } ?>
                                </ul>
                            
                            </div>
                            <div id="language_error"></div>
                            <div class="form-group">
                                <h5>Favorite</h5>
                                <ul class="list-check">
                                <?php foreach ($favorite as $favorite) {
                                    $sel = ($favorite->favorite_id==$profile['favorite_id']) ? 'selected' : '';

                                    $selected_favorite = explode(",",$profile['favorite_id']);

                                    ?>
                                    <li>
                                        <div class="checkbox-custom">
                                            <label class="common-checkbox">
                                            <?php echo $favorite->name ?>
                                            <input name="favorite[]" value="<?php echo $favorite->favorite_id; ?>" <?php echo in_array($favorite->favorite_id, $selected_favorite) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <div id="favorite_error" ></div>
                            </div>
                            <div id="" ></div>
                            <div class="last-btn-blocks">
                                <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                            </div>
                        </div>
                        </form>
                        <?php 
                        }
                        else if($user_role == 5)
                        {
                        ?>
                        <h4>profile information</h4>
                        <form id="login-page-form" method="post" action="<?= base_url("update-profile/"); ?>">
                            <div class="blocks-information">
                                <div class="row" >
                                    <div class="form-group col-md-6">
                                      <label class="form-label-custom">Profile</label>
                                      <!-- <input type="file"  id="profile_image" name="profile_image"> -->
                                      <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                      <input type="hidden" name="old_profile_image" value="<?= $profile['profile_image']; ?>">
                                   </div>
                                   <div class="form-group col-md-6">
                                    <?php if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) && $profile['profile_image']!='')  { ?>
                                        <img style="width: 200px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) ?>">  
                                    <?php } else{ ?>
                                        <img style="width: 280px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.'no_logo.png') ?>">
                                    <?php }  ?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label class="form-label-custom">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" value="<?= $profile['fname'] ?>" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label class="form-label-custom">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" value="<?= $profile['lname'] ?>" placeholder="Enter Last Name">
                                    </div>
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
                                <!-- <div class="form-group">
                                <label class="form-label-custom">Gender</label>
                                <select name="gender" id="gender" class="form-control ">
                                    <option value="">Please select your gender</option>
                                    <option <?php echo $profile['gender'] == 'male' ? 'selected' : ''; ?>  value="male">Male</option>
                                    <option <?php echo $profile['gender'] == 'female' ? 'selected' : ''; ?> value="female">Female</option>
                                    <option <?php echo $profile['gender'] == 'other' ? 'selected' : ''; ?> value="other">Other</option>
                                </select>
                                </div> -->
                                <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                            </div>
                        </form>
                        <?php
                        }
                        else
                        {
                        ?>
                        <h4>profile information</h4>
                        <form id="login-page-form" name="login-page-form" method="post" action="<?= base_url("update-profile/"); ?>" enctype="multipart/form-data">
                            <div class="blocks-information">
                                <div class="form-group">
                                    <label class="form-label-custom">Agency name</label>
                                    <input type="text" name="agency_name" id="agency_name" class="form-control" value="<?= $profile['agency_name']; ?>" placeholder="Agency name">
                                </div>
                                
                                <div class="row" >
                                    <div class="form-group col-md-6">
                                      <label class="form-label-custom">Logo</label>
                                      <!-- <input type="file"  id="profile_image" name="profile_image"> -->
                                      <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                      <input type="hidden" name="old_profile_image" value="<?= $profile['profile_image']; ?>">
                                   </div>
                                   <div class="form-group col-md-6">
                                    <?php if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) && $profile['profile_image']!='')  { ?>
                                        <img style="width: 280px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile['profile_image']) ?>">  
                                    <?php } else{ ?>
                                        <img style="width: 280px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.'no_logo.png') ?>">
                                    <?php }  ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label-custom">Contact name</label>
                                    <input type="text" name="contact_name" id="contact_name" class="form-control" value="<?= $profile['contact_name']; ?>" placeholder="Contact name">
                                </div>

                                <!-- <div class="form-group">
                                    <label class="form-label-custom">Contact name</label>
                                    <input type="text" name="contact_name" id="contact_name" class="form-control" value="" placeholder="Contact name">
                                </div> -->
                                
                                <div class="form-group">
                                    <h5>Primary Identity</h5>
                                    <div style="text-align: left;">
                                    <a href="javascript:void(0)" class="btn btn-primary" id="card_show"><i class="fas fa-id-card"></i> Add new identity</a>
                                    <a href="javascript:void(0)" class="btn btn-primary" id="card_hide"><i class="fas fa-id-card"></i> Add new identity</a>
                                    </div>
                                    
                                </div>
                                <div class="row" id="cards">
                                    <div class="form-group col-md-6">
                                    <label class="form-label-custom">Gender</label>
                                    <select name="agency_gender" id="agency_gender" class="form-control ">
                                        <option value="">Please select your gender</option>
                                        <option <?php echo $profile['agency_gender'] == 'male' ? 'selected' : ''; ?>  value="male">Male</option>
                                        <option <?php echo $profile['agency_gender'] == 'female' ? 'selected' : ''; ?> value="female">Female</option>
                                        <option <?php echo $profile['agency_gender'] == 'other' ? 'selected' : ''; ?> value="other">Other</option>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label-custom">Age:</label>
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
                                        <label class="form-label-custom">Nationality</label>
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
                                        <label class="form-label-custom">First Name</label>
                                        <input type="text" name="fname" id="fname" class="form-control" value="<?= $profile['fname'] ?>" placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label-custom">Last Name</label>
                                        <input type="text" name="lname" id="lname" class="form-control" value="<?= $profile['lname'] ?>" placeholder="Last Name">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label class="form-label-custom">Identification photo</label>
                                      <p>Please provide a scanned passport, driving licence or National ID so we can verify this information. Valid formats are jpg, png and pdf</p>
                                      <!-- <input type="file"  id="profile_image" name="profile_image"> -->
                                      <input type="file" class="form-control" id="identification_photo" name="identification_photo" accept="image/*">
                                      <input type="hidden" name="old_identification_photo" value="<?= $profile['identification_photo']; ?>">
                                   </div>
                                   <div class="form-group col-md-6">
                                    <?php if(file_exists(UPLOAD_DIR.USER_PROFILE_IMG.$profile['identification_photo']) && $profile['identification_photo']!='')  { ?>
                                        <img style="width: 119px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$profile['identification_photo']) ?>">  
                                    <?php } ?> 
                                    </div>

                                </div>
                                <div class="row" >
                                    
                                    <div class="form-group col-md-6">
                                        <!-- <label class="form-label-custom">Select State</label> -->
                                        <h5>State</h5>
                                        <select class="form-control" name="state_id" id="state_id" onchange="getCityByState(this.value)">
                                        <option value="">Select State</option>
                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <!-- <label class="form-label-custom">Select City</label> -->
                                        <h5>City</h5>
                                        <select class="form-control" name="city_id" id="city_id">
                                        
                                        <option value="">Select City</option>
                                        </select>
                                    </div>
                                                                                                            
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label-custom">Summary :</label>
                                    <textarea name="summary" id="summary" class="form-control"><?= $profile['summary'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label-custom">Full Description</label>
                                    <textarea name="introduction" placeholder="Enter Your profile introduction here..." id="introduction" class="form-control"><?= $profile['Introduction'] ?></textarea>
                                </div>

                                <div class="form-group" >
                                    <h5>Entertainment Services</h5>
                                    <ul class="list-check">
                                    
                                      <?php 
                                      foreach ($entertainment_service as $entertainment_ser) {
                                        $selected_service = explode(",",$profile['agency_service_id']);
                                        ?>
                                        <li>
                                            <div class="checkbox-custom" >
                                                <label class="common-checkbox">
                                                <?php echo $entertainment_ser->name ?>
                                                <input name="service[]" value="<?php echo $entertainment_ser->service_id; ?>" <?php echo in_array($entertainment_ser->service_id, $selected_service) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <?php } ?>
                                        
                                    </ul>
                                    <div id ="servrice_error"></div>
                                </div>

                                <div class="form-group" >
                                    <h5>Escort Services</h5>
                                    <ul class="list-check">
                                    
                                      <?php foreach ($escort_service as $service) {
                                        $selected_service = explode(",",$profile['agency_service_id']);

                                        ?>
                                        <li>
                                            <div class="checkbox-custom" >
                                                <label class="common-checkbox">
                                                <?php echo $service->name ?>
                                                <input name="service[]" value="<?php echo $service->service_id; ?>" <?php echo in_array($service->service_id, $selected_service) ? "checked" : ""; ?> type="checkbox" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <?php } ?>
                                        
                                    </ul>
                                    <div id ="escort_serv_error"></div>
                                </div>

                                <div class="form-group">
                                    <h5>Working hours</h5>
                                    <ul class="list-check">
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Monday
                                                <input name="hrs_monday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_mon'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_mon_value" class="form-control" value="<?= $profile['hrs_mon'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Tuesday
                                                <input name="hrs_tuesday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_tue'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_tue_value" class="form-control" value="<?= $profile['hrs_tue'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Wednesday
                                                <input name="hrs_wednesday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_wed'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_wed_value" class="form-control" value="<?= $profile['hrs_wed'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Thursday
                                                <input name="hrs_thursday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_thu'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_thu_value" class="form-control" value="<?= $profile['hrs_thu'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Friday
                                                <input name="hrs_friday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_fri'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_fri_value" class="form-control" value="<?= $profile['hrs_fri'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Saturday
                                                <input name="hrs_saturday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_sat'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_sat_value" class="form-control" value="<?= $profile['hrs_sat'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom">
                                                <label class="common-checkbox">
                                                Sunday
                                                <input name="hrs_sunday" value="1" type="checkbox" class="checkbox-custom" <?php echo $profile['hrs_sun'] > 0 ? "checked" : "" ?>><span class="checkbox-custom-dummy"></span>
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group mt-1 p-1">
                                                <input type="number" name="hrs_sun_value" class="form-control" value="<?= $profile['hrs_sun'] ?>" min="0" max="24">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                
                                <div class="last-btn-blocks">
                                    <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                                </div>
                            </div>
                        </form> 
                        <?php
                        }
                        ?>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$('#summernote').summernote({
    placeholder: 'Enter Your profile introduction here...',
    tabsize: 2,
    height: 100,
});

$('#includes').summernote({
    placeholder: 'Plus Package..',
    tabsize: 2,
    height: 100,
});

$('#extra_details').summernote({
    placeholder: 'Enter Extra Details..',
    tabsize: 2,
    height: 100,
});

$(document).ready(function(){
    $('#cards').hide();
    $('#card_show').show();
    $('#card_hide').hide();
    
});

$("#card_show").on("click", function(){
    $('#cards').show();
    $('#card_hide').show();
    $('#card_show').hide();
    
});

$("#card_hide").on("click", function(){
    $('#cards').hide();
    $('#card_hide').hide();
    $('#card_show').show();
});


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
  </script>

<script type="text/javascript">

 $(document).ready(function(){
    $("#login-page-form").validate({
       ignore: [],
       rules: {              
          alias_name:{required : true,remote: {url: "<?=base_url()?>check-alias-name",
                  type: "post",
                  data: {
                    alias_name: function() {
                      return $( "#alias_name" ).val();
                    }
                  }
             }},
          fname:{required : true},
          lname:{required : true},
          gender:{required : true},
          age:{required : true},
          call_type :{required : true},
          phone_no:{required : true},
          email:{required : true,email:true},
          Introduction:{required : true},
          country_id:{required : true},
          my_preferences:{required : true},
         "service[]": {required: true},
         "language[]": {required: true},
         "favorite[]": {required: true},
       },
       messages: {
          alias_name : { required:"Please enter alias name",remote: "Alias name is already taken."},
          fname : { required:"Please enter first name" },
          lname : { required:"Please enter last name" },
          gender : { required : "Plaese select gender"},
          age : { required : "Plaese select age"},
          call_type : { required : "Plaese select one service"},
          phone_no : { required : "Plaese enter phone no"},
          email : { required:"Please enter email"},
          Introduction : { required:"Please enter introduction details" },
          country_id : {required:"Please select your country"},
          my_preferences : { required:"Please enter preferences details" },
          "service[]" : { required:"Please select at least one Service. " },
          "language[]" : { required:"Please select at least one language. " },
          "favorite[]" : { required:"Please select at least one favorite. " },
       }, 
       errorPlacement: function(error, element) {
        if (element.attr('name') == 'service[]')
        {
            error.insertAfter("#servrice_error");
        }
        else if(element.attr('name') == 'language[]')
        {
            error.insertAfter("#language_error");
        }
        else if(element.attr('name') == 'favorite[]')
        {
            error.insertAfter("#favorite_error");
        }
        else
        {
            error.insertAfter(element);
        }

       }
    });
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
                // if(state_id!="")
                // {
                //     $('#state_id option[value='+state_id+']').attr('selected','selected');
                // }
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


    $(document).ready(function(){
       
    $(".call_type").on("click", function(){
        var chk = $('input[name="call_type"]:checked').val();
        
        if(chk == 1)
        {
            $(".div_entertainment_serv").show();
            $(".div_escort_serv").hide();
        }
        else if(chk == 2)
        {
            $(".div_entertainment_serv").hide();
            $(".div_escort_serv").show();
        }
        else
        {
            $(".div_escort_serv, .div_entertainment_serv").show();
        }

        });
    });

    
</script>
    </body>
</html>