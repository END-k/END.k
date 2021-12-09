<?php get_header(); $parentId = get_queried_object()->parent; ?>
<?php global $query_string;
query_posts( $query_string . '&showposts=-1' );
if(have_posts()): $numall = 0; while (have_posts()) : the_post(); $numall++; endwhile; endif;wp_reset_query();?>
<div class="product wavelength">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2><?php echo get_queried_object()->name; ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="comTopBorBox">
                <h3 class="headLine01">条件を絞り込む</h3>
                <div class="comLinkBox flexB">
                    <?php if($parentId == 0){
                        $args = array(
                            'taxonomy' => 'wavelengthcat',
                            // 'hide_empty' => 0,
                            'exclude' => '',
                            'parent' => get_queried_object()->term_id,
                        );
                    ?>
                    <?php $terms = get_terms( $args );
                    
                    // echo('<pre>');
                    // var_dump($terms);
                    // echo('</pre>');
                    
                    if($terms){ ?>
                    <div class="lBox">
                        <ul class="comLinkUl comLinkUl01 flexC">
                        <?php
                        foreach($terms as $term) {
                            $array=explode('n', $term->name);
                            if($array[0] === "多波長チューナブル"){
                        ?>
                            <li><a href="<?php echo home_url( '/' ); ?>?s=&search_type=2&cat03=<?php echo $term->term_id; ?>"><span><?php $array=explode('n', $term->name); echo $array[0]; ?></span></a></li>
                            <?php } else{ ?>
                            <li><a href="<?php echo home_url( '/' ); ?>?s=&search_type=2&cat03=<?php echo $term->term_id; ?>"><span><?php $array=explode('n', $term->name); echo $array[0]; ?><small>nm</small></span></a></li>
                        <?php } } ?>
                        </ul>
                    </div>
                    <?php } }else { ?>
                    <div class="lBox">
                        <ul class="comLinkUl comLinkUl01 flexC">
                            <li><a href="<?php echo home_url( '/' ); ?>?s=&search_type=2&cat03=<?php echo get_queried_object()->term_id; ?>"><span><?php $array=explode('n', get_queried_object()->name); echo $array[0]; ?><small>nm</small></span></a></li>
                        </ul>
                    </div>
                    <?php } ?>
                    <div class="sBox">
                        <p class="ttl headLine04">具体的な波長を入力して検索</p>
                        <div class="inputBox">
                        <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                            <input type="hidden" name="s" value="">
                            <input type="hidden" name="search_type" value="4">
                            <input type="text" placeholder="532nm" name="s" class="inputText">
                            <input type="submit" value="検索" class="inputButton">
                        </form>
                        </div>
                    </div>
                </div>
                <p class="down"><a href="#">もっと細かく指定する<span>+</span></a></p>
                <div class="conditionsBox">
                    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                        <input type="hidden" name="s" value="">
                        <input type="hidden" name="search_type" value="3">
                        <ul class="conUl">
                            <li>
                                <p class="ttl"><span>■</span>出力を指定する (入力なしの場合は全て表示されます)</p>
                                <div class="radioBox radioBox_w">
                                    <input type="number" id="mW" name="output" placeholder="200" class="txtInput wavetext wavetext01">
                                    <input type="number" name="output" placeholder="200" class="txtInput wavetext wavetext02">
                                    <ul class="rdoUl">
                                        <li><label><input type="radio" id="mW" name="w" value="mW" checked="checked"><span>mW</span></label></li>
                                        <li><label><input type="radio" name="w" value="W"><span>W</span></label></li>
                                    </ul>
                                </div>
                                <div class="cnt_area cnt_danger">mWでの検索は1~999までの整数のみ対応しております。</div>
                            </li>
                            <li>
                                <p class="ttl"><span>■</span>発振形式 (複数選択可能)</p>
                                <ul class="rdoUl">
                                    <li><label><input type="checkbox" name="mode[]" value="CW"><span>CW</span></label></li>
                                    <li><label><input type="checkbox" name="mode[]" value="パルス"><span>パルス</span></label></li>
                                    <li><label><input type="checkbox" name="mode[]" value="超短パルス"><span>超短パルス</span></label></li>
                                    <li><label><input type="checkbox" name="mode[]" value="CW&パルス"><span>CW&amp;パルス</span></label></li>
                                </ul>
                            </li>
                            <li>
                                <p class="ttl"><span>■</span>光源種類 (複数選択可能)</p>
                                <ul class="rdoUl">
                                    <li><label><input type="checkbox" name="source[]" value="LD"><span>LD</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="LED"><span>LED</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="VCSEL"><span>VCSEL</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="LED/SLD/SOA"><span>LED/SLD/SOA</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="DPSS"><span>DPSS</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="ファイナーレーザ/ファイバーアンプ"><span>ファイナーレーザ/ファイバーアンプ</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="単一周波数"><span>単一周波数</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="ブロードバンド"><span>ブロードバンド</span></label></li>
                                    <li><label><input type="checkbox" name="source[]" value="その他"><span>その他</span></label></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="lkBox flexC">
                            <p>指定した条件で</p>
                            <div class="link linkbtn"><a href="#">検索</a></div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if(!have_posts()): ?>
            <div class="thanks">
            <p class="ttl">申し訳ありません。<br>入力した条件では製品が見つかりませんでした。</p>
            <p>条件を変更し検索を行うか、トップページよりご希望のページをお探しください。</p>

            <div class="comBtn"><a href="<?php bloginfo('url');?>">TOPページに戻る</a></div>
            </div>
            <?php else: ?>
            <h4 class="headLine05">該当製品数<span><?php echo $numall; ?><small>件</small></span></h4>
            <?php if($parentId == 0){ if($terms){ ?>
            <?php
                foreach($terms as $term) {
                    $curId = $term->term_id;
                    $curSlug = $term->slug;
                    $array01=explode('n', $term->name);
            ?>
            <?php if($array01[0] === "多波長チューナブル"){ ?>
            <p class="waveTtl"><span><?php $array01=explode('n', $term->name); echo $array01[0]; ?></span></p>
            <?php } else{ ?>
            <p class="waveTtl"><span><?php $array01=explode('n', $term->name); echo $array01[0]; ?><small>nm</small></span></p>
            <?php }?>
            <?php
            $args01 = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wavelengthcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            ); $query = new WP_Query( $args01 ); if ( $query->have_posts() ) { $num = 0; ?>
            <ul class="comItemList flex wavelengthcatList">
                <?php while ( $query->have_posts() ) { $query->the_post(); $num++; ?>
                <?php $post_id = get_the_ID(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="ttl"><?php the_title(); ?></p>
                        <?php
                            endforeach;
                            wp_reset_postdata();
                            endif;
                        ?>
                        <div class="txt">
                            <?php the_field("ff_excerpt", $post_id); ?>
                        </div>
                        <?php
                            $taxonomy = 'productcat';
                            $terms01 = get_the_terms($post_id,$taxonomy);
                            $ancestor_maxnum = 1;
                            $ff_wavelengthlabel = get_field('ff_wavelengthlabel', $post_id);
                        ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php
                                $dep = count(get_ancestors($term01->term_id, $taxonomy));
                            ?>
                            <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                            <?php } ?>
                            <?php
                                $terms02 = get_ordered_terms($post_id,'slug', 'ASC', 'wavelengthcat');
                            ?>
                            <?php if($terms02): ?>
                            <?php if($ff_wavelengthlabel): ?>
                            <li class="rainbow"><span><?php echo $ff_wavelengthlabel; ?></span></li>
                            <?php else: ?>
                            <?php foreach($terms02 as $term02){ ?>
                            <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
                            <?php } ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </a>
                </li>
            <?php } ?>
            </ul>
            <?php //var_dump($terms); ?>
            <?php } wp_reset_postdata(); if($num > 6){ ?>
            <div class="comBtn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>wavelengthcat/<?php echo $curSlug; ?>">もっと見る</a></div>

            <?php } } } }else { ?>


            <p class="waveTtl"><span><?php $array01=explode('n', get_queried_object()->name); echo $array01[0]; ?><small>nm</small></span></p>
            <ul class="comItemList flex">
                <?php while ( have_posts() ): the_post(); $num++; ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="ttl"><?php the_title(); ?></p>
                        <?php endforeach;wp_reset_postdata(); endif; ?>
                        <div class="txt">
                            <?php the_field("ff_excerpt"); ?>
                        </div>
                        <?php
                            $taxonomy = 'productcat';
                            $terms01 = get_the_terms($post->ID,$taxonomy);
                            $ancestor_maxnum = 1;
                            $ff_wavelengthlabel = get_field('ff_wavelengthlabel');
                        ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php
                                $dep = count(get_ancestors($term01->term_id, $taxonomy));
                            ?>
                            <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                            <?php } ?>
                            <?php
                                $terms02 = get_ordered_terms($post->ID,'slug', 'ASC', 'wavelengthcat');
                            ?>
                            <?php if($terms02): ?>
                            <?php if($ff_wavelengthlabel): ?>
                            <li class="rainbow"><span><?php echo $ff_wavelengthlabel; ?></span></li>
                            <?php else: ?>
                            <?php foreach($terms02 as $term02){ ?>
                            <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
                            <?php } ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array(
                'options' => array(
                    'prev_text' => '<img src="'.get_template_directory_uri().'/img/common/icon07.png" width="8" alt="prev">',
                    'next_text' => '<img src="'.get_template_directory_uri().'/img/common/icon06.png" width="8" alt="next">',
                    'dotleft_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                    'dotright_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                ),
            ) );}?>

            <?php } ?>

            <?php endif; ?>
            <div class="comWaveBox comWaveBox01">
                <h3 class="headLine01">他の波長から探す</h3>
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
                                <li><a href="<?php bloginfo('url');?>/wavelengthcat/multi-wavelength"><span class="txt">多波長<br>
                                    チューナブル</span></a></li>
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
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/976nm"><span>976<small>nm</small></span></a></li>
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/980nm"><span>980<small>nm</small></span></a></li>
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/1060nm"><span>1060<small>nm</small></span></a></li>
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/1064nm"><span>1064<small>nm</small></span></a></li>
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/1310nm"><span>1310<small>nm</small></span></a></li>
                    <li><a href="<?php bloginfo('url');?>/wavelengthcat/1550nm"><span>1550<small>nm</small></span></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><?php echo get_queried_object()->name; ?></li>
</ul>
<?php get_footer(); ?>
