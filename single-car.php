<?php

get_header();
?>
  <main>
    <div class="content">
        <h1><?php the_title(); ?></h1>         
        <div>
          Description: 
          <?php the_content(); ?>
        </div>
       
        <h2>Feature: </h2>
        <div>
          Brand: 
          <?php the_terms( get_the_ID(), 'Brand', '', '', '' ); ?>
        </div>
        <div>
          Producing country:
          <?php the_terms( get_the_ID(), 'Producing country', '', '', '' ); ?> 
        </div>
        <div>
          Color: <div style="width:20px; height:20px; background-color:<?php echo get_post_meta(get_the_ID(), 'color', true); ?>"></div>              
        </div>
        <div>
          Power: 
          <?php echo get_post_meta(get_the_ID(), 'power', true); ?>   
        </div>
        <div>
          Price: 
          <?php echo get_post_meta(get_the_ID(), 'price', true); ?>   
        </div>
        <div> 
          Type of fuel: 
          <?php echo get_post_meta(get_the_ID(), 'select', true); ?>   
        </div>
    </div> 
  </main>    

<?php get_footer();
