<?php get_header(); ?>
	<div class="outer-image-container property-image-container">
		<div class="static-header-image-container">
			<?php 
				$images = get_field('property_gallery');
				if( $images ) { ?>
				    <ul class="portfolio-header-gallery">
				        <?php foreach( $images as $image ): ?>
				            <li>
				                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="static-header-image"/>
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
	<?php if( !empty($image) ): ?>
		<div class="property-logo">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		</div>
	<?php endif; ?>

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
	<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
		<?php if( empty($image) ): 
			$logo = 'single-sidebar-container';
		 endif; ?>
	<div class="properties-sidebar-container <?php echo $logo; ?>">
	<?php } else { ?>
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
						<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Email <?php echo get_the_title( $agent->ID ); ?></a></strong>
						<span><?php echo the_field('phone_number', $agent->ID ); ?></span>
						<ul>
							<li><a href="<?php echo get_permalink( $agent->ID ); ?>">Biography</a></li>
							<li><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>">Properties</a></li>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php } ?>
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
						<p>
							<a href="<?php echo get_permalink( $property->ID ); ?>">
								<img src="<?php echo $image_1['url']; ?>" alt="<?php echo $image_1['alt']; ?>" class="featured-property-image" />
								<?php echo get_the_title( $property->ID ); ?>
							</a>
							<?php the_field('address', $property->ID); ?>
						</p>
							<?php $agents = get_field('agent');	?>
							<?php if($agents) { ?>
								<?php foreach($agents as $agent): 
								$image = get_field('picture', $agent->ID); ?>
									<div class="single-property-agent-container">
										<strong><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?></a></strong>
										<small><?php echo the_field('phone_number', $agent->ID); ?></small>
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
			<div>
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
		<p class="bread-crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <?php if(in_array('This property is a community', get_field('community_property'))){ ?> / <a href="<?php echo get_permalink( 2866 ); ?>">Community</a> <?php } else { ?> / <?php echo implode(', ', get_field('property_type')); ?> <?php } ?> / <a href="<?php echo the_permalink(); ?>"><?php the_title();?></a></p>
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
			<p><?php echo the_field('description'); ?></p>
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
		<?php if(get_field('total_lots')) { ?>
			<p><strong>Total Lots: </strong><?php echo the_field('total_lots'); ?></p>
		<?php } ?>
		<?php if(get_field('major_tenants')) { ?>
			<p><strong>Tenants: </strong><?php echo the_field('major_tenants'); ?></p>
		<?php } ?>
		<?php if(get_field('total_square_feet')) { ?>
			<p><strong>Total Square Feet: </strong><?php echo number_format(get_field('total_square_feet')); ?></p>
		<?php } ?>
		<?php if(get_field('property_type')) { ?>
			<p><strong>Property Type: </strong><?php echo implode(', ', get_field('property_type')); ?> 
				<?php if(get_field('residential_type')) { ?>
					<?php echo implode(', ', get_field('residential_type')); ?>
				<?php } ?>
				<?php if(get_field('hotel_type')) { ?>
					<?php echo implode(', ', get_field('hotel_type')); ?>
				<?php } ?>
				<?php if(get_field('industrial_type')) { ?>
					<?php echo implode(', ', get_field('industrial_type')); ?>
				<?php } ?>
				<?php if(get_field('land_type')) { ?>
					<?php echo implode(', ', get_field('land_type')); ?>
				<?php } ?>
				<?php if(get_field('retail_type')) { ?>
					<?php echo implode(', ', get_field('retail_type')); ?>
				<?php } ?>
			</p>
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
		
		<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
			<?php $agents = get_field('agent');	?>
			<?php if($agents) { ?>
				<?php foreach($agents as $agent): 
				$image = get_field('picture', $agent->ID); ?>
					<div class="single-property-agent-container">
						<img src="<?php echo $image['url'];?>"/>
						<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></strong>
						<ul>
							<li><a href="<?php echo get_permalink( $agent->ID ); ?>"><?php echo get_the_title( $agent->ID ); ?>'s Biography</a></li>
							<li><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?>'s Properties</a></li>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php } ?>
		<?php } ?>
		</div>
		
	
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
			<br><br>
			<div>
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
							</select>
						</div>
					
				</div>
			</div>

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
 <object type="application/x-shockwave-flash" 
  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/Avilla.swf" 
  width="260" height="300" class="interactive-map">
  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/Avilla.swf" />
  <param name="quality" value="high"/>
</object>
<?php } elseif (is_single( 2604 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/BerryFarms.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/BerryFarms.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 719 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/RidgewayCenter.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/RidgewayCenter.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 721 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/SchillingFarmsCommunity.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/SchillingFarmsCommunity.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 817 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/MeridianCoolSprings.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/MeridianCoolSprings.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 726 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/SpringCreekRanch.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/SpringCreekRanch.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 699 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/ChadwellatBerryFarms.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/ChadwellatBerryFarms.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 1742 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/CityParkBrentwood.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/CityParkBrentwood.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 712 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/HumphreysCenter.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/HumphreysCenter.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } elseif (is_single( 560 )){ ?>
	 <object type="application/x-shockwave-flash" 
	  data="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/TownCenteratBerryFarms.swf" 
	  width="100%" height="300" class="interactive-map">
	  <param name="movie" value="http://maxtestdomain.com/boyle/wp-content/themes/boyle/InteractiveMaps/TownCenteratBerryFarms.swf" />
	  <param name="quality" value="high"/>
	</object>
<?php } ?>	

<p><?php echo the_field('address'); ?></p>
<?php endif; ?>
<?php if( in_array('This property is a community', get_field('community_property'))) { ?>
	<span class="map-toggle1">Switch to Street View</span>		
	<span class="map-toggle2" style="display:none;">Switch to Map View</span>	
<?php } ?>		
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
		map			: map
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