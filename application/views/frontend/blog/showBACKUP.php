<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$dis_cate_slug = "";
if(isset($cate_slug))
{
  $dis_cate_slug = $cate_slug; 
}

$dis_search_keyword = "";
if(isset($search_keyword))
{
  $dis_search_keyword = $search_keyword; 
}
?>

<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
<head>
    <link rel="canonical" href="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
    <meta name="description" content="">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />

    <meta property="og:site_name" content="Coffee & Strippers" />
    <meta property="og:image" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:secure_url" content="https://www.stripperpartybus.com/public/front/images/logo/logo.png" />
    <meta property="og:image:width" content="1457" />
    <meta property="og:image:height" content="461" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="Logo or Banner Image" />

    <meta name="twitter:title" content="Meta Title" />
    <meta name="twitter:description" content="Meta Description" />

    <?php $this->load->view(FRONTEND."include/include_css"); ?>
</head>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph":[{
  "@type": "Organization",
  "name": "Coffee & Strippers",
  "alternateName": "Strippers | Strippers UK | Male Strippers | Female Strippers",
  "url": "https://www.stripperpartybus.com/",
  "logo": "https://www.stripperpartybus.com/public/front/images/logo/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "07707012858",
    "contactType": "customer service",
    "areaServed": ["IE","GB"],
    "availableLanguage": ["en","Irish"]
  },
  "sameAs": [
    "https://www.facebook.com/",
    "https://twitter.com/",
    "https://www.youtube.com/",
    "https://www.instagram.com/"
  ]
},
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Coffee & Strippers",
  "url": "https://www.stripperpartybus.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.stripperpartybus.com/search?{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
]}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "People in Belfast ask if they can choose the uniform they want the stripper or a kissogram to wear",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "As a client, you can choose the costume you want the stripper to wear. Once you click on their profile and enter your location, you will see some of the outfits the stripper wears; if you want a different one, you let the stripper know. Usually, the price will be higher as compared to when they come with their own outfit."
      }
    },
    {
      "@type": "Question",
      "name": "People in Manchester wanted to know some of the services our escorts offer.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our escorts offer the following adult entertainment: sex toys, strap on, watersports, girlfriend experience, lap dancing, role play, shared showers, tie and tease, cross-dressing, foot fetish, nipple play, porn star experience, massage, showers, and bathtub games, and uniforms."
      }
    },
    {
      "@type": "Question",
      "name": "Corporate party organizers in Londonderry wanted to know if the drag queen can do impersonations.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, they can impersonate anyone you want them to. They also perform lip-syncing, international comedy, comedy sketches, live singing, mainstream comedy, cabaret dance performances, and much more."
      }
    },
    {
      "@type": "Question",
      "name": "If I book an escort in Glasgow and end up canceling, will I charged for withdrawing?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "If you had reserved an escort and you end up canceling, you will not get a refund of your deposit unless the entertainer approves. Contact us if you want to cancel a booking."
      }
    },
    {
      "@type": "Question",
      "name": "Stags in Dublin ask if they can handcuff the stripper.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, you can handcuff the stripper if you are looking for something hilarious and naughty? The stripper can also cuff himself to the stage to make sure they are stuck together the whole night."
      }
    },
    {
      "@type": "Question",
      "name": "I want to book a topless waitress in Birmingham; how do I go about the payment?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Once you have booked a topless waitress or any other entertainer from our website, you will be required to pay a deposit to reserve the stripper. The rest of the amount can be given to the stripper before or after a performance. You can also encourage the strippers to do more by tipping them well."
      }
    },
    {
      "@type": "Question",
      "name": "A few football fans in London asked if the stripper can wear a football top?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "How fun it is when a stripper costume is a perfect match to what you love. Our strippers will wear a football top if that is what you want. You, as the client, have the power to choose the outfit you want them to wear."
      }
    },
    {
      "@type": "Question",
      "name": "How can I reserve an art model online in Aberdeen?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Go to the cofffee’n cream website, click on the profile of the model you want to book, and get in touch with them directly and they will tell when they are available, what they do and how much they will charge you. Once you have agreed on everything, you can go ahead and place your booking on the website."
      }
    },
    {
      "@type": "Question",
      "name": "Is it true that male strippers in Cardiff use a pump to get a professional semi to do a magic strip tease dance?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our strippers are professionals who know how to tease in such a naughty manner that leaves you wanting more. However, how far they can go is entirely up to you. If you wish for them to use a pump to tease the stag, they will do just that."
      }
    },
    {
      "@type": "Question",
      "name": "I’m from Dundalk, and I want my stripper to dance to the full Monty music?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Monty music is at the heart of many Britons. And, ooh, our male strippers are unable to resist dancing to it."
      }
    },
    {
      "@type": "Question",
      "name": "Ladies in Essex ask if they can lick chocolate off the kissograms body.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "A little mischief and fun are what spices up the night more. And naughtiness includes licking off that chocolate and cream off a stripper’s body. You can be sure to both enjoy it."
      }
    },
    {
      "@type": "Question",
      "name": "Can strippers in Newcastle wimp us?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "No. Why? Our strippers are well qualified and trained. Aside from that, they are very confident, and they come ready to blow your mind. They will not shy away from doing what you want them to do."
      }
    },
    {
      "@type": "Question",
      "name": "Can roly-poly strippers in Galway get the bride to eat a banana?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "A stripper will tease you into eating a banana. They will also make sure you eat it in such a playful way that will leave the guests bursting with laughter and happiness."
      }
    },
    {
      "@type": "Question",
      "name": "Can buff butlers in wales play bride and groom games with us?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, the buff butler will play any games with the bridal party and do a lot more than that to spice up the party."
      }
    },
    {
      "@type": "Question",
      "name": "I'm in Donegal, but stripper I want to book is in Dundalk; What happens then?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our strippers will always travel to where the party is. Being a nationwide company means we avail you the strippers you want regardless of where you are. If the stripper cannot make it, you could always book them for a virtual strip and enjoy it from the comfort of your home."
      }
    },
    {
      "@type": "Question",
      "name": "The guys and I are having a divorce party in Edinburgh, and we want to party and party until everyone is passed out. Will a stripper be able to keep up with the energy? How long can she last?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Mostly, our girls can do three hours of entertainment per session. If the girl is tired, she can leave if her time is up. However, if she wants to give another session, it is up to her. Better still, if you are partying the whole night, why not hire 2 or 3 strippers to keep up?"
      }
    },
    {
      "@type": "Question",
      "name": "Newtownabbey people were curious to know if an escort can give them a massage?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We have so many escorts, including massage escorts, porn star escorts, dating experience escorts, girlfriend experience escorts, bisexual escorts, non-contact escorts, and many more. Talk to your escort before booking so you can know some of the services they offer."
      }
    },
    {
      "@type": "Question",
      "name": "Do strippers in Belfast do a full strip dance?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Some strippers are comfortable doing a full strip dance, but others are not. Once you click on the stripper's profile, you will see the services they offer, and if they fit what you want, you can ahead and book them."
      }
    },
    {
      "@type": "Question",
      "name": "People in Swansea wanted to know if a buff butler can give them a cocktail class.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our buff butlers are professionals when it comes to preparing cocktails. If you want, they are more than happy to give you and the girls a cocktail class."
      }
    },
    {
      "@type": "Question",
      "name": "Aberdeen people were curious to know if a topless waitress can entertain the guys.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "YES. When you book a topless waitress, they serve, entertain, play party games and offer more than to you."
      }
    },
    {
      "@type": "Question",
      "name": "I want to book a Model for an art class in Bangor; how do I know the one I book knows how to pose?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our art models have been trained to maintain the same poses for long periods and not shy away from the crowd's intense staring."
      }
    },
    {
      "@type": "Question",
      "name": "Do stripers in Antrim do a disabled performance?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Some of our strippers can do a sexy disabled performance. Click on their profile to see if they offer that in their services."
      }
    },
    {
      "@type": "Question",
      "name": "If I hire a stripper in Omagh, can I pick the song I want them to dance to?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Normally, our strippers come prepared with all the necessary tools to spice up the night. However, if you want them to do a song you like, that is what they will do."
      }
    },
    {
      "@type": "Question",
      "name": "Many people in Liverpool wanted to know if we offer stag and hen packages.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We have some of the craziest hen and stag packages you will find anywhere."
      }
    },
    {
      "@type": "Question",
      "name": "We are having a birthday party at a local club in Oxford? Will the kissogram come to the club?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Whether you have your party in a club, home, zoom, or any other venue, our kissograms will come to you."
      }
    },
    {
      "@type": "Question",
      "name": "Several people in Antrim wanted to know some of the services bunny girls will offer.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "A bunny girl will greet your guests at the door, take their coats, serve them drinks, and mingle among them while entertaining them."
      }
    },
    {
      "@type": "Question",
      "name": "People in Lisburn want to know if a stripper will wear a conic mask.",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "A sexy mask can complement a stripper's outfit greatly. If you want the stripper to wear the mask, they will; if not, they will not."
      }
    },
    {
      "@type": "Question",
      "name": "Can I get a stripper in Belfast to perform on a party bus?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our strippers perform on party buses all the time. Please indicate that your event will be on a party bus when booking so that our stripper can arrange to get there."
      }
    }
  ]
}
</script>

