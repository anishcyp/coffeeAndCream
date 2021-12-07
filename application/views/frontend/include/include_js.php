<?php $SocialInfo = FrontSiteInfo(); ?>
<script src="<?php echo FRONT_ASSETS;?>js/all_js.js"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<script>

    $(".seach_filter_block").click(function (e) {
        $(".fiter-block-main").toggleClass("open");
        $("body").toggleClass("overflow-body");
        e.preventDefault();
    });
    
    $(".fiter-block-main .close-icon-main a").click(function (e) {
        $(".fiter-block-main").removeClass("open");
        $("body").removeClass("overflow-body");
        e.preventDefault();
    });
    var baseURL = '<?php echo base_url(); ?>';

    function get_search_blog()
    {
        var search_val = $("#search").val();

        if(search_val!="")
        {
          url = baseURL + 'blog/search/' + search_val +'/';
          window.location.replace(url);
        }
    }
    
    //------------- Keywords suggesstion -------------------//
        
    // $("#suggesstion-box").hide();

    // $("#search").keyup(function(){
    //     $.ajax({
    //         type: "POST",
    //         url: baseURL+'CommonController/get_blog_sugg',
    //         data:'keyword='+$(this).val(),

    //         success: function(data){
    //             $("#suggesstion-box").show();
    //             $("#suggesstion-box").html(data);
    //         }
    //     });
    // });

    // function selectAgencys(name){
    //     $("#search").val(name);
    //     $("#suggesstion-box").hide();
    // }


    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function checkOnlyDigits(e) 
    {
        e = e ? e : window.event;
        var charCode = e.which ? e.which : e.keyCode;
        if (charCode < 48 || charCode > 57) {
            //alert('OOPs! Only digits allowed.');
            return false;
        }
    }

    $("#submit-newsletter").click(function(){
        // e.preventDefault(); 
        newsletter_subscribe("#email_newsletter");
    });

    function newsletter_subscribe(emailid) 
    {

        var email = $(emailid).val();
        if(email==""){
            $.notify({message: 'Please enter email address.'},{ type: 'danger'});
        }else if(validateEmail(email)==false){
            $.notify({message: 'Please enter valid email address.'},{ type: 'danger'});
        }else{
            $.ajax({
               type: "POST",
               url: "<?=URL?>newsletter_subscribe",
               data: {email:email}, // serializes the form's elements.
               success: function(data)
               {
                  if(data=='1'){
                    $.notify({message: 'Newsletter Subscribed Successfully'},{ type: 'success'});
                    // window.location = '<?php echo APP_URL; ?>';
                  }else{
                    $.notify({message: data},{ type: 'danger'});
                  }
                  $(emailid).val("");
               }
            });
        }
    }

    /*LOGIN WITH FACEBOOK*/
    function loginwith_fb()
    {
        FB.login(function(response) {
            if (response.authResponse) {
                getUserData();
            }
        }, {scope: 'email,public_profile', return_scopes: true});  
    }

    function getUserData() 
    {
        var data = '';
        FB.api('/me', { locale: 'en_US', fields: 'name, email, gender,picture' },
        function(response) {
            data = response
            console.log(data);
            $.ajax({
                method: 'POST',
                url: baseURL+'loginwithfb',
                data: data,
                dataType: 'text',
                success: function(result) 
                {
                    setTimeout(function(){
                        if(result=="Success_Signup")
                        {
                            $.notify({message: 'You have successfully registered.'},{ type: 'success'});
                            location.reload();
                        }
                        else if(result=="Success_Login")
                        {
                            $.notify({message: 'You have successfully login.'},{ type: 'success'});
                            location.reload();
                        }
                        else if(result=="Something_Wrong")
                        {
                            $.notify({message: 'Some error occured while login with facebook. Please check your facebook email id and try again.'},{ type: 'danger'});
                            location.reload();
                        }
                        else if(result=="Acc_Suspended")
                        {
                            $.notify({message: 'This account has been temporarily suspended. Contact customer service at <?=$SocialInfo['site_email']?> for more information.'},{ type: 'danger'});
                            location.reload();
                        }
                    },2000);
                }
            });
        });
    }
    
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?=FB_APP_ID?>',
            xfbml      : true,
            version    : 'v2.2'
        });
    };
        
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    /*LOGIN WITH GMAIL*/
    function loginwith_gmail()
    {
        startApp();
    }

    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function(){
            auth2 = gapi.auth2.init({
                client_id: '933613824245-r6n2ac7jqjb4jdp8nn3fstoj4erpotod.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
            });
            attachSignin(document.getElementById('customBtn'));
        });
    };

    function attachSignin(element) {
        
        auth2.attachClickHandler(element, {},
        function(googleUser) {
            var profile = auth2.currentUser.get().getBasicProfile();
            var data  =  'name='+ profile.getName() + '&picture=' + profile.getImageUrl() + '&email=' + profile.getEmail() + '&id=' + profile.getId(); 
            $.ajax({
                method: 'POST',
                url: baseURL+'loginwithgoogle',
                data: data,
                dataType: 'text',
                success: function(result) 
                {
                    setTimeout(function(){
                        if(result=="Success_Signup")
                        {
                            $.notify({message: 'You have successfully registered.'},{ type: 'success'});
                            location.reload();
                        }
                        else if(result=="Success_Login")
                        {
                            $.notify({message: 'You have successfully login.'},{ type: 'success'});
                            location.reload();
                        }
                        else if(result=="Something_Wrong")
                        {
                            $.notify({message: 'Some error occured while login with google. Please check your google email id and try again.'},{ type: 'danger'});
                            location.reload();
                        }
                        else if(result=="Acc_Suspended")
                        {
                            $.notify({message: 'This account has been temporarily suspended. Contact customer service at <?=$SocialInfo['site_email']?> for more information.'},{ type: 'danger'});
                            location.reload();
                        }
                    },2000);
                }
            });
        }, function(error) {
            /*alert(JSON.stringify(error, undefined, 2));*/
        });
    }


    $(document).ready(function(){
        setTimeout(function(){
            <?php 
            $success = $this->session->flashdata('success');
            if(isset($success))
            {
            ?>
                $.notify({message: '<?php echo $success; ?>'},{ type: 'success'});
            <?php 
            } 

            $error = $this->session->flashdata('error');
            if(isset($error))
            {
            ?>
                $.notify({message: "<?php echo $error; ?>"},{ type: 'danger'});
            <?php 
            } 
            ?>
        },1000);
    });

    $(document).ready(function(){
        $("#myContactForm").validate({
            ignore: [],
            errorClass: 'text-danger',
            rules: {
                name:{required : true},
                email:{required : true,email:true},
                phone:{required : true,number:true},
                subject:{required : true},
                message:{required : true},
            },
            messages: {
                name:{required:"Please enter name."},
                email:{required:"Please enter email.",email:"Please enter valid email address."},
                phone:{required:"Please enter phone number.",number:"Please enter valid phone number."},
                subject:{required:"Please enter subject."},
                message:{required:"Please enter message."},
            }, 
        });

        $("#contactus-btn").click(function(e){
            if($("#myContactForm").valid())
            {
                e.preventDefault();
                
                var form = $("#myContactForm")[0];
                var url = $("#myContactForm").attr('action');
                var formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData, // serializes the form's elements.
                    beforeSend: function()
                    {
                        $(".loading").show();
                    },
                    success: function(data)
                    {
                        if(data=='1')
                        {
                            window.location = '<?php echo APP_URL; ?>';
                        }
                        else
                        {
                            $.notify({message: data},{ type: 'danger'});
                            $(".loading").hide();
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    });


    function getStateListbyCountry(country_id, state_id = "")
    {
        var id = country_id;
        $.ajax({
            url: baseURL+'CommonController/getStateByCountry',
            type: "POST",
            data: "id="+id,
            success: function (data) {
                data = JSON.parse(data);
                var list = '<option value="">No state found</option>';
                if( data != 'blank' )
                {
                    list = '<option value="">Select State</option>';
                    $.each( data, function(index, item) {
                      //alert(item.state_id);
                        list += '<option value="'+item.state_id+'">'+item.name+'</option>';
                    });
                }
                $("#state_id").html(list);

                if(state_id!="")
                {
                    $('#state_id option[value='+state_id+']').attr('selected','selected');
                }
            },
        });
    }



    function getCityByState(state_id,city_id="")
    {
      if(state_id!="")
      {
        var id = state_id;
      }
      
      $.ajax({
            url: baseURL+'CommonController/getCityByState',
            type: "POST",
            data: "id="+id,
            success: function (data) {
                data = JSON.parse(data);
                var list = '<option value="">No City found</option>';
                if( data != 'blank' )
                {
                    list = '<option value="">Select City</option>';
                    $.each( data, function(index, item) {
                      // alert(item.city_id);
                        list += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                }
                $("#city_id").html(list);

                if(city_id!="")
                {
                    $('#city_id option[value='+city_id+']').attr('selected','selected');
                }
            },
        });
    }
	
	
		
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $("#scroll").fadeIn(); 
            $("#scroll").addClass("d-block");
        } else { 
            $('#scroll').fadeOut(); 
            $("#scroll").removeClass("d-block");
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
		



</script>