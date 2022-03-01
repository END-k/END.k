<?php
get_header();
$parentId = get_queried_object()->parent;
$curId = get_queried_object()->term_id;
$check = get_term_children($curId, 'productcat');
?>
<?php
$args = array(
'post_type' => 'product',
'posts_per_page' => -1,
'tax_query' => array(
    array(
        'taxonomy' => 'productcat',
        'field' => 'id',
        'terms' => array($curId)
    )
),
);
$product_query = new WP_Query($args)
?>
<?php $num = $product_query->post_count; ?>
<?php wp_reset_postdata(); ?>
<div class="product product01">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2><?php single_term_title(); ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <?php if($check): ?>
            <div class="comTopBorBox">
                <h4 class="headLine01"><?php single_term_title(); ?>に含まれる<br class="sp">カテゴリーを見る</h4>
                <div class="comLinkUlBox01">
                    <div class="comLinkUlBox02">
                        <?php
                            $args = array(
                                'taxonomy' => 'productcat',
                                // 'hide_empty' => 0,
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
                                    <li>
                                        <a href="<?php echo get_term_link( $restArr[$i] );?>">
                                            <span><?php echo $nameArr[$i];?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                            <p class="down pc"><a href="#">もっと見る <span>+</span></a></p>
                        </div>
                        <?php } ?>
                    </div>
                    <?php //if(count($restArr) > 0){ ?>
                    <p class="down sp"><a href="#">もっと見る <span>+</span></a></p>
                    <?php //} ?>
                </div>
            </div>
            <?php endif; ?>

            <h4 class="headLine05">該当製品数<span><?php echo $num; ?><small>件</small></span></h4>
            <ul class="comItemList flex">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04">
                        <?php
                            //整形したい文字列
                            $text = get_the_title();
                            //文字数の上限
                            $limit = 33;
                            //分岐
                            if(mb_strlen($text) > $limit) {
                            $title = mb_substr($text,0,$limit);
                            echo $title . '･･･' ;
                            } else {
                            the_title();
                            }
                            ?>
                        </h3>
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
                            //$terms01 = get_ordered_terms($post->ID,'name', 'ASC', $taxonomy);
                            $ancestor_maxnum = 1;
                            $ff_wavelengthlabel = get_field('ff_wavelengthlabel');
                        ?>
                        <ul class="tag">
                            <?php
                            //親カテゴリ一斉表示
                            foreach($terms01 as $term01){
                                // カテゴリの親・子・孫取得
                                $dep = count(get_ancestors($term01->term_id, $taxonomy));//get_ancestors=配列階層の下から上へ返すやつ
                                if($dep < $ancestor_maxnum):
                            ?>
                            <li style="border-color: #0b7ef1;"><?php echo $term01->name; ?></li>
                            <?php
                            endif;
                            }
                            ?>

                            <?php
                            //子カテゴリ一斉表示
                            foreach($terms01 as $term01){
                                // カテゴリの親・子・孫取得
                                $dep = count(get_ancestors($term01->term_id, $taxonomy));//get_ancestors=配列階層の下から上へ返すやつ
                                // 親でなく、自分より上の階層が１個＝子カテゴリのみ抽出
                                if($term01->parent != 0 && $dep === 1):
                            ?>
                            <li style="border-color: #0fd000;"><?php echo $term01->name; ?></li>
                            <?php
                            endif;
                            }
                            ?>

                            <?php
                            //孫カテゴリ一斉表示
                            foreach($terms01 as $term01){
                                // カテゴリの親・子・孫取得
                                $dep = count(get_ancestors($term01->term_id, $taxonomy));//get_ancestors=配列階層の下から上へ返すやつ
                                // 親でなく、自分より上の階層が2個＝孫カテゴリのみ抽出
                                if($term01->parent != 0 && $dep === 2):
                            ?>
                            <li style="border-color: #f20000;"><?php echo $term01->name; ?></li>
                            <?php
                            endif;
                            }
                            ?>

                            <?php
                                //波長のタグ
                                $terms02 = get_ordered_terms($post->ID,'description', 'ASC', 'wavelengthcat');
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
        </div>
    </div>
</div>
<?php if($parentId == 0): ?>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><?php single_term_title(); ?></li>
</ul>
<?php else: ?>
<?php
    $item = get_term_by('id',$parentId,'productcat');
    if($item->parent == 0):
?>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php echo get_term_link( $item->term_id );?>"><?php echo $item->name; ?></a>&gt;</li>
    <li><?php single_term_title(); ?></li>
</ul>
<?php else: ?>
<?php
    $bigId = $item->parent;
    $bigitem = get_term_by('id',$bigId,'productcat');
?>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php echo get_term_link( $bigitem->term_id );?>"><?php echo $bigitem->name; ?></a>&gt;</li>
    <li><a href="<?php echo get_term_link( $item->term_id );?>"><?php echo $item->name; ?></a>&gt;</li>
    <li><?php single_term_title(); ?></li>
</ul>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
