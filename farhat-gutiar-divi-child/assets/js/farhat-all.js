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


