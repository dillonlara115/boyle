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
	<div class="property-sub-navigation">
		<?php wp_nav_menu( array('menu' => 'Property Portfolio Regions Menu' )); ?>
	</div>
<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<?php 

$posts = get_field('featured_properties'); ?>
	<?php if ($posts) { ?>
		<div id="post-<?php the_ID(); ?>" class="search-availability-container portfolio-container" >
	<?php } else { ?>
		<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
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
	    <ul>
	    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	        <li>
	            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            <span></span>
	        </li>
	    <?php endforeach; ?>
	    </ul>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
	
</div>


<?php get_footer(); ?>