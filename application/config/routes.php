<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']								= 'home';
$route['404_override'] 										= 'MyCustom404Ctrl';
$route['translate_uri_dashes'] 								= FALSE;
$route['error'] 											= "welcome/error";
$route['error_code'] 										= "welcome/error_code";

/************************************************************************************************************/
/************************************************************************************************************/
/**************************************** FRONTEND DEFINED ROUTES *******************************************/
/************************************************************************************************************/
/************************************************************************************************************/
$route['/'] 												= 'Home';
$route['privacy'] 											= 'Home/view_privacy';
$route['terms'] 											= 'Home/view_terms';
$route['faq'] 												= 'Home/view_faq';
$route['gallery/(:any)'] 									= "GalleryController/galleryList/$1";
$route['gallery/details/(:any)'] 							= "GalleryController/galleryDetails/$1";
$route['gallery/(:any)/(:any)'] 							= "GalleryController/galleryList/$1/$2";
$route['gallery/(:any)/(:any)/(:any)'] 						= "GalleryController/galleryList/$1/$2/$3";
$route['gallery/(:any)/(:any)/(:any)/(:any)'] 				= "GalleryController/galleryList/$1/$2/$3/$4";

$route['user/details/(:any)'] 								= "ServicesController/serviceDetails/$1";

//My Location details
$route['detail/(:any)/(:any)/(:any)']						= "ServicesController/serviceLocation/$1/$2/$3";

//Language 
$route['language/(:any)'] 									= "ServicesController/language_view/$1";

//Favorite
$route['favorite/(:any)'] 									= "ServicesController/favorite_view/$1";


$route['service/(:any)'] 									= "ServicesController/serviceList/$1";
//$route['service/details/(:any)'] 							= "ServicesController/serviceDetails/$1";
$route['service/(:any)/(:any)'] 							= "ServicesController/serviceList/$1/$2";
$route['service/(:any)/(:any)/(:any)'] 						= "ServicesController/serviceList/$1/$2/$3";
$route['service/(:any)/(:any)/(:any)/(:any)'] 				= "ServicesController/serviceList/$1/$2/$3/$4";

$route['contactus'] 										= "ContactusController/index";
$route['contactusprocess'] 									= "ContactusController/contact_us";
$route['about-us'] 											= "ContactusController/aboutus";

// ************ Membership Plan

$route['membership-plan'] 									= "MembershipPlanController/Membershipplan_View";
$route['membership/cron'] 									= "MembershipPlanController/planRangeOrderNotify";
$route['membership/expired'] 								= "MembershipPlanController/expired_mail";
$route['membership/timer'] 									= "MembershipPlanController/Timer";
$route['membership/automail'] 								= "MembershipPlanController/auto_mail";
$route['membership/replan'] 								= "MembershipPlanController/replan";
$route['membership/remove_story']                           = "MembershipPlanController/stories_remove";

//Membership Plan details
$route['membership-details'] 								= "MembershipPlanController/membership_details/";
$route['plan-history/(:any)'] 								= "MembershipPlanController/details_view/$1";
$route['thank-you']											= "MembershipPlanController/thank_you";
$route['plan/(:any)']										= "MembershipPlanController/viewParchesPlan/$1";
$route['plan-purchase']										= "MembershipPlanController/plan_expired";

//hen-stag-accommodation
$route['hen-stag-accommodation']                            = "HenStagController/hen_stag_show";
$route['hen-stag-accommodation/details/(:any)/(:any)']      = "HenStagController/details/$1/$2";
// add activeties
$route['hen-stag-accommodation/(:any)/(:any)']              = "HenStagController/view_stag/$1/$2";
//add hen stag packages
$route['adds-package/(:any)/(:any)']                        = "HenStagController/add_hen_stag/$1/$2";
//Location
$route['accommodation/location/(:any)']                     = "HenStagController/location_hen_stag_view/$1";



// ********************************** My Account Details *********************************
$route['profile-info'] 										= "MyAccountController/personal_info";
$route['check-alias-name'] 									= "MyAccountController/checkAliasName";
$route['change-password'] 									= "MyAccountController/view_change_password/";
$route['update-password'] 									= "MyAccountController/change_password/";
$route['call-rates'] 										= "MyAccountController/view_call_rates/";
$route['insert-rates'] 										= "MyAccountController/insert_call_rates/";
$route['contact-methods']                                   = "MyAccountController/contact_methods/";
$route['store-contact']                                     = "MyAccountController/store_contact/";

