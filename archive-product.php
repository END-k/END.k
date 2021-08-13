<?php get_header(); ?>
<div class="product category">
    <section class="pageTitle">
        <embed src="<?php bloginfo('template_url');?>/img/common/line.svg" type="image/svg+xml" class="pc"><img src="<?php bloginfo('template_url');?>/img/common/sp_line.png" alt="" class="sp">
        <h2>製品カテゴリ</h2>
        <ul class="language flex pc">
            <li><span>LANGUAGE</span></li>
            <li><a href="#">JAPANESE</a></li>
            <li class="en"><a href="#">ENGLISH</a></li>
        </ul>
    </section>
    <div id="main">
        <div class="content">
            <ul class="comItemList comItemList01 flex">
            <?php
                $args = array(
                    'taxonomy' => 'productcat',
                    'hide_empty' => 0,
                    'exclude' => '',
                    'parent' => 0,
                );
            ?>
            <?php $terms = get_terms( $args );
                if($terms){
                    foreach($terms as $term) { $curId = $term->term_id; $showname = get_field('ff_showname', 'productcat_'.$curId); $showimg = get_field('ff_showimg', 'productcat_'.$curId); ?>
                    <li>
                        <a href="#a<?php echo $curId;?>">							
                            <div class="phoBox"><div class="pho" style="background-image: url(<?php echo $showimg; ?>)"></div></div>
                            <div class="txtBox">
                                <p class="link"><?php if($showname){ echo $showname; }else { echo $term->name; } ?></p>
                            </div>
                        </a>				
                    </li>
            <?php }}?>
            </ul>
            <?php $num=0; foreach($terms as $term) { $num++; $curId = $term->term_id; ?>
            <div class="bgBox">
                <div class="categoryLink<?php if($num%3==2){ echo ' categoryLink01'; }else if($num%3==0){ echo ' categoryLink02'; } ?>" id="a<?php echo $curId;?>"><a href="<?php echo get_term_link( $term->term_id );?>"><span><?php echo $term->name;?></span></a></div>
                <?php
                    $args01 = array(
                        'taxonomy' => 'productcat',
                        'hide_empty' => 0,
                        'exclude' => '',
                        'child_of' => $curId,
                    );
                ?>
                <?php $terms01 = get_terms( $args01 );
                    if($terms01){ $flag = 0; foreach($terms01 as $term01) { if($term01->parent != $curId){ $flag = 1; } } } if($flag == 1){ ?>
                <ul class="categoryUl flexB">
                <?php
                    $args02 = array(
                        'taxonomy' => 'productcat',
                        'hide_empty' => 0,
                        'exclude' => '',
                        'parent' => $curId,
                    );
                ?>
                <?php $terms02 = get_terms( $args02 );
                    if($terms02){ foreach($terms02 as $term02) { $secondId = $term02->term_id; $secendshowimg = get_field('ff_showimg', 'productcat_'.$secondId); ?>
                    <li>
                        <p class="ttlLink"><a href="<?php echo get_term_link( $secondId );?>"><span><?php echo $term02->name;?></span></a></p>
                        <div class="pho"><img src="<?php echo $secendshowimg; ?>" alt="<?php echo $term02->name;?>"></div>
                        <?php
                            $args03 = array(
                                'taxonomy' => 'productcat',
                                'hide_empty' => 0,
                                'exclude' => '',
                                'parent' => $secondId,
                            );
                        ?>
                        <?php $terms03 = get_terms( $args03 ); if($terms03){ $catArr = array(); foreach($terms03 as $term03) { array_push($catArr,$term03->term_id); } } ?>
                        <?php if(count($catArr)){ ?>
                        <ul class="comLinkUl flexC">
                        <?php for($i=0;$i<=count($catArr)-1;$i++){ if($i == 4){ break; } $small = get_field('ff_showname', 'productcat_'.$catArr[$i]);  ?>
                            <li><a href="<?php echo get_term_link( $catArr[$i] );?>"><span><?php if($small){ echo $small; }else { echo get_term_by('id',$catArr[$i],'productcat')->name; } ?></span></a></li>
                        <?php } ?>
                        </ul>
                        <?php }?>
                        <?php if(count($catArr) > 4){ ?>
                        <div class="downBox">
                            <div class="comLinkUlBox">
                                <ul class="comLinkUl flexC">
                                <?php for($i=4;$i<=count($catArr)-1;$i++){ $small = get_field('ff_showname', 'productcat_'.$catArr[$i]);  ?>
                                    <li><a href="<?php echo get_term_link( $catArr[$i] );?>"><span><?php if($small){ echo $small; }else { echo get_term_by('id',$catArr[$i],'productcat')->name; } ?></span></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                            <p class="down"><a href="#">もっと見る <span>+</span></a></p>
                        </div>
                        <?php } ?>
                    </li>
                <?php } } ?>
                </ul>
                <?php }else { ?>
                <?php
                    $args02 = array(
                        'taxonomy' => 'productcat',
                        'hide_empty' => 0,
                        'exclude' => '',
                        'parent' => $curId,
                    );
                ?>
                <?php $terms02 = get_terms( $args02 );
                    if($terms02){ ?>
                <div class="inn">
                    <ul class="comLinkUl flexB">
                    <?php foreach($terms02 as $term02) { $secondId = $term02->term_id; ?>
                        <li><a href="<?php echo get_term_link( $secondId );?>"><span><?php echo $term02->name;?></span></a></li>
                    <?php } ?>
                    </ul>
                </div>
                <?php } } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<ul id="pagePath">
    <li><a href="<?php bloginfo('url');?>">TOP</a>&gt;</li>
    <li>製品カテゴリ</li>
</ul>
<?php get_footer(); ?>