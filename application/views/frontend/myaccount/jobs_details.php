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
                  
                  
                </div>
              </div>


             
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-5">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>Job Application Request</h6>

                      <h5></h5>
                        <?php 
                        if($details['apply_req'] == 1)
                        {
                            ?>
                            <a name="apply" id="request" data-id="2" data-reqid = "<?= $details['id'] ?>" data-req="2" data-agencyid="<?= $details['agency_id'] ?>" data-userid = "<?= $details['user_id'] ?>" class="button button-lg button-shadow-2 button-primary button-zakaria">Request Accept</a> 
                            <?php
                        }
                        else if($details['apply_req'] == 2)
                        {
                            ?>
                            <a name="apply" id="request" data-id="1" data-reqid = "<?= $details['id'] ?>" data-req="1" data-agencyid="<?= $details['agency_id'] ?>" data-userid = "<?= $details['user_id'] ?>" class="button button-shadow-2 button-primary button-zakaria">Decline</a>
                            <?php
                        }
                        
                        ?>
                          
                      
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

<script>
    $(document).on("click","#request",function(){
	
	var reqid = $(this).attr("data-reqid");
	var data = $(this).attr("data-id");
	var req = $(this).attr("data-req");
    var agency_id = $(this).attr("data-agencyid");
    var user_id = $(this).attr("data-userid");
    
	$(".loading-div").show();  
	$.ajax({
		url: '<?= base_url("request-job"); ?>',
		type: "POST",
		data: { agency_id : agency_id, reqid : reqid , data : data , req : req , user_id : user_id },
		dataType: "json",
		success:function(response) {
			setTimeout(function(){
              console.log(response);
                if(response.error == 1)
                {
                  $.notify({message: response.msg},{ type: 'danger'});
                  location.reload();
                }
                else if(response.error == 0)
                {
                  $.notify({message: response.msg},{ type: 'success'});
                  location.reload();

                }
              $(".loading-div").hide();  
              $('#addpopUpmodal').modal('hide'); 
            },200);
		}
	});
	

});

</script>