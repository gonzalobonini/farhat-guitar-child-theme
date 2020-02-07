jQuery(document).ready(function($) {
	var et_settings_box_jqueryObject = $("p.et_pb_page_settings.et_pb_page_layout_settings");
	var target = document.querySelector('p.et_pb_page_settings.et_pb_page_layout_settings');
	var observer = new MutationObserver(function(mutations) {
		mutations.forEach(function(mutation) {
			console.log("style changed");
        		et_settings_box_jqueryObject.show();
    		});    
	});
	
	if (target) {
		console.log("I'm going to load the observer");
		observer.observe(target, { attributes : true, attributeFilter : ['style'] });	
	}
	
// Solo si el post es nuevo o está en draft y es del tipo banda o lección
	if ( $("#publish").val() === "Publish" && ($("body.post-type-bands") || $("body.post-type-lessons")) ) {
		$("select#et_pb_page_layout").val("et_full_width_page");	
	}
	
	var taxonomyCategory = $("#taxonomy-category");
	if (taxonomyCategory) {
		taxonomyCategory.prepend('<input placeholder="Search Me" id="box" type="text" />');
		$('#box').keyup(function(){
			   var valThis = $(this).val().toLowerCase();
			    searchInChildren($, $('ul.categorychecklist>li>label'), valThis);
			});
	}
	
});

function searchInChildren($, jqueryObjects, valThis) {
		var found = false;
		jqueryObjects.each(function(){
				var next = $(this).next();
				var hasChildren = next.is("ul");
				var foundInChildren = false;
				if (hasChildren) {
					var foundInChildren = searchInChildren($, next.find("li>label"), valThis);
					if (foundInChildren) {
						found = true;
						$(this).parent().show();					
					}
				}
				//I search in current jqueryObject
				var text = $(this).html().toLowerCase();
				if (text.indexOf(valThis) >= 0) {
					found = true;
					$(this).parent().show();
				}else {
					if (!foundInChildren) {
						$(this).parent().hide();
					}
				}
			     });

		return found;
	}
