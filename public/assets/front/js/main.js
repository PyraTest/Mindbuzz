
$(document).ready(function() {
	
	var btnn = $('#BackToTop');

	$(window).scroll(function() {
	if ($(window).scrollTop() > 300) {
	btnn.addClass('show');
	} else {
	btnn.removeClass('show');
	}
	});

	btnn.on('click', function(e) {
	e.preventDefault();
	$('html, body').animate({scrollTop:0}, '300');
	});

		var menu = document.getElementById("main_menu");
		var btnico = document.getElementById("nav-trigger");
	$('#nav-trigger').on('click', function() {
		
		menu.classList.toggle("active");
		btnico.classList.toggle("cansel");
		$(".overlapblackbg").toggleClass('active');
		$(".user-links").toggleClass('active');
		
	});
    $(".overlapblackbg ").on('click', function() {
		
		menu.classList.toggle("active");
		btnico.classList.toggle("cansel");
		$(".overlapblackbg").toggleClass('active');
		$(".user-links").toggleClass('active');

    });
	
	
    function padel_videos() {
        var owl = $(".padel_videos-slider");
        owl.owlCarousel({
            loop: true,
            margin: 30,
            navigation: true,
            items: 3,
            smartSpeed: 1000,
            dots: true,
            autoplay: true,
            center: true,
            autoplayTimeout: 2000,
            dotsEach: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                767: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1920: {
                    items: 3
                }
            }
        });
    }
    padel_videos();

    function member_players() {
        var owl = $(".member_players-slider");
        owl.owlCarousel({
            loop: true,
            margin: 24,
            navigation: true,
            items: 4,
            smartSpeed: 1000,
            dots: true,
            autoplay: true,
            center: true,
            autoplayTimeout: 2000,
            dotsEach: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                767: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1920: {
                    items: 4
                }
            }
        });
    }
    member_players();

    function joint_trainers() {
        var owl = $(".joint_trainers-slider");
        owl.owlCarousel({
            loop: true,
            margin: 24,
            navigation: true,
            items: 4,
            smartSpeed: 1000,
            dots: true,
            autoplay: true,
            center: true,
            autoplayTimeout: 2000,
            dotsEach: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                767: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1920: {
                    items: 4
                }
            }
        });
    }
    joint_trainers();

	function court_slide() {
        var owl = $(".court_images-slider");
        owl.owlCarousel({
            loop: true,
            margin: 0,
            navigation: true,
            items: 1,
            smartSpeed: 10,
            dots: true,
            autoplay: true,
            center: true,
            autoplayTimeout: 2000,
            dotsEach: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                767: {
                    items: 1
                },
                992: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
    }
    court_slide();
   /* ==============================================
  	Dropdown Select
  	=============================================== */ 

	$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
	   var target = $(this).html();

	   //Adds active class to selected item
	   $(this).parents('.dropdown-menu').find('li').removeClass('active');
	   $(this).parent('li').addClass('active');

	   //Displays selected text on dropdown-toggle button
	   $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <img src="images/icons/Icon ionic-md-arrow-dropdown.svg" />');
	});
	
	$('.dropdown-select').on( 'click', '.dropdown-menu li label', function() { 
	   var target = $(this).html();

	   //Adds active class to selected item
	   $(this).parents('.dropdown-menu').find('li').removeClass('active');
	   $(this).parent('li').addClass('active');

	   //Displays selected text on dropdown-toggle button
	   $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <img src="images/icons/Icon ionic-md-arrow-dropdown.svg" />');
	});
	
	

    //very easy 

    $('.thumbnails .small-images  img').on('click', function() {
        $(this).addClass('active').siblings().removeClass("active")

        $('.thumbnails .big-image img').hide().attr('src', $(this).attr('src')).fadeIn(500);

        console.log($(this).attr('src'))
    });


	

	
  $('.color-choose input').on('click', function() {
      var productColor = $(this).attr('data-image');
 
      $('.active').removeClass('active');
      $('.small-images img[data-image = ' + productColor + ']').addClass('active');
      $(this).addClass('active');
      $('.thumbnails .big-image img').hide().attr('src', $('.small-images img[data-image = ' + productColor + ']').attr('src')).fadeIn(500);

        console.log($('.small-images img[data-image = ' + productColor + ']').attr('src'))
  });
 
	
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#myimage').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });	
	
	
	/*====================================
    OTP Validation Code
    ======================================*/	
	let timerOn = true;

	function timer(remaining) {
	  var m = Math.floor(remaining / 60);
	  var s = remaining % 60;

	  m = m < 10 ? '0' + m : m;
	  s = s < 10 ? '0' + s : s;
	  document.getElementById('timer').innerHTML = m + ':' + s;
	  remaining -= 1;

	  if(remaining >= 0 && timerOn) {
		setTimeout(function() {
			timer(remaining);
		}, 1000);
		return;
	  }

	  if(!timerOn) {
		// Do validate stuff here
		return;
	  }

	  // Do timeout stuff here
	  alert('Timeout for otp');
	}

	timer(120);	
	 
	$('.digit-group').find('input').each(function() {
		$(this).attr('maxlength', 1);
		$(this).on('keyup', function(e) {
			var parent = $($(this).parent());

			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + $(this).data('previous'));

				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + $(this).data('next'));

				if(next.length) {
					$(next).select();
				} else {
					if(parent.data('autosubmit')) {
						parent.submit();
					}
				}
			}
		});
	});
	

  	/*====================================
    load More
    ======================================*/	
		size_li = $("#myList li").size();
		x=3;
		$('#myList li:lt('+x+')').show();
		$('#loadMore').click(function () {
			x= (x+5 <= size_li) ? x+5 : size_li;
			$('#myList li:lt('+x+')').show();
		});
		$('#showLess').click(function () {
			x=(x-5<0) ? 3 : x-5;
			$('#myList li').not(':lt('+x+')').hide();
		});
  	/*====================================
    WOW JS
    ======================================*/	

  	/*====================================
    Toggle Show/Hide Password
    ======================================*/
				
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });







function deleteCart() {
  $('#content').parent().before('<div class="completeDelete">تم حذف المنتج بنجاح</div>');
				setTimeout(function() { $(".completeDelete").fadeOut(1500); $('#cart #cart-total').html('1'); }, 100)
}

});


