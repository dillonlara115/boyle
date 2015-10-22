<?php
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) )
require_once($locale_file);

add_action( 'after_setup_theme', 'blankslate_theme_setup' );
function blankslate_theme_setup() {
add_theme_support( 'automatic-feed-links' );
}
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
}
if ( ! isset( $content_width ) ) $content_width = 640;
add_filter('the_title', 'blankslate_title');
function blankslate_title($title) {
if ($title == '') {
return 'Untitled';
} else {
return $title;
}
}
function blankslate_register_menus() {
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ))
);
}
add_action( 'init', 'blankslate_register_menus' );
function blankslate_theme_widgets_init() {
register_sidebar( array (
'name' => 'Primary Widget Area',
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


add_action( 'init', 'blankslate_theme_widgets_init' );

add_action( 'widgets_init', 'services_widget_init' );
function services_widget_init() {
    register_sidebar( array(
        'name' => 'Services Sidebar' ,
        'id' => 'services',
        'description' => __( 'Widgets in this area will be shown on all services pages' ),
        'before_widget' => '<div id="%1$s" class="services-sidebar-container %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="services-sidebar-title">',
	'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'contact_widget_init' );
function contact_widget_init() {
    register_sidebar( array(
        'name' => 'contact Sidebar' ,
        'id' => 'contact',
        'description' => __( 'Widgets in this area will be shown on all contact pages' ),
        'before_widget' => '<div id="%1$s" class="contact-sidebar-container %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="contact-sidebar-title">',
	'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'about_widget_init' );
function about_widget_init() {
    register_sidebar( array(
        'name' => 'About Sidebar' ,
        'id' => 'about',
        'description' => __( 'Widgets in this area will be shown on all about pages' ),
        'before_widget' => '<div id="%1$s" class="services-sidebar-container %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="about-sidebar-title">',
	'after_title'   => '</h2>',
    ) );
}

function staff_directory_init() {
    $args = array(
      'label' => 'Staff',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'staff-directory'),
        'query_var' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title',
            'thumbnail',
            'page-attributes',)
        );
    register_post_type( 'staff_directory', $args );
}
add_action( 'init', 'staff_directory_init' );

// Creates properties custom post type
function properties_init() {
    $args = array(
      'label' => 'Properties',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'properties'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => array(
            'title',
            'thumbnail',
            'page-attributes',)
        );
    register_post_type( 'properties', $args );
}
add_action( 'init', 'properties_init' );


// Creates videos custom post type
function videos_init() {
    $args = array(
      'label' => 'Videos',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'videos'),
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'page-attributes',)
        );
    register_post_type( 'videos', $args );
}
add_action( 'init', 'videos_init' );

// Creates news custom post type
function news_init() {
    $args = array(
      'label' => 'News',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'news'),
        'query_var' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'page-attributes',)
        );
    register_post_type( 'news', $args );
}
add_action( 'init', 'news_init' );

function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(http://www.maxtestdomain.com/boyle/wp-content/themes/boyle/images/boyle-blue-logo.gif);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//sort search results by post type
add_filter('relevanssi_hits_filter', 'products_first');
function products_first($hits) {
    $types = array();
 
    $types['properties'] = array();
    $types['post'] = array();
    $types['staff-directory'] = array();
    $types['page'] = array();
    $types['news'] = array();
 
    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
            if (!is_array($types[$hit->post_type])) $types[$hit->post_type] = array(); 
                array_push($types[$hit->post_type], $hit);     
        }
    }
 
    // Merge back to $hits in the desired order
    $hits[0] = array_merge($types['properties'], $types['post'], $types['staff-directory'], $types['page'], $types['news']);
    return $hits;
}

// array of filters (field key => field name)
$GLOBALS['my_query_filters'] = array( 
    'Choose a Region...'   => 'region_name', 
    'Greater Memphis'   => 'memphis_metro_area',
    'Greater Nashville'   => 'nashville_metro_area',
    'Other Regions'   => 'other'
);


//search results 
add_filter('posts_orderby', 'group_by_post_type', 10, 2);
function group_by_post_type($orderby, $query) {
global $wpdb;
if ($query->is_search) {
    return $wpdb->posts . '.post_type DESC';
}
// provide a default fallback return if the above condition is not true
return $orderby;
}


// action
add_action('pre_get_posts', 'my_pre_get_posts', 10, 1);

function my_pre_get_posts( $query ) {
    
    // bail early if is in admin
    if( is_admin() ) {
        
        return;
        
    }
    
    
    // get meta query
    $meta_query = $query->get('meta_query');

    
    // loop over filters
    foreach( $GLOBALS['my_query_filters'] as $key => $name ) {
        
        // continue if not found in url
        if( empty($_GET[ $name ]) ) {
            
            continue;
            
        }
        
        
        // get the value for this filter
        // eg: http://www.website.com/events?city=melbourne,sydney
        $value = explode(',', $_GET[ $name ]);
        
        
        // append meta query
        $meta_query[] = array(
            'key'       => $name,
            'value'     => $value,
            'compare'   => 'IN',
        );
        
    } 
    
    
    // update meta query
    $query->set('meta_query', $meta_query);

}



// add_filter( "gform_notification_{$form_id}", 'my_custom_function', 10, 3 );
add_filter( 'gform_notification_2', 'change_email_address', 10, 3 );
function change_email_address( $notification, $form, $entry ) {
       // append a signature to the existing notification 
       // message with .=

    $agents = get_field('agent');

    if($agents) { 
        foreach($agents as $agent): 

            $email = get_field('email', $agent->ID);
        endforeach; 
    } 
    
    $notification['from'] .= $email;

    return $notification;
}




//custom select menus on mobile
add_theme_support( 'menus' );
add_action( 'init', 'register_my_menus' );
 
function register_my_menus() {
    register_nav_menus(
        array(
            'mobile-nav' => 'Mobile Navigation'
        ));
}



class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
 
    function start_lvl(&$output, $depth) {    }
 
    function end_lvl(&$output, $depth) {    }
 
    function start_el(&$output, $item, $depth, $args) {
        // Here is where we create each option.
        $item_output = '';
 
        // add spacing to the title based on the depth
        $item->title = str_repeat("&amp;nbsp;", $depth * 4) . $item->title;

        $class_names = in_array("current_page_item",$item->classes) ? ' selected' : '';
 
        // Get the attributes.. Though we likely don't need them for this...
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';
 
        // Add the html
        $item_output .= '<option'. $attributes . $class_names .' >';
        $item_output .= apply_filters( 'the_title_attribute', $item->title );
 
        // Add this new item to the output string.
        $output .= $item_output;
 
    }
 
    function end_el(&$output, $item, $depth) {
        // Close the item.
        $output .= "</option>\n";
 
    }
 
}


add_action('wp_footer', 'dropdown_menu_scripts');
function dropdown_menu_scripts() {
    ?>
        <script>
          jQuery(document).ready(function ($) {
            $("#drop-nav").change( function() {
                    document.location.href =  $(this).val();
            });
          });
        </script>
    <?php
}

$preset_widgets = array (
'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
if ( isset( $_GET['activated'] ) ) {
update_option( 'sidebars_widgets', $preset_widgets );
}
function blankslate_cats($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}
function blankslate_tags($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}
function blankslate_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function blankslate_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php blankslate_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep"> | </span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'blankslate'),
get_comment_date(),
get_comment_time(),
'#comment-' . get_comment_ID() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'blankslate') ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','blankslate'),
'login_text' => __('Log in to reply.','blankslate'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function blankslate_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'blankslate'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'blankslate') ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php }