$(document).ready(function(){

  //fix header to top on scroll
  $(window).scroll(function(){
    if($(this).scrollTop() > 101){
      $('.header').addClass('sticky');
      $('.navigation').addClass('scroll');
    } else if($(this).scrollTop() < 1) {
      $('.header').removeClass('sticky');
      $('.navigation').removeClass('scroll');
    }
  });


  //nav-btn animation
  $('.nav-btn').click(function(){
    $('.nav-btn').toggleClass('open');
    //navigation animation
    $('.navigation').toggleClass('nav-open');
    $('body, html').toggleClass('no-scroll');
  });

  /** Dropdown on hover */
  $(".nav-link.dropdown-toggle").hover( function () {
      // Open up the dropdown
      $(this).removeAttr('data-toggle'); // remove the data-toggle attribute so we can click and follow link
      $(this).parent().addClass('show'); // add the class show to the li parent
      $(this).next().addClass('show'); // add the class show to the dropdown div sibling
  }, function () {
      // on mouseout check to see if hovering over the dropdown or the link still
      var isDropdownHovered = $(this).next().filter(":hover").length; // check the dropdown for hover - returns true of false
      var isThisHovered = $(this).filter(":hover").length;  // check the top level item for hover
      if(isDropdownHovered || isThisHovered) {
          // still hovering over the link or the dropdown
      } else {
          // no longer hovering over either - lets remove the 'show' classes
          $(this).attr('data-toggle', 'dropdown'); // put back the data-toggle attr
          $(this).parent().removeClass('show');
          $(this).next().removeClass('show');
      }
  }); //end Dropdown hover

  // Check the dropdown on hover
  $(".dropdown-menu").hover( function () {
  }, function() {
      var isDropdownHovered = $(this).prev().filter(":hover").length; // check the dropdown for hover - returns true of false
      var isThisHovered= $(this).filter(":hover").length;  // check the top level item for hover
      if(isDropdownHovered || isThisHovered) {
          // do nothing - hovering over the dropdown of the top level link
      } else {
          // get rid of the classes showing it
          $(this).parent().removeClass('show');
          $(this).removeClass('show');
      }
  }); //end check dropdown

  //alert box & promotion lightbox Functions
  function displayAlert(){
    $('.news-box').addClass('show-alert');
  }
  function closeAlert(){
    $('.news-box').removeClass('show-alert');
  }
  function displayMask(){
    $('.window-mask').addClass('show');
    $('html, body').css('overflow','hidden');
  }
  function displayPromo(){
    $('.promotion-container').addClass('visible');
  }
  function closePromo(){
    $('.window-mask').removeClass('show');
    $('.promotion-container').removeClass('visible');
    $('html, body').css('overflow', 'auto');
  }

  if(window.location.pathname === '/'){
    if($('.news-box').length){
      setTimeout(function(){
      displayAlert();
      }, 2000);
      $('.news-box .alert-close').click(function(){
        closeAlert();
      });
    }
    if($('.window-mask').length){
      setTimeout(function(){
        displayMask();
      },3000);
      setTimeout(function(){
        displayPromo();
      },3500);

      $('.close').click(function(){
        closePromo();
      });
      $('.window-mask').click(function(){
        closePromo();
      });
      $(document).keyup(function(e){
        if(e.keyCode === 27){
          closePromo();
        }
      });
    }
  } //end alertbox + lightbox functions

  if(window.location.pathname === '/amenities/parks-and-trails/'){
    $('.map-point').hover(function(){
			var pointName = $(this).attr('id');
			$('.' + pointName + '-detail').show();
		},
		function(){
			var pointName = $(this).attr('id');
			$('.' + pointName + '-detail').hide();
		});
  }

  // Homepage FadeIn / FadeOut
  $('.home-image').click(function(){
    var e = $(this),
      t = e.attr('data-link');

    if(e.hasClass('home-image-left')) {
      $('.home-image-left').addClass('animate');
      $('.home-image-right').addClass('hide');
    } else if(e.hasClass('home-image-right')) {
      $('.home-image-right').addClass('animate');
      $('.home-image-left').addClass('hide');
    }
    $('.home-overlay').addClass('animate'); setTimeout(function(){ window.location.href = t; }, 1250);
  });

  // Flip Card Functions
  var flipFrontH = $('.flipper > .front').height();
  $('.flipper').height(flipFrontH);
  $('.flipper .back').height(flipFrontH).width(flipFrontH);

  $(window).resize(function(){
    var flipFrontH = $('.flipper > .front').height();
    $('.flipper').height(flipFrontH);
    $('.flipper .back').height(flipFrontH).width(flipFrontH);
  });

  $('.flip-container').click(function(){
    $('.flip-container.hover').not(this).removeClass('hover');
    $(this).toggleClass('hover');
  });

  // Accordion
  $('.btn-link').click(function(){
    $(this).toggleClass('open');
    $('.btn-link').not(this).removeClass('open');
  });

  //form placeholder effects
  $('.form-control').focus(function(){
    $(this).siblings('.form-label').addClass('key');
  });
  $('.form-control').blur(function(){
    if($(this).val() === ''){
      $(this).siblings('.form-label').removeClass('key');
    }
  });
});

if(window.location.pathname === '/about-reunion/' || window.location.pathname === '/district-information/'){
  setTimeout(function(){
    $('.page-overlay').addClass('hide');
  }, 750);
}

//email to script
$('input.mailto_check').change(function(){
	var emailTo = [];
	var builder = [];
	jQuery.each($('input.mailto_check:checked'), function(){
    emailTo.push($(this).attr('data-mailto'));
		builder.push($(this).attr('data-builder'));
	});
	$('#mailto').val(emailTo.join(', '));
	$('#builder').val(builder.join(', '));
});

//change ph# to required if realtor is yes
$('.realtor').change(function(){
  if(this.checked){
    $('.phone_num').prop('required',true);
    $('.phone-label').append('<span class="req">*</span>');
  } else {
    $('.phone_num').prop('required',false);
    $('.phone-label > .req').remove();
  }
});

//$('select.price:first-child').css('display','none');
setTimeout(function(){
  $('.call-btn').removeClass('hide')
}, 2000);

$('.call-btn').click(function(){
  $(this).toggleClass('hide');
  $('.call-box').addClass('open');
});
$('.close-callbox').click(function(){
  $('.call-box').removeClass('open');
  $('.call-btn').removeClass('hide');
});
