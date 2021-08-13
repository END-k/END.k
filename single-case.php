<?php get_header(); ?>
<div class="caseDetail">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
            <h2><?php the_title(); ?></h2>   
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="comDetailBox">
                <p class="catBox"><span class="tagTxt"><span class="tag">カテゴリー</span><span class="tag" style="border-color: #0fd000;">中カテゴリ</span><span class="tag"style="border-color: #0fd000;">子カテゴリ</span></span></p>
                <?php if(have_posts()): while (have_posts()) : the_post();?>
                    <?php the_content();?>
                <?php endwhile; endif;?>
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
                <p class="btmTxt">
                    ファイバ径、数量、デバイス装着の有無により準備にかかる時間が大きく異なるため、<br>
<span class="line">都度のお見積り作業をさせて頂きます</span>
                </p>                    

                <p class="contTxt">ご質問・資料請求などはこちらから</p>
                <div class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></div>
            </div>

            <h3 class="headLine06">関連製品</h3>
            <p class="comTxt">併せて使うと便利な製品をご紹介します</p>
            <div class="detailSlideBox">
                <ul class="comItemList slide flex">					
                    <li>
                        <a href="#">							
                            <div class="phoBox"><div class="pho"><img src="<?php bloginfo('template_url');?>/img/common/photo04.jpg" alt=""></div></div>
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
                            <div class="phoBox"><div class="pho"><img src="<?php bloginfo('template_url');?>/img/common/photo05.jpg" alt=""></div></div>
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
                            <div class="phoBox"><div class="pho"><img src="<?php bloginfo('template_url');?>/img/common/photo06.jpg" alt=""></div></div>
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
            <div class="comBtn comBtnBack"><a href="<?php bloginfo('url');?>/case">一覧に戻る</a></div>
        </div>
    </div>
</div>
<div class="comSubBox">
    <p>ご応募はこちらから</p>
    <p class="comBtn"><a href="<?php bloginfo('url');?>/contact">お問い合わせ</a></p>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li><a href="<?php bloginfo('url');?>/case">検索結果</a>&gt;</li>
    <li><?php the_title(); ?></li>
</ul>
<?php get_footer(); ?>