//Job application
$route['job-application']                                   = "MyAccountController/job_application/";
$route['jobs-details/(:any)']								= 'MyAccountController/jobs_details/$1';

//Hen Stag Accommodation
$route['packages']                                          = "MyAccountController/hen_stag_accommodation";
$route['packages/add']                                      = "MyAccountController/hen_stag_accommodation_add";
$route['packages/store/(:any)']								= "MyAccountController/hen_stag_accommodation_add/$1";
$route['packages/store']                                    = "MyAccountController/packages_store";


//************ adver blog ************* */
$route['adver-blog']                                        = "MyAccountController/view_blog";
$route['add-blog']                                          = "MyAccountController/add_blog";
$route['add-blog/(:any)']									= "MyAccountController/add_blog/$1";
$route['insertrecord-blog']                                 = "MyAccountController/store_blog";

//************* Add Stories  **********
$route['add-stories']                                       = "MyAccountController/story_view";
$route['stories-store']                                     = "MyAccountController/store_stories";
$route['story']                                             = "CommonController/get_story";

//payment history
$route['payment-history/details/(:any)'] 					= "PaymentController/payment_history_details/$1";
$route['payment-history'] 									= "PaymentController/payment_history_show";

//Home Filter
$route['search-filter'] 									= "CommonController/filter_view";

//Payment method 

$route['payment-method']                                    = "MyAccountController/card_view";

//My Diary
$route['my-diary']											= 'MyAccountController/view_my_diary/';
$route['diary-store'] 										= "MyAccountController/store_diary/";

$route['payment-info'] 										= "MyAccountController/view_payment_info/";
$route['insert-payment']									= "MyAccountController/insert_payment/";

$route['location'] 											= "MyAccountController/view_location/";
$route['location-store'] 									= "MyAccountController/store_location/";

$route['my-gallery']										= "MyAccountController/gallery/";
$route['gallery-store']										= "MyAccountController/store_gallery/";

$route['user-role'] 										= "Home/user_role/";
$route['user-Updaterole/(:any)'] 							= "Home/Updaterole/$1";
$route['update-profile'] 									= "MyAccountController/update_profile/";
$route['newsletters'] 										= "MyAccountController/newsletters/";
$route['update-newsletters'] 								= "MyAccountController/newsletters_update/";
$route['close-account'] 									= "MyAccountController/close_account/";
$route['update-close-account'] 								= "MyAccountController/close_account_update/";

$route['choose-user'] 										= "Auth/view_choose_user";
$route['SignUp'] 											= "Auth/view_registers";
$route['SignUp/(:any)/(:any)'] 								= "Auth/view_register/$1/$2";
$route['Plane'] 											= "Auth/view_register";
$route['SignIn'] 											= "Auth/view_login";
$route['login'] 											= "Auth/login";
$route['loginwithfb'] 										= "Auth/fblogin";
$route['loginwithgoogle'] 									= "Auth/googlelogin";
$route['register'] 											= "Auth/register";
$route['VerifyEmail/(:any)/(:any)'] 						= "Auth/verifyemail/$1/$2";
$route['logout'] 											= "Auth/logout";

$route['forgot-password'] 									= "Auth/forgotpassword";
$route['forgot-password-send'] 								= "Auth/forgot_password";
$route['reset-password/(:any)'] 							= "Auth/reset_password/$1";
$route['reset/(:any)'] 										= "Auth/reset/$1";

//Booking
$route['deposit/(:any)']									= "PaymentController/view_payment/$1";
$route['payment-process']									= "PaymentController/payment_process";
$route['payment-succcess'] 									= 'PaymentController/payment_succcess';
$route['payment-cancel/(:any)'] 							= 'PaymentController/payment_cancel/$1';
$route['payment-notify'] 									= 'PaymentController/payment_notify';

//********  Maps  ********* */
$route['maps']									            = "MapsController/view_maps";


// ******************** blog ***************
$route['blog'] 												= "BlogController/index";
$route['blog/search/(:any)'] 								= "BlogController/search/$1";
$route['blog/category/(:any)'] 								= "BlogController/category/$1";
$route['blog/details/(:any)'] 								= "BlogController/details/$1";

