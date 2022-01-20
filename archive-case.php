<?php get_header(); ?>
<div class="case">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2>事例一覧</h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
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
                                <h3 class="headLine02">
                                    <?php
                                    //整形したい文字列
                                    $text = get_the_title();
                                    //文字数の上限
                                    $limit = 24;
                                    //分岐
                                    if(mb_strlen($text) > $limit) {
                                    $title = mb_substr($text,0,$limit);
                                    echo $title . '･･･' ;
                                    } else {
                                    the_title();
                                    }
                                    ?>
                                </h3>
                                <p><?php get_excerpt(48); ?></p>
                            </div>
                        </div>
                    </a>
                    <?php
                        $terms01 = get_the_terms($post->ID,'casecat');
                    ?>
                    <?php if($terms01): ?>
                    <ul class="tag">
                        <?php foreach($terms01 as $term01){ ?>
                        <li><?php echo $term01->name; ?></li>
                        <?php } ?>
                    </ul>
                    <?php endif; ?>
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
