<?php wp_nav_menu( array('menu' => 'Property Portfolio Memphis Menu', 'container_class' => 'hidden-mobile' )); ?>
<div class="visible-mobile">
	<strong>Select a Property Type: </strong>
	<?php
    	wp_nav_menu( array(
	    	'menu' => 'Property Portfolio Memphis Menu',
	        'theme_location' => 'mobile-nav',
	        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
	        'walker'  => new Walker_Nav_Menu_Dropdown())
        );
	?>
	
</div>
<div class="property-type-list-content property-list-container">
	<?php if ( is_page(1530) ) {  
		$value = array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office');
		$url = 'all';
	} elseif ( is_page(1542) ) { 
		$value = 'Hotels';
		$url = 'hotels';
	} elseif ( is_page(1540) ) {  
		$value = 'Industrial';
		$url = 'industrial';
	} elseif ( is_page(1544) ) { 
	 	$value = 'Land';
	 	$url = 'land';
	} elseif ( is_page(1532) ) {  
		$value = 'Mixed-Use';
		$url = 'mixed-use';
	} elseif ( is_page(1534) ) { 
		$value = 'Office';
		$url = 'office';
	} elseif ( is_page(1538) ) {
		$value = 'Residential';
		$url = 'residential';
	} elseif ( is_page(1536) ) { 
		$value = 'Retail';
		$url = 'retail';
	} ?>
		<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// args for residential property types
		$args = array(
			'post_type'		=> 'properties',
			'orderby'	=> 'title',
			'order'		=> 'ASC',
			'posts_per_page'	=> 15,
			'paged'		=> $paged,
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'property_type',
					'value'		=> $value,
					'compare'	=> 'LIKE'
				),
			
				array(
					'key'		=> 'region_name',
					'value'		=> 'Greater Memphis',
					'compare'	=> 'LIKE'
				)
			
			)
		);
		// query
		$the_query = new WP_Query( $args );

		$mapargs = array(
			'post_type'		=> 'properties',
			'orderby'	=> 'title',
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
					'key'		=> 'region_name',
					'value'		=> 'Greater Memphis',
					'compare'	=> 'LIKE'
				)
			)
		);
		// query
		$mapquery = new WP_Query( $mapargs );
		?>
		<?php if( $mapquery->have_posts() ): ?>
			<a href="http://maxtestdomain.com/boyle/search-availability/<?php echo $url; ?>" class="search-availability-link">Search Available Properties</a>
			<a href="http://maxtestdomain.com/boyle/availability/all-regions/<?php echo $url; ?>" class="availability-report-link">Availability Report</a>
			<hr />
			<div class="acf-map">
				<?php while ( $mapquery->have_posts() ) : $mapquery->the_post(); ?>
					<?php
						$location = get_field('location');
						$gtemp = explode (',',  implode($location));
						$coord = explode (',', implode($gtemp));
					?>
					<?php 
						$field = get_field_object('availability');
						$value = get_field('availability');
						$label = $field['choices'][ $value ];
						$images = get_field('property_gallery');
						$image_1 = $images[0];  
						if($label == 'not_available' ) {
							$status = 'not_available';
						} else {
							$status = 'available';
						}
					?>
					<div class="marker" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>" data-col="<?php echo $status; ?>">
						<div class="pull-left">
							<?php if( $images ) { ?>
    		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
							<?php } else { ?>
								<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
							<?php 	} ?> 
							
						</div>
						<p class="address"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						<p><?php echo the_field('address'); ?></p>		
					</div>		
				<?php endwhile; ?>
				
			</div>
			<div class="pin-drop-text">
				<div class="pin-drop-inner-content"><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png"><span class="green">Property Is Available</span> </div>

				<div class="pin-drop-inner-content"><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-RedDot.png"><span class="red">Property is Not Available</span></div>
			</div>
			<hr />
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$images = get_field('property_gallery');
				$image_1 = $images[0];  
				$agents = get_field('agent');	
			?>
				<li class="result-item">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>">
						<?php if( $images ) { ?>
		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
						<?php } elseif (has_post_thumbnail()) { ?>
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
						<?php 	} else { ?>
							<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/09/No-Photo-Available.gif" class="availability-report-image"/>
						<?php } ?> 
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
		<?php
		if($the_query->max_num_pages>1){?>
		    <p class="navrechts">
		    <?php
		      if ($paged > 1) { ?>
		        <a href="<?php echo '?paged=' . ($paged -1); //prev link ?>">«</a>
		                        <?php }
		    for($i=1;$i<=$the_query->max_num_pages;$i++){?>
		        <a href="<?php echo '?paged=' . $i; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
		        <?php
		    }
		    if($paged < $the_query->max_num_pages){?>
		        <a href="<?php echo '?paged=' . ($paged + 1); //next link ?>">»</a>
		    <?php } ?>
		    </p>
		<?php } ?>
	
</div>