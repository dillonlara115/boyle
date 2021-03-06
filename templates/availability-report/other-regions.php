<?php wp_nav_menu( array('menu' => 'Availability Report Other Regions Menu', 'container_class' => 'hidden-mobile'  )); ?>
<div class="visible-mobile">
	<strong>Select a Property Type: </strong>
	<?php
    	wp_nav_menu( array(
	    	'menu' => 'Availability Report Other Regions Menu',
	        'theme_location' => 'mobile-nav',
	        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
	        'walker'  => new Walker_Nav_Menu_Dropdown())
        );
	?>
	<br>
</div>
<div class="property-type-list-content property-list-container">
	<h2 class="property-portfolio-title"><?php the_title(); ?></h2>
	<?php if (is_page(991) ) { 
		$value = array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office');
	} elseif (is_page(646) ) { 
		$value = 'Residential';
	} elseif (is_page(640) ) {
		$value = 'Mixed-Use';
	} elseif (is_page(642) ) { 
		$value = 'Office';
	} elseif (is_page(644) ) { 
		$value = 'Retail';
	} elseif (is_page(650) ) { 
		$value = 'Hotels';
	} elseif (is_page(648) ) {
		$value = 'Industrial';
	} elseif (is_page(652) ) {
		$value = 'Land';
	} ?>
		<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// args for residential property types
		$args = array(
			'post_type'		=> 'properties',
			'meta_key'	=> 'zip_code',
			'orderby'	=> 'meta_value_num title',
			'order'		=> 'ASC',
			'posts_per_page'	=> -1,
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'property_type',
					'value'		=> $value,
					'compare'	=> 'LIKE'
				),
				array(
					'key'		=> 'activate_property',
					'value'		=> 'This property is active',
					'compare'	=> 'LIKE'
				),
				array(
					'key'		=> 'availability',
					'value'		=> 'available',
					'compare'	=> '='
				),
				array(
					'key'		=> 'region_name',
					'value'		=> 'Other',
					'compare'	=> 'LIKE'
				)
			)
		);
		// query
		$the_query = new WP_Query( $args );
		?>
		<?php if( $the_query->have_posts() ): ?>
			<p>There are <b><?php echo $the_query->found_posts ?></b> properties available within this region.</p>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$images = get_field('property_gallery');
				$image_1 = $images[0];  
				$agents = get_field('agent');	
			?>
							<li data-title="<?php the_field('city'); ?>" class="city-label"><h3><?php the_field('city'); ?></h3></li>

				<li class="result-item">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>">
						<?php if( $images ) { ?>
		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
						<?php } else { ?>
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
						<?php 	} ?> 
					</a>
					<?php if($agents) { ?>
					<?php foreach($agents as $agent): ?>
						<p class="result-item-agent-info">
							<strong class="result-item-agent"><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?></a></strong><br>
							<?php echo the_field('phone_number', $agent->ID); ?><br>
							<a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo the_field('email', $agent->ID); ?></a>
						</p>
					<?php endforeach; ?>
					<?php } ?>
				</div>	
				<div class="result-content">
				<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
				
				<p><?php echo the_field('description'); ?></p>

							<?php
						// check if the repeater field has rows of data
						if( have_rows('suite_information_acres') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_acres') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: center; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>

						<?php elseif( have_rows('suite_information_feet') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Suite</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Sq. Feet</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_feet') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: center; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>
						<?php else :
							// no rows found
						endif; ?>
					</div>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

</div>


