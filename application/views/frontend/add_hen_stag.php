<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <?php $this->load->view(FRONTEND."include/include_css"); ?>    
</head>
<body class="">
<?php $this->load->view(FRONTEND."include/menu"); ?>
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/3070052.jpg">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/3070052.jpg" alt="contact-banner"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
                <h1 class="text-transform-capitalize breadcrumbs-custom-title" style="font-size: 50px;">Add Hen Stag</h1>
                <h5 class="breadcrumbs-custom-text text-effect-contact">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                </h5>
				<!-- <div class="filter-activity filter-activity-v2 mt-5">
					<div class="container">
						<div class="row">
							<button type="button btn" class="col-3 button-popup" data-toggle="modal" data-target="#exampleModal">
								Brighton
							</button>
							
							<select class="selectpicker col-4 select-btn">
								<option value="5">5 People</option>
								<option value="6">6 People</option>
								<option value="7">7 People</option>
								<option value="8">8 People</option>
								<option value="9">9 People</option>
								<option value="10">10 People</option>
								<option value="11">11 People</option>
								<option value="12">12 People</option>
								<option value="13">13 People</option>
								<option value="14">14 People</option>
								<option value="15">15 People</option>
								<option value="16">16 People</option>
								<option value="17">17 People</option>
								<option value="18">18 People</option>
								<option value="19">19 People</option>
								<option value="20">20 People</option>
							</select>
							
							<div class="col-4 select-date">
								<input type="text" placeholder="Select Date" class="form-control" id="datepicker">
							</div>
							
							<select class="selectpicker col-4 select-night" name="night" id="night">
								<option value="1">0 Nights</option>
								<option value="2">1 Nights</option>
								<option value="3">2 Nights</option>
								<option value="4">3 Nights</option>
								<option value="5">4 Nights</option>
								<option value="6">5 Nights</option>
								<option value="7">6 Nights</option>
								<option value="8">7 Nights</option>
							</select>
							
						</div>
					</div>
				</div> -->
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?= base_url('') ?>">Home</a></li>
                <li><a href="<?= base_url('hen-stag-accommodation') ?>">Hen stag accommodation</a></li>
                <li class="active">Add Hen Stag</li>
            </ul>
        </div>
    </div>
</section>

<section class="select-packages">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<!-- <div class="package-box">
					<div class="package-date">
						<p>Day 1</p>
					</div>
					<div class="more-link">
						<a href="#" class="btn">Add More to This Day</a> 
					</div>
				</div> -->
				<?php
				$days = $this->crud->get_all_with_where('package_day','location','desc',array('isDelete'=>0,'user_id'=>$UserId));
				$i = 1;
				foreach($days as $day)
				{
					$where = array('id' => $day->package_id );
					$data = $this->crud->get_one_row("create_package",$where );
					
					$user_slug = $this->crud->get_column_value_by_id("create_package","slug","id = '".$day->package_id."'");
					
					$country = $this->crud->get_column_value_by_id("city","country_id","slug = '".$day->location."'");
					$state = $this->crud->get_column_value_by_id("city","state_id","slug = '".$day->location."'");
					$country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$country."'");
					$state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$state."'");
					$city_name = $this->crud->get_column_value_by_id("city","name","slug = '".$day->location."'");
					
					$image_path     = $data['profile_image'];

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
				<div class="package-box package-content" id="<?= $day->package_id ?>">
					<div class="package-date">
						<p>Day <?= $i++ ?></p>
					</div>
					<div class="content-box">
						<div class="inner-content">
							<div class="image-box" id="image-boxing-<?= $day->package_id ?>">
								<img src="<?= $prd_preview ?>" alt="image">
							</div>
							<div class="box-content" id="boxing-content-<?= $day->package_id ?>">
								<h3><?= $data['compnay_name'] ?></h3>
								<p><i class="fas fa-map-marker-alt"></i><?= $country_name ?> , <?= $state_name ?> &  <?= $city_name ?></p>
								<p><i class="fa fa-user"></i><?php if($day->people){echo "People ".$day->people;}else{echo "<span style='color: red;'>Edit People</span>";} ?></p>
								<p><i class="fas fa-clock"></i><?php if($day->time){echo "Start Time: ".$day->time;}else{echo "<span style='color: red;'>Edit Start Time</span>";} ?></p>
							</div>
							<div class="show-more">
								<a href="javascript:void(0);" onclick="showTogel('<?= $day->package_id ?>')" data-id="<?= $day->package_id ?>" id="pack_show_<?= $day->package_id ?>"><i class="fa fa-angle-right"></i></a>
								<input type="hidden" name="package_id" id="package_id">
							</div>
							<div class="hide-show-content" id="show-hide-<?= $day->package_id ?>">
								<div class="more-content" onclick="HideShow('<?= $day->package_id ?>')">
									<div class="more-data select-people">
										<a href="javascript:;" class="EditPeople" data-toggle="modal" data-target="#morepeople" data-toggle="modal" data-target="#morepeople" data-id="<?= $day->id ?>" data-user="<?= $day->user_id ?>" data-package="<?= $day->package_id ?>" data-location="<?= $day->location ?>" style="color: white;"><i class="fas fa-ellipsis-h"></i> <span>More</span></a>
									</div>
									<div class="more-data select-time">
										<a href="javascript:;" class="timer_people" data-toggle="modal" data-target="#modelday-time" data-id="<?= $day->id ?>" data-user="<?= $day->user_id ?>" data-package="<?= $day->package_id ?>" data-location="<?= $day->location ?>" style="color: white;"><i class="fas fa-clock"></i> <span>Start Time</span></a>
									</div>
									<div class="more-data remove-day" onclick="remove_pack('<?= $day->id ?>')">
										<a href="javascript:void(0);"><i class="fas fa-trash-alt"></i><span>Remove</span></a>
									</div>
									<!-- <div class="more-data move-day">
										<a class="move-up" href="javascript:void(0);"><i class="fas fa-angle-up"></i></a>
										<span>Move Day</span>
										<a class="move-down" href="javascript:void(0);"><i class="fas fa-angle-down"></i></a>
									</div> -->
									<?php $url  = base_url()."hen-stag-accommodation/details/".$day->location."/".$user_slug."/"; ?>
									<div class="more-data view-day">
										<a href="<?= $url ?>"><i class="far fa-eye"></i><span>View</span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="more-link" id="add_days">
						<?php $url  = base_url()."accommodation/location/".$city_slug."/"; ?>
						<a href="<?= $url ?>" class="btn">Add More to This Day</a> 
					</div>
				</div>
			<?php
			}
			?>
			</div>
			<div class="col-md-5">
				<button type="button" class="button button-shadow-2 button-zakaria button-lg button-primary" data-toggle="modal" data-target="#exampleModalCenter">
					Add To Enquiry
				</button>
			</div>
		</div>
	</div>
