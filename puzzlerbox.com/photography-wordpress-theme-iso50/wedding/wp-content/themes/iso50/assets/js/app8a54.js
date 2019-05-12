(function(a){"use strict";a.fn.absoluteCounter=function(b){b=a.extend({},a.fn.absoluteCounter.defaults,b||{});return a(this).each(function(){var d=this,g=b.speed,f=b.setStyles,e=b.delayedStart,c=b.fadeInDelay;if(f){a(d).css({display:"block",position:"relative",overflow:"hidden"}).addClass('animated')}a(d).css("opacity","0");a(d).animate({opacity:0},e,function(){var l=a(d).text();a(d).text("");for(var k=0;k<l.length;k++){var n=l.charAt(k);var m="";if(parseInt(n,10)>=0){m='<span class="onedigit p'+(l.length-k)+" d"+n+'">';for(var h=0;h<=parseInt(n,10);h++){m+='<span class="n'+(h%10)+'">'+(h%10)+"</span>"}m+="</span>"}else{m='<span class="onedigit p'+(l.length-k)+' char"><span class="c">'+n+"</span></span>"}a(d).append(m)}a(d).animate({opacity:1},c);a("span.onedigit",d).each(function(i,o){if(f){a(o).css({"float":"left",position:"relative"});a("span",a(o)).css({display:"block"})}var p=a("span",a(o)).length,j=a(d).height();a(o).css({height:(p*j)+"px",top:"0"});a("span",a(o)).css({height:j+"px"});a(o).animate({top:-1*((p-1)*j)+"px"},g,function(){if(typeof(b.onComplete)==="function"){b.onComplete.call(d)}})})})})};a.fn.absoluteCounter.defaults={speed:2000,setStyles:true,onComplete:null,delayedStart:0,fadeInDelay:0}}(jQuery));


(function($) {
    "use strict";

    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return $(this).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                $(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) === 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) === 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null  // callback method for when the element finishes updating
    };
})(jQuery);


/* Project */
function scaleElement(element, isVideo, propertyY, propertyX) {

    element.each(function() {
        elementCurrent = jQuery(this);

        var parentWidth = elementCurrent.parent().width();
        var parentHeight = elementCurrent.parent().height();

        var height = elementCurrent.attr("height");
        var width = elementCurrent.attr("width");

        if(isVideo){
            if (!height) {height = elementCurrent[0].videoWidth;}
            if (!width) {width = elementCurrent[0].videoHeight;}
        } else {
            if (!height) {height = elementCurrent.data("height");}
            if (!height) {height = elementCurrent.height();}
            if (!width) {width = elementCurrent.data("width");}
            if (!width) {width = elementCurrent.width();}
        }

        var ratio = height / width;

        if (!isVideo) {
            if ((parentHeight/parentWidth) > ratio){
                var newHeight = parentHeight;
                var newWidth = parentHeight / ratio;
            }
            else {
                var newWidth = parentWidth;
                var newHeight = parentWidth * ratio;
            }

            var newLeft = parseInt((parentWidth - newWidth)/2);
            var newTop = parseInt((parentHeight - newHeight)/2);

            elementCurrent.css({"height": newHeight,"width": newWidth, position:"absolute"});

            if (propertyX == "right") {
                elementCurrent.css({"right": newLeft, "left": "auto"});
                elementCurrent.attr("data-right", newLeft);
            }
            else if (propertyX != "no") {
                elementCurrent.css({"left": newLeft, "right" : "auto"});
                elementCurrent.attr("data-left", newLeft);
            }
            if (propertyY == "bottom") {
                elementCurrent.css({"bottom": newTop});
                elementCurrent.attr("data-bottom", newTop);
            }
            else if (propertyY != "no") {
                elementCurrent.css({"top": newTop});
                elementCurrent.attr("data-top", newTop);
            }

        }
        else {

            if (width < parentWidth) {width = parentWidth; height = (width * ratio);}
            if (height < parentHeight) {height = parentHeight; width = (height / ratio);}
            console.log(width)
            console.log(height)
            TweenLite.set(element, {left: "50%", top: "50%", marginLeft : -width/2, marginTop : -height/2, width: width, height:height});

        }

    });

}


