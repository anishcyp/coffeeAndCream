<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?>
   
    </style>
</head>
<body class="">    
    <?php $this->load->view(FRONTEND."include/menu"); ?>
	<?php 
		$where = array('id' => $user_d['user_id'] );
		$info_a = $this->crud->get_one_row("tbl_customer",$where ); 
	?>
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h1 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h1>
                    <h5 class="breadcrumbs-custom-text">
                    </h5>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-custom-footer">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="<?=base_url();?>">Home</a></li>
                    <li class="active"><?=$pageTitle;?></li>
                </ul>
            </div>
        </div>
    </section>

	<?php

	$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$user_d['country_id']."'");
	$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");


	$image_path     = $user_d['image'];

	$prd_exist = UPLOAD_DIR.POST_IMG.$image_path;

	if(file_exists($prd_exist) && $image_path!="") 
	{
		$prd_preview = base_url().UPLOAD_DIR.POST_IMG.$image_path;
	} 
	else 
	{
		$prd_preview = base_url().UPLOAD_DIR.'default.png';
	}

	?>  
	
	<section class="post-header-details">
		<div class="post-header-inner">
			<div class="container">
				<div class="valign-middle">
					<h2><?= $user_d['title'] ?></h2>
					<div class="time-description post-type">                                    
						<img src="<?= $prd_preview ?>" style="width: 250px;height: 80px;" alt="Post Logo">
                    </div>
				</div>
				<div class="button-group align-top">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						Click hare to work in this <?= $user_d['title'] ?>
					</button>
					<div class="contact-information">
						<div class="left-content">
							<h5><?= $info_a['fname'].' '.$info_a['lname'] ?></h5>
							<h6><?= $user_d['phone_no'] ?></h6>
						</div>
						<div class="right-content">
							<ul class="social-icons">
								<li><a href="<?= $info_a['instagram'] ?>"><i class="fab fa-instagram"></i></a></li>
								<li><a href="<?= $info_a['twitter'] ?>"><i class="fab fa-twitter"></i></a></li>
								<li><a href="<?= $info_a['facebook'] ?>"><i class="fab fa-facebook-f"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
                      
	<section class="posts-ads-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-7 post-content">
					<!-- <img src="<?= $prd_preview ?>" alt="Post Logo"> -->
					<div class="post-meta">
						<span><i class="fa fa-briefcase"></i><?= $user_d['title'] ?></span>
						<span><i class="fa fa-map-marker-alt"></i><?= $country_name .' , '. $state_name ?></span>
					</div>
					<div class="left-content">
    					<h5 class="desc-title">WORKING SYSTEM FOR THE <?= $user_d['title'] ?></h5>
    					<p><?= $user_d['work_system'] ?></p>
    					<h5 class="desc-title">WORKING HOURS:</h5>
    					<p><?= $user_d['work_hours'] ?></p>
						<h5 class="desc-title">EARNINGS:</h5>
						<p><?= $user_d['earnings'] ?></p>
						<h5 class="desc-title">REQUIRED:</h5>
						<p><?= $user_d['requirements'] ?></p>
						<?php if($user_d['possible_earnings'] != ''){ ?>
						<h5 class="desc-title">POTENTIAL EARNINGS:</h5>
						<p><?= $user_d['possible_earnings'] ?></p>
						<?php } ?>
						<h5 class="desc-title">SELECTION REQUIREMENTS :</h5>
						<p><?= $user_d['selection'] ?></p>
						<?php if($user_d['contract'] != ''){ ?>
						<h5 class="desc-title">CONTRACT LENGTH:</h5>
						<p><?= $user_d['contract'] ?></p>
						<?php } ?>
						<h5 class="desc-title">MORE DETAILS:</h5>
						<p><?= $user_d['more_info'] ?></p>
						<?php if($user_d['when_can_i_start'] != ''){ ?>
						<h5 class="desc-title">When I can start?</h5>
						<p><?= $user_d['when_can_i_start'] ?></p>
						<?php } ?>
						<?php if($user_d['accommodation'] != ''){ ?>
						<h5 class="desc-title">ACCOMMODATION CONDITIONS: </h5>
						<p><?= $user_d['accommodation'] ?></p>
						<?php } ?>
						<?php if($user_d['transport'] != ''){ ?>
						<h5 class="desc-title">TRANSPORT: </h5>
						<p><?= $user_d['transport'] ?></p>
						<?php } ?>
    				</div>
				</div>
				<!-- <div class="col-lg-4 col-md-5 about-widget">
					<div class="about-inner">
						<h5 class="widget-title">Company About</h3>
						<p>
							<?= $user_d['com_discription'] ?>
						</p>
						<h5 class="desc-title">Connect With Us</h5>
						<a href="https://<?= $user_d['com_website'] ?>"><?= $user_d['com_website'] ?></a>
						<?php 
							$where = array('id' => $user_d['user_id'] );
							$info_a = $this->crud->get_one_row("tbl_customer",$where ); 
						?>
						<ul class="social-icons">
							<li><a href="<?= $info_a['instagram'] ?>"><i class="fab fa-instagram"></i></a></li>
							<li><a href="<?= $info_a['twitter'] ?>"><i class="fab fa-twitter"></i></a></li>
							<li><a href="<?= $info_a['facebook'] ?>"><i class="fab fa-facebook-f"></i></a></li>
						</ul>
					</div>
				</div> -->
			</div>
		</div>
	</section>

<!-- Apply job Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Apply This Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form role="form" id="form-addService" name="form-addService" method="post">
		<div class="modal-body">  
			<div class="blocks-information">
				<div class="form-group">
					<label class="form-label-custom">Full Name*</label>  
					<input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your full name" />  
				</div>
				<div class="form-group">
					<label class="form-label-custom">Email*</label>  
					<input type="email" name="email" id="email" class="form-control" placeholder="Enter your register email" />  
				</div>
				<div class="form-group">
					<label class="form-label-custom">Message*</label>
					<textarea rows="3" cols="30" name="message" placeholder="Input job Description " id="message" class="form-control"><?= $profile['discription'] ?></textarea>
				</div>
				<input type="hidden" name="post_id" id="post_id" value="<?= $user_d['id'] ?>">
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
<script>
$('#form-addService').validate({ // initialize the plugin
	rules:{
	full_name :{ required : true },
	email:{ required : true  },
	message:{ required : true },
	},
	messages:{
	full_name :{ required : "Full name is required" },
	email :{ required : "Email is is required." },
	message : { required : "Message is required" },
	
	},
	submitHandler: function (form) {

		//return false;
		var formData = new FormData($(form)[0]);
		formData.append('td', '<?php echo base64_encode('apply_job') ?>');
		formData.append('i', '<?php echo base64_encode('id') ?>');
		$(".loading-div").show(); 
		$.ajax({
			url: '<?php echo APP_URL; ?>AgencyControler/apply_jobs',
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
					}

				$(".loading-div").hide();  
				$('#exampleModalCenter').modal('hide'); 
				},500);
			},
			
		});
	return false;
	}
});
</script>
</body>      
</html>