
function setupMenuBar() {
  $("#left-bar").slicknav({
    label: '',
    duration: 1000,
    easingOpen: "easeOutBounce"
  });
} 


jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  

  /* Ocultar cuando el usuario se va del top */

  $(window).scroll(checkscroll);


  function checkscroll(){
    var top = $(window).scrollTop();
    if(top > 5){
      $('.ocultable').fadeOut('slow');
    }else{
      $('.ocultable').fadeIn('slow');
    }
  }

  checkscroll();

  //setupMenuBar();

  /**** Fixed mobile ****/
  var mobile_sidebar = jQuery('.sidebar-menu .treeview.active').clone();
	if (jQuery(document).width() < 768) {
		jQuery('#flowplayer').after(mobile_sidebar);

		jQuery('.treeview.active').removeClass('active');
		/*jQuery('.treeview').click(function() {
			jQuery(this).toggleClass('active');
		});*/

		jQuery('.treeview > a').click(function(event){
			event.preventDefault();
		});
	}


	/*var mobile_title = jQuery('.et_pb_text.et_pb_bg_layout_light.et_pb_text_align_left.details-songs-title.section-title').clone();
	if (jQuery(document).width() < 768) {
		jQuery('.et_pb_text.et_pb_bg_layout_light.et_pb_text_align_left.details-songs-title.section-title').remove();
		jQuery('.songs-and-details-section .et_pb_row .et_pb_column.et_pb_column_1_4:last-child').prepend(mobile_title);
	}*/
	/**** End fix ****/
 

	$("#et_top_search").click(function(){
		$(".et-search-field.desktop").focus(); 
	});  

 
	
	if($(window).width() < 768){ // Solo si es mobile
	

	$('#simple-menu').sidr({
		displace: false
	});
	
	const $sidebar = $('.sidebar-menu');
	$(document).mouseup(function (e) {
		 if (!$sidebar.is(e.target) // if the target of the click isn't the container...
		 && $sidebar.has(e.target).length === 0) // ... nor a descendant of the container
		 {
			 $.sidr('close', 'sidr');
		}
	 });

	}

}); 
   