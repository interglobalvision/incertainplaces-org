var Site = {
  init: function() {

    // setup site vars
    this.windowWidth = $(window).innerWidth();
    this.windowHeight = $(window).innerHeight();
    this.marginBasic = parseInt($('#main-container').css('padding-top'));
    this.mobileWidth = 600;
    this.fullWidth = 1487;

    this.bind();

    // init functionality
    Site.Layout.init();
    Site.Menu.init();
    Site.Tooltip.init();
    Site.Mailchimp.init();
    Site.Ajax.init();

    // if home
    if ($('body').hasClass('home')) {
      Site.Home.init();
    }

  },

  bind: function() {
    var _this = this;

    $(window).resize(function() {
      _this.onResize();
    });

    $(document).ready(function() {
      _this.initPerfectScrollbars();
      _this.hashRoutes();

      Site.Layout.logic();
    });

  },

  onResize: function() {
    this.windowWidth = $(window).innerWidth();
    this.windowHeight = $(window).innerHeight();

    Site.Layout.onResize();
  },

  initPerfectScrollbars: function() {
    // Init perfect scrollbar
    $('.col-inner').perfectScrollbar({
      'suppressScrollX': true,
    });
  },

  hashRoutes: function() {
    // Check for hash links
    if (window.location.hash) {
      var target = window.location.hash.substr(3);

      if (target === 'menu') {
        Site.Home.destroySlideshow();
        window.location.hash = '';
      } else {
        Site.Menu.openLevel1(target);
        window.location.hash = '';
      }
    }
  },
};

Site.Layout = {
  init: function() {
    this.bind();
    this.logic();
  },

  bind: function() {
    var _this = this;

    $(document).on({
      'load': function() {
        _this.logic();
      },
    });

  },

  onResize: function() {
    this.logic();
  },

  logic: function() {

    if (Site.windowWidth > Site.mobileWidth) {
      return $('.col').css({
        'height': (Site.windowHeight - Site.marginBasic) + 'px',
      });
    } else {
      return $('.col').css({
        'height': 'auto',
      });
    }

  },
};

