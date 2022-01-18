<?php
function remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
add_action('admin_enqueue_scripts', 'remove_wp_open_sans');

//remove_filter (  'the_content' ,  'wpautop'  );
//remove_filter (  'the_excerpt' ,  'wpautop'  );
//remove_filter( 'comment_text', 'wpautop',  30 );


add_theme_support( 'post-thumbnails' );
//add_image_size('size-news',240,175,true);

/**
* get page name
**/
function getPageName(){
	if(is_page()){
		$pageId = get_the_ID();
		$curPage = get_page($pageId);
		$curPageParent = $curPage->post_parent;
		if($curPageParent == 0){
			$pname = $curPage->post_name;
		}else{
			$pname = get_page(get_top_parent_page_id())->post_name;
		}
	}
	else if(is_post_type_archive('staff') || is_singular('staff') || is_tax('staffcat') ){
		$pname = 'staff';
	}
	else if(is_category() || is_single() || is_search()){
		$pname = 'news';
	}
	return $pname;
}

function get_top_parent_page_id() {
    global $post;
    $ancestors = $post->ancestors;
    if ($ancestors) {
        return end($ancestors);
    } else {
        return $post->ID;
    }
}

function needRemoveP() {
	remove_filter('the_content', 'wpautop');
}

//add_action ('loop_start', 'needRemoveP');

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	return $pageURL;
}

/**
 * shortcode
 */
function template_src() {
    return get_bloginfo('template_url');
}

function template_url() {
    return get_bloginfo('url');
}

add_shortcode('src', 'template_src');
add_shortcode('url', 'template_url');

add_shortcode('add_part', function($attr){
	ob_start();
	get_template_part($attr['part']);
	return ob_get_clean();
});

//excerpt
function get_excerpt($count){
	$content = get_the_content();
	$trimmed_content = wp_trim_words( $content, $count, '...' );
	echo $trimmed_content;
}

function get_preview_id($postId) {
    global $post;
    $previewId = 0;
    if ( isset($_GET['preview'])
            && ($post->ID == $postId)
                && $_GET['preview'] == true
                    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
        ) {
        $preview = wp_get_post_autosave($postId);
        if ($preview != false) { $previewId = $preview->ID; }
    }
    return $previewId;
}

add_filter('get_post_metadata', function($meta_value, $post_id, $meta_key, $single) {
    if ($preview_id = get_preview_id($post_id)) {
        if ($post_id != $preview_id) {
            $meta_value = get_post_meta($preview_id, $meta_key, $single);
        }
    }
    return $meta_value;
}, 10, 4);

add_action('wp_insert_post', function ($postId) {
    global $wpdb;
    if (wp_is_post_revision($postId)) {
        if (isset($_POST['fields']) && count($_POST['fields']) != 0) {
            foreach ($_POST['fields'] as $key => $value) {
                $field = get_field($key);
                if ( !isset($field['name']) || !isset($field['key']) ) continue;
                if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
                    update_metadata('post', $postId, $field['name'], $value);
                    update_metadata('post', $postId, "_" . $field['name'], $field['key']);
                } else {
                    add_metadata('post', $postId, $field['name'], $value);
                    add_metadata('post', $postId, "_" . $field['name'], $field['key']);
                }
            }
        }
        do_action('save_preview_postmeta', $postId);
    }
});

add_filter('wp_terms_checklist_args','wp_terms_checklist_args');

function wp_terms_checklist_args($args) {
    $args['checked_ontop'] = false;
    return $args;
}

//// get site url
//wpcf7_add_form_tag('cf7_url', 'cf7_custom_url', true);
//function cf7_custom_url(){
//     return get_bloginfo('url');
//}
//
//// get logo url
//wpcf7_add_form_tag('cf7_src', 'cf7_custom_src', true);
//function cf7_custom_src(){
//   return get_bloginfo('template_url');
//}

/**
* 事例一覧
**/
function new_post_case(){
	register_post_type(
		'case',
		array(
			'label' => '事例一覧',
			'public' => true,
			'hierarchical' => false,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
				),
			'menu_position' => 6
			)
	);
	register_taxonomy(
		'casecat',
		'case',
		array(
			'label' => 'カテゴリ',
			'public' => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			)
		);
}
add_action('init', 'new_post_case');

