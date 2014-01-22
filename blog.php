<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blog Template
 *
Template Name: Blog (full posts)
 *
 * @file           blog.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/blog.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */
get_header(); ?>

	<div id="content-blog" class="content-area">
		<main id="main" class="<?php echo get_responsive_grid( 'col-8' ); ?>" role="main">

		<?php get_template_part( 'loop-header' ); ?>

		<?php
			if( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}
			$blog_query = new WP_Query( array(
				'post_type' => 'post',
				'paged' => $paged
			) );
		?>

		<?php if ( $blog_query->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php get_template_part( 'loop-nav' ); ?>

		<?php else : ?>

			<?php get_template_part( 'loop-no-posts' ); ?>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div><!-- #content-blog -->

<?php get_footer(); ?>