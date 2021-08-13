<?php get_header(); ?>
<div class="product newsDetail productDetail">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
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
                        <?php if(get_field("ff_shopdesc")){ ?>
                        <p><?php the_field("ff_shopdesc"); ?></p>
                        <?php } ?>
                        <?php $terms01 = get_the_terms($post->ID,'productcat'); $terms02 = get_the_terms($post->ID,'wavelengthcat'); if($terms01||$terms02){ ?>
                        <ul class="tag">
                        <?php  ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == 0){ $biggestId = $term01->term_id; ?><li><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $biggestId){ $secondId = $term01->term_id; ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms01 as $term01){ ?>
                            <?php if($term01->parent == $secondId){ ?><li style="border-color: #0fd000;"><?php echo $term01->name; ?></li><?php } ?>
                            <?php } ?>
                            <?php foreach($terms02 as $term02){ ?>
                            <?php if($term02->parent != 0){ ?><li style="border-color: #f20000;"><?php echo $term02->name; ?></li><?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <?php if(get_field("ff_toptext")){ ?>
                <p class="text01"><?php the_field("ff_toptext"); ?></p>
                <?php } ?>
                <?php if(have_posts()): while (have_posts()) : the_post();?>
                    <?php the_content();?>
                <?php endwhile; endif;?>
                <?php if( have_rows('ff_specifications') ): ?>
                <h3 class="headLine04 title01">仕様</h3>
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
                <?php if( have_rows('ff_useful') ): ?>
                <h3 class="headLine04 title01">用途</h3>
                <ul class="textUl01">
                <?php while( have_rows('ff_useful') ): the_row(); 
                    $color = get_sub_field('ff_color');
                    $usecontent = get_sub_field('ff_usecontent');
                    ?>
                    <?php if($usecontent){ ?><li><span style="background-color: <?php echo $color; ?>;"></span><?php echo $usecontent; ?></li><?php } ?>
                <?php endwhile; ?>
                </ul>
                <?php endif; ?>
                <?php 
                $images01 = get_field('ff_imglist');
                if( $images01 ): ?>
                <h3 class="headLine04 title01">図面</h3>
                <ul class="imgUl flexB">
                <?php foreach( $images01 as $image01 ): ?>
                    <li><img src="<?php echo esc_url($image01['url']); ?>" alt=""></li>
                <?php endforeach; ?>
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
                <?php $table = get_field( 'ff_table' ); ?>
                <?php if ( ! empty ( $table ) ) { $num = 0; ?>
                <div class="tabBox privacyBox">
                    <table>
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
                    </table>
                </div>
                <?php } ?>
                <p class="spTxt sp"><span>◀︎</span>表は横にスクロールして見ることができます<span>▶︎</span></p>
                <p class="contTxt">この製品のご質問・資料請求などはこちらから</p>
                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact#<?php echo $post->ID; ?>">お問い合わせ</a></div>
            </div>
            <?php if( $featured_posts ): foreach( $featured_posts as $post ): setup_postdata($post); ?>
            <div class="comDetailBox comDetailBox01">
                <div class="contBox flexB">
                    <p class="ttl"><small>ブランド紹介</small><span><?php the_title(); ?></span></p>
                    <p class="link"><a href="<?php bloginfo('url');?>/?s=&cat02=<?php echo $post->ID; ?>&search_type=1">このブランドの製品をもっと見る</a></p>
                </div>
                <?php if(get_field("ff_content")){ ?><p class="text02"><?php the_field("ff_content"); ?></p><?php } ?>
            </div>
            <?php endforeach;wp_reset_postdata(); endif; ?>
            <h3 class="headLine06">関連製品</h3>
            <p class="comTxt">併せて使うと便利な製品をご紹介します</p>
            <div class="detailSlideBox">
                <ul class="comItemList slide flex">					
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo04.jpg);"></div></div>
                            <h3 class="headLine04"> 製品名が入ります。</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">説明文が入ります。最大文字数54文字です。それ以上は…表示になります。説明文が入ります。最大文字数54文字です…</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo05.jpg);"></div></div>
                            <h3 class="headLine04">1000W(1KW), 2000W(2KW) CW ファイバーレーザ</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">レイアウトのサンプルです製品名・画像・カテゴリーなど実際のものとは異なる場合があります。</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo06.jpg);"></div></div>
                            <h3 class="headLine04"> 低コヒーレンス PMファイバ出力 光源</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">説明文が入ります。最大文字数54文字です。それ以上は…表示になります。説明文が入ります。最大文字数54文字です…</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>							
                </ul>
            </div>
            <h3 class="headLine06">おすすめ製品</h3>
            <div class="detailSlideBox">
                <ul class="comItemList slide comItemList02 flex">					
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo04.jpg);"></div></div>
                            <h3 class="headLine04"> 製品名が入ります。</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">説明文が入ります。最大文字数54文字です。それ以上は…表示になります。説明文が入ります。最大文字数54文字です…</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo05.jpg);"></div></div>
                            <h3 class="headLine04">1000W(1KW), 2000W(2KW) CW ファイバーレーザ</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">レイアウトのサンプルです製品名・画像・カテゴリーなど実際のものとは異なる場合があります。</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php bloginfo('template_url');?>/img/common/photo06.jpg);"></div></div>
                            <h3 class="headLine04"> 低コヒーレンス PMファイバ出力 光源</h3>
                            <p class="ttl">Liverage</p>
                            <p class="txt">説明文が入ります。最大文字数54文字です。それ以上は…表示になります。説明文が入ります。最大文字数54文字です…</p>							
                            <ul class="tag">
                                <li>自社製品</li>
                                <li style="border-color: #0fd000;">光ファイバ</li>
                                <li style="border-color: #0fd000;">シングルモードファイバパッチコード(SM)</li>
                            </ul>
                    </a>				
                    </li>							
                </ul>
            </div>
            <div class="comBtn comBtnBack"><a href="<?php bloginfo('url');?>/product">一覧に戻る</a></div>
        </div>
    </div>
</div>
<div class="comSubBox">
    <p>ご応募はこちらから</p>
    <div class="comBtnBox">
        <p class="comBtn"><a href="<?php bloginfo('url');?>/contact#<?php echo $post->ID; ?>">お問い合わせ</a></p>
        <p class="comBtn comBtn01"><a href="<?php bloginfo('url');?>/contact" target="_blank"><span>資料ダウンロード</span></a></p>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php bloginfo('url');?>">検索結果</a>&gt;</li>
    <li><a href="#">光源</a>&gt;</li>
    <li><?php the_title(); ?></li>
</ul>
<?php get_footer(); ?>