<body class="">    
<?php $this->load->view(FRONTEND."include/menu"); ?>
  
<section class="breadcrumbs-custom">
    <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="banner-img">
        <div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/banner-img.jpg" alt="parallax material"></div>
        <div class="breadcrumbs-custom-body parallax-content context-dark">
            <div class="container">
                <div class="directory-listing-form">
                    <h1><?=$pageTitle;?></h1>
                    <div class="directory-listings-search">
                        <form id="service_search" class="service_search" method="post" action="javascript:void(0);">
                            <div class="row">
                                <div class="col-lg-5 col-md-12">
                                    <div class="form-group">
                                        <label><i class="fa fa-keyboard-o" aria-hidden="true"></i></label>
                                        <input type="text" id="keywords" name="keywords" placeholder="What are you looking for?" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-location-arrow" aria-hidden="true"></i></label>
                                        <input type="text" id="keyword_location" name="keyword_location" placeholder="Location" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="directory-search-btn">
                                <button type="button" class="btn btn-primary">Geolocation <i class="fad fa-location"></i></button>
                                <button type="button" class="btn btn-primary seach_filter_block">Filter <i class="fal fa-filter"></i></button>
                                <button type="button" class="btn btn-primary" onclick="searchFilter();">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-custom-footer">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="<?=base_url();?>">Home</a></li>
                <li class="active"><?= $pageTitle;?></li>
            </ul>
        </div>
    </div>
