<?php
/*
Template Name: Video landing Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<h1 class="contact-page-title"><?php the_title(); ?></h1>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >

		<div class="search-availability-content">
			
		
			<div class="property-type-list-content">
				
				<?php the_content(); ?>

				<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'videos',

);


// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
		
	?>
		<div class="video-container">
			<h3><?php the_title(); ?></h3>
			<strong><?php the_field('date'); ?></strong>
			<div class="embed-container pull-left">
				<?php the_field('video'); ?>
			</div>
			<div class="pull-left"><?php the_content(); ?></div>
		</div>
		<hr>
	 <?php  endwhile; ?>
	
	
	
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

			</div>

		</div>
	</div>


</div>


<?php get_footer(); ?>