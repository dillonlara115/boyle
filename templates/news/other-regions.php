<?php wp_nav_menu( array('menu' => 'News Other Regions Menu' )); ?>
<div class="property-type-list-content news-list-container">
	<?php if ( is_page(1952) ) {  
		$value = array('Residential', 'Hotels', 'Land', 'Mixed Use', 'Industrial', 'Retail', 'Office', 'Corporate');
	} elseif ( is_page(1964) ) { 
		$value = 'Hotels';
	} elseif ( is_page(1961) ) {  
		$value = 'Industrial';
	} elseif ( is_page(1965) ) { 
	 $value = 'Land';
	} elseif ( is_page(1953) ) {  
		$value = 'Mixed Use';
	} elseif ( is_page(2017) ) { 
		$value = 'Office';
	} elseif ( is_page(1960) ) {
		$value = 'Residential';
	} elseif ( is_page(1957) ) { 
		$value = 'Retail';
	} elseif ( is_page(1968) ) {
		$value = 'Corporate';
	} ?>
		<?php 
		// args for residential property types
		$args = array(
			'post_type'		=> 'news',
			'orderby'		=> 'date',
			'order'			=> 'ASC',
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'tag_a_property_type',
					'value'		=> $value,
					'compare'	=> 'LIKE'
				),
				array(
					'key'		=> 'tag_a_region',
					'value'		=> 'Other Regions',
					'compare'	=> 'LIKE'
				),
				
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
			?>
				<li>
				<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
					<h3><a class="Title-Blue" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<strong class="news-date"><?php echo the_field('date'); ?></strong>
						<p><?php echo the_field('abstract'); ?></p>
						<p><a href="<?php the_permalink(); ?>">» Read More</a></p>
						<hr>
				</li>
			<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<p>No news articles have been found.</p>
		<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	
</div>