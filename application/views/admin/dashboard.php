
<div class="content dashboard">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="page-title-box">
               <h4 class="page-title">Dashboard </h4>
               <div class="clearfix"></div>
            </div>
            <div class="page-profile-title-block">
               <h4 class="page-title">Hello, <?= $admin_d['fname'].' '.$admin_d['lname'] ?> </h4>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <!-- end row -->
      <div class="row">
        <?php if($admin_d['roleId'] == '1'){ ?>
        <div class="col-lg-3 col-md-6">
          
          <a href="#" >
            <div class="card-box widget-box-two widget-two-success Aligner">
              <i class="mdi fa-user widget-two-icon"></i>
              <div class="wigdet-two-content text-white">
                
                <h2 class="text-white">Users</h2>
                <p class="m-0 detail-discription"><b><?= $users_q; ?></b></p>
              </div>
              <div class="hand-icon-inner">
                  <i class="mdi mdi-hand-pointing-right"></i>
                  </div>
            </div>
          </a>
          
        </div>
      <?php } ?>

         <!-- end col -->
         <div class="col-lg-3 col-md-6">
             <a href="#" >
               <div class="card-box widget-box-two widget-two-warning Aligner">
                  <i class="mdi mdi-city widget-two-icon"></i>
                  <div class="wigdet-two-content text-white">
                     <h2 class="text-white">City</h2>
                     <p class="m-0 detail-discription"><b><?= $city_q; ?></b></p>
                  </div>
                  <div class="hand-icon-inner">
                  <i class="mdi mdi-hand-pointing-right"></i>
                  </div>
               </div>
            </a>
           
         </div>
         <!-- end col -->
         <div class="col-lg-3 col-md-6">
            <a href="#" >
               <div class="card-box widget-box-two widget-two-info Aligner">
                  <i class="ion-ios7-location-outline widget-two-icon"></i>
                  <div class="wigdet-two-content text-white">
                     <h2 class="text-white">State</h2>
                     <p class="m-0 detail-discription"><b><?= $state_q; ?></b></p>
                  </div>
                  <div class="hand-icon-inner">
                  <i class="mdi mdi-hand-pointing-right"></i>
                  </div>
               </div>
            </a>
         </div>
         <!-- end col -->
         <div class="col-lg-3 col-md-6">
             <a href="#" >
               <div class="card-box widget-box-two widget-two-danger Aligner">
                  <i class="ion-ios7-location widget-two-icon"></i>
                  <div class="wigdet-two-content text-white">
                     <h2 class="text-white">Country</h2>
                     <p class="m-0 detail-discription"><b><?= $country_q; ?></b></p>
                  </div>
                  <div class="hand-icon-inner">
                  <i class="mdi mdi-hand-pointing-right"></i>
                  </div>
               </div>
            </a>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- container -->
</div>
