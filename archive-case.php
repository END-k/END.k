<?php get_header(); ?>
<div class="case">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2>事例一覧</h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <p class="pTop">オプトロンサイエンスの製品の採用事例や<br>
            カスタマイズ事例などがご覧いただけます。
            </p>
            <ul class="comCaseList flexB">
            <?php if(have_posts()): while (have_posts()) : the_post();?>
                <li>
                    <a href="<?php the_permalink();?>">
                        <div class="subBox flexB">
                            <div class="pho"><span style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></span></div>
                            <div class="txtBox">
                                <h3 class="headLine02"><?php the_title(); ?></h3>
                                <p><?php get_excerpt(48); ?></p>
                            </div>
                        </div>
                    </a>
                    <ul class="tag">
                        <li>カテゴリー</li>
                        <li style="border-color: #0fd000;">中カテゴリ</li>
                        <li style="border-color: #0fd000;">子カテゴリ</li>
                        <li style="border-color: #f20000;">波長(光源のみ)</li>
                    </ul>				
                </li>
            <?php endwhile; endif;?>
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
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li>事例一覧</li>
</ul>
<?php get_footer(); ?>