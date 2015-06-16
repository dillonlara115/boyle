<?php
/*
Template Name: Search Availability Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Icon-MagnifyingGlass.gif" alt="Search Availability" title="Search Availability" class="header-image">

	<h1 class="contact-page-title">Search Availability</h1>
	<p class="contact-page-text">Select the tab of the property type you are interested in searching. Then use the fields to specify your search criteria. Enter more search criteria for a smaller list of results.</p>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >

		<div class="search-availability-content">
			
		<?php wp_nav_menu( array('menu' => 'Search Availability Menu' )); ?>
			<div class="property-type-list-content">
				<?php the_title(); ?>
				<?php the_content(); ?>
			</div>

		</div>
	</div>


</div>


<?php get_footer(); ?>