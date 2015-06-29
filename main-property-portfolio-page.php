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

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<div class="property-sub-navigation">
			<?php wp_nav_menu( array('menu' => 'Availability Report Regions Menu' )); ?>
		</div>
		<?php the_content(); ?>
		<div class="search-availability-content">

			<?php if ( is_page( 'all-regions' ) || is_page(606) || is_page(604) || is_page(608) || is_page(595) || is_page(597)|| is_page(601) || is_page(599) || is_page(985) ) {     ?>

			    <?php get_template_part('templates/availability-report/all-regions'); ?>

			<?php } else if (is_page( 'greater-memphis' ) || is_page(621) || is_page(624) || is_page(619) || is_page(610) || is_page(612)|| is_page(617) || is_page(614) || is_page(987) ) { ?>

			    <?php get_template_part('templates/availability-report/memphis'); ?>

			<?php } else if (is_page( 'greater-nashville') || is_page(636) || is_page(634) || is_page(638) || is_page(626) || is_page(628)|| is_page(632) || is_page(630) || is_page(989) ) { ?>

				<?php get_template_part('templates/availability-report/nashville'); ?>

			<?php } else if (is_page( 'other-regions' ) || is_page(650) || is_page(648) || is_page(652) || is_page(640) || is_page(642)|| is_page(646) || is_page(644) || is_page(991) ) { ?>

				<?php get_template_part('templates/availability-report/other-regions'); ?>

			<?php } ?>

		</div>

	</div>

	
</div>


<?php get_footer(); ?>