//Payment Guidelines
$route['payment-guidelines'] 								= "PaymentController/payment_guidelines";

//POST AN AD **Agency**
$route['post-and-ads'] 										= "AgencyControler/post_view";
$route['post-and-ads/details/(:any)'] 	                    = "AgencyControler/post_details/$1";

//Agencies
$route['agencies'] 										    = "AgencyControler/agencylists";
$route['agencies/(:any)'] 								    = "AgencyControler/agencylists/$1";
$route['agencies/(:any)/(:any)'] 						    = "AgencyControler/agencylists/$1/$2";
$route['agencies/(:any)/(:any)/(:any)'] 				    = "AgencyControler/agencylists/$1/$2/$3";

$route['agency/details/(:any)'] 						    = "AgencyControler/agencyDetails/$1";
$route['agency/details/(:any)/(:any)'] 					    = "AgencyControler/agencyDetails/$1/$2";
$route['post-and-ads/categories/(:any)']                    = "AgencyControler/category_view/$1";
$route['apply-job']                                         = "AgencyControler/apply_job";
$route['request-job']                                       = "AgencyControler/request_job";

//entertainment & escort count
$route['entertainment-agencies/(:any)/(:any)']              = "AgencyControler/entertainment_view/$1/$2";
$route['escort-agencies/(:any)/(:any)']                     = "AgencyControler/escort_view/$1/$2";

//Create posts
$route['post']                                              = "MyAccountController/view_post";
$route['post-add']											= "MyAccountController/insert_form_post";
$route['post-add/(:any)']									= "MyAccountController/insert_form_post/$1";
$route['insertrecord-post']                                 = "MyAccountController/insertRecord";

//Videos 
$route['videos']											= 'VideosController/index';

//Account Reviews
$route['review']											= 'MyAccountController/review';
$route['review-details/(:any)']								= 'MyAccountController/review_details/$1';

//User Write a review
$route['review-store']										= 'ReviewController/store';

/*********************** ADMIN DEFINED ROUTES *****************************/

$route['admin'] 											= 'admin/login';
$route['loginMe'] 											= 'admin/login/loginMe';
$route['admin/dashboard'] 									= 'admin/user';
$route['admin/logout'] 										= 'admin/user/logout';

//Home Page
$route['admin/home-page-banner'] 							= 'admin/HomepageController/home_page_view';
$route['admin/manage-testimonial'] 							= 'admin/HomepageController/homePage_Des';

//Service manage image
$route['admin/manage-service-image'] 						= 'admin/HomepageController/img_view';


//Service manage image
$route['admin/home-page-service-content'] 					= 'admin/HomepageController/view_service_content';


$route['admin/forgot-password'] 							= "admin/login/forgotpassword";
$route['admin/forgot-password-send'] 						= "admin/login/forgot_password";
$route['admin/reset-password/(:any)'] 						= "admin/login/reset_password/$1";
$route['admin/reset/(:any)'] 								= "admin/login/reset/$1";


$route['admin/manage-sub-admin']							= "admin/ManageSubAdmin";

// Manage User
$route['admin/manage-admin'] 								= 'admin/ManageAdmin';
$route['admin/manage-admin/add'] 							= 'admin/ManageAdmin/showform';
$route['admin/manage-admin/edit/(:any)'] 					= 'admin/ManageAdmin/showform/$1';
$route['admin/manage-admin/view/(:any)'] 					= 'admin/ManageAdmin/getDetail/$1';
$route['admin/admin-store'] 								= 'admin/ManageAdmin/store';
$route['admin/manage-admin/delete/(:any)'] 					= 'admin/ManageAdmin/delete/$1';


//Manage Agency
$route['admin/manage-agency']                               = 'admin/ManageAgency';
$route['admin/manage-agency/view/(:any)'] 					= 'admin/ManageAgency/getDetail/$1';
$route['admin/manage-agency/gallery/(:any)'] 				= 'admin/ManageAgency/gallery_details/$1';
$route['admin/manage-agency/delete/(:any)'] 				= 'admin/ManageAgency/delete/$1';

