<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lessons
 */    
?>
        <footer class="lessons-footer dark-footer">  
            <div class="copyright-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="footer-logo-wrap text-center">
                                <?php lessons_copyright(); ?> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </footer>
    </div> <!-- lessons-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
