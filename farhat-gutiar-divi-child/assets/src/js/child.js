jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  

  /* Ocultar cuando el usuario se va del top */

  //setupMenuBar();

  /**** Fixed mobile ****/
	if ($(window).width() < 768) {

		jQuery('.treeview.active').removeClass('active');
	

		jQuery('.treeview:not(.actionable) > a').click(function(event){
			event.preventDefault();
		});

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
 

	$("#et_top_search").click(function(){
		$(".et-search-field.desktop").focus(); 
	});  



}); 
   