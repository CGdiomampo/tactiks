jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#logofb').val(imgurl);
 jQuery('#upload_image').val(imgurl);
 tb_remove();
}
 return false;
});
 


 jQuery('#upload_image_button_tw').click(function() {
 formfield = jQuery('#upload_image_tw').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl2 = jQuery('img',htm).attr('src');
 jQuery('#logotw').val(imgurl2);
 jQuery('#upload_image_tw').val(imgurl2);
 tb_remove();
}
 
 return false;
});
 
 
 jQuery('#upload_image_button_fl').click(function() {
 formfield = jQuery('#upload_image_fl').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 window.send_to_editor = function(html) {
 imgurl3 = jQuery('img',html).attr('src');
 jQuery('#logofl').val(imgurl3);
 jQuery('#upload_image_fl').val(imgurl3);
 tb_remove();
}
 
 return false;
});

});