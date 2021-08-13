<?php get_header(); ?>

<div id="conts">
	<?php if(have_posts()): while (have_posts()) : the_post();?>
	<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	<div class="mb20"><?php the_excerpt();?></div>
	<?php endwhile; endif;?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
