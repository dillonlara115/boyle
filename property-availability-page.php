<?php
/*
Template Name: Availability Report Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<?php the_title(); ?>
		<?php the_content(); ?>

		<div class="property-sub-navigation">

			<?php wp_nav_menu( array('menu' => 'Availability Report Regions Menu' )); ?>

		</div>

		<div class="search-availability-content">

			<?php if ( is_page( 'all-regions' ) || is_page(606) || is_page(604) || is_page(608) || is_page(595) || is_page(597)|| is_page(601) || is_page(599) ) {     ?>

			    <?php wp_nav_menu( array('menu' => 'Availability Report All Regions Menu' )); ?>
				<div class="property-type-list-content">
					all regions
				</div>

			<?php } else if (is_page( 'greater-memphis' ) || is_page(621) || is_page(624) || is_page(619) || is_page(610) || is_page(612)|| is_page(617) || is_page(614) ) { ?>

			    <?php wp_nav_menu( array('menu' => 'Availability Report Greater Memphis Menu' )); ?>
				<div class="property-type-list-content">
					greater memphis
				</div>

			<?php } else if (is_page( 'greater-nashville') || is_page(636) || is_page(634) || is_page(638) || is_page(626) || is_page(628)|| is_page(632) || is_page(630) ) { ?>

			    <?php wp_nav_menu( array('menu' => 'Availability Report Greater Nashville Menu' )); ?>
				<div class="property-type-list-content">
					greater nashville
				</div>

			<?php } else if (is_page( 'other-regions' ) || is_page(650) || is_page(648) || is_page(652) || is_page(640) || is_page(642)|| is_page(646) || is_page(644) ) { ?>

			    <?php wp_nav_menu( array('menu' => 'Availability Report Other Regions Menu' )); ?>
				<div class="property-type-list-content">
					other regions
				</div>

			<?php } ?>

		</div>

	</div>

	
</div>


<?php get_footer(); ?>