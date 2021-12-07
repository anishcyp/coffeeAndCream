<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$SocialInfo = FrontSiteInfo(); 
$onpage_record      = 8;
$location_onpage_record = 8;
?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
    <meta name="description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event.">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="Advertise with us - Stripper Party Bus" />
    <meta property="og:description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event." />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />
    <meta name="twitter:image" content="<?=FRONT_ASSETS?>images/banner-img.jpg" />

    <meta name="twitter:title" content="Advertise with us - Stripper Party Bus" />
    <meta name="twitter:description" content="We offer a range of flexible and cost-effective advertising solutions to help you publicize your product, service, or event." />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>

<body class="">    
<?php $this->load->view(FRONTEND."include/menu"); ?>
<section class="breadcrumbs-custom post-agencies-breadcrumbs">
    <div class="parallax-container parallax-agencies" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg" style="background-image:url(<?=FRONT_ASSETS?>images/banner-img.jpg);">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark">
            <div class="container">
                <div class="directory-listing-form">
                    <h1>Agencies</h1>
                    <div class="directory-listings-search">
                        <form id="service_search" class="service_search" method="post" action="javascript:void(0);">
                            
                                <div>
                                    <div class="form-group">
                                        <label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
                                        <input type="text" id="keywords" name="keywords" placeholder="Type in service or location you want." class="form-control" autocomplete="off">
                                        <div id="suggesstion-box" class="suggest"></div>
                                    </div>
                                </div>
                            
                            <div class="directory-search-btn">
                                <button type="button" class="btn btn-primary">Geolocation<i class="fad fa-location"></i></button>
                                <button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $post_ad_and = 'post-and-ads';
    if($post_ad_and != "")
    {
        $url = base_url('agencies');
        $path = "<a href='".$url."'>".$pageTitle."</a>";
        
    } 
    if($country_id != "")
    {
        $c_name = $coutry_n;

        $url .= "/".$this->slug->create_slug($c_name);
        $path = $path." /<a href='".$url."'>".$c_name."</a>";

    }
    if($state_id != "")
    {
        $c_name = $coutry_n;
        $s_name = $state_n;
        $url .= "/".$this->slug->create_slug($s_name);
        $path = $path." /<a href='".$url."'>".$s_name."</a>";
    }
    if($city_id != "")
    {
        $c_name = $coutry_n;
        $s_name = $state_n;
        $sy_name = $city_n;

        $url .= "/".$this->slug->create_slug($sy_name);
        $path = $path." /<a href='".$url."'>".$sy_name."</a>";
    }
    ?>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?=base_url();?>">Home</a></li>
                <li class="active"><?=$path;?></li>
            </ul>
        </div>
    </div>
</section>
	<div class="location-section">
		<div class="container">
			<ul class="location-list" id="locationResultList">
				
			</ul> 
			<?php
			// echo $location_total_record; exit();
			if($location_total_record > $location_onpage_record){ ?>
				<p class="text-center"><button class="btn btn-primary" id="location_load_more" data-val="0" type="button" style="display: none;"> Load more</button></p>
			<?php }?>      
		</div>
	</div>
	
	<div class="post-agencies-section">
		<div class="container">
			<div class="section-header">
				<h2>Agencies Available</h2>
			</div>
			<div class="row" id="resultList">
				
			</div>
			
			<div class="readmore-content">
				<div class="row">
					<!-- <div class="col-sm-6">
						<a href="#">Search in your location</a>
					</div> -->
					<?php if($total_record > $onpage_record){ ?>
					<div class="col-sm-12">
						<p class="text-center"><a href="javascript:void(0)"  id="load_more" data-val="0" type="button" style="display: none;">Load more agencies</a></p>
					</div>
					<?php } ?>
				</div>
			</div>
        			
		</div>
	</div>
	
	<div class="post-agencies">
		<div class="container">
			<div class="row">
				<div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="javascript:void(0)">Agency membership</a></h5>
					</div>
					<div class="panel-content">
						<p><b>Grow your agency by advertising on a platform that gives you maximum exposure to potential clients.</b></p>
                        <p>At coffee n Cream, we give agencies a platform to advertise their services and entertainers in all parts of the world.</p>
                        <p>Once you have created an agency account, you can create ads and advertise new positions in multiple locations of your choosing. An agency can have between 5 to 20 profiles and will manage all bookings on behalf of its members</p>
                        <p>You can advertise your services such as pole dancing services, stripping services, models, and escort services to clients with Coffee n Cream, and you are guaranteed maximum exposure. Agencies have benefits of advertising on the company blog, advertise with their company logo and get a VIP ribbon from Coffee n Cream.</p>
                        <p><b>Benefits of agency to customers</b></p>
                        <p><b>For clients, some of the benefits of being part of an agency include:</b></p>
                        <p>You can advertise in unlimited locations</p>
                        <p>If you are sick, the agency can easily find someone else to cover for you</p>
                        <p><b>Locations</b></p>
                        <p>Coffee n Cream is a worldwide company and that means you can advertise in any location in the world as well as operate and manage your entertainers from any country.</p>
                        <p>In Europe, agencies can advertise in England, Scotland, Wales, Northern Ireland, Republic of Ireland, France, Spain, Albania, Armenia, Austria, Belarus Belgium, Bulgaria, Croatia, Cyprus, Czech Republic, Denmark, Estonia, Finland, Germany, Greece, Hungary, Iceland, Italy, Latvia, Malta, Luxembourg,  Lithuania, Moldova, Monaco, Montenegro, Netherlands, North Macedonia, Norway, Poland, Portugal, Romania, Russia, Serbia, Slovakia, Slovenia, Spain, Sweden, Switzerland, Turkey, and Ukraine.</p>
                        <p>Here are some of the entertainers that coffee n Cream offers through agencies:</p>
					</div>
				</div>
			
				<div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="javascript:void(0)">Escort’s agency</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Escorts, Swansea Escorts , Wrexham Escorts, Newport Escorts, Barry Escorts, Neath Escorts,
Bridgend Escorts, Cwmbran Escorts, Llanelli Escorts, Merthyr Tydfil Escorts, Aberaeron Escorts, Dundee
Escorts, Aberdeen Escorts, Inverness Escorts, Perth Escorts, Stirling Escorts, Cumbernauld Escorts,
Glenrothes Escorts, Paisley Escorts, Melrose Escorts, Glasgow Escorts, Edinburgh Escorts, Bath Escorts,
Birmingham Escorts, Bradford Escorts, Brighton & Hove Escorts, Bristol Escorts, Cambridge Escorts,
Canterbury Escorts , Carlisle Escorts , Chelmsford Escorts, Chester Escorts, Chichester Escorts, Coventry
Escorts, Derby Escorts, Durham Escorts , Ely Escorts, Exeter Escorts, Gloucester Escorts, Hereford
Escorts, Kingston-upon-Hull Escorts, Lancaster Escorts, Leeds Escorts, Leicester Escorts, Lichfield Escorts,
Lincoln Escorts, Liverpool Escorts, London Escorts , Manchester Escorts , Newcastle-upon-Tyne Escorts ,
Norwich Escorts , Nottingham Escorts, Oxford Escorts, Peterborough Escorts, Plymouth Escorts,
Portsmouth Escorts , Preston Escorts , Ripon Escorts, Salford Escorts, Salisbury Escorts, Sheffield Escorts,
Southampton Escorts , St Albans Escorts, Stoke-on-Trent Escorts, Sunderland Escorts, Truro Escorts,
Wakefield Escorts , Wells Escorts, City of Westminster Escorts, Winchester Escorts , Wolverhampton
Escorts , Worcester Escorts, York Escorts, Belfast Escorts, Derry Escorts, Newtownabbey Escorts,
Craigavon Escorts, Bangor Escorts , Castlereagh Escorts, Lisburn Escorts, Ballymena Escorts,
Newtownards Escorts, Carrickfergus Escorts, Newry Escorts , Coleraine Escorts, Antrim Escorts, Omagh
Escorts, Larne Escorts, Banbridge Escorts, Armagh Escorts, Dungannon Escorts , Strabane Escorts,
Limavady Escorts, Cookstown Escorts , Holywood Escorts, Downpatrick Escorts, Ballymoney Escorts,
Ballyclare Escorts, Comber Escorts, Warrenpoint Escorts, Dromore Escorts, Crumlin Escorts,
Randallstown Escorts, Dublin Escorts, Cork Escorts, Limerick Escorts, Galway Escorts, Waterford Escorts,
Drogheda Escorts, Swords Escorts, Dundalk Escorts, Bray Escorts, Navan Escorts, Kilkenny Escorts, Ennis
Escorts, Carlow Escorts, Tralee Escorts, Newbridge Escorts, PortLaoise Escorts, Naas Escorts, Athlone
Escorts, Mullingar Escorts, Wexford Escorts, Letterkenny Escorts, Sligo Escorts, Greystones Escorts,
Clonmel Escorts, Leixlip Escorts , Tullamore Escorts, Maynooth Escorts, Arklow Escorts , Ashbourne
Escorts, massage escorts, transsexual escorts, live virtual escorts, live full girlfriend experience escorts,
white escorts, Latino escorts, blonde escorts, bisexual escorts, redhead escorts, Asian escorts, BBW
escorts, Arabic escorts, tiny body escorts ,party girl escorts, full live experience escorts, porno escorts,
authentic Thai massage escorts, local escorts, Colombian escorts, beautiful Asian escorts, In call and
outcall escorts, local busty sexy escorts, sexy escorts, discreet escorts, naughty escorts, curvy escorts,
big boobies escorts,247 escorts, luxury escorts, sexy Latina escorts, best tasty body Brazilian escorts, all
services passionate milf, English curvaceous escorts, luxury porn escorts</p>
					</div>
				</div>
			
			
				<div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="javascript:void(0)">Strippers’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Strippers, Swansea Strippers , Wrexham Strippers, Newport Strippers, Barry Strippers, Neath
