<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Lessons
 */
/**
 * Adds custom classes to the array of body classes.
 */
function lessons_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'lessons_body_classes' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function lessons_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'lessons_pingback_header' );
/**
 * Pagination
 */  
function lessons_pagination($numpages = '', $pagerange = '', $cpaged='',$next='',$prev='') {
	if (empty($pagerange)) {
		$pagerange = 2;
	}
	global $cpaged;
	if (empty($cpaged)) {
		$cpaged = 1;
	}
	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if(!$numpages) {
		    $numpages = 1;
		}
	}
	if($next==''){
		$next = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
	}
	if($prev==''){
		$prev = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	}
	$cpaged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
  	$pagination_args = array(
		'base'      => $pagenum_link,
		'format'    => $format,
		'total'     => $numpages,
		'current'   => $cpaged,
		'mid_size'  => $pagerange,
		'show_all'  => true,
		'add_args'  => array_map( 'urlencode', $query_args ),
		'prev_text' => $prev,
		'next_text' => $next,
		'type'      => 'list',
  	);
  	$paginate_links = paginate_links($pagination_args);
  	if ($paginate_links) { 
  		echo wp_kses_post($paginate_links); 
  	} 
} 
/**
 * Sidebar post count html append
 */  
function lessons_categories_archive_postcount_filter ($variable) {
	$variable = str_replace('(', '<span class="count">(', $variable);
 	$variable = str_replace(')', ')</span>', $variable);
    return $variable;
}
add_filter('wp_list_categories','lessons_categories_archive_postcount_filter');
add_filter('get_archives_link','lessons_categories_archive_postcount_filter');
/** 
 * Comment List 
 */
function lessons_comments_list($comment, $args, $depth) { ?> 
    <div id="comment-<?php comment_ID() ?>" class="author-info depth-<?php echo esc_attr($depth); ?> <?php echo ($depth>1) ? 'child' : ''; ?>">
        <?php if(get_avatar( $comment, 110 )): ?>
            <div class="author-info__photo">
                <?php echo get_avatar( $comment, 110 ); ?>
            </div>
        <?php endif; ?> 
        <div class="author-info__text-content">
            <h4 class="author-info__name"><?php comment_author(); ?></h4>
            <span class="author-info__date"><?php echo get_comment_date( 'M n, Y, g:i a', $comment ) ; ?></span>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?> 
            <?php comment_text(); ?>
        </div>
        <div class="clear"></div> 		 
<?php } 
/** 
 * Comment Form MOdify 
 */
function lessons_comment_fields($fields) {
    $wpxonbutton = '';
    if(is_user_logged_in()){
        $wpxonbutton = '<button type="submit" class="btn">Submit</button>';
    }
    
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
    unset($fields['url']);
    $fields['author'] = '<div class="name-email-website"><input type="text" class="form-control form-group__input" placeholder="' . esc_attr('Name', 'lessons') . '" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '">';
    $fields['email'] = '<input type="email" class="form-control form-group__input" placeholder="' . esc_attr('E-Mail', 'lessons') . '" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '">';
    $fields['url'] = '<input class="form-control form-group__input" name="url" type="text" placeholder="' . esc_attr('Website', 'lessons') . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></div>';
    return $fields;
}
add_filter('comment_form_default_fields','lessons_comment_fields');
/** 
 * Comment args change
 */
add_filter( 'comment_form_defaults', 'lessons_comment_form_allowed_tags' );
function lessons_comment_form_allowed_tags( $defaults ) { 
	$defaults['class_submit'] = '';  
	$defaults['title_reply_before'] =  '<div class="section-heading sm-padding"><h2>';
	$defaults['title_reply_after'] =  '</h2></div>';
    $defaults['comment_notes_before'] =  esc_html__( '&nbsp;','lessons' ); 
    $defaults['comment_field'] = '';
	$defaults['label_submit'] =  esc_html__( 'Post Comment','lessons' ); 
	return $defaults;
}
 
/** 
 * Comment form field order
 */
