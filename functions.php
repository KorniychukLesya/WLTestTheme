<?php


function car_setup_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( 'Car', 'textdomain' ),
        'menu_icon' => 'dashicons-car',
        'menu_position'  => 5, 
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'car' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false, 
		'exclude_from_search' => true,
		'show_in_nav_menus'  => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),            
    );

    register_post_type( 'car', $args );
	
	register_taxonomy( 'Brand', 'car',  array(
		'label'        => __( 'Brand', 'textdomain' ),
        'hierarchical' => true,
	) );

    register_taxonomy( 'Producing country', 'car',  array(
		'label'        => __( 'Producing country', 'textdomain' ),
        'hierarchical' => true,
	) );
}

add_action( 'init', 'car_setup_post_type' );

 
function car_meta_fields() {
    add_meta_box( 'car_fields', 'Дополнительные поля', 'car_fields_box_func', 'car', 'normal', 'high');
}

 function car_fields_box_func( $post ){
	$color = get_post_meta($post->ID, 'color', true);
	$power = get_post_meta($post->ID, 'power', true);
	$price = get_post_meta($post->ID, 'power', true);
	$sel_v = get_post_meta($post->ID, 'select', true);
 	?>
 	<p>Цвет 
 		<label>
 		  <input 
		    id="color"
 		    type="color" 
 		    name="car[color]" 
 		    value="<?php echo $color; ?>" 
 		    style="width:10%" 
 		  /> 
        </label>
 	</p>
  
     <p>Мощность 
 		<label>
 		  <input 
		    id="power"
		    type="number" 
 		    name="car[power]" 
		    value="<?php echo $power; ?>" 
 		    style="width:20%" 
 		  /> 
 		</label>
 	</p>
     <p>Цена 
 		<label>
 		  <input 
		    id="price"
 		    type="number" 
 		    name="car[price]" 
 		    value="<?php echo $price; ?>" 
		    style="width:20%"
 	      /> 
 	   </label>
 	</p>

 	<p>Топилво<select name="car[select]" id="sel_v"> 			
 			<option value="0">Выбрать вид топлива</option>
 			<option value="1" <?php selected( $sel_v, '1' )?> >Бензин</option>
 			<option value="2" <?php selected( $sel_v, '2' )?> >Дизель</option>
 			<option value="3" <?php selected( $sel_v, '3' )?> >Электро</option>
 		</select></p>
  	<?php
 }

  
add_action('add_meta_boxes', 'car_meta_fields', true);

 
function true_save_meta( $post_id ) {
	if (defined('DOING_AUTOSAVE') && 'DOING_AUTOSAVE') return false;
	if (!current_user_can('edit_post', $post_id)) return false;
	if (!isset($_POST['car'])) return false;

	$_POST['car'] = array_map('trim', $_POST['car']);

    foreach($_POST['car'] as $key => $value){
      if(empty($value)){
        delete_post_meta($post_id, $key); 
        continue;
      }

      update_post_meta($post_id, $key, $value);
    }

    return $post_id; 
}

add_action( 'save_post', 'true_save_meta', 10, 2 );


function car_customize_register_action( $wp_customize ) {
    $wp_customize->add_setting(
            'title_tagline_phone',
            array(
                'default' => '+3 (096) 333-33-33',
            )
        );
	
    $wp_customize->add_control(
        'title_tagline_phone',
        array(
            'label'   => 'Телефон',
            'section' => 'title_tagline',
            'type'    => 'text',
        )
    );
	$wp_customize->add_setting(
		'title_tagline_logo',
		array(
			'default' => 'Logo',
		)
	);

   $wp_customize->add_control(
   	    'title_tagline_logo',
   	    array(
   	    	'label'   => 'Logo',
   	    	'section' => 'title_tagline',
   	    	'type'    => 'text',
   	    )
   );
}

add_action( 'customize_register', 'car_customize_register_action' );


function car_shortcode_ten_car() {
	$args = array(
		'post_type'      => 'car',
		'posts_per_page' => 10,
	);

	$loop = new WP_Query($args);
	if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
	
	<a href="<? the_permalink()?>">
	  <h2>
		<?php the_title(); ?>
	  </h2>
	</a>
	<div>
	  <?php the_content(); ?> 
	</div>
	<hr> <?php endwhile;else: ?>
	<p> <?php _e("sorry"); ?></p> <?php endif; 

}
 add_shortcode( 'ten_cars' , 'car_shortcode_ten_car' ); 
?>