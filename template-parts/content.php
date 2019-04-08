<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lessons
 */
?>
<div id="post-<?php the_ID(); ?>" class="col-md-12 col-sm-12 col-xs-12 col-xxs-12 cb "> 
    <div class="blog-post">
		<?php if(has_post_thumbnail()): ?>
	        <div class="blog-post__image-wrap">
		        <?php $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'lessons'); 
		            $image_url = $image_src[0];
		            $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
		        ?>
				<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">  
	        </div>
        <?php endif; ?>
        <div class="blog-post__text-content">
            <h3 class="blog-post__title">
	            <?php if(is_sticky()): ?>
	                <i class="dashicons dashicons-admin-post"></i>
	            <?php endif; ?> 
	            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="blog-meta">
                <span class="blog-meta__date"><i class="fa fa-calendar"></i> <?php lessons_posted_on(); ?></span> 
                <span class="blog-meta__post-by"><i class="fa fa-user"></i> <?php esc_html_e('By','lessons'); ?> <?php the_author(); ?></span> 
                <a href="#" class="blog-meta__comments"><i class="fa fa-comments"></i> <?php comments_number( 
                    __('No comments','lessons'), 
                    __('1 comment','lessons'), 
                    __('% comments','lessons') 
                    ); ?>
                </a>
            </div> 
            <?php the_excerpt(); ?> 
        </div>
    </div><!--/.blog-post-->
</div>