</section>

<section class="section section-xl bg-default text-md-left">
      <div class="container">
        <div class="row row-50 row-md-60">
          <div class="col-lg-8 col-xl-9">
            <div class="inset-xl-right-100">
              <div class="row row-50 row-md-60 row-lg-80">
           
                <div class="col-12">
                  <div class="row row-30">
                    <div class="col-sm-6">
                      <!-- Post Classic-->
                      <article class="post post-classic box-md"><a class="post-classic-figure" href="blog-post.html"><img src="<?= base_url().UPLOAD_DIR.BLOG_IMG.'download_(3)1.jpg' ?>" alt="" width="370" height="239"></a>
                        <div class="post-classic-content">
                          <div class="post-classic-time">
                            <time datetime="2020-09-08">August 9, 2020</time>
                          </div>
                          <h5 class="post-classic-title"><a href="blog-post.html">Breakfast Potatoes (Crispy + Tender)</a></h5>
                          <p class="post-classic-text">Est velox nuptia, cesaris. Est dexter turpis, cesaris. Cum nixus persuadere, omnes fluctuies promissio flavum</p>
                        </div>
                      </article>
                    </div>
                    <div class="col-sm-6">
                      <!-- Post Classic-->
                      <article class="post post-classic box-md"><a class="post-classic-figure" href="blog-post.html"><img src="<?= base_url().UPLOAD_DIR.BLOG_IMG.'download_(3)1.jpg' ?>" alt="" width="370" height="239"></a>
                        <div class="post-classic-content">
                          <div class="post-classic-time">
                            <time datetime="2020-09-08">August 9, 2020</time>
                          </div>
                          <h5 class="post-classic-title"><a href="blog-post.html">How to Make Your Breakfast Easy and Yummy</a></h5>
                          <p class="post-classic-text">Sensorems peregrinatione in rugensis civitas! Ubi est bi-color byssus? Velox, teres ollas recte aperto de castus</p>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
             
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-xl-3">
            <div class="aside row row-30 row-md-50 justify-content-md-between">
              <div class="aside-item col-sm-6 col-lg-12">
                <h6 class="aside-title">Latest Posts</h6>
                <div class="row row-20 row-lg-30 gutters-10">
                  <div class="col-6 col-lg-12">
                    <!-- Post Minimal-->
                    <article class="post post-minimal">
                      <div class="unit unit-spacing-sm flex-column flex-lg-row align-items-lg-center">
                        <div class="unit-left"><a class="post-minimal-figure" href="blog-post.html"><img src="<?= base_url().UPLOAD_DIR.BLOG_IMG.'download_(3)1.jpg' ?>" alt="" width="106" height="104"></a></div>
                        <div class="unit-body">
                          <p class="post-minimal-title"><a href="blog-post.html">How to Make Your Breakfast Yummy</a></p>
                          <div class="post-minimal-time">
                            <time datetime="2020-03-15">March 15, 2020</time>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                  <div class="col-6 col-lg-12">
                    <!-- Post Minimal-->
                    <article class="post post-minimal">
                      <div class="unit unit-spacing-sm flex-column flex-lg-row align-items-lg-center">
                        <div class="unit-left"><a class="post-minimal-figure" href="blog-post.html"><img src="<?= base_url().UPLOAD_DIR.BLOG_IMG.'download_(3)1.jpg' ?>" alt="" width="106" height="104"></a></div>
                        <div class="unit-body">
                          <p class="post-minimal-title"><a href="blog-post.html">Recharge, Refresh, Exist</a></p>
                          <div class="post-minimal-time">
                            <time datetime="2020-03-15">March 15, 2020</time>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
               <div class="aside-item col-sm-6 col-md-5 col-lg-12">
                <h6 class="aside-title">Categories</h6>
                <ul class="list-categories">
                  <li><a href="#">All</a><span class="list-categories-number">(18)</span></li>
                  <li><a href="#">News</a><span class="list-categories-number">(9)</span></li>
                  <li><a href="#">Health</a><span class="list-categories-number">(5)</span></li>
                  <li><a href="#">Vegan</a><span class="list-categories-number">(8)</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>



<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="<?php echo COMMON; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo COMMON; ?>dataTables.bootstrap.js"></script>

</body>      
</html>

