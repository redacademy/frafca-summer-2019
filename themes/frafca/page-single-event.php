<?php
/**
 * The template for displaying all pages.
 *
 * @package FRAFCA_Theme
 * Template Name: page-single-event
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('tribe-events/single-event'); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>