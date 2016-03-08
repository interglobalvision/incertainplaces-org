# fullWidth = 1334
fullWidth = 1487

l = (data) ->
  console.log data

# start
windowWidth = $(window).innerWidth()
windowHeight = $(window).innerHeight()
marginBasic = parseInt($('#main-container').css('padding-top'))

# menu
submenus = $('.submenu')

# ajax
ajaxContent = $('#ajax-content')

init = () ->
  $(window).on {
    'resize': ->
      l 'resizeing u prik'
      layout()
  }

$(document).on {
  'load': ->
    init()
    layout()
}

$(document).ready ($) ->

  #hash links

  if window.location.hash
    target = window.location.hash.substr(3)
    if target == 'menu'
      removeHomeSlides()
      window.location.hash = ''
    else
      openLevel1(target)
      window.location.hash = ''

  #scrollbars

  $('.col-inner').perfectScrollbar({
    'suppressScrollX': true
  })

  # layout fixes

  layout()

  #home

  if $('body').hasClass('home')
    homeSlide = $('.home-slide')
    homeSlideLength = homeSlide.length

    homeSlide.each ->
      background = $(this).data('background')
      detectBrightness($(this), background)

    homeSlideshow = window.setInterval(->
      if $('#home-slides').length
        active = $('.home-slide.active')
        activeIndex = active.index()
        active.data('background', false)
        if activeIndex == (homeSlideLength-1)
          homeSlide.css('opacity', 0).removeClass('active')
          next = homeSlide.eq(0)
          next.css('opacity', 1).addClass('active')
          if next.data('brightness')
            $('body').removeClass('active-slide-dark').removeClass('active-slide-light').addClass('active-slide-'+next.data('brightness'))
        else
          homeSlide.css('opacity', 0).removeClass('active')
          next = homeSlide.eq(activeIndex+1)

          background = next.data('background')
          if next.data('background')
            next.css('background-image', 'url('+background+')').data('background', false)
          next.css('opacity', 1).addClass('active')
          if next.data('brightness')
            $('body').removeClass('active-slide-dark').removeClass('active-slide-light').addClass('active-slide-'+next.data('brightness'))
      else
        window.clearInterval(homeSlideshow)
    , 4500)

    $('#home-click').click ->
      removeHomeSlides()
      window.clearInterval(homeSlideshow)
      $('body').removeClass('active-slide-dark').removeClass('active-slide-light').removeClass('no-min-width')

  # menus and submenus

  $('.menu-item').click (e) ->
    target = $(this).data('target')
    if $('.home').length
      e.preventDefault()
      $('#home-'+target).toggle()
      $(this).toggleClass('active')
      layout()

    else if target == 'shop'

    else if $('.single-'+target).length or $('.post-type-archive-'+target).length
      e.preventDefault()
      $('.submenu-level-2').hide()
      $('.submenu-level-3').hide()
      $('#submenu-level-1').toggle()
      layout()

  $('.js-open-level-1').click (e) ->
    target = $(this).data('target')
    openLevel1(target)
    layout()

  $('.js-open-level-2').click (e) ->
    target = $(this).data('target')
    submenus.hide()
    $('#submenu-level-1').show()
    $(this).parents('.submenu-level-2').show()
    $('#submenu-'+target).show()
    layout()

  # tooltips

  if $('html').hasClass('no-touch')
    tooltip = $('#tooltip')
    tooltipOffset = 10

    $('.js-tooltip').on {
      'mouseenter': ->
        image = $(this).data('hover-image')
        tooltip.attr('src', image).show()
        $(window).mousemove (e) ->
          tooltip.css {
            'top': (e.pageY+tooltipOffset)+'px'
            'left': (e.pageX+tooltipOffset)+'px'
          }
      'mouseleave': ->
        $(window).off()
        tooltip.hide()
    }

  $('.has-hover-image').hover ->
    if !$(this).hasClass('js-lazy-loaded')
      target = $(this).children().children()
      target.attr('src', target.data('src'))
      $(this).addClass('js-lazy-loaded')

  # subscribe form

  $('#mce-EMAIL').keypress (e) ->
    if(e.which == 10 || e.which == 13)
      $('#mc-embedded-subscribe-form').trigger('submit')

  $('#mc-embedded-subscribe-form').submit (e) ->
    e.preventDefault()
    e.stopPropagation()
    url = $(this).attr('action').replace('/post?', '/post-json?').concat('&c=?')
    data = {}
    dataArray = $(this).serializeArray()
    $.each(dataArray, (index, item) ->
      data[item.name] = item.value
    )
    $.ajax {
      url: url
      data: data
      dataType: 'jsonp'
      error: (err, text) ->
        l "Mailchimp error:"
        l text
        l err
        alert "Subscription failure."
      success: (data) ->
        if (data.result == "success")
          $('#mc-embedded-subscribe-form').hide()
          $('#mc-embedded-subscribe-thanks').show()
        else
          l data
          alert "Subscription failure. " + data.msg
    }
    $('#mce-EMAIL').val('')

  # ajaxy

  ajaxLinks = $('.js-ajax')
  ajaxLinks.click (e) ->
    e.preventDefault()
    ajaxContent.html('loading...').load(e.target.href+' article.js-content', ->
      afterAjaxLoad(e.target.textContent, e.target.href)
    ).show()
    ajaxLinks.removeClass('active-ajax')
    $(this).addClass('active-ajax')

  ajaxProjectLinks = $('.js-ajax-projects')
  ajaxProjectLinks.click (e) ->
    if $('.single-projects').length or $('.post-type-archive-projects').length
      e.preventDefault()
      ajaxContent.html('loading...').load(e.target.href+' article.js-content', ->
        afterAjaxLoad(e.target.textContent, e.target.href)
      ).show()
      ajaxProjectLinks.removeClass('active-ajax')
      $(this).addClass('active-ajax')

  ajaxArtistLinks = $('.js-ajax-artists')
  ajaxArtistLinks.click (e) ->
    if $('.single-artists').length or $('.post-type-archive-artists').length
      e.preventDefault()
      ajaxContent.html('loading...').load(e.target.href+' article.artists', ->
        afterAjaxLoad(e.target.textContent, e.target.href)
      ).show()
      ajaxArtistLinks.removeClass('active-ajax')
      $(this).addClass('active-ajax')

  ajaxStudentLinks = $('.js-ajax-students')
  ajaxStudentLinks.click (e) ->
    if $('.single-students').length or $('.post-type-archive-students').length or $('.page').length
      e.preventDefault()
      ajaxContent.html('loading...').load(e.target.href+' article.students', ->
        afterAjaxLoad(e.target.textContent, e.target.href)
      ).show()
      ajaxStudentLinks.removeClass('active-ajax')
      $(this).addClass('active-ajax')

  $('.js-open-ma-information').click (e) ->
    e.preventDefault()
    submenus.hide()
    ajaxStudentLinks.removeClass('active-ajax')
    $('#submenu-level-1').show()
    target = $(this).data('target')
    ajaxContent.html('loading...').load(target+' article.js-content', ->
      $('.cycle-slideshow').cycle()
      if Modernizr.history
        history.pushState(null, null, target)
      content.imagesLoaded(->
        layout()
      ).animate({ scrollTop: 0 }, 'fast')
    ).show()

