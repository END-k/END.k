$(function () {
	$('a[href*=\\#]:not([href=\\#])').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
			if ($target.length) {
				if ($(this).parents('.menuBox').length) {
					setTimeout(function () {
						var targetOffset = $target.offset().top - $("#gHeader").outerHeight();
						$('html,body').animate({ scrollTop: targetOffset }, 1000);
					}, 100);
				} else {
					var targetOffset = $target.offset().top - $("#gHeader").outerHeight();
					$('html,body').animate({ scrollTop: targetOffset }, 1000);
				}
				return false;
			}
		}
	});
	var position;
	var posleft;
	if ($(window).width() > 896) {
		$("#gNavi .fatherUl .subUl .innBox .bgBox .innLinkUl > li:has('.borBox') > a").click(function () {
			position = $(this).parents('.innLinkUl').position().top + $(this).parents('.innLinkUl').height() - 28;
			$(this).next(".borBox").css('top', position).stop(true, true).slideToggle(300);
			$(this).parent().siblings().children(".borBox").hide();
			return false;
		});
		$('#gNavi .fatherUl .subUl > li > .innBox').mouseleave(function () {
			$(".borBox").stop(true, true).slideUp(10);
		});
		// $("#gNavi .fatherUl .subUl > li").hover(function() {
		//     position = $(this).position().top + 5 + $(this).height();
		//     posleft = $(this).position().left + 94;
		//     $(this).find(".arrow").css('left',posleft);
		// 	$(this).children(".innBox").css('top',position).stop(true, true).slideDown(300);
		// },function() {
		// 	$(this).children(".innBox").stop(true, true).slideUp(10);
		// });
		$("#gNavi .fatherUl .subUl > li:has('.innBox') > a").click(function () {
			position = $(this).parent().position().top + 10 + $(this).innerHeight();
			posleft = $(this).parent().position().left + 94;
			$(this).next().find(".arrow").css('left', posleft);
			$(this).next(".innBox").css('top', position).stop(true, true).slideDown(300);
			return false;
		});
		$("#gNavi .fatherUl .subUl > li").mouseleave(function () {
			$(this).children(".innBox").stop(true, true).slideUp(10);
		});
		$("#gNavi .fatherUl > li").hover(function () {
			$(this).addClass("on");
			$(this).children(".subUlBox").stop(true, true).slideDown(300);
		}, function () {
			$(this).removeClass("on");
			$(this).children(".subUlBox").stop(true, true).slideUp(10);
		});
	} else {
		$("#gNavi .fatherUl .subUl .innBox .bgBox .innLinkUl > li:has(.borBox) > a").click(function () {
			$(this).parent().toggleClass("on");
			$(this).parent().children(".borBox").slideToggle(300);
			return false;
		});
		$("#gNavi .fatherUl .subUl > li:has(.innBox) > a").click(function () {
			$(this).parent().toggleClass("on");
			$(this).parent().children(".innBox").slideToggle(300);
			return false;
		});
		$("#gNavi .fatherUl > li:has(.subUlBox) > a > span").click(function () {
			$(this).toggleClass("on");
			$(this).parents("#gNavi .fatherUl > li").children(".subUlBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 .fatUl .subUl > li:has(.grandSubBox) > a").click(function () {
			$(this).toggleClass("on");
			$(this).next(".grandSubBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 .fatUl .subUl > li .close").click(function () {
			$(this).toggleClass("on");
			$(this).parents(".grandSubBox").slideToggle(300);
			return false;
		});
		$("#gFooter .rBox .link02 > li > a span").click(function () {
			$(this).toggleClass("on");
			$(this).parents("a").next(".fLinkBox").slideToggle(300);
			return false;
		});
	}
	$(".comSelectUl > li .iptBox > a").click(function () {
		$(this).toggleClass("on").parents('li').siblings().find('.iptBox > a').removeClass('on');
		$(this).parents('li').siblings().find('.enUlBox').slideUp(300);
		$(this).next(".enUlBox").slideToggle(300, function () {
			$(window).trigger('resize');
		});
		$(this).parent(".iptBox").children('.cat01').val('');
		return false;
	});


	$(document).bind("click", function (e) {
		if (!$(e.target).closest(".iptBox").length) {
			$('.enUlBox').slideUp(300);
		}
	});

	//TOPページ、ヘッダー検索submit
	$('.selectBox .comBtn a').click(function () {
		$('.selectBox .form01').submit();
		return false;
	});

	//TOPページ、ヘッダー検索submit
	// $('.comBtn2 a').click(function () {
	// 	$('.form03').cleanQuery();
	// 	$('.selectBox .form03').submit();
	// 	return false;
	// });

	$('.enUlBox a').click(function () {
		if ($(this).next('ul').length || $(this).next('div').length) {
			$(this).next().slideToggle(300, function () {
				$(window).trigger('resize');
			});
			$(this).parents(".iptBox").children('.cat01').val('');
		} else {
			var text = $(this).text();
			$(this).parents(".iptBox").children(".link01").text(text);
			var catId = $(this).data('id01');
			$(this).parents(".iptBox").children('.cat01').val(catId);
			// $(".enUlBox").slideUp(300);
			$(".enUlBox").slideUp(300);
		}
		return false;
	});

	if ($(window).width() > 896) {
		$(".comLinkUlBox01 .down a").click(function () {
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".downBox").children(".comLinkUlBox").slideToggle(300);
			return false;
		});
	} else {
		$(".comLinkUlBox01 .down a").click(function () {
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox01").children(".comLinkUlBox02").slideToggle(300);
			return false;
		});
	}

	if ($(window).width() > 896) {
		$(".comLinkUlBox03 .down a").click(function () {
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox03").find(".downBox").slideToggle(300)
			return false;
		});
	} else {
		$(".comLinkUlBox03 .down a").click(function () {
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".comLinkUlBox03").find(".comLinkBox").slideToggle(300);
			return false;
		});
	}

	$(".category .down a").click(function () {
		$(this).children("span").text("+");
		$(this).children("span").toggleClass("on");
		$(this).children(".on").text("-");
		$(this).parents(".downBox").children(".comLinkUlBox").slideToggle(300);
		return false;
	});

	var state01 = false;
	var scrollpos;
	$('#gHeader .rBox .hBtn a').on('click', function () {
		if (state01 == false) {
			scrollpos = $(window).scrollTop();
			if ($(window).width() < 897) {
				$('body').addClass('fixed').css({ 'top': -scrollpos });
			}
			$('.selectBox').stop().slideDown(300);
			$('#gHeader .rBox .hBtn a').addClass('active');
			state01 = true;
			if (state == true) {
				$('.menuBox').stop().slideUp(300);
				$('.menu-trigger').removeClass('active');
				state = false;
			}

		} else {
			$('body').removeClass('fixed').css({ 'top': 0 });
			window.scrollTo(0, scrollpos);
			$('.selectBox').stop().slideUp(300);
			$('#gHeader .rBox .hBtn a').removeClass('active');
			state01 = false;
		}
		return false;
	});

	$('.selectBox .hBtn a').on('click', function () {
		$('body').removeClass('fixed').css({ 'top': 0 });
		window.scrollTo(0, scrollpos);
		$('.selectBox').stop().slideUp(300);
		$('#gHeader .rBox .hBtn a').removeClass('active');
		state01 = false;
		return false;
	});

	var state = false;
	var scrollpos;
	$('.menu-trigger').on('click', function () {
		if (state == false) {
			scrollpos = $(window).scrollTop();
			$('body').addClass('fixed').css({ 'top': -scrollpos });
			$('.menuBox').stop().slideDown(300);
			$('.menu-trigger').addClass('active');
			state = true;
			if (state01 == true) {
				$('.selectBox').stop().slideUp(300);
				$('#gHeader .rBox .hBtn a').removeClass('active');
				state01 = false;
			}
		} else {
			$('body').removeClass('fixed').css({ 'top': 0 });
			window.scrollTo(0, scrollpos);
			$('.menuBox').stop().slideUp(300);
			$('.menu-trigger').removeClass('active');
			state = false;
		}
		return false;
	});

	var pcflag, spflag;
	if ($(window).width() > 896) {
		pcflag = 1;
		spflag = 0;
	} else {
		pcflag = 0;
		spflag = 1;
	}

	$(window).resize(function () {
		if ($(window).width() < 897) {
			if (pcflag) {
				setTimeout(function () { window.location.reload() }, 100);
				pcflag = 0;
				spflag = 1;
			}
		} else {
			if (spflag) {
				setTimeout(function () { window.location.reload() }, 100);
				pcflag = 1;
				spflag = 0;
			}
		}
	});
	if ($(window).width() < 897) {
		$('#main .privacyBox').each(
			function () {
				$(this).jScrollPane(
					{
						//showArrows: $(this).is('.arrow')
					}
				);
				var api = $(this).data('jsp');
				var throttleTimeout;
				$(window).bind(
					'resize',
					function () {
						if (!throttleTimeout) {
							throttleTimeout = setTimeout(
								function () {
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

	if ($(window).width() > 898) {
		$('#gHeader + .selectBox .privacyBox').each(
			function () {
				$(this).jScrollPane(
					{
						//showArrows: $(this).is('.arrow')
					}
				);
				var api = $(this).data('jsp');
				var throttleTimeout;
				$(window).bind(
					'resize',
					function () {
						if (!throttleTimeout) {
							throttleTimeout = setTimeout(
								function () {
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

$(window).on('load', function () {
	var localLink = window.location + '';
	if (localLink.indexOf("#") != -1 && localLink.slice(-1) != '#') {
		localLink = localLink.slice(localLink.indexOf("#") + 1);
		if ($('#' + localLink).length) {
			$('html,body').animate({ scrollTop: $('#' + localLink).offset().top - $("#gHeader").outerHeight() }, 500);
		}
	}
});

/* mW,Wで入力した値を連動させる */
function keepInputValue() {
	const mwradio = document.getElementById("mW");
	const wradio = document.getElementById("W");
	const mwvalue = document.getElementById("mW").value;
	const wvalue = document.getElementById("W").value;

	mwradio.value = wvalue;
	wradio.value = mwvalue;
}


$(function(){
	/* nameがoutputのラジオボタンが変更された場合の処理 */
	$( 'input[name="w"]:radio' ).change( function() {

	/* nameがoutputのラジオボタンで選択されている値を取得 */
	let selectdata = $("input[name='w']:checked").val();

	/* その値が`W`だったら単位制限がないものを表示。違えば非表示にする */
	if(selectdata == "W"){
		$(".wavetext01").hide();
		$(".cnt_area").hide();
		$(".wavetext02").show();
	} else {
		$(".wavetext02").hide();
		$(".wavetext01").show();
		$(".cnt_area").show();
		}
	});

	//インプット要素を取得する
	let inputs = $('input');
	//読み込み時に「:checked」の疑似クラスを持っているinputの値を取得する
	let checked = inputs.filter(':checked').val();

	//インプット要素がクリックされたら
	inputs.on('click', function(){
		//クリックされたinputとcheckedを比較
		if($(this).val() === checked) {
			//inputの「:checked」をfalse
			$(this).prop('checked', false);
			//checkedを初期化
			checked = '';
		} else {
			//inputの「:checked」をtrue
			$(this).prop('checked', true);
			//inputの値をcheckedに代入
			checked = $(this).val();
		}
	});
});

/* 余計なGET送信をdisabledでコントロールする。 */
// function clickBtn1(){
// 	if (document.getElementById("b1").disabled === true){
// 		// disabled属性を削除
// 		document.getElementById("b1").removeAttribute("disabled");
// 	}else{
// 		// disabled属性を設定
// 		document.getElementById("b1").setAttribute("disabled", true);
// 	}
// }