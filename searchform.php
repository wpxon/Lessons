<?php 
/**
 * The template for displaying search form.
 * 
 * @package Lessons
 */ 
?>
<form class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>"> 
	<input type="search" class="form-control widget-search__text-field" placeholder="<?php echo esc_attr( 'Search', 'lessons' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" class="widget-search__submit"><i class="fa fa-search"></i></button>
</form>