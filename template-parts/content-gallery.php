<?php 
  $images = get_sub_field('gallery') 
?>

<?php foreach($images as $image) : ?>

  <div class="c-gallery-image">
    <?php 
      // get each image by its ID and the size we want
      echo wp_get_attachment_image($image['id'], 'full');
    ?>
    <?php
      //Set variable to hold caption
      $caption = wp_get_attachment_caption($image['id']);
    ?>

    <?php 
      //Check to see if $caption is/isn't empty
      if(!empty($caption)) :
    ?>

      <p class="o-caption">
        <?php 
          // If it's not empty, echo $caption
          echo $caption; 
        ?>
      </p>
      
    <?php  endif; ?>	
  </div>
    
<?php endforeach; ?>