Strippers, Bridgend Strippers, Cwmbran Strippers, Llanelli Strippers, Merthyr Tydfil Strippers, Aberaeron
Strippers, Dundee Strippers, Aberdeen Strippers, Inverness Strippers, Perth Strippers, Stirling Strippers,
Cumbernauld Strippers, Glenrothes Strippers, Paisley Strippers, Melrose Strippers, Glasgow Strippers,
Edinburgh Strippers, Bath Strippers, Birmingham Strippers, Bradford Strippers, Brighton & Hove
Strippers, Bristol Strippers, Cambridge Strippers, Canterbury Strippers , Carlisle Strippers , Chelmsford
Strippers, Chester Strippers, Chichester Strippers, Coventry Strippers, Derby Strippers, Durham
Strippers, Ely Strippers, Exeter Strippers, Gloucester Strippers, Hereford Strippers, Kingston-upon-Hull
Strippers, Lancaster Strippers, Leeds Strippers, Leicester Strippers, Lichfield Strippers, Lincoln Strippers,
Liverpool Strippers, London Strippers , Manchester Strippers , Newcastle-upon-Tyne Strippers , Norwich 
Strippers, Nottingham Strippers, Oxford Strippers, Peterborough Strippers, Plymouth Strippers,
Portsmouth Strippers , Preston Strippers , Ripon Strippers, Salford Strippers, Salisbury Strippers,
Sheffield Strippers, Southampton Strippers , St Albans Strippers, Stoke-on-Trent Strippers, Sunderland
Strippers, Truro Strippers, Wakefield Strippers , Wells Strippers, City of Westminster Strippers,
Winchester Strippers , Wolverhampton Strippers , Worcester Strippers, York Strippers, Belfast Strippers,
Derry Strippers, Newtownabbey Strippers, Craigavon Strippers, Bangor Strippers , Castlereagh Strippers,
Lisburn Strippers, Ballymena Strippers, Newtownards Strippers, Carrickfergus Strippers, Newry Strippers,
Coleraine Strippers, Antrim Strippers, Omagh Strippers, Larne Strippers, Banbridge Strippers, Armagh
Strippers, Dungannon Strippers , Strabane Strippers, Limavady Strippers, Cookstown Strippers ,
Holywood Strippers, Downpatrick Strippers, Ballymoney Strippers, Ballyclare Strippers, Comber
Strippers, Warrenpoint Strippers, Dromore Strippers, Crumlin Strippers, Randallstown Strippers, Dublin
Strippers, Cork Strippers, Limerick Strippers, Galway Strippers, Waterford Strippers, Drogheda Strippers,
Swords Strippers, Dundalk Strippers, Bray Strippers, Navan Strippers, Kilkenny Strippers, Ennis Strippers,
Carlow Strippers, Tralee Strippers, Newbridge Strippers, PortLaoise Strippers, Naas Strippers, Athlone
Strippers, Mullingar Strippers, Wexford Strippers, Letterkenny Strippers, Sligo Strippers, Greystones
Strippers, Clonmel Strippers, Leixlip Strippers , Tullamore Strippers, Maynooth Strippers, Arklow
Strippers , Ashbourne Strippers.</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="javascript:void(0)">Kissograms’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Kissograms, Swansea Kissograms , Wrexham Kissograms, Newport Kissograms, Barry Kissograms,
Neath Kissograms, Bridgend Kissograms, Cwmbran Kissograms, Llanelli Kissograms, Merthyr Tydfil
Kissograms, Aberaeron Kissograms, Dundee Kissograms, Aberdeen Kissograms, Inverness Kissograms,
Perth Kissograms, Stirling Kissograms, Cumbernauld Kissograms, Glenrothes Kissograms, Paisley
Kissograms, Melrose Kissograms, Glasgow Kissograms, Edinburgh Kissograms, Bath Kissograms,
Birmingham Kissograms, Bradford Kissograms, Brighton & Hove Kissograms, Bristol Kissograms, 
Cambridge Kissograms, Canterbury Kissograms , Carlisle Kissograms , Chelmsford Kissograms, Chester
Kissograms, Chichester Kissograms, Coventry Kissograms, Derby Kissograms, Durham Kissograms , Ely
Kissograms, Exeter Kissograms, Gloucester Kissograms, Hereford Kissograms, Kingston-upon-Hull
Kissograms, Lancaster Kissograms, Leeds Kissograms, Leicester Kissograms, Lichfield Kissograms, Lincoln
Kissograms, Liverpool Kissograms, London Kissograms , Manchester Kissograms , Newcastle-upon-Tyne
Kissograms , Norwich Kissograms , Nottingham Kissograms, Oxford Kissograms, Peterborough
Kissograms, Plymouth Kissograms, Portsmouth Kissograms , Preston Kissograms , Ripon Kissograms,
Salford Kissograms, Salisbury Kissograms, Sheffield Kissograms, Southampton Kissograms , St Albans
Kissograms, Stoke-on-Trent Kissograms, Sunderland Kissograms, Truro Kissograms, Wakefield
Kissograms , Wells Kissograms, City of Westminster Kissograms, Winchester Kissograms ,
Wolverhampton Kissograms , Worcester Kissograms, York Kissograms, Belfast Kissograms, Derry
Kissograms, Newtownabbey Kissograms, Craigavon Kissograms, Bangor Kissograms , Castlereagh
Kissograms, Lisburn Kissograms, Ballymena Kissograms, Newtownards Kissograms, Carrickfergus
Kissograms, Newry Kissograms , Coleraine Kissograms, Antrim Kissograms, Omagh Kissograms, Larne
Kissograms, Banbridge Kissograms, Armagh Kissograms, Dungannon Kissograms , Strabane Kissograms,
Limavady Kissograms, Cookstown Kissograms , Holywood Kissograms, Downpatrick Kissograms,
Ballymoney Kissograms, Ballyclare Kissograms, Comber Kissograms, Warrenpoint Kissograms, Dromore
Kissograms, Crumlin Kissograms, Randallstown Kissograms, Dublin Kissograms, Cork Kissograms,
Limerick Kissograms, Galway Kissograms, Waterford Kissograms, Drogheda Kissograms, Swords
Kissograms, Dundalk Kissograms, Bray Kissograms, Navan Kissograms, Kilkenny Kissograms, Ennis
Kissograms, Carlow Kissograms, Tralee Kissograms, Newbridge Kissograms, PortLaoise Kissograms, Naas
Kissograms, Athlone Kissograms, Mullingar Kissograms, Wexford Kissograms, Letterkenny Kissograms,
Sligo Kissograms, Greystones Kissograms, Clonmel Kissograms, Leixlip Kissograms , Tullamore
Kissograms, Maynooth Kissograms, Arklow Kissograms , Ashbourne Kissograms, Busty kissograms, sexy 
kissograms, female kissograms , male kissograms, bisexual kissograms, wild kissograms, naughty
kissograms, surprise party bus kissograms, hot kissograms</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Drag queens’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Drag queens, Swansea Drag queens , Wrexham Drag queens, Newport Drag queens, Barry Drag
queens, Neath Drag queens, Bridgend Drag queens, Cwmbran Drag queens, Llanelli Drag queens,
Merthyr Tydfil Drag queens, Aberaeron Drag queens, Dundee Drag queens, Aberdeen Drag queens,
Inverness Drag queens, Perth Drag queens, Stirling Drag queens, Cumbernauld Drag queens, Glenrothes
Drag queens, Paisley Drag queens, Melrose Drag queens, Glasgow Drag queens, Edinburgh Drag queens,
Bath Drag queens, Birmingham Drag queens, Bradford Drag queens, Brighton & Hove Drag queens,
Bristol Drag queens, Cambridge Drag queens, Canterbury Drag queens , Carlisle Drag queens ,
Chelmsford Drag queens, Chester Drag queens, Chichester Drag queens, Coventry Drag queens, Derby
Drag queens, Durham Drag queens , Ely Drag queens, Exeter Drag queens, Gloucester Drag queens,
Hereford Drag queens, Kingston-upon-Hull Drag queens, Lancaster Drag queens, Leeds Drag queens,
Leicester Drag queens, Lichfield Drag queens, Lincoln Drag queens, Liverpool Drag queens, London Drag
queens , Manchester Drag queens , Newcastle-upon-Tyne Drag queens , Norwich Drag queens ,
Nottingham Drag queens, Oxford Drag queens, Peterborough Drag queens, Plymouth Drag queens,
Portsmouth Drag queens , Preston Drag queens , Ripon Drag queens, Salford Drag queens, Salisbury
Drag queens, Sheffield Drag queens, Southampton Drag queens , St Albans Drag queens, Stoke-on-Trent
Drag queens, Sunderland Drag queens, Truro Drag queens, Wakefield Drag queens , Wells Drag queens,
City of Westminster Drag queens, Winchester Drag queens , Wolverhampton Drag queens , Worcester
Drag queens, York Drag queens, Belfast Drag queens, Derry Drag queens, Newtownabbey Drag queens,
Craigavon Drag queens, Bangor Drag queens , Castlereagh Drag queens, Lisburn Drag queens, Ballymena
Drag queens, Newtownards Drag queens, Carrickfergus Drag queens, Newry Drag queens , Coleraine
Drag queens, Antrim Drag queens, Omagh Drag queens, Larne Drag queens, Banbridge Drag queens, 
Armagh Drag queens, Dungannon Drag queens , Strabane Drag queens, Limavady Drag queens,
Cookstown Drag queens , Holywood Drag queens, Downpatrick Drag queens, Ballymoney Drag queens,
Ballyclare Drag queens, Comber Drag queens, Warrenpoint Drag queens, Dromore Drag queens, Crumlin
Drag queens, Randallstown Drag queens, Dublin Drag queens, Cork Drag queens, Limerick Drag queens,
Galway Drag queens, Waterford Drag queens, Drogheda Drag queens, Swords Drag queens, Dundalk
Drag queens, Bray Drag queens, Navan Drag queens, Kilkenny Drag queens, Ennis Drag queens, Carlow
Drag queens, Tralee Drag queens, Newbridge Drag queens, PortLaoise Drag queens, Naas Drag queens,
Athlone Drag queens, Mullingar Drag queens,Wexford Drag queens, Letterkenny Drag queens, Sligo
Drag queens, Greystones Drag queens, Clonmel Drag queens, Leixlip Drag queens , Tullamore Drag
queens, Maynooth Drag queens, Arklow Drag queens , Ashbourne Drag queens, naughty drag queens</p>
					</div>
				</div>


                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Buff butlers’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Buff butlers, Swansea Buff butlers , Wrexham Buff butlers, Newport Buff butlers, Barry Buff
