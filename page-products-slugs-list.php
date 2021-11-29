<?php get_header(); ?>
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
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <div><?php echo $post->post_name; ?></div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
