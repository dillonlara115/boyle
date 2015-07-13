<?php wp_nav_menu( array('menu' => 'Property Portfolio Other Regions Menu' )); ?>
<div class="property-type-list-content property-list-container">
	<?php if ( is_page(1566) ) {  
		$value = array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office');
	} elseif ( is_page(1577) ) { 
		$value = 'Hotels';
	} elseif ( is_page(1575) ) {  
		$value = 'Industrial';
	} elseif ( is_page(1579) ) { 
	 	$value = 'Land';
	} elseif ( is_page(1569) ) {  
		$value = 'Mixed-Use';
	} elseif ( is_page(1571) ) { 
		$value = 'Office';
	} elseif ( is_page(1573) ) {
		$value = 'Residential';
	} elseif ( is_page(1663) ) { 
		$value = 'Retail';
	} ?>
		<?php 
		// args for residential property types
		$args = array(
			'post_type'		=> 'properties',
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'property_type',
					'value'		=> $value,
					'compare'	=> 'LIKE'
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
			<hr />
			<div class="acf-map">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php
						$location = get_field('location');
						$gtemp = explode (',',  implode($location));
						$coord = explode (',', implode($gtemp));
					?>

					<div class="marker" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>">
						<p class="address"><?php the_title(); ?></p>		
					</div>		
				<?php endwhile; ?>
			</div>
			<hr />
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$images = get_field('property_gallery');
				$image_1 = $images[0];  
				$agents = get_field('agent');	
			?>
				<li>
				<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
					<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
						<?php if($agents) { ?>
							<?php foreach($agents as $agent): ?>
								<strong class="pull-right"><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></strong>
							<?php endforeach; ?>
						<?php } ?>
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
							        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>

						<?php elseif( have_rows('suite_information_feet') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_feet') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>
						<?php else :
							
						endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	
</div>