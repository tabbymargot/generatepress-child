<!-- CUSTOM CODE STARTS HERE -->
  <a href="<?php the_permalink(); ?>">
    <h1>
      Check out <?php the_title(); ?>!
    </h1>
  </a>
  <!-- This code uses CSS inline style attribute to attach hero image as a CSS background -->
  <!-- Note that get_field('hero_image') returns the path to the image, not the image itself -->
  <!-- So this code outputs that path into the inline CSS -->
  <section class="c-post-hero" style="
    <?php 
      //In the video he removes the conditional 'if' part of this code - I think this a mistake
      if( get_field('hero_image') ):
      //Custom function
      nice_background('hero_image');
      endif; 
    ?>"
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
            //custom function defined in functions.php and called here
            nice_date(get_field('date'));
            // echo date ("F Y", strtotime(get_field('date')));	
          ?>
        </p>
      <?php endif; ?>
    </div>
  </section>

<!-- CUSTOM CODE ENDS HERE -->