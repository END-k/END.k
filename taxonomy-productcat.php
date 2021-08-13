<?php get_header(); $parentId = get_queried_object()->parent; $curId = get_queried_object()->term_id; $paged = get_query_var('paged') ? get_query_var('paged') : 1;  ?>
<?php if($parentId == 0){ ?>
<div class="product product01">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2><?php echo get_queried_object()->name; ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="comTopBorBox">
                <h4 class="headLine01"><?php echo get_queried_object()->name; ?>に含まれる<br class="sp">カテゴリーを見る</h4>
                <div class="comLinkUlBox01">
                    <div class="comLinkUlBox02">
                    <?php
                        $args = array(
                            'taxonomy' => 'productcat',
                            'hide_empty' => 0,
                            'exclude' => '',
                            'parent' => get_queried_object()->term_id,
                        );
                    ?>
                    <?php $terms = get_terms( $args ); if($terms){ $count = 0; $nameArr = array(); $restArr = array(); ?>
                        <ul class="comLinkUl flexC">
                        <?php foreach($terms as $term) { $count++; if($count <= 5){ ?>
                            <li><a href="<?php echo get_term_link( $term->term_id );?>"><span><?php echo $term->name;?></span></a></li>
                        <?php }else { array_push($restArr,$term->term_id); array_push($nameArr,$term->name); } } ?>
                        </ul>
                    <?php }?>
                    <?php if(count($restArr)){ ?>
                        <div class="downBox">
                            <div class="comLinkUlBox">
                                <ul class="comLinkUl flexC">
                                <?php for($i=0;$i < count($restArr);$i++){ ?>
                                    <li><a href="<?php echo get_term_link( $restArr[$i] );?>"><span><?php echo $nameArr[$i];?></span></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                            <p class="down pc"><a href="#">もっと見る <span>+</span></a></p>
                        </div>
                    <?php } ?>
                    </div>
                    <?php if(count($restArr)){ ?>
                    <p class="down sp"><a href="#">もっと見る <span>+</span></a></p>
                    <?php } ?>
                </div>
            </div>
            <?php
            $args01 = array(
                'post_type' => 'product',
                'paged' => $paged,
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $args02 = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $post_list = get_posts($args02);
            if($post_list){ $num = 0;
            foreach ( $post_list as $post ) { setup_postdata($post); $num++; } }wp_reset_postdata();
            $query = new WP_Query( $args01 ); if ( $query->have_posts() ) { ?>
            <h4 class="headLine05">該当製品数<span><?php echo $num; ?><small>件</small></span></h4>
            <ul class="comItemList flex">
            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">							
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="ttl"><?php the_title(); ?></p>
                        <?php endforeach;wp_reset_postdata(); endif; ?>
                        <p class="txt"><?php get_excerpt(54); ?></p>
                        <?php $terms01 = get_the_terms($post->ID,'productcat'); if($terms01){ ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </a>				
                </li>
            <?php } ?>
            </ul>
            <?php } wp_reset_postdata(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array( 
                'query' => $query,
                'options' => array(
                    'prev_text' => '<img src="'.get_template_directory_uri().'/img/common/icon07.png" width="8" alt="prev">',
                    'next_text' => '<img src="'.get_template_directory_uri().'/img/common/icon06.png" width="8" alt="next">',
                    'dotleft_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                    'dotright_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                ),
            ) );}?>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li>自社製品</li>
</ul>
<?php }else { $item = get_term_by('id',$parentId,'productcat'); if($item->parent == 0){ ?>
<div class="product">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2><?php echo $item->name; ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <h3 class="headLine03"><span><?php echo get_queried_object()->name; ?></span></h3>
            <div class="comTopBorBox">
                <h4 class="headLine01"><?php echo get_queried_object()->name; ?>に含まれる<br class="sp">カテゴリーを見る</h4>
                <div class="comLinkUlBox01">
                    <div class="comLinkUlBox02">
                    <?php
                        $args = array(
                            'taxonomy' => 'productcat',
                            'hide_empty' => 0,
                            'exclude' => '',
                            'parent' => get_queried_object()->term_id,
                        );
                    ?>
                    <?php $terms = get_terms( $args ); $restArr = array(); if($terms){ $count = 0; $nameArr= array(); ?>
                        <ul class="comLinkUl flex">
                        <?php foreach($terms as $term) { $count++; if($count <= 5){ ?>
                            <li><a href="<?php echo get_term_link( $term->term_id );?>"><span><?php echo $term->name;?></span></a></li>
                        <?php }else { array_push($restArr,$term->term_id); array_push($nameArr,$term->name); } } ?>
                        </ul>
                    <?php }?>
                    <?php if(count($restArr)){ ?>
                        <div class="downBox">
                            <div class="comLinkUlBox">
                                <ul class="comLinkUl flexC">
                                <?php for($i=0;$i < count($restArr);$i++){ ?>
                                    <li><a href="<?php echo get_term_link( $restArr[$i] );?>"><span><?php echo $nameArr[$i];?></span></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                            <p class="down pc"><a href="#">もっと見る <span>+</span></a></p>
                        </div>
                    <?php } ?>
                    </div>
                    <?php if(count($restArr)){ ?>
                    <p class="down sp"><a href="#">もっと見る <span>+</span></a></p>
                    <?php } ?>
                </div>
            </div>
            <?php
            $args01 = array(
                'post_type' => 'product',
                'paged' => $paged,
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $args02 = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $post_list = get_posts($args02);
            if($post_list){ $num = 0;
            foreach ( $post_list as $post ) { setup_postdata($post); $num++; } }wp_reset_postdata();
            $query = new WP_Query( $args01 ); if ( $query->have_posts() ) { ?>
            <h4 class="headLine05">該当製品数<span><?php echo $num; ?><small>件</small></span></h4>
            <ul class="comItemList flex">
            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">							
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="ttl"><?php the_title(); ?></p>
                        <?php endforeach;wp_reset_postdata(); endif; ?>
                        <p class="txt"><?php get_excerpt(54); ?></p>
                        <?php $terms01 = get_the_terms($post->ID,'productcat'); if($terms01){ ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </a>				
                </li>
            <?php } ?>
            </ul>
            <?php } wp_reset_postdata(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array( 
                'query' => $query,
                'options' => array(
                    'prev_text' => '<img src="'.get_template_directory_uri().'/img/common/icon07.png" width="8" alt="prev">',
                    'next_text' => '<img src="'.get_template_directory_uri().'/img/common/icon06.png" width="8" alt="next">',
                    'dotleft_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                    'dotright_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                ),
            ) );}?>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php echo get_term_link( $item->term_id );?>"><?php echo $item->name; ?></a>&gt;</li>
    <li><?php echo get_queried_object()->name; ?></li>
</ul>
<?php }else { $bigId = $item->parent; $bigitem = get_term_by('id',$bigId,'productcat'); ?>
<div class="product product03">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2><?php echo $bigitem->name; ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <h3 class="headLine03"><span><?php echo $item->name; ?></span></h3>
            <p class="title"><?php echo get_queried_object()->name; ?></p>
            <?php
            $args01 = array(
                'post_type' => 'product',
                'paged' => $paged,
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $args02 = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'productcat',
                        'field'    => 'term_id',
                        'terms'    => array( $curId ),
                        'operator' => 'IN',
                    ),
                ),
            );
            $post_list = get_posts($args02);
            if($post_list){ $num = 0;
            foreach ( $post_list as $post ) { setup_postdata($post); $num++; } }wp_reset_postdata();
            $query = new WP_Query( $args01 ); if ( $query->have_posts() ) { ?>
            <h4 class="headLine05">該当製品数<span><?php echo $num ;?><small>件</small></span></h4>
            <ul class="comItemList flex">
            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">							
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="ttl"><?php the_title(); ?></p>
                        <?php endforeach;wp_reset_postdata(); endif; ?>
                        <p class="txt"><?php get_excerpt(54); ?></p>
                        <?php $terms01 = get_the_terms($post->ID,'productcat'); if($terms01){ ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </a>				
                </li>
            <?php } ?>
            </ul>
            <?php } wp_reset_postdata(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array( 
                'query' => $query,
                'options' => array(
                    'prev_text' => '<img src="'.get_template_directory_uri().'/img/common/icon07.png" width="8" alt="prev">',
                    'next_text' => '<img src="'.get_template_directory_uri().'/img/common/icon06.png" width="8" alt="next">',
                    'dotleft_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                    'dotright_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                ),
            ) );}?>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php echo get_term_link( $bigitem->term_id );?>"><?php echo $bigitem->name; ?></a>&gt;</li>
    <li><a href="<?php echo get_term_link( $item->term_id );?>"><?php echo $item->name; ?></a>&gt;</li>
    <li><?php echo get_queried_object()->name; ?></li>
</ul>
<?php } } ?>
<?php get_footer(); ?>