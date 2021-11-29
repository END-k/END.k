<?php get_header(); ?>
<style>
.productsList {
    list-style-type: decimal;
}

.productsList li {
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
    word-break: break-all;
}
</style>
<div class="news">
	<section class="pageTitle">
		<embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
		<h2>製品リスト</h2>
		<ul class="language flex pc">
			<li><span>LANGUAGE</span></li>
			<li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
		</ul>
	</section>
	<div id="main">
		<div class="content">
			<?php
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'name'
			);
			$news_query = new WP_Query($args)
			?>
			<?php if ( $news_query->have_posts() ) : ?>
			<ol class="productsList">
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <li>
					<a href="<?php the_permalink(); ?>">
                        <div><?php echo $post->post_name; ?></div>
                        <div><?php the_title(); ?></div>
                    </a>
				</li>
				<?php endwhile; ?>
			</ol>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