#functions

layout = ->
  l 'laying out u prik'
  windowWidth = $(window).innerWidth()
  windowHeight = $(window).innerHeight()
  $('.col').css({
    'height': (windowHeight-(marginBasic))+'px'
  })
#   colInners.perfectScrollbar('update')

#ajaxy func

afterAjaxLoad = (title, href) ->
  $('.cycle-slideshow').cycle()
  if Modernizr.history
    history.pushState(null, title, href)
  $('#main-content').imagesLoaded(->
    $('#ajax-content').perfectScrollbar('destroy').perfectScrollbar({
      'suppressScrollX': true
    })
  ).animate({ scrollTop: 0 }, 'fast')
  init()

#home

removeHomeSlides = ->
  $('#home-click').remove()
  $('#home-slides').remove()
  $('#menu').show()

openLevel1 = (target) ->
  submenus.hide()
  $('#submenu-level-1').show()
  $('#submenu-'+target).show()

#home image analysis functions

detectBrightness = (target, img) ->
  if Modernizr.canvas
    getImageBrightness(img, (brightness) ->
      if brightness > 127.5
        target.addClass('font-dark').data('brightness', 'dark')
        if target.hasClass('active')
          $('body').addClass('active-slide-dark')
      else
        target.addClass('font-light').data('brightness', 'light')
        if target.hasClass('active')
          $('body').addClass('active-slide-light')
    )

getImageBrightness = (imageSrc, callback) ->
  img = document.createElement("img")
  img.src = imageSrc
  img.style.display = "none"
  document.body.appendChild(img)

  colorSum = 0

  img.onload = ->
    canvas = document.createElement("canvas")
    canvas.width = this.width
    canvas.height = this.height

    ctx = canvas.getContext("2d")
    ctx.drawImage(this, 0, 0)

    imageData = ctx.getImageData(0, 0, canvas.width, canvas.height)
    data = imageData.data
    r
    g
    b
    avg

    x = 0
    len = data.length

    while x < len
      r = data[x]
      g = data[x + 1]
      b = data[x + 2]
      avg = Math.floor((r + g + b) / 3)
      colorSum += avg
      x += 4

    brightness = Math.floor(colorSum / (this.width * this.height))
    callback(brightness)