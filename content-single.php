<?php
/**
 * The template for displaying single posts.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
	<div class="inside-article">
	
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
			<!-- Child theme code -->

			<!-- This code uses CSS inline style attribute to attach hero image as a CSS background -->
			<!-- Note that get_field('hero_image') returns the path to the image, not the image itself -->
			<!-- So this code outputs that path into the inline CSS -->
			<section class="c-post-hero" style="
				<?php if( get_field('hero_image') ): ?>
						background-image: url(<?php the_field('hero_image'); ?>)
				<?php endif; ?>"
			>
				<div class="c-post-hero__content">
					<!-- title -->
					<h1 class="c-post-hero__title"><?php the_title() ?></h1>

					<!-- subheading -->
					<?php if( get_field('subhead') ): ?>
						<p class="c-post-hero__subhead"><?php the_field('subhead'); ?></p>
					<?php endif; ?>

					<!-- date -->
					<?php if( get_field('date') ): ?>
						<p class="c-post-hero__date">
							<?php 
								// convert date into format readable by PHP, and then convert it into a string
								echo date ("F Y", strtotime(get_field('date')));	
							?>
						</p>
					<?php endif; ?>
				</div>
			</section>

			<!-- End child theme code -->
			
			<header class="entry-header">
				
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
		?>

		<div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
			
		</div>

		<?php
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
