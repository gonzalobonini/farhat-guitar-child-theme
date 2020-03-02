
jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  

  /* Ocultar cuando el usuario se va del top */

  //setupMenuBar();

  /**** Fixed mobile ****/
 //var mobile_sidebar = jQuery('.sidebar-menu .treeview.active').clone();
	if ($(window).width() < 768) {
		//jQuery('#flowplayer').after(mobile_sidebar);

		jQuery('.treeview.active').removeClass('active');
		/*jQuery('.treeview').click(function() {
			jQuery(this).toggleClass('active');
		});*/

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
	
	//$('#simple-menu').sidr({
	//	displace: true
	//});


	}

}); 
   
(function($) {
	
	// $ Works! You can test it with next line if you like
	// console.log($);
	$.sidebarMenu = function(menu) {
    var animationSpeed = 300;
    
    $(menu).on('click', 'li a', function(e) {
      var $this = $(this);
      var checkElement = $this.next();
  
      if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function() {
          checkElement.removeClass('menu-open');
        });
        checkElement.parent("li").removeClass("active");
      }
  
      //If the menu is not visible
      else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
        //Get the parent menu
        var parent = $this.parents('ul').first();
        //Close all open menus within the parent
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        //Remove the menu-open class from the parent
        ul.removeClass('menu-open');
        //Get the parent li
        var parent_li = $this.parent("li");
  
        //Open the target menu and add the menu-open class
        checkElement.slideDown(animationSpeed, function() {
          //Add the class active to the parent li
          checkElement.addClass('menu-open');
          parent.find('li.active').removeClass('active');
          parent_li.addClass('active');
        });
      }
      //if this isn't a link, prevent the page from being redirected
      if (checkElement.is('.treeview-menu')) {
        e.preventDefault();
      }
    });
  }
  
  $(document).ready(function() {
    $.sidebarMenu($('.sidebar-menu'));
  });
  
})( jQuery );


