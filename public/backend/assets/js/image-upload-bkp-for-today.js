var drop = $("input");
drop.on('dragenter', function (e) {
  $(".drop").css({
    "border": "4px dashed #09f",
    "background": "rgba(0, 153, 255, .05)"
  });
  $(".cont").css({
    "color": "#09f"
  });
}).on('dragleave dragend mouseout drop', function (e) {
  $(".drop").css({
    "border": "3px dashed #DADFE3",
    "background": "transparent"
  });
  $(".cont").css({
    "color": "#8E99A5"
  });
});



function handleFileSelect(evt) {

  var files = evt.target.files; // FileList object

  // Loop through the FileList and render image files as thumbnails.
  for (var i = 0, f; f = files[i]; i++) {

    // Only process image files.
    if (!f.type.match('image.*')) {
      continue;
    }

    var reader = new FileReader();

    // Closure to capture the file information.
    reader.onload = (function(theFile) {
      return function(e) {
        

        var di=(escape(theFile.name)).toString().replace('.', '_');
        // Render thumbnail.
        var span = document.createElement('li');
        span.className = "pip";
        span.innerHTML = ['<div class="inner"><img class="thumb" src="', e.target.result,
                          '" title="', escape(theFile.name), '"/><input type="checkbox" name="default_img" id="default_img_'+di+'" value="'+escape(theFile.name)+'" class="form-control default-img-radio"><span class="multi_remove_img" data-del="'+escape(theFile.name)+'" id="del_'+di+'"><i class="fa fa-trash" aria-hidden="true"></i></span></div>'].join('');
        
        var uploaded_img_val = $('#hidden_fi').val();
        if(uploaded_img_val=="")
        {
          $('#hidden_fi').val(escape(theFile.name));
        }
        else
        {
          $('#hidden_fi').val(uploaded_img_val+","+escape(theFile.name));
        }
        chk_img_val();
        document.getElementById('list').insertBefore(span, null);

        $(".multi_remove_img").click(function(){
          var temp = $(this).data('del');
          var uploaded_img_val = $('#hidden_fi').val();

          console.log("before "+uploaded_img_val);
          var strArray = uploaded_img_val.split(',');
          for (var i = 0; i < strArray.length; i++) {
              if (strArray[i] === temp) {
                  strArray.splice(i, 1);
              }
          }
          $('#hidden_fi').val(strArray);
          console.log("after"+strArray);
          $(this).closest('.pip').remove();
           chk_img_val();
        });
         $('input.default-img-radio').on('change', function() {
          var di_val = $(this).val();
          var d_val=di_val.toString().replace('.', '_');
          $('input.default-img-radio').not(this).prop('checked', false);  
          $("#del_"+d_val).css('display','none');
          $(".multi_remove_img").not("#del_"+d_val).css('display','block');
          $("#default_images_value").val(di_val);
          if($(this).prop("checked") == true)
          {
            $("#del_"+d_val).css('display','none');
          }
          else
          {
            $("#default_images_value").val('');
            $("#del_"+d_val).css('display','block');
          }
          chk_def_val();
      });
       
      };
    })(f);

    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
  }
}

$('#files').change(handleFileSelect);

$(".multi_remove_edit_img").click(function()
{
  //this code used for remove already uploaded images which one removed by user at edit time in db
  var val = $(this).attr('data-delete-value');
  $('input[name="image_details_ids[]"][data-val="'+val+'"]').remove();
  var delete_vals = $('#delete_images_value').val();
  if(delete_vals != '') 
  {
    $('#delete_images_value').val(delete_vals+'#,#'+val);
  }
  else 
  {
    $('#delete_images_value').val(val);
  }

  //this code used for edit time validation for set default image and upload atleast one image
  var temp = $(this).data('del');

  var uploaded_img_val = $('#hidden_fi').val();

  var strArray = uploaded_img_val.split(',');
  for (var i = 0; i < strArray.length; i++) {

      if (strArray[i] === temp) 
      {
        strArray.splice(i, 1);
      }
  }
  $('#hidden_fi').val(strArray);

  $(this).closest('.pip').remove();
  chk_img_val();
});

  $('input.default-img-radio').on('change', function() {
      var di_val = $(this).val();
     
      var d_val=di_val.toString().replace('.', '_');
     
      $('input.default-img-radio').not(this).prop('checked', false);  
      $("#del_"+d_val).css('display','none');

      $(".multi_remove_img").not("#del_"+d_val).css('display','block');
      $("#default_images_value").val(di_val);

      if($(this).prop("checked") == true)
      {
        $("#del_"+d_val).css('display','none');
      }
      else
      {
        $("#default_images_value").val('');
        $("#del_"+d_val).css('display','block');
      }
      chk_def_val();
  });
