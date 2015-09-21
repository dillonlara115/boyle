<?php
/*
Template Name: Communities Landing Page
*/
?>

<?php get_header(); ?>


<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<h1 class="contact-page-title"><?php the_title(); ?></h1>
	<p class="contact-page-text"><?php the_content(); ?></p>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<div class="search-availability-results property-list-container">
		<?php 
		
		// args for residential property types
		$args = array(
			'post_type'		=> 'properties',
			'orderby'	=> 'title',
			'order'		=> 'ASC',
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'community_property',
					'value'		=> 'This property is a community',
					'compare'	=> 'LIKE'
				),
			)
		);
		// query
		$the_query = new WP_Query( $args );
		
		?>
		<?php if( $the_query->have_posts() ): 

		?>

			<ul>
			
				
			
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$images = get_field('property_gallery');
				$image_1 = $images[0];  
				$agents = get_field('agent');	
			?>

				
				<li class="result-item">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
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

					
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else :
		echo 'no results found';
	 endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	
	</div>
</div>

</div>


<?php get_footer(); ?>