</section>
	<!-- Modal Enquiry -->
	<div class="modal fade model-form" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	   		<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	     		 </div>
		      	<div class="modal-body">
		        	<div class="form-book">
		        		<form action="<?= base_url('HenStagController/enquiry') ?>" method="post" enctype="multipart/form-data">
		        			<div class="row">

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Email Address:</label>
		        						<input type="email" name="email" id="email" placeholder="Email Address" class="form-control">
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Size of group</label>
		        						<select class="form-control" name="size_group" id="size_group">
		        							<option value="5">5</option>
		        							<option value="10">10</option>
		        							<option value="15">15</option>
		        							<option value="20">20</option>
		        							<option value="25">25</option>
											<option value="30+">30+</option>
		        						</select>
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Arrival Date:</label>
		        						<input type="text" name="date" placeholder="Select Date" id="start_date" class="form-control">
		        					</div>
		        				</div>

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Number of Nights</label>
		        						<select class="form-control" name="night" id="night">
		        							<option value="1">1</option>
		        							<option value="2">2</option>
		        							<option value="3">3</option>
		        							<option value="4">4</option>
		        							<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8+">8+</option>
		        						</select>
		        					</div>
		        				</div>
		        				
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Budget (per person):</label>
		        						<input type="text" name="budget" id="budget" placeholder="Budget (per person)" class="form-control">
		        					</div>
		        				</div>
								<input type="hidden" name="package_id" id="package_id" value="<?= $package_id ?>">

		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label>Status</label>
		        						<select class="form-control" name="status" id="status">
		        							<option value="Ready to Book ASAP">Ready to Book ASAP</option>
		        							<option value="Ready to Book Soon">Ready to Book Soon</option>
		        						</select>
		        					</div>
		        				</div>
		        				<div class="col-md-12">
		        					<div class="form-group">
		        						<div class="check-forget">
											<input type="checkbox" id="remember" name="remember" value="1">
											<label for="remember">Are you happy to receive future offers and information from us?</label>
										</div>
		        					</div>
		        				</div>
		        				<div class="submit-btn d-block text-center ml-auto mr-auto">
		        					<button type="submit" class="button button-shadow-2 button-primary">Submit</button>
		        				</div>
		        			</div>
		        		</form>	
		        	</div>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<!-- Modal More People-->
	<div class="modal fade morepeople-model" id="morepeople" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">EDIT GUESTS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("HenStagController/Updatepeople") ?>" method="post">
						<div class="form-group">
							<label class="d-block mb-2">People</label>
							<select class="selectpicker select-btn popup-user" name="people" id="people">
								<option value="5">5 People</option>
								<option value="6">6 People</option>
								<option value="7">7 People</option>
								<option value="8">8 People</option>
								<option value="9">9 People</option>
								<option value="10">10 People</option>
								<option value="11">11 People</option>
								<option value="12">12 People</option>
								<option value="13">13 People</option>
								<option value="14">14 People</option>
								<option value="15">15 People</option>
								<option value="16">16 People</option>
								<option value="17">17 People</option>
								<option value="18">18 People</option>
								<option value="19">19 People</option>
								<option value="20">20 People</option>
							</select>
						</div>
						<input type="hidden" name="id" id="package_day_id">
						<input type="hidden" name="user_id" id="package_user_id">
						<input type="hidden" name="package_id" id="package_package_id">
						<input type="hidden" name="location" id="package_location">
						<button type="submit" class="button button-shadow-2 button-primary btn-sm w-100">Ok</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Time -->