butlers, Neath Buff butlers, Bridgend Buff butlers, Cwmbran Buff butlers, Llanelli Buff butlers, Merthyr
Tydfil Buff butlers, Aberaeron Buff butlers, Dundee Buff butlers, Aberdeen Buff butlers, Inverness Buff
butlers, Perth Buff butlers, Stirling Buff butlers, Cumbernauld Buff butlers, Glenrothes Buff butlers,
Paisley Buff butlers, Melrose Buff butlers, Glasgow Buff butlers, Edinburgh Buff butlers, Bath Buff
butlers, Birmingham Buff butlers, Bradford Buff butlers, Brighton & Hove Buff butlers, Bristol Buff
butlers, Cambridge Buff butlers, Canterbury Buff butlers , Carlisle Buff butlers , Chelmsford Buff butlers,
Chester Buff butlers, Chichester Buff butlers, Coventry Buff butlers, Derby Buff butlers, Durham Buff
butlers , Ely Buff butlers, Exeter Buff butlers, Gloucester Buff butlers, Hereford Buff butlers, Kingstonupon-Hull Buff butlers, Lancaster Buff butlers, Leeds Buff butlers, Leicester Buff butlers, Lichfield Buff
butlers, Lincoln Buff butlers, Liverpool Buff butlers, London Buff butlers , Manchester Buff butlers ,
Newcastle-upon-Tyne Buff butlers , Norwich Buff butlers , Nottingham Buff butlers, Oxford Buff butlers,
Peterborough Buff butlers, Plymouth Buff butlers, Portsmouth Buff butlers , Preston Buff butlers , Ripon 
Buff butlers, Salford Buff butlers, Salisbury Buff butlers, Sheffield Buff butlers, Southampton Buff butlers
, St Albans Buff butlers, Stoke-on-Trent Buff butlers, Sunderland Buff butlers, Truro Buff butlers,
Wakefield Buff butlers , Wells Buff butlers, City of Westminster Buff butlers, Winchester Buff butlers ,
Wolverhampton Buff butlers , Worcester Buff butlers, York Buff butlers, Belfast Buff butlers, Derry Buff
butlers, Newtownabbey Buff butlers, Craigavon Buff butlers, Bangor Buff butlers , Castlereagh Buff
butlers, Lisburn Buff butlers, Ballymena Buff butlers, Newtownards Buff butlers, Carrickfergus Buff
butlers, Newry Buff butlers , Coleraine Buff butlers, Antrim Buff butlers, Omagh Buff butlers, Larne Buff
butlers, Banbridge Buff butlers, Armagh Buff butlers, Dungannon Buff butlers , Strabane Buff butlers,
Limavady Buff butlers, Cookstown Buff butlers , Holywood Buff butlers, Downpatrick Buff butlers,
Ballymoney Buff butlers, Ballyclare Buff butlers, Comber Buff butlers, Warrenpoint Buff butlers,
Dromore Buff butlers, Crumlin Buff butlers, Randallstown Buff butlers, Dublin Buff butlers, Cork Buff
butlers, Limerick Buff butlers, Galway Buff butlers, Waterford Buff butlers, Drogheda Buff butlers,
Swords Buff butlers, Dundalk Buff butlers, Bray Buff butlers, Navan Buff butlers, Kilkenny Buff butlers,
Ennis Buff butlers, Carlow Buff butlers, Tralee Buff butlers, Newbridge Buff butlers, PortLaoise Buff
butlers, Naas Buff butlers, Athlone Buff butlers, Mullingar Buff butlers,Wexford Buff butlers, Letterkenny
Buff butlers, Sligo Buff butlers, Greystones Buff butlers, Clonmel Buff butlers, Leixlip Buff butlers ,
Tullamore Buff butlers, Maynooth Buff butlers, Arklow Buff butlers , Ashbourne Buff butlers, sexy buff
butlers, naughty buff butlers
</p>
					</div>
				</div>


                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Bunny girls’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Bunny girls, Swansea Bunny girls , Wrexham Bunny girls, Newport Bunny girls, Barry Bunny girls,