//Manage Hen Stag Accommodation
$route['admin/manage-hen-stag-accommodation']               = 'admin/HenStagAccommoController';
$route['admin/manage-hen-stag-accommodation/view/(:any)'] 					= 'admin/HenStagAccommoController/getDetail/$1';
$route['admin/manage-hen-stag-accommodation/gallery/(:any)'] 				= 'admin/HenStagAccommoController/gallery_details/$1';
$route['admin/manage-hen-stag-accommodation/delete/(:any)'] 				= 'admin/HenStagAccommoController/delete/$1';


// Manage Users
$route['admin/manage-user'] 								= 'admin/ManageCustomers';
$route['admin/manage-user/view/(:any)'] 					= 'admin/ManageCustomers/getDetail/$1';
$route['admin/manage-user/gallery/(:any)'] 					= 'admin/ManageCustomers/gallery_details/$1';
$route['admin/manage-user/gallery1'] 						= 'admin/ManageCustomers/gallery_details1';
$route['admin/manage-user/delete/(:any)'] 					= 'admin/ManageCustomers/delete/$1';
$route['manage-user/photosVerify'] 							= 'admin/ManageCustomers/Verifygallery';


//Settings
$route['admin/loadChangePass'] 								= "admin/user/loadChangePass";
$route['admin/changePassword'] 								= "admin/user/changePassword";

// faq
$route['admin/manage-faq'] 									= 'admin/Faq';
$route['admin/manage-faq/add'] 								= 'admin/Faq/showform';
$route['admin/manage-faq/edit/(:any)'] 						= 'admin/Faq/showform/$1';
$route['admin/manage-faq/view/(:any)'] 						= 'admin/Faq/getDetail/$1';
$route['admin/manage-faq/delete/(:any)'] 					= 'admin/Faq/delete/$1';

//Manage Terms
$route['admin/manage-terms']                                = 'admin/TermController';

// Manage Location
$route['admin/manage-city'] 								= 'admin/ManageLocation';
$route['admin/manage-city-area'] 							= 'admin/ManageLocation/cityarea';
$route['admin/manage-state'] 								= 'admin/ManageLocation/state';
$route['admin/manage-country'] 								= 'admin/ManageLocation/country';

//Mange Service
$route['admin/manage-service'] 								= 'admin/ServiceController/service';

//Advert Plan
$route['admin/manage-advert-plan'] 							= 'admin/AdvertplanController';

//Manage Favourite
$route['admin/manage-favourite'] 							= 'admin/ManageLocation/favourite';

//Manage language
$route['admin/manage-language'] 							= 'admin/ManageLocation/language';

//Contact Us
$route['admin/subscriber'] 									= 'admin/SubscriberController';

/*contact*/
$route['admin/contact'] 									= 'admin/ContactController';
$route['admin/our-contact'] 								= 'admin/ContactController/our_contact';
$route['admin/description-contact'] 						= 'admin/ContactController/manage_des_contact';


// CMS
$route['admin/cms/store'] 									= 'admin/Cms/store';
$route['admin/cms/(:any)'] 									= 'admin/Cms/index/$1';

// Manage Membership Plan 
$route['admin/manage-membership-plan'] 						= 'admin/MembershipPlanController';

// Post
$route['admin/manage-blog'] 								= 'admin/BlogController';
$route['admin/manage-blog/add'] 							= 'admin/BlogController/showform';
$route['admin/manage-blog/edit/(:any)'] 					= 'admin/BlogController/showform/$1';
$route['admin/manage-blog/delete/(:any)'] 					= 'admin/BlogController/delete/$1';
$route['admin/manage-blog/view/(:any)'] 					= 'admin/BlogController/getDetail/$1';
$route['admin/blog-store'] 									= 'admin/BlogController/store';
$route['admin/manage-blog-category'] 						= 'admin/BlogController/blog_category';

//Manage Videos
$route['admin/manage-videos']								= 'admin/VideoController';

// Mange about us
$route['admin/about-us']									= 'admin/AboutusController';

//Send Mail
$route['admin/send-mail-list']								= 'admin/ManageCustomers/v_send_mail_list';
$route['admin/send-mail']									= 'admin/ManageCustomers/v_send_mail';
$route['admin/send-mail/(:any)']						    = 'admin/ManageCustomers/v_send_mail/$1';
$route['admin/mail_sending']								= 'admin/ManageCustomers/mail_sending';

//Manage hen stag  
$route['admin/manage-hen-stag']								= 'admin/HenStagController';