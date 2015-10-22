<?php get_header(); ?>
	<div class="outer-image-container property-image-container">
		<div class="static-header-image-container">
			<?php 
				$images = get_field('property_gallery');
				if( $images ) { ?>
				    <ul class="portfolio-header-gallery">
				        <?php foreach( $images as $image ): ?>
				            <li>
				                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="static-header-image single-property-header-slide-image"/>
				            </li>
				        <?php endforeach; ?>
				    </ul>
				<?php } else { ?>
					<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?>
				<?php 	} ?> 
		</div> 
		<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
			<h2><?php echo the_title(); ?></h2>
		<?php } ?>
	</div>

<?php the_post(); ?>
<?php $communities = get_field('community'); ?>
<?php $image = get_field('property_logo'); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
<div class="single-property-sub-navigation">
	

	<div class="single-property-bucket-container has-logo">
		<div class="bucket bucket-availability"><a href="#"><span>A</span>vailability <span>R</span>eport</a></div>
	</div>
	<div class="single-property-bucket-container bucket-gallery-container">
		<div class="bucket bucket-gallery"><a href=""><span>G</span>allery</a></div>
	</div>
	<div class="single-property-bucket-container">
		<div class="bucket bucket-news"><a href=""><span>C</span>ommunity <span>N</span>ews</a></div>
	</div>
	<div class="single-property-bucket-container bucket-contact-container">
		<div class="bucket bucket-contact "><a href=""><span>C</span>ontact</a></div>
	</div>
