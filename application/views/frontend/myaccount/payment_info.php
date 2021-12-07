<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head>
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        
         <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">Payment Info</h2>
              <h5>You can add a card on your account easier ways to process your membership.</h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">Payment Info</li>
            </ul>
          </div>
        </div>
      </section>
      
      <section class="diary-list">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Payment info:</h3>
                    <ul>
                        <li>All payment will be done via papal or bank.</li>
                        <li>Add your card to the account to be able to process your membership and receive payments easily.</li>
                        <li>Remember to save before moving to the next step.</li>
                    </ul>
                </div>
            </div>
          </div>
        </section>
      
      <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
               <div class="common-blocks-detail">
                <div class="card-box table-responsive">

                <button class="button button-shadow-2 button-primary button-zakaria d-block ml-auto mb-3 " data-toggle="modal" data-target="#addpopUpmodal">Add Card</button>
                 
                 <table id="datatable-scroller" class="table table-striped  table-colored table-info">
                <thead>
                  <tr>
                    <th>Payment Type</th>
                    <th>Card Details</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <?php  
                if (!empty($payment)) {
                  $tablename = base64_encode('payment');
                  $tableId = base64_encode('id');
                foreach($payment as $payment) {  ?>
                <tbody>
                  <tr>
                    <td><?php echo $payment->payment_type;  ?></td>
                    <?php if($payment->payment_type == "card"){ ?>
                    <td>
                        <b>Card Name    : </b>   <?php echo $payment->card_name; ?>
                        <br>
                        <b>Card Number  : </b>   <?php echo $payment->card_no; ?>
                        <br>
                        <b>Expiry Month : </b>  <?php echo $payment->expiry_month; ?>
                        <br>
                        <b>Expiry Year  : </b>   <?php echo $payment->expiry_year; ?>
                    <?php } else { ?>
                      <td><b>Paypal Id  : </b>   <?php echo $payment->paypal; ?></td>
                    <?php } ?>
                    </td>
                    <td> <?php echo $payment->updated_at; ?></td>
                    <td><button class="btn btn-icon waves-effect btn-success rowEdit" data-id="<?php echo $payment->id; ?>" data-td="<?php echo $tablename; ?>" data-i="<?php echo $tableId; ?>"> <i class="fa fa-edit"></i> </button></td>
                  </tr>
                </tbody>
                <?php }
                }else
                {
                  ?>
                  <td></td>
                  <td colspan='3'><p>Record Not Found</p></td>
                  
                  <?php
                } ?>
              </table>

               </div>

            </div>
          </div>
      </div>


    </div>
    </div>
    <div id="addpopUpmodal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close button button-shadow-2 button-primary button-zakaria" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Card Details</h4>  
                </div>  
                 <form role="form" action="<?= base_url("insert-payment/"); ?>" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">
                <div class="modal-body">  
                     <div class="blocks-information"> 
                      <div class="form-group">
                          <label class="form-label-custom">Select Payment</label>  
                          <select name="select_card" id="select_card" class="form-control">
                               <option value="">Select Payment</option>  
                               <option value="card">Card</option>  
                               <option value="paypal">Paypal</option>  
                          </select> 
                        </div>
                          <br> 
                            <div id="card">
                              <div class="row">

                              <div class="form-group col-md-12">
                            <label class="form-label-custom">Card Name</label>  
                            <input type="text" name="card_name" id="card_name" class="form-control" placeholder="Card Name" />  
                            </div>

                            <div class="form-group col-md-12">
                            <label class="form-label-custom">Card No</label>  
                            <input type="text" name="card_no" id="card_no" class="form-control" placeholder="Card No" />  
                            </div>
                          
                            <div class="form-group col-md-6">
                            <label class="form-label-custom">Expiry Mouth</label>  
                            <input type="text" name="expiry_month" minlength="1" maxlength="2" id="expiry_month" class="form-control" placeholder="Expiry Mouth" />  
                          </div>
                          <div class="form-group col-md-6">
                            <label class="form-label-custom">Expiry Year</label>  
                            <input type="text" name="expiry_year" id="expiry_year" minlength="1" maxlength="4" class="form-control" placeholder="Expiry Year" />  
                            </div>
                          </div>
                          </div>
                            <div id="paypal" >
                              <label class="form-label-custom">Paypal Email</label>  
                            <input type="text" name="paypal_id" id="paypal_id" class="form-control" placeholder="Paypal Email" />  
                            </div>
                            <br>
                          
                           <input type="hidden" id="type" name="type" value="add">
                           <input type="hidden" id="editid" name="editid">
                           
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
<script type="text/javascript">

    $('.modal').on('hidden.bs.modal', function(){
          $(this).find('form')[0].reset();
          $("#type").val('add');
          $("#editid").val();
    });


$(document).ready(function(){
    $('#card').hide();
    $('#paypal').hide();
});
$('#select_card').on('change', function() {
    var status = $("#select_card option:selected").val();
    if(status=="card"){
      $('#card').show();
      $('#paypal').hide(); 
    }
    if(status=="paypal"){
      $('#card').hide();
      $('#paypal').show(); 
    }
});

$('#form-addModels').validate({ // initialize the plugin
         rules:{
          select_card : { required : true },
            card_name :{ required : true },
            card_no :{ required: true,minlength: 16,maxlength:16 },
            expiry_month :{ required : true },
            expiry_year :{ required : true },
            paypal_id:{required : true,email:true},
          },
          messages:{
            select_card : { required : "Select Payment." },
            card_name : { required : "Card name is required." },
            card_no :{ required : "Card no is required.",minlength:"Please enter valid card number.",maxlength: "Please enter valid card number." },
            expiry_month :{ required : "Expiry Mouth is required." },
            expiry_year :{ required : "Expiry Year is required." },
            paypal_id:{required:"Please enter paypal email.",email:"Please enter valid email address."},
          },
      
});


$(document).on("click",".rowEdit",function(){
          
        $('#addpopUpmodal').modal('show');  
        var id = $(this).attr("data-id");      
        var field = $(this).attr("data-i");             
        var table = $(this).attr("data-td"); 
         
        $.ajax(
        {
            url: '<?php echo APP_URL ?>CommonController/getEditRecord',
            dataType: "JSON",
            method:"POST",
            data: {
                "id": id,
                "td": table,
                "i": field,
            },
            success: function (response)
            { 
             
              $("#type").val('edit');
              $("#editid").val(response.id);
              $('#select_card option[value='+response.payment_type+']').attr('selected','selected');
              if(response.payment_type == 'card')
              {
                $('#card').show();
                $('#paypal').hide();
                $('#card_name').val(response.card_name);
                $("#card_no").val(response.card_no);
                $("#expiry_month").val(response.expiry_month);
                $("#expiry_year").val(response.expiry_year);
              }
              else
              {
                $('#card').hide();
                $('#paypal').show();
                $("#paypal_id").val(response.paypal);
              }
          
            }
        });
                  
    });



   
</script>
    </body>
</html>