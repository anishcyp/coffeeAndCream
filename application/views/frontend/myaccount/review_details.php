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


<div class="container">
    <div class="main-body">
    
    <br>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                      <?php 

                      $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$user_d['country_id']."'");
                      
                      $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");

                      $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$user_d['city_id']."'");

                      if($user_d['call_type'] == '1'){
                      
                        $service = 'Entertainment Services';
                      
                      }
                      else if($user_d['call_type'] == '2'){
                          
                          $service= 'Escort Services';
                          
                      }
                      else if($user_d['call_type'] == '3'){
                          
                          $service = 'Escort Services , Entertainment Services';
                         
                      }

                      $image_path     = $user_d['profile_image'];

                      $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

                      if(file_exists($prd_exist) && $image_path!="") 
                      {
                          $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
                      } 
                      else 
                      {
                          $prd_preview = base_url().UPLOAD_DIR.'default.png';
                      }


                      ?>
                      <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= $prd_preview ?> " alt="<?= $user_d['fname'].' '.$user_d['lname'] ?>" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?= $user_d['fname'].' '.$user_d['lname'] ?></h4>
                      <p class="text-secondary mb-1"><?= $service ?></p>
                      <p class="text-muted font-size-sm"><?= $country_name.' , '.$state_name.' , '.$city_name ?></p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $user_d['fname'].' '.$user_d['lname'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?= $user_d['email'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $user_d['phone'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Outcome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $details['outcome']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?= $details['date'].' at '.$details['time']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">hour</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $details['hour']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location</h6>
                      <?php 
                      $location = $this->crud->get_column_value_by_id("city","name","id = '".$details['city_id']."'");
                      ?>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $location  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Call Type</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $details['call_type']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">price</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <b>£</b> <?= $details['price']  ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Reviews</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $details['experience']  ?>
                    </div>
                  </div>
                </div>
              </div>


             
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-5">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Ratings</h6>


                      <small>Accuracy of photos</small>
                      <h4><?=$details['accuracy_of_photos'];?> <i class="fa fa-star" data-rating="<?=$details['accuracy_of_photos'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>

                      <hr>

                      <small>Services received</small>

                      <h4><?=$details['services_received'];?> <i class="fa fa-star" data-rating="<?=$details['services_received'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>

                      <hr>

                      <small>Location</small>

                      <h4><?=$details['location'];?> <i class="fa fa-star" data-rating="<?=$details['location'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>

                      <hr>

                      <small>Value for money</small>


                      <h4><?=$details['value_for_money'];?> <i class="fa fa-star" data-rating="<?=$details['value_for_money'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>

                      <hr>

                      <small>Physical Appearance</small>


                      <h4><?=$details['physical_appearance'];?> <i class="fa fa-star" data-rating="<?=$details['physical_appearance'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>
                      
                      <hr>

                      <small>Overall experience</small>


                      <h4><?=$details['overall_experience'];?> <i class="fa fa-star" data-rating="<?=$details['overall_experience'];?>" style="font-size:20px;color:#3cc3c1;"></i> </h4>
                    </div>
                    
                    
                  </div>
                </div>
                
              </div>


            </div>
          </div>

        </div>
    </div>


<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>