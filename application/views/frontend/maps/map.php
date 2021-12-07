<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$FrontSiteInfo = FrontSiteInfo();
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
<link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
<meta name="description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment.">

<meta name="facebook-domain-verification" content="ibnktxgx5u3zxbe0g9j8q3hp3fx0y3" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />

<meta property="og:title" content="<?= $pageTitle ?>" />
<meta property="og:description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment." />
<meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

<meta property="og:site_name" content="Coffee & Strippers" />
<meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
<meta property="og:image:width" content="1457" />
<meta property="og:image:height" content="461" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="Logo or Banner Image" />

<meta name="twitter:title" content="<?= $pageTitle ?>" />
<meta name="twitter:description" content="Stripper Party Bus offers the best Male & Female strippers, kissograms, and escort services in Ireland and Northern Ireland. Visit our website and book now for entertainment." />

<?php $this->load->view(FRONTEND."include/include_css"); ?>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
</head>
  
<body class="">    
<?php //$this->load->view(FRONTEND."include/menu"); ?>

<div class="logo-fixed">
	<a href="<?php echo base_url();?>" title="Logo"><img src="<?php echo base_url('public/front/images/logo/waterMark.png');?>" alt="Logo"></a>
</div>

<div class="container-fluid maplistiong-section p-0">
	<div class="row no-gutters">
		<div class="col-md-5 map-block">
			<div class="map-inner">
				<div id='map'></div>	
			</div>
		</div>
		<div class="col-md-7 profile-block-map directory-listing-form">
			<div class="directory-listings-search">
				<form>
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="form-group">
								<label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
								<input type="text" id="keywords" name="keywords" placeholder="What are you looking for?" class="display-3 form-control">
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label><i class="fa fa-location-arrow" aria-hidden="true"></i></label>
								<input type="text" id="keyword_location" name="keyword_location" placeholder="Location" class="form-control" value="United Kingdom">
							</div>
						</div>
					</div>
					<div class="directory-search-btn profile-search-map">
						<!-- <button type="button" class="btn btn-primary">Geolocation <i class="fad fa-location"></i></button>
						<button type="button" class="btn btn-primary seach_filter_block">Filter <i class="fal fa-filter"></i></button> -->
						<button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
				</form>
			</div>
			<div class="result-main">
				<div class="title-main-block">
					<h4>Strippers Clubs</h4>
				</div>
				<div class="row mt-0" id="resultList">
					
				</div>
			</div>
		</div>
	</div>

</div>


<!-- footer -->
<?php //$this->load->view(FRONTEND."include/footer"); ?>
<?php //$this->load->view(FRONTEND."include/include_js"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

<script type="text/javascript">
	var flag = 0;
function searchFilter()
{
  $("#resultList").html("");
  getRecords(0);
}

function getRecords() 
{
    
  var keywords            = $('#keywords').val();
  var keyword_location    = $('#keyword_location').val();

  $.ajax({
    type : 'POST',
    url : '<?php echo APP_URL ?>MapsController/map_search/',
    data:'keywords='+keywords+'&keyword_location='+keyword_location,
	dataType:'json',
    beforeSend: function(){
      $(".loading-div").show();
    },
    success:function(data)
    {
        setTimeout(function(){
            $(".loading-div").hide();
            $('#resultList').append(data.html);
			intimap(data.map);
			map.setView(new L.LatLng(data.latitude,data.longitude), 8);
        },1500);
    }
  });
}

</script>
<script>
	// var options = {
	// 	enableHighAccuracy: true,
	// 	timeout: 5000,
	// 	maximumAge: 0
	// };

	// function error(err) {
	// 	console.warn(`ERROR(${err.code}): ${err.message}`);
	// }

    // var latitude = -75.50;
	// var longitude = 40;

    // navigator.geolocation.getCurrentPosition(success, error, options);

	// function success(pos) {
	// 	var crd = pos.coords;
	// 	console.log(pos);	
	// 	longitude = crd.longitude;
	// 	latitude = crd.latitude;		
	// }

	L.mapbox.accessToken = 'pk.eyJ1IjoibWVodWxzeG9wZSIsImEiOiJja2dramhjanEwaTFnMnFsbHRtdTdyb2ozIn0.rz9r6eRsWrmUGM9SZk2rKw';
	var map = L.mapbox.map('map')
		.setView([40, -75.50], 8)
		.addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));
		
	var myLayer = L.mapbox.featureLayer().addTo(map);
	

	var geoJson = {
		type: 'FeatureCollection',
		features: []
	};
	
	// Set a custom icon on each marker based on feature properties.
	myLayer.on('layeradd', function(e) {
		var marker = e.layer,
			feature = marker.feature;
	
		marker.setIcon(L.icon(feature.properties.icon));
	});
	
	// Add features to the map.
	myLayer.setGeoJSON(geoJson);

	L.control.fullscreen().addTo(map);
	    

	function intimap($data){
		myLayer.setGeoJSON($data);
	}

	var options = {
		enableHighAccuracy: true,
		timeout: 5000,
		maximumAge: 0
	};

	

    navigator.geolocation.getCurrentPosition(success, error, options);

	function error(err) {
		console.warn(`ERROR(${err.code}): ${err.message}`);
	}

	function success(pos) {
		var crd = pos.coords;	
		longitude = crd.longitude;
		latitude = crd.latitude;
		
		getCountryName(latitude,longitude);		
	}

	function getCountryName(latitude,longitude){
		if(flag == 0){

			flag = 1;
// 			$.ajax({
// 				type : 'POST',
// 				url :'<?php echo APP_URL ?>MapsController/getCountryName',
// 				data : {latitude:latitude,longitude,longitude},
// 				success:function(data)
// 				{
// 					map.setView(new L.LatLng(latitude,longitude), 8);
// 					$("#keyword_location").val(data);
// 				}
// 			});
		}

	}

	$( document ).ready(function() {
    	getRecords();
	});
  </script>