Neath Bunny girls, Bridgend Bunny girls, Cwmbran Bunny girls, Llanelli Bunny girls, Merthyr Tydfil Bunny
girls, Aberaeron Bunny girls, Dundee Bunny girls, Aberdeen Bunny girls, Inverness Bunny girls, Perth
Bunny girls, Stirling Bunny girls, Cumbernauld Bunny girls, Glenrothes Bunny girls, Paisley Bunny girls,
Melrose Bunny girls, Glasgow Bunny girls, Edinburgh Bunny girls, Bath Bunny girls, Birmingham Bunny 
girls, Bradford Bunny girls, Brighton & Hove Bunny girls, Bristol Bunny girls, Cambridge Bunny girls,
Canterbury Bunny girls , Carlisle Bunny girls , Chelmsford Bunny girls, Chester Bunny girls, Chichester
Bunny girls, Coventry Bunny girls, Derby Bunny girls, Durham Bunny girls , Ely Bunny girls, Exeter Bunny
girls, Gloucester Bunny girls, Hereford Bunny girls, Kingston-upon-Hull Bunny girls, Lancaster Bunny girls,
Leeds Bunny girls, Leicester Bunny girls, Lichfield Bunny girls, Lincoln Bunny girls, Liverpool Bunny girls,
London Bunny girls , Manchester Bunny girls , Newcastle-upon-Tyne Bunny girls , Norwich Bunny girls ,
Nottingham Bunny girls, Oxford Bunny girls, Peterborough Bunny girls, Plymouth Bunny girls,
Portsmouth Bunny girls , Preston Bunny girls , Ripon Bunny girls, Salford Bunny girls, Salisbury Bunny
girls, Sheffield Bunny girls, Southampton Bunny girls , St Albans Bunny girls, Stoke-on-Trent Bunny girls,
Sunderland Bunny girls, Truro Bunny girls, Wakefield Bunny girls , Wells Bunny girls, City of Westminster
Bunny girls, Winchester Bunny girls , Wolverhampton Bunny girls , Worcester Bunny girls, York Bunny
girls, Belfast Bunny girls, Derry Bunny girls, Newtownabbey Bunny girls, Craigavon Bunny girls, Bangor
Bunny girls , Castlereagh Bunny girls, Lisburn Bunny girls, Ballymena Bunny girls, Newtownards Bunny
girls, Carrickfergus Bunny girls, Newry Bunny girls , Coleraine Bunny girls, Antrim Bunny girls, Omagh
Bunny girls, Larne Bunny girls, Banbridge Bunny girls, Armagh Bunny girls, Dungannon Bunny girls ,
Strabane Bunny girls, Limavady Bunny girls, Cookstown Bunny girls , Holywood Bunny girls, Downpatrick
Bunny girls, Ballymoney Bunny girls, Ballyclare Bunny girls, Comber Bunny girls, Warrenpoint Bunny girls,
Dromore Bunny girls, Crumlin Bunny girls, Randallstown Bunny girls, Dublin Bunny girls, Cork Bunny girls,
Limerick Bunny girls, Galway Bunny girls, Waterford Bunny girls, Drogheda Bunny girls, Swords Bunny
girls, Dundalk Bunny girls, Bray Bunny girls, Navan Bunny girls, Kilkenny Bunny girls, Ennis Bunny girls,
Carlow Bunny girls, Tralee Bunny girls, Newbridge Bunny girls, PortLaoise Bunny girls, Naas Bunny girls,
Athlone Bunny girls, Mullingar Bunny girls,Wexford Bunny girls, Letterkenny Bunny girls, Sligo Bunny
girls, Greystones Bunny girls, Clonmel Bunny girls, Leixlip Bunny girls , Tullamore Bunny girls, Maynooth 
Bunny girls, Arklow Bunny girls , Ashbourne Bunny girls, sexy bunny girls, blonde bunny girls, black
bunny girls, red-haired bunny girls, Naughty bunny girls
</p>
					</div>
				</div>


                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Topless waitresses’ agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Topless waitresses, Swansea Topless waitresses , Wrexham Topless waitresses, Newport Topless
waitresses, Barry Topless waitresses, Neath Topless waitresses, Bridgend Topless waitresses, Cwmbran
Topless waitresses, Llanelli Topless waitresses, Merthyr Tydfil Topless waitresses, Aberaeron Topless
waitresses, Dundee Topless waitresses, Aberdeen Topless waitresses, Inverness Topless waitresses,
Perth Topless waitresses, Stirling Topless waitresses, Cumbernauld Topless waitresses, Glenrothes
Topless waitresses, Paisley Topless waitresses, Melrose Topless waitresses, Glasgow Topless waitresses,
Edinburgh Topless waitresses, Bath Topless waitresses, Birmingham Topless waitresses, Bradford
Topless waitresses, Brighton & Hove Topless waitresses, Bristol Topless waitresses, Cambridge Topless
waitresses, Canterbury Topless waitresses , Carlisle Topless waitresses , Chelmsford Topless waitresses,
Chester Topless waitresses, Chichester Topless waitresses, Coventry Topless waitresses, Derby Topless
waitresses, Durham Topless waitresses , Ely Topless waitresses, Exeter Topless waitresses, Gloucester
Topless waitresses, Hereford Topless waitresses, Kingston-upon-Hull Topless waitresses, Lancaster
Topless waitresses, Leeds Topless waitresses, Leicester Topless waitresses, Lichfield Topless waitresses,
Lincoln Topless waitresses, Liverpool Topless waitresses, London Topless waitresses , Manchester
Topless waitresses , Newcastle-upon-Tyne Topless waitresses , Norwich Topless waitresses , Nottingham
Topless waitresses, Oxford Topless waitresses, Peterborough Topless waitresses, Plymouth Topless
waitresses, Portsmouth Topless waitresses , Preston Topless waitresses , Ripon Topless waitresses,
Salford Topless waitresses, Salisbury Topless waitresses, Sheffield Topless waitresses, Southampton
Topless waitresses , St Albans Topless waitresses, Stoke-on-Trent Topless waitresses, Sunderland
Topless waitresses, Truro Topless waitresses, Wakefield Topless waitresses , Wells Topless waitresses,
City of Westminster Topless waitresses, Winchester Topless waitresses , Wolverhampton Topless 
waitresses , Worcester Topless waitresses, York Topless waitresses, Belfast Topless waitresses, Derry
Topless waitresses, Newtownabbey Topless waitresses, Craigavon Topless waitresses, Bangor Topless
waitresses , Castlereagh Topless waitresses, Lisburn Topless waitresses, Ballymena Topless waitresses,
Newtownards Topless waitresses, Carrickfergus Topless waitresses, Newry Topless waitresses ,
Coleraine Topless waitresses, Antrim Topless waitresses, Omagh Topless waitresses, Larne Topless
waitresses, Banbridge Topless waitresses, Armagh Topless waitresses, Dungannon Topless waitresses ,
Strabane Topless waitresses, Limavady Topless waitresses, Cookstown Topless waitresses , Holywood
Topless waitresses, Downpatrick Topless waitresses, Ballymoney Topless waitresses, Ballyclare Topless
waitresses, Comber Topless waitresses, Warrenpoint Topless waitresses, Dromore Topless waitresses,
Crumlin Topless waitresses, Randallstown Topless waitresses, Dublin Topless waitresses, Cork Topless
waitresses, Limerick Topless waitresses, Galway Topless waitresses, Waterford Topless waitresses,
Drogheda Topless waitresses, Swords Topless waitresses, Dundalk Topless waitresses, Bray Topless
waitresses, Navan Topless waitresses, Kilkenny Topless waitresses, Ennis Topless waitresses, Carlow
Topless waitresses, Tralee Topless waitresses, Newbridge Topless waitresses, PortLaoise Topless
waitresses, Naas Topless waitresses, Athlone Topless waitresses, Mullingar Topless waitresses, Wexford
Topless waitresses, Letterkenny Topless waitresses, Sligo Topless waitresses, Greystones Topless
waitresses, Clonmel Topless waitresses, Leixlip Topless waitresses , Tullamore Topless waitresses,
Maynooth Topless waitresses, Arklow Topless waitresses , Ashbourne Topless waitresses, Sexy topless
waitresses, Busty topless waitresses, Hot topless waitresses, Naughty topless waitresses, Flirty topless
waitresses
</p>
					</div>
				</div>


                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Life drawing and nude painting models agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Life drawing and nude painting models, Swansea Life drawing and nude painting models ,
