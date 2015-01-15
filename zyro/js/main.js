
function wb_form_validateForm(formId, values, errors) {
	var form = $("input[name='wb_form_id'][value='" + formId + "']").parent();
	if (!form || form.length === 0 || !errors) return;
	
	form.find("input[name],textarea[name]").css({backgroundColor: ""});
	
	if (errors.required) {
		for (var i = 0; i < errors.required.length; i++) {
			var name = errors.required[i];
			var elem = form.find("input[name='" + name + "'],textarea[name='" + name + "'],select[name='" + name + "']");
			elem.css({backgroundColor: "#ff8c8c"});
		}
	}
	
	if (errors.length) {
		for (var k in values) {
			var elem = form.find("input[name='" + k + "'],textarea[name='" + k + "'],select[name='" + k + "']");
			elem.val(values[k]);
		}
	}
}


// Setup variables
$window = $(window);
$slide = $('.homeSlide');
$slideTall = $('.homeSlideTall');
$slideTall2 = $('.homeSlideTall2');
$body = $('body');

$( function() {
	setTimeout(function() {
		      
		// Init Skrollr
		var s = skrollr.init({
			render: function(data) {

				//Debugging - Log the current scroll position.
				//console.log(data.curTop);
			}
		});

		// Get window size
		winH = $(window).height();

		// Keep minimum height 550
		if(winH <= 550) {
			winH = 550;
		} 

		// Resize our slides
		$slide.height(winH);
		$slideTall.height(winH*2);
		$slideTall2.height(winH*3);

		// Refresh Skrollr after resizing our sections
		s.refresh($('.homeSlide'));
			  
	}, 800);
});
    

