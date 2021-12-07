<link href="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND; ?>assets/plugins/bx-slider/jquery.bxslider.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.view-class {
border-bottom: 0.25px solid rgba(152, 152, 152, 0.8);
}
</style>
<!-- Start content -->
<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="page-title-box">
               <h4 class="page-title">User Details</h4>
               <ol class="breadcrumb p-0 m-0">
                  <li>
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="active">
                     User Details
                  </li>
               </ol>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <!-- end row -->
      <div class="card-box table-responsive">
         <p class="text-muted font-13 m-b-30">
            <a href="<?php echo ADMIN_LINK; ?>manage-user" class="btn btn-primary waves-effect waves-light pull-right">Back</a>
         </p>
         <div class="col-lg-12">
            <hr>
            
            <!-- End : Business Detail -->
            <!-- Start : Business Additional Options -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  User Information
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition5"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition5" class="panel-collapse collapse">
                  <div class="panel-body">
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Profile Image</label>

                        <?php
                          if($edit['profile_image'] !='')  {
                            ?>
                              <img width="100" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$edit['profile_image']) ?>">
                            <?php
                            }
                            ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Alias Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['alias_name'] ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['fname']." ".$edit['lname']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Email</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['email']; ?>">
                     </div>
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Age</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['age']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">WhatsApp Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['whatsapp_number']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Phone Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['phone']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Gender</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['gender']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Introduction</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['Introduction']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Facilities</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['facilities']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Disabled friendly</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['friendly']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Showers available</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['showers_available']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Will travel to</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['will_travel_to']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Call type</label>
                        <?php 
                        if($edit['call_type'] == 1){
                           $call_type = "Entertainment Services";
                        }
                        elseif($edit['call_type'] == 2)
                        {
                           $call_type = "Escort service";
                        }
                        else
                        {
                           $call_type = "Entertainment Services & Escort service";
                        } 
                        ?>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $call_type; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Withheld numbers</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['withheld_numbers']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Text messages</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['text_massage']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Out of hour calls</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['out_of_hour_calls']; ?>">
                     </div>
                     <?php 
                        $country = $this->crud->get_column_value_by_id("country","name","country_id = '".$edit['country_id']."'");
                     ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">Country</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $country ?>">
                     </div>
                     <?php 
                        $state = $this->crud->get_column_value_by_id("state","name","state_id = '".$edit['state_id']."'");
                     ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">State</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $state; ?>">
                     </div>
                     <?php 
                        $city = $this->crud->get_column_value_by_id("city","name","id = '".$edit['city_id']."'");
                     ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">City</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $city; ?>">
                     </div>

                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">Interests</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['interests']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Dream Job</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['dream_job']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Relationship Status</label>
                        <?php 
                        $relationship_status_name = $edit['relationship_status_id'];
                           $relationship = $this->crud->get_column_value_by_id("relationship_status","name","id = '".$relationship_status_name."'");
                                ?>
                                    <input type="text" class="form-control view-class" readonly="" value="<?= $relationship; ?>">
                                <?php
                        ?>
                        
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Heroes</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['heroes']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Smoker</label>
                        <?php 
                        $smoker_name = $edit['smoker_id'];
                           $smoker_name_ = $this->crud->get_column_value_by_id("smoker","name","id = '".$smoker_name."'");
                                ?>
                                    <input type="text" class="form-control view-class" readonly="" value="<?= $smoker_name_; ?>">
                                <?php
                        ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Drinker</label>
                        <?php 
                        $drinker_name = $edit['drinker_id'];
                           $drinker_name_ = $this->crud->get_column_value_by_id("drinker","name","id = '".$drinker_name."'");
                                ?>
                                    <input type="text" class="form-control view-class" readonly="" value="<?= $drinker_name_; ?>">
                                <?php
                        ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Place</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_place']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Music</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_music']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Movies</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_movies']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite TV Shows</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_tv_shows']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Writers / Books</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_writers_books']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Cuisine</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_cuisine']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Pub / Club</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_club']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Drink</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_drink']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Favourite Quotation</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['favourite_quotation']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Biography</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['biography']; ?>">
                     </div> -->

                     <div class="form-group col-md-4">
                     <label class="control-label">Entertainment Services</label><br>
                     <?php 
                        $selected_service = explode(",",$edit['service_id']);

                        if($selected_service != '')
                        {
                            foreach ($selected_service as $service) 
                            {
                              $service_type = $this->crud->get_column_value_by_id("service","service_type","service_id = '".$service."'");
                              if($service_type == 1)
                              {
                                $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$service."'");
                                echo $service_name."<br>";
                              }
                            } 
                        } ?>
                     </div>

                     <div class="form-group col-md-4">
                     <label class="control-label">Escort Services</label><br>
                     <?php 
                        $selected_service = explode(",",$edit['service_id']);

                        if($selected_service != '')
                        {
                            foreach ($selected_service as $service) 
                            {
                              $service_type = $this->crud->get_column_value_by_id("service","service_type","service_id = '".$service."'");
                              if($service_type == 2)
                              {
                                $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$service."'");
                                echo $service_name."<br>";
                              }
                            } 
                        } ?>
                     </div>

                     <div class="form-group col-md-4">
                        <label class="control-label">Language</label><br>
                        <?php 
                        $selected_language = explode(",",$edit['language_id']);
                        if($selected_language != '')
                        {
                            foreach ($selected_language as $language) 
                            {
                                $language_name = $this->crud->get_column_value_by_id("language","name","language_id = '".$language."'");
                                echo $language_name."<br>";
                            }
                        }
                        ?>
                     </div>

                     <div class="form-group col-md-4">
                        <label class="control-label">Favorite</label><br>
                        <?php 
                        $selected_favorite = explode(",",$edit['favorite_id']); 
                        foreach ($selected_favorite as $favorite) 
                        {
                            $favorite_name = $this->crud->get_column_value_by_id("favorite","name","favorite_id = '".$favorite."'");
                            echo $favorite_name."<br>";
                         }
                        ?>
                     </div>
                  </div>
                  
               </div>  
            </div>

            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Membership plan Details
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition1"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition1" class="panel-collapse collapse ">
                  <div class="panel-body">

                     <?php if(is_array($plan)){
                      foreach($plan as $plans) { 
                     /*$user_name = $this->crud->get_column_value_by_id("tbl_customer","fname","id = '".$plans->uid."'");*/
                       ?>
                     <div class="form-group col-md-3">
                        <label class="control-label">User Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['fname'].' '.$edit['lname'] ?>">
                     </div>
                     <div class="form-group col-md-3">
                        <label class="control-label">Plan Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $plans->plan_nickname ?>">
                     </div>
                     <div class="form-group col-md-3">
                        <label class="control-label">Amount</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $plans->amount ?>">
                     </div>
                     <div class="form-group col-md-3">
                        <label class="control-label">Interval</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?=$plans->interval_count .' '. $plans->custom_interval ?>">
                     </div>
                     <div class="form-group col-md-6">
                        <label class="control-label">Plan Cities</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $plans->no_plan_cities ?>">
                     </div>
                     <div class="form-group col-md-6">
                        <label class="control-label">Plan Validity</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?=$plans->created_at .' To '. $plans->end_date ?>">
                     </div>
                     <?php } } ?>
                  </div>
               </div>  
            </div>

            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Payment Details
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition8"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition8" class="panel-collapse collapse">
                  <div class="panel-body">
                     <?php 
                     if($deposit != '')
                     {
                        foreach($deposit as $deposits)
                        {
                     ?>
                     <div class="row">
                        <h5><b>Entertainer User details</b></h5>
                        <div class="form-group col-md-2">
                            <label class="control-label">User Name</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->fname.' '.$deposits->lname ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Email id</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->email ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Phone no</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->phone ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Payment Date</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->payment_date ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Payment Type</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->payment_type ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Amount</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->amount ?>">
                        </div>
                        <?php if($deposits->txn_id != ''){ ?>
                        <div class="form-group col-md-2">
                            <label class="control-label">Transaction id :</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->txn_id ?>">
                        </div>                            
                           <?php
                           } 
                           else
                           {
                              ?>
                              <div class="form-group col-md-2">
                               <label class="control-label">Transaction id :</label>
                               <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->stripe_charge_id ?>">
                              </div>
                              <?php
                           }
                           ?>
                        
                        <div class="form-group col-md-2">
                           <?php $service_name = $this->crud->get_column_value_by_id("service","name","service_id = '".$deposits->service_id."'"); ?>
                            <label class="control-label">Service name :</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $service_name ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Time You Want Entertainer :</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->time_entertainer ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Venue/Location of booking :</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->location_booking ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">What is the celebration? :</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->celebration ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Total cost agreed by entertainer and customer?</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->agreed_enter_cust ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Balance to paid in cash after deposit </label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $deposits->cash_balance ?>">
                        </div>
                     </div>
                     <div class="row">
                        <h5><b>Advert User details</b></h5>
                        <?php $user_d = $this->crud->get_one_row("tbl_customer",array("id"=>$deposits->uid)); ?>
                        <div class="form-group col-md-2">
                            <label class="control-label">User Name </label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $user_d['fname'] . ' '. $user_d['lname'] ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Email id</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $user_d['email'] ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">Phone no</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $user_d['phone'] ?>">
                        </div>
                     </div>
                     <?php
                     }
                     }
                     ?>
                  </div>
               </div>  
            </div>

            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Call Rates
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition1"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition1" class="panel-collapse collapse ">
                  <div class="panel-body">

                     <?php if(is_array($call_rates)){
                      foreach($call_rates as $call_rates) {  ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">Description</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $call_rates->decscription; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Call Rates</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $call_rates->rates; ?>">
                     </div>
                     <?php } } ?>
                  </div>
               </div>  
            </div>



            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Payment Info
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition2"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition2" class="panel-collapse collapse ">
                  <div class="panel-body">

                     <?php if(is_array($payment)){
                     foreach($payment as $payment) {  ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">Payment Type</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $payment->payment_type; ?>">
                     </div>
                     <?php 
                   
                     if($payment->payment_type=='card'){ ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">Card Details</label>
                        <input type="text" class="form-control view-class" readonly="" value="Card Name :<?= $payment->card_name; ?>">
                        <input type="text" class="form-control view-class" readonly="" value="Card Number :<?= $payment->card_no; ?>">
                        <input type="text" class="form-control view-class" readonly="" value="Expiry Month :<?= $payment->expiry_month; ?>">
                        <input type="text" class="form-control view-class" readonly="" value="Expiry Year :<?= $payment->expiry_year; ?>">
                     </div>
                     <?php } else {?>

                        <div class="form-group col-md-6">
                        <label class="control-label">Paypal Details</label>
                        <input type="text" class="form-control view-class" readonly="" value="Paypal Id  : <?= $payment->paypal; ?>">
                     </div>
                     <?php }  } } ?>
                  </div>
                  
                  <!-- End : Business Additional Options -->
               </div>  
            </div>



            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Location
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition3"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               
               <div id="busness-addition3" class="panel-collapse collapse ">

                  <div class="panel-body">
                    <?php
                    if(is_array($location)){


                    foreach ($location as $location_details) 
                    {
                        $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$location_details->country_id."'");
                        $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$location_details->state_id."'");
                        ?>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Country Name</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $country_name; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">State Name</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $state_name; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">City Name</label><br>
                            <?php 
                            $exp_city = explode(",", $location_details->city_id);
                            foreach ($exp_city as $exp_city_val) 
                            {
                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$exp_city_val."'");
                                echo $city_name."<br>";
                            }
                            ?>
                        </div>
                        </div>
                        <?php
                    }
                  }
                    ?>
                  </div>
               </div>  
            </div>



                <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  My Diary
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition4"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               
               <div id="busness-addition4" class="panel-collapse collapse ">



                  <div class="panel-body"> 
                    <?php
                    if(is_array($diary)){
                    foreach ($diary as $diary_details) 
                    {
                        $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$diary_details->country_id."'");
                        $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$diary_details->state_id."'");
                        ?>
                    <div class="row">

                       <div class="form-group col-md-6">
                            <label class="control-label">From Date</label>
                              <input type="text" class="form-control view-class" readonly="" value="<?php echo date("d-m-Y",strtotime($diary_details->from_date)); ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">To Date</label>
                              <input type="text" class="form-control view-class" readonly="" value="<?php echo date("d-m-Y",strtotime($diary_details->to_date)); ?>">
                        </div>
                        <br>

                        <div class="form-group col-md-4">
                            <label class="control-label">Country Name</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $country_name; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">State Name</label>
                            <input type="text" class="form-control view-class" readonly="" value="<?= $state_name; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">City Name</label><br>
                            <?php 
                            $diary_city = explode(",", $diary_details->city_id);
                            foreach ($diary_city as $diary_city_val) 
                            {
                                $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$diary_city_val."'");
                                echo $city_name."<br>";
                            }
                            ?>
                        </div>
                        </div>
                        <?php
                    }
                  }
                    ?>
                  </div>
               </div>  
            </div>
         </div>
      </div>
      <!-- container -->
   </div>
   <!-- content -->
   <!-- Start : Slider  -->
   <script src="<?php echo BACKEND; ?>assets/plugins/bx-slider/jquery.bxslider.min.js"></script>
   <script>
   $(document).ready(function () {
   $('.property-slider').bxSlider({
   pagerCustom: '#bx-pager'
   });
   });
   </script>
   <!-- End : Slider  -->