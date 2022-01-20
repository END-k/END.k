<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '' ), max( $paged, $page ) );

	?></title>
<link rel="icon" type="image/gif" href="<?php bloginfo('template_url');?>/img/common/favicon.ico">
<meta property="og:image" content="<?php bloginfo('template_url');?>/img/common/ogp.jpg">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/js/jquery.jscrollpane.css">
<?php if(is_home()||is_front_page()||is_page("detail")){ ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/js/slick/slick.css">
<?php }else if(is_singular("product")){ ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/js/slick/slick.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/js/jquery.jscrollpane.css">
<?php } ?>
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet" type="text/css">
<script src="<?php bloginfo('template_url');?>/js/head.js"></script>
<?php wp_head(); ?>
</head>
<body>
<div id="container">
    <header id="gHeader">
        <div class="hBox flexB">
            <h1><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/logo.png" alt="株式会社オプトロンサイエンスOptronscience,Inc."></a></h1>
            <div class="menu-trigger sp" href="#"> <span></span> <span></span> <span></span> </div>
            <div class="rBox flex">
                <div id="gNavi" class="menuBox">
                    <ul class="fatherUl flexC">
                        <li><a href="<?php bloginfo('url');?>/business">事業内容</a></li>
                        <li><a href="<?php bloginfo('url');?>/product" class="arrow"><span>製品情報</span></a>
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
                                        <li>
                                            <a href="<?php echo get_term_link( $curId );?>">
                                                <span><?php if($showname){ echo $showname; }else { echo $term->name; } ?></span>
                                            </a>
                                            <?php
                                                $args01 = array(
                                                    'taxonomy' => 'productcat',
                                                    // 'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => $bigId,
                                                );
                                            ?>
                                            <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                            <div class="innBox">
                                                <div class="bgBox">
                                                    <div class="arrow"><span></span></div>
                                                    <ul class="innLinkUl flex">
                                                    <?php foreach($terms01 as $term01) { $secondId = $term01->term_id; ?>
                                                        <li><a href="<?php echo get_term_link( $term01->term_id );?>"><?php echo $term01->name; ?></a>
                                                        <?php
                                                            $args02 = array(
                                                                'taxonomy' => 'productcat',
                                                                 // 'hide_empty' => 0,
                                                                'exclude' => '',
                                                                'parent' => $secondId,
                                                            );
                                                        ?>
                                                        <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                                            <div class="borBox">
                                                                <ul class="linkList flex">
                                                                    <li><a href="<?php echo get_term_link( $secondId );?>">全て</a></li>
                                                                <?php foreach($terms02 as $term02) { ?>
                                                                    <li><a href="<?php echo get_term_link( $term02->term_id );?>"><?php echo $term02->name; ?></a></li>
                                                                <?php } ?>
                                                                </ul>
                                                            </div>
                                                        <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                        </li>
                        <li><a href="<?php bloginfo('url');?>/case">事例一覧</a></li>
                        <li><a href="<?php bloginfo('url');?>/distributor">取扱メーカー</a></li>
                        <li><a href="<?php bloginfo('url');?>/company" class="arrow arrow01"><span>会社情報</span></a>
                            <div class="subUlBox">
                                <div class="subInnBox">
                                    <ul class="subUl2 flex">
                                        <li class="sp"><a href="<?php bloginfo('url');?>/company"><span>会社情報</span></a></li>
                                        <li><a href="<?php bloginfo('url');?>/policy"><span>環境方針・品質方針</span></a></li>
                                        <li><a href="<?php bloginfo('url');?>/privacy"><span>プライバシーポリシー</span></a></li>
                                        <li><a href="<?php bloginfo('url');?>/recruit"><span>採用情報</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="<?php bloginfo('url');?>/news">ニュース</a></li>
                    </ul>
                    <div class="sp">
                        <ul class="language flex">
                            <li><span>LANGUAGE</span></li>
                            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
                        </ul>
                    </div>
                </div>
                <div class="hBtn"><a href="#"></a></div>
            </div>
        </div>
    </header>
    <div class="selectBox">
        <div class="selectInner">
            <div class="lBpx">
                <p class="hTtl sp">製品検索</p>
                <p>商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                <div class="inputBox">
                    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                        <input type="text" name="s" class="inputText">
                        <input type="submit" value="検索" class="inputButton" onclick="paramMod(this)">
                    </form>
                </div>
            </div>
            <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="form01">
                <input type="hidden" name="search_type" value="1">
                <input type="hidden" name="s" value="">
                <div class="centerBox">
                    <ul class="comSelectUl flex">
                        <li>
                            <p class="link"><a href="#">カテゴリーで探す</a></p>
                            <div class="iptBox">
                                <input type="hidden" name="cat01" class="cat01">
                                <a href="#" class="link01">選択してください</a>
                                <?php if($terms){ ?>
                                <div class="enUlBox enUlBox01">
                                    <ul class="enUl01">
                                    <?php foreach($terms as $term) { ?>
                                        <li><a href="#" data-id01="<?php echo $term->term_id; ?>"><?php echo $term->name; $bigId = $term->term_id; ?></a>
                                            <?php
                                                $args11 = array(
                                                    'taxonomy' => 'productcat',
                                                    //'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => $bigId,
                                                );
                                            ?>
                                            <?php $terms11 = get_terms( $args11 ); if($terms11){ ?>
                                            <ul class="conterUl">
                                                <li><a href="#" data-id01="<?php echo $bigId; ?>">■<?php echo $term->name;?>すべて</a></li>
                                            <?php foreach($terms11 as $term11) { ?>
                                                <li><a href="#" data-id01="<?php echo $term11->term_id; ?>">■<?php echo $term11->name; $secondId = $term11->term_id; ?></a>
                                                    <?php
                                                        $args22 = array(
                                                            'taxonomy' => 'productcat',
                                                            //'hide_empty' => 0,
                                                            'exclude' => '',
                                                            'parent' => $secondId,
                                                        );
                                                    ?>
                                                    <?php $terms22 = get_terms( $args22 ); if($terms22){ ?>
                                                    <div class="subWrap">
                                                        <ul class="subUl flexB">
                                                            <li><a href="#" data-id01="<?php echo $term11->term_id; ?>"><?php echo $term11->name; ?>すべて</a></li>
                                                        <?php foreach($terms22 as $term22) { ?>
                                                            <li><a href="#" data-id01="<?php echo $term22->term_id; ?>"><?php echo $term22->name; ?></a></li>
                                                        <?php }?>
                                                        </ul>
                                                    </div>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </li>
                        <li>
                            <p class="link"><a href="#">メーカーで探す</a></p>
                            <div class="iptBox">
                                <input type="hidden" name="cat02" class="cat01">
                                <a href="#" class="link01">選択してください</a>
                                <?php
                                    $args03 = array(
                                        'taxonomy' => 'distributorcat',
                                        // 'hide_empty' => 0,
                                        'exclude' => '',
                                        'parent' => 0,
                                    );
                                ?>
                                <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                <div class="enUlBox enUlBox02">
                                    <ul class="enUl flex">
                                    <?php foreach($terms03 as $term03) { ?>
                                        <li>
                                            <ul class="fatUl">
                                                <li><a href="#" data-id01=""><?php echo $term03->name; $bigId01 = $term03->term_id; ?></a>
                                                    <?php
                                                        $args04 = array(
                                                            'post_type' => 'distributor',
                                                            'posts_per_page' => -1,
                                                            'orderby' => 'meta_value',
                                                            'order' => 'ASC',
                                                            'meta_key'=>'ff_yomi',
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => 'distributorcat',
                                                                    'field'    => 'term_id',
                                                                    'terms'    => array( $bigId01 ),
                                                                    'operator' => 'IN',
                                                                ),
                                                            ),
                                                        );
                                                    ?>
                                                    <?php $query = new WP_Query( $args04 ); if ( $query->have_posts() ) { ?>
                                                    <ul class="innUl">
                                                    <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                                                    <li><a href="#" data-id01="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
                                                    <?php }?>
                                                    </ul>
                                                    <?php } wp_reset_postdata(); ?>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        </li>
                        <li>
                            <p class="link"><a href="#">光源を波長から探す</a></p>
                            <div class="iptBox">
                                <input type="hidden" name="cat03" class="cat01">
                                <a href="#" class="link01">選択してください</a>
                                <div class="enUlBox enUlBox03">
                                    <ul class="enUl03">
                                        <li><p><span>波長域から探す</span></p>
                                            <ul class="flex">
                                                <li><a href="#" data-id01="617">200nm~</a></li>
                                                <li><a href="#" data-id01="612">300nm~</a></li>
                                                <li><a href="#" data-id01="286">400nm~</a></li>
                                                <li><a href="#" data-id01="583">500nm~</a></li>
                                                <li><a href="#" data-id01="591">600nm~</a></li>
                                                <li><a href="#" data-id01="287">700nm~</a></li>
                                                <li><a href="#" data-id01="288">800nm~</a></li>
                                                <li><a href="#" data-id01="592">900nm~</a></li>
                                                <li><a href="#" data-id01="289">1000nm~</a></li>
                                                <li><a href="#" data-id01="593">1500nm~</a></li>
                                                <li><a href="#" data-id01="594">2000nm~</a></li>
                                                <li><a href="#" data-id01="290">多波長チューナブル~</a></li>
                                            </ul>
                                        </li>
                                        <li><p><span>良く探されている波長から探す</span></p>
                                            <ul class="flex">
                                                <li><a href="#" data-id01="608">532nm</a></li>
                                                <li><a href="#" data-id01="291">808nm</a></li>
                                                <li><a href="#" data-id01="584">850nm</a></li>
                                                <li><a href="#" data-id01="324">940nm</a></li>
                                                <li><a href="#" data-id01="601">976/980nm</a></li>
                                                <li><a href="#" data-id01="610">1060/1064nm</a></li>
                                                <li><a href="#" data-id01="293">1310/1550nm</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="comBtn-wrap">
                    <div class="comBtn"><a href="#"><span>この条件で検索する</span></a></div>
                    <div class="hBtn comBtn--close"><a href="#"><span>閉じる</span></a></div>
                </div>
            </form>
        </div>
    </div>
