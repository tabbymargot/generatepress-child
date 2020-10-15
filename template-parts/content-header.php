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