<?php
/**
 * Template Name: Blog 2 Column
 *
 * @package Lessons
 */
get_header(); ?>

    <div class="main-content">
        <div class="container">
            <div id="masonry-loop" class="row">  
                <?php 
                    /* Start the Loop */
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    $lessons_post_query = new WP_Query(array( 'post_type'=> 'post','paged' => $paged ));
                    while ( $lessons_post_query->have_posts() ) : $lessons_post_query->the_post(); 
                        get_template_part( 'template-parts/content','2' );  
                    endwhile; 
                ?> 
            </div>   
            <div class="row mt30 mb20">
                <?php lessons_pagination($lessons_post_query->max_num_pages,"",$paged); ?>
            </div>
        </div>
    </div> 
<?php get_footer();