/**
* 取扱メーカー
**/
function new_post_distributor(){
	register_post_type(
		'distributor',
		array(
			'label' => '取扱メーカー',
			'public' => true,
			'hierarchical' => false,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
				),
			'menu_position' => 6
			)
	);
	register_taxonomy(
		'distributorcat',
		'distributor',
		array(
			'label' => 'カテゴリ',
			'public' => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			)
		);
}
add_action('init', 'new_post_distributor');

/**
* 製品
**/
function new_post_product(){
	register_post_type(
		'product',
		array(
			'label' => '製品',
			'public' => true,
			'hierarchical' => false,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail'
				),
			'menu_position' => 6
			)
	);
	register_taxonomy(
		'productcat',
		'product',
		array(
			'label' => 'カテゴリ',
			'public' => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			)
		);
    register_taxonomy(
		'wavelengthcat',
		'product',
		array(
			'label' => '波長カテゴリ',
			'public' => true,
			'hierarchical' => true,
			'show_in_rest' => true,
			)
		);
		register_taxonomy(
			'waveoutputcat',
			'product',
			array(
				'label' => '波長出力カテゴリ',
				'public' => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				)
			);
	
}
add_action('init', 'new_post_product');

/**
* おすすめ商品バナー
**/
function new_post_recommend(){
	register_post_type(
		'recommend',
		array(
			'label' => 'おすすめ商品バナー',
			'public' => true,
			'hierarchical' => false,
			'has_archive' => true,
			'show_in_rest' => true,
			'supports' => array(
				'title',
				'custom-fields',
				'thumbnail'
				),
			'menu_position' => 6
			)
	);
}
add_action('init', 'new_post_recommend');


function mytheme_admin_enqueue() {
    wp_enqueue_style( 'my_admin_css', get_template_directory_uri() . '/my-admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'mytheme_admin_enqueue' );

//検索ロジック
function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'product');
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

/**
 * サイト内検索の範囲に、カテゴリー名、タグ名、を含める
 */
function custom_search($search, $wp_query) {
global $wpdb;

//サーチページ以外だったら終了
if (!$wp_query->is_search)
	return $search;

if (!isset($wp_query->query_vars))
	return $search;

/**
 * サイト内検索の範囲に、カテゴリー名、タグ名、を含める
 */
// 検索した文字列、文末が”ー”だったら、ー消す
$input_words = $_GET['s'];//検索文字
$string = mb_substr($input_words,-1);//ラスト１文字取得
if($string === "ー"){
	$input_words = mb_substr($_GET['s'], 0, -1);//$wordが「あいー」だった場合、文末１文字消されて「あい」に
}
//echo $input_words;
//echo $string;

//$_GET['s']が存在していれば
// if(isset($_GET['s']) && $_GET['s'] != ''){
//     echo '<strong>$_GET[\'s\']が送信されました。値は[ '.$_GET['s'].' ]です。'."</strong><br/>\n";
    
// }else{
//     echo '<strong>$_GET[\'s\']はまだ送信されていません。'."</strong><br/>\n";
// }

// die;
//スペースでの検索を許可
$search_words = explode(' ', isset($input_words) ? $input_words : '');
if ( count($search_words) > 0 ) {
	$search = '';
	foreach ( $search_words as $word ) {
		if ( !empty($word) ) {
			$search_word = $wpdb->escape("%{$word}%");
			$search .= " AND (
				{$wpdb->posts}.post_title LIKE '{$search_word}'
				OR {$wpdb->posts}.post_content LIKE '{$search_word}'
				OR {$wpdb->posts}.ID IN (
					SELECT distinct post_id
					FROM {$wpdb->postmeta}
					WHERE {$wpdb->postmeta}.meta_key IN ('ff_distributor_search', 'ff_modelnumber') AND meta_value LIKE '{$search_word}'
				)
				OR {$wpdb->posts}.ID IN (
					SELECT distinct r.object_id
					FROM {$wpdb->term_relationships} AS r
					INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
					INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
					WHERE t.name LIKE '{$search_word}'
					OR t.slug LIKE '{$search_word}'
					OR tt.description LIKE '{$search_word}'
				)
			) ";
		}
	}
}

return $search;
}
add_filter('posts_search','custom_search', 10, 2);


