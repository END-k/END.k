<?php get_header(); ?>

<div class="index">
    <section class="mainVisual">
        <div class="svgBox pc">
            <div class="modern">
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave" fill="none" stroke-width="0.1" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="48" y="0" stroke="#f20000" fill="none" />
                        <use xlink:href="#gentle-wave" x="48" y="3" stroke="#0fd000" fill="none" />
                        <use xlink:href="#gentle-wave" x="48" y="5" stroke="#0b7ef1" fill="none" />
                    </g>
                </svg>
            </div>
            <div class="ie">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="161.01600646972656" viewBox="0 0 1441.225 161.016">
                    <g id="line"  transform="translate(1104.861 -327.377)">
                        <path id="パス_6516" data-name="パス 6516" d="M-1104,342.732s273.026,122.48,548.951,0S-76.94,426.463,83.019,427.878,336,330.763,336,330.763" transform="translate(0 60)" fill="none" stroke="#f20000" stroke-width="1" class="svg-elem-1"></path>
                        <path id="パス_6517" data-name="パス 6517" d="M336,372.467S268.42,427.555-7.5,305.711s-492.771,88.986-737.217,94S-1104,280.7-1104,280.7" transform="translate(0 60)" fill="none" stroke="#0fd000" stroke-width="1" class="svg-elem-2"></path>
                        <path id="パス_6518" data-name="パス 6518" d="M-1104.623,329.992s171,92.744,361.29,33.706c275.924-121.843,417.555-8.188,622.75-8.188S336,280.7,336,280.7" transform="translate(0 90)" fill="none" stroke="#0b7ef1" stroke-width="1" class="svg-elem-3"></path>
                    </g>
                </svg>
            </div>
        </div>
        <div class="svgBox sp">
            <svg xmlns="http://www.w3.org/2000/svg" width="375" height="84" viewBox="0 0 375 84">
                <defs>
                    <clipPath id="u08mxbhuva">
                        <path fill="#fff" stroke="#707070" d="M0 0H375V84H0z" transform="translate(-1104 321.417)" class="svg-elem-1"></path>
                    </clipPath>
                </defs>
                <g>
                    <g fill="none" clip-path="url(#u08mxbhuva)" transform="translate(1104 -321.417)">
                        <path stroke="#f20000" d="M-1104 322.941s122.111 60.068 245.518 0 213.834 41.065 285.376 41.758 113.146-47.628 113.146-47.628" transform="translate(-.344 40.27)" class="svg-elem-2"></path>
                        <path stroke="#0fd000" d="M-459.961 319.162s-30.225 27.017-153.632-32.74-220.391 43.642-329.72 46.1S-1104 274.154-1104 274.154" transform="translate(-.344 60)" class="svg-elem-3"></path>
                        <path stroke="#0b7ef1" d="M-1104.623 304.873s76.478 45.485 161.587 16.531c123.407-59.756 186.751-4.016 278.525-4.016S-460.3 280.7-460.3 280.7" transform="translate(0 66.803)" class="svg-elem-4"></path>
                    </g>
                </g>
            </svg>
        </div>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
        <div class="content innBox flexB">
            <div class="lBox">
                <h2>光技術<span>で</span><br>
                ものづくり<span>の</span>基盤<span>を</span>支える<br>
                オプトロンサイエンス</h2>
            </div>
            <div class="rBox">
                <p class="ttl">製品検索</p>
                <p class="text01">商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                <p id="output-message"></p>
                <div class="inputBox">
                    <form role="search" id="search_form" method="get" name="form1" action="<?php echo home_url( '/' ); ?>">
                        <input type="text" id="input-message" name="s" class="inputText" value="<?php fwsearch($input_words); ?>">
                        <input type="submit" id="word_search" value="検索" class="inputButton">
                    </form>
                </div>
                <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="form01">
                    <input type="hidden" name="s" value="<?php echo fwsearch($input_words); ?>">
                    <input type="hidden" name="search_type" value="1">
                    <ul class="comSelectUl flex">
                        <li>
                            <p class="link"><a href="#">カテゴリーで探す</a></p>
                            <div class="iptBox">
                                <input type="hidden" name="cat01" class="cat01">
                                <a href="#" class="link01" data-id01="">選択してください</a>
                                <?php
                                    $args = array(
                                        'taxonomy' => 'productcat',
                                        // 'hide_empty' => 0,
                                        'exclude' => '',
                                        'parent' => 0,
                                    );
                                ?>
                                <?php
                                    $terms = get_terms( $args );
                                    //並べ替え
                                        usort($terms, function ($a, $b) {
                                            return $a->description - $b->description;
                                        });

                                    if($terms){
                                ?>
                                <div class="enUlBox enUlBox01">
                                    <ul class="enUl01">
                                        <?php foreach($terms as $term) { ?>
                                        <li><a href="#" data-id01="<?php echo $term->term_id; ?>"><?php echo $term->name; $bigId = $term->term_id; ?></a>
                                            <?php
                                                $args01 = array(
                                                    'taxonomy' => 'productcat',
                                                    // 'hide_empty' => 0,
                                                    'exclude' => '',
                                                    'parent' => $bigId,
                                                );
                                            ?>
                                            <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                            <ul class="conterUl">
                                                <li><a href="#" data-id01="<?php echo $bigId; ?>">■ <?php echo $term->name;?>すべて</a></li>
                                                <?php foreach($terms01 as $term01) { ?>
                                                <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; $secondId = $term01->term_id; ?></a>
                                                    <?php
                                                        $args02 = array(
                                                            'taxonomy' => 'productcat',
                                                            // 'hide_empty' => 0,
                                                            'exclude' => '',
                                                            'parent' => $secondId,
                                                        );
                                                    ?>
                                                    <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                                    <div class="subWrap">
                                                        <ul class="subUl flexB">
                                                            <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; ?>すべて</a></li>
                                                            <?php foreach($terms02 as $term02) { ?>
                                                            <li><a href="#" data-id01="<?php echo $term02->term_id; ?>"><?php echo $term02->name; ?></a></li>
                                                            <?php }?>
                                                        </ul>
                                                    </div>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ul>
                                            <?php }?>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <?php }?>
                            </div>
                        </li>
                        <li>
                            <p class="link"><a href="#">メーカーで探す</a></p>
                            <div class="iptBox">
                                <input type="hidden" name="cat02" class="cat01">
                                <?php
                                    $args03 = array(
                                        'taxonomy' => 'distributorcat',
                                        // 'hide_empty' => 0,
                                        'exclude' => '',
                                        'parent' => 0,
                                    );
                                ?>
                                <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                <a href="#" class="link01">選択してください</a>
                                <div class="enUlBox">
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
                                    <?php }?>
                                    </ul>
                                </div>
                                <?php }?>
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
                                                <li><a href="#" data-id01="290">多波長、チューナブル</a></li>
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
                    <div class="comBtn"><a href="<?php bloginfo('url');?>/result"><span>この条件で検索する</span></a></div>
                </form>
            </div>
        </div>
    </section>
    <div id="main">
        <div class="content proBox flexB">
            <div class="txtBox">
                <h3 class="headLine01">おすすめ商品</h3>
                <p class="txt01 en">PICKUP</p>
            </div>
            <div class="slideBox">
                <ul class="linkUl01 flex slide">
                    <!-- <li style="border-color: #0fd000;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?search_type=1&s=&cat01=206&cat02=&cat03="><img src="<?php bloginfo('template_url');?>/img/index/photo01.jpg" alt="おすすめ商品"></a></li>
                    <li style="border-color: #0b7ef1;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>product/optron_bandle"><img src="<?php bloginfo('template_url');?>/img/index/photo02.jpg" alt="おすすめ商品"></a></li>
                    <li style="border-color: #f20000;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>product/opticon_opn-3102i"><img src="<?php bloginfo('template_url');?>/img/index/photo03.jpg" alt="おすすめ商品"></a></li> -->
                    <?php
                        $args = array(
                            'posts_per_page' => 3, // 表示する投稿数＝３記事
                            'post_type' => array('recommend'), // 取得する投稿タイプのスラッグ
                            'orderby' => 'date', //日付で並び替え（投稿日）
                            'order' => 'DESC' // 降順=最新３記事のみ
                        );
                        $my_posts = get_posts($args);
                        ?>
                    <?php foreach ($my_posts as $post) : setup_postdata($post); ?>
                    <li style="border-color: <?php echo get_field('border_color'); ?>;">
                        <a href="<?php echo esc_url( home_url( '/' ) ); echo get_field("recommend_url"); ?>">
                            <?php
                                // アイキャッチ画像を取得
                                $thumbnail_id = get_post_thumbnail_id($post->ID);
                                $thumb_url = wp_get_attachment_image_src($thumbnail_id,'full');
                                if (get_post_thumbnail_id($post->ID)) {
                                echo '<img src="' . $thumb_url[0] . '" alt="おすすめ商品">';
                                } else {
                                // アイキャッチ画像が登録されていなかったときの画像
                                echo '<img src="' . get_template_directory_uri() . '/img/index/img-default.png" alt="recommend_default">';
                                }
                            ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="bgBox">
            <div class="bgBoxInn">
                <div class="content">
                    <h3 class="headLine01">取り扱いカテゴリー</h3>
                    <?php if($terms){ ?>
                    <p class="en txt01">CATEGORY</p>
                    <p class="pTop">自社および各種メーカーの<br>
                    様々な製品をご覧いただけます</p>
                    <ul class="comItemList comItemList01 flex">
                    <?php
                        foreach($terms as $term) {
                            $curId = $term->term_id;
                            $showname = get_field('ff_showname', 'productcat_'.$curId);
                            $showimg = get_field('ff_showimg', 'productcat_'.$curId);
                    ?>
                        <li>
                            <a href="<?php echo get_term_link( $curId );?>">
                                <div class="phoBox"><div class="pho" style="background-image: url(<?php echo $showimg; ?>);"></div></div>
                                <div class="txtBox">
                                    <p class="link"><?php if($showname){ echo $showname; }else { echo $term->name; } ?></p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                    <?php } ?>
                    <div class="borBox flexB">
                        <div class="txtBox">
                            <h3 class="headLine01">取り扱いメーカー一覧</h3>
                            <p class="txt01 en">MAKER</p>
                            <p class="pTop">国内外80社以上の<br class="sp">メーカーの製品をご紹介します</p>
                            <div class="comBtn"><a href="<?php bloginfo('url');?>/distributor">詳しく見る</a></div>
                        </div>
                        <div class="lBox"><img src="<?php bloginfo('template_url');?>/img/index/photo03.png" alt="取り扱いメーカー一覧"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comWaveBox content">
            <h3 class="headLine01">光源を波長から探す</h3>
            <p class="pTop">WAVELENGTH</p>
            <div class="waveBox pc"><img src="<?php bloginfo('template_url');?>/img/common/photo08.jpg" alt="WAVELENGTH"><img src="<?php bloginfo('template_url');?>/img/common/sp_photo08.jpg" alt="WAVELENGTH" class="sp"></div>
            <p class="waveTtl"><span>波長域から探す</span></p>
            <div class="spWaveBox flexB">
                <div class="waveBox sp"><img src="<?php bloginfo('template_url');?>/img/common/sp_photo08.jpg" alt="WAVELENGTH" class="sp"></div>
                <ul class="comLinkUl comLinkUl01 flex">
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/200nm"><span>200<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/300nm"><span>300<small>nm~</small></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/400nm" class="bor bor01"><span>400<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/500nm" class="bor bor03"><span>500<small>nm~</small></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/600nm" class="bor bor02"><span>600<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/700nm" class="bor bor04"><span>700<small>nm~</small></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/800nm"><span>800<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/900nm"><span>900<small>nm~</small></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/1000nm"><span>1000<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/1500nm"><span>1500<small>nm~</small></span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/2000nm"><span>2000<small>nm~</small></span></a></li>
                            <li><a href="<?php bloginfo('url');?>/wavelengthcat/multi-wavelength"><span class="txt">多波長<br>チューナブル</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <p class="waveTtl"><span>良く探されている<br class="sp">波長から探す</span></p>
            <ul class="comLinkUl comLinkUl01 comLinkUl02 flex">
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/532nm" class="bor bor05"><span>532<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/808nm"><span>808<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/850nm"><span>850<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/940nm"><span>940<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/976nm"><span>976/980<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/1064nm"><span>1060/1064<small>nm</small></span></a></li>
                <li><a href="<?php bloginfo('url');?>/wavelengthcat/1310-1550nm"><span>1310/1550<small>nm</small></span></a></li>
            </ul>
        </div>
        <div class="point">
            <div class="content flexB">
                <div class="txtBox">
                    <h3 class="headLine01">オプトロンサイエンスの<br>
                    2つのポイント</h3>
                    <p class="txt01 en">POINT</p>
                </div>
                <ul class="imgUl flexB">
                    <li>
                        <div class="pho"><img src="<?php bloginfo('template_url');?>/img/index/photo04.png" alt="メーカーを横断して検索・発注が可能">
                            <p class="txt01 en">01</p>
                            <p class="txt02"><span>メーカーを横断</span>して<br>
                            検索・発注が可能</p>
                        </div>
                        <p class="txt03">多様化するお客様のニーズに応えるべく、優れた光製品を日本製、海外製問わずご要望に合わせてご紹介します。</p>
                    </li>
                    <li>
                        <div class="pho"><img src="<?php bloginfo('template_url');?>/img/index/photo05.png" alt="ニーズに合わせたカスタマイズ納品が可能">
                            <p class="txt01 en">02</p>
                            <p class="txt02">ニーズに合わせた<br>
                            <span>カスタマイズ納品</span>が可能</p>
                        </div>
                        <p class="txt03">30年来の実績とノウハウを基に、光源装置の製造および各種光ファイバ端末加工を一端末からサポートいたします。特殊ファイバ加工などもぜひご相談下さい！</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="about content">
            <h3 class="headLine01"><span>会社概要</span></h3>
            <p class="txt01 en">ABOUT US</p>
            <p class="text">オプトロンサイエンスは1990年の創業以来、<br class="pc">『光製品で社会に貢献』をモットーに光関連製品の製造販売および<br class="pc">自動認識関連製品における商社活動を続けてまいりました。<br class="pc">近年では海外メーカーの取扱いも開始し、より多角的に光関連製品の紹介を進めております。<br class="pc">これからも皆様の技術開発パートナーとして、共に歩んでまいります。 </p>
            <div class="comBtn"><a href="<?php bloginfo('url');?>/company">詳しく見る</a></div>
        </div>
        <?php query_posts('showposts=2&post_type=case');  if(have_posts()): ?>
        <div class="case">
            <h3 class="headLine01"><span>事例一覧</span></h3>
            <p class="txt01 en">CASE STUDY</p>
            <p class="text">オプトロンサイエンスの製品の<br class="sp">カスタマイズ事例や採用事例などを<br class="sp">ご覧いただけます</p>
            <ul class="comCaseList flexB content">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink();?>">
                        <div class="subBox flexB">
                            <div class="pho"><span style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></span></div>
                            <div class="txtBox">
                                <h3 class="headLine02">
                                <?php
                                    //整形したい文字列
                                    $text = get_the_title();
                                    //文字数の上限
                                    $limit = 24;
                                    //分岐
                                    if(mb_strlen($text) > $limit) {
                                    $title = mb_substr($text,0,$limit);
                                    echo $title . '･･･' ;
                                    } else {
                                    the_title();
                                    }
                                    ?>
                                </h3>
                                <p><?php get_excerpt(48); ?></p>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endwhile; ?>
            </ul>
            <div class="comBtn"><a href="<?php bloginfo('url');?>/case">一覧を見る</a></div>
        </div>
        <?php endif; wp_reset_query(); ?>

        <?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 4,
                'post_status' => 'publish'
			);
			$news_query = new WP_Query($args)
			?>
			<?php if ( $news_query->have_posts() ) : ?>
        <div class="news">
            <h3 class="headLine01"><span>ニュース</span></h3>
            <p class="txt01 en">NEWS</p>
            <ul class="comNewsList">
                <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <?php
                    $cat= get_the_category();
                    $cat = $cat[0];
                    $cat_slug = $cat->slug;
                    $cat_name = $cat->cat_name;
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <dl>
                            <dt>
                                <span class="date"><?php the_time('Y.m.d'); ?></span>
                                <span class="tag" <?php if(!in_category(array('optronnews', 'notice'))): ?>style="background-color:<?php if(in_category(array('new-products', 'others'))): ?>#0fd000;<?php elseif(in_category('exhibition')): ?>#0b7ef1<?php endif; ?>"<?php endif; ?>><?php echo $cat_name; ?></span></dt>
                            <dd><span class="txt"><?php the_title(); ?></span></dd>
                        </dl>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
            <div class="comBtn"><a href="<?php bloginfo('url');?>/news">一覧を見る</a></div>
        </div>
        <?php endif; ?>
		<?php wp_reset_postdata(); ?>

    </div>
</div>
<?php get_footer(); ?>
