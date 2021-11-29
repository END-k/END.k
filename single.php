<?php
$cat= get_the_category();
$cat_id = $cat[0]->term_id;
$cat_name = $cat[0]->name;
get_header();
?>
<div class="newsDetail">
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
					<p class="date"><?php the_time('Y.m.d'); ?><span class="tag"  <?php if(!in_category(array('optronnews', 'notice'))): ?>style="background-color:<?php if(in_category(array('new-products', 'others'))): ?>#0fd000;<?php elseif(in_category('exhibition')): ?>#0b7ef1<?php endif; ?>"<?php endif; ?>><?php echo $cat_name; ?></span></p>
				</div>
				<?php if(has_post_thumbnail()): ?>
				<div class="photo"><img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title(); ?>"></div>
				<?php endif; ?>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; ?>
			</div>

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
			<div class="comBtn comBtnBack"><a href="<?php bloginfo('url');?>/news">一覧に戻る</a></div>
		</div>
	</div>
</div>
<div class="comSubBox">
	<p>ご応募はこちらから</p>
	<p class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></p>
</div>
<ul id="pagePath">
	<li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
	<li><a href="<?php bloginfo('url');?>/news">ニュース一覧</a>&gt;</li>
	<li><?php the_title(); ?></li>
</ul>
<?php get_footer(); ?>
