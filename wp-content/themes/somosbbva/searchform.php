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

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" style="padding-right: 30%;" id="<?php echo $unique_id; ?>" class="search-field" placeholder="Presiona Enter para Buscar" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="screen-reader-text"></span></button>
</form>
