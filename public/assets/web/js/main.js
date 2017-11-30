var count =0;

$('.dexel-audio-card').find('.dexel-audio-backpanel .dexel-audio-list').each(function(){

	$(this).find('.jp-jplayer').attr('id', 'jquery_jplayer_' + count);
	$(this).find('.jp-audio').attr('id', 'jp_container_' + count);

	count++;
});


$('.hamburger').on('click', function(){
	if($(this).hasClass('is-open')){
		$(this).parent().find('.sidebar-brand-logo').show();
		$(this).parent().find('.logo-text').show();
		$(this).parent().find('.landing_logo_main').removeClass('logofix');
		
	}else{
		$(this).parent().find('.sidebar-brand-logo').hide();
		$(this).parent().find('.logo-text').hide();
		$(this).parent().find('.landing_logo_main').addClass('logofix');

	}
});

// Character Animation
$('.character a').on('mouseenter', function(){
	$(this).find('.hand-text').animate({
          color: "#FFF",
          width: '100%'
        }, 300 );
	$(this).on('mouseleave', function(){
		$(this).find('.hand-text').animate({
          
          color: "transparent",
          width: '0%'

        }, '500'); 
	});
});

// Navigation/ Menu

 var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  }); 

// Flip Card Dynamic Height

		//var FlipcardHeight = $('.dexel-audio-grp').outerHeight(true);
		//$('.dexel-flipcard').css('height', FlipcardHeight );

// Animations

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};

// Go to the TOP of the Page
	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	
	};

	var counter = function() {
		$('.js-counter').countTo({
			 formatter: function (value, options) {
	      return value.toFixed(options.decimals);
	    },
		});
	};

	var counterWayPoint = function() {
		if ($('#dexel-counter').length > 0 ) {
			$('#dexel-counter').waypoint( function( direction ) {
										
				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( counter , 400);					
					$(this.element).addClass('animated');
				}
			} , { offset: '90%' } );
		}
	};

// Flip Card
	var flipCard = function(){

			$('.dexel-flipper').on('click', function(){
				if($(this).parents('.dexel-flipcard').hasClass('flipped')){
					$(this).parents('.dexel-flipcard').removeClass('flipped');
					
				}
				else{
					var parent_div = $(this).parents('.dexel-flipcard');
					parent_div.addClass('flipped');
					if(window.is_play == 'no')
					{
						parent_div.find('.play_audio:first').click();
					}
				}
				
			});
	};

	
	$(function(){
		contentWayPoint();
		goToTop();
		flipCard();
		counterWayPoint();
	});


$(document).ajaxStart(function() {
	$('#site_loding').show();
});
$(document).ajaxError(function(event, xhr, settings, thrownError) {
	$('#site_error').show();
});
$(document).ajaxComplete(function(event, xhr, settings) {
	$('#site_loding').hide();
});
$(document).on('click', '#close_site_error', function(event) {
	event.preventDefault();
	$('#site_error').hide();
});
window.onbeforeunload = function(e) {
    $('#site_loding').show();
};

$('body').on('click', '.close-popup-message', function(event) {
	event.preventDefault();
	$('.message-popup').hide();
});
$('body').on('click', '.home-subscribe-cancel', function(event) {
	event.preventDefault();
	$('.message-popup').hide();
});

$('#subscribe').click(function(event) {
	$.ajax({
		url: base_url+'/subscribe/'+$(this).attr('action'),
		type: 'POST',
		data: {'_token': csrf_token},
	})
	.done(function(data) {
		$('#subscribe').attr('action',data.action.toLowerCase());
		$('#subscribe').text(data.action);
	})
	.fail(function() {
		//console.log("error");
	})
	.always(function() {
		//console.log("complete");
	});
	
});
$('#subscribe-login').click(function(event) {
	/* Act on the event */
	if(!$('#subscribe-popup-home').length)
	{
		$('#subscribe-popup').show();
	}
	else
	{
		$('#email').focus();
	}
});
$('body').on('click', '#subscribe-popup-form-btn', function(event) {
	/* Act on the event */
	$.ajax({
		url: base_url+'/subscribe',
		type: 'POST',
		dataType: 'html',
		data: $('#subscribe-popup-form').serialize(),
	})
	.done(function(data) {
		if($('#subscribe-popup-home').length)
		{
			$('#subscribe-popup-home').html(data);
		}
		else
		{
			$('#subscribe-popup-div').html(data);	
		}

	})
	.fail(function() {
		
	})
	.always(function() {
		
	});
});
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function showsubscribe(){
	if($('#subscribe-login').length)
	{
		if(getCookie('subscribe')== 'yes')
		{
			//do nothing
		}
		else
		{
			$('#subscribe-login').click();
			setCookie('subscribe', 'yes', 5);
		}
	}
}
//10 sec
setTimeout(showsubscribe, 10000);