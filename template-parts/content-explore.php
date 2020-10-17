<?php
  // organise our options into a data object
  $args = array(
    'posts_per_page' => 3,
    'orderby' => 'rand',
    //exclude current post (grabs the ID of the current post)
    'post__not_in' => array($post->ID)
  );

  // a variable with our query and options
  $query = new WP_Query( $args );

  // do a loop with our new query code 
  if ($query->have_posts()): while ($query->have_posts()): $query->the_post(); ?>
  
    <!-- code as we’re used to already! -->
    <a href="<?php the_permalink(); ?>">
      <h1><?php the_title(); ?></h1>
    </a>
<?php endwhile; endif; ?>