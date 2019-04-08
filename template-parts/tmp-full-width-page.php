<?php
/**
 * Template Name: Page Full Width 
 *
 * @package Lessons
 */
get_header();
?>
    <div class="lessons-ful"> 	
		<?php 
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 
				the_container();
			endwhile; 
		?>  
	</div> 
<?php get_footer();
