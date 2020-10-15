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
			if( get_row_layout() == 'header' ): ?>

				<!-- Header wrapper -->
				<div class="c-single-post-header c-single-post-header@m">

					<!-- Header image -->
					<div class="c-single-post-header-image c-single-post-header-image@m" style="
						<?php 
							//In the video he removes the conditional 'if' part of this code - I think this a mistake, as if there's no hero image in ACF the page doesn't load at all.
							if( get_field('hero_image') ):
							//Custom function
							nice_background('hero_image');
							endif; 
						?>"
					>
					</div>

					<!-- Header content -->
					<div class="c-single-post-header-content c-single-post-header-content@m">
						<!-- data shared from our hero -->
						<div class="c-single-post-header-content-wrapper">
							<p class="c-single-post-header-date">
								<?php 
									// convert date into format readable by PHP, and then convert it into a string
									//custom function defined in functions.php and called here
									nice_date(get_field('date'));
								?>
							</p>
								<!-- standard wordpress data -->
								<h1 class="c-single-post-header-title">
									<?php the_title(); ?>
								</h1>
								
								<p class="c-single-post-header-subhead">
									<?php the_field('subhead'); ?>
								</p>
								<!-- specific to this component (ACF calls components 'layouts') -->
								<p class="c-single-post-header-description">
									<?php the_sub_field('header_intro'); ?>	
								</p>
						</div>	
					</div>
				</div>
			
			<?php 
				//If there's no header, check for a 'text-block', and then echo out the data:
				elseif( get_row_layout() == 'text_block' ): ?>

				<div class="c-single-post-textblock">
					<?php the_sub_field('text_content'); ?>
				</div>

			<?php endif; 
		endwhile; endif; 
		?>

		<?php 
			// get an image by its ID and the size we want
			echo wp_get_attachment_image(50, 'full'); 
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
