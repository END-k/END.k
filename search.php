<?php get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$search_type = $_GET['search_type'] ? $_GET['search_type'] : '';
$product = $_GET['cat01'] ? $_GET['cat01'] : '';
$distributor = $_GET['cat02'] ? $_GET['cat02'] : '';
$wavelength = $_GET['cat03'] ? $_GET['cat03'] : '';
$s = $_GET['s'] ? $_GET['s'] : '';
$w = $_GET['w'] ? $_GET['w'] : '';
$output = $_GET['output'] ? $_GET['output'] : '';
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
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更する</p>
                        <p class="sp text01">商品名・型番・メーカーまたはキーワードを入力</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" placeholder="商品名・型番・メーカーまたはキーワードを入力" class="inputText">
                                <input type="submit" value="検索" class="inputButton">
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
                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                <li>
                                                    <a href="#" data-id01="2">自社製品(設計・試作・OEM)</a>
                                                    <ul class="conterUl">
                                                        <li>
                                                            <a href="#" data-id01="2">■すべて</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id01="3">光ファイバ</a>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="3">光ファイバすべて</a></li>
                                                                    <li><a href="#" data-id01="4">シングルモードファイバパッチコード(SM)</a></li>
                                                                    <li><a href="#" data-id01="5">マルチモードファイバパッチコード(MM)</a></li>
                                                                    <li><a href="#" data-id01="6">偏波保持ファイバパッチコード(PM、パンダ)</a></li>
                                                                    <li><a href="#" data-id01="7">プラスチックファイバパッチコード(POF)</a></li>
                                                                    <li><a href="#" data-id01="8">分岐ファイバ</a></li>
                                                                    <li><a href="#" data-id01="9">バンドルファイバ</a></li>
                                                                    <li><a href="#" data-id01="10">ファイバアレイ</a></li>
                                                                    <li><a href="#" data-id01="11">コネクタ・アダプタ各種</a></li>
                                                                    <li><a href="#" data-id01="12">ファイバ補強スリーブ</a></li>
                                                                    <li><a href="#" data-id01="13">ファイバ保護チューブ</a></li>
                                                                    <li><a href="#" data-id01="14">フェルール</a></li>
                                                                    <li><a href="#" data-id01="15">真空フィードスルー</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id01="17">コリメータ</a>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="17">コリメータすべて</a></li>
                                                                    <li><a href="#" data-id01="18">コリメータ</a></li>
                                                                    <li><a href="#" data-id01="19">ファイバ一体型コリメータ</a></li>
                                                                    <li><a href="#" data-id01="20">FCレセプタクルコリメータ</a></li>
                                                                    <li><a href="#" data-id01="21">長距離用コリメータ</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id01="22">レーザーポインタ</a>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="22">レーザーポインタすべて</a></li>
                                                                    <li><a href="#" data-id01="23">レーザーポインタ</a></li>
                                                                    <li><a href="#" data-id01="24">真円レーザーポインタ</a></li>
                                                                    <li><a href="#" data-id01="25">ラインレーザーポインタ</a></li>
                                                                    <li><a href="#" data-id01="26">出力調整コントローラ</a></li>
                                                                    <li><a href="#" data-id01="27">パワーサプライ(専用電源)</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-id01="29">光源装置</a>
                                                            <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="29">光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="30">LD光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="31">LED光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="32">VCSEL光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="33">小型光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="34">2波長合成光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="36">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="37">LD・PDモジュール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="37">LD・PDモジュールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="38">シングルモードファイバLDピグテイル</a></li>
                                                                                                                                <li><a href="#" data-id01="41">LDピグテイルドライバ付き光源装置</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="45">LDドライバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="45">LDドライバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="46">APC駆動 LDドライバ</a></li>
                                                                                                                                <li><a href="#" data-id01="47">ACC駆動 LDドライバ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="48">オプティクス</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="48">オプティクスすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="49">合成石英レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="50">反射型可視光NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="51">反射型紫外用NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="52">光学用ミラー</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="65">光ファイバ・ファイバコンポーネント</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="65">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="66">光ファイバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="66">光ファイバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="67">シングルモードファイバ・パッチコード(SM)</a></li>
                                                                                                                                <li><a href="#" data-id01="68">マルチモードファイバ ・パッチコード(MM)</a></li>
                                                                                                                                <li><a href="#" data-id01="69">偏波保持ファイバ・パッチコード(PM、パンダ)</a></li>
                                                                                                                                <li><a href="#" data-id01="70">フォトニック結晶ファイバ(PCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="71">特殊ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="72">中空ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="73">分散補償ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="75">ダブルクラッドファイバ(DCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="76">中赤外用ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="108">プラスチックファイバ パッチコード(POF)</a></li>
                                                                                                                                <li><a href="#" data-id01="77">高非線形ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="78">校正ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="79">耐熱・耐環境</a></li>
                                                                                                                                <li><a href="#" data-id01="109">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="80">ファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="80">ファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="81">光スイッチ</a></li>
                                                                                                                                <li><a href="#" data-id01="83">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="85">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="86">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="87">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="88">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="90">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="93">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="94">PMファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="94">PMファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="97">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="99">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="100">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="101">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="102">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="104">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="106">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="110">光源</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="110">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="112">CW</a></li>
                                                                                                                                <li><a href="#" data-id01="113">パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="114">超短パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="115">ファイバーアンプ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="117">半導体レーザ・VCSEL</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="117">半導体レーザ・VCSELすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="118">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="119">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="120">VCSEL</a></li>
                                                                                                                                <li><a href="#" data-id01="121">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="122">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="123">ベアチップ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="125">LED・SLD・SOA</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="125">LED・SLD・SOAすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="126">UV-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="127">IR-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="128">RC-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="129">SLD・SLED</a></li>
                                                                                                                                <li><a href="#" data-id01="130">SOA・ゲインチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="131">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="132">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="133">ベアチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="134">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="135">LD・LED光源装置</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="135">LD・LED光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="136">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="137">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="139">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="141">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="143">固体レーザ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="143">固体レーザすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="144">CW(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="145">パルス(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="148">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="151">広帯域・その他光源</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="151">広帯域・その他光源すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="152">ASE</a></li>
                                                                                                                                <li><a href="#" data-id01="154">スーパーコンティニュアム</a></li>
                                                                                                                                <li><a href="#" data-id01="155">RGB・多波長</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="157">光変調器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="157">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="158">音響光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="159">電気光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="160">ドライバ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="162">光学部品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="162">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="163">光学結晶</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="163">光学結晶すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="164">非線形結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="165">レーザ結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="166">PPLN</a></li>
                                                                                                                                <li><a href="#" data-id01="167">接合結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="168">電気光学結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="171">シンチレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="172">光学結晶アクセサリ</a></li>
                                                                                                                                <li><a href="#" data-id01="173">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="174">光学部品</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="174">光学部品すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="175">フィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="176">ミラー</a></li>
                                                                                                                                <li><a href="#" data-id01="177">コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="178">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="181">過飽和吸収体</a></li>
                                                                                                                                <li><a href="#" data-id01="182">エタロン</a></li>
                                                                                                                                <li><a href="#" data-id01="183">レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="184">マイクロ-レンズ/オプティクス</a></li>
                                                                                                                                <li><a href="#" data-id01="186">スプリッタ</a></li>
                                                                                                                                <li><a href="#" data-id01="188">光学窓</a></li>
                                                                                                                                <li><a href="#" data-id01="189">偏光子</a></li>
                                                                                                                                <li><a href="#" data-id01="190">テラヘルツ</a></li>
                                                                                                                                <li><a href="#" data-id01="191">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="192">メカニカルコンポーネンツ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="192">メカニカルコンポーネンツすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="193">光学マウント</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="197">エレクトロニクス</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="197">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="198">電流アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="199">電圧アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="200">ロックインアンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="201">LDドライバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="202">温度コントローラ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="203">LD関係アクセサリ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="205">測定器・検出器・試験機</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="205">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="611">光通信用測定器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="207">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="208">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="209">パワーメータ・ロステスタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="210">光可変アッテネータ (VOA)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="211">波長可変光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="212">光チューナブルフィルタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="213">ラボ・製造用 多機能プラットフォーム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="214">イーサネット試験機</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="215">OTDR</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="216">光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="217">MPO関連</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="218">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="219">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="251">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="252">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="221">フォトレシーバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="222">パワーメータ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="223">IRビューア</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="224">放射計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="225">分光器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="227">ゴレイセル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="253">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="254">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="230">Si (200~1100nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="231">GaAs (600~900nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="232">InGaAs (800~2600nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="233">Ge (800~1800nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="234">APD</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="236">TIA</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="237">アレイ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="238">UV, X線 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="239">1060nm 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="241">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="242">光学材料・消耗品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="242">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="244">IRセンサカード</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="245">色素</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="246">ホログラム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="247">保護メガネ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="248">保護フィルム</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="255">光学機器・光学解析ソフトウェア</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="255">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="256">光学解析ソフトウェア</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="259">自動認識関連機器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="259">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="260">CCDハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="261">レーザハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="262">ハンディイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="263">定置・組込型CCDスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="264">定置・組込型レーザスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="265">定置・組込型2Dイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="267">データコレクタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="268">ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="270">RFID HF帯 リーダライタモジュール</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="271">RFID HF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="273">RFID UHF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="274">RFID ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="275">RFID 応用製品</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="276">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="277">光通信</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="277">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="278">光通信フィールド用ツール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="278">光通信フィールド用ツールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="279">オプティカルツール</a></li>
                                                                                                                                <li><a href="#" data-id01="280">光ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="283">測定機</a></li>
                                                                                                                                <li><a href="#" data-id01="284">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                    </ul>
                                        </div>
                                                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">メーカーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                                                                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">国内</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="236">株式会社ファーストメカニカルデザイン</a></li>
                                                                                                                <li><a href="#" data-id01="233">導光技術</a></li>
                                                                                                                <li><a href="#" data-id01="225">株式会社オプトゲート</a></li>
                                                                                                                <li><a href="#" data-id01="197">DOWAエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="172">富士通株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="170">山本光学株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="167">珠電子株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="158">株式会社オプトロンサイエンス</a></li>
                                                                                                                <li><a href="#" data-id01="148">旭化成株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="146">アイメックス</a></li>
                                                                                                                <li><a href="#" data-id01="145">株式会社オプトエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="144">ジーエルソリューションズ</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">A</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="198">ao smart</a></li>
                                                                                                                <li><a href="#" data-id01="187">Arroyo Instruments</a></li>
                                                                                                                <li><a href="#" data-id01="180">advanced fiber tools</a></li>
                                                                                                                <li><a href="#" data-id01="179">Ampliconyx</a></li>
                                                                                                                <li><a href="#" data-id01="147">art photonics</a></li>
                                                                                                                <li><a href="#" data-id01="54">Andover</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">B</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="230">Brolis Semiconductors</a></li>
                                                                                                                <li><a href="#" data-id01="229">Bergmann Messgeräte Entwicklung</a></li>
                                                                                                                <li><a href="#" data-id01="228">BATOP optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="188">Bellin Laser</a></li>
                                                                                                                <li><a href="#" data-id01="173">Brightlaser</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">C</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="231">CASTECH</a></li>
                                                                                                                <li><a href="#" data-id01="182">CRYSLASER</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">D</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="232">DenseLight Semiconductors POET company</a></li>
                                                                                                                <li><a href="#" data-id01="189">DIRECTED LIGHT INC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">E</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="234">Exciton</a></li>
                                                                                                                <li><a href="#" data-id01="190">ETU-Link Technology</a></li>
                                                                                                                <li><a href="#" data-id01="150">EXFO Inc.</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">F</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="238">FORC Photonics</a></li>
                                                                                                                <li><a href="#" data-id01="235">Femto Messtechnik GmbH</a></li>
                                                                                                                <li><a href="#" data-id01="223">FinishAdapt</a></li>
                                                                                                                <li><a href="#" data-id01="202">fiberware</a></li>
                                                                                                                <li><a href="#" data-id01="199">FJW Optical Systems, Inc.</a></li>
                                                                                                                <li><a href="#" data-id01="171">Focuslight</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">G</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="241">GEOLA</a></li>
                                                                                                                <li><a href="#" data-id01="239">GPD Optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="222">Gigahertz-Optik</a></li>
                                                                                                                <li><a href="#" data-id01="175">Gentec-eo</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">H</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="240">HC Photonics (HCP)</a></li>
                                                                                                                <li><a href="#" data-id01="193">HiLight Semiconductor</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">I</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="153">ISOMET</a></li>
                                                                                                                <li><a href="#" data-id01="152">Inrad Optics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">J</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="206">JOINWIT</a></li>
                                                                                                                <li><a href="#" data-id01="205">JPT Opto-electronics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">L</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="209">LIMO</a></li>
                                                                                                                <li><a href="#" data-id01="201">laservision USA, LP</a></li>
                                                                                                                <li><a href="#" data-id01="200">Liverage Technology</a></li>
                                                                                                                <li><a href="#" data-id01="195">Lightwaves2020</a></li>
                                                                                                                <li><a href="#" data-id01="163">Layertec</a></li>
                                                                                                                <li><a href="#" data-id01="155">LightMachinery</a></li>
                                                                                                                <li><a href="#" data-id01="154">Leysop</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">M</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="203">MOORI Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">N</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="196">NPL</a></li>
                                                                                                                <li><a href="#" data-id01="181">NOVAE</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">O</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="208">OptoChip Photonics Ltd.</a></li>
                                                                                                                <li><a href="#" data-id01="160">OSI optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="159">Optowell</a></li>
                                                                                                                <li><a href="#" data-id01="157">Opneti</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">P</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="221">Photon Wave</a></li>
                                                                                                                <li><a href="#" data-id01="204">PicoLAS</a></li>
                                                                                                                <li><a href="#" data-id01="186">PowerPhotonic</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Q</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="178">QPhotonics</a></li>
                                                                                                                <li><a href="#" data-id01="161">Qubig GmbH</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">R</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="177">RUIK</a></li>
                                                                                                                <li><a href="#" data-id01="165">RPMC (LDX)</a></li>
                                                                                                                <li><a href="#" data-id01="162">Radiant Dyes Laser &amp; Accessories</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">S</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="227">Sheaumann Laser (Axcel photonics)</a></li>
                                                                                                                <li><a href="#" data-id01="194">SJ SYSTEM</a></li>
                                                                                                                <li><a href="#" data-id01="192">Siny optic-com co.,LTD</a></li>
                                                                                                                <li><a href="#" data-id01="184">Shanghai Dream Lasers Technology</a></li>
                                                                                                                <li><a href="#" data-id01="176">Schäfter + Kirchhoff</a></li>
                                                                                                                <li><a href="#" data-id01="166">SemiNex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">T</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="210">The fibers</a></li>
                                                                                                                <li><a href="#" data-id01="168">Tydex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">U</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="174">Union Optronics (UOC)</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">W</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="224">Wuhan Eternal Technologies</a></li>
                                                                                                                <li><a href="#" data-id01="169">Wavelength Electronics</a></li>
                                                                                                                <li><a href="#" data-id01="156">Wuhan Amazelink Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">X</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="191">Xinghan Laser Technology</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Y</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="183">YOFC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                </ul>
                                        </div>
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
                                                        <li><a href="#" data-id01="290">多波長チューナブル~</a></li>
                                                    </ul>
                                                </li>
                                                <li><p><span>良く探されている波長から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="608">532nm</a></li>
                                                        <li><a href="#" data-id01="291">808nm</a></li>
                                                        <li><a href="#" data-id01="584">850nm</a></li>
                                                        <li><a href="#" data-id01="324">940nm</a></li>
                                                        <li><a href="#" data-id01="mul01">976/980nm</a></li>
                                                        <li><a href="#" data-id01="mul02">1060/1064nm</a></li>
                                                        <li><a href="#" data-id01="mul03">1310/1550nm</a></li>
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
            </div>
            <?php else: ?>
            <div class="topBox flexB">
                <div class="sdwBox">
                    <div class="hadBox flexB">
                        <p class="headLine04"> 検索条件</p>
                        <ul class="tag">
                            <?php if($product){ $productitem = get_term_by('id',$product,'productcat'); ?><li style="border-color: #0fd000;"><?php echo $productitem->name; ?></li><?php } ?>
                            <?php if($distributor){ ?><li style="border-color: #0fd000;"><?php $title = get_post($distributor)->post_title; echo $title; ?></li><?php } ?>
                            <?php if($wavelength){ ?>
                            <?php if($wavelength == 'mul01'){ ?>
                            <li class="rainbow"><p>976/980nm</p></li>
                            <?php }else if($wavelength == 'mul02'){ ?>
                            <li class="rainbow"><span>1060/1064nm</span></li>
                            <?php }else if($wavelength == 'mul03'){ ?>
                            <li class="rainbow"><span>1310/1550nm</span></li>
                            <?php }else { ?>
                            <?php $wavelengthitem = get_term_by('id',$wavelength,'wavelengthcat'); ?><li class="rainbow"><p class="in"><?php echo $wavelengthitem->name; ?></p></li>
                            <?php } } ?>
                            <?php if($s){ ?><li style="border-color: #0fd000;"><?php echo $s; ?></li><?php } ?>
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更する</p>
                        <p class="sp text01">商品名・型番・メーカーまたはキーワードを入力</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" placeholder="商品名・型番・メーカーまたはキーワードを入力" class="inputText">
                                <input type="submit" value="検索" class="inputButton">
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
                                                                                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                                                        <li><a href="#" data-id01="2">自社製品(設計・試作・OEM)</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="2">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="3">光ファイバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="3">光ファイバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="4">シングルモードファイバパッチコード(SM)</a></li>
                                                                                                                                <li><a href="#" data-id01="5">マルチモードファイバパッチコード(MM)</a></li>
                                                                                                                                <li><a href="#" data-id01="6">偏波保持ファイバパッチコード(PM、パンダ)</a></li>
                                                                                                                                <li><a href="#" data-id01="7">プラスチックファイバパッチコード(POF)</a></li>
                                                                                                                                <li><a href="#" data-id01="8">分岐ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="9">バンドルファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="10">ファイバアレイ</a></li>
                                                                                                                                <li><a href="#" data-id01="11">コネクタ・アダプタ各種</a></li>
                                                                                                                                <li><a href="#" data-id01="12">ファイバ補強スリーブ</a></li>
                                                                                                                                <li><a href="#" data-id01="13">ファイバ保護チューブ</a></li>
                                                                                                                                <li><a href="#" data-id01="14">フェルール</a></li>
                                                                                                                                <li><a href="#" data-id01="15">真空フィードスルー</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="17">コリメータ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="17">コリメータすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="18">コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="19">ファイバ一体型コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="20">FCレセプタクルコリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="21">長距離用コリメータ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="22">レーザーポインタ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="22">レーザーポインタすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="23">レーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="24">真円レーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="25">ラインレーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="26">出力調整コントローラ</a></li>
                                                                                                                                <li><a href="#" data-id01="27">パワーサプライ(専用電源)</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="29">光源装置</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="29">光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="30">LD光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="31">LED光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="32">VCSEL光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="33">小型光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="34">2波長合成光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="36">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="37">LD・PDモジュール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="37">LD・PDモジュールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="38">シングルモードファイバLDピグテイル</a></li>
                                                                                                                                <li><a href="#" data-id01="41">LDピグテイルドライバ付き光源装置</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="45">LDドライバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="45">LDドライバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="46">APC駆動 LDドライバ</a></li>
                                                                                                                                <li><a href="#" data-id01="47">ACC駆動 LDドライバ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="48">オプティクス</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="48">オプティクスすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="49">合成石英レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="50">反射型可視光NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="51">反射型紫外用NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="52">光学用ミラー</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="65">光ファイバ・ファイバコンポーネント</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="65">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="66">光ファイバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="66">光ファイバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="67">シングルモードファイバ・パッチコード(SM)</a></li>
                                                                                                                                <li><a href="#" data-id01="68">マルチモードファイバ ・パッチコード(MM)</a></li>
                                                                                                                                <li><a href="#" data-id01="69">偏波保持ファイバ・パッチコード(PM、パンダ)</a></li>
                                                                                                                                <li><a href="#" data-id01="70">フォトニック結晶ファイバ(PCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="71">特殊ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="72">中空ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="73">分散補償ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="75">ダブルクラッドファイバ(DCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="76">中赤外用ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="108">プラスチックファイバ パッチコード(POF)</a></li>
                                                                                                                                <li><a href="#" data-id01="77">高非線形ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="78">校正ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="79">耐熱・耐環境</a></li>
                                                                                                                                <li><a href="#" data-id01="109">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="80">ファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="80">ファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="81">光スイッチ</a></li>
                                                                                                                                <li><a href="#" data-id01="83">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="85">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="86">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="87">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="88">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="90">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="93">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="94">PMファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="94">PMファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="97">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="99">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="100">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="101">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="102">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="104">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="106">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="110">光源</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="110">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="112">CW</a></li>
                                                                                                                                <li><a href="#" data-id01="113">パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="114">超短パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="115">ファイバーアンプ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="117">半導体レーザ・VCSEL</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="117">半導体レーザ・VCSELすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="118">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="119">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="120">VCSEL</a></li>
                                                                                                                                <li><a href="#" data-id01="121">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="122">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="123">ベアチップ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="125">LED・SLD・SOA</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="125">LED・SLD・SOAすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="126">UV-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="127">IR-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="128">RC-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="129">SLD・SLED</a></li>
                                                                                                                                <li><a href="#" data-id01="130">SOA・ゲインチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="131">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="132">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="133">ベアチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="134">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="135">LD・LED光源装置</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="135">LD・LED光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="136">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="137">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="139">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="141">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="143">固体レーザ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="143">固体レーザすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="144">CW(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="145">パルス(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="148">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="151">広帯域・その他光源</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="151">広帯域・その他光源すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="152">ASE</a></li>
                                                                                                                                <li><a href="#" data-id01="154">スーパーコンティニュアム</a></li>
                                                                                                                                <li><a href="#" data-id01="155">RGB・多波長</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="157">光変調器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="157">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="158">音響光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="159">電気光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="160">ドライバ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="162">光学部品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="162">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="163">光学結晶</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="163">光学結晶すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="164">非線形結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="165">レーザ結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="166">PPLN</a></li>
                                                                                                                                <li><a href="#" data-id01="167">接合結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="168">電気光学結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="171">シンチレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="172">光学結晶アクセサリ</a></li>
                                                                                                                                <li><a href="#" data-id01="173">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="174">光学部品</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="174">光学部品すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="175">フィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="176">ミラー</a></li>
                                                                                                                                <li><a href="#" data-id01="177">コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="178">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="181">過飽和吸収体</a></li>
                                                                                                                                <li><a href="#" data-id01="182">エタロン</a></li>
                                                                                                                                <li><a href="#" data-id01="183">レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="184">マイクロ-レンズ/オプティクス</a></li>
                                                                                                                                <li><a href="#" data-id01="186">スプリッタ</a></li>
                                                                                                                                <li><a href="#" data-id01="188">光学窓</a></li>
                                                                                                                                <li><a href="#" data-id01="189">偏光子</a></li>
                                                                                                                                <li><a href="#" data-id01="190">テラヘルツ</a></li>
                                                                                                                                <li><a href="#" data-id01="191">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="192">メカニカルコンポーネンツ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="192">メカニカルコンポーネンツすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="193">光学マウント</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="197">エレクトロニクス</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="197">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="198">電流アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="199">電圧アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="200">ロックインアンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="201">LDドライバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="202">温度コントローラ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="203">LD関係アクセサリ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="205">測定器・検出器・試験機</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="205">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="611">光通信用測定器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="207">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="208">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="209">パワーメータ・ロステスタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="210">光可変アッテネータ (VOA)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="211">波長可変光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="212">光チューナブルフィルタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="213">ラボ・製造用 多機能プラットフォーム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="214">イーサネット試験機</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="215">OTDR</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="216">光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="217">MPO関連</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="218">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="219">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="251">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="252">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="221">フォトレシーバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="222">パワーメータ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="223">IRビューア</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="224">放射計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="225">分光器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="227">ゴレイセル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="253">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="254">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="230">Si (200~1100nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="231">GaAs (600~900nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="232">InGaAs (800~2600nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="233">Ge (800~1800nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="234">APD</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="236">TIA</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="237">アレイ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="238">UV, X線 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="239">1060nm 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="241">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="242">光学材料・消耗品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="242">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="244">IRセンサカード</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="245">色素</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="246">ホログラム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="247">保護メガネ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="248">保護フィルム</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="255">光学機器・光学解析ソフトウェア</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="255">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="256">光学解析ソフトウェア</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="259">自動認識関連機器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="259">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="260">CCDハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="261">レーザハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="262">ハンディイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="263">定置・組込型CCDスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="264">定置・組込型レーザスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="265">定置・組込型2Dイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="267">データコレクタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="268">ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="270">RFID HF帯 リーダライタモジュール</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="271">RFID HF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="273">RFID UHF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="274">RFID ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="275">RFID 応用製品</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="276">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="277">光通信</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="277">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="278">光通信フィールド用ツール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="278">光通信フィールド用ツールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="279">オプティカルツール</a></li>
                                                                                                                                <li><a href="#" data-id01="280">光ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="283">測定機</a></li>
                                                                                                                                <li><a href="#" data-id01="284">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                    </ul>
                                        </div>
                                                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">メーカーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                                                                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">国内</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="236">株式会社ファーストメカニカルデザイン</a></li>
                                                                                                                <li><a href="#" data-id01="233">導光技術</a></li>
                                                                                                                <li><a href="#" data-id01="225">株式会社オプトゲート</a></li>
                                                                                                                <li><a href="#" data-id01="197">DOWAエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="172">富士通株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="170">山本光学株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="167">珠電子株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="158">株式会社オプトロンサイエンス</a></li>
                                                                                                                <li><a href="#" data-id01="148">旭化成株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="146">アイメックス</a></li>
                                                                                                                <li><a href="#" data-id01="145">株式会社オプトエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="144">ジーエルソリューションズ</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">A</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="198">ao smart</a></li>
                                                                                                                <li><a href="#" data-id01="187">Arroyo Instruments</a></li>
                                                                                                                <li><a href="#" data-id01="180">advanced fiber tools</a></li>
                                                                                                                <li><a href="#" data-id01="179">Ampliconyx</a></li>
                                                                                                                <li><a href="#" data-id01="147">art photonics</a></li>
                                                                                                                <li><a href="#" data-id01="54">Andover</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">B</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="230">Brolis Semiconductors</a></li>
                                                                                                                <li><a href="#" data-id01="229">Bergmann Messgeräte Entwicklung</a></li>
                                                                                                                <li><a href="#" data-id01="228">BATOP optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="188">Bellin Laser</a></li>
                                                                                                                <li><a href="#" data-id01="173">Brightlaser</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">C</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="231">CASTECH</a></li>
                                                                                                                <li><a href="#" data-id01="182">CRYSLASER</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">D</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="232">DenseLight Semiconductors POET company</a></li>
                                                                                                                <li><a href="#" data-id01="189">DIRECTED LIGHT INC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">E</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="234">Exciton</a></li>
                                                                                                                <li><a href="#" data-id01="190">ETU-Link Technology</a></li>
                                                                                                                <li><a href="#" data-id01="150">EXFO Inc.</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">F</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="238">FORC Photonics</a></li>
                                                                                                                <li><a href="#" data-id01="235">Femto Messtechnik GmbH</a></li>
                                                                                                                <li><a href="#" data-id01="223">FinishAdapt</a></li>
                                                                                                                <li><a href="#" data-id01="202">fiberware</a></li>
                                                                                                                <li><a href="#" data-id01="199">FJW Optical Systems, Inc.</a></li>
                                                                                                                <li><a href="#" data-id01="171">Focuslight</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">G</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="241">GEOLA</a></li>
                                                                                                                <li><a href="#" data-id01="239">GPD Optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="222">Gigahertz-Optik</a></li>
                                                                                                                <li><a href="#" data-id01="175">Gentec-eo</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">H</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="240">HC Photonics (HCP)</a></li>
                                                                                                                <li><a href="#" data-id01="193">HiLight Semiconductor</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">I</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="153">ISOMET</a></li>
                                                                                                                <li><a href="#" data-id01="152">Inrad Optics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">J</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="206">JOINWIT</a></li>
                                                                                                                <li><a href="#" data-id01="205">JPT Opto-electronics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">L</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="209">LIMO</a></li>
                                                                                                                <li><a href="#" data-id01="201">laservision USA, LP</a></li>
                                                                                                                <li><a href="#" data-id01="200">Liverage Technology</a></li>
                                                                                                                <li><a href="#" data-id01="195">Lightwaves2020</a></li>
                                                                                                                <li><a href="#" data-id01="163">Layertec</a></li>
                                                                                                                <li><a href="#" data-id01="155">LightMachinery</a></li>
                                                                                                                <li><a href="#" data-id01="154">Leysop</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">M</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="203">MOORI Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">N</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="196">NPL</a></li>
                                                                                                                <li><a href="#" data-id01="181">NOVAE</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">O</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="208">OptoChip Photonics Ltd.</a></li>
                                                                                                                <li><a href="#" data-id01="160">OSI optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="159">Optowell</a></li>
                                                                                                                <li><a href="#" data-id01="157">Opneti</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">P</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="221">Photon Wave</a></li>
                                                                                                                <li><a href="#" data-id01="204">PicoLAS</a></li>
                                                                                                                <li><a href="#" data-id01="186">PowerPhotonic</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Q</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="178">QPhotonics</a></li>
                                                                                                                <li><a href="#" data-id01="161">Qubig GmbH</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">R</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="177">RUIK</a></li>
                                                                                                                <li><a href="#" data-id01="165">RPMC (LDX)</a></li>
                                                                                                                <li><a href="#" data-id01="162">Radiant Dyes Laser &amp; Accessories</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">S</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="227">Sheaumann Laser (Axcel photonics)</a></li>
                                                                                                                <li><a href="#" data-id01="194">SJ SYSTEM</a></li>
                                                                                                                <li><a href="#" data-id01="192">Siny optic-com co.,LTD</a></li>
                                                                                                                <li><a href="#" data-id01="184">Shanghai Dream Lasers Technology</a></li>
                                                                                                                <li><a href="#" data-id01="176">Schäfter + Kirchhoff</a></li>
                                                                                                                <li><a href="#" data-id01="166">SemiNex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">T</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="210">The fibers</a></li>
                                                                                                                <li><a href="#" data-id01="168">Tydex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">U</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="174">Union Optronics (UOC)</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">W</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="224">Wuhan Eternal Technologies</a></li>
                                                                                                                <li><a href="#" data-id01="169">Wavelength Electronics</a></li>
                                                                                                                <li><a href="#" data-id01="156">Wuhan Amazelink Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">X</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="191">Xinghan Laser Technology</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Y</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="183">YOFC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                </ul>
                                        </div>
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
                                                        <li><a href="#" data-id01="290">多波長チューナブル~</a></li>
                                                    </ul>
                                                </li>
                                                <li><p><span>良く探されている波長から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="608">532nm</a></li>
                                                        <li><a href="#" data-id01="291">808nm</a></li>
                                                        <li><a href="#" data-id01="584">850nm</a></li>
                                                        <li><a href="#" data-id01="324">940nm</a></li>
                                                        <li><a href="#" data-id01="mul01">976/980nm</a></li>
                                                        <li><a href="#" data-id01="mul02">1060/1064nm</a></li>
                                                        <li><a href="#" data-id01="mul03">1310/1550nm</a></li>
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
            </div>
            <?php endif; ?>
            <ul class="comItemList flex">
                <?php while ( $search_query->have_posts() ) { $search_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <div class="comItemList-detail">
                            <?php
                            $featured_posts = get_field('ff_distributor');
                            if( $featured_posts ): foreach( $featured_posts as $featured_post ): $title = get_the_title( $featured_post->ID ); ?>
                            <p class="ttl"><?php echo $title; ?></p>
                            <?php endforeach;  endif; ?>
                            <div class="txt">
                                <?php the_field("ff_excerpt"); ?>
                            </div>
                            <?php
                                $taxonomy = 'productcat';
                                $terms01 = get_the_terms($post->ID,$taxonomy);
                                $terms02 = get_ordered_terms($post->ID,'slug', 'ASC', 'wavelengthcat');
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
                                <li class="rainbow"><span><?php echo $ff_wavelengthlabel; ?></span></li>
                                <?php elseif (is_object_in_term($post->ID, 'wavelengthcat','multi-wavelength')): ?>
                                <li class="rainbow"><span>多波長、チューナブル</span></li>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
                                <?php } ?>
                                <?php else: ?>
                                <?php foreach($terms02 as $term02){ ?>
                                <?php if($term02->parent != 0){ ?><li class="rainbow"><span><?php echo $term02->name; ?></span></li><?php } ?>
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
                            <?php if($product){ $productitem = get_term_by('id',$product,'productcat'); ?><li style="border-color: #0fd000;"><?php echo $productitem->name; ?></li><?php } ?>
                            <?php if($distributor){ ?><li style="border-color: #0fd000;"><?php $title = get_post($distributor)->post_title; echo $title; ?></li><?php } ?>
                            <?php if($wavelength){ ?>
                            <?php if($wavelength == 'mul01'){ ?>
                            <li class="rainbow"><span>976/980nm</span></li>
                            <?php }else if($wavelength == 'mul02'){ ?>
                            <li class="rainbow"><span>1060/1064nm</span></li>
                            <?php }else if($wavelength == 'mul03'){ ?>
                            <li class="rainbow"><span>1310/1550nm</span></li>
                            <?php }else { ?>
                            <?php $wavelengthitem = get_term_by('id',$wavelength,'wavelengthcat'); ?><li class="rainbow"><span><?php echo $wavelengthitem->name; ?></span></li>
                            <?php } } ?>
                            <?php if($s){ ?><li style="border-color: #0fd000;"><?php echo $s; ?></li><?php } ?>
                        </ul>
                    </div>
                    <div class="rBox sdwBox--toggle">
                        <p class="headLine04">検索条件を変更する</p>
                        <p class="sp text01">商品名・型番・メーカーまたはキーワードを入力</p>
                        <div class="inputBox">
                            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" name="s" placeholder="商品名・型番・メーカーまたはキーワードを入力" class="inputText">
                                <input type="submit" value="検索" class="inputButton">
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
                                                                                                        <div class="enUlBox enUlBox01">
                                            <ul class="enUl01">
                                                                                        <li><a href="#" data-id01="2">自社製品(設計・試作・OEM)</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="2">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="3">光ファイバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="3">光ファイバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="4">シングルモードファイバパッチコード(SM)</a></li>
                                                                                                                                <li><a href="#" data-id01="5">マルチモードファイバパッチコード(MM)</a></li>
                                                                                                                                <li><a href="#" data-id01="6">偏波保持ファイバパッチコード(PM、パンダ)</a></li>
                                                                                                                                <li><a href="#" data-id01="7">プラスチックファイバパッチコード(POF)</a></li>
                                                                                                                                <li><a href="#" data-id01="8">分岐ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="9">バンドルファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="10">ファイバアレイ</a></li>
                                                                                                                                <li><a href="#" data-id01="11">コネクタ・アダプタ各種</a></li>
                                                                                                                                <li><a href="#" data-id01="12">ファイバ補強スリーブ</a></li>
                                                                                                                                <li><a href="#" data-id01="13">ファイバ保護チューブ</a></li>
                                                                                                                                <li><a href="#" data-id01="14">フェルール</a></li>
                                                                                                                                <li><a href="#" data-id01="15">真空フィードスルー</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="17">コリメータ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="17">コリメータすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="18">コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="19">ファイバ一体型コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="20">FCレセプタクルコリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="21">長距離用コリメータ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="22">レーザーポインタ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="22">レーザーポインタすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="23">レーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="24">真円レーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="25">ラインレーザーポインタ</a></li>
                                                                                                                                <li><a href="#" data-id01="26">出力調整コントローラ</a></li>
                                                                                                                                <li><a href="#" data-id01="27">パワーサプライ(専用電源)</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="29">光源装置</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="29">光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="30">LD光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="31">LED光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="32">VCSEL光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="33">小型光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="34">2波長合成光源装置</a></li>
                                                                                                                                <li><a href="#" data-id01="36">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="37">LD・PDモジュール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="37">LD・PDモジュールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="38">シングルモードファイバLDピグテイル</a></li>
                                                                                                                                <li><a href="#" data-id01="41">LDピグテイルドライバ付き光源装置</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="45">LDドライバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="45">LDドライバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="46">APC駆動 LDドライバ</a></li>
                                                                                                                                <li><a href="#" data-id01="47">ACC駆動 LDドライバ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="48">オプティクス</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="48">オプティクスすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="49">合成石英レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="50">反射型可視光NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="51">反射型紫外用NDフィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="52">光学用ミラー</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="65">光ファイバ・ファイバコンポーネント</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="65">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="66">光ファイバ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="66">光ファイバすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="67">シングルモードファイバ・パッチコード(SM)</a></li>
                                                                                                                                <li><a href="#" data-id01="68">マルチモードファイバ ・パッチコード(MM)</a></li>
                                                                                                                                <li><a href="#" data-id01="69">偏波保持ファイバ・パッチコード(PM、パンダ)</a></li>
                                                                                                                                <li><a href="#" data-id01="70">フォトニック結晶ファイバ(PCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="71">特殊ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="72">中空ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="73">分散補償ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="75">ダブルクラッドファイバ(DCF)</a></li>
                                                                                                                                <li><a href="#" data-id01="76">中赤外用ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="108">プラスチックファイバ パッチコード(POF)</a></li>
                                                                                                                                <li><a href="#" data-id01="77">高非線形ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="78">校正ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="79">耐熱・耐環境</a></li>
                                                                                                                                <li><a href="#" data-id01="109">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="80">ファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="80">ファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="81">光スイッチ</a></li>
                                                                                                                                <li><a href="#" data-id01="83">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="85">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="86">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="87">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="88">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="90">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="93">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="94">PMファイバコンポーネント</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="94">PMファイバコンポーネントすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="97">カプラ</a></li>
                                                                                                                                <li><a href="#" data-id01="99">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="100">コンバイナ</a></li>
                                                                                                                                <li><a href="#" data-id01="101">アッテネータ</a></li>
                                                                                                                                <li><a href="#" data-id01="102">WDM</a></li>
                                                                                                                                <li><a href="#" data-id01="104">サーキュレータ・PBC/S・ポラライザ</a></li>
                                                                                                                                <li><a href="#" data-id01="106">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="110">光源</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="110">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="111">ファイバレーザ・ファイバーアンプすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="112">CW</a></li>
                                                                                                                                <li><a href="#" data-id01="113">パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="114">超短パルス</a></li>
                                                                                                                                <li><a href="#" data-id01="115">ファイバーアンプ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="117">半導体レーザ・VCSEL</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="117">半導体レーザ・VCSELすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="118">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="119">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="120">VCSEL</a></li>
                                                                                                                                <li><a href="#" data-id01="121">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="122">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="123">ベアチップ</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="125">LED・SLD・SOA</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="125">LED・SLD・SOAすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="126">UV-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="127">IR-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="128">RC-LED</a></li>
                                                                                                                                <li><a href="#" data-id01="129">SLD・SLED</a></li>
                                                                                                                                <li><a href="#" data-id01="130">SOA・ゲインチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="131">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="132">エピウェハ</a></li>
                                                                                                                                <li><a href="#" data-id01="133">ベアチップ</a></li>
                                                                                                                                <li><a href="#" data-id01="134">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="135">LD・LED光源装置</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="135">LD・LED光源装置すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="136">空間出力</a></li>
                                                                                                                                <li><a href="#" data-id01="137">ファイバーカップル</a></li>
                                                                                                                                <li><a href="#" data-id01="139">狭線幅光源</a></li>
                                                                                                                                <li><a href="#" data-id01="141">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="143">固体レーザ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="143">固体レーザすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="144">CW(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="145">パルス(空間)</a></li>
                                                                                                                                <li><a href="#" data-id01="148">超短パルス</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="151">広帯域・その他光源</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="151">広帯域・その他光源すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="152">ASE</a></li>
                                                                                                                                <li><a href="#" data-id01="154">スーパーコンティニュアム</a></li>
                                                                                                                                <li><a href="#" data-id01="155">RGB・多波長</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="157">光変調器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="157">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="158">音響光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="159">電気光学変調器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="160">ドライバ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="162">光学部品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="162">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="163">光学結晶</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="163">光学結晶すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="164">非線形結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="165">レーザ結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="166">PPLN</a></li>
                                                                                                                                <li><a href="#" data-id01="167">接合結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="168">電気光学結晶</a></li>
                                                                                                                                <li><a href="#" data-id01="171">シンチレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="172">光学結晶アクセサリ</a></li>
                                                                                                                                <li><a href="#" data-id01="173">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="174">光学部品</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="174">光学部品すべて</a></li>
                                                                                                                                <li><a href="#" data-id01="175">フィルタ</a></li>
                                                                                                                                <li><a href="#" data-id01="176">ミラー</a></li>
                                                                                                                                <li><a href="#" data-id01="177">コリメータ</a></li>
                                                                                                                                <li><a href="#" data-id01="178">アイソレータ</a></li>
                                                                                                                                <li><a href="#" data-id01="181">過飽和吸収体</a></li>
                                                                                                                                <li><a href="#" data-id01="182">エタロン</a></li>
                                                                                                                                <li><a href="#" data-id01="183">レンズ</a></li>
                                                                                                                                <li><a href="#" data-id01="184">マイクロ-レンズ/オプティクス</a></li>
                                                                                                                                <li><a href="#" data-id01="186">スプリッタ</a></li>
                                                                                                                                <li><a href="#" data-id01="188">光学窓</a></li>
                                                                                                                                <li><a href="#" data-id01="189">偏光子</a></li>
                                                                                                                                <li><a href="#" data-id01="190">テラヘルツ</a></li>
                                                                                                                                <li><a href="#" data-id01="191">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                        <li><a href="#" data-id01="192">メカニカルコンポーネンツ</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="192">メカニカルコンポーネンツすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="193">光学マウント</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="197">エレクトロニクス</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="197">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="198">電流アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="199">電圧アンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="200">ロックインアンプ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="201">LDドライバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="202">温度コントローラ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="203">LD関係アクセサリ</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="205">測定器・検出器・試験機</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="205">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="611">光通信用測定器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="207">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="208">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="209">パワーメータ・ロステスタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="210">光可変アッテネータ (VOA)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="211">波長可変光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="212">光チューナブルフィルタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="213">ラボ・製造用 多機能プラットフォーム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="214">イーサネット試験機</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="215">OTDR</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="216">光源</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="217">MPO関連</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="218">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="219">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="251">波長計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="252">光スペクトラムアナライザ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="221">フォトレシーバ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="222">パワーメータ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="223">IRビューア</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="224">放射計</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="225">分光器</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="227">ゴレイセル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="253">コネクタ端面検査装置</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="254">その他</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="230">Si (200~1100nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="231">GaAs (600~900nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="232">InGaAs (800~2600nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="233">Ge (800~1800nm)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="234">APD</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="236">TIA</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="237">アレイ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="238">UV, X線 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="239">1060nm 用</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="241">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="242">光学材料・消耗品</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="242">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="244">IRセンサカード</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="245">色素</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="246">ホログラム</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="247">保護メガネ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="248">保護フィルム</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="255">光学機器・光学解析ソフトウェア</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="255">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="256">光学解析ソフトウェア</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="259">自動認識関連機器</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="259">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="260">CCDハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="261">レーザハンディスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="262">ハンディイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="263">定置・組込型CCDスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="264">定置・組込型レーザスキャナ(1次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="265">定置・組込型2Dイメージャー(2次元)</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="267">データコレクタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="268">ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="270">RFID HF帯 リーダライタモジュール</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="271">RFID HF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="273">RFID UHF帯 リーダライタ</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="274">RFID ハンディターミナル</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="275">RFID 応用製品</a>
                                                                                                                                                                </li>
                                                                                                        <li><a href="#" data-id01="276">その他</a>
                                                                                                                                                                </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                        <li><a href="#" data-id01="277">光通信</a>
                                                                                                                                            <ul class="conterUl">
                                                        <li><a href="#" data-id01="277">■すべて</a></li>
                                                                                                        <li><a href="#" data-id01="278">光通信フィールド用ツール</a>
                                                                                                                                                                    <div class="subWrap">
                                                                <ul class="subUl flexB">
                                                                    <li><a href="#" data-id01="278">光通信フィールド用ツールすべて</a></li>
                                                                                                                                <li><a href="#" data-id01="279">オプティカルツール</a></li>
                                                                                                                                <li><a href="#" data-id01="280">光ファイバ</a></li>
                                                                                                                                <li><a href="#" data-id01="283">測定機</a></li>
                                                                                                                                <li><a href="#" data-id01="284">その他</a></li>
                                                                                                                            </ul>
                                                            </div>
                                                                                                            </li>
                                                                                                    </ul>
                                                                                            </li>
                                                                                    </ul>
                                        </div>
                                                                    </div>
                                </li>
                                <li>
                                    <p class="link"><a href="#">メーカーで探す</a></p>
                                    <div class="iptBox">
                                        <input type="hidden" name="cat02" class="cat01">
                                                                                                        <a href="#" class="link01">選択してください</a>
                                        <div class="enUlBox">
                                            <ul class="enUl flex">
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">国内</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="236">株式会社ファーストメカニカルデザイン</a></li>
                                                                                                                <li><a href="#" data-id01="233">導光技術</a></li>
                                                                                                                <li><a href="#" data-id01="225">株式会社オプトゲート</a></li>
                                                                                                                <li><a href="#" data-id01="197">DOWAエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="172">富士通株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="170">山本光学株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="167">珠電子株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="158">株式会社オプトロンサイエンス</a></li>
                                                                                                                <li><a href="#" data-id01="148">旭化成株式会社</a></li>
                                                                                                                <li><a href="#" data-id01="146">アイメックス</a></li>
                                                                                                                <li><a href="#" data-id01="145">株式会社オプトエレクトロニクス</a></li>
                                                                                                                <li><a href="#" data-id01="144">ジーエルソリューションズ</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">A</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="198">ao smart</a></li>
                                                                                                                <li><a href="#" data-id01="187">Arroyo Instruments</a></li>
                                                                                                                <li><a href="#" data-id01="180">advanced fiber tools</a></li>
                                                                                                                <li><a href="#" data-id01="179">Ampliconyx</a></li>
                                                                                                                <li><a href="#" data-id01="147">art photonics</a></li>
                                                                                                                <li><a href="#" data-id01="54">Andover</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">B</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="230">Brolis Semiconductors</a></li>
                                                                                                                <li><a href="#" data-id01="229">Bergmann Messgeräte Entwicklung</a></li>
                                                                                                                <li><a href="#" data-id01="228">BATOP optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="188">Bellin Laser</a></li>
                                                                                                                <li><a href="#" data-id01="173">Brightlaser</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">C</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="231">CASTECH</a></li>
                                                                                                                <li><a href="#" data-id01="182">CRYSLASER</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">D</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="232">DenseLight Semiconductors POET company</a></li>
                                                                                                                <li><a href="#" data-id01="189">DIRECTED LIGHT INC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">E</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="234">Exciton</a></li>
                                                                                                                <li><a href="#" data-id01="190">ETU-Link Technology</a></li>
                                                                                                                <li><a href="#" data-id01="150">EXFO Inc.</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">F</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="238">FORC Photonics</a></li>
                                                                                                                <li><a href="#" data-id01="235">Femto Messtechnik GmbH</a></li>
                                                                                                                <li><a href="#" data-id01="223">FinishAdapt</a></li>
                                                                                                                <li><a href="#" data-id01="202">fiberware</a></li>
                                                                                                                <li><a href="#" data-id01="199">FJW Optical Systems, Inc.</a></li>
                                                                                                                <li><a href="#" data-id01="171">Focuslight</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">G</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="241">GEOLA</a></li>
                                                                                                                <li><a href="#" data-id01="239">GPD Optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="222">Gigahertz-Optik</a></li>
                                                                                                                <li><a href="#" data-id01="175">Gentec-eo</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">H</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="240">HC Photonics (HCP)</a></li>
                                                                                                                <li><a href="#" data-id01="193">HiLight Semiconductor</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">I</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="153">ISOMET</a></li>
                                                                                                                <li><a href="#" data-id01="152">Inrad Optics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">J</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="206">JOINWIT</a></li>
                                                                                                                <li><a href="#" data-id01="205">JPT Opto-electronics</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">L</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="209">LIMO</a></li>
                                                                                                                <li><a href="#" data-id01="201">laservision USA, LP</a></li>
                                                                                                                <li><a href="#" data-id01="200">Liverage Technology</a></li>
                                                                                                                <li><a href="#" data-id01="195">Lightwaves2020</a></li>
                                                                                                                <li><a href="#" data-id01="163">Layertec</a></li>
                                                                                                                <li><a href="#" data-id01="155">LightMachinery</a></li>
                                                                                                                <li><a href="#" data-id01="154">Leysop</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">M</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="203">MOORI Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">N</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="196">NPL</a></li>
                                                                                                                <li><a href="#" data-id01="181">NOVAE</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">O</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="208">OptoChip Photonics Ltd.</a></li>
                                                                                                                <li><a href="#" data-id01="160">OSI optoelectronics</a></li>
                                                                                                                <li><a href="#" data-id01="159">Optowell</a></li>
                                                                                                                <li><a href="#" data-id01="157">Opneti</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">P</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="221">Photon Wave</a></li>
                                                                                                                <li><a href="#" data-id01="204">PicoLAS</a></li>
                                                                                                                <li><a href="#" data-id01="186">PowerPhotonic</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Q</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="178">QPhotonics</a></li>
                                                                                                                <li><a href="#" data-id01="161">Qubig GmbH</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">R</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="177">RUIK</a></li>
                                                                                                                <li><a href="#" data-id01="165">RPMC (LDX)</a></li>
                                                                                                                <li><a href="#" data-id01="162">Radiant Dyes Laser &amp; Accessories</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">S</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="227">Sheaumann Laser (Axcel photonics)</a></li>
                                                                                                                <li><a href="#" data-id01="194">SJ SYSTEM</a></li>
                                                                                                                <li><a href="#" data-id01="192">Siny optic-com co.,LTD</a></li>
                                                                                                                <li><a href="#" data-id01="184">Shanghai Dream Lasers Technology</a></li>
                                                                                                                <li><a href="#" data-id01="176">Schäfter + Kirchhoff</a></li>
                                                                                                                <li><a href="#" data-id01="166">SemiNex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">T</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="210">The fibers</a></li>
                                                                                                                <li><a href="#" data-id01="168">Tydex</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">U</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="174">Union Optronics (UOC)</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">W</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="224">Wuhan Eternal Technologies</a></li>
                                                                                                                <li><a href="#" data-id01="169">Wavelength Electronics</a></li>
                                                                                                                <li><a href="#" data-id01="156">Wuhan Amazelink Technologies</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">X</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="191">Xinghan Laser Technology</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                    <li>
                                                    <ul class="fatUl">
                                                        <li><a href="#" data-id01="">Y</a>
                                                                                                                                                                    <ul class="innUl">
                                                                                                                <li><a href="#" data-id01="183">YOFC</a></li>
                                                                                                                </ul>
                                                                                                            </li>
                                                    </ul>
                                                </li>
                                                                                </ul>
                                        </div>
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
                                                        <li><a href="#" data-id01="290">多波長チューナブル~</a></li>
                                                    </ul>
                                                </li>
                                                <li><p><span>良く探されている波長から探す</span></p>
                                                    <ul class="flex">
                                                        <li><a href="#" data-id01="608">532nm</a></li>
                                                        <li><a href="#" data-id01="291">808nm</a></li>
                                                        <li><a href="#" data-id01="584">850nm</a></li>
                                                        <li><a href="#" data-id01="324">940nm</a></li>
                                                        <li><a href="#" data-id01="mul01">976/980nm</a></li>
                                                        <li><a href="#" data-id01="mul02">1060/1064nm</a></li>
                                                        <li><a href="#" data-id01="mul03">1310/1550nm</a></li>
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
