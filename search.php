<?php get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$search_type = $_GET['search_type'] ? $_GET['search_type'] : '';
$product = $_GET['cat01'] ? $_GET['cat01'] : '';
$distributor = $_GET['cat02'] ? $_GET['cat02'] : '';
$wavelength = $_GET['cat03'] ? $_GET['cat03'] : '';
$s = $_GET['s'] ? $_GET['s'] : '';
$w = $_GET['w'] ? $_GET['w'] : '';
$output = $_GET['output'] ? $_GET['output'] : '';
$nanowave = $_GET['nanowave'] ? $_GET['nanowave'] : array();
$mwat = $_GET['mwat'] ? $_GET['mwat'] : array();
$wat = $_GET['wat'] ? $_GET['wat'] : array();
$mode = $_GET['mode'] ? $_GET['mode'] : array();
$source = $_GET['source'] ? $_GET['source'] : array();
if($search_type == 1){
    if($product){
        $args01 = array(
            'taxonomy' => 'productcat',
            'field'    => 'term_id',
            'terms'    => array( $product ),
            'operator' => 'IN',
        );
    }else {
        $args01 = '';
    }
    if($wavelength){
        $mulargs = array();
        if($wavelength == 'mul01' || $wavelength == 'mul02' || $wavelength == 'mul03'){
            if($wavelength == 'mul01'){
                $mulargs = array(416,417);
            }else if($wavelength == 'mul02'){
                $mulargs = array(428,429);
            }else {
                $mulargs = array(455,483);
            }
        }else {
            $mulargs = array($wavelength);
        }
        $args02 = array(
            'taxonomy' => 'wavelengthcat',
            'field'    => 'term_id',
            'terms'    => $mulargs,
            'operator' => 'IN',
        );
    }else {
        $args02 = '';
    }
    if($distributor){
        $args03 = array(
            'key' => 'ff_distributor',
            'value' => '"' . $distributor . '"',
            'compare' => 'LIKE'
        );
    }else {
        $args03 = '';
    }
    $args = array(
        'post_type' => 'product',
        'paged' => $paged,
        'posts_per_page' => 12,
        'tax_query' => array(
            'relation' => 'AND',
            $args01,
            $args02,
        ),
        'meta_query' => array(
            $args03,
        ),
    );
    $argsearch = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            $args01,
            $args02,
        ),
        'meta_query' => array(
            $args03,
        ),
    );
}else if($search_type == 2){
    if($wavelength){
        if($wavelength == 'mul01' || $wavelength == 'mul02' || $wavelength == 'mul03'){
            $mulargs = array();
            if($wavelength == 'mul01'){
                $mulargs = array(416,417);
            }else if($wavelength == 'mul02'){
                $mulargs = array(428,429);
            }else if($wavelength == 'mul03') {
                $mulargs = array(455,483);
            }

            $args = array(
                'post_type' => 'product',
                'paged' => $paged,
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wavelengthcat',
                        'field'    => 'term_id',
                        'terms'    => $mulargs,
                        'operator' => 'IN',
                    ),
                ),
            );
            $argsearch = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wavelengthcat',
                        'field'    => 'term_id',
                        'terms'    => $mulargs,
                        'operator' => 'IN',
                    ),
                ),
            );
        }else {
            $args = array(
                'post_type' => 'product',
                'paged' => $paged,
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wavelengthcat',
                        'field'    => 'term_id',
                        'terms'    => array($wavelength),
                        'operator' => 'IN',
                    ),
                ),
            );
            $argsearch = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'wavelengthcat',
                        'field'    => 'term_id',
                        'terms'    => array($wavelength),
                        'operator' => 'IN',
                    ),
                ),
            );
        }
    }else {
        $args = array(
            'post_type' => 'product',
            'paged' => $paged,
            'posts_per_page' => 12,
        );
        $argsearch = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
    }
}else if($search_type == 3){
    if($output){
        $args01 = array(
            'relation' => 'OR',
            array(
                'key'     => 'ff_specifyoutput2',
                'value'   => array( $output ),
                'compare' => 'IN',
            ),
            array(
                'key'     => 'ff_specifyoutput3',
                'value'   => array( $output ),
                'compare' => 'IN',
            )
        );
    }else {
        $args01 = '';
    }

    if($w){
        $args02 = array(
            'relation' => 'OR',
            array(
                'key'     => 'ff_unit2',
                'value'   => array( $w ),
                'compare' => 'IN',
            ),
            array(
                'key'     => 'ff_unit3',
                'value'   => array( $w ),
                'compare' => 'IN',
            )
        );
    }else {
        $args02 = '';
    }

    if(count($mode)){
        $args03 = array(
            'key'     => 'ff_oscillationform2',
            'value'   => $mode,
            'compare' => 'IN',
        );
    }else {
        $args03 = '';
    }

    if(count($source)){
        $args04 = array(
            'key'     => 'ff_lightsourcetype2',
            'value'   => $source,
            'compare' => 'IN',
        );
    }else {
        $args04 = '';
    }

    if(count($nanowave)){
        $args05 = array(
            'key'     => 'nm',
            'value'   => $nanowave,
            'compare' => 'IN',
        );
    }else {
        $args05 = '';
    }

    if(count($mwat)){
        $args06 = array(
            'key'     => 'mw',
            'value'   => $mwat,
            'compare' => 'IN',
        );
    }else {
        $args06 = '';
    }

    if(count($wat)){
        $args07 = array(
            'key'     => 'w',
            'value'   => $wat,
            'compare' => 'IN',
        );
    }else {
        $args07 = '';
    }

    $args = array(
        'post_type' => 'product',
        'paged' => $paged,
        'posts_per_page' => 12,
        'meta_query' => array(
            'relation' => 'AND',
            $args01,
            $args02,
            $args03,
            $args04,
            $args05,
            $args06,
            $args07,
        ),
    );
    $argsearch = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            $args01,
            $args02,
            $args03,
            $args04,
            $args05,
            $args06,
            $args07,
        ),
    );
}else if($search_type == 4){
    if($s){
        $args = array(
            'post_type' => 'product',
            'paged' => $paged,
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'wavelengthcat',
                    'field'    => 'name',
                    'terms'    => array($s),
                ),
            ),
        );
        $argsearch = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'wavelengthcat',
                    'field'    => 'name',
                    'terms'    => array($s),
                ),
            ),
        );
    }else {
        $args = array(
            'post_type' => 'product',
            'paged' => $paged,
            'posts_per_page' => 12,
        );
        $argsearch = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
    }
}else if($s){
    $args = array(
        's' => $s,
        'post_type' => 'product',
        'paged' => $paged,
        'posts_per_page' => 12
    );
    $argsearch = array(
        's' => $s,
        'post_type' => 'product',
        'posts_per_page' => -1
    );
} ?>
<div class="product result">
    <section class="pageTitle">
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li class="en"><a href="https://eng.opt-ron.com/">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <?php
                $search_query = new WP_Query( $args );
                if ( $search_query->have_posts() ) {
            ?>
            <?php if($search_type == 3): ?>
            <div class="topBox flexB">
                <div class="sdwBox">
                    <div class="hadBox flexB">
                        <p class="headLine04"> 検索条件</p>
                        <ul class="tag">
                            <?php if($w): ?>
                            <li>出力：<?php echo $w; ?></li>
                            <?php endif; ?>
                            <?php if($mode): ?>
                            <li>発振形式：
                                <?php foreach ($mode as $value) {
                                    echo '<span>'. $value .'</span>' ;
                                } ?>
                            </li>
                            <?php endif; ?>
                            <?php if($source): ?>
                            <li>光源種類：
                                <?php foreach ($source as $value) {
                                    echo '<span>'. $value .'</span>' ;
                                } ?>
                            </li>
                            <?php endif; ?>
                            <?php if($nanowave): ?>
                            <li>波長：
                                <?php foreach ($nanowave as $value) {
                                    echo '<span>'. $value .'</span>' ;
                                } ?>
                            </li>
                            <?php endif; ?>
                            <?php if($mwat): ?>
                            <li>出力（mW）：
                                <?php foreach ($mwat as $value) {
                                    echo '<span>'. $value .'</span>' ;
                                } ?>
                            </li>
                            <?php endif; ?>
                            <?php if($wat): ?>
                            <li>出力（W）：
                                <?php foreach ($wat as $value) {
                                    echo '<span>'. $value .'</span>' ;
                                } ?>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更するaaaa</p>
                        <p class="text01">商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" class="inputText">
                                <input type="submit" value="検索" class="inputButton" onclick="paramMod(this)">
                            </form>
                        </div>
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form01">
                            <input type="hidden" name="s" value="">
                            <input type="hidden" name="search_type" value="1">
                            <ul class="comSelectUl flex">
                                <li>
                                    <p class="link"><a href="#">カテゴリーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat01" class="cat01">
                                        <a href="#" class="link01" data-id01="">選択してください</a>
                                        <?php
                                            $args = array(
                                                'taxonomy' => 'productcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php
                                            $terms = get_terms( $args );
                                            //並べ替え
                                                usort($terms, function ($a, $b) {
                                                    return $a->description - $b->description;
                                                });

                                            if($terms){
                                        ?>
                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                <?php foreach($terms as $term) { ?>
                                                <li><a href="#" data-id01="<?php echo $term->term_id; ?>"><?php echo $term->name; $bigId = $term->term_id; ?></a>
                                                    <?php
                                                        $args01 = array(
                                                            'taxonomy' => 'productcat',
                                                            // 'hide_empty' => 0,
                                                            'exclude' => '',
                                                            'parent' => $bigId,
                                                        );
                                                    ?>
                                                    <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                                    <ul class="conterUl">
                                                        <li><a href="#" data-id01="<?php echo $bigId; ?>">■ <?php echo $term->name;?>すべて</a></li>
                                                        <?php foreach($terms01 as $term01) { ?>
                                                        <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; $secondId = $term01->term_id; ?></a>
                                                            <?php
                                                                $args02 = array(
                                                                    'taxonomy' => 'productcat',
                                                                    // 'hide_empty' => 0,
                                                                    'exclude' => '',
                                                                    'parent' => $secondId,
                                                                );
                                                            ?>
                                                            <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; ?>すべて</a></li>
                                                                    <?php foreach($terms02 as $term02) { ?>
                                                                    <li><a href="#" data-id01="<?php echo $term02->term_id; ?>"><?php echo $term02->name; ?></a></li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                            <?php }?>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">メーカーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                        <?php
                                            $args03 = array(
                                                'taxonomy' => 'distributorcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                            <?php foreach($terms03 as $term03) { ?>
                                                <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01=""><?php echo $term03->name; $bigId01 = $term03->term_id; ?></a>
                                                            <?php
                                                                $args04 = array(
                                                                    'post_type' => 'distributor',
                                                                    'posts_per_page' => -1,
                                                                    'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'distributorcat',
                                                                            'field'    => 'term_id',
                                                                            'terms'    => array( $bigId01 ),
                                                                            'operator' => 'IN',
                                                                        ),
                                                                    ),
                                                                );
                                                            ?>
                                                            <?php $query = new WP_Query( $args04 ); if ( $query->have_posts() ) { ?>
                                                            <ul class="innUl">
                                                            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                                                            <li><a href="#" data-id01="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
                                                            <?php }?>
                                                            </ul>
                                                            <?php } wp_reset_postdata(); ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">光源を波長から探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat03" class="cat01">
                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox enUlBox03">
                                            <ul class="enUl03">
                                                <li><p><span>波長域から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="617">200nm~</a></li>
                                                        <li><a href="#" data-id01="612">300nm~</a></li>
                                                        <li><a href="#" data-id01="286">400nm~</a></li>
                                                        <li><a href="#" data-id01="583">500nm~</a></li>
                                                        <li><a href="#" data-id01="591">600nm~</a></li>
                                                        <li><a href="#" data-id01="287">700nm~</a></li>
                                                        <li><a href="#" data-id01="288">800nm~</a></li>
                                                        <li><a href="#" data-id01="592">900nm~</a></li>
                                                        <li><a href="#" data-id01="289">1000nm~</a></li>
                                                        <li><a href="#" data-id01="593">1500nm~</a></li>
                                                        <li><a href="#" data-id01="594">2000nm~</a></li>
                                                        <li><a href="#" data-id01="290">多波長、チューナブル</a></li>
                                                    </ul>
                                                </li>
                                                <li><p><span>良く探されている波長から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="608">532nm</a></li>
                                                        <li><a href="#" data-id01="291">808nm</a></li>
                                                        <li><a href="#" data-id01="584">850nm</a></li>
                                                        <li><a href="#" data-id01="324">940nm</a></li>
                                                        <li><a href="#" data-id01="601">976/980nm</a></li>
                                                        <li><a href="#" data-id01="610">1060/1064nm</a></li>
                                                        <li><a href="#" data-id01="293">1310/1550nm</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="comBtn"><input type="submit" value="検索"></div>
                        </form>
                    </div>
                    <div class="sdwLink">検索条件を変更する</div>
                </div>
                <h2 class="headLine05">該当製品数<span><?php echo $search_query->found_posts; ?><small>件</small></span></h2>
                <p id="output-message"></p>
            </div>
            <?php else: ?>
            <!-- フリーワード検索 -->
            <div class="topBox flexB">
                <div class="sdwBox">
                    <div class="hadBox flexB">
                        <p class="headLine04"> 検索条件</p>
                        <ul class="tag">
                            <!-- 製品カテゴリ検索 -->
                            <?php if($product){ $productitem = get_term_by('id',$product,'productcat'); ?><li style="border-color: #0fd000;"><?php echo $productitem->name; ?></li><?php } ?>
                            <!-- 投稿者検索 -->
                            <?php if($distributor){ ?><li style="border-color: #0fd000;"><?php $title = get_post($distributor)->post_title; echo $title; ?></li><?php } ?>
                            <!-- 波長検索 -->
                            <?php if($wavelength){ ?>
                            <?php if($wavelength == 'mul01'){ ?>
                            <li class="rainbow"><p class="in">976/980nm</p></li>
                            <?php }else if($wavelength == 'mul02'){ ?>
                            <li class="rainbow"><p class="in">1060/1064nm</p></li>
                            <?php }else if($wavelength == 'mul03'){ ?>
                            <li class="rainbow"><p class="in">1310/1550nm</p></li>
                            <?php }else { ?>
                            <?php $wavelengthitem = get_term_by('id',$wavelength,'wavelengthcat'); ?><li class="rainbow"><p class="in"><?php echo $wavelengthitem->name; ?></p></li>
                            <?php } } ?>
                            <!-- フリーワード検索 -->
                            <?php if($s){ ?>
                                <li style="border-color: #0fd000;"><?php echo $s; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更する</p>
                        <p class="text01">商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" class="inputText">
                                <input type="submit" value="検索" class="inputButton" onclick="paramMod(this)">
                            </form>
                        </div>
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form01">
                            <input type="hidden" name="s" value="">
                            <input type="hidden" name="search_type" value="1">
                            <ul class="comSelectUl flex">
                                <li>
                                    <p class="link"><a href="#">カテゴリーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat01" class="cat01">
                                        <a href="#" class="link01" data-id01="">選択してください</a>
                                        <?php
                                            $args = array(
                                                'taxonomy' => 'productcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php
                                            $terms = get_terms( $args );
                                            //並べ替え
                                                usort($terms, function ($a, $b) {
                                                    return $a->description - $b->description;
                                                });

                                            if($terms){
                                        ?>
                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                <?php foreach($terms as $term) { ?>
                                                <li><a href="#" data-id01="<?php echo $term->term_id; ?>"><?php echo $term->name; $bigId = $term->term_id; ?></a>
                                                    <?php
                                                        $args01 = array(
                                                            'taxonomy' => 'productcat',
                                                            // 'hide_empty' => 0,
                                                            'exclude' => '',
                                                            'parent' => $bigId,
                                                        );
                                                    ?>
                                                    <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                                    <ul class="conterUl">
                                                        <li><a href="#" data-id01="<?php echo $bigId; ?>">■ <?php echo $term->name;?>すべて</a></li>
                                                        <?php foreach($terms01 as $term01) { ?>
                                                        <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; $secondId = $term01->term_id; ?></a>
                                                            <?php
                                                                $args02 = array(
                                                                    'taxonomy' => 'productcat',
                                                                    // 'hide_empty' => 0,
                                                                    'exclude' => '',
                                                                    'parent' => $secondId,
                                                                );
                                                            ?>
                                                            <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; ?>すべて</a></li>
                                                                    <?php foreach($terms02 as $term02) { ?>
                                                                    <li><a href="#" data-id01="<?php echo $term02->term_id; ?>"><?php echo $term02->name; ?></a></li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                            <?php }?>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">メーカーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                        <?php
                                            $args03 = array(
                                                'taxonomy' => 'distributorcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                            <?php foreach($terms03 as $term03) { ?>
                                                <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01=""><?php echo $term03->name; $bigId01 = $term03->term_id; ?></a>
                                                            <?php
                                                                $args04 = array(
                                                                    'post_type' => 'distributor',
                                                                    'posts_per_page' => -1,
                                                                    'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'distributorcat',
                                                                            'field'    => 'term_id',
                                                                            'terms'    => array( $bigId01 ),
                                                                            'operator' => 'IN',
                                                                        ),
                                                                    ),
                                                                );
                                                            ?>
                                                            <?php $query = new WP_Query( $args04 ); if ( $query->have_posts() ) { ?>
                                                            <ul class="innUl">
                                                            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                                                            <li><a href="#" data-id01="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
                                                            <?php }?>
                                                            </ul>
                                                            <?php } wp_reset_postdata(); ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>


                                </li>
                                <li>
                                    <p class="link"><a href="#">光源を波長から探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat03" class="cat01">
                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox enUlBox03">
                                            <ul class="enUl03">
                                                <li><p><span>波長域から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="617">200nm~</a></li>
                                                        <li><a href="#" data-id01="612">300nm~</a></li>
                                                        <li><a href="#" data-id01="286">400nm~</a></li>
                                                        <li><a href="#" data-id01="583">500nm~</a></li>
                                                        <li><a href="#" data-id01="591">600nm~</a></li>
                                                        <li><a href="#" data-id01="287">700nm~</a></li>
                                                        <li><a href="#" data-id01="288">800nm~</a></li>
                                                        <li><a href="#" data-id01="592">900nm~</a></li>
                                                        <li><a href="#" data-id01="289">1000nm~</a></li>
                                                        <li><a href="#" data-id01="593">1500nm~</a></li>
                                                        <li><a href="#" data-id01="594">2000nm~</a></li>
                                                        <li><a href="#" data-id01="290">多波長、チューナブル</a></li>
                                                    </ul>
                                                </li>
                                                <li><p><span>良く探されている波長から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="608">532nm</a></li>
                                                        <li><a href="#" data-id01="291">808nm</a></li>
                                                        <li><a href="#" data-id01="584">850nm</a></li>
                                                        <li><a href="#" data-id01="324">940nm</a></li>
                                                        <li><a href="#" data-id01="601">976/980nm</a></li>
                                                        <li><a href="#" data-id01="610">1060/1064nm</a></li>
                                                        <li><a href="#" data-id01="293">1310/1550nm</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="comBtn"><input type="submit" value="検索"></div>
                        </form>
                    </div>
                    <div class="sdwLink">検索条件を変更する</div>
                </div>
                <h2 class="headLine05">該当製品数<span><?php echo $search_query->found_posts; ?><small>件</small></span></h2>
                <p id="output-message"></p>
            </div>
            <?php endif; ?>
            <ul class="comItemList flex">
                <?php while ( $search_query->have_posts() ) { $search_query->the_post(); ?>
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
                        <div class="comItemList-detail">
                            <?php
                            $featured_posts = get_field('ff_distributor');
                            if( $featured_posts ): foreach( $featured_posts as $featured_post ): $title = get_the_title( $featured_post->ID ); ?>
                            <p class="ttl">
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
                            </p>
                            <?php endforeach;  endif; ?>
                            <div class="txt">
                                <?php the_field("ff_excerpt"); ?>
                            </div>
                            <?php
                                $taxonomy = 'productcat';
                                $terms01 = get_the_terms($post->ID,$taxonomy);
                                $terms02 = get_ordered_terms($post->ID,'description', 'ASC', 'wavelengthcat');
                                $ancestor_maxnum = 1;
                                $ff_wavelengthlabel = get_field('ff_wavelengthlabel');
                            ?>
                            <ul class="tag">
                                <?php if($terms01): ?>
                                <?php foreach($terms01 as $term01){ ?>
                                <?php
                                    $dep = count(get_ancestors($term01->term_id, $taxonomy));
                                ?>
                                <li <?php if($dep < $ancestor_maxnum): ?>style="border-color: #0b7ef1;"<?php elseif($dep > $ancestor_maxnum): ?>style="border-color: #f20000;"<?php else: ?>style="border-color: #0fd000;"<?php endif; ?>><?php echo $term01->name; ?></li>
                                <?php } ?>
                                <?php endif; ?>
                                <?php if($terms02): ?>
                                <?php if($ff_wavelengthlabel): ?>
                                <li class="rainbow"><p class="in"><?php echo $ff_wavelengthlabel; ?></p></li>
                                <?php elseif (is_object_in_term($post->ID, 'wavelengthcat','multi-wavelength')): ?>
                                <li class="rainbow"><p class="in">多波長、チューナブル</p></li>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><p class="in"><?php echo $term02->name; ?></p></li><?php } ?>
                                <?php } ?>
                                <?php else: ?>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><p class="in"><?php echo $term02->name; ?></p></li><?php } ?>
                                <?php } ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <div class="topBox flexB">
                <div class="sdwBox">
                    <div class="hadBox flexB">
                        <p class="headLine04"> 検索条件</p>
                        <ul class="tag">
                            <!-- 製品カテゴリ検索 -->
                            <?php if($product){ $productitem = get_term_by('id',$product,'productcat'); ?><li style="border-color: #0fd000;"><?php echo $productitem->name; ?></li><?php } ?>
                            <!-- 投稿者検索 -->
                            <?php if($distributor){ ?><li style="border-color: #0fd000;"><?php $title = get_post($distributor)->post_title; echo $title; ?></li><?php } ?>
                            <!-- 波長検索 -->
                            <?php if($wavelength){ ?>
                            <?php if($wavelength == 'mul01'){ ?>
                            <li class="rainbow"><p class="in">976/980nm</p></li>
                            <?php }else if($wavelength == 'mul02'){ ?>
                            <li class="rainbow"><p class="in">1060/1064nm</p></li>
                            <?php }else if($wavelength == 'mul03'){ ?>
                            <li class="rainbow"><p class="in">1310/1550nm</p></li>
                            <?php }else { ?>
                            <?php $wavelengthitem = get_term_by('id',$wavelength,'wavelengthcat'); ?><li class="rainbow"><p class="in"><?php echo $wavelengthitem->name; ?></p></li>
                            <?php } } ?>
                            <!-- フリーワード検索 -->
                            <?php if($s){ ?>
                                <li style="border-color: #0fd000;"><?php echo $s; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更する</p>
                        <p class="text01">商品名・型番・メーカーまたはキーワードを入力（全角）</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" class="inputText">
                                <input type="submit" value="検索" class="inputButton" onclick="paramMod(this)">
                            </form>
                        </div>
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form01">
                            <input type="hidden" name="s" value="">
                            <input type="hidden" name="search_type" value="1">
                            <ul class="comSelectUl flex">
                                <li>
                                    <p class="link"><a href="#">カテゴリーで探す</a></p>


                                    <div class="iptBox">
                                        <input type="hidden" name="cat01" class="cat01">
                                        <a href="#" class="link01" data-id01="">選択してください</a>
                                        <?php
                                            $args = array(
                                                'taxonomy' => 'productcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php
                                            $terms = get_terms( $args );
                                            //並べ替え
                                                usort($terms, function ($a, $b) {
                                                    return $a->description - $b->description;
                                                });

                                            if($terms){
                                        ?>
                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                <?php foreach($terms as $term) { ?>
                                                <li><a href="#" data-id01="<?php echo $term->term_id; ?>"><?php echo $term->name; $bigId = $term->term_id; ?></a>
                                                    <?php
                                                        $args01 = array(
                                                            'taxonomy' => 'productcat',
                                                            // 'hide_empty' => 0,
                                                            'exclude' => '',
                                                            'parent' => $bigId,
                                                        );
                                                    ?>
                                                    <?php $terms01 = get_terms( $args01 ); if($terms01){ ?>
                                                    <ul class="conterUl">
                                                        <li><a href="#" data-id01="<?php echo $bigId; ?>">■ <?php echo $term->name;?>すべて</a></li>
                                                        <?php foreach($terms01 as $term01) { ?>
                                                        <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; $secondId = $term01->term_id; ?></a>
                                                            <?php
                                                                $args02 = array(
                                                                    'taxonomy' => 'productcat',
                                                                    // 'hide_empty' => 0,
                                                                    'exclude' => '',
                                                                    'parent' => $secondId,
                                                                );
                                                            ?>
                                                            <?php $terms02 = get_terms( $args02 ); if($terms02){ ?>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="<?php echo $term01->term_id; ?>"><?php echo $term01->name; ?>すべて</a></li>
                                                                    <?php foreach($terms02 as $term02) { ?>
                                                                    <li><a href="#" data-id01="<?php echo $term02->term_id; ?>"><?php echo $term02->name; ?></a></li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                            <?php }?>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                    <?php }?>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>






                                </li>
                            <li>
                                <p class="link"><a href="#">メーカーで探す</a></p>

                                <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                        <?php
                                            $args03 = array(
                                                'taxonomy' => 'distributorcat',
                                                // 'hide_empty' => 0,
                                                'exclude' => '',
                                                'parent' => 0,
                                            );
                                        ?>
                                        <?php $terms03 = get_terms( $args03 ); if($terms03){ ?>
                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                            <?php foreach($terms03 as $term03) { ?>
                                                <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01=""><?php echo $term03->name; $bigId01 = $term03->term_id; ?></a>
                                                            <?php
                                                                $args04 = array(
                                                                    'post_type' => 'distributor',
                                                                    'posts_per_page' => -1,
                                                                    'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'distributorcat',
                                                                            'field'    => 'term_id',
                                                                            'terms'    => array( $bigId01 ),
                                                                            'operator' => 'IN',
                                                                        ),
                                                                    ),
                                                                );
                                                            ?>
                                                            <?php $query = new WP_Query( $args04 ); if ( $query->have_posts() ) { ?>
                                                            <ul class="innUl">
                                                            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                                                            <li><a href="#" data-id01="<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
                                                            <?php }?>
                                                            </ul>
                                                            <?php } wp_reset_postdata(); ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php }?>
                                            </ul>
                                        </div>
                                        <?php }?>
                                    </div>


                            </li>
                            <li>
                                <p class="link"><a href="#">光源を波長から探す</a></p>
                                <div class="iptBox">
                                    <input type="hidden" name="cat03" class="cat01">
                                    <a href="#" class="link01">選択してください</a>
                                    <div class="enUlBox enUlBox03">
                                        <ul class="enUl03">
                                            <li><p><span>波長域から探す</span></p>
                                                <ul class="flex">
                                                    <li><a href="#" data-id01="617">200nm~</a></li>
                                                    <li><a href="#" data-id01="612">300nm~</a></li>
                                                    <li><a href="#" data-id01="286">400nm~</a></li>
                                                    <li><a href="#" data-id01="583">500nm~</a></li>
                                                    <li><a href="#" data-id01="591">600nm~</a></li>
                                                    <li><a href="#" data-id01="287">700nm~</a></li>
                                                    <li><a href="#" data-id01="288">800nm~</a></li>
                                                    <li><a href="#" data-id01="592">900nm~</a></li>
                                                    <li><a href="#" data-id01="289">1000nm~</a></li>
                                                    <li><a href="#" data-id01="593">1500nm~</a></li>
                                                    <li><a href="#" data-id01="594">2000nm~</a></li>
                                                    <li><a href="#" data-id01="290">多波長、チューナブル</a></li>
                                                </ul>
                                            </li>
                                            <li><p><span>良く探されている波長から探す</span></p>
                                                <ul class="flex">
                                                    <li><a href="#" data-id01="608">532nm</a></li>
                                                    <li><a href="#" data-id01="291">808nm</a></li>
                                                    <li><a href="#" data-id01="584">850nm</a></li>
                                                    <li><a href="#" data-id01="324">940nm</a></li>
                                                    <li><a href="#" data-id01="601">976/980nm</a></li>
                                                    <li><a href="#" data-id01="610">1060/1064nm</a></li>
                                                    <li><a href="#" data-id01="293">1310/1550nm</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="comBtn"><input type="submit" value="検索"></div>
                        </form>
                    </div>
                <div class="sdwLink">検索条件を変更する</div>
                </div>
                <h2 class="headLine05">該当製品数<span><?php echo $search_query->found_posts; ?><small>件</small></span></h2>
                <p id="output-message"></p>
            </div>
            <div class="thanks">
            <p class="ttl">申し訳ありません。<br>入力した条件では製品が見つかりませんでした。</p>
            <p>条件を変更し検索を行うか、トップページよりご希望のページをお探しください。</p>

            <div class="comBtn"><a href="<?php bloginfo('url');?>">TOPページに戻る</a></div>
            </div>
            <?php } wp_reset_postdata(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array(
                'query' => $search_query,
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
    <li>検索結果</li>
</ul>
<?php get_footer(); ?>
