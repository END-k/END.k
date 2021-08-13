$(function(){
	$('a[href*=\\#]:not([href=\\#])').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
			if ($target.length) {
				if($(this).parents('.menuBox').length){
					setTimeout(function(){
						var targetOffset = $target.offset().top - $("#gHeader").outerHeight();
						$('html,body').animate({scrollTop: targetOffset}, 1000);
					},100);
				}else{
					var targetOffset = $target.offset().top - $("#gHeader").outerHeight();
					$('html,body').animate({scrollTop: targetOffset}, 1000);
				}
				return false;
			}
		}
	});
    var position;
    var posleft;
	if($(window).width() > 896){
		$("#gNavi .fatherUl .subUl .innBox .bgBox .innLinkUl > li").hover(function() {
            position = $(this).position().top + 25 + $(this).height();
			$(this).children(".borBox").css('top',position).stop(true, true).slideDown(300);
		},function() {
			$(this).children(".borBox").stop(true, true).slideUp(10);
		});
		$("#gNavi .fatherUl .subUl > li").hover(function() {
            position = $(this).position().top + 5 + $(this).height();
            posleft = $(this).position().left + 94;
            $(this).find(".arrow").css('left',posleft);
			$(this).children(".innBox").css('top',position).stop(true, true).slideDown(300);
		},function() {
			$(this).children(".innBox").stop(true, true).slideUp(10);
		});
		$("#gNavi .fatherUl > li").hover(function() {
			$(this).addClass("on");
			$(this).children(".subUlBox").stop(true, true).slideDown(300);
		},function() {
			$(this).removeClass("on");
			$(this).children(".subUlBox").stop(true, true).slideUp(10);
		});
	}else {
		$("#gNavi .fatherUl .subUl .innBox .bgBox .innLinkUl > li:has(.borBox) > a").click(function(){
			$(this).parent().toggleClass("on");
			$(this).parent().children(".borBox").slideToggle(300);
			return false;
		});
		$("#gNavi .fatherUl .subUl > li:has(.innBox) > a").click(function(){
			$(this).parent().toggleClass("on");
			$(this).parent().children(".innBox").slideToggle(300);
			return false;
		});
		$("#gNavi .fatherUl > li:has(.subUlBox) > a > span").click(function(){
			$(this).toggleClass("on");
			$(this).parents("#gNavi .fatherUl > li").children(".subUlBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 .fatUl .subUl > li:has(.grandSubBox) > a").click(function(){
			$(this).toggleClass("on");
			$(this).next(".grandSubBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 .fatUl .subUl > li .close").click(function(){
			$(this).toggleClass("on");
			$(this).parents(".grandSubBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 > li > a span").click(function(){
			$(this).toggleClass("on");
			$(this).parents("a").next(".fLinkBox").slideToggle(300);
			return false;
		});
	}
	$(".comSelectUl > li .iptBox > a").click(function(){
		$(this).toggleClass("on");
		$(this).next(".enUlBox").slideToggle(300);
        $(this).parent(".iptBox").children('.cat01').val('');
		return false;
	});
    
    $('.selectBox .comBtn a').click(function(){
        $('.selectBox .form01').submit();
        return false;
    });

    $('.enUlBox a').click(function(){
        if($(this).next('ul').length || $(this).next('div').length){
            $(this).next().slideToggle(300);
            $(this).parents(".iptBox").children('.cat01').val('');
        }else {
            var text = $(this).text();
            $(this).parents(".iptBox").children(".link01").text(text);
            var catId = $(this).data('id01');
            $(this).parents(".iptBox").children('.cat01').val(catId); 
            $(".enUlBox").slideUp(300);
        }
        return false;
    });

	if($(window).width() > 896){
		$(".comLinkUlBox01 .down a").click(function(){
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".downBox").children(".comLinkUlBox").slideToggle(300);
			return false;
		});
	}else {
		$(".comLinkUlBox01 .down a").click(function(){
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox01").children(".comLinkUlBox02").slideToggle(300);
			return false;
		});
	}

	if($(window).width() > 896){
		$(".comLinkUlBox03 .down a").click(function(){
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox03").find(".downBox").slideToggle(300)
			return false;
		});
	}else {
		$(".comLinkUlBox03 .down a").click(function(){
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox03").find(".comLinkBox").slideToggle(300);
			return false;
		});
	}

	var state01 = false;
	var scrollpos;
    $('#gHeader .rBox .hBtn a').on('click', function(){
        if(state01 == false) {
            scrollpos = $(window).scrollTop();
			if($(window).width() < 897){
				$('body').addClass('fixed').css({'top': -scrollpos});
			}
            $('.selectBox').stop().slideDown(300);
            $('#gHeader .rBox .hBtn a').addClass('active');
            state01 = true;
			if(state == true) {
				$('.menuBox').stop().slideUp(300);
			 	$('.menu-trigger').removeClass('active');
			 	state = false;
		 	}

        } else {
            $('body').removeClass('fixed').css({'top': 0});
            window.scrollTo( 0 , scrollpos );
            $('.selectBox').stop().slideUp(300);
            $('#gHeader .rBox .hBtn a').removeClass('active');
            state01 = false;
        }
        return false;	
    });

	var state = false;
	var scrollpos;
    $('.menu-trigger').on('click', function(){
        if(state == false) {
            scrollpos = $(window).scrollTop();
            $('body').addClass('fixed').css({'top': -scrollpos});
            $('.menuBox').stop().slideDown(300);
            $('.menu-trigger').addClass('active');
            state = true;
			if(state01 == true) {
				$('.selectBox').stop().slideUp(300);
			 	$('#gHeader .rBox .hBtn a').removeClass('active');
			 	state01 = false;
		 	}
        } else {
            $('body').removeClass('fixed').css({'top': 0});
            window.scrollTo( 0 , scrollpos );
            $('.menuBox').stop().slideUp(300);
            $('.menu-trigger').removeClass('active');
            state = false;
        }
        return false;	
    });

	var pcflag,spflag;
	if($(window).width() > 767){
		pcflag = 1;
		spflag = 0;
	}else{
		pcflag = 0;
		spflag = 1;
	}
	
	$(window).resize(function(){
		if($(window).width() < 768){
			if(pcflag){
				setTimeout(function(){window.location.reload()},100);
				pcflag = 0;
				spflag = 1;
			}
		}else{
			if(spflag){
				setTimeout(function(){window.location.reload()},100);
				pcflag = 1;
				spflag = 0;
			}
		}
	});

	var pcflag,spflag;
	if($(window).width() > 896){
		pcflag = 1;
		spflag = 0;
	}else{
		pcflag = 0;
		spflag = 1;
	}
	
	$(window).resize(function(){
		if($(window).width() < 897){
			if(pcflag){
				setTimeout(function(){window.location.reload()},100);
				pcflag = 0;
				spflag = 1;
			}
		}else{
			if(spflag){
				setTimeout(function(){window.location.reload()},100);
				pcflag = 1;
				spflag = 0;
			}
		}
	});
	if($(window).width() < 897){
		$('.privacyBox').each(
			function(){
				$(this).jScrollPane(
					{
						//showArrows: $(this).is('.arrow')
					}
				);
				var api = $(this).data('jsp');
				var throttleTimeout;
				$(window).bind(
					'resize',
					function(){
						if (!throttleTimeout) {
							throttleTimeout = setTimeout(
								function(){
									api.reinitialise();
									throttleTimeout = null;
								},
								50
							);
						}
					});
			}
		)
	}
});

$(window).on('load',function(){
	var localLink = window.location+'';
	if(localLink.indexOf("#") != -1 && localLink.slice(-1) != '#'){	
		localLink = localLink.slice(localLink.indexOf("#")+1);
        if($('#'+localLink).length){
            $('html,body').animate({scrollTop: $('#'+localLink).offset().top - $("#gHeader").outerHeight()}, 500);
        }
	}
});