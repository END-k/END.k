<?php get_header(); ?>
<div class="caseDetail">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
            <h2><?php the_title(); ?></h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="comDetailBox">
                <?php
                    $terms01 = get_the_terms($post->ID,'casecat');
                ?>
                <?php if($terms01): ?>
                <p class="catBox">
                    <span class="tagTxt">
                        <?php foreach($terms01 as $term01){ ?>
                        <span class="tag"><?php echo $term01->name; ?></span>
                        <?php } ?>
                    </span>
                </p>
                <?php endif; ?>
                <div class="caseDetailWrap">
                <?php if(have_posts()): while (have_posts()) : the_post();?>
                    <?php the_content();?>
                <?php endwhile; endif;?>
                </div>

                <?php if( have_rows('ff_use') ): ?>
                <h3>用途</h3>
                <ul class="txtList">
                <?php while( have_rows('ff_use') ): the_row();
                    $iconcolor = get_sub_field('ff_iconcolor');
                    $useitem = get_sub_field('ff_useitem');
                    ?>
                    <?php if($useitem){ ?><li><span style="background-color: <?php echo $iconcolor; ?>;"></span><?php echo $useitem; ?></li><?php } ?>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?>
                <?php if( have_rows('ff_tablerepeat') ): ?>
                <?php while( have_rows('ff_tablerepeat') ): the_row();
                    $table = get_sub_field('ff_table');
                    ?>
                <?php if ( ! empty ( $table ) ) { ?>
                <div class="tabBox privacyBox">
                    <table>
                    <?php $i = 0; foreach ( $table['body'] as $tr ) { $i++;
                        echo '<tr>';
                            if($i == 1){
                                foreach ( $tr as $td ) {
                                    echo '<th>';
                                        echo $td['c'];
                                    echo '</th>';
                                }
                            }else {
                                foreach ( $tr as $td ) {
                                    echo '<td>';
                                        echo $td['c'];
                                    echo '</td>';
                                }
                            }
                        echo '</tr>';
                    } ?>
                    </table>
                </div>
                <p class="spTxt sp"><span>◀︎</span>表は横にスクロールして見ることができます<span>▶︎</span></p>
                <?php } ?>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php if( have_rows('ff_procedure') ): ?>
                <?php while( have_rows('ff_procedure') ): the_row();
                    $procedurettl = get_sub_field('ff_procedurettl');
                    $procedurecontent = get_sub_field('ff_procedurecontent');
                    $procedureimg = get_sub_field('ff_procedureimg');
                    ?>
                <div class="imgInner flexB">
                    <div class="txtBox">
                        <?php if($procedurettl){ ?><h4><?php echo $procedurettl; ?></h4><?php } ?>
                        <?php if($procedurecontent){ ?><p><?php echo $procedurecontent; ?></p><?php } ?>
                    </div>
                    <?php if($procedureimg){ ?>
                    <div class="phoBox">
                        <img src="<?php echo $procedureimg; ?>" alt="">
                    </div>
                    <?php } ?>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <!--<p class="btmTxt">
                    ファイバ径、数量、デバイス装着の有無により準備にかかる時間が大きく異なるため、<br><span class="line">都度のお見積り作業をさせて頂きます</span>
                </p>-->

                <p class="contTxt">ご質問・資料請求などはこちらから</p>
                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></div>
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
                        <p class="txt"><?php get_excerpt(54); ?></p>
                        <?php $terms01 = get_the_terms($post->ID,'productcat'); if($terms01){ ?>
                        <ul class="tag">
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        </a>
                    </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="comBtn comBtnBack"><a href="<?php bloginfo('url');?>/case">一覧に戻る</a></div>
        </div>
    </div>
</div>
<div class="comSubBox">
    <div class="comSubBox-close"><img src="<?php echo get_template_directory_uri(); ?>/img/product/close-cc.png" width="15" alt=""></div>
    <p>製品のお問い合わせはこちら</p>
    <p class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></p>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php bloginfo('url');?>/case">事例一覧</a>&gt;</li>
    <li><?php the_title(); ?></li>
</ul>
<?php get_footer(); ?>
