<?php

/**
 * Template part for displaying results in search pages.
 *
 * @package FRAFCA_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<p></p>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php frafca_theme_posted_on(); ?> / <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?> / <?php frafca_theme_posted_by(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo get_the_excerpt(); ?>
	</div><!-- .entry-summary -->


</article><!-- #post-## -->