jQuery(document).ready(function(e){e("li.first").removeClass("first"),e("li.last").removeClass("last"),jQuery(".trf").each(function(){var e=jQuery(this).attr("title");jQuery(this).parent().prepend(e)});/iPhone|iPad|iPod|Android/i.test(navigator.userAgent);var i=jQuery(".sidebar-menu").length;if(window.matchMedia("(max-width: 767px)").matches&&i){jQuery(".treeview.active").removeClass("active"),jQuery(".treeview:not(.actionable) > a").click(function(e){e.preventDefault()}),jQuery("#simple-menu").sidr({displace:!1});var t=jQuery(".sidebar-menu");jQuery(document).mouseup(function(e){t.is(e.target)||0!==t.has(e.target).length||jQuery.sidr("close","sidr")})}e("#et_top_search").click(function(){e(".et-search-field.desktop").focus()})}),function(e){e.sidebarMenu=function(i){e(i).on("click","li a",function(i){var t=e(this),n=t.next();if(n.is(".treeview-menu")&&n.is(":visible"))n.slideUp(300,function(){n.removeClass("menu-open")}),n.parent("li").removeClass("active");else if(n.is(".treeview-menu")&&!n.is(":visible")){var s=t.parents("ul").first();s.find("ul:visible").slideUp(300).removeClass("menu-open");var r=t.parent("li");n.slideDown(300,function(){n.addClass("menu-open"),s.find("li.active").removeClass("active"),r.addClass("active")})}n.is(".treeview-menu")&&i.preventDefault()})},e(document).ready(function(){e.sidebarMenu(e(".sidebar-menu"))})}(jQuery);