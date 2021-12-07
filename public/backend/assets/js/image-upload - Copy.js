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
        // Render thumbnail.
        var span = document.createElement('li');
        span.className = "pip";
        span.innerHTML = ['<div class="inner"><img class="thumb" src="', e.target.result,
                          '" title="', escape(theFile.name), '"/><span class="multi_remove_img"><i class="fa fa-trash" aria-hidden="true"></i></span></div>'].join('');
        document.getElementById('list').insertBefore(span, null);

        $(".multi_remove_img").click(function(){
          $(this).closest('.pip').remove();
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
    $(this).closest('.pip').remove();
    var val = $(this).attr('data-delete-value');
    //alert(val);
    $('input[name="image_details_ids[]"][data-val="'+val+'"]').remove();
    var delete_vals = $('#delete_images_value').val();
    if(delete_vals != '') {
        $('#delete_images_value').val(delete_vals+'#,#'+val);
    }
    else {
        $('#delete_images_value').val(val);
    }
});