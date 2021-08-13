<?php get_header(); ?>
<div class="product distributor">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2>取扱メーカー</h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="borBox">
                <h3 class="headLine01">アルファベット選択</h3>
                <div class="linkUlBox">
                    <div class="cat02 sp"><a href="#">選択してください</a></div>
                    <div class="linkBox">
                        <ul class="linkUl flexC">
                        <?php
                            $args = array(
                                'taxonomy' => 'distributorcat',
                                'hide_empty' => 0,
                                'exclude' => '',
                            );
                        ?>
                        <?php $terms = get_terms( $args );
                            if($terms){
                                foreach($terms as $term) { ?>
                                <li><a href="#a<?php echo $term->term_id;?>"><?php echo $term->name;?></a></li>
                        <?php }}?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if($terms){
                foreach($terms as $term) { $curId = $term->term_id; ?>
                <p class="waveTtl" id="a<?php echo $term->term_id; ?>"><span><?php echo $term->name;?></span></p>
                <?php
                    $args = array(
                        'post_type' => 'distributor',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'distributorcat',
                                'field'    => 'term_id',
                                'terms'    => array( $curId ),
                                'operator' => 'IN',
                            ),
                        ),
                    );
                    $query = new WP_Query( $args ); if ( $query->have_posts() ) { ?>
                <ul class="imgLinkUl flexB">
                <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                    <li>
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <div class="rBox">
                            <h4><?php the_title(); ?></h4>
                            <p class="ttl flexB"><?php if(get_field("ff_country")){ ?><span class="txt01"><?php the_field("ff_country"); ?></span><?php } ?><?php if(get_field("ff_content")){ ?><span class="txt02">詳細を見る</span><?php } ?></p>
                            <?php if(get_field("ff_content")){ ?><p class="txt"><?php the_field("ff_content"); ?></p><?php } ?>
                            <?php if(get_field("ff_url")){ ?><p class="link"><a href="<?php the_field("ff_url"); ?>" target="_blank">メーカーURL <?php the_field("ff_url"); ?></a></p><?php } ?>
                            <div class="comBtn"><a href="<?php bloginfo('url');?>/?s=&cat02=<?php echo $post->ID; ?>&search_type=1">関連製品を見る</a></div>
                        </div>
                    </li>
                <?php } ?>
                </ul>
                <?php }else { ?>
                <p class="noneText">該当するメーカーは<br class="sp">ありません</p>
                <?php } wp_reset_postdata(); ?>
            <?php }}?>
            <?php
                $argsproduct = array(
                    'taxonomy' => 'productcat',
                    'hide_empty' => 0,
                    'exclude' => '',
                    'parent' => 0,
                );
            ?>
            <?php $termspro = get_terms( $argsproduct ); if($termspro){ ?>
            <h3 class="headLine01">カテゴリーから探す</h3>
            <p class="en txt01">CATEGORY</p>
            <p class="pTop">自社および各種メーカーの<br>
            様々な製品をご覧いただけます</p>
            <ul class="comItemList comItemList01 flex">
            <?php foreach($termspro as $termpro) { $curproId = $termpro->term_id; $showname = get_field('ff_showname', 'productcat_'.$curproId); $showimg = get_field('ff_showimg', 'productcat_'.$curproId); ?>
                <li>
                    <a href="<?php echo get_term_link( $curproId );?>">							
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php echo $showimg; ?>);"></div></div>
                        <div class="txtBox">
                            <p class="link"><?php if($showname){ echo $showname; }else { echo $termpro->name; } ?></p>
                        </div>
                    </a>				
                </li>
            <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li>取扱メーカー</li>
</ul>
<?php get_footer(); ?>