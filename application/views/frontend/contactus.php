<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $SocialInfo = FrontSiteInfo();
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']  ?>" />
    <meta name="description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com.">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com." />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/contact-banner.png" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/contact-banner.png" />

    <meta name="twitter:title" content="<?= $pageTitle ?>" />
    <meta name="twitter:description" content="Coffee and Cream is available 24/7 to help you. You can call us on 07756765622. Also, you could send us an email to coffeenstrippers@gmail.com" />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>    
</head>


    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        <section class="breadcrumbs-custom">
            <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/contact-banner.png">
                <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/contact-banner.png" alt="contact-banner"></div>
                <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
                    <div class="container">
                        <h1 class="text-transform-capitalize breadcrumbs-custom-title">Contact Us</h1>
                        <h5 class="breadcrumbs-custom-text text-effect-contact"> <span>TO BOOK CLICK AND VIEW PROFILE AND CALL DIRECTLY</span> <a href="tel:<?=$SocialInfo['site_phone']?>" class="pulse"><i class="fas fa-phone-alt"></i></a> <span>ON THE TELEPHONE  ICON</span>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="breadcrumbs-custom-footer">
                <div class="container">
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section section-xl bg-default text-md-left contact_us">
			<div class="row m-0 align-items-center">
				<div class="col-lg-4 col-md-4 p-0 phone-image">
					<img src="<?=FRONT_ASSETS?>images/iphone-call.png" alt="Phone">
				</div>
				<div class="col-lg-8 col-md-8 p-0">
					<div class="contact-inner">
						<div class="title-block">
							<h3>Get in Touch With Us </h3>
						</div>
						<div class="Touch-main">
							<p>To advertise your products or services with us or for any other queries, get in touch via phone, email or fax on</p>
							<table>
								<thead>
									<tr>
										<th></th>
										<th colspan="2">Our contact</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($our_contact as $contacts) { ?>
									<tr>
										<td><?php echo $contacts->name ?></td>
										<td><a href="tel:+07707012858"><?php echo $contacts->number_1 ?></a></td>
										<td><a href="tel:+07707012858"><?php echo $contacts->number_2 ?></a></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							<table>
								<thead>
									<tr>
										<th></th>
										<th colspan="2">Available hours</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $result_time['title'] ?></td>
										<td><?php echo $result_time['descr'] ?></td>
									</tr>
								</tbody>
							</table>
							<table>
								<thead>
									<tr>
										<th colspan="3"><i class="far fa-comment-alt"></i> LANGUAGE AVAILABILITY</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<i class="far fa-check-circle"></i><strike> Spanish </strike><br>
											<i class="far fa-times-circle"></i><strike> Romanian</strike> <br>
											<i class="far fa-times-circle"></i><strike> Hungarian</strike> <br>
											<i class="far fa-times-circle"></i><strike> Estonian</strike> <br>
											<i class="far fa-times-circle"></i><strike> Portuguese</strike>
										</td>
										<td>
											<i class="far fa-check-circle"></i> English <br>
											<i class="far fa-times-circle"></i><strike> Polish</strike> <br>
											<i class="far fa-times-circle"></i><strike> French</strike> <br>
											<i class="far fa-times-circle"></i><strike> German</strike>
										</td>
										<td>
											<i class="far fa-times-circle"></i><strike> Slovak</strike> <br>
											<i class="far fa-times-circle"></i><strike> Italian</strike> <br>
											<i class="far fa-times-circle"></i><strike> Finnish</strike> <br>
											<i class="far fa-times-circle"></i><strike> Czech</strike>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
            </div>
        </section>

        <section class="section section-xl bg-default text-md-left contact-form pt-0">
			<div class="row m-0 align-items-center">
				<div class="col-lg-7 p-0">
					<div class="form-inner">
						<div class="title-classic">
							<h3 class="title-classic-title">Get in touch</h3>
							<p class="title-classic-subtitle">We are available 24/7 by fax, e-mail or by phone. You can also use our <span class="d-block">quick contact form to ask a question about our products.</span></p>
						</div>

						<form class="rd-form rd-mailform" method="post" action="<?=URL?>contactusprocess" id="contactus-form">
							<div class="row row-20 row-md-30">

								<?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>

								<ul class="list-check">
									<li>
										<i class="far fa-check-circle"></i> <label>General enquiries</label>
									</li>
									<li>
										<i class="far fa-check-circle"></i> <label>Feedback</label>
									</li>
									<li>
										<i class="far fa-check-circle"></i> <label>Media enquiries</label>
									</li>
									<li>
										<i class="far fa-check-circle"></i> <label>Technical issues</label>
									</li>
									<li>
										<i class="far fa-check-circle"></i> <label>Complaints</label>
									</li>
									<li>
										<i class="far fa-check-circle"></i> <label>Or if you want to advertise on our website</label>
									</li>
									<li>
										<i class="far fa-times-circle"></i> <label>Looking for an escort</label>
									</li>
								</ul>
								<div class="col-lg-12">
									<div class="row row-20 row-md-30">
										<div class="col-sm-6">
											<div class="form-wrap">
												<select name="department" id="department" class="" required>
													<option value="" class="disabled">Select department </option>
													<option value="0" selected="">General Support</option>
													<option value="1">Moderators</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6"></div>
										<div class="col-sm-6">
											<div class="form-wrap">
												<input class="form-input form-control-has-validation" id="name" name="name" type="text" required>
												<label class="form-label rd-input-label">Name</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-wrap">
												<input class="form-input form-control-has-validation" id="email" type="email" name="email" required>
												<label class="form-label rd-input-label">E-mail</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-wrap">
												<input class="form-input form-control-has-validation" id="phone" type="text" name="phone" required>
												<label class="form-label rd-input-label" for="phone">Phone</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-wrap">
										<label class="form-label rd-input-label">Message</label>
										<textarea class="form-input textarea-lg form-control-has-validation form-control-last-child" id="message" name="message" placeholder="Please let us know the reason for your enquiry so that the appropriate department can get back to you." required></textarea>
									</div>
								</div>
							</div>
							<button class="button button-lg button-primary button-zakaria" type="submit" value="Submit" id="contactus-btn">Send Message</button>
						</form>
					</div>
				</div>
				<div class="col-lg-5 p-0">
					<img src="<?=FRONT_ASSETS?>images/home-banner.png" alt="Home Banner">
				</div>
			</div>
        </section>
        <section class="section section-xl bg-gray-4">
            <div class="container">
                <div class="row row-30 justify-content-center">
                    <div class="col-sm-6 col-md-4">
                        <h4>Phones</h4>
                        <ul class="contacts-classic">
                            <li>Office <a href="tel:<?=$SocialInfo['site_phone']?>"><?=$SocialInfo['site_phone']?></a>
                            </li>
                            <li>Fax <a href="tel:+07707012858">07707 012858</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <h4>Address</h4>
                        <div class="contacts-classic"><?=$SocialInfo['site_address'];?></div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <h4>E-mails</h4>
                        <ul class="contacts-classic">
                            <li><a href="mailTo:<?=$SocialInfo['site_email']?>"><?=$SocialInfo['site_email']?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="section bg-default mb-5 pt-5 p-0">
            <div class="container">
                <div class="row row-40 row-md-60 justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                         <?php echo $result['descr']; ?>
                    </div>
                </div>
            </div>
        </section>
        </div>
        <?php $this->load->view(FRONTEND."include/footer"); ?>
        <?php $this->load->view(FRONTEND."include/include_js"); ?>
        <script type="text/javascript">
        $(document).ready(function(){
            $("#contactus-form").validate({
                 ignore: [],
                 rules: {
                    department:{required : true},
                    name:{required : true},
                    email:{required : true,email:true},
                    phone:{required : true,number:true},
                    message:{required : true},
                 },
                 messages: {
                    department:{required:"Please select department."},
                    email:{required:"Please enter email.",email:"Please enter valid email address."},
                    name:{required:"Please enter name."},
                    phone:{required:"Please enter phone number.",number:"Please enter valid phone number."},
                    message:{required:"Please enter message."},
                 }, 
                
              });
           });
        </script>
    </body>
</html>