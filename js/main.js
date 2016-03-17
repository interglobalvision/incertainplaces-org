var afterAjaxLoad, ajaxContent, detectBrightness, fullWidth, getImageBrightness, init, l, layout, marginBasic, openLevel1, removeHomeSlides, submenus, windowHeight, windowWidth;

fullWidth = 1487;
mobileWidth = 600;

l = function(data) {
  return console.log(data);
};

windowWidth = $(window).innerWidth();

windowHeight = $(window).innerHeight();

marginBasic = parseInt($('#main-container').css('padding-top'));

submenus = $('.submenu');

ajaxContent = $('#ajax-content');

init = function() {
  $(window).on({
    'resize': function() {
      layout();
    },
  });
};

$(document).on({
  'load': function() {
    init();
    layout();
  },
});

$(document).ready(function($) {
  var ajaxArtistLinks, ajaxLinks, ajaxProjectLinks, ajaxStudentLinks, homeSlide, homeSlideLength, homeSlideshow, target, tooltip, tooltipOffset;

  if (window.location.hash) {
    target = window.location.hash.substr(3);
    if (target === 'menu') {
      removeHomeSlides();
      window.location.hash = '';
    } else {
      openLevel1(target);
      window.location.hash = '';
    }
  }

  $('.col-inner').perfectScrollbar({
    'suppressScrollX': true,
  });

  layout();

  if ($('body').hasClass('home')) {
    homeSlide = $('.home-slide');
    homeSlideLength = homeSlide.length;
    homeSlide.each(function() {
      var background;

      background = $(this).data('background');
      return detectBrightness($(this), background);
    });

    homeSlideshow = window.setInterval(function() {
      var active, activeIndex, background, next;

      if ($('#home-slides').length) {
        active = $('.home-slide.active');
        activeIndex = active.index();
        active.data('background', false);
        if (activeIndex === (homeSlideLength - 1)) {
          homeSlide.css('opacity', 0).removeClass('active');
          next = homeSlide.eq(0);
          next.css('opacity', 1).addClass('active');
          if (next.data('brightness')) {
            return $('body').removeClass('active-slide-dark').removeClass('active-slide-light').addClass('active-slide-' + next.data('brightness'));
          }
        } else {
          homeSlide.css('opacity', 0).removeClass('active');
          next = homeSlide.eq(activeIndex + 1);
          background = next.data('background');
          if (next.data('background')) {
            next.css('background-image', 'url(' + background + ')').data('background', false);
          }

          next.css('opacity', 1).addClass('active');
          if (next.data('brightness')) {
            return $('body').removeClass('active-slide-dark').removeClass('active-slide-light').addClass('active-slide-' + next.data('brightness'));
          }
        }
      } else {
        return window.clearInterval(homeSlideshow);
      }
    }, 4500);

    $('#home-click').click(function() {
      removeHomeSlides();
      window.clearInterval(homeSlideshow);
      return $('body').removeClass('active-slide-dark').removeClass('active-slide-light').removeClass('no-min-width');
    });
  }

  $('.menu-item').click(function(e) {
    target = $(this).data('target');

    if ($('.home').length) {
      e.preventDefault();
      $('#home-' + target).toggle();
      $(this).toggleClass('active');
      return layout();
    } else if (target === 'shop') {

    } else if ($('.single-' + target).length || $('.post-type-archive-' + target).length) {
      e.preventDefault();
      $('.submenu-level-2').hide();
      $('.submenu-level-3').hide();
      $('#submenu-level-1').toggle();
      return layout();
    }
  });
  $('.js-open-level-1').click(function(e) {
    target = $(this).data('target');

    openLevel1(target);
    return layout();
  });
  $('.js-open-level-2').click(function(e) {
    target = $(this).data('target');

    submenus.hide();
    $('#submenu-level-1').show();
    $(this).parents('.submenu-level-2').show();
    $('#submenu-' + target).show();
    return layout();
  });

  if ($('html').hasClass('no-touch')) {
    tooltip = $('#tooltip');
    tooltipOffset = 10;

    $('.js-tooltip').on({
      'mouseenter': function() {
        var image;

        image = $(this).data('hover-image');
        tooltip.attr('src', image).show();
        return $(window).mousemove(function(e) {
          return tooltip.css({
            'top': (e.pageY + tooltipOffset) + 'px',
            'left': (e.pageX + tooltipOffset) + 'px',
          });
        });
      },

      'mouseleave': function() {
        $(window).off();
        return tooltip.hide();
      },
    });
  }

  $('.has-hover-image').hover(function() {
    if (!$(this).hasClass('js-lazy-loaded')) {
      target = $(this).children().children();
      target.attr('src', target.data('src'));
      return $(this).addClass('js-lazy-loaded');
    }
  });

  $('#mce-EMAIL').keypress(function(e) {
    if (e.which === 10 || e.which === 13) {
      return $('#mc-embedded-subscribe-form').trigger('submit');
    }
  });

  $('#mc-embedded-subscribe-form').submit(function(e) {
    var data, dataArray, url;

    e.preventDefault();
    e.stopPropagation();
    url = $(this).attr('action').replace('/post?', '/post-json?').concat('&c=?');
    data = {};
    dataArray = $(this).serializeArray();
    $.each(dataArray, function(index, item) {
      return data[item.name] = item.value;
    });
    $.ajax({
      url: url,
      data: data,
      dataType: 'jsonp',
      error: function(err, text) {
        l("Mailchimp error:");
        l(text);
        l(err);
        return alert("Subscription failure.");
      },

      success: function(data) {
        if (data.result === "success") {
          $('#mc-embedded-subscribe-form').hide();
          return $('#mc-embedded-subscribe-thanks').show();
        } else {
          l(data);
          return alert("Subscription failure. " + data.msg);
        }
      },
    });
    return $('#mce-EMAIL').val('');
  });

  ajaxLinks = $('.js-ajax');
  ajaxLinks.click(function(e) {
    e.preventDefault();
    ajaxContent.html('loading...').load(e.target.href + ' article.js-content', function() {
      return afterAjaxLoad(e.target.textContent, e.target.href);
    }).show();
    ajaxLinks.removeClass('active-ajax');
    return $(this).addClass('active-ajax');
  });

  ajaxProjectLinks = $('.js-ajax-projects');
  ajaxProjectLinks.click(function(e) {
    if ($('.single-projects').length || $('.post-type-archive-projects').length) {
      e.preventDefault();
      ajaxContent.html('loading...').load(e.target.href + ' article.js-content', function() {
        return afterAjaxLoad(e.target.textContent, e.target.href);
      }).show();
      ajaxProjectLinks.removeClass('active-ajax');
      return $(this).addClass('active-ajax');
    }
  });

  ajaxArtistLinks = $('.js-ajax-artists');
  ajaxArtistLinks.click(function(e) {
    if ($('.single-artists').length || $('.post-type-archive-artists').length) {
      e.preventDefault();
      ajaxContent.html('loading...').load(e.target.href + ' article.artists', function() {
        return afterAjaxLoad(e.target.textContent, e.target.href);
      }).show();
      ajaxArtistLinks.removeClass('active-ajax');
      return $(this).addClass('active-ajax');
    }
  });

  ajaxStudentLinks = $('.js-ajax-students');
  ajaxStudentLinks.click(function(e) {
    if ($('.single-students').length || $('.post-type-archive-students').length || $('.page').length) {
      e.preventDefault();
      ajaxContent.html('loading...').load(e.target.href + ' article.students', function() {
        return afterAjaxLoad(e.target.textContent, e.target.href);
      }).show();
      ajaxStudentLinks.removeClass('active-ajax');
      return $(this).addClass('active-ajax');
    }
  });

  return $('.js-open-ma-information').click(function(e) {
    e.preventDefault();
    submenus.hide();
    ajaxStudentLinks.removeClass('active-ajax');
    $('#submenu-level-1').show();
    target = $(this).data('target');
    return ajaxContent.html('loading...').load(target + ' article.js-content', function() {
      $('.cycle-slideshow').cycle();
      if (Modernizr.history) {
        history.pushState(null, null, target);
      }

      return content.imagesLoaded(function() {
        return layout();
      }).animate({
        scrollTop: 0,
      }, 'fast');
    }).show();
  });
});