Site.Home = {
  init: function() {
    this.bind();
    this.analyzesSlides();
  },

  bind: function() {
    var _this = this;

    // on click remove slideshow
    $('#home-click').click(function() {
      _this.destroySlideshow();
      $('body').removeClass('active-slide-dark').removeClass('active-slide-light').removeClass('no-min-width');
    });

  },

  analyzesSlides: function() {
    var _this = this;

    // detect brightness on home slides
    _this.$homeSlides = $('.home-slide');
    _this.homeSlideLength = this.$homeSlides.length;

    _this.$homeSlides.each(function() {
      var background = $(this).data('background');

      return _this.detectBrightness($(this), background);
    });

    _this.initSlideshow();
  },

  initSlideshow: function() {
    var _this = this;

    // Set home slideshow looping, check brightness and set text color according
    _this.homeSlideshow = window.setInterval(function() {
      var $active, activeIndex, background, next;

      if ($('#home-slides').length) {
        $active = $('.home-slide.active');
        activeIndex = $active.index();
        $active.data('background', false);

        if (activeIndex === (_this.homeSlideLength - 1)) {
          _this.$homeSlides.css('opacity', 0).removeClass('active');
          next = _this.$homeSlides.eq(0);
          next.css('opacity', 1).addClass('active');
          if (next.data('brightness')) {
            return $('body').removeClass('active-slide-dark').removeClass('active-slide-light').addClass('active-slide-' + next.data('brightness'));
          }

        } else {
          _this.$homeSlides.css('opacity', 0).removeClass('active');
          next = _this.$homeSlides.eq(activeIndex + 1);
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
        this.destroySlideshow();
      }
    }, 4500);

  },

  destroySlideshow: function() {
    var _this = this;

    window.clearInterval(_this.homeSlideshow);

    $('#home-click').remove();
    $('#home-slides').remove();

    $('#menu').show();
  },

  detectBrightness: function($target, img) {
    var _this = this;

    if (Modernizr.canvas) {
      return _this.getImageBrightness(img, function(brightness) {
        if (brightness > 127.5) {
          $target.addClass('font-dark').data('brightness', 'dark');
          if ($target.hasClass('active')) {
            return $('body').addClass('active-slide-dark');
          }
        } else {
          $target.addClass('font-light').data('brightness', 'light');
          if ($target.hasClass('active')) {
            return $('body').addClass('active-slide-light');
          }
        }
      });
    }
  },

  getImageBrightness: function(imageSrc, callback) {
    var colorSum, img;

    img = document.createElement("img");
    img.src = imageSrc;
    img.style.display = "none";
    document.body.appendChild(img);
    colorSum = 0;
    img.onload = function() {
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
  },
};

Site.Menu = {
  init: function() {
    this.$submenus = $('.submenu');

    this.bind();
  },

  bind: function() {
    var _this = this;

    $('.menu-item').click(function(e) {
      var target = $(this).data('target');

      // if desktop toggle drawers
      if( Site.windowWidth > Site.mobileWidth ) {
        if ($('.home').length) {
          e.preventDefault();
          $('#home-' + target).toggle();
          $(this).toggleClass('active');
          return Site.Layout.logic();

        } else if (target === 'shop') {
          // do nothing
        } else if ($('.single-' + target).length || $('.post-type-archive-' + target).length) {
          e.preventDefault();
          $('.submenu-level-2').hide();
          $('.submenu-level-3').hide();
          $('#submenu-level-1').toggle();
          return Site.Layout.logic();
        }
      }
      // else, normal link behavior

    });

    $('.js-open-level-1').click(function(e) {
      var target = $(this).data('target');

      Site.Breadcrumbs.setLevelOne($(this));

      _this.openLevel1(target);
      return Site.Layout.logic();
    });

    $('.js-open-level-2').click(function(e) {
      var target = $(this).data('target');

      Site.Breadcrumbs.setLevelTwo($(this));

      _this.$submenus.hide();

      $('#submenu-level-1').show();

      $(this).parents('.submenu-level-2').show();

      $('.submenu-level-2 a').removeClass('active-ajax');

      $('#submenu-' + target).show();

      return Site.Layout.logic();
    });

  },

  openLevel1: function(target) {
    this.$submenus.hide();
    $('#submenu-level-1').show();
    return $('#submenu-' + target).show();
  },
};

Site.Breadcrumbs = {
  setLevelOne: function($target) {
    $('.level-1-breadcrumb').removeClass('level-1-breadcrumb');
    $target.addClass('level-1-breadcrumb');
  },

  setLevelTwo: function($target) {
    $('.level-2-breadcrumb').removeClass('level-2-breadcrumb');
    $target.addClass('level-2-breadcrumb');
  },

  setLevelThree: function($target) {
    $('.level-3-breadcrumb').removeClass('level-3-breadcrumb');
    $target.addClass('level-3-breadcrumb');
  },

  clearAll: function() {
    $('.level-1-breadcrumb').removeClass('level-2-breadcrumb');
    $('.level-2-breadcrumb').removeClass('level-2-breadcrumb');
    $('.level-3-breadcrumb').removeClass('level-3-breadcrumb');
  },
};

Site.Ajax = {
  init: function() {

    this.$ajaxContent = $('#ajax-content');

    this.$ajaxLinks = $('.js-ajax');
    this.$ajaxProjectLinks = $('.js-ajax-projects');
    this.$ajaxPracticingPlaceAbout = $('.js-ajax-pp-about');
    this.$ajaxArtistLinks = $('.js-ajax-artists');
    this.$ajaxStudentLinks = $('.js-ajax-students');
    this.$ajaxMaLinks = $('.js-open-ma-information');

    this.bind();
  },

  bind: function() {
    var _this = this;

    _this.$ajaxLinks.click(function(e) {
      _this.ajaxLoad(e);
    });

    _this.$ajaxProjectLinks.on('click.ajax', function(e) {
      if ($('.single-projects').length || $('.post-type-archive-projects').length) {
        Site.Breadcrumbs.setLevelThree($(this));
        _this.ajaxLoad(e);
      }
    });

    _this.$ajaxPracticingPlaceAbout.on('click.ajax', function(e) {
      if ($('.single-projects').length || $('.post-type-archive-projects').length) {
        Site.Breadcrumbs.setLevelTwo($(this));
        $('.submenu-level-3').hide();
        _this.ajaxLoad(e);
      }
    });

    _this.$ajaxArtistLinks.on('click.ajax', function(e) {
      if ($('.single-artists').length || $('.post-type-archive-artists').length) {
        Site.Breadcrumbs.setLevelOne($(this));
        _this.ajaxLoad(e);
      }
    });

    _this.$ajaxStudentLinks.on('click.ajax', function(e) {
      if ($('.single-students').length || $('.post-type-archive-students').length || $('.page').length) {
        Site.Breadcrumbs.setLevelTwo($(this));
        _this.ajaxLoad(e);
      }
    });

    _this.$ajaxMaLinks.on('click.ajax', function(e) {
      e.preventDefault();

      Site.Breadcrumbs.setLevelOne($(this));

      Site.Menu.$submenus.hide();

      _this.$ajaxStudentLinks.removeClass('active-ajax');

      $('#submenu-level-1').show();

      var target = $(this).data('target');

       _this.$ajaxContent.html('loading...').load(target + ' article.js-content', function() {

       _this.afterAjaxLoad(e.target.textContent, e.target.href);
      }).show();
    });

  },

  unbind: function() {
    var _this = this;

    $('.js-ajax, .js-ajax-projects, .js-ajax-artists, .js-ajax-students, .js-open-ma-information').off('.ajax');
  },

  ajaxLoad: function(e) {
    var _this = this;

    e.preventDefault();
    _this.$ajaxContent.html('loading...').load(e.target.href + ' article.js-content', function() {
      return _this.afterAjaxLoad(e.target.textContent, e.target.href);
    }).show();
    _this.scrollToBottom();
    _this.$ajaxLinks.removeClass('active-ajax');
    return $(this).addClass('active-ajax');
  },

  afterAjaxLoad: function(title, href) {
    var _this = this;

    // init Slideshows
    $('.cycle-slideshow').cycle();

    // if supports history api set url
    if (Modernizr.history) {
      history.pushState(null, title, href);
    }

    // re-init scrollbars by destroying first
    $('#main-content').imagesLoaded(function() {
      return $('#ajax-content').perfectScrollbar('destroy').perfectScrollbar({
        'suppressScrollX': true,
      });
    });

    // unbind ajax links
    _this.unbind();

    // reinit site
    return Site.init();
  },

  scrollToBottom: function() {
    // on mobile scroll to loading
    if ( Site.windowWidth <= Site.mobileWidth ) {
      $('html, body').animate({
        scrollTop: $('#main-content').offset().top - 13,
      }, 'fast');
    }
  },
};

Site.Mailchimp = {
  init: function() {
    this.bind();
  },

  bind: function() {
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
        data[item.name] = item.value;
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
  },
};

Site.Tooltip = {
  init: function() {
    this.$tooltip = $('#tooltip');
    this.tooltipOffset = 10;

    this.bind();
  },

  bind: function() {
    var _this = this;

    if ($('html').hasClass('no-touch')) {
      $('.js-tooltip').on({
        'mouseenter': function() {
          var image = $(this).data('hover-image');

          _this.$tooltip.attr('src', image).show();

          return $(window).mousemove(function(e) {
            return _this.$tooltip.css({
              'top': (e.pageY + _this.tooltipOffset) + 'px',
              'left': (e.pageX + _this.tooltipOffset) + 'px',
            });
          });
        },

        'mouseleave': function() {
          $(window).off();
          return _this.$tooltip.hide();
        },
      });
    }

    $('.has-hover-image').hover(function() {
      if (!$(this).hasClass('js-lazy-loaded')) {
        var target = $(this).children().children();

        target.attr('src', target.data('src'));
        return $(this).addClass('js-lazy-loaded');
      }
    });
  },
};

Site.init();