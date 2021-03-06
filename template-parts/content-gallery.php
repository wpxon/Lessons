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
          <?php $lessons_gallery_items = get_post_meta( get_the_ID(), '_lessons_post_galery_list', 1 ); ?>
            <?php if(!empty($lessons_gallery_items)): ?>  
              <div class="blog-post__image-wrap">
                <div id="blog-carousel" class="owl-carousel blog-carousel item1-carousel nf-carousel-theme">
                  <?php foreach ( (array) $lessons_gallery_items as $attachment_id => $attachment_url ) { 
                    $image_src = wp_get_attachment_image_src($attachment_id,'lessons'); 
                    $image_url = $image_src[0];
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                   ?> 
                    <div class="item"> <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" /> </div>  
                    <?php } ?> 
                </div>  
              </div>  
          <?php else: ?> 
            <?php if(has_post_thumbnail()): ?>
                <div class="blog-post__image-wrap">
                    <?php $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'lessons'); 
                        $image_url = $image_src[0];
                        $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                    ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">  
                </div>
            <?php endif; ?>
          <?php endif; ?>
        <div class="blog-post__text-content">
            <div class="blog-meta">
                <span class="blog-meta__date"><?php lessons_posted_on(); ?></span>
                <span class="blog-meta__separator">|</span>
                <span class="blog-meta__post-by"><?php esc_html_e('by','lessons'); ?> <?php the_author(); ?></span>
                <span class="blog-meta__separator">|</span>
                <a href="#" class="blog-meta__comments"><?php comments_number( 
                    __('No comments','lessons'), 
                    __('1 comment','lessons'), 
                    __('% comments','lessons') 
                    ); ?>
                </a>
            </div> 
            <h3 class="blog-post__title">
	            <?php if(is_sticky()): ?>
	                <i class="dashicons dashicons-admin-post"></i>
	            <?php endif; ?> 
	            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="blog-post__read-more"><?php esc_html_e('Read More','lessons'); ?></a>
        </div>
    </div><!--/.blog-post-->
</div>