<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_anesc_htmle_error_404_Page
 *
 * @package Lessons
 */
get_header();
?>
 
<section class="no-results not-found text-center fourzerofour">
    <div class="container"> 
        <div class="error_icon">
            <?php esc_html_e('404','lessons'); ?>
        </div> 
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'lessons' ); ?></h1>
        </header><!-- .page-header -->
        <div class="page-content">
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'lessons' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .page-content -->
    </div>
</section><!-- .no-results -->
<?php
get_footer();
