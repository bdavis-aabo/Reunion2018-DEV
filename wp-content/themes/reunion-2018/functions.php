<?php
// Theme Functions

/* bootstrap nav walker */
require_once get_template_directory() . '/assets/_inc/class-wp-bootstrap-navwalker.php';

// Instagram Feed functions
require_once get_template_directory() . '/assets/_inc/wp-instagram-feed.php';

/* Remove Admin Bar from Frontend */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar(){
  show_admin_bar(false);
}

/* Remove Comments from Admin Bar */
function remove_comments(){
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render','remove_comments');

if (function_exists('add_theme_support')){
  // Add Menu Support
  add_theme_support('menus');

  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true);  		// Large Thumbnail
  add_image_size('medium', 250, '', true); 		// Medium Thumbnail
  add_image_size('small', 125, '', true);  		// Small Thumbnail
  add_image_size('custom-size', 700, 200, true);  // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');
}

add_action('after_setup_theme', 'menu_setup');
if(!function_exists('menu_setup')):
  function menu_setup() {
    register_nav_menu('community', __('Community Navigation', 'reunion-2018'));
    register_nav_menu('metro', __('Metro Navigation', 'reunion-2018'));
  }
endif;

function wpt_register_js(){
  if( !is_admin()){
    wp_deregister_script('jquery');
  }

	wp_register_script('jquery', '//code.jquery.com/jquery-3.3.1.min.js', 'jquery', '', false);
  wp_register_script('jquery.popper.min', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', '', false);
	wp_register_script('jquery.bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', 'jquery', '', false);
	wp_register_script('jquery.extras.min', get_template_directory_uri() . '/assets/js/main.min.js', 'jquery', '', true);
	if(!is_admin()){
	  wp_enqueue_script('jquery');
    wp_enqueue_script('jquery.popper.min');
    wp_enqueue_script('jquery.bootstrap.min');
    wp_enqueue_script('jquery.extras.min');
  }
}

function wpt_register_css(){
  wp_register_style('bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
  wp_register_style('fontawesome.min', '//use.fontawesome.com/releases/v5.5.0/css/all.css');
  wp_register_style('main.min', get_template_directory_uri() . '/assets/css/main.min.css');
  wp_enqueue_style('bootstrap.min');
  wp_enqueue_style('fontawesome.min');
  wp_enqueue_style('main.min');
}
add_action('init','wpt_register_js');
add_action('wp_enqueue_scripts', 'wpt_register_css');

// Add Class to Images posted on pages
function add_responsive_class($content){
  $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
  $document = new DOMDocument();

  libxml_use_internal_errors(true);
  if(!empty($content)): $document->loadHTML(utf8_decode($content)); endif;

  $imgs = $document->getElementsByTagName('img');
  foreach($imgs as $img){
    $existing_class = $img->getAttribute('class');
    $img->setAttribute('class', 'img-fluid ' . $existing_class);
  }
  $html = $document->saveHTML();
	      return $html;
}
add_filter('the_content', 'add_responsive_class');

// Create Post Type for Homebuilders
add_action('init','create_home_builders');
function create_home_builders(){
  register_post_type('home_builders', array(
    'label'           =>	__('Home Builders'),
		'singular_label'	=>	__('Home Builder'),
		'public'          =>	true,
		'show_ui'         =>	true,
		'capability_type'	=>	'post',
		'hierarchical'		=>	'true',
		'rewrite'         =>	array('slug' => 'homebuilder'),
		'supports'        =>	array('title','author','excerpt','thumbnail','custom-fields','order','page-attributes'),
		'menu_position'		=>	21,
		'menu_icon'       =>	'dashicons-admin-home',
		'has_archive'     =>	false,
  ));
}

// Create Post Type for Quick Move-ins
add_action('init','create_quick_moves');
function create_quick_moves(){
  register_post_type('quickmoves',array(
    'label'           =>	__('Quick Move-Ins'),
		'singular_label'	=>	__('Quick Move-In'),
		'public'          =>	true,
		'show_ui'         =>	true,
		'capability_type'	=>	'post',
		'hierarchical'		=>	'true',
		'rewrite'         =>	array('slug' => 'quick-moveins'),
		'supports'        =>	array('title','custom-fields','order','page-attributes'),
		'menu_position'		=>	22,
		'menu_icon'       =>	'dashicons-admin-home',
		'has_archive'     =>	true,
  ));
}

// Create Taxonomies for Builders (quick move-ins)
add_action('init','builder_taxonomies',0);
function builder_taxonomies(){
  $_labels = array(
    'name'              =>	_x('Builders','taxonomy general name'),
		'singular_name'     =>	_x('Builder', 'taxonomy singular name'),
		'search_items'		  =>	__('Search Builders'),
		'all_items'         =>	__('All Builders'),
		'parent_item'       =>	__('Parent Builder'),
		'parent_item_colon'	=>	__('Parent Builder:'),
		'edit_item'         =>	__('Edit Builder'),
		'update_item'       =>	__('Update Builder'),
		'add_new_item'      =>	__('Add New Builder'),
		'new_item_name'     =>	__('New Builder Name'),
		'menu_name'         =>	__('Builders'),
  );
  $_args = array(
    'hierarchical'      =>	true,
		'labels'            =>	$_labels,
		'show_ui'           =>	true,
		'show_admin_column'	=>	true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'         =>	true,
		'rewrite'           =>	array('slug' => 'builder'),
  );
  register_taxonomy('builder','quickmoves',$_args);
}

// Create Post Type for Alerts
add_action('init','create_alerts');
function create_alerts(){
  register_post_type('alerts', array(
    'label'           =>	__('Alerts'),
		'singular_label'	=>	__('Alert'),
		'public'          =>	true,
		'show_ui'         =>	true,
		'capability_type'	=>	'post',
		'hierarchical'		=>	'true',
		'rewrite'         =>	array('slug' => 'alerts'),
		'supports'        =>	array('title','custom-fields','order','page-attributes'),
		'menu_position'		=>	24,
		'menu_icon'       =>	'dashicons-megaphone',
		'has_archive'     =>	true,
  ));
}

// Create Post Type for Promotions
add_action('init','create_promos');
function create_promos(){
  register_post_type('promos', array(
    'label'           =>	__('Promotions'),
		'singular_label'	=>	__('Promotion'),
		'public'          =>	true,
		'show_ui'         =>	true,
		'capability_type'	=>	'post',
		'hierarchical'		=>	'true',
		'rewrite'         =>	array('slug' => 'promos'),
		'supports'        =>	array('title','custom-fields','order','page-attributes'),
		'menu_position'		=>	25,
		'menu_icon'       =>	'dashicons-megaphone',
		'has_archive'     =>	true,
  ));
}

// Create Widget Areas
function reunion_sidebar_widget(){
  register_sidebar(array(
    'name'  =>  'Blog Sidebar',
    'id'    =>  'blog-sidebar',
    'before_widget' =>  '<div class="blog-sidebar-widget">',
    'after_widget'  =>  '</div>',
    'before_title'  =>  '<h3 class="widget-title">',
    'after_title'   =>  '</h3>',
  ));
}
add_action('widgets_init','reunion_sidebar_widget');

/*Contact form 7 remove span*/
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    $content = str_replace('<br />', '', $content);

    return $content;
});

