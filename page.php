<?php get_header(); ?>
<?php add_action ('loop_start', 'needRemoveP'); ?>
	<?php if(have_posts()): while (have_posts()) : the_post();?>
	<?php the_content();?>
	<?php endwhile; endif;?>
<?php get_footer(); ?>