(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelRequestAnimationFrame = window[vendors[x]+
        'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}())


jQuery.fn.extend({everyTime:function(interval,label,fn,times){return this.each(function(){jQuery.timer.add(this,interval,label,fn,times)})},oneTime:function(interval,label,fn){return this.each(function(){jQuery.timer.add(this,interval,label,fn,1)})},stopTime:function(label,fn){return this.each(function(){jQuery.timer.remove(this,label,fn)})}});jQuery.extend({timer:{global:[],guid:1,dataKey:"jQuery.timer",regex:/^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,powers:{'ms':1,'cs':10,'ds':100,'s':1000,'das':10000,'hs':100000,'ks':1000000},timeParse:function(value){if(value==undefined||value==null)return null;var result=this.regex.exec(jQuery.trim(value.toString()));if(result[2]){var num=parseFloat(result[1]);var mult=this.powers[result[2]]||1;return num*mult}else{return value}},add:function(element,interval,label,fn,times){var counter=0;if(jQuery.isFunction(label)){if(!times)times=fn;fn=label;label=interval}interval=jQuery.timer.timeParse(interval);if(typeof interval!='number'||isNaN(interval)||interval<0)return;if(typeof times!='number'||isNaN(times)||times<0)times=0;times=times||0;var timers=jQuery.data(element,this.dataKey)||jQuery.data(element,this.dataKey,{});if(!timers[label])timers[label]={};fn.timerID=fn.timerID||this.guid++;var handler=function(){if((++counter>times&&times!==0)||fn.call(element,counter)===false)jQuery.timer.remove(element,label,fn)};handler.timerID=fn.timerID;if(!timers[label][fn.timerID])timers[label][fn.timerID]=window.setInterval(handler,interval);this.global.push(element)},remove:function(element,label,fn){var timers=jQuery.data(element,this.dataKey),ret;if(timers){if(!label){for(label in timers)this.remove(element,label,fn)}else if(timers[label]){if(fn){if(fn.timerID){window.clearInterval(timers[label][fn.timerID]);delete timers[label][fn.timerID]}}else{for(var fn in timers[label]){window.clearInterval(timers[label][fn]);delete timers[label][fn]}}for(ret in timers[label])break;if(!ret){ret=null;delete timers[label]}}for(ret in timers)break;if(!ret)jQuery.removeData(element,this.dataKey)}}}});jQuery(window).bind("unload",function(){jQuery.each(jQuery.timer.global,function(index,item){jQuery.timer.remove(item)})});


var rdyGlobals = {};

rdyGlobals.isMobile	= (/(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|windows phone)/.test(navigator.userAgent));
rdyGlobals.isAndroid = (/(Android)/.test(navigator.userAgent));
rdyGlobals.isiOS = (/(iPhone|iPod|iPad)/.test(navigator.userAgent));
rdyGlobals.isiPhone	= (/(iPhone|iPod)/.test(navigator.userAgent));
rdyGlobals.isiPad = (/(iPad)/.test(navigator.userAgent));
rdyGlobals.isBuggy = (navigator.userAgent.match(/AppleWebKit/) && typeof window.ontouchstart === 'undefined' && ! navigator.userAgent.match(/Chrome/));
rdyGlobals.isWindowsPhone = navigator.userAgent.match(/IEMobile/i);

jQuery.fn.reverse = [].reverse;
jQuery.fn.exists = function() {
    "use strict";

    if (jQuery(this).length > 0) {
        return true;
    } else {
        return false;
    }
};


function rdy_guid() {
    "use strict";

    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
            .toString(16)
            .substring(1);
    }
    return 'u' + s4() + s4() + '-' + s4() + '-' + s4() + '-' +
        s4() + '-' + s4() + s4() + s4();
}


jQuery(function ($) {
    "use strict";

    var PZPREFIX = window.PZPREFIX || {};
    window.PZPREFIX = PZPREFIX;


    PZPREFIX.hideScrollBar = function() {
        jQuery('html').addClass('no-scroll');
    };


    PZPREFIX.showScrollBar = function() {
        if (!jQuery('body[data-hide-scrollbar="true"]').length) {
            jQuery('html').removeClass('no-scroll');
        }
    };


    PZPREFIX.initHeader = function() {

        $.show_complete_nav_bar = function(){

            if (jQuery(window).width() >= 992) {
                jQuery('#header').addClass('visible');
            } else {
                jQuery('#mobile-header').addClass('visible');
            }

            jQuery('body').addClass('navbar-in-view');
        };

        $.hide_complete_nav_bar = function(){

            if (jQuery(window).width() >= 992) {
                jQuery('#header').removeClass('visible');
            } else {
                jQuery('#mobile-header').removeClass('visible');
            }

            jQuery('body').removeClass('navbar-in-view');
        };

        var show_complete_nav_bar = function(){
            setTimeout(function(){
                if (jQuery(window).width() >= 992) {
                    jQuery('#header').addClass('visible');
                } else {
                    jQuery('#mobile-header').addClass('visible');
                }

                jQuery('body').addClass('navbar-in-view');
            },300);
        };

        var hide_complete_nav_bar = function(){
            if (jQuery(window).width() >= 992) {
                jQuery('#header').removeClass('visible');
            } else {
                jQuery('#mobile-header').removeClass('visible');
            }

            jQuery('body').removeClass('navbar-in-view');
        };

        setTimeout(function(){
            show_complete_nav_bar();
        }, 1250);

        if(jQuery('body.header-behaviour-slideup, body.header-mobile-slideup').length) {
            jQuery(window).on("scroll", function () {
                var scrollHeight = jQuery(document).height();
                var scrollPosition = jQuery(window).height() + jQuery(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    $.show_complete_nav_bar();
                }
            });

            var lastScrollTop = 0;
            var delta = 50;

            if (Modernizr.touch) {
                delta = 150;
            }

            jQuery(window).scroll(function(){
                var nowScrollTop = jQuery(this).scrollTop();

                if(Math.abs(lastScrollTop - nowScrollTop) >= delta){
                    if (nowScrollTop > lastScrollTop){
                        var distanceFromBottom = jQuery(document).height() - (jQuery(document).scrollTop() + jQuery(window).height());

                        if(distanceFromBottom > 50){
                            $.hide_complete_nav_bar();
                        }else{
                            if(!jQuery('html').hasClass('animated-scrolling')){
                                $.show_complete_nav_bar();
                            }
                        }

                    } else {
                        if(!jQuery('body').hasClass('complete-scroll-lock')){
                            if(!jQuery('html').hasClass('animated-scrolling')){
                                $.show_complete_nav_bar();
                            }
                        }
                    }

                    lastScrollTop = nowScrollTop;
                }
            });
        }

        var midnight_default_height = $('#wpadminbar').length ? 70 : 140;

        if ($('#header').length) {
            $('#header').midnight({
                objectOffset: $('#header .main-logo .logo-holder').offset().top,
                objectHeight: $('#header .main-logo .logo-holder').height()
            });
        }

        if ($('#vheader .main-logo .logo-holder').length) {
            $('#vheader .main-logo').midnight({
                objectOffset: $('#vheader .main-logo .logo-holder').offset().top,
                objectHeight: $('#vheader .main-logo .logo-holder').height()
            });
        }

    };


    PZPREFIX.elements = function() {

        jQuery(".sf-menu").superfish({});

        if (jQuery('body[data-hide-scrollbar="true"]').length) {
            PZPREFIX.hideScrollBar();
        }

        var uncoveringFooter = function () {
            if (jQuery('body.footer-uncovering').length) {
                if (jQuery(window).width() >= 992) {
                    jQuery('#page').css('margin-bottom', jQuery('footer.site-footer').height());
                } else {
                    jQuery('#page').css('margin-bottom', 0);
                }
            } else if (jQuery('body.footer-fixed').length) {
                jQuery('body').css('margin-bottom', jQuery('footer.site-footer').height());
            }
        };

        jQuery(window).on('debouncedresize', function() {
            uncoveringFooter();
        });
        uncoveringFooter();


        function debounce(func, wait, immediate) {
            var timeout;

            return function () {
                var context = this, args = arguments, later = function () {
                    timeout = null,
                    immediate || func.apply(context, args);
                }, callNow = immediate && !timeout;
                clearTimeout(timeout),
                    timeout = setTimeout(later, wait),
                callNow && func.apply(context, args);
            };
        }


        jQuery('#mobile-menu ul li').each(function () {
            if (jQuery(this).find('> ul').length > 0) {
                jQuery(this).addClass('has-ul');
                jQuery(this).find('> a').append('<div class="fa-sub-indicator"><i class="fa fa-sort-desc"></i></div>');
            }
        });

        jQuery('#mobile-menu ul li:has(">ul") > a .fa-sub-indicator').on('click', function () {
            jQuery(this).parent().parent().toggleClass('open');
            jQuery(this).parent().parent().find('> ul').stop(true, true).slideToggle();
            return false;
        });

        jQuery('#mobile-menu ul li.expand:has(">ul") > a').on('click', function () {
            jQuery(this).parent().toggleClass('open');
            jQuery(this).parent().find('> ul').stop(true, true).slideToggle();
            return false;
        });

        jQuery('#mobile-menu .close_arrow').on('click', function (e) {
            menuToggle();
        });

        $.Velocity.RegisterUI("menu.slideLeftIn", {defaultDuration:800,calls:[[{opacity:[1,0],translateX:[0,-200],translateZ:0}, 0.800, {easing:"easeOutExpo"}]]});
        $.Velocity.RegisterUI("menu.slideLeftOut", {defaultDuration:500,calls:[[{opacity:[1,0],translateZ:0}, 0.3, {easing:"easeInOutCubic"}]]});


        var rdy_mobile_menu = jQuery('#mobile-menu');

        var menuToggle = function(){

            jQuery('body').toggleClass('menu-opened');
            jQuery('.vertical_menu_area, .vertical_menu_wrap').toggleClass('active');
            jQuery('.vertical_menu_area, #mobile-header').find('.hamburger').toggleClass('is-active');

            if (jQuery('.vertical_menu_area').hasClass('active')) {
                TweenMax.staggerFromTo(
                    jQuery('ul.menu a, .vertical_menu_area_elements', jQuery('.vertical_menu_area')),
                    0.7, {x: -200, opacity: 0}, {x: 0, opacity: 1, delay: 0.35, ease: Expo.easeOut}, 0.06
                );
            } else {
                jQuery('ul.menu a', jQuery('.vertical_menu_area')).velocity('stop').velocity({opacity: 0}, 800, {
                    delay: 0
                });
            }

            if (jQuery(window).width() < 992) {

                var animation = {translateY: "-110%"};
                var animation_out = {translateY:  [ "0%", "-110%" ]};

                var items_animation = '';

                if (rdy_mobile_menu.data('menu-animation') === 'slideleft') {
                    animation = {translateX: "-110%"};
                    animation_out = {translateX: ["0%", "-110%"]};
                    items_animation = 'transition.slideLeftIn';
                } else if(rdy_mobile_menu.data('menu-animation') === 'slideright') {
                    animation = {translateX: "110%"};
                    animation_out = {translateX: ["0%", "110%"]};
                    items_animation = 'transition.slideRightIn';
                } else if(rdy_mobile_menu.data('menu-animation') === 'fadein') {
                    animation = {opacity: "0"};
                    animation_out = {opacity: ["1", "0"]};
                    items_animation = 'transition.fadeIn';
                }


                if (rdy_mobile_menu.hasClass('menu-opened')) {
                    PZPREFIX.showScrollBar();

                    jQuery('.menu-mobile > li, .mobile-text, .pzprefix-social-networks, .mobile_socials, #mobile-search', rdy_mobile_menu).velocity("stop").velocity({opacity: 0});

                    rdy_mobile_menu.velocity("stop").velocity(animation, {
                        duration: 800,
                        easing: [0.19, 1, 0.22, 1],
                        complete: function () {
                            rdy_mobile_menu.css({visibility: 'hidden'});
                        }
                    });
                    rdy_mobile_menu.removeClass('menu-opened');

                } else {
                    PZPREFIX.hideScrollBar();

                    rdy_mobile_menu.css({visibility: 'visible'}).velocity("stop").velocity(animation_out, {
                        duration: 900,
                        easing: [0.19, 1, 0.22, 1],
                        queue: false,
                        complete: function () {
                        }
                    });

                    rdy_mobile_menu.addClass('menu-opened');

                    if (items_animation) {
                        jQuery('.cta-button, .menu-mobile > li, .mobile-text, .pzprefix-social-networks, .mobile_socials, #mobile-search', rdy_mobile_menu).velocity(items_animation, {
                            delay: 200,
                            stagger: rdy_mobile_menu.data('menu-items-cascade') ? 150 : false,
                            duration: 1000,
                            easing: "ease-in"
                        });
                    }

                }

            }

        };

        jQuery('.vertical_menu_hidden_button, #vheader_overlay, .vertical_menu_area .label, #mobile-header .hamburger').on('click', function (e) {
            e.preventDefault();
            menuToggle();
        });

        var $vertical_menu_area__social_lock = false;

        jQuery('.vertical_menu_area .social_box__button').hoverIntent({
            over: function () {
                jQuery('.vertical_menu__social_box__items').addClass('hover');
            },
            out: function () {
                if (!$vertical_menu_area__social_lock) {
                    jQuery('.vertical_menu__social_box__items').removeClass('hover');
                    $vertical_menu_area__social_lock = false;
                }
            },
            timeout: 200,
            interval: 0
        });

        jQuery('.vertical_menu__social_box__items').on({
            mouseenter: function () {
                $vertical_menu_area__social_lock = true;
            },
            mouseleave: function () {
                jQuery('.vertical_menu__social_box__items').removeClass('hover');
                $vertical_menu_area__social_lock = false;
            }
        });


        var rdy_limit_height;
        var rdy_topbar_height = 0;
        var rdy_has_sticky_mobile = jQuery("body").hasClass('header-mobile-sticky');
        var rdy_has_sticky_menu = jQuery("body.header-type-classic.header-behaviour-sticky, body.header-type-classic.header-behaviour-shrink").exists();

        var rdy_header_scroll = function() {

            var isMobileResolution = window.innerWidth <= 992 ? true : false;

            if (jQuery('#top-bar').exists() && jQuery('#top-bar').css('display') !== 'none') {
                rdy_topbar_height = jQuery('#top-bar').innerHeight();
            } else {
                rdy_topbar_height = 0;
            }

            rdy_limit_height = rdy_topbar_height;

            var rdy_window_y = jQuery(window).scrollTop();
            var wpadminbar_height = 0;
            var top_margin = 0;

            if (jQuery('body.logo-hide-onscroll').exists() && jQuery('.vertical_menu_logo').exists()) {
                if (!jQuery('.vertical_menu_logo').data('ypos')) {
                    jQuery('.vertical_menu_logo').data('ypos', jQuery('.vertical_menu_logo').position().top + jQuery('.vertical_menu_logo').height() + 50);
                }

                var yshift = jQuery('.vertical_menu_logo').data('ypos') ? jQuery('.vertical_menu_logo').data('ypos') : 200;

                if (rdy_window_y > 150) {
                    if (jQuery('.vertical_menu_logo').hasClass('logo-hide')) {
                        TweenMax.to(jQuery('.vertical_menu_logo'), 1, {y: -yshift,
                        });
                        jQuery('.vertical_menu_logo').removeClass('logo-hide');
                    }

                } else {
                    if (!jQuery('.vertical_menu_logo').hasClass('logo-hide')) {
                        TweenMax.to(jQuery('.vertical_menu_logo'), 1, {y: 0,
                            ease: Power3.easeOut
                        });
                        jQuery('.vertical_menu_logo').addClass('logo-hide');
                    }
                }
            }

            if (jQuery("#wpadminbar").exists()) {
                wpadminbar_height = top_margin = jQuery("#wpadminbar").height();
            }

            if (rdy_window_y > rdy_limit_height && !isMobileResolution) {
                if (rdy_has_sticky_menu) {
                    if (!jQuery("#header").hasClass("set-fixed")) {
                        jQuery("#header").addClass("set-fixed").css({"top": top_margin});
                    }
                }
            } else if (rdy_has_sticky_mobile && wpadminbar_height && rdy_window_y > wpadminbar_height && window.innerWidth <= 600) {
                jQuery("#mobile-header").addClass("set-fixed").css("top", 0, 'important');

            } else if (rdy_has_sticky_mobile && wpadminbar_height && rdy_window_y < wpadminbar_height && window.innerWidth <= 600) {
                jQuery("#mobile-header").removeClass("set-fixed").css({"top": "auto"});

            } else {
                if (rdy_has_sticky_menu) {
                    if (jQuery("#header").hasClass("set-fixed")) {
                        jQuery("#header").removeClass("set-fixed").css({"top": "auto"});
                    }
                }

            }

        };


        rdy_header_scroll();
        var debounce_header_resize = debounce(function () {
            rdy_header_scroll();
        }, 100);
        window.addEventListener("resize", debounce_header_resize);


        var rdy_mobile_scroll_visible = false;
        var lastScrollY = 0;

        jQuery(window).scroll(function () {

            if (jQuery(this).scrollTop() > 50) {
                jQuery('.section-down-arrow').addClass('hidden');
            } else {
                jQuery('.section-down-arrow').removeClass('hidden');
            }

            if (jQuery('body.menu-opened').length && lastScrollY != window.pageYOffset) {
                lastScrollY = window.pageYOffset;
                menuToggle();
            }

            if (jQuery(window).width() > 992) {

                if (jQuery('.scroll-top-main').data('footer-stick') == "1") {
                    var offset = 0;

                    if (jQuery('.rdy-post-nav').length) {
                        offset = jQuery('.rdy-post-nav').height();
                    }

                    if (jQuery(window).scrollTop() > jQuery(document).height() - jQuery(window).height() - jQuery('#colophon').height()) {
                        jQuery('.scroll-top-main').css('position', 'absolute');
                        jQuery('.scroll-top-main').css('bottom', (jQuery('#colophon').height() + offset + 40) + 'px');
                    } else {
                        jQuery('.scroll-top-main').css('position', 'fixed');
                        jQuery('.scroll-top-main').css('bottom', (offset + 40) +  'px');
                    }
                }

                if (jQuery(this).scrollTop() > 500) {
                    jQuery('.scroll-top-main').css('display', 'block').velocity("stop").velocity({opacity: 0.5}, {
                        duration: 350,
                        easing: [0.19, 1, 0.22, 1],
                        queue: false,
                        complete: function () {
                        }
                    });
                } else {
                    jQuery('.scroll-top-main').velocity("stop").velocity({opacity: 0}, {
                        duration: 300,
                        easing: [0.19, 1, 0.22, 1],
                        queue: false,
                        complete: function () {
                            jQuery(this).css('display', 'none');
                        }
                    });
                }

            } else {

                if (jQuery(this).scrollTop() > 300 && ( jQuery('#bottom-bar').length ? jQuery(document).height() - jQuery(window).height() - jQuery('#bottom-bar').height() > jQuery(window).scrollTop() : true)) {
                    if (!rdy_mobile_scroll_visible) {
                        rdy_mobile_scroll_visible = true;
                        jQuery('.scroll-top-main-mobile').velocity("stop").velocity({translateY: 0}, {
                            duration: 150,
                            easing: [0.19, 1, 0.22, 1],
                            queue: false,
                            complete: function () {
                            }
                        });
                    }

                } else {
                    if (rdy_mobile_scroll_visible) {
                        rdy_mobile_scroll_visible = false;
                        jQuery('.scroll-top-main-mobile').velocity("stop").velocity({translateY: 60}, {
                            duration: 140,
                            easing: [0.19, 1, 0.22, 1],
                            queue: false,
                            complete: function () {
                            }
                        });
                    }
                }

            }

            rdy_header_scroll();

        });

        jQuery('body').on('click', '.section-down-arrow', function () {
            var $offset = jQuery('.single_post-title_area').height();

            if (jQuery(window).width() < 992) {
                $offset = $offset + 60;
            }

            jQuery('.single_post-title_area').velocity("stop").velocity('scroll', {
                duration: 1000,
                offset: $offset + 2,
                easing: 'easeInOutCubic'
            });
        });

        jQuery(".scroll-top, .scroll-top-main, .scroll-top-main-mobile").on("click", function(e) {
            e.preventDefault();
            jQuery("html, body").animate({scrollTop: 0}, {duration: 900, easing: "easeInOutExpo"});
            return false;
        });

        jQuery(".scroll-top-main").on('mouseenter', function(){
            TweenMax.to(jQuery(".scroll-top-main"), 0.35, {opacity: 1});
        }).on('mouseleave', function(){
            TweenMax.to(jQuery(".scroll-top-main"), 0.3, {opacity: 0.5});
        });


        if(typeof $('#header a').smoothScroll === 'function'){
            $('#header a, #menu-mobile a').smoothScroll({speed: 1000, easing: "easeInOutCubic", animationEngine: 'velocity'});

            $('.rdy_button, .wpb_single_image a, .vc_icon_element a, .wpb_text_column a, .vc_column_link, .vc_custom_heading a, .vc_btn3, .vc_icon_element-link').smoothScroll({speed: 1000, easing: "easeInOutCubic", animationEngine: 'velocity'});
        }


        var $animation_param = {duration: 300, easing: "easeInOut"};

        jQuery(".anm-arrow-left-hv").each(function () {
            jQuery(this).mouseenter(function() {
                jQuery(this).velocity("stop").velocity({translateX: -10}, $animation_param);

                if (!jQuery(this).hasClass('anm-arrow-mout')) {
                    jQuery(this).velocity({translateX: 0}, $animation_param);
                }
            });

            if (jQuery(this).hasClass('anm-arrow-mout')) {
                jQuery(this).mouseleave(function() {
                    jQuery(this).velocity("stop").velocity({translateX: 0}, $animation_param);
                });
            }
        });

        jQuery(".anm-arrow-right-hv").each(function () {
            jQuery(this).mouseenter(function() {
                jQuery(this).velocity("stop").velocity({translateX: 10}, $animation_param);

                if (!jQuery(this).hasClass('anm-arrow-mout')) {
                    jQuery(this).velocity({translateX: 0}, $animation_param);
                }
            });

            if (jQuery(this).hasClass('anm-arrow-mout')) {
                jQuery(this).mouseleave(function() {
                    jQuery(this).velocity("stop").velocity({translateX: 0}, $animation_param);
                });
            }
        });

        jQuery(".anm-arrow-up-hv").each(function () {
            jQuery(this).mouseenter(function() {
                jQuery(this).velocity("stop").velocity({translateY: -10}, $animation_param);

                if (!jQuery(this).hasClass('anm-arrow-mout')) {
                    jQuery(this).velocity({translateY: 0}, $animation_param);
                }
            });

            if (jQuery(this).hasClass('anm-arrow-mout')) {
                jQuery(this).mouseleave(function() {
                    jQuery(this).velocity("stop").velocity({translateY: 0}, $animation_param);
                });
            }
        });

        jQuery(".anm-arrow-down-hv").each(function () {
            jQuery(this).mouseenter(function() {
                jQuery(this).velocity("stop").velocity({translateY: 10}, $animation_param);

                if (!jQuery(this).hasClass('anm-arrow-mout')) {
                    jQuery(this).velocity({translateY: 0}, $animation_param);
                }
            });

            if (jQuery(this).hasClass('anm-arrow-mout')) {
                jQuery(this).mouseleave(function() {
                    jQuery(this).velocity("stop").velocity({translateY: 0}, $animation_param);
                });
            }
        });

        jQuery('.blog-archive.blog-hover-cross .title-wrapper, .section-portfolio.hover-cross .gallery-item-container').hover(
            function() {
                var $animation = { duration: 750, easing: [0.19, 1, 0.22, 1], queue: false };

                jQuery(this).find('.hover-element rect:eq(0)').velocity('stop').velocity(
                    {translateY: ['20px', 0]}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(1)').velocity('stop').velocity(
                    {translateX: ['-20px', 0]}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(2)').velocity('stop').velocity(
                    {translateY: ['-20px', 0]}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(3)').velocity('stop').velocity(
                    {translateX: ['20px', 0]}, $animation
                );

            }, function() {
                var $animation = { duration: 450, easing: [0.19, 1, 0.22, 1], queue: false };

                jQuery(this).find('.hover-element rect:eq(0)').velocity('stop').velocity(
                    {translateY: '0px'}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(1)').velocity('stop').velocity(
                    {translateX: '0px'}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(2)').velocity('stop').velocity(
                    {translateY: '0px'}, $animation
                );
                jQuery(this).find('.hover-element rect:eq(3)').velocity('stop').velocity(
                    {translateX: '0px'}, $animation
                );

            }
        );

        jQuery('.paginator .nav-prev, .paginator .nav-next, .rdy-post-prev, .rdy-post-next').on( "mouseover", function(){
            jQuery('.arrow-holder', jQuery(this)).addClass('hovered');
        }).on( "mouseleave", function(){
            jQuery('.arrow-holder', jQuery(this)).removeClass('hovered');
        });



        if ($('.wpcf7-form').length) {
            $('body').on('focus', '.wpcf7-form input, .wpcf7-form textarea', function () {
                $(this).parents('.action-form-input').addClass('filled').removeClass('no-text');
            });

            $('body').on('blur','.wpcf7-form input, .wpcf7-form textarea',function(){
                if($(this).val().length > 0) $(this).parents('.wpcf7-form-control-wrap').addClass('has-text').removeClass('no-text');
                else $(this).parents('.wpcf7-form-control-wrap').removeClass('has-text').addClass('no-text');

                if (!($(this).val().length > 0)) {
                    $(this).parents('.action-form-input').removeClass('filled');
                }
            });
        }

        function convertToActionStyle(el){

            $(el).each(function(){
                if($(this).parent().find('input:not([type="checkbox"]):not([type="hidden"]):not(#search-outer input):not(.adminbar-input):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="date"]):not([type="color"]):not([type="range"]):not([role="button"]):not([role="combobox"]):not(.select2-focusser):not([name="min_price"]):not([name="max_price"])').length == 1 || $(this).parent().find('textarea').length == 1) {

                    if($(this).parents('.action-form-input').length == 0) {
                        if($(this).next('input').length == 1) {

                            $(this).next('input').andSelf().wrapAll('<div class="action-form-input"/>');
                        } else if($(this).find('.wpcf7-form-control-wrap').length > 0) {
                            var $cloneInput = $(this).find('.wpcf7-form-control-wrap');
                            $(this).find('.wpcf7-form-control-wrap').remove();
                            $cloneInput.insertAfter($(this));
                            $(this).parent().wrapInner('<div class="action-form-input" />');
                        } else {
                            $(this).parent().wrapInner('<div class="action-form-input" />');
                        }
                        var $html = $(this).html();
                        $(this)[0].innerHTML = '<span class="text"><span class="text-inner">'+$html+'</span></span>';

                        if($(this).parent().find('textarea').length == 1) $(this).parents('.action-form-input').addClass('textarea');
                    }
                }

            });

            $(el).each(function(){
                if($(this).parents('.action-form-input').length == 1 && $(this).find('.text').length == 0) {
                    var $html = $(this).html();
                    $(this)[0].innerHTML = '<span class="text"><span class="text-inner">'+$html+'</span></span>';
                }
            });
        }

        setTimeout(function(){ convertToActionStyle('form.wpcf7-form label'); removeExcessLabels(); checkValueOnLoad(); }, 501);

        function removeExcessLabels() {
            $('.action-form-input').each(function(){
                if($(this).find('label').length > 1) {
                    $lngth = 0;
                    $(this).find('label').each(function(){
                        if($(this).text().length >= $lngth) {
                            $lngth = $(this).text().length;
                            $(this).parents('.action-form-input').find('label').addClass('tbr');
                            $(this).removeClass('tbr');
                        }
                    });
                    $(this).find('label.tbr').remove();
                }
            });
        }
        removeExcessLabels();


        function checkValueOnLoad() {
            $('.action-form-input input, .action-form-input textarea').each(function(){
                if($(this).val().length > 0) $(this).parents('.action-form-input').addClass('has-text').removeClass('no-text');
            });
        }
        checkValueOnLoad();

    };


    PZPREFIX.isotopeLayout = function() {

        if (jQuery('.iso-container').length > 0) {

            var itemQueue = [];
            var delayQueue = 300;
            var timerQueue;

            var isotopeContainersArray = [],
                filterItems = [];

            jQuery('[class*="iso-container"]').each(function() {
                var isoData = jQuery(this).data();
                isotopeContainersArray.push(jQuery(this));
            });

            var init_isotope = function() {
                for (var i = 0, len = isotopeContainersArray.length; i < len; i++) {
                    var $container = jQuery(isotopeContainersArray[i]);

                    if($container.hasClass('type-height')) {
                        itemsAnimation(jQuery('.grid-item', $container), 0, false, $container);
                        continue;
                    }

                    var this_container = $container;
                    init_isotope_container(this_container);
                }
            },

            init_isotope_container = function (this_container) {
                imagesLoaded( this_container, function () {
                    var transitionDuration = this_container.data('items-animation') ? 0 : '0.4s';

                    if (this_container.data('isotopeLayout') === 'grid') {
                        this_container.isotope({
                            transitionDuration: transitionDuration,
                            itemSelector: '.grid-item',
                            layoutMode: 'fitRows',
                            fitRows: {
                                // columnWidth: '.grid-sizer'
                            }
                        }).on('layoutComplete', onLayout(this_container, 0));
                    } else {
                        this_container.isotope({
                            transitionDuration: transitionDuration,
                            itemSelector: '.grid-item',
                            masonry: {}
                        }).on('layoutComplete', onLayout(this_container, 0));
                    }


                    if(this_container.find('video').length){
                        this_container.find('video').on('loadedmetadata', function(){
                            this_container.isotope('layout');
                        });
                    }
                    this_container.isotope('layout');

                    setTimeout(function(){
                        jQuery(window).trigger('resize');
                    }, 150);
                });

                jQuery(window).on('debouncedresize', function() {
                    if(window.skrollr) {
                        skrollr.get().refresh();
                    }
                });
            },

            itemEffectAnimate = function ($item, $fx, $queue) {
                var $animation = "transition.fadeIn";

                if ($fx === 'fadeIn') {
                    $animation = "transition.fadeIn";
                } else if ($fx === 'slideUpBigIn') {
                    $animation = "transition.slideUpBigIn";
                } else if ($fx === 'expandIn') {
                    $animation = "transition.expandIn";
                }

                var speed;
                var duration = 1000;
                var delay = 500;

                if ($queue) {
                    duration = 750;
                    delay = 0;
                } else {
                    if (speed === 'fast') {
                        duration = 900;
                        delay = 300;
                    }
                }

                jQuery('> .hentry', $item).removeClass('fade-out').addClass('start_animation');
                jQuery('> .hentry', $item).velocity('stop').velocity($animation, {
                    duration: duration,
                    delay: delay,
                    drag: true,
                    display: 'auto',
                    easing: [0.17, 0.67, 0.83, 0.67]
                });
            },

            itemEffectQueue = function($fx){
                if (timerQueue) {
                    return;
                }

                timerQueue = window.setInterval(function () {
                    if (!itemQueue.length){
                        window.clearInterval(timerQueue);
                        timerQueue = null;
                    }

                    if (itemQueue.length) {
                        var $item = jQuery(itemQueue.shift());
                        itemEffectAnimate($item, $fx, true);
                        itemEffectQueue($fx);
                    }
                }, delayQueue);
            },

            setWaypoint = function($item, $type_animation, $queue, offset){
                $item.waypoint(function (direction) {
                    if ($queue) {
                        itemQueue.push(this);
                        itemEffectQueue($type_animation);
                    } else {
                        itemEffectAnimate(jQuery(this), $type_animation, false);
                    }
                }, {offset: offset, triggerOnce: true});
            },

            onLayout = function (container, startIndex, speed) {

                var $type_animation = container.data('items-animation');
                var $type_animation_queue = container.data('items-animation-queue');

                if ($type_animation) {
                    var offset = '85%';

                    if ($type_animation_queue) {
                        offset = '95%';
                    }

                    $.each(container.find('.grid-item'), function (index, val) {
                        if (jQuery(val).hasClass('do-animation')) {
                            setWaypoint(jQuery(val), $type_animation, $type_animation_queue, offset);
                        }
                    });
                }
            },

            itemsAnimation = function(items, startIndex, arrange, container) {
                var $allItems = items.length - startIndex,
                    showed = 0,
                    index = 0;

                var $type_animation = container.data('items-animation');
                var $type_animation_queue = container.data('items-animation-queue');

                if ($type_animation) {
                    var offset = '85%';

                    if ($type_animation_queue) {
                        offset = '95%';
                    }

                    $.each(items, function (index, val) {
                        var $el;

                        if (arrange) {
                            $el = jQuery(val.element);
                        } else {
                            $el = jQuery(val);
                        }

                        setWaypoint($el, $type_animation, $type_animation_queue, offset);
                    });
                }
            },

            init_infinite = function(){
                var $containers = jQuery('.infinite-scroll .iso-container');
                var is_masonry = jQuery('.infinite-scroll .rdy-masonry, .infinite-scroll .rdy-grid').length ? true : false;
                var $container;

                if($containers.length > 0) {
                    $container = jQuery($containers[0]);

                    $container.infinitescroll({
                            navSelector: '.paginator .page-nav',
                            nextSelector: '.paginator .page-nav a:first',
                            itemSelector: '.grid-item',
                            animate: false,
                            maxPage: jQuery('.paginator').data('max-pages'),
                            loading: {
                                finishedMsg: "",
                                msg: jQuery('<div class="loader"><div class="circle"></div></div>'),
                                msgText: "",
                                selector: ".infinite-loading",
                                speed: 0
                            },
                            errorCallback: function () {
                                jQuery(".infinite-loading, .rdy-load-more").hide(0);
                            }
                        },
                        function (newElements) {
                            var $newElems = jQuery(newElements);
                            $container.append($container.find('.grid-sizer'));

                            if (is_masonry) {
                                $newElems.imagesLoaded(function () {
                                    $container.isotope('appended', $newElems);
                                });

                                jQuery(window).trigger('resize');
                            }

                            itemsAnimation(newElements, 0, false, $container);
                        }
                    );

                    if ($container.hasClass('load-button-style')) {
                        jQuery(window).unbind('.infscr');
                        jQuery('.rdy-load-more').click(function (e) {
                            e.preventDefault();
                            $container.infinitescroll('retrieve');
                            return false;
                        });
                    }
                }
            };

            jQuery('.rdy_gallery.hover-elem-cross .grid-item').hover(
                function() {
                    var $animation = { duration: 750, easing: [0.19, 1, 0.22, 1], queue: false };

                    jQuery(this).find('.hover-element rect:eq(0)').velocity('stop').velocity(
                        {translateY: ['20px', 0]}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(1)').velocity('stop').velocity(
                        {translateX: ['-20px', 0]}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(2)').velocity('stop').velocity(
                        {translateY: ['-20px', 0]}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(3)').velocity('stop').velocity(
                        {translateX: ['20px', 0]}, $animation
                    );

                }, function() {
                    var $animation = { duration: 450, easing: [0.19, 1, 0.22, 1], queue: false };

                    jQuery(this).find('.hover-element rect:eq(0)').velocity('stop').velocity(
                        {translateY: '0px'}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(1)').velocity('stop').velocity(
                        {translateX: '0px'}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(2)').velocity('stop').velocity(
                        {translateY: '0px'}, $animation
                    );
                    jQuery(this).find('.hover-element rect:eq(3)').velocity('stop').velocity(
                        {translateX: '0px'}, $animation
                    );

                }
            );

            init_isotope();
        }
    };

    PZPREFIX.initLightbox = function () {

        jQuery('#section-project-wall.lightbox-gallery, .section-portfolio.lightbox-gallery').each(function () {
            var $lg = jQuery(this);
            $lg.lightGallery({
                selector: '.gallery-item-container a',
                mode: 'lg-fade',
                startClass: 'lg-start-fade',
                cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                download: false,
                thumbMargin: 0,
                fullScreen: true,
                counter: jQuery(this).data('lightbox-counter') ? true : false,
            });

            $lg.on('onAfterOpen.lg', function (event) {
                PZPREFIX.hideScrollBar();
            });

            $lg.on('onBeforeClose.lg', function (event) {
                PZPREFIX.showScrollBar();
            });
        });

        if ($(".rdy-video-lightbox").magnificPopup) {
            jQuery(".rdy-video-lightbox").magnificPopup({
                type: "iframe",
                mainClass: 'mfp-zoom-in',
                fixedContentPos: false,
                closeBtnInside: false,
                closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
                removalDelay: 400
            });

            $('.rdy-video-lightbox').on('click', function (e) {
                return false;
            });
        }

    };

    PZPREFIX.initFx = function() {
        $('.vc_row > .row-overlay.filmgrain, .wpb_single_image .img-overlay.filmgrain').each(function(){
            var uid = rdy_guid();
            var $this = $(this);
            $(this).prepend('<canvas id="' + uid + '"></canvas>');

            var canvas = document.getElementById(uid);

            var viewWidth,
                viewHeight,
                ctx;

            var patternSize = 100,
                patternScaleX = 1,
                patternScaleY = 1,
                patternRefreshInterval = 5,
                patternAlpha = 60;

            var patternPixelDataLength = patternSize * patternSize * 4,
                patternCanvas,
                patternCtx,
                patternData,
                frame = 0;

            function initCanvas() {
                viewWidth = canvas.width = canvas.clientWidth;
                viewHeight = canvas.height = canvas.clientHeight;
                ctx = canvas.getContext('2d');
                ctx.scale(patternScaleX, patternScaleY);
            }


            function initGrain() {
                patternCanvas = document.createElement('canvas');
                patternCanvas.width = patternSize;
                patternCanvas.height = patternSize;
                patternCtx = patternCanvas.getContext('2d');
                patternData = patternCtx.createImageData(patternSize, patternSize);
            }

            function update() {
                var value;

                for (var i = 0; i < patternPixelDataLength; i += 4) {
                    value = (Math.random() * 255) || 0;

                    patternData.data[i] = value;
                    patternData.data[i + 1] = value;
                    patternData.data[i + 2] = value;
                    patternData.data[i + 3] = patternAlpha;
                }

                patternCtx.putImageData(patternData, 0, 0);
            }


            function draw() {
                if (ctx) {
                    ctx.clearRect(0, 0, viewWidth, viewHeight);
                    ctx.fillStyle = ctx.createPattern(patternCanvas, 'repeat');
                    ctx.fillRect(0, 0, viewWidth, viewHeight);
                }
            }

            function loop() {
                if (++frame % patternRefreshInterval === 0) {
                    update();
                    draw();
                }

                requestAnimationFrame(loop);
            }

            $(this).imagesLoaded( function () {
                initCanvas();
                initGrain();
                requestAnimationFrame(loop);
            });

            function resizeCanvas() {
                viewWidth = canvas.width = $this.width();
                viewHeight = canvas.height = $this.height();
                draw();
            }

            window.addEventListener('resize', resizeCanvas, false);
            $(this).resize(resizeCanvas);
        });

        $('.wpb_single_image .img-overlay.glitch').each(function(){
            var glitch = new GlitchFx();
            glitch.setImagePath($(this).data('img-src'), false);
            $(this).append(glitch.domElement);
        });
    };

    PZPREFIX.init_vc_row = function() {

        /**
         *  VC vc_rowBehaviour Rewrite
         */

        window.vc_rowBehaviour = function () {
            var $ = window.jQuery;

            function parallaxRow() {
                var parallaxRows = [];
                var speedDivider = 0.25;
                var bodyTop = document.documentElement.scrollTop || document.body.scrollTop;
                var wwidth = window.innerWidth || document.documentElement.clientWidth;
                var wheight = window.innerHeight || document.documentElement.clientHeight;

                var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;

                $(".vc_parallax-inner").remove();
                $(".vc_parallax[data-vc-parallax]").each(function () {
                    if ("on" === $(this).data("vcParallaxOFade")) {
                        $(this).children('.row-container').children('.row-inner').attr("data-5p-top-bottom", "opacity:0;").attr("data-50p-top-bottom", "opacity:1;");
                    }

                    var $parallaxElement = $("<div/>").addClass("vc_parallax-inner").appendTo($(this));
                    parallaxImage = $(this).data("vcParallaxImage");
                    youtubeId = vcExtractYoutubeId(parallaxImage);
                    if (youtubeId) {
                        insertYoutubeVideoAsBackground($parallaxElement, youtubeId);
                    } else if("undefined" !== typeof parallaxImage) {
                        $parallaxElement.css("background-image", "url(" + parallaxImage + ")");
                    }

                    parallaxRows.push($parallaxElement);
                });

                var setParallaxOffset = function(el, valueY) {
                    var translate = 'translate3d(0, ' + valueY + 'px' + ', 0)';
                    el.css({
                        '-webkit-transform': translate,
                        '-moz-transform': translate,
                        '-ms-transform': translate,
                        '-o-transform': translate,
                        'transform': translate
                    });
                };

                var parallaxRowCol = function(bodyTop) {
                    var offsetValue;
                    if (typeof parallaxRows === 'object') {
                        for (var i = 0; i < parallaxRows.length; i++) {
                            var parallaxRow = parallaxRows[i];
                            var holder = parallaxRows[i].parent(),

                                thisHeight = parallaxRow.outerHeight(),
                                sectionHeight = holder.outerHeight(),
                                offSetTop = bodyTop + (holder !== null ? holder.get(0).getBoundingClientRect().top : 0),
                                offSetPosition = wheight + bodyTop - offSetTop;

                            if (offSetPosition > 0 && offSetPosition < (sectionHeight + wheight)) {
                                offsetValue = ((offSetPosition - wheight) * speedDivider);

                                if (Math.abs(offsetValue) < (thisHeight - sectionHeight)) {
                                    setParallaxOffset(parallaxRow, offsetValue);
                                } else {
                                    setParallaxOffset(parallaxRow, thisHeight - sectionHeight);
                                }
                            }
                        }
                    }
                };

                var scrollFunction = function() {
                    parallaxRowCol(bodyTop);
                };

                window.addEventListener('scroll', function(e) {
                    bodyTop = document.documentElement.scrollTop || document.body.scrollTop;
                    scrollFunction();
                }, false);

                parallaxRowCol(bodyTop);

                if (window.skrollr) {
                    var vcSkrollrOptions = {
                        forceHeight: !1,
                        smoothScrolling: !1,
                        mobileCheck: function () {
                            return false;
                        }
                    }
                    window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions)
                }

            }

            function fullHeightRow() {
                var $element = $(".vc_row-o-full-height:first");
                if ($element.length) {
                    var $window, windowHeight, offsetTop, fullHeight;
                    $window = $(window);
                    windowHeight = $window.height();
                    offsetTop = $element.offset().top;

                    if (windowHeight > offsetTop) {
                        fullHeight = 100 - offsetTop / (windowHeight / 100);
                        $element.css("min-height", fullHeight + "vh");
                    }
                }
                $(document).trigger("vc-full-height-row", $element);
            }

            // VC-mod
            function rdyFixIeFlexbox() {
                var ua = window.navigator.userAgent, msie = ua.indexOf("MSIE ");
                if (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) {
                    $(".rdy_vc_row-o-full-height").each(function () {
                        $(this).addClass('rdy_vc_ie-flexbox-fixer');
                    });
                }

                if (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) {
                    $(".rdy_vc_row-o-equal-height > .row-container > .row-inner").each(function () {
                        if("flex" === $(this).css("display")) {
                            $(this).find('.vc_column-inner > .wpb_wrapper').addClass('rdy_vc_ie-flexbox-fixer-h');
                        }
                    });
                }
            }

            $(window).off("resize.vcRowBehaviour"); fullHeightRow(); rdyFixIeFlexbox(); vc_initVideoBackgroundsYV(); parallaxRow();

        };

        /**
         *  END ## VC vc_rowBehaviour Rewrite
         */

        function vcExtractVimeoId(url) {
            if ("undefined" == typeof url) {
                return !1;
            }
            var id = url.match(/(http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)/);
            return null !== id && id[4];
        }

        function vc_initVideoBackgroundsYV() {
            jQuery("[data-vc-video-bg]").each(function () {
                var youtubeUrl,
                    youtubeId,
                    vimeoId,
                    $element = jQuery(this);

                $element.data("vcVideoBg") ? (
                    youtubeUrl = $element.data("vcVideoBg"),
                        youtubeId = vcExtractYoutubeId(youtubeUrl),
                        vimeoId = vcExtractVimeoId(youtubeUrl),
                    youtubeId && (
                        $element.find(".vc_video-bg").remove(),
                            insertYoutubeVideoAsBackground($element, youtubeId)
                    ),
                    vimeoId && (
                        $element.find(".vc_video-bg").remove(),
                            insertVimeoVideoAsBackground($element, vimeoId)
                    ),
                        jQuery(window).on("grid:items:added", function (event, $grid) {
                            $element.has($grid).length && vcResizeVideoBackground($element);
                        })
                ) :
                    $element.find(".vc_video-bg").remove();
            });
        }

        function insertVimeoVideoAsBackground($element, vimeoId, counter) {
            var $container = $element.prepend('<div class="vc_video-bg vc_hidden-xs"><div class="inner"><iframe src="https://player.vimeo.com/video/' + vimeoId + '?wmode=opaque&background=1&api=1&autoplay=1&loop=1&player_id=video_' + vimeoId + '&title=0&byline=0&portrait=0&color=" id="video_' + vimeoId + '" width="640" height="320" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>').find(".inner");
            $element.data('provider', 'vimeo');

            var player = $f($element.find('iframe')[0]);
            player.addEvent('ready', function() {
                player.api('setVolume', 0);
            });

            vcResizeVideoBackground($element), jQuery(window).bind("resize", function () {
                vcResizeVideoBackground($element);
            });
        }

        jQuery(".wpb_tour_tabs_wrapper").on( "tabsactivate tabsshow", function( event, ui ) {
            var panel = ui.panel || ui.newPanel;
            panel.find(".iso-container").length && panel.find(".iso-container").each(function () {
                jQuery(this).isotope("layout");
            });
        } );

        jQuery(".wpb_accordion_wrapper").on( "accordionactivate accordionchange", function( event, ui ) {
            var panel = ui.panel || ui.newPanel;
            panel.find(".iso-container").length && panel.find(".iso-container").each(function () {
                jQuery(this).isotope("layout");
            });
        } );

        function vcResizeVideoBackground($element) {
            var iframeW,
                iframeH,
                marginLeft,
                marginTop,
                containerW = $element.innerWidth(),
                containerH = $element.innerHeight(),
                ratio1 = 16,
                ratio2 = 9,
                a = 5,
                ratio,
                controls_remove = 50;

            ratio = ratio1 / ratio2;

            if(containerW / containerH < ratio1 / ratio2) {
                iframeW = containerH * (ratio1 / ratio2);
                iframeH = containerH;
            } else {
                iframeW = containerW;
                iframeH = containerW * (ratio2 / ratio1);
            }

            if($element.data('provider') === 'vimeo'){
                iframeH = iframeH + controls_remove * 2;
                iframeW = ratio * iframeH;
            }

            marginTop = -Math.round((iframeH - containerH) / 2) + "px";
            marginLeft = -Math.round((iframeW - containerW) / 2) + "px";
            iframeW += "px";
            iframeH += "px";

            $element.find(".vc_video-bg iframe").css({
                maxWidth: "1000%",
                marginLeft: marginLeft,
                marginTop: marginTop,
                width: iframeW,
                height: iframeH
            });

        }


        var min_w = 1200; // minimum video width allowed
        var vid_w_orig;  // original video dimensions
        var vid_h_orig;

        vid_w_orig = 1280;
        vid_h_orig = 720;


        function resizeVideoToCover() {
            if(rdyGlobals.isMobile) {
                return false;
            }

            $('.vc_row > video').each(function(){

                var container = $(this).parent('.vc_row'),
                    video = $(this);

                var width = container.outerWidth(),
                    height = container.outerHeight(),
                    pWidth,
                    pHeight,
                    ratio = 1.777777,
                    heightOffset = 0,
                    widthOffset = heightOffset * ratio;

                if (container.data('video-ratio')) {
                    ratio = container.data('video-ratio');
                }

                if (width / ratio < height) {
                    pWidth = Math.ceil((height + heightOffset) * ratio);
                    video.css({
                        width: pWidth + widthOffset + 'px',
                        height: height + heightOffset + 'px',
                        left: ((width - pWidth) / 2) - (widthOffset / 2) + 'px',
                        top: '-' + (heightOffset / 2) + 'px'
                    });

                } else {
                    pHeight = Math.ceil(width / ratio);
                    video.css({
                        width: width + widthOffset + 'px',
                        height: pHeight + heightOffset + 'px',
                        left: '-' + (widthOffset / 2) + 'px',
                        top: ((height - pHeight) / 2) - (heightOffset / 2) + 'px'
                    });
                }

                if (!video.data('show')) {
                    video.css('opacity', 1);
                }

            });

            $('.site-content.project .illustrations-container .illustrations .illustration-inner[data-video="1"]').each(function(i){
                var $containerHeight;
                var $containerWidth;
                var $container = $('.mejs-container', $(this));

                if($(this).parents('#page-header-bg').length > 0) {
                    if($('.container-wrap.auto-height').length > 0) {
                        return false;
                    }
                    $containerHeight = $(this).parents('#page-header-bg').outerHeight();
                    $containerWidth = $(this).parents('#page-header-bg').outerWidth();
                } else if($(this).parents('.illustration').length > 0) {
                    if($('.container-wrap.auto-height').length > 0) {
                        return false;
                    }
                    $containerHeight = $(this).parents('.illustration').outerHeight();
                    $containerWidth = $(this).parents('.illustration').outerWidth();
                } else {
                    $containerHeight = $(this).parents('.wpb_row').outerHeight();
                    $containerWidth = $(this).parents('.wpb_row').outerWidth();
                }

                $container.width($containerWidth);
                $container.height($containerHeight);

                var scale_h = $containerWidth / vid_w_orig;
                var scale_v = ($containerHeight - $containerHeight) / vid_h_orig;
                var scale = scale_h > scale_v ? scale_h : scale_v;

                min_w = 1280/720 * ($containerHeight+40);

                if (scale * vid_w_orig < min_w) {scale = min_w / vid_w_orig;}

                $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * vid_w_orig +0));
                $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * vid_h_orig +0));

                $container.css('left', -($(this).find('video').width() - $containerWidth) / 2);
                $container.css('top', -($(this).find('video').height() - ($containerHeight)) / 2);

            });
        }

        setTimeout(function () {
            resizeVideoToCover();
        }, 300);

        jQuery(window).resize(function () {
            resizeVideoToCover();
        });

    };

    PZPREFIX.initCascadeAnimation = function() {

        $.Velocity.RegisterUI("pzprefix.slideUpIn", {
            defaultDuration: 900,
            calls: [
                [ { opacity: [ 1, 0 ], translateY: [ 0, 50 ], translateZ: 0 } ]
            ]
        });

        $('.vc_row[data-csd-animation], .wpb_column[data-csd-animation]').each(function(){
            var $obj = $(this);
            var animation = $obj.data('csd-animation') ? $obj.data('csd-animation') : "transition.fadeIn";
            var stagger = $obj.data('csd-animation-delay') ? $obj.data('csd-animation-delay') : 600;
            var duration = $obj.data('csd-animation-duration') ? $obj.data('csd-animation-duration') : 600;

            $(this).waypoint(function(direction) {
                if (direction === 'down' && !$obj.data('vanimated')) {
                    $obj.data('vanimated', 1);

                    if ($obj.hasClass('vc_row')) {
                        $('> .row-container > .row-inner > .wpb_column', $obj).velocity(animation, {
                            display: "flex",
                            delay: 400,
                            stagger: stagger,
                            duration: duration,
                            easing: "ease-in",
                            begin: function(elements) { $(this).css({opacity: 1}); }
                        });
                    } else if ($obj.hasClass('wpb_column')) {
                        $('> .vc_column-inner > .wpb_wrapper > *', $obj).velocity(animation, {
                            delay: 400,
                            stagger: stagger,
                            duration: duration,
                            easing: "ease-in",
                            begin: function(elements) { $(this).css({opacity: 1}); }
                        });
                    }
                }

            }, { offset: '80%' });

        });
    };

    PZPREFIX.init_vc_column = function() {

        $(".animate-element:not(.start-animation):not(.client-logo)").each(function () {
            var $this = $(this);

            $(this).waypoint(function(direction) {
                if (direction === 'down' && $this.data('animation-class')) {
                    if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
                        $this.addClass("animation-triggered");

                        $this.addClass($this.data('animation-class'));
                        $this.addClass("start-animation animated");
                        $this.css("opacity", "1");
                    }
                }

            }, { offset: '100%' });


            if($(this).hasClass('animate-loop')){
                $(this).waypoint(function(direction) {
                    if (direction === 'up' && $this.data('animation-class') && $this.hasClass("start-animation")) {
                        $this.removeClass($this.data('animation-class'));
                        $this.removeClass("start-animation animated animation-triggered");
                        $this.css("opacity", "0");
                    }

                }, { offset: '110%' });
            }
        });

    };

    PZPREFIX.init_vc_custom_heading = function() {

        $(".vc_custom_heading[data-text-animate]").each(function () {
            var $this = $(this);

            $(this).waypoint(function(direction) {
                if (direction === 'down' && !$this.hasClass('text-animation-triggered')) {
                    var delay = 0;

                    if ( $this.data('text-animate-delay') ) {
                        delay = $this.data('text-animate-delay');
                    }

                    var $animation = "transition.fadeIn";

                    if ($this.data('text-animate-type') === 'fadeIn') {
                        $animation = "transition.fadeIn";
                    }
                    else if ($this.data('text-animate-type') === 'slideUpIn') {
                        $animation = "transition.slideUpIn";
                    }

                    var $text_animation_param;

                    if ($this.data('text-animate') === 'char') {
                        $text_animation_param = {
                            stagger: 250, duration: 550
                        };

                        if ( $this.data('text-animate-speed') === 'fast' ) {
                            $text_animation_param = {
                                stagger: 100, duration: 200
                            };
                        } else if ( $this.data('text-animate-speed') === 'middle' ) {
                            $text_animation_param = {
                                stagger: 160, duration: 300
                            };
                        }

                        $this.find('span').blast({delimiter: "word"});

                        setTimeout(function () {
                            $this.addClass('text-animation-triggered');
                            $this.find('.blast-root span.blast').each(function(){
                                $(this).removeClass('blast');
                                $(this).blast({ delimiter: "char", tag: "em" });
                            });
                            $this.find('.blast-root em.blast').velocity($animation, $text_animation_param);
                        }, delay);
                    } else if($this.data('text-animate') === 'word') {
                        $text_animation_param = {
                            stagger: 800, duration: 1000
                        };

                        if ( $this.data('text-animate-speed') === 'fast' ) {
                            $text_animation_param = {
                                stagger: 250, duration: 500
                            };
                        } else if ( $this.data('text-animate-speed') === 'middle' ) {
                            $text_animation_param = {
                                stagger: 400, duration: 600
                            };
                        }

                        setTimeout(function () {
                            $this.addClass('text-animation-triggered');
                            $this.find('span').blast({delimiter: "word"}).velocity($animation, $text_animation_param);
                        }, delay);

                    }

                }

            }, { offset: '100%' });

        });

    };

    PZPREFIX.init_vc_clientlist = function() {

        $('.rdy-owlslider.rdy-client_list').each(function () {
            $(this).find('.rdy-owl-slides').owlCarousel({
                autoplay: $(this).data('autoplay'),
                smartSpeed: $(this).data('animationSpeed'),
                autoplayTimeout: $(this).data('autoplayTimeout') ? $(this).data('autoplayTimeout') : 4000,
                autoplayHoverPause: $(this).data('pauseonhover'),
                items: $(this).data('maxitems'),
                loop: true,
                responsiveClass: true,
                dots: false,
                nav: false,
                responsive : {
                    0 : {
                        items: 2
                    },
                    768 : {
                        items: $(this).data('maxitems')
                    }
                }
            });
        });

        $('.rdy-client_list.column-style').each(function() {
            var group = $(this),
                list = group.find('li'),
                listStyle = group.find('ul').attr('style'),
                fullRowColumns = group.find('ul:first-of-type li').length,
                viewport = $(window),
                viewportWidth = viewport.innerWidth(),
                breakPoint1 = 960 - 25,
                breakPoint2 = 767 - 25,
                breakPoint3 = 550 - 25;

            if(listStyle === undefined) {
                listStyle = '';
            }

            function redrawClientGrid() {
                if (viewportWidth > breakPoint1) {
                    list.unwrap();
                    for (var i = 0; i < list.length; i += fullRowColumns) {
                        list.slice(i, i + fullRowColumns)
                            .wrapAll('<ul style="' + listStyle + '"></ul>');
                    }
                } else if (viewportWidth < breakPoint2) {
                    list.unwrap();
                    for (var i = 0; i < list.length; i += 2) {
                        list.slice(i, i + 2).wrapAll('<ul class="rdy-clients-fixed-list" style="' + listStyle + '"></ul>');
                    }
                } else if (viewportWidth < breakPoint1) {
                    list.unwrap();
                    for (var i = 0; i < list.length; i += 3) {
                        list.slice(i, i + 3).wrapAll('<ul class="rdy-clients-fixed-list" style="' + listStyle + '"></ul>');
                    }
                }
            }
            redrawClientGrid();

            $(window).on('debouncedresize', function() {
                viewportWidth = viewport.innerWidth();
                redrawClientGrid();
            });

        });

        $(".rdy-client_list.with-animation-fadein:not(.is-hover)").each(function () {
            var $this = $(this);
            var repeatOnce = true;

            if ($this.hasClass('animate-loop')) {
                repeatOnce = false;
            }

            $(this).waypoint(function(direction) {
                if (direction === 'down') {
                    var delay = 0;
                    $this.find('.client-logo').each(function () {
                        $(this).velocity("stop").velocity({opacity: 1}, {
                            duration: 300,
                            delay: delay
                        });
                        delay = delay + 300;
                    });

                }

            }, { offset: '95%', triggerOnce: repeatOnce });

            if($this.hasClass('animate-loop')){
                $(this).waypoint(function(direction) {
                    if (direction === 'up') {
                        $this.find('.client-logo').velocity("stop").css({'opacity': 0});
                    }

                }, { offset: '110%', triggerOnce: repeatOnce });
            }

        });

    };

    PZPREFIX.init_vc_counter = function() {
        function initCounterRandom() {

            if ($('.rdy_counter_holder.random').length) {
                $('.rdy_counter_holder.random').each(function () {
                    var $counter = $(this).find('.counter .digit');

                    if (!$counter.hasClass('executed')) {
                        $counter.addClass('executed');

                        var animation = $counter.data('animation'),
                            speed = $counter.data('speed') ? $counter.data('speed') : 2000,
                            delay = $counter.data('delay') ? $counter.data('delay') : 0;
                        var obj_this = this;

                        $counter.waypoint(function (direction) {
                            $(obj_this).css('opacity', '1');
                            $counter.absoluteCounter({
                                speed: speed,
                                fadeInDelay: 1000,
                                onComplete: function () {
                                    if (animation) {
                                        $counter.velocity({
                                            scaleX: 1.1,
                                            scaleY: 1.1,
                                            opacity: 0.8
                                        }, 50, {easing: "easeOutElastic"})
                                            .velocity({
                                                scaleX: 1,
                                                scaleY: 1,
                                                opacity: 1
                                            }, 100, {easing: "easeOutElastic"});
                                    }
                                }
                            });

                        }, {offset: '90%', triggerOnce: true});
                    }
                });
            }
        }


        function initToCounter() {

            if ($('.rdy_counter_holder.zero').length) {
                $('.rdy_counter_holder.zero').each(function () {
                    var $counter = $(this).find('.counter .digit');

                    if (!$counter.hasClass('executed')) {
                        $counter.addClass('executed');
                        var obj_this = this;
                        var repeatOnce = $counter.data('repeat') ? false : true;

                        var useOnComplete = false,
                            useEasing = true,
                            useGrouping = true,
                            animation = $counter.data('animation'),
                            duration = $counter.data('speed') ? $counter.data('speed') / 1000 : 2.5,
                            options = {
                                useEasing: true,
                                useGrouping: true,
                                separator: $counter.data('separator') ? $counter.data('separator') : ''
                            };

                        $counter.waypoint(function (direction) {
                            if (direction === 'down') {
                                setTimeout(function () {
                                    $(obj_this).css('opacity', '1');

                                    var numAnim = new CountUp($counter[0], 0, $counter.data('count'), 0, duration, options);
                                    numAnim.start(function () {
                                        if (animation) {
                                            $(obj_this).velocity("stop").velocity({
                                                scaleX: 1.1,
                                                scaleY: 1.1
                                            }, {duration: 100, easing: "easeInOut"})
                                                .velocity({scaleX: 1, scaleY: 1}, {duration: 600, easing: [200, 8]});

                                            setTimeout(function () {
                                                $(obj_this).css({opacity: 0.3}).velocity({
                                                    opacity: 1
                                                }, {duration: 1000, queue: false, easing: "easeOutExpo"});
                                            }, 0);

                                        }
                                    });
                                }, $(obj_this).data('delay') ? $counter.data('delay') : 0);
                            }
                        }, {offset: '90%', triggerOnce: repeatOnce});

                    }
                });
            }
        }


        function initCounterMotion() {
            $('.rdy_counter_holder.motion').each(function () {
                var $counter = $(this).find('.counter');

                if ($counter.is('[data-symbol]')) {
                    if ($counter.attr('data-symbol-pos') === 'before') {
                        $counter.find('.digit').prepend('<div class="symbol-wrap"><span class="symbol">' + $counter.attr('data-symbol') + '</span></div>');
                    } else {
                        $counter.find('.digit').append('<div class="symbol-wrap"><span class="symbol">' + $counter.attr('data-symbol') + '</span></div>');
                    }

                    var $symbol_size = ( $counter.attr('data-symbol-size') === $counter.find('.digit').attr('data-number-size') );
                    $counter.find('.symbol-wrap').css({
                        'font-size': $symbol_size + 'px',
                        'line-height': $symbol_size + 'px'
                    });
                }

                $counter.find('.digit').css({
                    'font-size': $counter.find('.digit').attr('data-number-size') + 'px',
                    'line-height': $counter.find('.digit').attr('data-number-size') + 'px'
                });
            });

            if (!$('body').hasClass('mobile')) {

                var $blurCssString = '';
                $('.rdy_counter_holder.motion').each(function (i) {
                    var $counter = $(this).find('.counter');

                    $counter.addClass('instance-' + i);

                    var $currentColor = $counter.find('.digit').css('color');
                    var rgb = $currentColor.match(/^rgb\((\d+)\,\s*(\d+)\,\s*(\d+)\)$/);
                    var R = rgb[1];
                    var G = rgb[2];
                    var B = rgb[3];

                    var $rgbaColor0 = 'rgba(' + R + ',' + G + ',' + B + ',0.2)';
                    var $rgbaColor1 = 'rgba(' + R + ',' + G + ',' + B + ',1)';
                    var $numberSize = parseInt($counter.find('.digit').css('font-size'), 10);

                    $blurCssString += '@keyframes motion-blur-number-' + i + ' { ' +
                        ' 0% { ' +
                        'color: ' + $rgbaColor0 + '; ' +
                        'text-shadow: 0 ' + $numberSize / 20 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 10 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 6 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 5 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 4 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 20 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 10 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 6 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 5 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 4 + 'px 0 ' + $rgbaColor0 + '; ' +
                        'opacity: 0; transform: translateZ(0px) translateY(-100%); -webkit-transform: translateZ(0px) translateY(-100%); ' +
                        '} ' +
                        '35% { opacity: 1 }' +
                        '100% { ' +
                        'color: ' + $rgbaColor1 + '; ' +
                        'text-shadow: none; ' +
                        'transform: translateZ(0px) translateY(0px); -webkit-transform: translateZ(0px) translateY(0px); ' +
                        '} ' +
                        '} ' +
                        '@-webkit-keyframes motion-blur-number-' + i + ' { ' +
                        ' 0% { ' +
                        'color: ' + $rgbaColor0 + '; ' +
                        'text-shadow: 0 ' + $numberSize / 20 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 10 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 6 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 5 + 'px 0 ' + $rgbaColor0 + ', 0 ' + $numberSize / 4 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 20 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 10 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 6 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 5 + 'px 0 ' + $rgbaColor0 + ', 0 -' + $numberSize / 4 + 'px 0 ' + $rgbaColor0 + '; ' +
                        'opacity: 0; transform: translateZ(0px) translateY(-100%); -webkit-transform: translateZ(0px) translateY(-100%); ' +
                        '} ' +
                        '35% { opacity: 1 }' +
                        '100% { ' +
                        'color: ' + $rgbaColor1 + '; ' +
                        'text-shadow: none; ' +
                        'transform: translateZ(0px) translateY(0px); -webkit-transform: translateZ(0px) translateY(0px); ' +
                        '} ' +
                        '} ' +
                        '.rdy_counter_holder .counter.motion.instance-' + i + ' .digit span.in-sight { animation: 0.65s cubic-bezier(0, 0, 0.17, 1) 0s normal backwards 1 motion-blur-number-' + i + '; -webkit-animation: 0.65s cubic-bezier(0, 0, 0.17, 1) 0s normal backwards 1 motion-blur-number-' + i + '; } ';

                    var $symbol = $counter.find('.symbol-wrap').clone();
                    $counter.find('.symbol-wrap').remove();
                    var characters = $counter.find('.digit').text().split("");
                    var $this = $counter.find('.digit');
                    $this.empty();

                    $.each(characters, function (i, el) {
                        if (el === ' ') {
                            el = '&nbsp;';
                        }
                        $this.append("<span>" + el + "</span>");
                    });

                    if ($counter.has('[data-symbol]')) {
                        if ($counter.attr('data-symbol-pos') === 'after') {
                            $this.append($symbol);
                        } else {
                            $this.prepend($symbol);
                        }
                    }

                });

                var head = document.head || document.getElementsByTagName('head')[0];
                var style = document.createElement('style');

                style.type = 'text/css';
                if (style.styleSheet) {
                    style.styleSheet.cssText = $blurCssString;
                } else {
                    style.appendChild(document.createTextNode($blurCssString));
                }

                head.appendChild(style);

                $('.rdy_counter_holder.motion').each(function () {
                    var $counter = $(this).find('.counter');

                    $(this).css('opacity', 1);
                    var $offset = ($counter.hasClass('motion')) ? '90%' : '105%';
                    var repeatOnce = $counter.find('.digit').data('repeat') ? false : true;

                    $counter.waypoint(function (direction) {
                        if ($counter.hasClass('motion') && direction === 'down') {
                            if (!$counter.hasClass("animation-triggered")) {
                                $counter.addClass("animation-triggered");
                                $counter.find('span').each(function (i) {
                                    var $that = $(this);
                                    setTimeout(function () {
                                        $that.addClass('in-sight');
                                    }, 200 * i);

                                });
                            }
                        }

                    }, {offset: $offset, triggerOnce: repeatOnce});

                    $counter.waypoint(function (direction) {
                        if ($counter.hasClass('motion') && direction === 'up') {
                            $counter.removeClass("animation-triggered");
                            $counter.find('span').removeClass("in-sight");
                        }

                    }, {offset: '110%', triggerOnce: repeatOnce});
                });

            }

        }

        initCounterRandom();
        initToCounter();
        initCounterMotion();
    };

    PZPREFIX.owlCarousel = function(container) {
        var $owlSelector = $('[class*="owl-carousel"]:not(.owl-testimonials):not(.products)', container),
            params = {},
            tempTimeStamp,
            currentIndex;

        $owlSelector.each(function () {
            var params = {};
            var itemID = $(this).attr('id'),
                $elSelector = $(this);
            params.id = itemID;
            params.items = 4;
            params.columns = 3;
            params.fade = false;
            params.nav = false;
            params.navmobile = false;
            params.navskin = 'light';
            params.navspeed = 400;
            params.dots = false;
            params.dotsmobile = false;
            params.loop = false;
            params.autoplay = false;
            params.timeout = 3000;
            params.autoheight = false;
            params.hoverpause = false;
            params.margin = 0;
            params.lg = 1;
            params.md = 1;
            params.sm = 1;

            $.each($(this).data(), function (i, v) {
                params[i] = v;
            });

            $elSelector.on('initialized.owl.carousel', function (event) {

                var thiis = $(event.currentTarget);

                if ($(event.currentTarget).data('autoplay')) {
                    $(event.currentTarget).trigger('play.owl.autoplay');
                }

                setTimeout(function () {
                    animate_thumb($('.t-inside', el), event);
                }, 400);


                var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
                    currentIndex = $(currentItem).attr('data-index');

                $.each($('.owl-item:not(.active)', event.currentTarget), function (index, val) {
                    if ($(val).attr('data-index') != currentIndex) {
                        $('.start_animation:not(.t-inside)', val).removeClass('start_animation');
                    }
                    if ($(val).attr('data-index') == currentIndex) {
                        $('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
                    }
                });

                var el = $(event.currentTarget);

            });


            $elSelector.on('translated.owl.carousel', function (event) {

                var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
                    currentIndex = $(currentItem).attr('data-index');

                setTimeout(function () {
                    var lastDelayElems = animate_elems($('.owl-item.active', event.currentTarget));
                    var lastDelayThumb = animate_thumb($('.owl-item.active .t-inside', event.currentTarget), event);

                    if ($(event.currentTarget).closest('.uncode-slider').length && $(event.currentTarget).data('autoplay')) {
                        if (lastDelayElems === undefined) {
                            lastDelayElems = 0;
                        }
                        if (lastDelayThumb === undefined) {
                            lastDelayThumb = 0;
                        }
                        var maxDelay = Math.max(lastDelayElems, lastDelayThumb);
                        $(event.currentTarget).trigger('stop.owl.autoplay');
                        setTimeout(function () {
                            if (!$(event.currentTarget).hasClass('owl-mouseenter') && $(event.currentTarget).data('stopped') != 'true') $(event.currentTarget).trigger('play.owl.autoplay');
                        }, maxDelay);
                    }
                }, 200);

                $.each($('.owl-item:not(.active) .start_animation', $(event.target)), function (index, val) {
                    if ($(val).closest('.uncode-slider').length) {
                        $(val).removeClass('start_animation');
                    }
                });

                $.each($('.owl-item:not(.active)', event.currentTarget), function (index, val) {
                    if ($(val).attr('data-index') != currentIndex) {
                        $('.start_animation:not(.t-inside)', val).removeClass('start_animation');
                    }
                    if ($(val).attr('data-index') == currentIndex) {
                        $('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
                    }
                });

            });


            $elSelector.owlCarousel({
                items: params.items,
                animateOut: (params.fade == true) ? 'fadeOut' : null,
                nav: params.nav,
                dots: params.dots,
                loop: params.loop,
                margin: 0,
                video: true,
                autoWidth: false,
                autoplay: false,
                autoplayTimeout: params.timeout,
                autoplaySpeed: params.navspeed,
                autoplayHoverPause: params.hoverpause,
                autoHeight: ($(this).hasClass('owl-height-equal') || $(this).hasClass('owl-height-auto')) ? true : params.autoheight,
                rtl: $('body').hasClass('rtl') ? true : false,
                fluidSpeed: true,
                navSpeed: params.navspeed,
                navContainer: params.nav ? $elSelector : false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: params.sm,
                        nav: params.navmobile,
                        dots: params.dotsmobile
                    },
                    480: {
                        items: params.sm,
                        nav: params.navmobile,
                        dots: params.dotsmobile
                    },
                    570: {
                        items: params.md,
                        nav: params.navmobile,
                        dots: params.dotsmobile
                    },
                    960: {
                        items: params.lg
                    }
                }
            });

        });

        function animate_elems($this) {
            var lastDelay;
            $.each($('.animate_when_almost_visible:not(.t-inside)', $this), function (index, val) {
                var element = $(val),
                    delayAttr = element.attr('data-delay');
                if (delayAttr === undefined) {
                    delayAttr = 0;
                }
                setTimeout(function () {
                    element.addClass('start_animation');
                }, delayAttr);
                lastDelay = delayAttr;
            });
            return lastDelay;
        }

        function animate_thumb(items, event) {
            var lastDelay,
                itemIndex,
                tempIndex = ($(event.currentTarget).data('tempIndex') === undefined) ? $('.owl-item.active', event.currentTarget).first().index() : $(event.currentTarget).data('tempIndex'),
                numActives = $('.owl-item.active', event.currentTarget).length;
            $(event.currentTarget).data('tempIndex', event.item.index);
            $.each(items, function (index, val) {
                var parent = $(val).closest('.owl-item');
                if (!$(val).hasClass('start_animation')) {
                    if (parent.hasClass('active')) {

                        $(val).waypoint(function (direction) {
                            var element = $(this),
                                delayAttr = parseInt(element.attr('data-delay')),
                                itemIndex = element.closest('.owl-item').index() + 1,
                                diffItem = Math.abs(itemIndex - tempIndex) - 1;
                            if (itemIndex > tempIndex) {
                                $(event.currentTarget).data('tempIndex', itemIndex);
                            }
                            if (isNaN(delayAttr)) {
                                delayAttr = 100;
                            }
                            $('.owl-item.cloned[data-index="' + (element.closest('.owl-item').data('index')) + '"] .t-inside', event.currentTarget).addClass('start_animation');
                            var objTimeout = setTimeout(function () {
                                element.addClass('start_animation');
                            }, diffItem * delayAttr);
                            lastDelay = diffItem * delayAttr;
                            parent.data('objTimeout', objTimeout);

                        }, {offset: '90%', triggerOnce: true});

                    }
                }
            });

            return lastDelay;

        }
    };

    PZPREFIX.init_vc_separator = function() {
        if ($(window).width() > 992) {
            $(".rdy_separator.animate:not(.start-animation)").each(function () {
                var $this = $(this);
                var repeatOnce = true;
                if ($this.hasClass('animate-loop')) {
                    repeatOnce = false;
                }

                $(this).waypoint(function (direction) {

                    if (direction === 'down' && !$this.hasClass("animation-triggered")) {
                        var delay = $this.data('animation-delay') ? $this.data('animation-delay') : 0;

                        if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
                            $this.addClass("animation-triggered");

                            setTimeout(function () {
                                $this.addClass($this.data('animation-class'));
                                $this.addClass("start-animation");
                            }, delay);
                        }

                    }

                }, {offset: '90%', triggerOnce: repeatOnce});

                if ($this.hasClass('animate-loop')) {
                    $(this).waypoint(function (direction) {
                        if (direction === 'up') {
                            $this.removeClass("animation-triggered");
                            $this.removeClass("start-animation");
                        }

                    }, {offset: '110%', triggerOnce: repeatOnce});
                }
            });
        }
    };

    PZPREFIX.init_vc_icon = function() {

        var $icon = [];

        $('.vc_icon_element').each(function (i) {
            var $that = $(this);
            var $file = $that.find('.vc_icon_element-icon').data('svg');

            if(typeof $file != 'undefined') {

                if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|BlackBerry|Opera Mini)/)) $that.attr('svg-animation','false');

                $(this).attr('id', 'icon-svg-instance-' + i);
                var $animationSpeed = ($that.is('[data-svg-animation-speed]') && $that.attr('data-svg-animation-speed').length > 0) ? $that.attr('data-svg-animation-speed') : 500;
                var $animationType = $that.is('[data-svg-animation-type]') ? $that.attr('data-svg-animation-type') : 'delayed';

                var $animationTiming = Vivus.LINEAR;
                if ($that.data('svg-animation-timing') === 'EASE') {
                    $animationTiming = Vivus.EASE;
                } else if ($that.data('svg-animation-timing') === 'EASE_OUT') {
                    $animationTiming = Vivus.EASE_OUT;
                } else if ($that.data('svg-animation-timing') === 'EASE_OUT') {
                    $animationTiming = Vivus.EASE_OUT;
                } else if ($that.data('svg-animation-timing') === 'EASE_IN') {
                    $animationTiming = Vivus.EASE_IN;
                } else if ($that.data('svg-animation-timing') === 'EASE_OUT_BOUNCE') {
                    $animationTiming = Vivus.EASE_OUT_BOUNCE;
                }

                if (!$that.data('svg-animation')) {
                    $animationSpeed = 1;
                    $that.css('opacity', '1');
                }

                $icon[i] = new Vivus($that.find( '.vc_icon_element-inner' ).get(0), {
                    type: $animationType,
                    pathTimingFunction: Vivus.EASE_OUT,
                    animTimingFunction: $animationTiming,
                    duration: $animationSpeed,
                    file: $file,
                    onReady: svgInit
                });

                $that.find('span').remove();

                var checkIfReady = function () {
                    var $animationDelay = ($that.data('svg-animation-delay') && $that.data('svg-animation-delay').length > 0 && $that.data('animation') != 'false') ? $that.data('svg-animation-delay') : 0;
                    if ($icon[$that.attr('id').slice(-1)].isReady == true) {
                        $that.css('opacity', '1');
                        setTimeout(function () {
                            $icon[$that.attr('id').slice(-1)].reset().play();
                        }, $animationDelay);
                    } else {
                        setTimeout(checkIfReady, 50);
                    }
                };

                if($animationSpeed !== 1) {
                    $(this).waypoint(function(direction) {

                        checkIfReady();
                        $that.addClass('animated-in');

                    }, { offset: '90%', triggerOnce: true });

                } else {
                    checkIfReady();
                }

                var svgInit = function (eVivus) {
                    $icon[$that.attr('id').slice(-1)].reset().stop();
                };

            }

        });

    };


    PZPREFIX.initVC = function() {
        PZPREFIX.init_vc_row();
        PZPREFIX.init_vc_column();
        PZPREFIX.init_vc_custom_heading();
        PZPREFIX.init_vc_clientlist();
        PZPREFIX.init_vc_counter();
        PZPREFIX.init_vc_separator();
        PZPREFIX.init_vc_icon();
        PZPREFIX.initFx();
        PZPREFIX.initCascadeAnimation();
        PZPREFIX.owlCarousel($('body'));
    };

    PZPREFIX.initSearch = function() {

        if($('#header-search__button').length){

            var mainContainer = document.getElementById('page'),
                openCtrl = document.getElementById('header-search__button'),
                closeCtrl = document.getElementById('header-search__close'),
                searchContainer = document.querySelector('.search_container'),
                inputSearch = searchContainer.querySelector('.search__input');

            var initEvents = function () {
                openCtrl.addEventListener('click', openSearch);
                closeCtrl.addEventListener('click', closeSearch);
                document.addEventListener('keyup', function(ev) {
                    if( ev.keyCode === 27 ) {
                        closeSearch();
                    }
                });
            };

            var openSearch = function () {
                jQuery(searchContainer).css('display', 'block');
                mainContainer.classList.add('main-wrap--overlay');
                closeCtrl.classList.remove('btn--hidden');
                searchContainer.classList.add('search--open');
                TweenMax.to(jQuery(searchContainer), 0.5, {
                    left: 0,
                    onComplete: function() {
                        inputSearch.focus();
                    }
                });

                PZPREFIX.hideScrollBar();
            };

            var closeSearch = function () {
                mainContainer.classList.remove('main-wrap--overlay');
                closeCtrl.classList.add('btn--hidden');
                searchContainer.classList.remove('search--open');
                TweenMax.to(jQuery(searchContainer), 0.4, {
                    left: '100%',
                    onComplete: function() {
                        jQuery(searchContainer).css('display', 'none');
                    }
                });
                inputSearch.blur();
                inputSearch.value = '';
                PZPREFIX.showScrollBar();

            };

            initEvents();
        }

    };

    PZPREFIX.initTransition = function() {

        function transition_page_do_animate(e) {

            if($('#page-loading-screen[data-effect="slide"]').length > 0) {
                $('#page-loading-screen').removeClass('loaded');
                $('#page-loading-screen').addClass('in-from');

                setTimeout(function(){
                    $('#page-loading-screen').addClass('loaded');
                },30);
            } else {
                $('#page-loading-screen').css({'display': 'block'});
                TweenMax.to($('#page-loading-screen'), 0.45, { opacity: 1 });
            }

        }

        if($('body[data-page-transitions="true"]').length > 0 ) {
            jQuery(window).on('pageshow', function(event) {

                $('html').addClass('page-trans-loaded');

                if ($('#page-loading-screen[data-effect="regular"]').length > 0) {
                    setTimeout(function () {
                        TweenMax.to($('#page-loading-screen'), 0.7, {
                            opacity: 0,
                            onComplete: function() {
                                $('#page-loading-screen').css({'display': 'none'});
                            }
                        });

                        TweenMax.to($('#page-loading-screen .loading-icon'), 0.7, {
                            opacity: 0
                        });

                    }, 60);

                } else {
                    if ($('#page-loading-screen[data-effect="slide"]').length > 0) {
                        setTimeout(function () {
                            $('#page-loading-screen').addClass('loaded');
                        }, 60);
                    }

                    setTimeout(function () {
                        $('#page-loading-screen:not(.loaded)').addClass('loaded');
                        setTimeout(function () {
                            $('#page-loading-screen').addClass('hidden');
                        }, 1000);
                    }, 150);

                    if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Chrome') === -1 || navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                        window.onunload = function () {
                            TweenMax.to($('#page-loading-screen'), 0.8, {
                                opacity: 0,
                                onComplete: function() {
                                    $('#page-loading-screen').css({'display': 'none'});
                                }
                            });
                            TweenMax.to($('#page-loading-screen .loading-icon'), 0.6, { opacity: 0 });
                        };
                        window.onpageshow = function (event) {
                            if (event.persisted) {
                                TweenMax.to($('#page-loading-screen'), 0.8, {
                                    opacity: 0,
                                    onComplete: function() {
                                        $('#page-loading-screen').css({'display': 'none'});
                                    }
                                });
                                TweenMax.to($('#page-loading-screen .loading-icon'), 0.6, { opacity: 0 });
                            }
                        };
                    } else if (navigator.userAgent.indexOf('Firefox') !== -1) {
                        window.onunload = function () {};
                    }
                }
            });

            if($('#page-loading-screen').length) {
                $('a[href]:not(.no-ajaxy):not([target="_blank"]):not([href^="#"]):not([href^="mailto:"]):not(.comment-edit-link):not(.magnific-popup):not(.magnific):not(.meta-comment-count a):not(.comments-link):not(#cancel-comment-reply-link):not(.comment-reply-link):not(#toggle-nav):not(.logged-in-as a):not(.add_to_cart_button):not(.section-down-arrow):not([data-filter]):not(.pp):not([rel^="prettyPhoto"]):not(.pretty_photo):not(.light-gallery):not(.rdy-video-lightbox)').click(function(e){
                    if($(this).is('[href^="#"]')) {
                        return;
                    }

                    var $window_current_location = window.location.href.split("#")[0];
                    var $window_clicked_location = $(this).attr('href').split("#")[0];

                    if($window_clicked_location !== $window_current_location) {
                        var $target = $(this).attr('href');
                        if($target !== '') {

                            $('#page-loading-screen').addClass('set-to-fade');
                            transition_page_do_animate();

                            setTimeout(function(){
                                window.location = $target;
                            },330);

                            return false;
                        }
                    }

                });
            }
        }
    };

    PZPREFIX.initRoyalSlider = function() {

        var $window = jQuery( window ),
            $document = jQuery( document ),
            $html = jQuery( 'html' ),
            $body = jQuery( 'body' ),
            window_width = window.innerWidth,
            window_height = window.innerHeight,
            document_height = $document.height(),
            knownScrollY = - 1,
            latestKnownScrollY = window.scrollY,
            scrollDirection = 'down';


        function scaleImage($images, amount) {

            amount = (typeof amount == "undefined") ? 1 : amount;

            $images.each(function(i, element) {

                var $image = jQuery(element);

                if ( $image.is('img') ) {
                    $image.imagesLoaded( scaleThis );
                }

                if ( $image.is('video') ) {
                    if ( element.readyState > 3 ) {
                        scaleThisVideo();
                    } else {
                        $image.one( 'canplaythrough', scaleThisVideo );
                    }
                }

                function scaleThis() {
                    var imageWidth  = $image.outerWidth(),
                        imageHeight = $image.outerHeight(),
                        $container  = $image.parent(),
                        containerHeight  = $.outerHeight(),
                        scaleX      = (window_width + 2) / imageWidth,
                        scaleY      = (containerHeight + (window_height - containerHeight) * amount + 2) / imageHeight,
                        scale       = Math.max(scaleX, scaleY);

                    $image.css({
                        width: imageWidth * scale,
                        top: (containerHeight - imageHeight * scale) / 2,
                        left: (window_width - imageWidth * scale) / 2
                    });
                }

                function scaleThisVideo() {
                    var imageWidth  = $image[0].videoWidth,
                        imageHeight = $image[0].videoHeight,
                        $container  = $image.parent().parent(),
                        containerHeight  = $container.outerHeight(),
                        scaleX      = (window_width + 2) / imageWidth,
                        scaleY      = (containerHeight + (window_height - containerHeight) * amount + 2) / imageHeight,
                        scale       = Math.max(scaleX, scaleY);

                    $image.css({
                        width: imageWidth * scale,
                        top: (containerHeight - imageHeight * scale) / 2,
                        left: (window_width - imageWidth * scale) / 2
                    });
                }

            });
        }

        $window.on( "load", function() {
            $( '.video-placeholder' ).each( function( i, obj ) {
                var $placeholder = $( obj ),
                    video = document.createElement( 'video' ),
                    $video = $( video ).addClass( 'iso-bg iso-bg-video' );

                if ( $placeholder.closest( '.js-isoslider' ).children().length <= 1 ) {

                    video.onloadedmetadata = function() {
                        scaleImage( $video );
                        video.play();
                    };
                }

                video.src = $placeholder.data( 'src' );
                video.poster = $placeholder.data( 'poster' );
                video.muted = true;
                video.loop = true;
                $placeholder.replaceWith( $video );

            } );
        } );



        function royal_slider_init($container) {
            $container = typeof $container !== 'undefined' ? $container : jQuery('body');

            $container.find('.js-isoslider').each(function () {

                var $slider = jQuery(this);

                if ( $slider.children().length < 2 ) {
                    return;
                }

                $slider.imagesLoaded(function() {
                    slider_init($slider);

                    if (jQuery('#fullscreen-project').data('slidertransition') === 'slide2' || jQuery('#fullscreen-project').data('slidertransition') === 'slide3') {
                        slider_finish_init($slider);
                    }

                });
            });

            jQuery(window).load(function() {});

        }

        if ($('#fullscreen-project-container').length !== 0) {
            royal_slider_init();

            if (jQuery('.component-tooltip').length !== 0) {
                jQuery('body').addClass('nocursor');
                var tooltip = jQuery('.component-tooltip');

                tooltip.appendTo("body");
                tooltip.css({
                    'left': jQuery(window).width() / 2 - tooltip.width() / 2,
                    'top': jQuery(window).height() / 2 - tooltip.height() / 2,
                });

                jQuery(document).on("mousemove", function (evt) {
                    tooltip.css({left: evt.pageX, top: evt.pageY});
                });

                TweenMax.to(tooltip, 0.4, {
                    opacity: 0,
                    delay: 3.5,
                    onComplete: function () {
                        tooltip.css('display', 'none');
                        jQuery('body').removeClass('nocursor');
                    }
                });
            }
        }


        (function($) {
            updateLoop();
        })(jQuery);

        $window.scroll( onScroll );
        function onScroll( e ) {
            latestKnownScrollY = jQuery( this ).scrollTop();
        }

        var scheduledAnimationFrame = false;

        function updateLoop() {
            if ( scheduledAnimationFrame ) {
                return;
            }
            scheduledAnimationFrame = true;

            if ( knownScrollY !== latestKnownScrollY ) {
                scrollDirection = latestKnownScrollY > knownScrollY ? 'down' : 'up';
                knownScrollY = latestKnownScrollY;
            }

            requestAnimationFrame( function() {
                scheduledAnimationFrame = false;
                updateLoop();
            } );
        }


        function slider_split_title($slide_content) {
            var $title = $slide_content.find('.fullscreen-item-title'),
                $subtitle = $slide_content.find('.fullscreen-item-subtitle');

            if (jQuery('#fullscreen-project').data('titlestyle') === 'style1') {
                $slide_content.find('.fullscreen-item-desc').css('opacity', '0');

            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style3' || jQuery('#fullscreen-project').data('titlestyle') === 'style5') {
                if (!$slide_content.hasClass('text-animation-triggered')) {
                    $slide_content.addClass('text-animation-triggered');

                    if ($title) {
                        $title.blast({delimiter: "word"});
                        $title.find('span.blast').each(function () {
                            jQuery(this).removeClass('blast');
                            jQuery(this).blast({delimiter: "char"});
                        });
                    }

                    if ($subtitle) {
                        $subtitle.blast({delimiter: "word"});
                        $subtitle.find('span.blast').each(function () {
                            jQuery(this).removeClass('blast');
                            jQuery(this).blast({delimiter: "char"});
                        });
                    }

                } else {
                    $title.find('.blast-root > span.blast').css('opacity', 0);
                    $subtitle.find('.blast-root > span.blast').css('opacity', 0);
                }
            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style4') {
                var top = $slide_content.find(".fullscreen-item-desc .fullscreen-item-title div").first().outerHeight();
                $slide_content.find(".fullscreen-item-desc .fullscreen-item-title .title_line").css('top', top);
            }

        }

        function slider_animate_title($slide_content, type) {
            var $title_e = $slide_content.find('.fullscreen-item-title'),
                $suntitle_e = $slide_content.find('.fullscreen-item-subtitle');
            var from_title,
                to_title;

            if (jQuery('#fullscreen-project').data('titlestyle') === 'style1') {
                TweenMax.fromTo($slide_content.find('.fullscreen-item-desc'), 0.7, {autoAlpha: 0}, {autoAlpha: 1});

            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style2') {
                if (type === 'next') {
                    from_title = {autoAlpha: 0, x: 50};
                    to_title = {autoAlpha: 1, x: 0, ease: CustomEase.create("custom1", ".19,1,.22,1")};
                } else {
                    from_title = {autoAlpha: 0, x: -50};
                    to_title = {autoAlpha: 1, x: 0, ease: CustomEase.create("custom1", ".19,1,.22,1")};
                }
                TweenMax.fromTo($title_e, 0.62, from_title, to_title);
                TweenMax.fromTo($suntitle_e, 0.62, from_title, jQuery.extend(to_title, {delay: 0.2}));

            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style3') {
                if (type === 'next') {
                    from_title = {autoAlpha: 0, x: -12};
                    to_title = {autoAlpha: 1, x: 0};
                } else {
                    from_title = {autoAlpha: 0, x: 12};
                    to_title = {autoAlpha: 1, x: 0};
                }

                TweenMax.staggerFromTo($title_e.find('.blast'), 0.8, from_title, to_title, 0.03);
                TweenMax.staggerFromTo($suntitle_e.find('.blast'), 0.8, from_title, to_title, 0.03);

            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style5') {

                if (type === 'next') {
                    from_title = {autoAlpha: 0, x: -30};
                    to_title = {autoAlpha: 1, x: 0, ease: CustomEase.create("custom", ".38,0,.32,1")};
                } else {
                    from_title = {autoAlpha: 0, x: -30};
                    to_title = {autoAlpha: 1, x: 0, ease: CustomEase.create("custom", ".38,0,.32,1")};
                }

                $title_e.find('div').each(function(){
                    TweenMax.staggerFromTo(jQuery(this).find('.blast'), 0.6, from_title, to_title, 0.03);
                });

                TweenMax.staggerFromTo($suntitle_e.find('.blast'), 0.6, from_title, to_title, 0.03);

            } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style4') {
                var top = $slide_content.find(".fullscreen-item-desc .fullscreen-item-title div").first().outerHeight();

                TweenMax.staggerFromTo($slide_content.find(".fullscreen-item-desc .fullscreen-item-title .title_line, .fullscreen-item-desc .fullscreen-item-subtitle .title_line"), 0.5, {
                    top: top,
                    ease: Cubic.easeInOut
                }, {
                    top: 0,
                    ease: Cubic.easeInOut
                }, 0.1);

            }
        }

        function slider_color_init($slider, $slide_content) {

            if ($slide_content.data('slidecolor')) {
                jQuery('#fullscreen-project-container').attr('data-currentcolor', $slide_content.data('slidecolor'));
            } else {
                jQuery('#fullscreen-project-container').removeAttr('data-currentcolor');
            }

            var header_color_transform = false;
            if( $slider && $slider.data('headercolortransform')) {
                header_color_transform = $slider.data('headercolortransform');
            } else {
                header_color_transform = $slide_content.closest('.js-isoslider').data('headercolortransform');
            }

            if (header_color_transform) {
                if ($slide_content.data('slidecolor')) {
                    jQuery('#header, #vheader').attr('data-mark-color', $slide_content.data('slidecolor'));
                } else {
                    jQuery('#header, #vheader').removeAttr('data-mark-color');
                }
            }
        }

        function slider_finish_init($slider) {
            var slider = $slider.data('royalSlider');

            var first_slide 			= slider.slides[0],
                first_slide_content 	= jQuery(first_slide.content),
                $video 				    = first_slide_content.hasClass('video') ? first_slide_content : first_slide_content.find('.video'),
                first_slide_auto_play 	= typeof $video.data('video_autoplay') !== "undefined";

            var last_slide = slider.currSlideId;

            if ( $slider.closest('.js-iso').length ) {
                first_slide.holder.on('rsAfterContentSet', function () {
                    if ( first_slide_auto_play ) {
                        slider.playVideo();
                    }
                });

                $video = jQuery(first_slide.holder).find('video');
                if ($video.length) {
                    $video.get(0).play();
                }

                slider.ev.on('rsBeforeAnimStart', function(event) {
                    var $slide = slider.currSlide.holder,
                        slideWidth = $slide.width(),
                        move = 300,
                        direction = 1;

                    jQuery(slider.slides).each(function(i, obj) {
                        jQuery(obj.holder).css('z-index', 1);
                    });

                    if (last_slide == slider.currSlideId - 1 || (last_slide == slider.slides.length - 1) && slider.currSlideId === 0) {
                        direction = -1;
                    }

                    var $lastSlide = jQuery(slider.slides[last_slide].holder),
                        $lastVideo = $lastSlide.find('video'),
                        $video = $slide.find('video');

                    scaleImage( $slide.find( 'video' ) );

                    if ( $video.length ) {
                        $video.get(0).play();
                    }

                    TweenMax.fromTo($slide, 0.85, {x: slideWidth * direction * -1}, {x: 0, ease: Quart.easeInOut});

                    if(jQuery('#fullscreen-project').data('slidertransition') === 'slide2'){
                        TweenMax.fromTo($slide.children(), 0.85, {x: (slideWidth - move) * direction}, {x: 0, ease: Quart.easeInOut});
                    } else if(jQuery('#fullscreen-project').data('slidertransition') === 'slide3'){
                        TweenMax.fromTo($slide.children(), 0.85, {x: (slideWidth) * direction}, {x: 0, ease: Quart.easeInOut});
                    }

                    if (jQuery('#fullscreen-project').data('slidertransition') === 'slide2') {
                        TweenMax.to($lastSlide, 0.85, {x: move * direction, ease: Quart.easeInOut});
                    } else if (jQuery('#fullscreen-project').data('slidertransition') === 'slide3') {
                        TweenMax.to($lastSlide, 0.85, {x: 0, ease: Quart.easeInOut});
                    }

                    last_slide = slider.currSlideId;
                });

            }

            slider.ev.on('rsOnDestroyVideoElement', function(i,el){
                var $slide_content = jQuery(this.currSlide.content),
                    $video = $slide_content.hasClass('video') ? $slide_content : $slide_content.find('.video');

                $video.removeClass('video_autoplay');
            });
        }

        function slider_init($slider) {
            jQuery(window).resize(function(e) {
                if ($slider.attr('id') === 'fullscreen-project') {
                    var topYOffset = 0,
                        heightOffset = 0;

                    if (jQuery('body.header-type-classic').length && jQuery('body.header-behaviour-sticky').length && jQuery('#header').length && !jQuery('body.with-header-opacity').length) {
                        topYOffset = jQuery('#header').height();
                        heightOffset = jQuery('#header').height();
                    }

                    if (jQuery('body.header-type-classic').length && jQuery('body.header-behaviour-regular').length && jQuery('#header').length && !jQuery('body.with-header-opacity').length) {
                        heightOffset = jQuery('#header').height();
                    }


                    $slider.closest('#fullscreen-project-container').css({'height': jQuery(window).height() - jQuery('#wpadminbar').height() - heightOffset, 'margin-top': topYOffset});
                    $slider.css({'height': jQuery(window).height() - jQuery('#wpadminbar').height() - heightOffset});
                }
            });

            jQuery(window).trigger('resize');

            $slider.find('img').removeClass('invisible');

            var rs_arrows                   = typeof $slider.data('arrows') !== "undefined",
                rs_autoPlay                 = typeof $slider.data('sliderautoplay') !== "undefined",
                rs_autoheight               = typeof $slider.data('autoheight') !== "undefined",
                rs_autoScaleSlider          = false,
                rs_autoScaleSliderWidth     = typeof $slider.data('autoscalesliderwidth') !== "undefined" && $slider.data('autoscalesliderwidth') !== '' ? $slider.data('autoscalesliderwidth') : false,
                rs_autoScaleSliderHeight    = typeof $slider.data('autoscalesliderheight') !== "undefined" && $slider.data('autoscalesliderheight') !== '' ? $slider.data('autoscalesliderheight') : false,
                rs_bullets                  = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
                rs_customArrows             = typeof $slider.data('customarrows') !== "undefined",
                rs_delay                    = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') !== '' ? $slider.data('sliderdelay') : '1000',
                rs_drag                     = true,
                rs_globalCaption            = typeof $slider.data('showcaptions') !== "undefined",
                rs_imageScale               = $slider.data('imagescale'),
                rs_imageAlignCenter         = typeof $slider.data('imagealigncenter') !== "undefined",
                rs_slidesSpacing            = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
                rs_keyboardNav              = typeof $slider.data('fullscreen') !== "undefined",
                is_headerSlider             = true,
                rs_hoverArrows              = typeof $slider.data('hoverarrows') !== "undefined",
                rs_transitionSpeed          = 1000,
                rs_transitionType           = 'fade',
                rs_visibleNearby            = typeof $slider.data('visiblenearby') !== "undefined";

            rs_arrows = false;
            rs_transitionSpeed = 850;
            jQuery.rsCSS3Easing.isoEasing = 'cubic-bezier(0.770, 0.000, 0.175, 1.000)';
            jQuery.rsCSS3Easing.isoEasing2 = 'cubic-bezier(0.215, 0.610, 0.355, 1.000)';

            if (typeof $slider.data('slidertransition') !== "undefined") {
                if ($slider.data('slidertransition') === 'slide2' || $slider.data('slidertransition') === 'slide3') {
                    rs_transitionType = 'fade';
                } else {
                    rs_transitionType = $slider.data('slidertransition');
                }
            } else {
                rs_transitionType = 'fade';
            }

            if (rs_autoheight) {
                rs_autoScaleSlider = false;
                rs_imageScale = 'none';
                rs_imageAlignCenter = false;
            } else {
                rs_autoheight = false;
                rs_autoScaleSlider = true;
            }


            var royalSliderParams = {
                arrowsNav: false,
                arrowsNavAutoHide: false,
                autoHeight: rs_autoheight,
                autoScaleSlider: rs_autoScaleSlider,
                autoScaleSliderWidth: rs_autoScaleSliderWidth,
                autoScaleSliderHeight: rs_autoScaleSliderHeight,
                controlNavigation: rs_bullets,
                globalCaption: rs_globalCaption,
                easeOut: 'isoEasing2',
                easeInOut: 'isoEasing',
                imageScalePadding: 0,
                imageScaleMode: rs_imageScale,
                imageAlignCenter: rs_imageAlignCenter,
                keyboardNavEnabled: rs_keyboardNav,
                loop: true,
                navigateByClick: false,
                numImagesToPreload: 2,
                slidesSpacing: rs_slidesSpacing,
                sliderDrag: rs_drag,
                transitionType: rs_transitionType,
                transitionSpeed: rs_transitionSpeed,
                autoPlay: {
                    enabled: rs_autoPlay,
                    stopAtAction: false,
                    pauseOnHover: false,
                    delay: rs_delay
                },
                video: {
                    autoHideArrows: false,
                    autoHideControlNav: false,
                    autoHideBlocks: false
                }
            };

            if (jQuery('#fullscreen-project-container').data('navigation') == 'nav4') {
                royalSliderParams.navigateByClick = true;
                royalSliderParams.controlNavigation = 'thumbnails';
            }

            if (rs_visibleNearby) {
                royalSliderParams.visibleNearby = {
                    enabled: true,
                    center: true,
                    breakpoint: 0,
                    navigateByCenterClick: false
                };
            }

            if (jQuery('#fullscreen-project-container').data('navigation')) {
                royalSliderParams.sliderDrag = false;
            }

            $slider.royalSlider(royalSliderParams);

            var royalSlider = $slider.data('royalSlider' ),
                slides_number = royalSlider.numSlides,
                textSliderDelay = 850;

            royalSlider.ev.on('rsBeforeMove', function(e, type, action) {
                var $slide_content = jQuery( this.currSlide.content );

                if (jQuery('#fullscreen-project').data('slidertransition') === 'slide2') {
                    jQuery("#fullscreen-project .rsImg").css({'opacity': '1'});
                    TweenMax.fromTo($slide_content.find('img'), 0.7, {autoAlpha: 1}, {autoAlpha: 0.5, delay: 0.3});
                }
            });

            scaleImage( jQuery(royalSlider.slides[0].content).find( 'video' ) );
            slider_color_init($slider, jQuery(royalSlider.slides[0].content));

            if (jQuery('#fullscreen-project').data('titlestyle')) {
                slider_split_title(jQuery(royalSlider.slides[0].content));
                slider_animate_title(jQuery(royalSlider.slides[0].content));
            }

            royalSlider.ev.on('rsBeforeMove', function (e, type, action) {

                var $xtype = type;
                var $slide_content = jQuery(this.currSlide.content);

                var next_index = royalSlider.currSlideId;
                if (type === 'next') {
                    next_index++;
                } else if (type === 'prev') {
                    next_index--;
                } else {
                    next_index = type;

                    if (royalSlider.currSlideId < next_index) {
                        $xtype = 'next';
                    } else {
                        $xtype = 'prev';
                    }
                }

                if (next_index < 0) {
                    next_index = royalSlider.numSlides - 1;
                } else if (next_index >= royalSlider.numSlides) {
                    next_index = 0;
                }

                var newSlide = jQuery(royalSlider.slides[next_index].content);


                if (jQuery('#fullscreen-project').data('titlestyle')) {

                    if (jQuery('#fullscreen-project').data('titlestyle') === 'style1') {
                        TweenMax.fromTo($slide_content.find('.fullscreen-item-desc'), 0.5, {autoAlpha: 1}, {autoAlpha: 0});

                    } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style2') {
                        var to_title,
                            from_title;

                        if (type === 'next') {
                            to_title = {autoAlpha: 0, x: -100, ease: Cubic.easeInOut};
                            from_title = {autoAlpha: 1, x: 0};
                        } else {
                            to_title = {autoAlpha: 0, x: 100, ease: Cubic.easeInOut};
                            from_title = {autoAlpha: 1, x: 0};
                        }

                        TweenMax.fromTo($slide_content.find('.fullscreen-item-title'), 0.3, from_title, to_title);
                        TweenMax.fromTo($slide_content.find('.fullscreen-item-subtitle'), 0.3, from_title, to_title);

                    } else if (jQuery('#fullscreen-project').data('titlestyle') === 'style4') {
                        var top = $slide_content.find(".fullscreen-item-desc .fullscreen-item-title div").first().outerHeight();

                        TweenMax.staggerFromTo(
                            $slide_content.find(".fullscreen-item-desc .fullscreen-item-title .title_line, .fullscreen-item-desc .fullscreen-item-subtitle .title_line"), 0.5, {
                                top: 0,
                                ease: Cubic.easeInOut
                            }, {
                                top: -top,
                                ease: Cubic.easeInOut
                            }, 0.1);
                    }

                    slider_split_title(newSlide);
                    setTimeout(function () {
                        slider_animate_title(newSlide, $xtype);
                    }, textSliderDelay);

                }

            });

            royalSlider.ev.on('rsBeforeAnimStart', function(event) {
                jQuery('.iso-slider-arrows-header').addClass('is-inactive');
                setTimeout(function() {
                    jQuery('.iso-slider-arrows-header').removeClass('is-inactive');
                }, 950);

                var $slide_content = jQuery( this.currSlide.content );
                slider_color_init(false, $slide_content);
                slider_split_title($slide_content);
            });

            if (royalSlider && rs_customArrows && slides_number > 1 ) {
                var classes = '';
                if (is_headerSlider) {
                    classes = 'slider-arrows-header';
                }

                if (rs_hoverArrows && !Modernizr.touch) {
                    classes += ' arrows--hover ';
                }

                var $gallery_control = jQuery('.js-iso .iso-slider-arrows-header');

                if (jQuery('#fullscreen-project-container').data('navigation') === 'nav2') {
                    $gallery_control.on('mouseenter mouseleave', '.js-arrow-left, .js-arrow-right', function (event) {
                        var type = event.type === 'mouseenter',
                            direction = jQuery(event.currentTarget).hasClass("js-arrow-left") ? -1 : 1,
                            x = type ? 10 * direction : 0,
                            scale = type ? 1.1 : 1,
                            alpha = type ? 1 : 0.6,
                            ease = type ? Expo.easeInOut : Expo.easeInOut;

                        TweenMax.to(jQuery(this), 0.3, {
                            x: x,
                            scale: scale,
                            autoAlpha: alpha
                        });
                    });
                }

                $gallery_control.on('click', '.js-arrow-left', function (event) {
                    event.preventDefault();
                    if (!jQuery(this).parent('.iso-slider-arrows-header').hasClass('is-inactive')) {
                        royalSlider.prev();
                    }
                });

                $gallery_control.on('click', '.js-arrow-right', function (event) {
                    event.preventDefault();
                    if (!jQuery(this).parent('.iso-slider-arrows-header').hasClass('is-inactive')) {
                        royalSlider.next();
                    }
                });
            }

            $slider.find('.rsNav').insertAfter($slider);

            setTimeout(function() {
                $slider.closest('.js-iso').addClass('slider-loaded');
            }, 10);
        }
    };

    PZPREFIX.init = function() {
        PZPREFIX.initHeader();
        PZPREFIX.elements();
        PZPREFIX.initLightbox();
        PZPREFIX.initVC();
        PZPREFIX.initSearch();
        PZPREFIX.initTransition();
        PZPREFIX.initRoyalSlider();

        if (jQuery.fn.isotope !== undefined) {
            PZPREFIX.isotopeLayout();
        }


    };

    PZPREFIX.init();

});