function is_child(){
  global $post;
  if(is_page() && $post->post_parent > 0){
    return true;
  } else {
    return false;
  }
}

/* Excerpt Formatting */
function reunion_excerpt($text){
  $_raw = $text;
  if($text == ''){
    $text = get_the_content('');
    $text = strip_shortcodes($text);
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);

    $_length = apply_filters('excerpt_length', 55);
    $_more   = apply_filters('excerpt_more', ' ' . '...');

    $_words = preg_split('/[\n\r\t ]+/', $text, $_length + 1, PREG_SPLIT_NO_EMPTY);
    if(count($_words) > $_length){
      array_pop($_words);
      $text = implode(' ', $_words);
      $text = force_balance_tags($text);
      $text = $text . $_more;
    } else {
      $text = implode(' ', $_words);
    }
  }
  return apply_filters('wp_trim_excerpt', $text, $_raw);
}
//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
//add_filter('get_the_excerpt', 'reunion_excerpt');


/* Get First Image in Blog Article */
function get_article_image(){
  global $post, $posts;
  $_firstImage = '';
  ob_start();
  ob_end_clean();

  $_output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $_firstImage = $matches[1][0];

  if(empty($_firstImage)){
    $_firstImage = get_template_directory_uri() . '/assets/images/default.png';
  }
  return $_firstImage;
}






















?>
