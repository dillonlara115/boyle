<?php
/*
Template Name: Main Property Portfolio Page
*/
?>

<?php get_header(); ?>
	<div class="outer-image-container property-image-container">
		<div class="static-header-image-container">
			<?php 
				$images = get_field('image_gallery');
				if( $images ): ?>
				    <ul class="portfolio-header-gallery">
				        <?php foreach( $images as $image ): ?>
				            <li>
				                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="static-header-image"/>
				            </li>
				        <?php endforeach; ?>
				    </ul>
			<?php endif; ?> 
		</div> 
		<h2><?php echo the_title(); ?></h2>
	</div>
	<div id="post-<?php the_ID(); ?>" class="property-sub-navigation portfolio-sub-navigation">
		<?php wp_nav_menu( array('menu' => 'Property Portfolio Regions Menu' )); ?>
	</div>
<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<?php $posts = get_field('featured_properties'); ?>
	<?php if ($posts) { ?>
		<div  class="search-availability-container portfolio-container" >
	<?php } else { ?>
		<div  class="search-availability-container" >
	<?php } ?>
	
		
		<?php the_content(); ?>
		<div class="search-availability-content">
			<?php if ( is_page( 1512 ) || is_page(1524) || is_page(1522) || is_page(1526) || is_page(1514) || is_page(1516)|| is_page(1520) || is_page(1518) || is_page(1504) ) {     ?>

			    <?php get_template_part('templates/property-portfolio/all-regions'); ?>

			<?php } else if (is_page(1506) || is_page(1530) || is_page(1542) || is_page(1540) || is_page(1544) || is_page(1532)|| is_page(1534) || is_page(1538) || is_page(1536) ) { ?>

			    <?php get_template_part('templates/property-portfolio/memphis'); ?>

			<?php } else if (is_page(1508) || is_page(1548) || is_page(1561) || is_page(1559) || is_page(1563) || is_page(1551)|| is_page(1553) || is_page(1555) || is_page(1557) ) { ?>

				<?php get_template_part('templates/property-portfolio/nashville'); ?>

			<?php } else if (is_page(1510) || is_page(1566) || is_page(1577) || is_page(1575) || is_page(1579) || is_page(1569)|| is_page(1571) || is_page(1573) || is_page(1563) ) { ?>

				<?php get_template_part('templates/property-portfolio/other-regions'); ?>

			<?php } ?>
		</div>
	</div>

<?php if( $posts ): ?>
	<div class="services-sidebar-container">
		<h3 class="side-property-header side-property-header-availability"><span>F</span>eatured <span>P</span>roperties</h3>
	    
	    <?php foreach( $posts as $post): 
	    	$images = get_field('property_gallery', $property->ID);
			$image_1 = $images[0]; 
	    ?>
	        <?php setup_postdata($post); ?>
	        <p>
	            <a href="<?php the_permalink(); ?>">
		            <img src="<?php echo $image_1['url']; ?>" alt="<?php echo $image_1['alt']; ?>" class="featured-property-image" />
		            <?php the_title(); ?>
	            </a>
	            <?php the_field('address'); ?>
            </p>
            <?php $agents = get_field('agent');	?>
			<?php if($agents) { ?>
				<?php foreach($agents as $agent): 
				$image = get_field('picture', $agent->ID); ?>
					<div class="single-property-agent-container">
						<strong class="agent-name"><a href="#"><?php echo get_the_title( $agent->ID ); ?></a></strong>
						<small><?php echo the_field('phone_number', $agent->ID); ?></small>
						<p><a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo the_field('email', $agent->ID); ?></a>
						</p>
					</div>
				<?php endforeach; ?>
			<?php } ?>
	        <hr>
	    <?php endforeach; ?>
	    
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
	
</div>


<?php get_footer(); ?>