function change_posts_per_page($query) {
	if ( is_admin() || ! $query->is_main_query() ){
		return;
	}

	if ( $query->is_tax('productcat') ) {
		$query->set( 'posts_per_page', '12' );
		return;
	}

	if ( $query->is_tax('wavelengthcat') ) {
		$query->set( 'posts_per_page', '12' );
		return;
	}

}
add_action( 'pre_get_posts', 'change_posts_per_page' );


function get_ordered_terms( $id = 0, $orderby = 'term_id', $order = 'ASC', $taxonomy = 'wavelengthcat' ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( $terms ) {
        $ordered = array();
        foreach ( $terms as $term ) {
            if ( isset( $term->$orderby ) ) {
                $ordered[$term->$orderby] = $term;
            }
        }
        if ( strtoupper( $order ) == 'DESC' ) {
            $func = 'krsort';
        } else {
            $func = 'ksort';
        }
        $func( $ordered );
        return $ordered;
    }
}

function get_the_terms_orderby_termorder($taxonomy){
	global $post;
	$terms = get_the_terms($post->ID, $taxonomy);
	$array = array();
	foreach($terms as $term){
	        $array[$term->term_order] = (object)array(
	            "term_id"          => $term->term_id,
	            "name"             => $term->name,
	            "slug"             => $term->slug,
	            "term_group"       => $term->term_group,
	            "term_order"       => $term->term_order,
	            "term_taxonomy_id" => $term->term_taxonomy_id,
	            "taxonomy"         => $term->taxonomy,
	            "description"      => $term->description,
	            "parent"           => $term->parent,
	            "count"            => $term->count,
	            "object_id"        => $term->object_id
	        );
	}
	ksort($array);
	$array = (object)$array;

	return $array;
}

//波長配下の絞り込み
// function wavesearch(){
// 	if(isset($_GET["nanowave"])) {
// 	// セレクトボックスで選択された値を受け取る
// 	$wave = $_GET["nanowave"]."&".$_GET["mwat"]."&".$_GET["wat"];

// 	// 受け取った値を画面に出力
// 	return $wave;
// 	}
// }

function fwsearch(){
	$input_words = $_GET['s'];//検索文字
	$string = mb_substr($input_words,-1);//ラスト１文字取得
		if($string === "ー"){
			$input_words = mb_substr($_GET['s'], 0, -1);//$wordが「あいー」だった場合、文末１文字消されて「あい」に
		}
	// 受け取った値を画面に出力
	return $input_words;
}

// mWとWのチェックボックスをAND検索からOR検索に変更
// function change_pre_get_posts($query) {

//     // 管理画面,メインクエリ以外に干渉しないため
//     if ( is_admin() || ! $query->is_main_query() ){
//         return;
//     }

//     // カスタム投稿タイプが製品ページ「product」だけ、以下のクエリ変更を行う。
//     if($query->is_post_type_archive( 'product' )) {

// 		// OR検索に
//         $meta_query = [
//             'relation' => 'LIKE',
//         ];

//         // 製品の出力（mW）
//         if(!empty($_GET['mwat[]']) and is_array($_GET['mwat[]'])) {
//             $sub_meta_query = [
//                 'relation' => 'LIKE',
//             ];
//             foreach ($_GET['mwat[]'] as $index => $m_wat) {
//                 $sub_meta_query[] = [
//                     'key'     => 'mw',
//                     'value'   => $m_wat,
//                     'compare' => '='
//                 ];
//             }
//             $meta_query[] = $sub_meta_query;
//         }

//         // 製品の出力（W）
//         if(!empty($_GET['wat[]']) and is_array($_GET['wat[]'])) {
//             $sub_meta_query = [
//                 'relation' => 'LIKE',
//             ];
//             foreach ($_GET['wat[]'] as $index => $wat_status) {
//                 $sub_meta_query[] = [
//                     'key'     => 'w',
//                     'value'   => $wat_status,
//                     'compare' => '='
//                 ];
//             }
//             $meta_query[] = $sub_meta_query;
//         }
        
//         $query->set('meta_query', $meta_query);
//     }
// }
// add_action( 'pre_get_posts', 'change_pre_get_posts' );