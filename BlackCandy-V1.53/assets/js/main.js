window.onload = function () {
    $(window).trigger("scroll");
};
$(window).resize(function () {
    $(window).trigger("scroll");
});

$(document).ready(function(){
    // navigation button
	$(".menu-button").click(function(){
		$(".mobile-menu-wrap").slideToggle(2);
	});

    function noticeCarousel() {
        $(".notice-wrap ul").animate({
            "top": "-24px"
        }, 450, function () {
            $(this).css("top", 0);
            $(this).append($(this).find("li:first"));
        });
    }
    var noticeNums = $(".notice-wrap ul li").length;
    if (noticeNums > 1) {
        setInterval(noticeCarousel, 3000);
    }
    // article fancybox
    if (fancyboxSwitcher && !isHomePage) {
        var siteTitle = $("title").html();
        $(".article-body img, .page-common img").each(function () {
            var alt = this.alt;
            var src = this.src;
            if (!alt) {
                $(this).attr("alt", siteTitle);
            }
            $(this).wrap("<a href='"+ src +"' class='fancybox' rel='fancybox-group' title='"+ alt +"'></a>");
            // set the img alt
        });

        $(".fancybox").fancybox({
            'padding': 0,
            'opacity': true,
            'cyclic': true,
        });
    }

    // carousel
    if (carouselSwitcher && isHomePage) {
        var mainWidth = $('#main').innerWidth();
        var sliderHeight = $('#carousel').innerHeight();
        $('#carousel .carousel-item').each(function(index, el) {
            $(this).innerWidth(mainWidth);
            $(this).innerHeight(sliderHeight);
        });
        switch(carouselType){
            case "slide":
                $('.carousel-wrap').addClass('carousel-slide');
                $('body').css({
                    'paddingTop': '60px'
                });
                $("#carousel").owlCarousel({
                    autoplay:true,
                    autoplayTimeout:5000,
                    smartSpeed: 200,
                    items : 1,
                    loop: true,
                    // autoplayHoverPause: true,
                    responsive: {
                        768 : {
                            items: 1,
                            margin: 12,
                            autoWidth:true,
                            center: true,
                        },
                        992 : {
                            items: 2,
                            margin: 12,
                            smartSpeed: 200,
                            center: true,
                            autoWidth:true,
                            nav : true,
                            navText:'',
                        }
                    }
                });
                break;
            case "image":
                $("#carousel").owlCarousel({
                    autoplay:true,
                    autoplayTimeout:5000,
                    smartSpeed: 200,
                    items : 1,
                    loop: true,
                    // autoplayHoverPause: true,
                    responsive: {
                        768 : {
                            items: 1,
                            margin: 0,
                        },
                        992 : {
                            items: 2,
                            margin: 12,
                            smartSpeed: 200,
                            center: true,
                            autoWidth:true,
                            nav : true,
                            navText:'',
                        }
                    }
                });
                break;
            case "one":
                $('#carousel').css({
                    'width': mainWidth,
                    'margin': '0 auto',
                });
                $("#carousel").owlCarousel({
                    items: 1,
                    loop:true,
                    autoplay:true,
                    autoplayTimeout:4000,
                    smartSpeed: 200,
                });
                break;
            default:
                break;
        }
    }
    $('.owl-prev').append('<i class="fa fa-chevron-left">');
    $('.owl-next').append('<i class="fa fa-chevron-right">');

    /**
     * MouseWheel
     */
    if (carouselSwitcher && carouselMouseSwitcher) {
        $('#carousel').bind('mousewheel', function(event, delta, deltaX, deltaY){
            event.preventDefault();
            if (delta == -1){
                $('.owl-next').click();
            }
            if (delta == 1){
                $('.owl-prev').click();
            }
        });
    }

    // 赞
  	$('.article-support-button .btn').bind({
        mouseenter: function(){
            $(".article-support-img").show();
            $(".article-support-img").animate({
                bottom: '46px',
                opacity: 1,
            }, 300);
        },
        mouseleave: function() {
            $(".article-support-img").animate({
                bottom: '58px',
                opacity: 0,
            }, 300, function(){
                $(this).hide();
            });
        },
    });

    $(".search-button").click(function () {
       $(".mobile-search-wrap").toggle(2);
    });
    $(".mobile-search-wrap .fa-close").click(function () {
       $(".mobile-search-wrap").hide();
    });
    // search click
    $('.header-search input').click(function(event) {
        $('.header-search').animate({width: '180px'},300);
    });
    $('.header-search input').blur(function(event) {
        $('.header-search').animate({width: '100px'},300);
    });

    // sidebar fixed
    var headerH = $('#header').height();
    var sidebarW = $('#sidebar').width();
    var noticeH = $('.notice').outerHeight(true);
    var footerH = $('#footer').innerHeight();
    var windowH = $(window).height();
    var sidebarH = $('#sidebar').outerHeight();

    // mobile search wrap
    $(".mobile-search-wrap").height(windowH);

    $('main').css({
        'minHeight': windowH - headerH - footerH,
    });
    scrollTop = 0;
    var temp = 0;
    $(window).scroll(function(event) {
        var bodyH = $(document).height();
        var carouselH = $('.carousel-wrap').outerHeight();
        var footerH = $('#footer').innerHeight();
        var windowH = $(window).height();
        var affixH = $(".affix").innerHeight();
        var leftH = (windowH - headerH - affixH - 6) > 0 ? (windowH - headerH - affixH - 6) : 0;
        scrollTop = $(document).scrollTop();
        if (scrollTop > 1200) {
            $('.scrollTop').show();
        } else {
            $('.scrollTop').hide();
        }
        var scrollBottom = bodyH - windowH - scrollTop;
        if (scrollTop > headerH + carouselH + noticeH + sidebarH) {
            if (scrollTop < (bodyH - footerH - windowH + leftH)) {
                $('.affix').css({
                    position: 'fixed',
                    top: '66px',
                    bottom: '',
                    width: sidebarW + 'px'
                });
            } else {
                $('.affix').css({
                    position: 'fixed',
                    top: '',
                    bottom: footerH - scrollBottom,
                    width: sidebarW + 'px',
                });
            }
        } else {
            $('.affix').css({
                position: '',
                top: '',
                width: sidebarW + 'px',
            });
        }
  	});
    /**
     * to top
     */
    $('.scrollTop').click(function(){
        $('body,html').animate({scrollTop:0},600);
        return false;
    });

    /**
     * show descendant menu
     */
  	$('.menu-item-has-children').bind({
  		mouseenter: function() {
  			$(this).children('.sub-menu').css({
  				'transform': 'scale3d(1,1,1)',
  				'opacity': 1
  			});
  		},mouseleave: function() {
  			$(this).children('.sub-menu').css({
  				'transform': 'scale3d(0,0,0)',
  				'opacity': 0
  			});
  		}
  	});
    /**
     * show wechat img
     */
    $(".follow-wechat").bind({
        mouseenter: function () {
            $(this).find('.follow-wechat-popup').show();
            $(this).find('.follow-wechat-popup').animate({
                bottom: '48px',
                opacity: 1,
            }, 300);
        }, mouseleave: function () {
            $(this).find('.follow-wechat-popup').animate({
                bottom: '58px',
                opacity: 0,
            }, 300, function () {
                $(this).hide();
            });
        }
    });

    /**
     *
     * @returns {boolean}
     */
    $.fn.postLike = function() {
        var id = $(this).data("id"),
            action = $(this).data('action'),
            rateHolder = $(this).children('.count');
        if ($(this).hasClass('done')) {
            $(this).removeClass('done');
            var _this = $(this);
            var ajaxData = {
                action: "subLike",
                um_id: id,
                um_action: action
            };
            $.ajax({
                type: "POST",
                url: siteUrl+"/wp-admin/admin-ajax.php",
                data: ajaxData,
                beforeSend: function () {
                    _this.find('i').animate({
                        "fontSize": "15px"
                    }, 1, function () {
                        $(this).removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
                        $(this).animate({
                            "fontSize": "15px"
                        }, 1);
                    });

                },
                success: function(data) {
                    $(rateHolder).html(data);
                }
            });
            return false;
        } else {
            $(this).addClass('done');
            var _this = $(this);
            var ajaxData = {
                action: "addLike",
                um_id: id,
                um_action: action
            };
            $.ajax({
                type: "POST",
                url: siteUrl+"/wp-admin/admin-ajax.php",
                data: ajaxData,
                beforeSend: function () {
                    _this.find('i').animate({
                        "fontSize": "15px"
                    }, 1, function () {
                        $(this).removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
                        $(this).animate({
                            "fontSize": "15px"
                        }, 1);
                    });

                },
                success: function(data) {
                    $(rateHolder).html(data);
                }
            });
            return false;
        }
    };
    $(document).on("click", ".favorite", function() {
            $(this).postLike();
    });

    // break out of iframe
    // if (parent.frames.length > 0) {
    //     parent.location.href = location.href;
    // }
    $(".owl-next").bind({
        mouseenter: function() {
            $(this).children(".fa").css({
                textShadow: "2px 0 1px #444"
            });
        },
        mouseleave: function () {
            $(this).children(".fa").css({
                textShadow: "0 0 2px #555"
            });
        },
        mousedown: function() {
            $(this).css({right: "18%"});
        },
        mouseup: function () {
            $(this).css({right: "19%"});
        }
    });
    $(".owl-prev").bind({
        mouseenter: function() {
            $(this).children(".fa").css({
                textShadow: "-2px 0 1px #444"
            });
        },
        mouseleave: function () {
            $(this).children(".fa").css({
                textShadow: "0 0 2px #555"
            });
        },
        mousedown: function() {
            $(this).css({left: "18%"});
        },
        mouseup: function () {
            $(this).css({left: "19%"});
        }
    });

    $(".mobile-menu-wrap").css("maxHeight", windowH-52);

    var pagMoreFlag = 1;
    $(window).scroll(function() {
        if (pagType == "infinite" && $(document).scrollTop() + $(window).height() > $(document).height() - 80 && pagMoreFlag == 1) {
            paginationMore($(".pagination .more a"));
        }
    });
    function paginationMore(_this) {
        pagMoreFlag = 0;
        _this.text("加载中").append("<i class='fa fa-refresh fa-spin fa-fw'></i>");
        $.ajax({
            type: "POST",
            url: _this.attr("href"),
            success: function(data){
                result = $(data).find(".post-wrap").children();
                nextHref = $(data).find(".pagination .more a").attr("href");
                // ajax content fadeIn
                $(".post-wrap").append(result.fadeIn(500));
                pagMoreFlag = 1;
                _this.text("加载更多");
                if ( nextHref != undefined ) {
                    _this.attr("href", nextHref);
                } else {
                    // without more articles, remove the pagination navigatino
                    _this.remove();
                    pagMoreFlag = 0;
                    $(".pagination .more").append("没有更多文章了");
                }
            }
        });
    }
    $(".pagination .more a").click(function(){
        paginationMore($(this));
        return false;
    });
    var articleW = $(".article-body").width();
    var iframeW = $(".article-body iframe").attr("width");
    var iframeH = $(".article-body iframe").attr("height");
    if ($(".article-body iframe").width() == articleW) {
        $(".article-body iframe").height(articleW * iframeH / iframeW - 80);
    }

});



