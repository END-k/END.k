<?php get_header(); ?>
<div class="news">
	<section class="pageTitle">
		<embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
		<h2>ニュース一覧</h2>
		<ul class="language flex pc">
			<li><span>LANGUAGE</span></li>
			<li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
		</ul>
	</section>
	<div id="main">
		<div class="content">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'post',//　ページの種類
				'posts_per_page' => 10,
				'paged' => $paged,
				'orderby' => 'date',
				'order' => 'DESC',
                'post_status' => 'publish'
			);
			$news_query = new WP_Query($args)
			?>
			<?php if ( $news_query->have_posts() ) : ?>
			<ul class="comNewsList">
				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                <?php
                    $cat= get_the_category();
                    $cat = $cat[0];
                    $cat_slug = $cat->slug;
                    $cat_name = $cat->cat_name;
                ?>
				<li>
					<a href="<?php the_permalink(); ?>">
                        <dl>
                            <dt>
                                <span class="date"><?php the_time('Y.m.d'); ?></span>
                                <span class="tag" <?php if(!in_category(array('optronnews', 'notice'))): ?>style="background-color:<?php if(in_category(array('new-products', 'others'))): ?>#0fd000;<?php elseif(in_category('exhibition')): ?>#0b7ef1<?php endif; ?>"<?php endif; ?>><?php echo $cat_name; ?></span></dt>
                            <dd><span class="txt"><?php the_title(); ?></span></dd>
                        </dl>
                    </a>
				</li>
				<?php
					endwhile;
					// else:
					// 	echo '<div><p>Newsはありません。</p></div>';
					endif;
				?>
			</ul>
			<div>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array(
				'query' => $news_query,
                'options' => array(
                    'prev_text' => '<img src="'.get_template_directory_uri().'/img/common/icon07.png" width="8" alt="prev">',
                    'next_text' => '<img src="'.get_template_directory_uri().'/img/common/icon06.png" width="8" alt="next">',
                    'dotleft_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
                    'dotright_text' => '<img src="'.get_template_directory_uri().'/img/common/line04.png" width="28" alt="">',
					'num_pages' => 3,
                ),
            ) );}?>

			</div>

			<?php //endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>
<ul id="pagePath">
	<li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
	<li>ニュース一覧</li>
</ul>
<?php get_footer(); ?>
