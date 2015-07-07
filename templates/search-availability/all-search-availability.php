<div class="search-availability-results property-list-container">
	<h3>Search Results</h3>
	<?php 	$region = $_GET['region']; 
			$metro_area = $_GET['metroarea']; 
	?>
	<?php if (strstr($_SERVER['REQUEST_URI'], "memphis_metro_area")){ ?>
	<?php 
	$args = array(
		'post_type'		=> 'properties',
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'property_type',
				'value'		=> array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office'),
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'activate_property',
				'value'		=> 'This property is active',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'region_name',
				'value'		=> 'Greater Memphis',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'memphis_metro_area',
				'value'		=> $metro_area,
				'compare'	=> 'LIKE'
				)
			)
		);
					// query
	$the_query = new WP_Query( $args );
	?>
	<?php if( $the_query->have_posts() ): ?>
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
							// no rows found
						endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	
	<?php } elseif (strstr($_SERVER['REQUEST_URI'], "other")){ ?>
	<?php 
	$args = array(
		'post_type'		=> 'properties',
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'property_type',
				'value'		=> array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office'),
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'activate_property',
				'value'		=> 'This property is active',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'region_name',
				'value'		=> 'Other',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'other',
				'value'		=> $metro_area,
				'compare'	=> 'LIKE'
				)
			)
		);
					// query
	$the_query = new WP_Query( $args );
	?>
	<?php if( $the_query->have_posts() ): ?>
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
							// no rows found
						endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	
	<?php } elseif (strstr($_SERVER['REQUEST_URI'], "nashville_metro_area")){ ?>
	<?php 
	$args = array(
		'post_type'		=> 'properties',
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'property_type',
				'value'		=> array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office'),
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'activate_property',
				'value'		=> 'This property is active',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'region_name',
				'value'		=> 'Greater Nashville',
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'nashville_metro_area',
				'value'		=> $metro_area,
				'compare'	=> 'LIKE'
				)
			)
		);
					// query
	$the_query = new WP_Query( $args );
	?>
	<?php if( $the_query->have_posts() ): ?>
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
							// no rows found
						endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<?php } ?>
	
</div>
</div>