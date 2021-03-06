<?php
/*
Template Name: Boyle Insurance Agency Page
*/
?>

<?php get_header(); ?>
<div class="static-header-image-container">
	<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?>
</div> 
<div id="content" class="static-container" >
	<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="services-container" >
		

		<h1 class="static-pages-title"><?php the_title(); ?></h1>

		<div class="static-pages-content">
			<?php the_content(); ?>
		
		<div>	
			<?php $query = new WP_Query( array( 
				'post_type' => 'staff_directory',
				'orderby'	=> 'title',
				'order'		=>	'ASC'
				) 
			);
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="staff-container">
				<?php
				$values = get_field('general_tag');
				if( in_array( "Insurance", get_field('general_tag')) )
					{
						$image = get_field('picture'); ?>
						<div class="staff-item">
							<div class="staff-item-image">
								<img src="<?php echo $image['url'];?>"/>
							</div>
							<div class="staff-item-content">
								
								<h3><?php echo the_title(); ?></h3>
								<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
								<div class="staff-item-content-contact">
									<p>Office: <?php echo the_field('phone_number'); ?></p>
									<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
				<!-- show pagination here -->
			<?php else : ?>
				<!-- show 404 error here -->
			<?php endif; ?>
		</div>


		</div>
	</div>

	<?php dynamic_sidebar( 'about' ); ?>
</div>


<?php get_footer(); ?>