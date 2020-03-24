jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  
  
  // Add flags to language switcher
 
  jQuery(".trf").each(function(){
	var title = jQuery(this).attr("title"); 
	jQuery(this).parent().prepend(title);
  });

  var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
  var isSingle = jQuery(".sidebar-menu");
  if( (isMobile || window.matchMedia("(max-width: 767px)").matches ) && isSingle){

	// The viewport is less than 768 pixels wide or is mobile

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
   