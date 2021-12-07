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
    
    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg">
            <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img"></div>
            <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                <div class="container">
                    <h2 class="text-transform-capitalize breadcrumbs-custom-title"><?=$pageTitle;?></h2>
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
    
	
    <section class="slider-profile">
        <div class="slider-profile-main">
            <?php
            if($gallerylists){
            foreach ($gallerylists as $gallerylist) 
            {
                $image_path     = $gallerylist->gallery_file;

                $prd_exist = UPLOAD_DIR.GALLERY_IMG.$image_path;

                if(file_exists($prd_exist) && $image_path!="") 
                {
                    $prd_preview = base_url().UPLOAD_DIR.GALLERY_IMG.$image_path;
                } 
                else 
                {
                    $prd_preview = base_url().UPLOAD_DIR.'default.png';
                }

                if(file_exists(UPLOAD_DIR.GALLERY_IMG.$image_path) && $image_path!='')  
                {
                    $ext = pathinfo($image_path, PATHINFO_EXTENSION);
                    $video= array("webm","mkv","flv","gif","m4p","mp4");

                    if (in_array($ext, $video))
                    {
                    ?>
                    <!-- <div class="profile-item">
                        <video width="100" height="100" controls>
                            <source src="<?=$prd_preview;?>">
                        </video>
                    </div> -->
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="profile-item">
                        <div class="profile-item-inner">
                           <img src="<?=$prd_preview?>" alt="<?=ucwords($user_d['fname']." ".$user_d['lname']);?>">
                        </div>
                    </div>
                    <?php
                    }
                }
            }

            }
            ?>
        </div>
    </section>
	
	<div class="agency-tab-section">
		<div class="tab-inner">
			<div class="container">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item col">
						<a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true"><i class="far fa-gem"></i> About</a>
					</li>
					<li class="nav-item col">
					
						<a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><img src="<?=FRONT_IMG?>logo/favicon.png" alt="" style="width : 20px">  Entertainment</a>
					</li>
					<!-- <li class="nav-item col">
						<a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><i class="fa fa-female"></i> Escorts</a>
					</li> -->
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="tab-content" id="pills-tabContent">

				<!--********************** Agency About us **********************-->
				<div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
					<section class="agency-detials-section">
						<div class="container">
							<div class="row">
								<div class="col-md-4 agencybox">
									<div class="agency-detials-inner">
									<?php
										  if($user_d['profile_image'] !='')  {
											?>
											  <!-- <img width="100" src="<?php //echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$edit['profile_image']) ?>"> -->
											  <img src="<?php echo base_url(UPLOAD_DIR.USER_PROFILE_IMG.$user_d['profile_image']) ?>" alt="<?= $user_d['agency_name'] ?>">
											<?php
											}
											?>
										
										<h2><?= $user_d['agency_name'] ?></h2>
										<ul>
											<li><a data-toggle="modal" data-target="#phoneModal"><span><i class="fas fa-phone-alt"></i></span></a></li>

											<li><a href="mailto:<?=$user_d['email'];?>"><span><i class="far fa-envelope"></i></span></a></li>

											<li><a data-toggle="modal" data-target="#Shares"><span><i class="fas fa-share-alt"></i></span></a></li>

											<li><a id="btn"><span><i class="fas fa-link"></i></span></a></li>

										</ul>
										
										<!-- <h2>Job Apply</h2>
										<ul>
											<li>
												<a name="apply" id="apply" data-id="1" data-agencyid = "<?= $user_d['id'] ?>" data-req="Request" class="button button-lg button-shadow-2 button-primary button-zakaria">Apply</a>
											</li>
										</ul> -->
									</div>
								</div>
								<?php
								$country_slug = $this->crud->get_column_value_by_id("country","slug","country_id = '".$user_d['country_id']."'");

								$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$user_d['state_id']."'");

								$s_slug = $this->crud->get_column_value_by_id("state","slug","state_id = '".$user_d['state_id']."'");

								$location_url  = base_url()."agencies/".$country_slug."/".$s_slug;
								?>
								<div class="col-md-4 agencybox agencybox-center">
									<div class="agency-detials-inner">
										<h5>Summary</h5>
										<p><?= $user_d['summary'] ?></p>
										<br>
										<h5>Location</h5>
										
										<p>
											<a style="padding: 7px 45px;" class="button button-shadow-2 button-primary" href="<?= $location_url ?>"><?=$state_name;?></a>
										</p>
									</div>
								</div>
								
								<div class="col-md-4 agencybox agencybox-center">
									<div class="agency-detials-inner">
										<h5> Working Hours</h5>
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Monday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_mon'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_mon'] != 0) { echo $user_d['hrs_mon'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Tuesday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_tue'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_tue'] != 0) { echo $user_d['hrs_tue'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Wednesday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_wed'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_wed'] != 0) { echo $user_d['hrs_wed'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Thursday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_thu'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_thu'] != 0) { echo $user_d['hrs_thu'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Friday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_fri'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_fri'] != 0) { echo $user_d['hrs_fri'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Saturday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p><?= $user_d['hrs_sat'] ?> Hours</p> -->
												<p><?php if($user_d['hrs_sat'] != 0) { echo $user_d['hrs_sat'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
										
										<div class="row week-data">
											<div class="col-sm-4">
												<p>Sunday</p>
											</div>
											<div class="col-sm-1">
												<p>-</p>
											</div>
											<div class="col-sm-6">
												<!-- <p> Hours</p> -->
												<p><?php if($user_d['hrs_sun'] != 0) { echo $user_d['hrs_sun'].' Hours'; } else { echo "OFF"; } ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
	
					<section class="agency-description">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<div class="description-inner">
										<h4><i class="fal fa-envelope-open-text"></i> DESCRIPTION</h4>
										<p><?= $user_d['Introduction'] ?></p>
									</div>
								</div>
							</div>
						</div>	
					</section>
	
					<div class="agency-service">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="agency-service-inner">
										<div class="row">
											<div class="col-md-6 right-br">
												<h5><i class="fas fa-money-check"></i>  SERVICE RATES</h5>
												<div class="row">
													<div class="col-sm-12">
														<h6>In Call Rates</h6>
													</div>

												
													<div class="col-sm-6">
													</div>
													<div class="col-sm-6">
														<i class=""></i>
													</div>

													<?php if(is_array($call_rateslists)){
													foreach($call_rateslists as $call_rates) { 
													if($call_rates->call_type == "In Call")
													{	
													?>
													<div class="col-sm-6">
														<strong><?= $call_rates->decscription ?></strong>
													</div>

													<div class="col-sm-6">
														<p><?= $call_rates->rates ?></p>
													</div>
													<?php } } }?>

												</div>
											</div>
											
											<div class="col-md-6">
												<h5 class="hide-text"><i class="fas fa-money-check"></i>  SERVICE RATES</h5>
												<div class="row">
													<div class="col-sm-12">
														<h6>Out Call Rates</h6>
													</div>
													<div class="col-sm-6">
													</div>
													<div class="col-sm-6">
														<i class=""></i>
													</div>
													<?php if(is_array($call_rateslists)){
													foreach($call_rateslists as $call_rates) { 
													if($call_rates->call_type == "Out Call")
													{	
													?>
													<div class="col-sm-6">
														<strong><?= $call_rates->decscription ?></strong>
													</div>
													<div class="col-sm-6">
														<p><?= $call_rates->rates ?></p>
													</div>
													<?php } } }?>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!--********************** And Agency About us **********************-->
				<?php
					$join1['select'] = 'c.*';
					$join1['table'] = 'tbl_customer c';
		
					$join1['joins'][] = array(
						'join_table' => 'apply_job r', 
						'join_by' => 'r.user_id = c.id', 
						'join_type' => 'inner');
		
					$wh1 = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"c.user_role"=>1,"r.agency_id"=>$user_d['id'],"r.isDelete"=>0,"r.apply_req"=>2);
		
					$param1 = array();
		
					$data['pageTitle']    = 'Entertainment Agency';
					$posts1        = $this->crud->get_join($join1,$wh1,$param1);
		
				?>
				<!--********************** Agency Strippers **********************-->
				<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
					<section class="section section-xl bg-default text-md-left block-profile-main">
						<div class="container">
							<div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<ul id="resultlist1">
										<!--  Near located user profile   -->
										<?php 
										if(!empty($posts1))
										{
											foreach($posts1 as $post)
											{
												$id             = $post['id'];
												$phone          = $post['phone'];
												$image_path     = $post['profile_image'];
												$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

												$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

												$city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

												$prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

												if(file_exists($prd_exist) && $image_path!="") 
												{
													$prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
												} 
												else 
												{
													$prd_preview = base_url().UPLOAD_DIR.'default.png';
												}

												

												$str = strtolower($post['slug']);
												$details_url1  = base_url()."user/details/".$str."/";
												?> 
												<li class="overlay-link-gallery">
													<div class="inner_link">
														<a href="<?= $details_url1 ?>">
															<img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
															<div class="gallery-content">
																<h4><?= $post['fname'] ?></h4>
																<p><?= $city_name ?></p>
																<!-- <p><?= $user_d['agency_name'] ?></p> -->
															</div>
														</a>
													</div>
												</li>
												<?php 
											}
										}
										else
										{
											?>
											<div class="block-no-record">
												<div class="col-md-12 text-center">
													<h3 class="text-center"><strong class="text-center">Entertainment record not found.</strong></h3>
												</div>
											</div>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</section>
				</div>
				<!--********************** And Agency Strippers **********************-->
				<?php
					$joins['select'] = 'c.*';
					$joins['table'] = 'tbl_customer c';
		
					$joins['joins'][] = array(
						'join_table' => 'apply_job r', 
						'join_by' => 'r.user_id = c.id', 
						'join_type' => 'inner');
		
					$whs = array("c.is_delete"=>0,"c.status"=>"Y","c.purchase_plan"=>1,"c.is_verified"=>1,"c.user_role"=>2,"r.agency_id"=>$user_d['id'],"r.isDelete"=>0,"r.apply_req"=>2);
		
					$paramse = array();
		
					$posts        = $this->crud->get_join($joins,$whs,$paramse);

				?>
				<!--********************** Agency Escorts **********************-->
				<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
				<section class="section section-xl bg-default text-md-left block-profile-main">
						<div class="container">
							<div class="row row-40 row-md-60 justify-content-center align-items-xl-center m-0">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<ul id="resultlist1">
										<!--  Near located user profile   -->
										<?php 
										if(!empty($posts))
										{
											foreach($posts as $post)
											{
												$id             = $post['id'];
												$phone          = $post['phone'];
												$image_path     = $post['profile_image'];
												$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

												$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

												$city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

												$prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

												if(file_exists($prd_exist) && $image_path!="") 
												{
													$prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
												} 
												else 
												{
													$prd_preview = base_url().UPLOAD_DIR.'default.png';
												}

												

												$str = strtolower($post['slug']);
												$details_url1  = base_url()."user/details/".$str."/";
												?> 
												<li class="overlay-link-gallery">
													<div class="inner_link">
														<a href="<?= $details_url1 ?>">
															<img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
															<div class="gallery-content">
																<h4><?= $post['fname'] ?></h4>
																<p><?= $city_name ?></p>
																<!-- <p><?= $user_d['agency_name'] ?></p> -->
															</div>
														</a>
													</div>
												</li>
												<?php 
											}
										}
										else
										{
											?>
											<div class="block-no-record">
												<div class="col-md-12 text-center">
													<h3 class="text-center"><strong class="text-center">Entertainment record not found.</strong></h3>
												</div>
											</div>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</section>
				</div>
				<!--********************** And Agency Escorts **********************-->
			</div>
		</div>
	</div>
	<!-- Modal call  -->
	<div id="phoneModal" class="modal fade">  
        <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close button button-shadow-2 button-primary button-zakaria" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">CALL NOW!</h4>  
                </div>  
                <div class="modal-body">  
                    <div class="blocks-information"> 
                        <div id="card">
                            <div class="row">
                                <div class="form-group col-md-12 text-left">
                                    <label class="form-label-custom">Choose a phone number to call</label>  
                                    <h3><a href="tel:<?=$user_d['phone'];?>"><i class="fas fa-phone-alt"></i><?=$user_d['phone'];?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
           </div>  
        </div>  
    </div>
	<!-- share -->
	<div id="Shares" class="modal fade">  
        <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close button button-shadow-2 button-primary button-zakaria" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Websites</h4>  
                </div>  
                <div class="modal-body">  
                    <div class="blocks-information"> 
                        <div id="card">
						<?php $exp_web = explode(",", $user_d['website']); ?>
                            <div class="row p-2">
								<?php
								foreach ($exp_web as $exp_web_val) 
                            	{
									$web_site = $this->crud->get_column_value_by_id("tbl_customer","website","id = '".$user_d['id']."'");
									?>
									<div class="col-md-3 contact-btn">
										<a href="<?= $web_site ?>" target="_blank">
											<div class="openWebsite" data-profile="" data-method="website">
												<div class="btn-clickable btn-ea-secondary">
												<span><i class="fas fa-globe-americas" style="font-size: 30px;"></i></span>
												
												</div>
											</div>
										</a>
									</div>
									<?php
								}
								?>
                                    <!-- <h3><a href="<?=$user_d['website'];?>"><i class="fas fa-phone-alt"></i><?=$user_d['website'];?></a></h3> -->
                            </div>
                        </div>
                    </div>
                </div>   
           </div>  
        </div>  
    </div>

<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>

<?php $this->load->view(FRONTEND."include/include_js"); ?>
</body>      
</html>
<script type="text/javascript">

$('.slider-profile-main').slick({
	infinite: true,
	dots: false,
	arrows: true,
	centerMode: true,
	centerPadding: '20',
	slidesToShow: 1,
	slidesToScroll: 1,
	centerMode: true,
	variableWidth: true,
	autoplay: true,
});


$(document).on("click","#apply",function(){
	
	var agency_id = $(this).attr("data-agencyid");
	var data = $(this).attr("data-id");
	var req = $(this).attr("data-req");
	$(".loading-div").show();  
	$.ajax({
		url: '<?= base_url("apply-job"); ?>',
		type: "POST",
		data: { agency_id : agency_id, data : data , req : req  },
		dataType: "json",
		success:function(response) {
			// alert(response);
			setTimeout(function(){
              console.log(response);
			//   alert(response.error);
                if(response.error == 1)
                {
                  $.notify({message: response.msg},{ type: 'danger'});
                //   window.location = '<?php echo base_url('SignIn') ?>';

                }
                else if(response.error == 0)
                {
                  $.notify({message: response.msg},{ type: 'success'});
                }
              $(".loading-div").hide();  
              $('#addpopUpmodal').modal('hide'); 
            },300);
		}
	});
	
});

<?php if(isset($task) && $task != "") { ?>
	<?php if($task == "entertainment"){ ?>
		$("#pills-2-tab").trigger("click");
	<?php } ?>

	<?php if($task == "escorts"){ ?>
		$("#pills-3-tab").trigger("click");
	<?php } ?>
<?php } ?>

$(document).ready(function(){
    var $temp = $("<input>");
    var $url = $(location).attr('href');
    $('#btn').click(function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    $("#copied").text("URL copied!");
    });
});
</script>

</body>
</html>