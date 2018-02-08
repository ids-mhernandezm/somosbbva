<?php
/**
 * Template for displaying search forms in Custom Template
 *
 * @package WordPress
 * @subpackage Somos BBVA
 * @since 1.0
 * @version 1.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="input" size="35" class="search-field" placeholder="Presiona Intro para Buscar" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="screen-reader-text"></span></button>
</form>
