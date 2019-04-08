<?php
/**
 * Template Name: Post Box Width
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lessons
 */ 
get_header();
	while ( have_posts() ) : the_post(); 
	?>
	 
	    <div class="main-content main-content--small-gap">
	        <div class="container">
	            <div class="row"> 
	                <div class="col-md-12">
	                    <div class="blog-detail-wrapper">
							<?php if(has_post_thumbnail()): ?>
						        <?php $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'lessons'); 
						            $image_url = $image_src[0];
						            $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
						        ?>
		                        <div class="image blog-details-img">
		                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
		                        </div>
							<?php endif; ?> 
	                        <div class="blog-details-text mt50">
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
	                            <h2 class="blog-detail-title"><?php the_title(); ?></h2>
	                            <?php the_content(); 
					                wp_link_pages( array(
					                    'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'lessons' ),
					                    'after'       => '</div>',
					                    'link_before' => '<span class="page-number">',
					                    'link_after'  => '</span>',
					                ) ); 
					                global $numpages;
					                if ( is_singular() && $numpages > 1 ) {
					                      if ( is_singular( 'attachment' ) ) {
					                        // Parent post navigation.
					                        the_post_navigation( array(
					                          'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'lessons' ),
					                        ) );
					                      } elseif ( is_singular( 'post' ) ) {
					                        // Previous/next post navigation.
					                        the_post_navigation( array(
					                          'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next - ', 'lessons' ) . '</span> ' . 
					                            '<span class="post-title">%title</span>',
					                          'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous - ', 'lessons' ) . '</span> ' . 
					                            '<span class="post-title">%title</span>',
					                        ) );
					                      }
					                } 
					            ?>
	                            <div class="row mb20">
	                                <div class="col-sm-12">
	                                    <div class="tag-list mb20">
	                                    	<?php the_tags( '', '', '' ); ?> 
	                                    </div>
	                                </div> 
	                            </div>
	                            <?php $author_desc = get_the_author_meta( 'designation' ); ?>
	                            <?php if($author_desc): ?>
		                            <div class="author-info author-info-border">
		                            	<?php $lessons_avatar = get_avatar( get_the_author_meta( 'ID' ), 110 ); ?>
				                		<?php if($lessons_avatar): ?> 
			                                <div class="author-info__photo">
			                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 110 ); ?>
			                                </div>
					            		<?php endif; ?>
		                                <div class="author-info__text-content">
		                                    <h4 class="author-info__name"><?php the_author(); ?></h4><span class="author-info__designation"><?php the_author_meta( 'designation' ); ?></span>
		                                    <p><?php the_author_meta( 'description' ); ?></p>
		                                </div>
		                                <div class="clear"></div>
		                            </div>
		                        <?php endif; ?>
								<?php 
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?> 
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="pdt50"></div>
	 
	<?php 
	endwhile;
get_footer();
