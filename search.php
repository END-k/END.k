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
            'key'     => 'ff_specifyoutput',
            'value'   => array( $output ),
            'compare' => 'IN',
        );
    }else {
        $args01 = '';
    }
    
    if($w){
        $args02 = array(
            'key'     => 'ff_unit',
            'value'   => array( $w ),
            'compare' => 'IN',
        );
    }else {
        $args02 = '';
    }
    
    if(count($mode)){
        $args03 = array(
            'key'     => 'ff_oscillationform',
            'value'   => $mode,
            'compare' => 'IN',
        );
    }else {
        $args03 = '';
    }
    
    if(count($source)){
        $args04 = array(
            'key'     => 'ff_lightsourcetype',
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
    if($wavelength){
        $args = array(
            'post_type' => 'product',
            'paged' => $paged,
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'wavelengthcat',
                    'field'    => 'name',
                    'terms'    => array($wavelength),
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
                    'terms'    => array($wavelength),
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
} ?>
<div class="product result">
    <section class="pageTitle">
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <div class="topBox flexB">
                <div class="sdwBox">
                    <div class="hadBox flexB">
                        <p class="headLine04"> 検索条件</p>
                        <ul class="tag">
                            <?php if($product){ $productitem = get_term_by('id',$product,'productcat'); ?><li style="border-color: #0fd000;"><?php echo $productitem->name; ?></li><?php } ?>
                            <?php if($distributor){ ?><li style="border-color: #0fd000;"><?php $title = get_post($distributor)->post_title; echo $title; ?></li><?php } ?>
                            <?php if($wavelength){ ?>
                            <?php if($wavelength == 'mul01'){ ?>
                            <li style="border-color: #0fd000; background-color: #f20000;">976/980nm</li>
                            <?php }else if($wavelength == 'mul02'){ ?>
                            <li style="border-color: #0fd000; background-color: #f20000;">1060/1064nm</li>
                            <?php }else if($wavelength == 'mul03'){ ?>
                            <li style="border-color: #0fd000; background-color: #f20000;">1310/1550nm</li>
                            <?php }else { ?>
                            <?php $wavelengthitem = get_term_by('id',$wavelength,'wavelengthcat'); ?><li style="border-color: #0fd000; background-color: #f20000;"><?php echo $wavelengthitem->name; ?></li>
                            <?php } } ?>
                            <?php if($s){ ?><li style="border-color: #0fd000;"><?php echo $s; ?></li><?php } ?>
                        </ul>
                    </div>
                    <div class="sdwLink"><a href="#">検索条件を変更する</a></div>
                </div>
                <h2 class="headLine05">該当製品数<span><?php $post_list = get_posts($argsearch); $num = 0; if($post_list){
                foreach ( $post_list as $post ) { setup_postdata($post); $num++; } }wp_reset_postdata(); echo $num; ?><small>件</small></span></h2>
            </div>
            <?php $query = new WP_Query( $args ); if ( $query->have_posts() ) { ?>
            <ul class="comItemList flex">
            <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">							
                        <div class="phoBox"><div class="pho" style="background-image: url(<?php if(has_post_thumbnail()){ the_post_thumbnail_url('full'); }?>);"></div></div>
                        <h3 class="headLine04"><?php the_title(); ?></h3>
                        <?php
                        $featured_posts = get_field('ff_distributor');
                        if( $featured_posts ): foreach( $featured_posts as $featured_post ): $title = get_the_title( $featured_post->ID ); ?>
                        <p class="ttl"><?php echo $title; ?></p>
                        <?php endforeach;  endif; ?>
                        <p class="txt"><?php get_excerpt(54); ?></p>
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
                    </a>					
                </li>
            <?php } ?>
            </ul>
            <?php } wp_reset_postdata(); ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi( array( 
                'query' => $query,
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