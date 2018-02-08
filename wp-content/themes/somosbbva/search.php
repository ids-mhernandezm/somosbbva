<?php
/**
* The template for displaying search results pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package WordPress
* @subpackage Twenty_Seventeen
* @since 1.0
* @version 1.0
*/

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>


			<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>

			<div id="results" class="container">
			<?php
		// Start the loop.
			while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			?>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
					<?php echo get_post_type(); ?>

					
				</article><!-- #post-## -->
			</div>

			<?php

		// End the loop.
		endwhile;

		?>
		</div>
		<?php

		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( 'Anterior', 'twentysixteen' ),
			'next_text'          => __( 'Siguiente', 'twentysixteen' ),
			'screen_reader_text' => __( 'Más resultados...','twentysixteen'),
		) );

	// If no content, include the "No posts found" template.
	else :
		?>
		<section class="no-results not-found">

			<h1 class="page-title"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h1>


			<div class="page-content">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentysixteen' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentysixteen' ); ?></p>


				<?php else : ?>

					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentysixteen' ); ?></p>


				<?php endif; ?>
			</div><!-- .page-content -->
		</section><!-- .no-results -->

		<?php

	endif;
	?>

</main><!-- .site-main -->
</section><!-- .content-area -->

<?php get_footer(); ?>
