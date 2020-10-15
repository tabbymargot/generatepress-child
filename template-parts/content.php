<?php
/**
 * The template for displaying posts within the loop.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>

	<div class="inside-article">

		<!-- CUSTOM CODE STARTS HERE -->
		<?php 
			// Checks for a row called content:
			if( have_rows('content') ): while ( have_rows('content') ) : the_row();

			// If 'content' exists, check for a row layout called 'header', and if it exists, go through the data and echo it out:
			if( get_row_layout() == 'header' ): 

			get_template_part( 'template-parts/content-header', get_post_type() );
		?>
			
			<?php 
				//If there's no header, check for a 'text-block', and then echo out the data:
				elseif( get_row_layout() == 'text_block' ): ?>
	
			<?php
				get_template_part( 'template-parts/content-text', get_post_type() );
			?>

			<?php 
				elseif ( get_row_layout() == 'gallery' ):
			?>

			<?php
				get_template_part( 'template-parts/content-gallery', get_post_type() );
			?>

			<?php endif; 
		endwhile; endif; 
		?>

		
		<!-- CUSTOM CODE ENDS HERE -->

		<?php
		/**
		 * generate_before_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_featured_page_header_inside_single - 10
		 */
		do_action( 'generate_before_content' );

		if ( generate_show_entry_header() ) :
			?>

			<header class="entry-header">

				<!-- CUSTOM CODE STARTS HERE -->

			

				<!-- CUSTOM CODE ENDS HERE -->

				<?php
				/**
				 * generate_before_entry_title hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_before_entry_title' );

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}

				/**
				 * generate_after_entry_title hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_post_meta - 10
				 */
				do_action( 'generate_after_entry_title' );
				?>
			</header>
			<?php
		endif;

		/**
		 * generate_after_entry_header hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_post_image - 10
		 */
		do_action( 'generate_after_entry_header' );

		$itemprop = '';

		if ( 'microdata' === generate_get_schema_type() ) {
			$itemprop = ' itemprop="text"';
		}

		if ( generate_show_excerpt() ) :
			?>

			<div class="entry-summary"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
				<?php the_excerpt(); ?>
			</div>

		<?php else : ?>

			<div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>

				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<?php
		endif;

		/**
		 * generate_after_entry_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_footer_meta - 10
		 */
		do_action( 'generate_after_entry_content' );

		/**
		 * generate_after_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_content' );
		?>
	</div>
</article>