layout = function() {
  windowWidth = $(window).innerWidth();
  windowHeight = $(window).innerHeight();

  if (windowWidth > mobileWidth) {
    return $('.col').css({
      'height': (windowHeight - marginBasic) + 'px',
    });
  } else {
    return $('.col').css({
      'height': 'auto',
    });
  }
};

afterAjaxLoad = function(title, href) {
  $('.cycle-slideshow').cycle();

  if (Modernizr.history) {
    history.pushState(null, title, href);
  }

  $('#main-content').imagesLoaded(function() {
    return $('#ajax-content').perfectScrollbar('destroy').perfectScrollbar({
      'suppressScrollX': true,
    });
  }).animate({
    scrollTop: 0,
  }, 'fast');

  return init();
};

removeHomeSlides = function() {
  $('#home-click').remove();
  $('#home-slides').remove();

  return $('#menu').show();
};

openLevel1 = function(target) {
  submenus.hide();
  $('#submenu-level-1').show();

  return $('#submenu-' + target).show();
};

detectBrightness = function(target, img) {
  if (Modernizr.canvas) {
    return getImageBrightness(img, function(brightness) {
      if (brightness > 127.5) {
        target.addClass('font-dark').data('brightness', 'dark');
        if (target.hasClass('active')) {
          return $('body').addClass('active-slide-dark');
        }
      } else {
        target.addClass('font-light').data('brightness', 'light');
        if (target.hasClass('active')) {
          return $('body').addClass('active-slide-light');
        }
      }
    });
  }
};

getImageBrightness = function(imageSrc, callback) {
  var colorSum, img;

  img = document.createElement("img");
  img.src = imageSrc;
  img.style.display = "none";
  document.body.appendChild(img);
  colorSum = 0;
  return img.onload = function() {
    var avg, b, brightness, canvas, ctx, data, g, imageData, len, r, x;

    canvas = document.createElement("canvas");
    canvas.width = this.width;
    canvas.height = this.height;
    ctx = canvas.getContext("2d");
    ctx.drawImage(this, 0, 0);
    imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    data = imageData.data;
    r;
    g;
    b;
    avg;
    x = 0;
    len = data.length;
    while (x < len) {
      r = data[x];
      g = data[x + 1];
      b = data[x + 2];
      avg = Math.floor((r + g + b) / 3);
      colorSum += avg;
      x += 4;
    }

    brightness = Math.floor(colorSum / (this.width * this.height));
    return callback(brightness);
  };
};