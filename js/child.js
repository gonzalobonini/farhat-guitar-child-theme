function setupMenuBar() {
  $("#left-bar").slicknav({
    label: '',
    duration: 1000,
    easingOpen: "easeOutBounce"
  });
}


function setupFlowplayer($) {
	flowplayer.conf = {
	  //speeds: [0.25, 0.5, 1, 1.5, 2], // default
	  speeds: [0.5, 0.6, 0.7, 0.8, 0.9, 1],
	  splash: true,
	  embed: false,
	  rtmp: "rtmp://stream.blacktrash.org/cfx/st"
	};
	 
	flowplayer(function (api, root) {
	  var speedbuttons = $(".buttons span", root);
	 
	  api.bind("load", function (e, api) {
	    // remove speed buttons if playback rate changes are not available
	    if (api.engine == "flash" || !flowplayer.support.inlineVideo) {
	      $(".buttons", root).remove();
	    }
	 
	  }).bind("speed", function (e, api, rate) {
	    // mark the current speed button as active
	    var i;
	 
	    speedbuttons.removeClass("active");
	 
	    for (i = 0; i < api.conf.speeds.length; i = i + 1) {
	      if (api.conf.speeds[i] == rate) {
		speedbuttons.eq(i).addClass("active");
		break;
	      }
	    }
	  });
	 
	  // bind speed() call to click on buttons
	  speedbuttons.click(function () {
	    if (!$(this).hasClass("active")) {
	      var buttonindex = speedbuttons.index(this);
	 
	      if (flowplayer.support.seekable) {
		api.speed(api.conf.speeds[buttonindex]);
	      } else {
		// workaround for iPad and friends
		api.pause(function (e, api) {
		  api.speed(api.conf.speeds[buttonindex], function (e, api) {
		    api.resume();
		  });
		});
	      }
	    }
	  });
	});
	console.log("FlowPlayer configuration Finished");
}

jQuery(document).ready(function($) {
	var backgroundImage = '';
	jQuery('.et_pb_video_overlay').each(function(num,val){
		backgroundImage = (jQuery(this).css('background-image'))
	});
	var sources = [];
	$('video source').each(function(num,val) {
		var src = $(this).attr('src');
		if (src.indexOf('webm')>0) {
			sources['webm'] = src;
		}else if (src.indexOf('mp4')>0) {
			sources['mp4'] = src;
		}else if (src.indexOf('ogv')>0) {
			sources['ogv'] = src;		
		}
	});

	var webm = (sources['webm']) ?   '<source type="video/webm" src="'+sources['webm']+'">' : '';
	var mp4 = (sources['mp4']) ?   '<source type="video/mp4" src="'+sources['mp4']+'">' : '' ;
	var ogv = (sources['ogv']) ?   '<source type="video/ogv" src="'+sources['ogv']+'">' : '' ;

	var videoHTML = 
'<!-- the player -->' +
   '<div id="flowplayer" class="flowplayer functional" data-swf="flowplayer.swf" data-ratio="0.4167">'+
    '  <video>'+
     	 webm+
	 ogv+	
	mp4+
     ' </video>'+
	'<div class="buttons">'+
      '<span>0.5x</span>'+
      '<span>0.6x</span>'+
      '<span>0.7x</span>'+
      '<span>0.8x</span>'+
	'<span>0.9x</span>	'+
      '<span class="active">1x</span>'+
   '</div>'+
   '</div>';
	var video = $('.et_pb_video.lesson-video');
	if (video) {
		video.after(videoHTML);
		$('#flowplayer').css('background-image', backgroundImage);
		$('#flowplayer').css('z-index', 9);
		$('#flowplayer').css('background-size', 'cover');
		setupFlowplayer($);
  	}
	video.remove();

	$ = jQuery;
	var tabs = $('.tab-container');
	$('.video-section').before(tabs);

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
		jQuery('.treeview').click(function() {
			jQuery(this).toggleClass('active');
		});

		jQuery('.treeview > a').click(function(event){
			event.preventDefault();
		});
	}
	/**** End fix ****/

});



