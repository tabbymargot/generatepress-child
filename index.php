<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			//I HAVE COMMENTED OUT THE DEFAULT LOOP, AS I'M RUNNING A WP_QUERY BELOW

			// if ( generate_has_default_loop() ) {
			// 	if ( have_posts() ) :

			// 		while ( have_posts() ) :

			// 			the_post();

						

			// 		endwhile;

			// 		/**
			// 		 * generate_after_loop hook.
			// 		 *
			// 		 * @since 2.3
			// 		 */
			// 		do_action( 'generate_after_loop', 'index' );

			// 	else :

			// 		generate_do_template_part( 'none' );

			// 	endif;
			// }

			//CUSTOM CODE STARTS HERE
					
				// we can also do our options like this too

				//Get one post which is a random one each time, and store in $query variable
				$query = new WP_Query('posts_per_page=1&orderby=rand');

				if ($query->have_posts()): while ($query->have_posts()): $query->the_post();

					// get the id for our current post and store it in a variable
					//$hero_post is a global variable, and is used in content-navigate.php. More notes there.
					$hero_post = get_the_ID();

					//run this content
					get_template_part('template-parts/content-hero');

				endwhile; endif;
					get_template_part('template-parts/content-about');
					get_template_part('template-parts/content-navigate');
					get_template_part('template-parts/content-bio');
			
					//CUSTOM CODE ENDS HERE

			// generate_do_template_part( 'index' );

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main>
	</div>

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

	get_footer();