add_action( 'comment_form_after_fields', 'lessons_add_textarea' );
add_action( 'comment_form_logged_in_after', 'lessons_add_textarea' );
function lessons_add_textarea(){
    echo '<textarea id="comment" name="comment" cols="30" rows="4" class="form-control commtent-text-input" placeholder="' . esc_attr('Comment', 'lessons') . '" required></textarea><button type="submit" class="btn">'. esc_html__('Submit','lessons') .'</button>';
} 
/** 
 * Get post vews.
 */ 
function lessons_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
/** 
 * Set post views.
 */  
function lessons_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/** 
 * Nav Menu (Main)
 */   
function lessons_main_menu($style=1){ 
    wp_nav_menu( array(
        'theme_location'    => 'mainmenu',
        'depth'             => 3,
        'container'         => false,
        'menu_id'           => 'lessons-main-menu',
        'menu_class'        => 'menu-list',  
        'fallback_cb'       => 'lessons_default_menu'
    ));
}   
/** 
 * Nav Menu (Mobile)
 */   
function lessons_mobile_menu(){ 
    wp_nav_menu( array(
        'theme_location'    => 'mobilemenu',
        'depth'             => 3,
        'container'         => false,
        'menu_id'           => 'lessons-mobile-menu',
        'menu_class'        => 'menu-accordion',  
        'fallback_cb'       => 'lessons_default_menu'
    ));
}   
/**
 * Fallback menu 
 */
function lessons_default_menu() {
    ?>
    <ul class="menu-list"> 
        <li>
            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="nav-link"><?php esc_html_e( 'ADD MENU', 'lessons'); ?></a> 
        </li>                
    </ul>
    <?php
}  
/**
 * Logo 
 */
function lessons_logo(){
   $logo = get_custom_logo(); 
    if( !empty($logo) ){
        the_custom_logo();
       }else{ ?> 
      <a class="logo-index" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span><?php bloginfo( 'name' ); ?></span></a>
   <?php } 
}
/**
 * Copyright 
 */
function lessons_copyright(){ 
    $copy_text = get_theme_mod( 'v_copyright_text' );
    if(!empty($copy_text)){
    ?>
        <p><?php echo wp_kses_post($copy_text); ?></p>
    <?php
    }else{
        $url2 =  esc_url('http://wpxon.com/'); 
        $text =  esc_html__('Copyright &copy; 2019 ','lessons');
        $text2 =  get_bloginfo('name');
        $text3 =  ' |';
        $text4 = $text.$text2.$text3;
        $text5 =  esc_html__('Wpxon','lessons');
        printf( '<p>%s Powered by <a class="credits" href="%s">%s</a></p>', esc_html($text4), esc_url($url2), esc_html($text5) );
    }
}
/**
 * BreadCrumb 
 */ 
function lessons_breadcrumb(){
  $lessons_header_default_text = get_theme_mod( 'header_default_text' );
  $lessons_title=  (!empty($lessons_header_default_text)) ? $lessons_header_default_text : esc_html__('Blog','lessons');
  if(is_front_page() && is_home()){ 
    echo esc_html($lessons_title); 
  }elseif(is_home() || is_page()){ 
      if( is_page()){
          $lessons_ptitle = get_the_title();
    }else{
      $lessons_ptitle =  get_the_title( get_option('page_for_posts', true) );
    }
    echo esc_html($lessons_ptitle);
  }elseif(is_single()){
    the_title();
  }elseif(is_search()){    
    echo get_search_query(); 
  }elseif(is_category() || is_tag()) {
    single_cat_title("", true);
  }elseif(is_archive()){ 
    if ( class_exists('WooCommerce' ) ){
      if(is_shop() || is_product_category() || is_product_tag() ){
        woocommerce_page_title(); 
      }else{ 
        echo get_the_date('F Y'); 
      } 
    }else{ 
      echo get_the_date('F Y'); 
    }
  }elseif(is_404()){ 
    esc_html_e('404 Not Found','lessons');
  }else{ 
    the_title();
  }
}

 