</div>
<?php } ?>
<div id="content" class="static-container single-properties-container">
	<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
		<div class="child-title-block">
			<span>Property Division ::</span> <?php echo implode(', ', get_field('property_type')); ?>
		</div>
	<?php } ?>
		<div class="properties-sidebar-container single-sidebar-container">
		<?php if( !empty($image) ): ?>
				<div class="property-logo">
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				</div>
			<?php endif; ?>
			<?php $agents = get_field('agent');	?>
			<?php if($agents) { ?>
				<?php foreach($agents as $agent): 
				$image = get_field('picture', $agent->ID); ?>
					<div class="single-property-agent-container">
						<img src="<?php echo $image['url'];?>"/>
						<strong><?php echo get_the_title( $agent->ID ); ?></strong>
						<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Email Me</a></strong>
						<span><?php echo the_field('phone_number', $agent->ID ); ?></span>
						<ul>
							<li><a href="<?php echo get_permalink( $agent->ID ); ?>">My Biography</a></li>
							<li><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>">My Properties</a></li>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php } ?>
	
			
		
		<?php if($communities) { ?>
			<?php foreach($communities as $community): ?>
				<div class="">
					
					<h3 class="side-property-header side-property-header-community-overview"><a href="<?php echo get_permalink( $community->ID ); ?>"><span>C</span>ommunity <span>O</span>verview</a>
						
				</div>
			<?php endforeach; ?>
		<?php } ?>
		



		<?php if(get_field('web_site')) { ?>
			<h3 class="side-property-header"><a href="<?php echo the_field('web_site');  ?>" target="_blank"><span>V</span>isit <span>C</span>ommunity <span>W</span>eb <span>S</span>ite</a></h3>
		<?php } ?>

		<?php if(get_field('site_plan')) {
			$attachment_id = get_field('site_plan');
			$url = wp_get_attachment_url( $attachment_id );
			$title = get_the_title( $attachment_id );
			$planimg = get_field('site_plan_image');
		 ?>
		 	<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-site-plan"><a href="<?php echo $url; ?>" target="_blank"><span>V</span>iew <span>S</span>ite <span>P</span>lan</a></h3>
				<p><a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo $planimg['url']; ?>" alt="<?php echo $planimg['alt']; ?>" /></a></p>
			</div>
		<?php } ?>
			<?php

			$featured_properties = get_posts(array(
				'post_type' => 'properties',
				'meta_query' => array(
					'relation'	=> 'AND',
					array(
						'key' => 'community', // name of custom field
						'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
						'compare' => 'LIKE'
					),
					array(
						'key' => 'feature_property_select', // name of custom field
						'value' => '"Feature this property in its community"', // matches exaclty "123", not just 123. This prevents a match for "1234"
						'compare' => 'LIKE'
					)
				)
			));
			?>
			<?php if( $featured_properties ): ?>
			 	<div class="side-property-inner-container">
					<h3 class="side-property-header side-property-header-availability"><span>F</span>eatured <span>P</span>roperties</h3>
					<?php foreach( $featured_properties as $property ): ?>
						<?php 
							$images = get_field('property_gallery', $property->ID);
							$image_1 = $images[0]; 


						?>
						<div class="featured-property-sidebar">
							<a href="<?php echo get_permalink( $property->ID ); ?>">
								<?php if( $images ) { ?>
		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="featured-property-image"/>
						<?php } elseif (has_post_thumbnail()) { ?>
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "featured-property-image") ); ?>
						<?php 	} else { ?>
							<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/09/No-Photo-Available.gif" class="featured-property-image"/>
						<?php } ?> 
								<br><?php echo get_the_title( $property->ID ); ?>
							</a><br>
							<?php the_field('address', $property->ID); ?>
						</div>
							<?php $agents = get_field('agent');	?>
							<?php if($agents) { ?>
								<?php foreach($agents as $agent): 
								$image = get_field('picture', $agent->ID); ?>
									<div class="single-property-agent-container">
										<strong><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?></a></strong><br>
										<small><?php echo the_field('phone_number', $agent->ID); ?></small><br>
										<p><a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo the_field('email', $agent->ID); ?></a>
										</p>
									</div>
								<?php endforeach; ?>
							<?php } ?>
						
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		<?php if(get_field('suite_information_acres')) { ?>
			<h3 class="side-property-header side-property-header-availability"><span>A</span>vailability</h3>
		        <table width="100%" cellpadding="0" cellspacing="0" border="0">
			    <tbody><tr>
			        <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle; font-weight: bold;">Lot#</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Acres</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Price</td>
			    </tr>   
			<?php

				// check if the repeater field has rows of data
				if( have_rows('suite_information_acres') ):			         
				 	// loop through the rows of data
				    while ( have_rows('suite_information_acres') ) : the_row();
						$attachment = get_sub_field('lot_file'); ?>
			<tr>
			    <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_title'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_size'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>

			</tr>
				 <?php   endwhile;

				else :

				    // no rows found

				endif;

				?>
				</tbody></table>
		<?php } elseif(get_field('suite_information_feet')) { ?>
			<h3 class="side-property-header side-property-header-availability"><span>A</span>vailability</h3>
		        <table width="100%" cellpadding="0" cellspacing="0" border="0">
			    <tbody><tr>
			        <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle; font-weight: bold;">Lot#</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Sq. Ft.</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Price</td>
			    </tr>   
			<?php

				// check if the repeater field has rows of data
				if( have_rows('suite_information_feet') ):			         
				 	// loop through the rows of data
				    while ( have_rows('suite_information_feet') ) : the_row();
						$attachment = get_sub_field('lot_file'); ?>
			<tr>
			    <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_title'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_size'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>

			</tr>
				 <?php   endwhile;

				else :

				    // no rows found

				endif;

				?>
				</tbody></table>

		<?php } ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		<?php 
			$news = get_posts(array(
				'post_type' => 'News',
				'meta_query'	=> array(
						'relation'		=> 'AND',
						array(
							'key'		=> 'property_tags',
							'value'		=>  '"' . get_the_ID() . '"',
							'compare'	=> 'LIKE'
						),
					)
			));

		?>
		<?php if( $news ): ?>
		
			<h3 class="side-property-header side-property-header-community-news"><span>P</span>roperty <span>N</span>ews</h3>
			<div class="news-sidebar-container">
			<?php foreach( $news as $item ): ?>
				<div class="property-news-sidebar-item">
					<?php if(get_field('date', $item->ID)) { ?>
						<strong class="news-date"><?php the_field('date', $item->ID); ?></strong>
					<?php } ?>
					<a href="<?php echo get_permalink( $item->ID ); ?>">
						<?php echo get_the_title( $item->ID ); ?>
					</a>
				</div>
			<?php endforeach; ?>
			</div>
		
	<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		<?php if(get_field('add_a_document')) { ?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-documents"></span>D</span>ocuments</h3>
				<?php while (have_rows('add_a_document')) : the_row();
					$attachment_id = get_sub_field('upload_a_document');
					$url = wp_get_attachment_url( $attachment_id );
					$title = get_the_title( $attachment_id ); ?>
						<p><a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></p>
				<?php endwhile ;?>
			</div>
			
		<?php } ?>

		<?php if(get_field('price_list')) { 
			$attachment_id = get_field('price_list');
			$url = wp_get_attachment_url( $attachment_id );
			$title = get_the_title( $attachment_id );
		?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-price-list"><a href="<?php echo $url; ?>" target="_blank"><span>P</span>rice <span>L</span>ist</a></h3>
			</div>
		<?php } ?>
		<?php if(get_field('featured_builders')) { 	?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-featured-builders"><span>F</span>eatured <span>B</span>uilders</h3>
				<b><?php echo the_field('featured_builders'); ?></b>
			</div>
		<?php } ?>
		<?php if(get_field('community_news')) { 	?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-community-news"><span>C</span>ommunity <span>N</span>ews</h3>
				<b><?php echo the_field('community-news'); ?></b>
			</div>
		<?php } ?>
		
	</div>
	<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
		<div class="child-property-container">
	<?php } ?>
	<div class="services-container">
		<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
			<h2 class="single-child-property-title"><?php echo the_title(); ?></h2>
		<?php } ?>
		<p class="bread-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <?php if(in_array('This property is a community', get_field('community_property'))){ ?> / <a href="<?php echo get_permalink( 2866 ); ?>">Community</a> <?php } else { ?> /
		 <?php 
		 	$categories = get_field('property_type');
			$elements = array();
			foreach($categories as $category) {
			    //do something
			    $elements[] = '<a href="http://www.maxtestdomain.com/boyle/search-availability/?type=' . strtolower($category) . '" title="' . $title . '">' . $category .'</a>';
			}

		 echo implode(', ', $elements); ?> 


		 <?php } ?> 

		 / <?php the_title();?></p>
		<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
			<!-- availability report -->
			<div class="report-container inner-container is-hidden">
				<?php get_template_part('templates/property-portfolio-availability-report'); ?>
			</div>

			<!-- image gallery -->
			<div class="gallery-container inner-container is-hidden">
				<?php get_template_part('templates/property-portfolio-gallery'); ?>
			</div>

			<!-- contact form -->
			<div class="contact-container inner-container is-hidden">
				<?php get_template_part('templates/property-portfolio-contact'); ?>
			</div>

			<!-- community news -->
			<div class="community-news-container inner-container is-hidden">
				<?php get_template_part('templates/property-portfolio-community-news'); ?>
			</div>
		<?php } ?>
		<!-- main info -->
		<div class="inner-container home-container single-propery-container">
		<?php if(get_field('description')) { ?>
			<p class="single-property-description"><?php echo the_field('description'); ?></p>
		<?php } ?>
		<?php if(get_field('address')) { ?>
			<p><strong>Address: </strong><?php echo the_field('address'); ?></p>
		<?php } ?>
		<?php $communities = get_field('community'); ?>
		<?php if($communities) { ?>
			<?php foreach($communities as $community): ?>
				<p><strong>Community: </strong><a href="<?php echo get_permalink( $community->ID ); ?>"><?php echo get_the_title( $community->ID ); ?></a></p>
				
			<?php endforeach; ?>
		<?php } ?>
		<?php if(get_field('transaction_type')) { ?>
			<p><strong>Transactions: </strong><?php echo implode(', ', get_field('transaction_type')); ?></p>
		<?php } ?>
		<?php if(get_field('floors')) { ?>
			<p><strong>Floors: </strong><?php the_field('floors'); ?></p>
		<?php } ?>
		<?php if(get_field('year_built')) { ?>
			<p><strong>Year Built: </strong><?php the_field('year_built'); ?></p>
		<?php } ?>
		<?php if(get_field('total_lots')) { ?>
			<p><strong>Total Lots: </strong><?php echo the_field('total_lots'); ?></p>
		<?php } ?>
		<?php if(get_field('major_tenants')) { ?>
			<p><strong>Tenants: </strong><?php echo the_field('major_tenants'); ?></p>
		<?php } ?>
		<?php if(get_field('total_square_feet')) { ?>
			<p><strong>Total Square Feet: </strong><?php echo number_format(get_field('total_square_feet')); ?></p>
		<?php } ?>
		<?php if(get_field('stores')) { ?>
			<p><strong>Stores: </strong><?php echo number_format(get_field('stores')); ?></p>
		<?php } ?>
		<?php if(get_field('property_type')) { ?>
			<p><strong>Property Type: </strong>
			 <?php 
		 	$categories = get_field('property_type');
			$elements = array();
			foreach($categories as $category) {
			    //do something
			    $elements[] = '<a href="http://www.maxtestdomain.com/boyle/search-availability/?type=' . strtolower($category) . '" title="' . $title . '">' . $category .'</a>';
			}

		 	echo implode(', ', $elements); ?> 
				<?php if(get_field('residential_type')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=residential">
						<?php echo implode(', ', get_field('residential_type')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('hotel_type')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=hotels">
						<?php echo implode(', ', get_field('hotel_type')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('industrial_type')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=industrial">
						<?php echo implode(', ', get_field('industrial_type')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('land_type')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=land">
						<?php echo implode(', ', get_field('land_type')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('retail_type')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=retail">
						<?php echo implode(', ', get_field('retail_type')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('mixed_use')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=mixed-use">
						<?php echo implode(', ', get_field('mixed_use')); ?>
					</a></p>
				<?php } ?>
				<?php if(get_field('office')) { ?>
					<p>
					<strong>Other Type:</strong>
					<a href="<?php echo get_permalink( 152 ); ?>?type=office">
						<?php echo implode(', ', get_field('office')); ?>
					</a>
					</p>
				<?php } ?>
			</p>
		<?php } ?>
		<?php if(get_field('Elevators')) { ?>
			<p><strong>Elevators: </strong><?php the_field('Elevators'); ?></p>
		<?php } ?>
		<?php if(get_field('parking')) { ?>
			<p><strong>Parking: </strong><?php the_field('parking'); ?></p>
		<?php } ?>
		<?php if(get_field('security')) { ?>
			<p><strong>Security: </strong><?php the_field('security'); ?></p>
		<?php } ?>
		<?php if(get_field('lobby_finishes')) { ?>
			<p><strong>Lobby Finishes: </strong><?php the_field('lobby_finishes'); ?></p>
		<?php } ?>
		<?php if(get_field('home_price_max')) { ?>
			<?php 	$minhomePrice = get_field('home_price_min');
					$maxhomePrice = get_field('home_price_max'); 
					$minhomeFormat = number_format($minhomePrice);	
					$maxhomeFormat = number_format($maxhomePrice);		
			?>
			<p><strong>Home Price Range: </strong>$<?php echo $minhomeFormat ?> - $<?php echo $maxhomeFormat?></p>
		<?php } ?>
		<?php if(get_field('lot_price_max')) { ?>
			<?php 	$minLotPrice = get_field('lot_price_min');
					$maxLotPrice = get_field('lot_price_max'); 
					$minLotFormat = number_format($minLotPrice);	
					$maxLotFormat = number_format($maxLotPrice);		
			?>
			<p><strong>Lot Price Range: </strong>$<?php echo $minLotFormat; ?> - $<?php echo $maxLotFormat; ?></p>
		<?php } ?>
		<?php if(get_field('lot_size_max_feet') != get_field('lot_size_min_feet')) { ?>
			<p><strong>Lot Size(feet): </strong>
				<?php echo the_field('lot_size_min_feet'); ?> - <?php echo the_field('lot_size_max_feet'); ?></p>
		<?php } elseif(get_field('lot_size_max_feet') && get_field('lot_size_max_feet') === get_field('lot_size_min_feet')) { ?>
		
			<p><strong>Lot Size(feet): </strong>
				<?php echo the_field('lot_size_min_feet'); ?></p>
		<?php } ?>
		<?php if(get_field('lot_size_max_acres')) { ?>
			<p><strong>Lot Size(acres): </strong><?php if(get_field('lot_size_min_acres')) { ?>
			<?php echo the_field('lot_size_min_acres'); ?> - <?php } ?><?php echo the_field('lot_size_max_acres'); ?></p>
		<?php } ?>
		<?php if(get_field('notes')) { ?>
			<p><strong>Notes: </strong><?php echo the_field('notes'); ?></p>
		<?php } ?>
		<?php if(get_field('schools')) { ?>
			<p><strong>Schools: </strong><?php echo the_field('schools'); ?></p>
		<?php } ?>
		<?php if(get_field('amenities')) { ?>
			<p><strong>Amenities: </strong><?php echo the_field('amenities'); ?></p>
		<?php } ?>
		<?php $parentproperty = get_field('parent_property'); ?>
		<?php if($parentproperty) { ?>
			<?php foreach($parentproperty as $parent): ?>
				<p><strong>Parent Properties: </strong><a href="<?php echo get_permalink( $parent->ID ); ?>"><?php echo get_the_title( $parent->ID ); ?></a></p>
				
			<?php endforeach; ?>
		<?php } ?>
		<?php if(get_field('population_3_mile')) { ?>
			<p><strong>Population (3 Mile): </strong><?php echo the_field('population_3_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('population_5_mile')) { ?>
			<p><strong>Population (5 Mile): </strong><?php echo the_field('population_5_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('hh_3_mile')) { ?>
			<p><strong>HH (3 Mile): </strong><?php echo the_field('hh_3_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('hh_5_mile')) { ?>
			<p><strong>HH (5 Mile): </strong><?php echo the_field('hh_5_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('avg_hh_income_3_mile')) { ?>
			<p><strong>Avg. HH Income (3 mile): </strong><?php echo the_field('avg_hh_income_3_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('avg_hh_income_5_mile')) { ?>
			<p><strong>Avg. HH Income (5 mile): </strong><?php echo the_field('avg_hh_income_5_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('median_age_3_mile')) { ?>
			<p><strong>Median Age (3 mile): </strong><?php echo the_field('median_age_3_mile'); ?></p>
		<?php } ?>
		<?php if(get_field('median_age_5_mile')) { ?>
			<p><strong>Median Age (5 mile): </strong><?php echo the_field('median_age_5_mile'); ?></p>
		<?php } ?>
		</div>
		<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
			<div class="single-property-form-container">
				<?php get_template_part('templates/property-portfolio-contact'); ?>
			</div>
			
		<?php } ?>
	
		<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
			<?php
				$propertyPosts = new WP_Query( array( 
				'post_type' 	=> 'properties',
				'orderby' => 'title',
				'order'   => 'ASC',
				'meta_query'	=> array(
					'relation'	=> 'AND',
					
					array(
						'key'		=> 'activate_property',
						'value'		=> 'This property is active',
						'compare'	=> 'LIKE'
						),
					array(
						'key'		=> 'community',
						'value' => '"' . get_the_ID() . '"',
						'compare'	=> 'LIKE'
						),
					
					),
				) 
			);?>
			<?php $the_query = new WP_Query( $propertyPosts ); ?>
								<?php if( $propertyPosts->have_posts() ): ?>
			<br><br>
			<div class="single-property-select-a-property">
				<div class="TabUpMiddle">
					<div class="SubTitle-Blue">Select a Property Within This Community</div>
				</div>
				<div class="property-type-list-content property-list-container community-search-filters">
					
						<div class="search-filters">
							<strong>Property:</strong>
							<select class="property-select">
								<option>...</option>
							<?php $the_query = new WP_Query( $propertyPosts ); ?>
								<?php if( $propertyPosts->have_posts() ): ?>
									<?php while ( $propertyPosts->have_posts() ) : $propertyPosts->the_post(); ?>
										<option data-permalink="<?php the_permalink(); ?>"><?php the_title(); ?> </option>
									<?php endwhile; ?>
								<?php endif; ?>
								<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
							</select>
						</div>
					
				</div>
			</div>
			<?php endif; ?>
			<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		<?php } ?>


	</div>
	

		<div class="properties-sidebar-container property-map-sidebar">
			<a href="javascript:window.print()" class="single-property-print"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2015/06/Icon-Print.gif"></a>
			<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
			<?php 
				$images = get_field('sidebar_gallery');
				if( $images ): ?>
					<div class="sidebar-gallery-container">
					    <div class="portfolio-sidebar-gallery">
					        <?php foreach( $images as $image ): ?>
					            <span>
					                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="static-sidebar-image"/>
					            </span>
					        <?php endforeach; ?>
					    </div>
					    <div class="slider-nav">
					        <?php foreach( $images as $image ): ?>
					            <span>
					                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="static-sidebar-image"/>
					            </span>
					        <?php endforeach; ?>
					    </div>
				    </div>
			<?php endif; ?> 
			<?php } ?>


			<?php $location = get_field('location');
			if( !empty($location) ): ?>

				<?php if ( is_single( 430 ) ||  is_single( 2604 ) || is_single( 719 ) || is_single( 721 ) || is_single( 817 ) || is_single( 726 ) || is_single( 699 ) || is_single( 1742 ) || is_single( 712 ) || is_single( 560 )) {  
					$hidden = 'hidden';
				 } ?>
				<div class="Title2-Gray" style="text-align: left; padding-bottom: 5px; margin-top: 10px;">P<span style="font-size: 8pt;">ROPERTY</span> M<span style="font-size: 8pt;">AP</span></div>
				<div class="acf-map side-map <?php echo $hidden; ?>">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
				
		

<?php if ( is_single( 430 ) ) {     ?>
<div class="avilla-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-6 available">
	        <a href="<?php echo get_permalink( 430 ); ?>" >NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 6<br>2.027 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-7 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 7<br>2.552 Acres</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-5 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 5<br>2.021 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-8 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 8<br>2.309 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-9 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 9<br>3.372 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-4 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 4<br>2.201 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-12 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 12<br>2.320 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-10 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 10<br>2.287 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-11 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 11<br>2.953 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-3 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 3<br>2.161 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-13 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 13<br>2.118 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-2 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 2<br>2.649 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-1 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 1<br>2.136 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-15 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 15<br>2.180 Acres</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-14 available">
	        <a href="<?php echo get_permalink( 430 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Lot 14<br>2.069 Acres</h2>
	          </header>
	        </div>
	      </li>
	     
	      
    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/Avilla.png" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 2604 )){ ?>
	 <div class="berryfarms-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-townCenter">
	        <a href="<?php echo get_permalink( 560 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Town Center<br>at Berry Farms</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-chadwell">
	        <a href="<?php echo get_permalink( 699 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell<br>at Berry Farms</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-reams">
	        <a href="<?php echo get_permalink( 716 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Reams-Fleming<br>at Berry Farms</h2>
	          </header>
	        </div>
	      </li>
	      
    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/berryfarms.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 719 )){ ?>
	<div class="ridgeway-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-church">
	        <a href="<?php echo get_permalink( 903 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>First Evangelical<br>Church, Memphis</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-775 available">
	        <a href="<?php echo get_permalink( 1377 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>775 Ridge Lake Blvd.<br>Sparks Building</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-866 available">
	        <a href="<?php echo get_permalink( 848 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>866 Ridgeway Loop</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-850 available">
	        <a href="<?php echo get_permalink( 840 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>850 Ridgeway Loop</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-871 available">
	        <a href="<?php echo get_permalink( 850 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>871 Ridgeway Loop</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-889 available">
	        <a href="<?php echo get_permalink( 852 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>889 Ridge Lake Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-860 available">
	        <a href="<?php echo get_permalink( 846 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>860 Ridge Lake Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-benihana">
	        <a href="<?php echo get_permalink( 866 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Benihana</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-staybridge">
	        <a href="<?php echo get_permalink( 1139 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Staybridge Suites</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-959 available">
	        <a href="<?php echo get_permalink( 856 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>959 Ridgeway Loop</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-100ridgeway available">
	        <a href="<?php echo get_permalink( 768 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1000 Ridgeway Loop<br>(Marsh Center)</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-949 available">
	        <a href="<?php echo get_permalink( 854 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>949 Shady Grove Rd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-5409 available">
	        <a href="<?php echo get_permalink( 1380 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5904 Ridgeway<br>Center Parkway</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-1100 available">
	        <a href="<?php echo get_permalink( 770 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1100 Ridgeway Loop</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-999 available">
	        <a href="<?php echo get_permalink( 860 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>999 Shady Grove Rd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-hampton">
	        <a href="<?php echo get_permalink( 1375 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Hampton Inn</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-embasy">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Embasy Suites</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-regalia available">
	        <a href="<?php echo get_permalink( 1067 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Regalia</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-hilton">
	        <a href="<?php echo get_permalink( 928 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Hilton Hotel</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-965 available">
	        <a href="<?php echo get_permalink( 858 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>965 Ridge<br>Lake Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-5865 available">
	        <a href="<?php echo get_permalink( 828 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5865 Ridgeway<br>Center Parkway</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-5885 available">
	        <a href="<?php echo get_permalink( 1229 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5885 Ridgeway<br>Center Parkway</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-5900 available">
	        <a href="<?php echo get_permalink( 1216 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5900 Poplar Ave.<br>(Boyle Building)</h2>
	          </header>
	        </div>
	      </li>
    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/ridgeway-center-map-boyle1.jpg" alt="" />
	  </div>
	</div>
	
<?php } elseif (is_single( 721 )){ ?>
	 <div class="schilling-farms-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-1313 available">
	        <a href="<?php echo get_permalink( 781 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1313 West<br>Poplar Avenue</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-1255 available">
	        <a href="<?php echo get_permalink( 1033 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1255 West<br>Poplar Avenue</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-bank-branch">
	        <a href="<?php echo get_permalink( 1144 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Sun Trust<br>Bank Branch</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-bank-tn">
	        <a href="<?php echo get_permalink( 862 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Bank Tennessee<br>Headquarters</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-popeyes">
	        <a href="<?php echo get_permalink( 1031 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>popeyes</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-jiffy">
	        <a href="<?php echo get_permalink( 935 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Jiffy Lube</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-verizon">
	        <a href="<?php echo get_permalink( 1188 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Verizon</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-1190 available">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1190 Schilling Boulevard</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-11 available">
	        <a href="<?php echo get_permalink( 1236 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>11 Schilling<br>Bend Commons</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-schilling-gardens">
	        <a href="<?php echo get_permalink( 1134 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Schilling Gardens</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-telerythmics">
	        <a href="<?php echo get_permalink( 1148 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Telerythmics</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-10 available">
	        <a href="<?php echo get_permalink( 1232 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>10 Schilling<br>Bend Commons</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-business-center available">
	        <a href="<?php echo get_permalink( 1081 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Schilling Farms<br>Business Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-D1">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>D1 Sports</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-rural-metro">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Rural Metro<br>Alliance</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-ortho">
	        <a href="<?php echo get_permalink( 1027 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Ortho One</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-100-market available">
	        <a href="<?php echo get_permalink( 758 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>100 Market<br>Center Drive</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-legacy-farm-appartments">
	        <a href="<?php echo get_permalink( 941 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Legacy Farm<br>Apartments</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-signature">
	        <a href="<?php echo get_permalink( 1177 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Signature</h2>
	          </header>
	        </div>
	      </li>
			<li class="map-marker map-marker-mcr">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>MCR Safety</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-200 available">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>200 Schilling<br>Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-YMCA">
	        <a href="<?php echo get_permalink( 1214 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Schilling Farms<br>YMCA</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-kidtech">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>KidTech<br>Childcare</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-pediatrics">
	        <a href="<?php echo get_permalink( 1029 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Pediatrics East</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-dental">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Schilling Farms<br>Dental Care</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-juice">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Juice Plus</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-chemical available">
	        <a href="<?php echo get_permalink( 798 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Helena Chemical<br>Headquarters</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-madison">
	        <a href="<?php echo get_permalink( 1162 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Madison<br>Appartments</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-fresenius">
	        <a href="<?php echo get_permalink( 907 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Fresenius<br>Medical Care</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-grant-homes">
	        <a href="<?php echo get_permalink( 920 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Grant Homes</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-860 available">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>860 Winchester<br>Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-carrington-west">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Carrington West<br>Office, Retail</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-carrington-farms">
	        <a href="<?php echo get_permalink( 1789 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Carrington at<br>Schilling Farms</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-oaks-farms">
	        <a href="<?php echo get_permalink( 1168 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Oaks at<br>Schilling Farms</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-life-church">
	        <a href="#">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Life Church at<br>Schilling Farms</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-neighborhood available">
	        <a href="<?php echo get_permalink( 1164 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Neighborhood at<br>Schilling Farms</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-sterling-square">
	        <a href="<?php echo get_permalink( 1142 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Sterling Square</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-855 available">
	        <a href="<?php echo get_permalink( 842 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>855 Winchester<br>Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-village">
	        <a href="<?php echo get_permalink( 1180 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Village</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-wynstone-mill">
	        <a href="<?php echo get_permalink( 1212 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Wynstone Mill</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-middle-school">
	        <a href="<?php echo get_permalink( 1089 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Schilling Farms<br>Middle School</h2>
	          </header>
	        </div>
	      </li>

    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/SchillingFarmsmap.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 817 )){ ?>
	 <div class="meridian-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-ranch available">
	        <a href="<?php echo get_permalink( 809 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>3000 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-estates available">
	        <a href="<?php echo get_permalink( 764 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1000 Meridian Blvd</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-retreat">
	        <a href="<?php echo get_permalink( 815 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>4000 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-fayette available">
	        <a href="<?php echo get_permalink( 1287 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>2550 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-grandmanor available">
	        <a href="<?php echo get_permalink( 1285 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>2555 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-manor available">
	        <a href="<?php echo get_permalink( 788 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>2000 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-openspace available">
	        <a href="<?php echo get_permalink( 772 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>990 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-recreation">
	        <a href="<?php echo get_permalink( 893 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Courtyard Marriot</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-village available">
	        <a href="<?php echo get_permalink( 774 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>995 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-future available">
	        <a href="<?php echo get_permalink( 820 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5000 Meridian Blvd</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-1175 available">
	        <a href="<?php echo get_permalink( 778 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>1175 Meridian</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-fitness">
	        <a href="<?php echo get_permalink( 1385 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Meridian Fitness Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-residence">
	        <a href="<?php echo get_permalink( 1079 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Residence Inn</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-5005 available">
	        <a href="<?php echo get_permalink( 1732 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>5005 Meridian</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-one available">
	        <a href="<?php echo get_permalink( 1018 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>One Meridian</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-two available">
	        <a href="<?php echo get_permalink( 1186 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Two Meridian</h2>
	          </header>
	        </div>
	      </li>

    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/meridian-cool-springs-map-boyle.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 726 )){ ?>
	 <div class="springcreek-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-ranch">
	        <a href="http://join.springcreekranch.org/">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Ranch</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-estates">
	        <a href="http://join.springcreekranch.org/">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Estates</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-retreat">
	        <a href="http://join.springcreekranch.org/">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Retreat</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-fayette">
	        <a href="http://join.springcreekranch.org/">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Fayette Co.<br>Future</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-grandmanor available">
	        <a href="<?php echo get_permalink( 732 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Grand Manor</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-manor available">
	        <a href="<?php echo get_permalink( 1365 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Manor</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-openspace">
	        <a href="http://join.springcreekranch.org/">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Community<br>Open Space</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-recreation">
	        <a href="http://join.springcreekranch.org/">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Community<br>recreation</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-village available">
	        <a href="<?php echo get_permalink( 740 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Village</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-future">
	        <a href="http://join.springcreekranch.org/">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Future</h2>
	          </header>
	        </div>
	      </li>

    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/springcreek.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 699 )){ ?>
	<div class="chadwell-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-hotel available">
	        <a href="<?php echo get_permalink( 1309 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Hotel Chadwell</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-park available">
	        <a href="<?php echo get_permalink( 1311 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell Park</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-village available">
	        <a href="<?php echo get_permalink( 1314 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell Village</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace available">
	        <a href="<?php echo get_permalink( 1307 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace<br>At Chadwell</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-park2 available">
	        <a href="<?php echo get_permalink( 1313 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell Park 2</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-village2 available">
	        <a href="<?php echo get_permalink( 1320 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell Village 2</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-village3 available">
	        <a href="<?php echo get_permalink( 1321 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Chadwell Village 3</h2>
	          </header>
	        </div>
	      </li>
    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/chadwell-at-berry-farms.png" alt="" />
	  </div>
	</div>
	
<?php } elseif (is_single( 1742 )){ ?>
	 <div class="citypark-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-one available">
	        <a href="<?php echo get_permalink( 1747 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>One Citypark</h2>
	          </header>
	        </div>
	      </li>
	      
	      <li class="map-marker map-marker-six available">
	        <a href="<?php echo get_permalink( 1757 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Six Citypark</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-three available">
	        <a href="<?php echo get_permalink( 1751 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Three CityPark</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-two available">
	        <a href="<?php echo get_permalink( 1749 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Two CityPark</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-retaila available">
	        <a href="<?php echo get_permalink( 1799 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail A<br>at CityPark</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-retailb available">
	        <a href="<?php echo get_permalink( 1801 ); ?>">ME</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail B<br>at CityPark</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-retailc available">
	        <a href="<?php echo get_permalink( 1803 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail C<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-retaild available">
	        <a href="<?php echo get_permalink( 1805 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail D<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-retaile available">
	        <a href="<?php echo get_permalink( 1807 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail E<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-retailf available">
	        <a href="<?php echo get_permalink( 1808 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Retail F<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-mooreland available">
	        <a href="<?php echo get_permalink( 1796 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Mooreland<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-hilton available">
	        <a href="#">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Hilton Garden Inn<br>at CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-seven available">
	        <a href="<?php echo get_permalink( 1759 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Seven CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-four available">
	        <a href="<?php echo get_permalink( 1753 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Four CityPark</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-five available">
	        <a href="<?php echo get_permalink( 1755 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Five CityPark</h2>
	          </header>	        
          	</div>
	      </li>
    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/citypark-map.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 712 )){ ?>
	  <div class="humphreys-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-baptist">
	        <a href="<?php echo get_permalink( 812 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Baptist Memorial<br>Healthcare Corp</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-190 available">
	        <a href="#">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>190 N. Humphreys Blvd.</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-220">
	        <a href="#">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>200 N. Humphreys<br>Fire Station 44</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-100 available">
	        <a href="<?php echo get_permalink( 762 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>100 N. Humphreys<br>West Clinic</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-225">
	        <a href="<?php echo get_permalink( 796 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>225 N. Humphreys<br>Eaglecrest Building</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-cbhigschool">
	        <a href="<?php echo get_permalink( 830 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Christian Brothers<br>High School</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-nwcorner available">
	        <a href="<?php echo get_permalink( 1007 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>NW Corner of Walnut<br>Grove and Humphreys</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-hospital">
	        <a href="<?php echo get_permalink( 831 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Baptist Hospital</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-hampton">
	        <a href="<?php echo get_permalink( 811 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Hampton Inn</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-shops available">
	        <a href="<?php echo get_permalink( 1103 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Shops of Humphreys Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-80">
	        <a href="<?php echo get_permalink( 835 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>80 Humphreys Center<br>Medical Building</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-baptistwomens">
	        <a href="<?php echo get_permalink( 832 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Baptist Women's<br>Hospital</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-6305 available">
	        <a href="<?php echo get_permalink( 1240 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>6305 Humphreys<br>Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-6325 available">
	        <a href="<?php echo get_permalink( 833 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>6325 Humphreys<br>Blvd.</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-cloisters">
	        <a href="<?php echo get_permalink( 1152 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>The Cloisters of Riveroaks</h2>
	          </header>
	        </div>
	      </li>

    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/humphreys-center-map-boyle.jpg" alt="" />
	  </div>
	</div>
<?php } elseif (is_single( 560 )){ ?>
	  <div class="towncenter-map">
	 <div class="map">
    	<ul class="map-markers">
	      <li class="map-marker map-marker-commons available">
	        <a href="<?php echo get_permalink( 1359 ); ?>">NA</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Commons, Village & Manor<br>Homes at Town Center 3</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-commons2 available">
	        <a href="<?php echo get_permalink( 1353 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Commons, Village & Manor<br>Homes at Town Center 2</h2>
	          </header>	        
          	</div>
	      </li>
	      <li class="map-marker map-marker-townhomes2 available">
	        <a href="<?php echo get_permalink( 1363 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Townhomes at<br>Town Center 2</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-commons3 available">
	        <a href="<?php echo get_permalink( 575 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Commons, Village & Manor<br>Homes at Town Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-townhomes available">
	        <a href="<?php echo get_permalink( 1357 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Townhomes at<br>Town Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace3 available">
	        <a href="<?php echo get_permalink( 1322 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 3</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-commons4 available">
	        <a href="<?php echo get_permalink( 1361 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Commons, Village & Manor<br>Homes at Town Center 4</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace6 available">
	        <a href="<?php echo get_permalink( 1342 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 6</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-center-park available">
	        <a href="<?php echo get_permalink( 1346 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Town Center Park</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-commons5 available">
	        <a href="<?php echo get_permalink( 1362 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Commons, Village & Manor<br>Homes at Town Center 5</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-centerpark4 available">
	        <a href="<?php echo get_permalink( 1351 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Town Center Park 4</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-centerpark2 available">
	        <a href="<?php echo get_permalink( 1348 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Town Center Park 2</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-neighborhood available">
	        <a href="<?php echo get_permalink( 1240 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Neighborhood Center at<br>Town Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace4 available">
	        <a href="<?php echo get_permalink( 1338 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 4</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace7 available">
	        <a href="<?php echo get_permalink( 1343 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 7</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-centerpark3 available">
	        <a href="<?php echo get_permalink( 1350 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Town Center Park 3</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace available">
	        <a href="<?php echo get_permalink( 1322 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace2 available">
	        <a href="<?php echo get_permalink( 1326 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 2</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace5 available">
	        <a href="<?php echo get_permalink( 1339 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 5</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-marketplace8 available">
	        <a href="<?php echo get_permalink( 1344 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Marketplace at<br>Town Center 8</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-specialty available">
	        <a href="<?php echo get_permalink( 1340 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Specialty Retail & Restaurants<br>At Town Center</h2>
	          </header>
	        </div>
	      </li>
	      <li class="map-marker map-marker-specialty2 available">
	        <a href="<?php echo get_permalink( 1345 ); ?>">OR</a>
	        <div class="map-marker-info">
	          <header>
	            <h2>Specialty Retail & Restaurants<br>At Town Center2</h2>
	          </header>
	        </div>
	      </li>

    	</ul>
	    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/10/town-center-interactive.jpg" alt="" />
	  </div>
	</div>
<?php } ?>	

<p><?php echo the_field('address'); ?><br>
</p>
<?php endif; ?>
<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
	<span class="map-toggle1">Switch to Street View</span>		
	<span class="map-toggle2" style="display:none;">Switch to Map View</span>	
<?php } ?>		
		<div class="Title2-Gray" style="text-align: left; padding-bottom: 5px; margin-top: 10px;">S<span style="font-size: 8pt;">HARE</span> T<span style="font-size: 8pt;">HIS</span> P<span style="font-size: 8pt;">ROPERTY</span></div>
		<?php echo do_shortcode('[shareaholic app="share_buttons" id="20981761"]'); ?>
		</div>

	<?php if( !in_array('This property is a community', get_field('community_property'))) { ?>
		</div>
	<?php } ?>

</div>
<div style="clear: both;"></div>
</div>

<?php comments_template('', false); ?>


<style type="text/css">

.acf-map {
	width: 100%;
	height: 300px;
	border: #ccc solid 1px;
	margin: 0 0 10px;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
(function($) {
	$('.map-toggle1').on('click', function(){
		$('.interactive-map').toggle();
		$('.side-map').toggle();
		$(this).hide();
		$('.map-toggle2').show();
	});
	$('.map-toggle2').on('click', function(){
		$('.interactive-map').toggle();
		$('.side-map').toggle();
		$(this).hide();
		$('.map-toggle1').show();
	});

	var $property = $(".property-select");

		$property.change(function(){
			console.log($(".property-select option:selected").attr('data-permalink'));
			var $link = $(".property-select option:selected").attr('data-permalink')
			window.location = $link;
		});

/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function render_map( $el ) {

	// var
	var $markers = $el.find('.marker');

	// vars
	var args = {
		zoom		: 15,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};

	// create map	        	
	var map = new google.maps.Map( $el[0], args);

	// add a markers reference
	map.markers = [];

	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});

	// center map
	center_map( map );

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
		icon: 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png'

	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/

$(document).ready(function(){

	$('.acf-map').each(function(){

		render_map( $(this) );

	});

});

})(jQuery);
</script>
<?php get_footer(); ?>