Wrexham Life drawing and nude painting models, Newport Life drawing and nude painting models,
Barry Life drawing and nude painting models, Neath Life drawing and nude painting models, Bridgend 
Life drawing and nude painting models, Cwmbran Life drawing and nude painting models, Llanelli Life
drawing and nude painting models, Merthyr Tydfil Life drawing and nude painting models, Aberaeron
Life drawing and nude painting models, Dundee Life drawing and nude painting models, Aberdeen Life
drawing and nude painting models, Inverness Life drawing and nude painting models, Perth Life drawing
and nude painting models, Stirling Life drawing and nude painting models, Cumbernauld Life drawing
and nude painting models, Glenrothes Life drawing and nude painting models, Paisley Life drawing and
nude painting models, Melrose Life drawing and nude painting models, Glasgow Life drawing and nude
painting models, Edinburgh Life drawing and nude painting models, Bath Life drawing and nude painting
models, Birmingham Life drawing and nude painting models, Bradford Life drawing and nude painting
models, Brighton & Hove Life drawing and nude painting models, Bristol Life drawing and nude painting
models, Cambridge Life drawing and nude painting models, Canterbury Life drawing and nude painting
models , Carlisle Life drawing and nude painting models , Chelmsford Life drawing and nude painting
models, Chester Life drawing and nude painting models, Chichester Life drawing and nude painting
models, Coventry Life drawing and nude painting models, Derby Life drawing and nude painting models,
Durham Life drawing and nude painting models , Ely Life drawing and nude painting models, Exeter Life
drawing and nude painting models, Gloucester Life drawing and nude painting models, Hereford Life
drawing and nude painting models, Kingston-upon-Hull Life drawing and nude painting models,
Lancaster Life drawing and nude painting models, Leeds Life drawing and nude painting models,
Leicester Life drawing and nude painting models, Lichfield Life drawing and nude painting models,
Lincoln Life drawing and nude painting models, Liverpool Life drawing and nude painting models,
London Life drawing and nude painting models , Manchester Life drawing and nude painting models ,
Newcastle-upon-Tyne Life drawing and nude painting models , Norwich Life drawing and nude painting
models , Nottingham Life drawing and nude painting models, Oxford Life drawing and nude painting
models, Peterborough Life drawing and nude painting models, Plymouth Life drawing and nude painting 
models, Portsmouth Life drawing and nude painting models , Preston Life drawing and nude painting
models , Ripon Life drawing and nude painting models, Salford Life drawing and nude painting models,
Salisbury Life drawing and nude painting models, Sheffield Life drawing and nude painting models,
Southampton Life drawing and nude painting models , St Albans Life drawing and nude painting models,
Stoke-on-Trent Life drawing and nude painting models, Sunderland Life drawing and nude painting
models, Truro Life drawing and nude painting models, Wakefield Life drawing and nude painting models
, Wells Life drawing and nude painting models, City of Westminster Life drawing and nude painting
models, Winchester Life drawing and nude painting models , Wolverhampton Life drawing and nude
painting models , Worcester Life drawing and nude painting models, York Life drawing and nude
painting models, Belfast Life drawing and nude painting models, Derry Life drawing and nude painting
models, Newtownabbey Life drawing and nude painting models, Craigavon Life drawing and nude
painting models, Bangor Life drawing and nude painting models , Castlereagh Life drawing and nude
painting models, Lisburn Life drawing and nude painting models, Ballymena Life drawing and nude
painting models, Newtownards Life drawing and nude painting models, Carrickfergus Life drawing and
nude painting models, Newry Life drawing and nude painting models , Coleraine Life drawing and nude
painting models, Antrim Life drawing and nude painting models, Omagh Life drawing and nude painting
models, Larne Life drawing and nude painting models, Banbridge Life drawing and nude painting
models, Armagh Life drawing and nude painting models, Dungannon Life drawing and nude painting
models , Strabane Life drawing and nude painting models, Limavady Life drawing and nude painting
models, Cookstown Life drawing and nude painting models , Holywood Life drawing and nude painting
models, Downpatrick Life drawing and nude painting models, Ballymoney Life drawing and nude
painting models, Ballyclare Life drawing and nude painting models, Comber Life drawing and nude
painting models, Warrenpoint Life drawing and nude painting models, Dromore Life drawing and nude
painting models, Crumlin Life drawing and nude painting models, Randallstown Life drawing and nude 
painting models, Dublin Life drawing and nude painting models, Cork Life drawing and nude painting
models, Limerick Life drawing and nude painting models, Galway Life drawing and nude painting
models, Waterford Life drawing and nude painting models, Drogheda Life drawing and nude painting
models, Swords Life drawing and nude painting models, Dundalk Life drawing and nude painting models,
Bray Life drawing and nude painting models, Navan Life drawing and nude painting models, Kilkenny
Life drawing and nude painting models, Ennis Life drawing and nude painting models, Carlow Life
drawing and nude painting models, Tralee Life drawing and nude painting models, Newbridge Life
drawing and nude painting models, PortLaoise Life drawing and nude painting models, Naas Life drawing
and nude painting models, Athlone Life drawing and nude painting models, Mullingar Life drawing and
nude painting models,Wexford Life drawing and nude painting models, Letterkenny Life drawing and
nude painting models, Sligo Life drawing and nude painting models, Greystones Life drawing and nude
painting models, Clonmel Life drawing and nude painting models, Leixlip Life drawing and nude painting
models , Tullamore Life drawing and nude painting models, Maynooth Life drawing and nude painting
models, Arklow Life drawing and nude painting models , Ashbourne Life drawing and nude painting
models</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Roly-poly strippers agencies </a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Roly-poly strippers, Swansea Roly-poly strippers , Wrexham Roly-poly strippers, Newport Rolypoly strippers, Barry Roly-poly strippers, Neath Roly-poly strippers, Bridgend Roly-poly strippers,
Cwmbran Roly-poly strippers, Llanelli Roly-poly strippers, Merthyr Tydfil Roly-poly strippers, Aberaeron
Roly-poly strippers, Dundee Roly-poly strippers, Aberdeen Roly-poly strippers, Inverness Roly-poly
strippers, Perth Roly-poly strippers, Stirling Roly-poly strippers, Cumbernauld Roly-poly strippers,
Glenrothes Roly-poly strippers, Paisley Roly-poly strippers, Melrose Roly-poly strippers, Glasgow Rolypoly strippers, Edinburgh Roly-poly strippers, Bath Roly-poly strippers, Birmingham Roly-poly strippers,
Bradford Roly-poly strippers, Brighton & Hove Roly-poly strippers, Bristol Roly-poly strippers, Cambridge 
Roly-poly strippers, Canterbury Roly-poly strippers , Carlisle Roly-poly strippers , Chelmsford Roly-poly
strippers, Chester Roly-poly strippers, Chichester Roly-poly strippers, Coventry Roly-poly strippers,
Derby Roly-poly strippers, Durham Roly-poly strippers , Ely Roly-poly strippers, Exeter Roly-poly
strippers, Gloucester Roly-poly strippers, Hereford Roly-poly strippers, Kingston-upon-Hull Roly-poly
strippers, Lancaster Roly-poly strippers, Leeds Roly-poly strippers, Leicester Roly-poly strippers, Lichfield
Roly-poly strippers, Lincoln Roly-poly strippers, Liverpool Roly-poly strippers, London Roly-poly strippers
, Manchester Roly-poly strippers , Newcastle-upon-Tyne Roly-poly strippers , Norwich Roly-poly
strippers , Nottingham Roly-poly strippers, Oxford Roly-poly strippers, Peterborough Roly-poly strippers,
Plymouth Roly-poly strippers, Portsmouth Roly-poly strippers , Preston Roly-poly strippers , Ripon Rolypoly strippers, Salford Roly-poly strippers, Salisbury Roly-poly strippers, Sheffield Roly-poly strippers,
Southampton Roly-poly strippers , St Albans Roly-poly strippers, Stoke-on-Trent Roly-poly strippers,
Sunderland Roly-poly strippers, Truro Roly-poly strippers, Wakefield Roly-poly strippers , Wells Roly-poly
strippers, City of Westminster Roly-poly strippers, Winchester Roly-poly strippers , Wolverhampton
Roly-poly strippers , Worcester Roly-poly strippers, York Roly-poly strippers, Belfast Roly-poly strippers,
Derry Roly-poly strippers, Newtownabbey Roly-poly strippers, Craigavon Roly-poly strippers, Bangor
Roly-poly strippers , Castlereagh Roly-poly strippers, Lisburn Roly-poly strippers, Ballymena Roly-poly
strippers, Newtownards Roly-poly strippers, Carrickfergus Roly-poly strippers, Newry Roly-poly strippers
, Coleraine Roly-poly strippers, Antrim Roly-poly strippers, Omagh Roly-poly strippers, Larne Roly-poly
strippers, Banbridge Roly-poly strippers, Armagh Roly-poly strippers, Dungannon Roly-poly strippers ,
Strabane Roly-poly strippers, Limavady Roly-poly strippers, Cookstown Roly-poly strippers , Holywood
Roly-poly strippers, Downpatrick Roly-poly strippers, Ballymoney Roly-poly strippers, Ballyclare Rolypoly strippers, Comber Roly-poly strippers, Warrenpoint Roly-poly strippers, Dromore Roly-poly
strippers, Crumlin Roly-poly strippers, Randallstown Roly-poly strippers, Dublin Roly-poly strippers, Cork
Roly-poly strippers, Limerick Roly-poly strippers, Galway Roly-poly strippers, Waterford Roly-poly 
strippers, Drogheda Roly-poly strippers, Swords Roly-poly strippers, Dundalk Roly-poly strippers, Bray
Roly-poly strippers, Navan Roly-poly strippers, Kilkenny Roly-poly strippers, Ennis Roly-poly strippers,
Carlow Roly-poly strippers, Tralee Roly-poly strippers, Newbridge Roly-poly strippers, PortLaoise Rolypoly strippers, Naas Roly-poly strippers, Athlone Roly-poly strippers, Mullingar Roly-poly
strippers,Wexford Roly-poly strippers, Letterkenny Roly-poly strippers, Sligo Roly-poly strippers,
Greystones Roly-poly strippers, Clonmel Roly-poly strippers, Leixlip Roly-poly strippers , Tullamore Rolypoly strippers, Maynooth Roly-poly strippers, Arklow Roly-poly strippers , Ashbourne Roly-poly strippers,
Sexy roly-poly strippers, Busty roly-poly strippers, Hot roly-poly strippers</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Virtual strippers agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Virtual strippers, Swansea Virtual strippers , Wrexham Virtual strippers, Newport Virtual
strippers, Barry Virtual strippers, Neath Virtual strippers, Bridgend Virtual strippers, Cwmbran Virtual
strippers, Llanelli Virtual strippers, Merthyr Tydfil Virtual strippers, Aberaeron Virtual strippers, Dundee
Virtual strippers, Aberdeen Virtual strippers, Inverness Virtual strippers, Perth Virtual strippers, Stirling
Virtual strippers, Cumbernauld Virtual strippers, Glenrothes Virtual strippers, Paisley Virtual strippers,
Melrose Virtual strippers, Glasgow Virtual strippers, Edinburgh Virtual strippers, Bath Virtual strippers,
Birmingham Virtual strippers, Bradford Virtual strippers, Brighton & Hove Virtual strippers, Bristol Virtual
strippers, Cambridge Virtual strippers, Canterbury Virtual strippers , Carlisle Virtual strippers ,
Chelmsford Virtual strippers, Chester Virtual strippers, Chichester Virtual strippers, Coventry Virtual
strippers, Derby Virtual strippers, Durham Virtual strippers , Ely Virtual strippers, Exeter Virtual strippers,
Gloucester Virtual strippers, Hereford Virtual strippers, Kingston-upon-Hull Virtual strippers, Lancaster
Virtual strippers, Leeds Virtual strippers, Leicester Virtual strippers, Lichfield Virtual strippers, Lincoln
Virtual strippers, Liverpool Virtual strippers, London Virtual strippers , Manchester Virtual strippers ,
Newcastle-upon-Tyne Virtual strippers , Norwich Virtual strippers , Nottingham Virtual strippers, Oxford
Virtual strippers, Peterborough Virtual strippers, Plymouth Virtual strippers, Portsmouth Virtual 
strippers , Preston Virtual strippers , Ripon Virtual strippers, Salford Virtual strippers, Salisbury Virtual
strippers, Sheffield Virtual strippers, Southampton Virtual strippers , St Albans Virtual strippers, Stokeon-Trent Virtual strippers, Sunderland Virtual strippers, Truro Virtual strippers, Wakefield Virtual
strippers , Wells Virtual strippers, City of Westminster Virtual strippers, Winchester Virtual strippers ,
Wolverhampton Virtual strippers , Worcester Virtual strippers, York Virtual strippers, Belfast Virtual
strippers, Derry Virtual strippers, Newtownabbey Virtual strippers, Craigavon Virtual strippers, Bangor
Virtual strippers , Castlereagh Virtual strippers, Lisburn Virtual strippers, Ballymena Virtual strippers,
Newtownards Virtual strippers, Carrickfergus Virtual strippers, Newry Virtual strippers , Coleraine Virtual
strippers, Antrim Virtual strippers, Omagh Virtual strippers, Larne Virtual strippers, Banbridge Virtual
strippers, Armagh Virtual strippers, Dungannon Virtual strippers , Strabane Virtual strippers, Limavady
Virtual strippers, Cookstown Virtual strippers , Holywood Virtual strippers, Downpatrick Virtual
strippers, Ballymoney Virtual strippers, Ballyclare Virtual strippers, Comber Virtual strippers,
Warrenpoint Virtual strippers, Dromore Virtual strippers, Crumlin Virtual strippers, Randallstown Virtual
strippers, Dublin Virtual strippers, Cork Virtual strippers, Limerick Virtual strippers, Galway Virtual
strippers, Waterford Virtual strippers, Drogheda Virtual strippers, Swords Virtual strippers, Dundalk
Virtual strippers, Bray Virtual strippers, Navan Virtual strippers, Kilkenny Virtual strippers, Ennis Virtual
strippers, Carlow Virtual strippers, Tralee Virtual strippers, Newbridge Virtual strippers, PortLaoise
Virtual strippers, Naas Virtual strippers, Athlone Virtual strippers, Mullingar Virtual strippers,Wexford
Virtual strippers, Letterkenny Virtual strippers, Sligo Virtual strippers, Greystones Virtual strippers,
Clonmel Virtual strippers, Leixlip Virtual strippers , Tullamore Virtual strippers, Maynooth Virtual
strippers, Arklow Virtual strippers , Ashbourne Virtual strippers</p>
					</div>
				</div>
                
                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Party bus agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Party bus, Swansea Party bus , Wrexham Party bus, Newport Party bus, Barry Party bus, Neath
