$( document ).ready(function() {
    var timeout;
    console.log("hello hostinger");
    /*****change language******/
    change_language = function (language) {
        $.ajax({
            url:"../appscripts/change_language.php",
            method:"POST",
            data:{language:language},
            dataType:"JSON",
            success:function(data)
            {
                location.reload();
            },
            error: function(ts)
            {
                console.log("an error occured");
                // console.log(ts.responseText);
            }
        });
    };

    $('.navigation li ul a ').click(function (){
        toggle_menu(false);
    });

    /******scroll to anchor******/
    function checkForHash() {
        if(window.location.hash) {
            setTimeout(function(){
                moveTo("[data-" + window.location.hash.substring(1) + "]")
            }, 1000);
        }
    }

    checkForHash();

    $(".navigation li ul a").click(function () {
        checkForHash();
    });

    moveTo = function(selector) {
        if(document.querySelector(selector)) {
            if (timeout) {
                window.cancelAnimationFrame(timeout);
            }
            timeout = window.requestAnimationFrame( function() {
                var distance = document.querySelector(selector).getBoundingClientRect().top;
                distance += $('#page-wrapper').scrollTop();
                $('#page-wrapper').animate({
                    scrollTop: distance
                }, 700);
            });
        }
    };

    var last_scroll = 0;

    // $('#page-wrapper').scroll(function () {
    //     if ($(this).scrollTop() > 30) $('body').addClass('scrolled');
    //     else $('body').removeClass('scrolled');

    //     if(window.innerWidth < 992) {
    //         if($(this).scrollTop() > 30 && $(this).scrollTop() > last_scroll){$('body').addClass('scrolled_down');}
    //         else if ($(this).scrollTop() < last_scroll){$('body').removeClass('scrolled_down');}
    //     }
    //     else {
    //         if($(this).scrollTop() > last_scroll){$('body').addClass('scrolled_down');}
    //         else if ($(this).scrollTop() < last_scroll){$('body').removeClass('scrolled_down');}
    //     }
    //     last_scroll = $(this).scrollTop();
    // });

    scroll_to_top = function() {
        $('#page-wrapper').animate({
            scrollTop: 0
        }, 700);
    };

    toggle_menu = function(choice) {
        if(choice) {
            document.getElementById("page-wrapper").classList.add('overflow-hidden');
            document.body.classList.add('menu_is_open');
        }
        else {
            document.getElementById("page-wrapper").classList.remove('overflow-hidden');
            document.body.classList.remove('menu_is_open');
        }
    };

    toggle_no_link_open = function(el) {
        el.classList.toggle('open');
    };

    var scrollbarWidth = window.innerWidth - $('#page').innerWidth();
    $("header").css("paddingRight", scrollbarWidth + 'px');
    $('.close').css("right", scrollbarWidth + 'px');

    /*******moving image*********/

    var moving_image_class = 'movingImage';
    var elements = document.getElementsByClassName(moving_image_class);
    if(elements[0]) {
        for(var i=0; i< elements.length; i++) {
            elements[i].parentElement.addEventListener('mousemove', function(event) {
                if(window.innerWidth >= 992) {
                    var that = this;
                    if (timeout) {
                        window.cancelAnimationFrame(timeout);
                    }
                    timeout = window.requestAnimationFrame( function() {
                        var cursorX = event.pageX;
                        var cursorY = event.pageY - window.scrollY;
                        var heroRect = that.getBoundingClientRect();
                        var availableSpaceX = -1 + (that.querySelector('.' + moving_image_class).getBoundingClientRect().width - heroRect.width) / 2;
                        var availableSpaceY = -1 + (that.querySelector('.' + moving_image_class).getBoundingClientRect().height - heroRect.height) / 2;
                        var percentY = cursorY * 100 / (heroRect.bottom - heroRect.top);
                        var percentX = cursorX * 100 / (heroRect.right - heroRect.left);
                        var translateX = 2 * (availableSpaceX / 2 - (availableSpaceX * percentX / 100));
                        var translateY = 2 * (availableSpaceY / 2 - (availableSpaceY * percentY / 100));
                        that.querySelector('.' + moving_image_class).style.transform = "translate(" + translateX + "px, " + translateY + "px)";
                    });
                }
            })
        }
    }

    /**************Collapse**************/
    var active_collapse = false;
    var collapse_items = document.getElementsByClassName('collapse');
    if(collapse_items.length > 0) {
        for(var i = 0; i < collapse_items.length; i++) {
            var list_height = collapse_items[i].getBoundingClientRect().bottom - collapse_items[i].getBoundingClientRect().top;
            collapse_items[i].setAttribute('data-height', list_height + 'px');
            collapse_items[i].style.height = 0;
            collapse_items[i].style.opacity = 1;
            collapse_items[i].style.transition = "height 0.5s ease, opacity 0.5s ease";
            collapse_items[i].parentElement.addEventListener('click', function() {
                let child = this.querySelector('.collapse');
                child.style.height = child.getAttribute('data-height');
                if(active_collapse) active_collapse.style.height = 0;
                if(active_collapse === child) {
                    this.classList.remove('is-open');
                    active_collapse = false;
                }
                else {
                    if(active_collapse) active_collapse.parentElement.classList.remove('is-open');
                    this.classList.add('is-open');
                    active_collapse = child;
                }
            });
        }
    }

    /****Waypoints*****/

    buildWaypoints = function() {
        // Fade in will always exist because it is attached to logo
        if(typeof $('.fadeIn').waypoint !== "function") return;

        $('.img_mask, .test_image, .fadeIn, .fadeInUp, .zoomOut').waypoint({
            handler: function() {
                $(this.element).addClass("is-visible")
            },
            offset: '90%',
            context: document.getElementById('page-wrapper')
        });

        $('.restrained').waypoint({
            handler: function() {
                $(this.element).removeClass("restrained")
            },
            offset: '100%',
            context: document.getElementById('page-wrapper')
        });

    }();

});