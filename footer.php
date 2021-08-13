    <footer id="gFooter">
        <div class="hBox flexB">
            <div class="lBox">
                <div class="fLogo"><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/f_logo.png" alt="株式会社オプトロンサイエンスOptronscience,Inc."></a></div>
                <p class="place sp">商品名・型番・メーカーまたはキーワードを入力</p>
                <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                    <input type="hidden" name="search_type" value="1">
                    <div class="inputBox">
                        <input type="text" name="s" placeholder="商品名・型番・メーカーまたはキーワードを入力" class="inputText">
                        <input type="submit" value="検索" class="inputButton">
                    </div>
                </form>
                <p class="ttl">ご質問・資料請求などはこちらから</p>
                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></div>
                <address class="pc">&copy;2021 optronscience,inc.</address>
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
                            <ul class="fatUl flexB">
                                <li>
                                    <ul class="subUl">
                                        <li class="liStyle01 li01"><a href="<?php bloginfo('url');?>/productcat/自社製品設計・試作・oem"><span><strong>自社製品</strong><br>
                                            <small><strong>(設計・試作・OEM)</strong></small></span></a>
                                            <?php
                                                $args01 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 2,
                                                );
                                            ?>
                                            <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">自社製品に含まれる<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms01 as $term01) { ?>
                                                    <li><a href="<?php echo get_term_link( $term01->term_id );?>"><?php echo $term01->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li class="liStyle01"><a href="<?php bloginfo('url');?>/productcat/光ファイバ端末加工・処理"><span><strong>光ファイバ端末加工・</strong><br>
                                            <strong>処理</strong></span></a>
                                            <?php
                                                $args02 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 53,
                                                );
                                            ?>
                                            <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光ファイバ端末加工・処理<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms02 as $term02) { ?>
                                                    <li><a href="<?php echo get_term_link( $term02->term_id );?>"><?php echo $term02->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li class="liStyle01"><a href="<?php bloginfo('url');?>/productcat/光ファイバ・ファイバコンポーネント"><span><strong>光ファイバ・</strong><br>
                                        <strong>ファイバコンポーネント</strong></span></a>
                                            <?php
                                                $args03 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 65,
                                                );
                                            ?>
                                            <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光ファイバ・ファイバコンポーネント<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms03 as $term03) { ?>
                                                    <li><a href="<?php echo get_term_link( $term03->term_id );?>"><?php echo $term03->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光源">光源</a>
                                            <?php
                                                $args04 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 110,
                                                );
                                            ?>
                                            <?php $terms04 = get_terms( $args04 ); if($terms04){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光源<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms04 as $term04) { ?>
                                                    <li><a href="<?php echo get_term_link( $term04->term_id );?>"><?php echo $term04->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光変調器">光変調器 </a>
                                            <?php
                                                $args05 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 157,
                                                );
                                            ?>
                                            <?php $terms05 = get_terms( $args05 ); if($terms05){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光変調器<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms05 as $term05) { ?>
                                                    <li><a href="<?php echo get_term_link( $term05->term_id );?>"><?php echo $term05->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光学部品">光学部品</a>
                                            <?php
                                                $args06 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 162,
                                                );
                                            ?>
                                            <?php $terms06 = get_terms( $args06 ); if($terms06){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光学部品<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms06 as $term06) { ?>
                                                    <li><a href="<?php echo get_term_link( $term06->term_id );?>"><?php echo $term06->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="subUl">
                                        <li><a href="<?php bloginfo('url');?>/productcat/エレクトロニクス">エレクトロニクス</a>
                                            <?php
                                                $args07 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 197,
                                                );
                                            ?>
                                            <?php $terms07 = get_terms( $args07 ); if($terms07){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">エレクトロニクス<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms07 as $term07) { ?>
                                                    <li><a href="<?php echo get_term_link( $term07->term_id );?>"><?php echo $term07->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光学材料・消耗品">光学材料・消耗品</a>
                                            <?php
                                                $args08 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 242,
                                                );
                                            ?>
                                            <?php $terms08 = get_terms( $args08 ); if($terms08){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光学材料・消耗品<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms08 as $term08) { ?>
                                                    <li><a href="<?php echo get_term_link( $term08->term_id );?>"><?php echo $term08->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/測定器・検出器・試験機">測定機・検出器・試験機</a>
                                            <?php
                                                $args09 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 205,
                                                );
                                            ?>
                                            <?php $terms09 = get_terms( $args09 ); if($terms09){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">測定機・検出器・試験機<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms09 as $term09) { ?>
                                                    <li><a href="<?php echo get_term_link( $term09->term_id );?>"><?php echo $term09->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光学機器・光学解析ソフトウェア">光学機器・光学解析ソフトウェア</a>
                                            <?php
                                                $args10 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 255,
                                                );
                                            ?>
                                            <?php $terms06 = get_terms( $args10 ); if($terms10){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光学機器・光学解析ソフトウェア<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms10 as $term10) { ?>
                                                    <li><a href="<?php echo get_term_link( $term10->term_id );?>"><?php echo $term10->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/自動認識関連機器">自動認識関連機器</a>
                                            <?php
                                                $args11 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 259,
                                                );
                                            ?>
                                            <?php $terms11 = get_terms( $args11 ); if($terms11){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">自動認識関連機器<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms11 as $term11) { ?>
                                                    <li><a href="<?php echo get_term_link( $term11->term_id );?>"><?php echo $term11->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <li><a href="<?php bloginfo('url');?>/productcat/光通信">光通信用オプティカルツール</a>
                                            <?php
                                                $args12 = array(
                                                    'taxonomy' => 'productcat',
                                                    'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => 277,
                                                );
                                            ?>
                                            <?php $terms12 = get_terms( $args12 ); if($terms12){ ?>
                                            <div class="grandSubBox sp">
                                                <p class="ttl">光通信用オプティカルツール<br>
                                                カテゴリーを見る</p>
                                                <ul class="grandSubUl">
                                                <?php foreach($terms12 as $term12) { ?>
                                                    <li><a href="<?php echo get_term_link( $term12->term_id );?>"><?php echo $term12->name; ?></a></li>
                                                <?php } ?>
                                                </ul>
                                                <p class="close"><span>閉じる <small>-</small></span></p>
                                            </div>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
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
                slidesToShow: length,
                slidesToScroll: 1,
                arrows: false,
                autoplay: false,
                dots: false,
                asNavFor: '.slideBox01 .slide',
                centerPadding: 0,
                focusOnSelect: true,
                variableWidth: true
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
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>