Party bus, Bridgend Party bus, Cwmbran Party bus, Llanelli Party bus, Merthyr Tydfil Party bus, 
Aberaeron Party bus, Dundee Party bus, Aberdeen Party bus, Inverness Party bus, Perth Party bus,
Stirling Party bus, Cumbernauld Party bus, Glenrothes Party bus, Paisley Party bus, Melrose Party bus,
Glasgow Party bus, Edinburgh Party bus, Bath Party bus, Birmingham Party bus, Bradford Party bus,
Brighton & Hove Party bus, Bristol Party bus, Cambridge Party bus, Canterbury Party bus , Carlisle Party
bus , Chelmsford Party bus, Chester Party bus, Chichester Party bus, Coventry Party bus, Derby Party
bus, Durham Party bus , Ely Party bus, Exeter Party bus, Gloucester Party bus, Hereford Party bus,
Kingston-upon-Hull Party bus, Lancaster Party bus, Leeds Party bus, Leicester Party bus, Lichfield Party
bus, Lincoln Party bus, Liverpool Party bus, London Party bus , Manchester Party bus , Newcastle-uponTyne Party bus , Norwich Party bus , Nottingham Party bus, Oxford Party bus, Peterborough Party bus,
Plymouth Party bus, Portsmouth Party bus , Preston Party bus , Ripon Party bus, Salford Party bus,
Salisbury Party bus, Sheffield Party bus, Southampton Party bus , St Albans Party bus, Stoke-on-Trent
Party bus, Sunderland Party bus, Truro Party bus, Wakefield Party bus , Wells Party bus, City of
Westminster Party bus, Winchester Party bus , Wolverhampton Party bus , Worcester Party bus, York
Party bus, Belfast Party bus, Derry Party bus, Newtownabbey Party bus, Craigavon Party bus, Bangor
Party bus , Castlereagh Party bus, Lisburn Party bus, Ballymena Party bus, Newtownards Party bus,
Carrickfergus Party bus, Newry Party bus , Coleraine Party bus, Antrim Party bus, Omagh Party bus,
Larne Party bus, Banbridge Party bus, Armagh Party bus, Dungannon Party bus , Strabane Party bus,
Limavady Party bus, Cookstown Party bus , Holywood Party bus, Downpatrick Party bus, Ballymoney
Party bus, Ballyclare Party bus, Comber Party bus, Warrenpoint Party bus, Dromore Party bus, Crumlin
Party bus, Randallstown Party bus, Dublin Party bus, Cork Party bus, Limerick Party bus, Galway Party
bus, Waterford Party bus, Drogheda Party bus, Swords Party bus, Dundalk Party bus, Bray Party bus,
Navan Party bus, Kilkenny Party bus, Ennis Party bus, Carlow Party bus, Tralee Party bus, Newbridge
Party bus, PortLaoise Party bus, Naas Party bus, Athlone Party bus, Mullingar Party bus,Wexford Party 
bus, Letterkenny Party bus, Sligo Party bus, Greystones Party bus, Clonmel Party bus, Leixlip Party bus ,
Tullamore Party bus, Maynooth Party bus, Arklow Party bus , Ashbourne Party bus
</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Cocktail classes agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Cocktail classes, Swansea Cocktail classes , Wrexham Cocktail classes, Newport Cocktail classes,
Barry Cocktail classes, Neath Cocktail classes, Bridgend Cocktail classes, Cwmbran Cocktail classes,
Llanelli Cocktail classes, Merthyr Tydfil Cocktail classes, Aberaeron Cocktail classes, Dundee Cocktail
classes, Aberdeen Cocktail classes, Inverness Cocktail classes, Perth Cocktail classes, Stirling Cocktail
classes, Cumbernauld Cocktail classes, Glenrothes Cocktail classes, Paisley Cocktail classes, Melrose
Cocktail classes, Glasgow Cocktail classes, Edinburgh Cocktail classes, Bath Cocktail classes, Birmingham
Cocktail classes, Bradford Cocktail classes, Brighton & Hove Cocktail classes, Bristol Cocktail classes,
Cambridge Cocktail classes, Canterbury Cocktail classes , Carlisle Cocktail classes , Chelmsford Cocktail
classes, Chester Cocktail classes, Chichester Cocktail classes, Coventry Cocktail classes, Derby Cocktail
classes, Durham Cocktail classes , Ely Cocktail classes, Exeter Cocktail classes, Gloucester Cocktail classes,
Hereford Cocktail classes, Kingston-upon-Hull Cocktail classes, Lancaster Cocktail classes, Leeds Cocktail
classes, Leicester Cocktail classes, Lichfield Cocktail classes, Lincoln Cocktail classes, Liverpool Cocktail
classes, London Cocktail classes , Manchester Cocktail classes , Newcastle-upon-Tyne Cocktail classes ,
Norwich Cocktail classes , Nottingham Cocktail classes, Oxford Cocktail classes, Peterborough Cocktail
classes, Plymouth Cocktail classes, Portsmouth Cocktail classes , Preston Cocktail classes , Ripon Cocktail
classes, Salford Cocktail classes, Salisbury Cocktail classes, Sheffield Cocktail classes, Southampton
Cocktail classes , St Albans Cocktail classes, Stoke-on-Trent Cocktail classes, Sunderland Cocktail classes,
Truro Cocktail classes, Wakefield Cocktail classes , Wells Cocktail classes, City of Westminster Cocktail
classes, Winchester Cocktail classes , Wolverhampton Cocktail classes , Worcester Cocktail classes, York
Cocktail classes, Belfast Cocktail classes, Derry Cocktail classes, Newtownabbey Cocktail classes,
Craigavon Cocktail classes, Bangor Cocktail classes , Castlereagh Cocktail classes, Lisburn Cocktail classes, 
Ballymena Cocktail classes, Newtownards Cocktail classes, Carrickfergus Cocktail classes, Newry Cocktail
classes , Coleraine Cocktail classes, Antrim Cocktail classes, Omagh Cocktail classes, Larne Cocktail
classes, Banbridge Cocktail classes, Armagh Cocktail classes, Dungannon Cocktail classes , Strabane
Cocktail classes, Limavady Cocktail classes, Cookstown Cocktail classes , Holywood Cocktail classes,
Downpatrick Cocktail classes, Ballymoney Cocktail classes, Ballyclare Cocktail classes, Comber Cocktail
classes, Warrenpoint Cocktail classes, Dromore Cocktail classes, Crumlin Cocktail classes, Randallstown
Cocktail classes, Dublin Cocktail classes, Cork Cocktail classes, Limerick Cocktail classes, Galway Cocktail
classes, Waterford Cocktail classes, Drogheda Cocktail classes, Swords Cocktail classes, Dundalk Cocktail
classes, Bray Cocktail classes, Navan Cocktail classes, Kilkenny Cocktail classes, Ennis Cocktail classes,
Carlow Cocktail classes, Tralee Cocktail classes, Newbridge Cocktail classes, PortLaoise Cocktail classes,
Naas Cocktail classes, Athlone Cocktail classes, Mullingar Cocktail classes,Wexford Cocktail classes,
Letterkenny Cocktail classes, Sligo Cocktail classes, Greystones Cocktail classes, Clonmel Cocktail classes,
Leixlip Cocktail classes , Tullamore Cocktail classes, Maynooth Cocktail classes, Arklow Cocktail classes ,
Ashbourne Cocktail classes
</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">DJs agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff DJs, Swansea DJs , Wrexham DJs, Newport DJs, Barry DJs, Neath DJs, Bridgend DJs, Cwmbran DJs,
Llanelli DJs, Merthyr Tydfil DJs, Aberaeron DJs, Dundee DJs, Aberdeen DJs, Inverness DJs, Perth DJs,
Stirling DJs, Cumbernauld DJs, Glenrothes DJs, Paisley DJs, Melrose DJs, Glasgow DJs, Edinburgh DJs,
Bath DJs, Birmingham DJs, Bradford DJs, Brighton & Hove DJs, Bristol DJs, Cambridge DJs, Canterbury DJs
, Carlisle DJs , Chelmsford DJs, Chester DJs, Chichester DJs, Coventry DJs, Derby DJs, Durham DJs , Ely DJs,
Exeter DJs, Gloucester DJs, Hereford DJs, Kingston-upon-Hull DJs, Lancaster DJs, Leeds DJs, Leicester DJs,
Lichfield DJs, Lincoln DJs, Liverpool DJs, London DJs , Manchester DJs , Newcastle-upon-Tyne DJs ,
Norwich DJs , Nottingham DJs, Oxford DJs, Peterborough DJs, Plymouth DJs, Portsmouth DJs , Preston
DJs , Ripon DJs, Salford DJs, Salisbury DJs, Sheffield DJs, Southampton DJs , St Albans DJs, Stoke-on-Trent 
DJs, Sunderland DJs, Truro DJs, Wakefield DJs , Wells DJs, City of Westminster DJs, Winchester DJs ,
Wolverhampton DJs , Worcester DJs, York DJs, Belfast DJs, Derry DJs, Newtownabbey DJs, Craigavon DJs,
Bangor DJs , Castlereagh DJs, Lisburn DJs, Ballymena DJs, Newtownards DJs, Carrickfergus DJs, Newry DJs
, Coleraine DJs, Antrim DJs, Omagh DJs, Larne DJs, Banbridge DJs, Armagh DJs, Dungannon DJs ,
Strabane DJs, Limavady DJs, Cookstown DJs , Holywood DJs, Downpatrick DJs, Ballymoney DJs, Ballyclare
DJs, Comber DJs, Warrenpoint DJs, Dromore DJs, Crumlin DJs, Randallstown DJs, Dublin DJs, Cork DJs,
Limerick DJs, Galway DJs, Waterford DJs, Drogheda DJs, Swords DJs, Dundalk DJs, Bray DJs, Navan DJs,
Kilkenny DJs, Ennis DJs, Carlow DJs, Tralee DJs, Newbridge DJs, PortLaoise DJs, Naas DJs, Athlone DJs,
Mullingar DJs,Wexford DJs, Letterkenny DJs, Sligo DJs, Greystones DJs, Clonmel DJs, Leixlip DJs ,
Tullamore DJs, Maynooth DJs, Arklow DJs , Ashbourne DJs
</p>
					</div>
				</div>

                <div class="panel-box-content">
					<div class="panel-heading">
						<span><i class="fa fa-home"></i></span>
						<h5><a href="#">Stag and hen packages agencies</a></h5>
					</div>
					<div class="panel-content">
						<p>Cardiff Stag and hen packages, Swansea Stag and hen packages , Wrexham Stag and hen packages,
