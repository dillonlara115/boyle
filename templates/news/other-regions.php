<?php wp_nav_menu( array('menu' => 'News Other Regions Menu', 'container_class' => 'hidden-mobile'  )); ?>
<div class="visible-mobile">
	<strong>Select a Property Type: </strong>
	<?php
    	wp_nav_menu( array(
	    	'menu' => 'News Other Regions Menu',
	        'theme_location' => 'mobile-nav',
	        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
	        'walker'  => new Walker_Nav_Menu_Dropdown())
        );
	?>
	<br>
</div>
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
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// args for residential property types
		$args = array(
			'post_type'		=> 'news',
			'meta_key'	=> 'date',
			'orderby'		=> 'meta_value_num title',
			'order'			=> 'DESC',
			'posts_per_page'	=> 10,
			'paged'		=> $paged,
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

			?>
				<li>
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