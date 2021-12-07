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
               <h4 class="page-title">Agency Details</h4>
               <ol class="breadcrumb p-0 m-0">
                  <li>
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="active">
                     Agency Details
                  </li>
               </ol>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <!-- end row -->
      <div class="card-box table-responsive">
         <p class="text-muted font-13 m-b-30">
            <a href="<?php echo ADMIN_LINK; ?>manage-agency" class="btn btn-primary waves-effect waves-light pull-right">Back</a>
         </p>
         <div class="col-lg-12">
            <hr>
            
            <!-- End : Business Detail -->
            <!-- Start : Business Additional Options -->
            
            <!-- Agency Info -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Agency Information
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition5"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition5" class="panel-collapse collapse">
                  <div class="panel-body">
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Agency Logo</label>

                        <?php
                          if($edit['profile_image'] !='')  {
                            ?>
                              <img width="400" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$edit['profile_image']) ?>">
                            <?php
                            }
                            ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Agency name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['agency_name'] ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Contact name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['contact_name']; ?>">
                     </div>

                     <!-- <div class="form-group col-md-6">
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
                     </div> -->

                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">Gender</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['gender']; ?>">
                     </div> -->

                     <div class="form-group col-md-6">
                        <label class="control-label">Full Description</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['Introduction']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Summary</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['summary']; ?>">
                     </div>

                      


                     
                     <?php 
                        $country = $this->crud->get_column_value_by_id("country","name","country_id = '".$edit['country_id']."'");
                     ?>
                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">Country</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $country ?>">
                     </div> -->
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
                     

                    

                            
                  </div>
               </div>  
            </div>
            <!-- End Agency info -->
            
            <!-- PRIMARY IDENTITY -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Primary Identity
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition4"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition4" class="panel-collapse collapse">
                  <div class="panel-body">
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Identification photo</label>

                        <?php
                          if($edit['identification_photo'] !='')  {
                            ?>
                              <img width="400" src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$edit['identification_photo']) ?>">
                            <?php
                            }
                            ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">First Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['fname']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Last Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['lname']; ?>">
                     </div>

                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">Email</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['email']; ?>">
                     </div> -->
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Age</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['age']; ?>">
                     </div>

                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">WhatsApp Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['whatsapp_number']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Phone Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['phone']; ?>">
                     </div> -->

                     <div class="form-group col-md-6">
                        <label class="control-label">Gender</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['agency_gender']; ?>">
                     </div>

                     
                     <?php 
                        $country = $this->crud->get_column_value_by_id("country","name","country_id = '".$edit['country_id']."'");
                     ?>
                     <div class="form-group col-md-6">
                        <label class="control-label">Nationality</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $country ?>">
                     </div>
                     
                  </div>
               </div>  
            </div>
            <!-- End PRIMARY IDENTITY -->

            <!-- Contact -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Contact Details
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition9"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition9" class="panel-collapse collapse">
                  <div class="panel-body">
                     

                     <!-- <div class="form-group col-md-6">
                        <label class="control-label">First Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['fname']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Last Name</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['lname']; ?>">
                     </div> -->

                     <div class="form-group col-md-6">
                        <label class="control-label">WhatsApp Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['whatsapp_number']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Phone Number</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['phone']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Email</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['email']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Web Site</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['website']; ?>">
                     </div>
                     
                     <div class="form-group col-md-6">
                        <label class="control-label">Facebook</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['facebook']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Pinterest</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['pinterest']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Twitter</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['twitter']; ?>">
                     </div>

                     <div class="form-group col-md-6">
                        <label class="control-label">Instagram</label>
                        <input type="text" class="form-control view-class" readonly="" value="<?= $edit['instagram']; ?>">
                     </div>
                     
                  </div>
               </div>  
            </div>
            <!-- End Contact -->

            <!-- Contact -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Job Apply Details
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition22"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition22" class="panel-collapse collapse">
                  <div class="panel-body">
                     <?php
                     if(is_array($jobs))
                     {
                        $i = 1;
                        foreach($jobs as $job)
                        {
                           $fname = $this->crud->get_column_value_by_id("tbl_customer","fname","id = '".$job->user_id."'");
                           $lname = $this->crud->get_column_value_by_id("tbl_customer","lname","id = '".$job->user_id."'");
                           $email = $this->crud->get_column_value_by_id("tbl_customer","email","id = '".$job->user_id."'");
                           $phone = $this->crud->get_column_value_by_id("tbl_customer","phone","id = '".$job->user_id."'");
                           $agency_name = $this->crud->get_column_value_by_id("tbl_customer","agency_name","id = '".$job->agency_id."'");
                           
                           ?>
                              <div class="form-group col-md-6">
                                 <label class="control-label">User name</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $fname.' '.$lname ?>">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="control-label">Email id</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $email ?>">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="control-label">Phone Number</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $phone ?>">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="control-label">Request/Accept ?</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $job->request_str ?>">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="control-label">Date</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $job->created_at ?>">
                              </div>

                              <div class="form-group col-md-6">
                                 <label class="control-label">Agency name</label>
                                 <input type="text" class="form-control view-class" readonly="" value="<?= $agency_name ?>">
                              </div>



                           <?php
                           
                        }
                     }
                     ?>
                  
                     
                  </div>
               </div>  
            </div>
            <!-- End Contact -->

            <!-- Membership plan -->
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
            <!-- Membership plan details -->

            <!-- Call rates -->
            <div class="portlet">
               <div class="portlet-heading bg-primary">
                  <h3 class="portlet-title">
                  Call Rates
                  </h3>
                  <div class="portlet-widgets">
                     <a data-toggle="collapse" data-parent="#accordion1" href="#busness-addition19"><i class="ion-minus-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="busness-addition19" class="panel-collapse collapse ">
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
            <!-- End Call rates -->

            <!-- location -->
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
            <!-- end location -->
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