Newport Stag and hen packages, Barry Stag and hen packages, Neath Stag and hen packages, Bridgend
Stag and hen packages, Cwmbran Stag and hen packages, Llanelli Stag and hen packages, Merthyr Tydfil
Stag and hen packages, Aberaeron Stag and hen packages, Dundee Stag and hen packages, Aberdeen
Stag and hen packages, Inverness Stag and hen packages, Perth Stag and hen packages, Stirling Stag and
hen packages, Cumbernauld Stag and hen packages, Glenrothes Stag and hen packages, Paisley Stag and
hen packages, Melrose Stag and hen packages, Glasgow Stag and hen packages, Edinburgh Stag and hen
packages, Bath Stag and hen packages, Birmingham Stag and hen packages, Bradford Stag and hen
packages, Brighton & Hove Stag and hen packages, Bristol Stag and hen packages, Cambridge Stag and
hen packages, Canterbury Stag and hen packages , Carlisle Stag and hen packages , Chelmsford Stag and
hen packages, Chester Stag and hen packages, Chichester Stag and hen packages, Coventry Stag and hen
packages, Derby Stag and hen packages, Durham Stag and hen packages , Ely Stag and hen packages,
Exeter Stag and hen packages, Gloucester Stag and hen packages, Hereford Stag and hen packages, 
Kingston-upon-Hull Stag and hen packages, Lancaster Stag and hen packages, Leeds Stag and hen
packages, Leicester Stag and hen packages, Lichfield Stag and hen packages, Lincoln Stag and hen
packages, Liverpool Stag and hen packages, London Stag and hen packages , Manchester Stag and hen
packages , Newcastle-upon-Tyne Stag and hen packages , Norwich Stag and hen packages , Nottingham
Stag and hen packages, Oxford Stag and hen packages, Peterborough Stag and hen packages, Plymouth
Stag and hen packages, Portsmouth Stag and hen packages , Preston Stag and hen packages , Ripon Stag
and hen packages, Salford Stag and hen packages, Salisbury Stag and hen packages, Sheffield Stag and
hen packages, Southampton Stag and hen packages , St Albans Stag and hen packages, Stoke-on-Trent
Stag and hen packages, Sunderland Stag and hen packages, Truro Stag and hen packages, Wakefield Stag
and hen packages , Wells Stag and hen packages, City of Westminster Stag and hen packages,
Winchester Stag and hen packages , Wolverhampton Stag and hen packages , Worcester Stag and hen
packages, York Stag and hen packages, Belfast Stag and hen packages, Derry Stag and hen packages,
Newtownabbey Stag and hen packages, Craigavon Stag and hen packages, Bangor Stag and hen
packages , Castlereagh Stag and hen packages, Lisburn Stag and hen packages, Ballymena Stag and hen
packages, Newtownards Stag and hen packages, Carrickfergus Stag and hen packages, Newry Stag and
hen packages , Coleraine Stag and hen packages, Antrim Stag and hen packages, Omagh Stag and hen
packages, Larne Stag and hen packages, Banbridge Stag and hen packages, Armagh Stag and hen
packages, Dungannon Stag and hen packages , Strabane Stag and hen packages, Limavady Stag and hen
packages, Cookstown Stag and hen packages , Holywood Stag and hen packages, Downpatrick Stag and
hen packages, Ballymoney Stag and hen packages, Ballyclare Stag and hen packages, Comber Stag and
hen packages, Warrenpoint Stag and hen packages, Dromore Stag and hen packages, Crumlin Stag and
hen packages, Randallstown Stag and hen packages, Dublin Stag and hen packages, Cork Stag and hen
packages, Limerick Stag and hen packages, Galway Stag and hen packages, Waterford Stag and hen
packages, Drogheda Stag and hen packages, Swords Stag and hen packages, Dundalk Stag and hen 
packages, Bray Stag and hen packages, Navan Stag and hen packages, Kilkenny Stag and hen packages,
Ennis Stag and hen packages, Carlow Stag and hen packages, Tralee Stag and hen packages, Newbridge
Stag and hen packages, PortLaoise Stag and hen packages, Naas Stag and hen packages, Athlone Stag
and hen packages, Mullingar Stag and hen packages,Wexford Stag and hen packages, Letterkenny Stag
and hen packages, Sligo Stag and hen packages, Greystones Stag and hen packages, Clonmel Stag and
hen packages, Leixlip Stag and hen packages , Tullamore Stag and hen packages, Maynooth Stag and hen
packages, Arklow Stag and hen packages , Ashbourne Stag and hen packages</p>
					</div>
				</div>

                
			</div>
		</div>
	</div>
	
 <!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

