<?php get_header(); ?>
<div class="thanks page404">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2>お探しのページが見つかりません</h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <p class="ttl">リクエストいただいた<br class="sp">URLのページは下記のような理由により<br>
            ご覧いただくことができません。</p>
            <ul class="textUl">
                <li>入力したURLが間違っているため</li>
                <li>該当するURLのページが移転したか、URLが変更されたため</li>
                <li>ページが削除されたため</li>
            </ul>
            <p class="ttl ttl02">下記よりトップページに戻り、<br class="sp">ご希望のページをお探しください。</p>
            <div class="comBtn"><a href="<?php bloginfo('url');?>">TOPページに戻る</a></div>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li>404エラー</li>
</ul>
<?php get_footer(); ?>