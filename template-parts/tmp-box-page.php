<?php
/**
 * Template Name: Page Box Width 
 *
 * @package Lessons
 */
get_header();
?> 
	<div class="container"> 	
		<?php 
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 
				the_content();
			endwhile; 
		?>  
	</div>  
<?php get_footer();