<script>

$(document).ready(function(){
    getRecords(0);
    getLocationRecords(0);

    $("#load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getRecords(page);
    });

    $("#location_load_more").on("click",function(e){
        e.preventDefault();
        var page = $(this).attr('data-val');
        getLocationRecords(page);
    });
});

function searchFilter()
{
    $("#resultList").html("");
    getRecords(0);
}

function getRecords(page_num) 
{
    var state_id            = '<?php echo $state_id; ?>';
    var country_id          = '<?php echo $country_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var total_record        = '<?php echo $total_record; ?>';
    var onpage_record       = '<?php echo $onpage_record;?>';
    var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record       = parseInt(total_record) - parseInt(curr_disp);
    var keywords            = $('#agency_name').val();
    
    $.ajax({
        type : 'POST',
        url : baseURL+'AgencyControler/agencyListajaxPaginationData/',
        data:'page='+page_num+'&service_id='+service_id+'&keywords='+keywords+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
        success:function(html) 
        {
            setTimeout(function(){
                $(".loading-div").hide();
                $('#resultList').append(html);

                var new_count = parseInt($('#load_more').attr('data-val')) + parseInt(1);
                $('#load_more').attr('data-val',new_count);

                if(remain_record <= 0)
                {
                  $('#load_more').hide();
                }else{
                  $('#load_more').show();
                }
            },1500);
        }
    });
}


function getLocationRecords(page_num) 
{
    var state_id            = '<?php echo $state_id; ?>';
    var country_id          = '<?php echo $country_id; ?>';
    var city_id             = '<?php echo $city_id; ?>';
    var total_record        = '<?php echo $location_total_record; ?>';
    var onpage_record       = '<?php echo $location_onpage_record;?>';
    var curr_disp           = parseInt(page_num) * parseInt(onpage_record) + parseInt(onpage_record);
    var remain_record       = parseInt(total_record) - parseInt(curr_disp);
	// alert('hi');
    $.ajax({
        type : 'POST',
        url : baseURL+'AgencyControler/locationListajaxPaginationData/',
        data:'page='+page_num+'&service_id='+service_id+'&country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id,
        beforeSend: function(){
          $(".loading-div").show();
        },
        success:function(html) 
        {
            setTimeout(function(){
                $(".loading-div").hide();
                $('#locationResultList').append(html);

                var new_count = parseInt($('#location_load_more').attr('data-val')) + parseInt(1);
                $('#location_load_more').attr('data-val',new_count);

                if(remain_record <= 0)
                {
                  $('#location_load_more').hide();
                }else{
                  $('#location_load_more').show();
                }

            },1500);
        }
    });
}
$("#suggesstion-box").hide();

$("#agency_name").keyup(function(){
    $.ajax({
    type: "POST",
    url: baseURL+'AgencyControler/getAgencyList/',
    data:'keyword='+$(this).val(),
    success: function(data){
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        //$("#agency_name").css("background","#FFF");
    }
    });
});

function selectAgency(name){
    $("#agency_name").val(name);
    $("#suggesstion-box").hide();
}

</script>


</body>      
</html>
