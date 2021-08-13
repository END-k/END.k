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
}
add_action('init', 'new_post_product');