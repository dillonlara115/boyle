<?php
/*
Template Name: Property Portfolio Page
*/
?>

<?php get_header(); ?>
<div class="static-header-image-container">
	<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?>
</div>
<div class="visible-mobile">
						<strong>Property Type: </strong>
						<?php
					    	wp_nav_menu( array(
						    	'menu' => 'Property Location Menu',
						        'theme_location' => 'mobile-nav',
						        'items_wrap'     => '<select id="drop-nav"><option value="">Select a page...</option>%3$s</select>',
						        'walker'  => new Walker_Nav_Menu_Dropdown())
					        );
						?>
					</div><br>
<?php wp_nav_menu( array('menu' => 'Property Location Menu' 'container_class' => 'hidden-mobile')); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<h1 class="contact-page-title"><?php the_title(); ?></h1>
	<p class="contact-page-text">Select the tab of the property type you are interested in searching. Then use the fields to specify your search criteria. Enter more search criteria for a smaller list of results.</p>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >

		<div class="search-availability-content">
			
		<?php wp_nav_menu( array('menu' => 'Property Portfolio Menu' )); ?>
			<div class="property-type-list-content">
				
				<?php the_content(); ?>
			</div>

		</div>
	</div>


</div>


<?php get_footer(); ?>