<div class="modal fade modelday-time" id="modelday-time" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">PREFERRED START TIME</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url("HenStagController/Updatetime") ?>" method="post">
					<div class="form-group">
						<label class="d-block mb-2">Start Time Preference</label>
						<select class="selectpicker select-btn popup-user" name="time" id="time">
							<option value="9">9:00</option>
							<option value="9:15">9:15</option>
							<option value="9:30">9:30</option>
							<option value="9:45">9:45</option>
							<option value="10:00">10:00</option>
							<option value="10:15">10:15</option>
							<option value="10:30">10:30</option>
							<option value="11">11:00</option>
							<option value="11:15">11:15</option>
							<option value="11:30">11:30</option>
							<option value="11:45">11:45</option>
							<option value="12">12:00</option>
							<option value="12:15">12:15</option>
							<option value="12:30">12:30</option>
							<option value="12:45">12:45</option>
							<option value="13">13:00</option>
							<option value="13:15">13:15</option>
							<option value="13:30">13:30</option>
							<option value="14">14:00</option>
							<option value="14:15">14:15</option>
							<option value="14:30">14:30</option>
							<option value="14:45">14:45</option>
							<option value="15">15:00</option>
							<option value="15:15">15:15</option>
							<option value="15:30">15:30</option>
							<option value="15:45">15:45</option>
							<option value="16:15">16:15</option>
							<option value="16:30">16:30</option>
							<option value="16:45">16:45</option>
							<option value="17">17:00</option>
						</select>
					</div>
					<input type="hidden" name="id" id="package_day_ids">
					<input type="hidden" name="user_id" id="package_user_ids">
					<input type="hidden" name="package_id" id="package_package_ids">
					<input type="hidden" name="location" id="package_locations">
					<button type="submit" class="button button-shadow-2 button-primary btn-sm w-100">Ok</button>
				</form>
			</div>
			
		</div>
	</div>
</div>


<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script type="text/javascript">

	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll > 300) 
		{
			$(".select-packages .enquiry-button").addClass("fixed-top");
		}
		else 
		{
			$(".select-packages .enquiry-button").removeClass("fixed-top");
		}
	});

	$(document).on("click",".EditPeople",function(){
		var id = $(this).attr("data-id");
		var user_id = $(this).attr("data-user");
		var package_id = $(this).attr("data-package");
		var location = $(this).attr("data-location");
		
		$('#package_day_id').val(id);
		$('#package_user_id').val(user_id);
		$('#package_package_id').val(package_id);
		$('#package_location').val(location);
	});

	$(document).on("click",".timer_people",function(){
		var id = $(this).attr("data-id");
		var user_id = $(this).attr("data-user");
		var package_id = $(this).attr("data-package");
		var location = $(this).attr("data-location");
				
		$('#package_day_ids').val(id);
		$('#package_user_ids').val(user_id);
		$('#package_package_ids').val(package_id);
		$('#package_locations').val(location);
		
	});
	
	
	$(document).on("ready", function() {
		$( "#datepicker" ).datepicker({ 
   			minDate: "+7"
		});
		$( "#start_date" ).datepicker();
	});


	function showTogel(id)
	{
		$("#show-hide-"+id+"").toggleClass("active");
		$("#image-boxing-"+id+"").toggleClass("hide");
		$("#boxing-content-"+id+"").toggleClass("hide");
	}

	function HideShow(id)
	{
		$("#show-hide-"+id+"").removeClass("active");
		$("#image-boxing-"+id+"").removeClass("hide");
		$("#boxing-content-"+id+"").removeClass("hide");
	}

	function remove_pack(id)
	{
		
		if(confirm("Are you sure you want to delete file?")){}
		else{return false;}
		$.ajax({
				url: baseURL+'CommonController/remove_packages',
				dataType: "JSON",
				method:"POST",
				data: {
				"id": id
			},
			success: function ()
			{
				$.notify({message: 'Your file delete successfuly'},{ type: 'success'});
				location.reload();
			}
		});
	}
	

	var height	=	$(".package-box .content-box").height();
	$(".package-box .content-box .hide-show-content").css('height',height);

</script>