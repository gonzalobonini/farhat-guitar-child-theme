jQuery(document).ready(function($) {
	
 
  $('li.first').removeClass('first');
  $('li.last').removeClass('last');  

  /* Ocultar cuando el usuario se va del top */

  //setupMenuBar();

  /**** Fixed mobile ****/
  if(window.matchMedia("(max-width: 767px)").matches){
	// The viewport is less than 768 pixels wide
	//if ($(window).width() < 768) {

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


