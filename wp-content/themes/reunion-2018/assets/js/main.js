$(document).ready(function(){

  // var screen_mobile = 667;
  // if(window.innerWidth <= screen_mobile){
  //   setTimeout(function(){ window.scrollTo(0,1) }, 1000);
  // }


  //nav-btn
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
  });
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
  });

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
  }

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

  if(window.location.pathname !== '/'){
    setTimeout(function(){
      $('.page-overlay').addClass('hide');
    }, 1000);
  }

  // Flip Card Functions
  var flipFrontH = $('.flipper > .front').height();
  $('.flipper').height(flipFrontH);
  $('.flipper .back').height(flipFrontH);

  $(window).resize(function(){
    var flipFrontH = $('.flipper > .front').height();
    $('.flipper').height(flipFrontH);
    $('.flipper .back').height(flipFrontH);
  });

  $('.flip-container').click(function(){
    $(this).toggleClass('hover');
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
