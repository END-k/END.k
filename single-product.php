<?php
$productcats = get_the_terms($post->ID,'productcat');
foreach($productcats as $productcat) {
    $productcat_name = $productcat->name;
    $productcat_slug = $productcat->slug;
}
$post_id = get_the_ID();
get_header();
?>
<div class="product newsDetail productDetail">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="comDetailBox">
                <div class="ttlBox">
                    <p class="title"><?php the_title(); ?></p>
                </div>
                <div class="imgBox flexB">
                    <?php
                    $images = get_field('ff_slide');
                    if( $images ): ?>
                    <div class="photoBox">
                        <div class="slideBox01">
                            <ul class="slide">
                            <?php foreach( $images as $image ): ?>
                                <li><img src="<?php echo esc_url($image['url']); ?>" alt=""></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="slideBox02">
                            <ul class="slide">
                            <?php foreach( $images as $image ): ?>
                                <li><img src="<?php echo esc_url($image['url']); ?>" alt=""></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="textBox">
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                        <p class="headLine04"><small>メーカー名</small><span><?php the_title(); ?></span></p>
                        <?php endforeach;wp_reset_postdata(); endif; ?>
                        <?php
                                $taxonomy = 'productcat';
                                $terms01 = get_the_terms($post->ID,$taxonomy);

                                $terms02 = get_ordered_terms($post->ID,'slug', 'ASC', 'wavelengthcat');
                                $ancestor_maxnum = 1;
                                $ff_wavelengthlabel = get_field('ff_wavelengthlabel');
                            ?>
                            <ul class="tag">
                                <?php if($terms01): ?>
                                <?php foreach($terms01 as $term01){ ?>
                                <?php
                                    $dep = count(get_ancestors($term01->term_id, $taxonomy));
                                ?>
                                <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                                <?php } ?>
                                <?php endif; ?>
                                <?php if($terms02): ?>
                                <?php if($ff_wavelengthlabel): ?>
                                <li class="rainbow"><span><?php echo $ff_wavelengthlabel; ?></span></li>
                                <?php elseif (is_object_in_term($post->ID, 'wavelengthcat','multi-wavelength')): ?>
                                <li class="rainbow"><span>多波長チューナブル</span></li>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
                                <?php } ?>
                                <?php else: ?>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
                                <?php } ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </ul>

                        <?php if(get_field("ff_shopdesc")){ ?>
                        <p><?php the_field("ff_shopdesc"); ?></p>
                        <?php } ?>

                    </div>
                </div>
                <?php if(get_field("ff_toptext")){ ?>
                <p class="text01"><?php the_field("ff_toptext"); ?></p>
                <?php } ?>
                <div class="productDetailWrap">
                    <?php if(have_posts()): while (have_posts()) : the_post();?>
                        <?php the_content();?>
                    <?php endwhile; endif;?>
                </div>

                <?php if( have_rows('ff_specifications') || get_field('ff_specifications_content')): ?>
                <h3 class="headLine04 title01">仕様</h3>
                <?php endif; ?>
                <?php if( have_rows('ff_specifications') ): ?>
                <ul class="textUl flexB">
                <?php while( have_rows('ff_specifications') ): the_row();
                    $spettl = get_sub_field('ff_spettl');
                    $specontent = get_sub_field('ff_specontent');
                    ?>
                    <li>
                        <?php if($spettl){ ?><p class="ttl"><?php echo $spettl; ?></p><?php } ?>
                        <?php if($specontent){ ?><p class="txt"><?php echo $specontent; ?></p><?php } ?>
                    </li>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?>
                <?php $ff_specifications_content = get_field('ff_specifications_content');
                if( $ff_specifications_content) {
                    echo $ff_specifications_content;
                }
                ?>
                <?php if( have_rows('ff_useful') || get_field('ff_useful_content') ): ?>
                <h3 class="headLine04 title01">用途</h3>
                <?php endif; ?>
                <?php if( have_rows('ff_useful') ): ?>
                <ul class="textUl01">
                <?php while( have_rows('ff_useful') ): the_row();
                    $color = get_sub_field('ff_color');
                    $usecontent = get_sub_field('ff_usecontent');
                    ?>
                    <?php if($usecontent){ ?><li><span style="background-color: <?php echo $color; ?>;"></span><?php echo $usecontent; ?></li><?php } ?>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <?php $ff_useful_content = get_field('ff_useful_content');
                if( $ff_useful_content) {
                    echo $ff_useful_content;
                }
                ?>

                <?php
                    $images01 = get_field('ff_imglist');
                    if( $images01 || have_rows('ff_imglist_pdf') ):
                ?>
                <h3 class="headLine04 title01">図面</h3>
                <?php endif; ?>

                <?php if($images01): ?>
                <ul class="imgUl flexB">
                <?php foreach( $images01 as $image01 ): ?>
                    <li><img src="<?php echo esc_url($image01['url']); ?>" alt=""></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if( have_rows('ff_imglist_pdf') ): ?>
                <ul class="textUl01 textUl02 textUllink icon-pdf">
                    <?php
                    while( have_rows('ff_imglist_pdf') ): the_row();
                        $ff_imglist_pdf_content = get_sub_field('ff_imglist_pdf_content');
                    ?>
                    <li><a target="_blank" href="<?php echo $ff_imglist_pdf_content['url'] ; ?>"><?php echo $ff_imglist_pdf_content['title'] ; ?><br><small><?php echo $ff_imglist_pdf_content['caption'] ; ?></small></a></li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <?php if( have_rows('ff_point') ): ?>
                <h3 class="headLine04 title01">ポイント</h3>
                <ul class="textUl01 textUl02">
                <?php while( have_rows('ff_point') ): the_row();
                    $pointcolor = get_sub_field('ff_pointcolor');
                    $pointcontent = get_sub_field('ff_pointcontent');
                    ?>
                    <?php if($pointcontent){ ?><li><span style="background-color: <?php echo $pointcolor; ?>;"></span><?php echo $pointcontent; ?></li><?php } ?>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?>
                <?php $tablestyle = get_field("ff_tablestyle"); $table = get_field( 'ff_table' ); ?>
                <?php if ( ! empty ( $table ) ) { $num = 0; $num01 = 0; ?>
                <div class="tabBox privacyBox<?php if($tablestyle == 'styleB'){ echo ' tabBox01'; }else if($tablestyle == 'styleC'){ echo ' tabBox02'; } ?>">
                    <table>
                    <?php if($tablestyle == '横テーブル'){ ?>
                    <?php foreach ( $table['body'] as $tr ) { $num++; ?>
                        <tr>
                        <?php foreach ( $tr as $td ) {
                            if($num == 1){
                                echo '<th>';
                                echo $td['c'];
                                echo '</th>';
                            }else {
                                echo '<td>';
                                echo $td['c'];
                                echo '</td>';
                            }
                        }
                        ?>
                        </tr>
                    <?php } ?>
                    <?php }else if($tablestyle == '縦テーブル'){ ?>
                    <?php foreach ( $table['body'] as $tr ) { $num=0; ?>
                        <tr>
                        <?php foreach ( $tr as $td ) { $num++;
                            if($num == 1){
                                echo '<th>';
                                echo $td['c'];
                                echo '</th>';
                            }else {
                                echo '<td>';
                                echo $td['c'];
                                echo '</td>';
                            }
                        }
                        ?>
                        </tr>
                    <?php } ?>
                    <?php }else { ?>
                    <?php foreach ( $table['body'] as $tr ) { $num++; $num01=0; ?>
                        <tr>
                        <?php foreach ( $tr as $td ) { $num01++;
                            if($num == 1||$num01 == 1){
                                echo '<th>';
                                echo $td['c'];
                                echo '</th>';
                            }else {
                                echo '<td>';
                                echo $td['c'];
                                echo '</td>';
                            }
                        }
                        ?>
                        </tr>
                    <?php } ?>
                    <?php } ?>
                    </table>
                </div>
                <?php } ?>
                <p class="spTxt sp"><span>◀︎</span>表は横にスクロールして見ることができます<span>▶︎</span></p>

                <?php if( have_rows('ff_download') ): ?>
                <h3 class="headLine04 title01">資料ダウンロード</h3>
                <ul class="textUl01 textUl02 textUllink icon-pdf">
                    <?php
                    while( have_rows('ff_download') ): the_row();
                        $ff_download_content = get_sub_field('ff_download_content');
                    ?>
                    <li><a target="_blank" href="<?php echo $ff_download_content['url'] ; ?>"><?php echo $ff_download_content['title'] ; ?></a></li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact#<?php echo $post->ID; ?>">お問い合わせ</a></div>
            </div>
            <?php if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
            <?php $post_id = get_the_ID(); ?>
            <div class="comDetailBox comDetailBox01">
                <div class="contBox flexB">
                    <p class="ttl"><small>ブランド紹介</small><span><?php the_title(); ?></span></p>
                    <p class="link"><a href="<?php bloginfo('url');?>?search_type=1&s=&cat01=&cat02=<?php echo $post_id; ?>&cat03=">このブランドの製品をもっと見る</a></p>
                </div>
                <?php if(get_field("ff_content02")){ ?><div class="text02"><?php the_field("ff_content02"); ?></div><?php } ?>
            </div>
            <?php endforeach;wp_reset_postdata(); endif; ?>

            <?php if( have_rows('ff_related') ): ?>
            <h3 class="headLine06">関連製品</h3>
            <p class="comTxt">併せて使うと便利な製品をご紹介します</p>
            <div class="detailSlideBox">
                <ul class="comItemList slide flex">
                    <?php
                        while( have_rows('ff_related') ): the_row();
                        $ff_related_content = get_sub_field('ff_related_content');
                    ?>
                    <?php
                        $args = array(
                            'post_type' => 'product',
                            'post__in' => array($ff_related_content),
                            'posts_per_page' => 1,
                        );
                        $related_query = new WP_Query($args);
                    ?>
                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <?php $ff_excerpt = get_field( 'ff_excerpt', $ff_related_content ); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                            <h3 class="headLine04"><?php the_title(); ?></h3>
                            <?php
                            $featured_posts = get_field('ff_distributor');
                            if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                            <p class="ttl"><?php the_title(); ?></p>
                            <?php endforeach;wp_reset_postdata(); endif; ?>

                            <div class="txt"><?php echo $ff_excerpt; ?></div>

                            <?php
                                $taxonomy = 'productcat';
                                $terms01 = get_the_terms($ff_related_content,$taxonomy);
                                $ancestor_maxnum = 1;
                                $ff_wavelengthlabel = get_field('ff_wavelengthlabel', $ff_related_content);
                            ?>
                            <ul class="tag">
                                    <?php foreach($terms01 as $term01){ ?>
                                    <?php
                                        $dep = count(get_ancestors($term01->term_id, $taxonomy));
                                    ?>
                                    <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                                    <?php } ?>
                                <?php
                                    $terms02 = get_ordered_terms($ff_related_content,'slug', 'ASC', 'wavelengthcat');
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
                    <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php
                $args = array(
                    'post_type' => 'product',
                    'post__not_in' => array($post_id),
                    'posts_per_page' => 3,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'productcat',
                            'field' => 'slug',
                            'terms' => $productcat_slug,
                        )
                    ),
                );
                $product_query = new WP_Query($args);
            ?>
            <?php if ( $product_query->have_posts() ) : ?>
            <h3 class="headLine06">おすすめ製品</h3>
            <div class="detailSlideBox">
                <ul class="comItemList slide comItemList02 flex">
                    <?php while ( $product_query->have_posts() ) : $product_query->the_post(); ?>
                    <?php $recommend_id = get_the_ID(); ?>
                    <?php $ff_excerpt = get_field( 'ff_excerpt', $recommend_id ); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                            <h3 class="headLine04"><?php the_title(); ?></h3>
                            <?php
                            $featured_posts = get_field('ff_distributor');
                            if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
                            <p class="ttl"><?php the_title(); ?></p>
                            <?php endforeach;wp_reset_postdata(); endif; ?>

                            <div class="txt"><?php echo $ff_excerpt; ?></div>

                            <?php
                                $taxonomy = 'productcat';
                                $terms01 = get_the_terms($post->ID,$taxonomy);
                                $terms02 = get_ordered_terms($post->ID,'slug', 'ASC', 'wavelengthcat');
                                $ancestor_maxnum = 1;
                                $ff_wavelengthlabel = get_field('ff_wavelengthlabel');
                            ?>
                            <ul class="tag">
                                <?php if($terms01): ?>
                                <?php foreach($terms01 as $term01){ ?>
                                <?php
                                    $dep = count(get_ancestors($term01->term_id, $taxonomy));
                                ?>
                                <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                                <?php } ?>
                                <?php endif; ?>
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
            </div>
            <div class="comBtn comBtnBack"><a href="<?php bloginfo('url');?>/product">一覧に戻る</a></div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<div class="comSubBox">
    <div class="comSubBox-close"><img src="<?php echo get_template_directory_uri(); ?>/img/product/close-cc.png" width="15" alt=""></div>
    <p>製品のお問い合わせはこちら</p>
    <div class="comBtnBox">
        <p class="comBtn"><a href="<?php bloginfo('url');?>/contact#<?php echo $post->ID; ?>">お問い合わせ</a></p>
    </div>
</div>

<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php bloginfo('url');?>/product">製品情報</a>&gt;</li>
    <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><a href="<?php bloginfo('url');?>/productcat/<?php echo $term01->slug; ?>"><?php echo $term01->name; ?></a>&gt;</li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li><a href="<?php bloginfo('url');?>/productcat/<?php echo $term01->slug; ?>"><?php echo $term01->name; ?></a>&gt;</li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li><a href="<?php bloginfo('url');?>/productcat/<?php echo $term01->slug; ?>"><?php echo $term01->name; ?></a>&gt;</li><?php } ?>
                            <?php } ?>
    <li><?php the_title(); ?></li>
</ul>
<?php get_footer(); ?>
