jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  

  /* Ocultar cuando el usuario se va del top */
  
  //setupMenuBar();

  /**** Fixed mobile ****/
  var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

  // Add flags to language switcher

  jQuery(".trf").each(function(){
	var title = jQuery(this).attr("title"); 
	jQuery(this).parent().prepend(title);
  });

  if(isMobile || window.matchMedia("(max-width: 767px)").matches){
	// The viewport is less than 768 pixels wide
	//if ($(window).width() < 768) {

		jQuery('.treeview.active').removeClass('active');
	

		jQuery('.treeview:not(.actionable) > a').click(function(event){
			event.preventDefault();
		});

		jQuery('#simple-menu').sidr({
			displace: false
		}); 		
		
		var sidebar = jQuery('.sidebar-menu');
		jQuery(document).mouseup(function (e) {
			 if (!sidebar.is(e.target) // if the target of the click isn't the container...
			 && sidebar.has(e.target).length === 0) // ... nor a descendant of the container
			 {
				jQuery.sidr('close', 'sidr');
			}
		 });
	}
 

	$("#et_top_search").click(function(){
		$(".et-search-field.desktop").focus(); 
	});  



}); 
   