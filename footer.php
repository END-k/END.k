    <footer id="gFooter">
        <div class="hBox flexB">
            <div class="lBox">
                <div class="fLogo"><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/f_logo.png" alt="株式会社オプトロンサイエンスOptronscience,Inc."></a></div>
                <p class="place">商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                    <div class="inputBox">
                        <input type="text" name="s" class="inputText">
                        <input type="submit" value="検索" class="inputButton">
                    </div>
                </form>
                <p class="ttl">ご質問・資料請求などはこちらから</p>
                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></div>
                <address class="pc">&copy;2022 optronscience,inc.</address>
            </div>
            <div class="rBox">
                <ul class="link01">
                    <li><a href="<?php bloginfo('url');?>/business">事業内容</a></li>
                    <li><a href="<?php bloginfo('url');?>/case">事例一覧</a></li>
                    <li><a href="<?php bloginfo('url');?>/distributor">取扱メーカー</a></li>
                    <li><a href="<?php bloginfo('url');?>/news">ニュース</a></li>
                </ul>
                <ul class="link02 flexB">
                    <li><a href="<?php bloginfo('url');?>/product"><span>製品情報</span></a>
                        <div class="fLinkBox">
                            <!-- PC -->
                            <ul class="fatUl flexB f_product_box">
                                <?php
                                    $args02 = array(
                                        'taxonomy' => 'productcat',
                                        // 'hide_empty' => 0,
                                        'exclude' => '',
                                        'parent' => 0,
                                        'orderby' => 'slug'//←カテゴリ「説明」欄にて入れた数値を使ってソートする。
                                        );
                                    $terms = get_terms( $args02 );//term取得
                                    //並べ替え
                                    usort($terms, function ($a, $b) {
                                        return $a->description - $b->description;
                                    });
                                    if($terms){
                                ?>
                                <li>
                                    <ul class="subUl f_product">
                                    <?php foreach($terms as $term) {
                                        $curId = $term->term_id;
                                        $showname = get_field('ff_showname', 'productcat_'.$curId);
                                        $bigId = $term->term_id;
                                    ?>
                                        <li>
                                            <a href="<?php echo get_term_link( $curId );?>">
                                                <span><?php if($showname){ echo $showname; }else { echo $term->name; } ?></span>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                            <!-- /PC -->
                            <!-- SP -->
                            <ul class="fatUl flexB f_product_box_sp">
                                <?php
                                    $args = array(
                                        'taxonomy' => 'productcat',
                                        // 'hide_empty' => 0,
                                        'exclude' => '',
                                        'parent' => 0,
                                        'orderby' => 'slug'//←カテゴリ「説明」欄にて入れた数値を使ってソートする。
                                    );
                                    $terms = get_terms( $args );//term取得
                                    //並べ替え
                                    usort($terms, function ($a, $b) {
                                        return $a->description - $b->description;
                                    });

                                    if($terms){
                                ?>
                                <div class="subUlBox">
                                    <div class="subInnBox">
                                        <ul class="subUl flex">
                                        <?php foreach($terms as $term) {
                                            $curId = $term->term_id;
                                            $showname = get_field('ff_showname', 'productcat_'.$curId);
                                            $bigId = $term->term_id;
                                        ?>
                                            <!-- 大カテゴリ -->
                                            <li class="liStyle01 li01">
                                                <a href="<?php echo get_term_link( $curId );?>">
                                                    <span><strong><?php if($showname){ echo $showname; }else { echo $term->name; } ?></strong></span>
                                                </a>
                                                <!-- 中カテゴリ -->
                                                <?php
                                                    $args01 = array(
                                                        'taxonomy' => 'productcat',
                                                        // 'hide_empty' => 0,
                                                        'exclude' => '',
                                                        'parent' => $bigId,
                                                    );
                                                ?>
                                                <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                                    <div class="grandSubBox sp">
                                                        <p class="ttl"><?php if($showname){ echo $showname; }else { echo $term->name; } ?><br>
                                                            カテゴリーを見る</p>
                                                            <ul class="grandSubUl">
                                                            <?php foreach($terms01 as $term01) { $secondId = $term01->term_id; ?>
                                                                <li><a href="<?php echo get_term_link( $term01->term_id );?>"><?php echo $term01->name; ?></a></li>
                                                            <?php } ?>
                                                            </ul>
                                                        <p class="close"><span>閉じる <small>-</small></span></p>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                            </ul>
                            <!-- /SP -->
                        </div>
                    </li>
                    <li class="liStyle01"><a href="<?php bloginfo('url');?>/company"><span>会社情報</span></a>
                        <div class="fLinkBox">
                            <ul class="fatUl fatUl01">
                                <li>
                                    <ul class="subUl">
                                        <li><a href="<?php bloginfo('url');?>/policy">環境方針・品質方針</a></li>
                                        <li><a href="<?php bloginfo('url');?>/privacy">プライバシーポリシー</a></li>
                                        <li><a href="<?php bloginfo('url');?>/recruit">採用情報</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <address class="sp">&copy;<?php echo date('Y'); ?> optronscience,inc.</address>
        </div>
    <div class="pageTop"><a href="#container"><span>TOP</span></a></div>
    </footer>
</div>

<script src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.matchHeight.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.jscrollpane.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.mousewheel.js"></script>
<?php if(is_home()||is_front_page()||is_page("detail")){ ?>
<script src="<?php bloginfo('template_url');?>/js/slick/slick.js"></script>
<?php }else if(is_singular("product")){ ?>
<script src="<?php bloginfo('template_url');?>/js/slick/slick.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.jscrollpane.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.mousewheel.js"></script>
<?php } ?>
<script src="<?php bloginfo('template_url');?>/js/common.js"></script>
<?php if(is_home()||is_front_page()){ ?>
<script>
    $(function(){
        $('.svgBox').addClass('active');
        if($(window).width() < 897){
            var num = $('.slideBox .slide li').length - 1;
            $('.slideBox .slide').slick({
                dots: true,
                arrows: false,
                autoplay: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 1000,
                autoplaySpeed: 4500,
                slidesToScroll: 1,
                slidesToShow: num,
                centerMode: true,
                centerPadding: 0,
                variableWidth: true,
            });
        }

        $('.index .mainVisual .innBox .comBtn a').click(function(){
            $('.index .mainVisual .innBox .form01').submit();
            return false;
        });
    })
</script>
<?php }else if(is_post_type_archive("distributor")||is_tax("distributorcat")){ ?>
<script>
	$(function(){
		$('#main .phoList li h3').matchHeight();

        $(".downBox .down a").click(function(){
			$(this).children("span").text("+");
			$(this).children("span").toggleClass("on");
			$(this).children(".on").text("-");
			$(this).parents(".downBox").find(".comLinkUlBox").slideToggle(300)
			return false;
		});

        $(".distributor .imgLinkUl li .rBox .ttl .txt02").click(function(){
            $(this).toggleClass("on");
            $(this).parents(".ttl").next(".txt").slideToggle(300);
            return false;
        });

        $(".distributor .borBox .cat02 a").click(function(){
            $(this).parents(".cat02").next(".linkBox").slideToggle(300);
            return false;
        });

	});
</script>
<?php }else if(is_page("contact")){ ?>
<script>
    function get() {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: '<?php bloginfo('template_url');?>/title.php?id=' + window.location.hash.replace("#", ""),
            success: function(res) {
                $('.contact .formBox td .textArea01').val(res.title);
                $('.contact .formBox td .textArea02').val(res.permlink);
            },
            error : function(error){  }
        });
    }

    $(function(){
        if(window.location.hash.replace("#", "")!=0){
            get();
        }

        $('select[name="consult"]').find('option').eq(0).val('');
    });
</script>
<?php }else if(is_tax("productcat")){ ?>
<script>
	$(function(){
		$('#main .phoList li h3').matchHeight();
	});
</script>
<?php }else if(is_tax("wavelengthcat")){ ?>
<script>
	$(function(){
        $('.wavelength .conditionsBox .lkBox .link a').click(function(){
            $('.wavelength .conditionsBox form').submit();
            return false;
        });

        $(".comTopBorBox .down a").click(function(){
			$(this).html("もっと細かく指定する<span>+</span>");
			$(this).toggleClass("on");
			$(".comTopBorBox .down .on").html("検索条件をたたむ<span>-</span>");
			$(this).parents(".down").next(".conditionsBox").slideToggle(300)
			return false;
		});
    });
</script>
<?php }else if(is_singular("product")){ ?>
<script>
    $( '.productDetailWrap iframe' ).wrap( '<div class="iframeWrap"></div>' );

    $(document).ready(function(){
        $(".comSubBox-close").click(function(){
            $(".comSubBox").hide();
        });
    });

	$(function(){
		$('#gFooter').addClass("ftrPadding");
		$('#main .phoList li h3').matchHeight();
        $(function(){
            $('.slideBox01 .slide').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                autoplay: false,
                dots: false,
                asNavFor: '.slideBox02 .slide',
                centerMode: true,
                centerPadding: 0,
            });
            var length = $('.slideBox02 li').length - 1;
            $('.slideBox02 .slide').slick({
                slidesToScroll: 1,
                arrows: true,
                autoplay: false,
                dots: false,
                asNavFor: '.slideBox01 .slide',
                centerPadding: 0,
                focusOnSelect: true,
                variableWidth: true,
                prevArrow: '<div class="prev"><button class="slide-arrow prev-arrow"></button></div>',
                nextArrow: '<div class="next"><button class="slide-arrow next-arrow"></button></div>'
            });
        })
        if($(window).width() < 897){
            $('.detailSlideBox .slide').slick({
                dots: true,
                arrows: false,
                autoplay: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 1000,
                autoplaySpeed: 4500,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: 0,
                variableWidth: true,
            });
        }
	});
</script>
<?php }else if(is_singular('case')){ ?>
<script>
    $(function(){
        $( '.caseDetailWrap iframe' ).wrap( '<div class="iframeWrap"></div>' );

        $('.comSubBox-close').on('click', () => {
            $('.comSubBox').hide();
        });
    });
</script>
<?php }else if(is_page('detail')){ ?>
<script>
	$(function(){
		$('#gFooter').addClass("ftrPadding");
		$('#main .phoList li h3').matchHeight();
        if($(window).width() < 897){
            $('.detailSlideBox .slide').slick({
                dots: true,
                arrows: false,
                autoplay: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 1000,
                autoplaySpeed: 4500,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: 0,
                variableWidth: true,
            });
        }
	});
</script>
<?php }else if(is_search()){ ?>
<script>
	$(function(){
        $('.sdwLink').click(function() {
            $('.sdwBox--toggle').toggle(200);
        })
    });
</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>

<!-- フリーワード検索、ラスト１文字"ー"の場合削除 -->
<script>
// ボタンのイベントを設定する
//   $('#word_search').on('click', function() {
//     $("form").submit(function() {
//         const textbox = document.getElementById("input-message");
//         let value = textbox.value;
//         let last = value.slice(-1);
//         const url = new URL(location);
//         const test = url.toString();
        
//         // alert(last + "送信します。");
//         // if(last !== "ー"){
//             //let text = value;
//         // }else{
//             let text = value.substring(0, value.length - 1);
//         // }
//         alert(test + "送信します。");
//     });
//   });

//   $('#word_search').on('click', function() {
//     $("form").submit(function() {
//         const url = new URL(window.location.href);
//         const params = url.searchParams;

//         if( params.get('s') ) {
//             params.set('s','taro');
//             alert(params.get('s'));
//         }
//     });
// });

/* 余計なGET送信をdisabledでコントロールする。 */
function myCheck1(){
    // 1番目のラジオボタン（出力検索しない）がチェックされているかを判定
    if(document.form1.outputs[0].checked){
        //alert(document.form1.fruits[0].value + "が選択されました。");
        // disabled属性を設定
        document.getElementById("b2").setAttribute("disabled", true);
        document.getElementById("b3").setAttribute("disabled", true);
    }
}
function myCheck2(){
    // 2番目のラジオボタン(mW)がチェックされているかを判定
    if(document.form1.outputs[1].checked){
        //alert(document.form1.fruits[1].value + "が選択されました。");
        // disabled属性を削除
		document.getElementById("b2").removeAttribute("disabled");

        // disabled属性を設定
        document.getElementById("b3").setAttribute("disabled", true);
    }
}
function myCheck3(){
    // 3番目のラジオボタン(W)がチェックされているかを判定
    if(document.form1.outputs[2].checked){
        //alert(document.form1.fruits[2].value + "が選択されました。");
        // disabled属性を削除
		document.getElementById("b3").removeAttribute("disabled");

        // disabled属性を設定
        document.getElementById("b2").setAttribute("disabled", true);

    }
}

function paramMod(obj) {
    let inputText = $(obj).siblings()[0].value;
    
    // 検索文字にハイフンがあればハイフン削除
    if(inputText.slice(-1) == "ー") {
       inputText = inputText.slice(0, -1);
    }

    // inputに戻す
    $(obj).siblings()[0].value = inputText;
}
</script>