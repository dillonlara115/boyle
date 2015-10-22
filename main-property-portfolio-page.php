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
	<div class="visible-mobile property-portfolio-region">
		<strong>Select a Region: </strong>
		<?php
	    	wp_nav_menu( array(
		    	'menu' => 'Property Portfolio Regions Menu',
		        'theme_location' => 'mobile-nav',
		        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
		        'walker'  => new Walker_Nav_Menu_Dropdown())
	        );
		?>
	</div>
<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<?php $posts = get_field('featured_properties'); ?>
	<?php if ($posts) { ?>
		<div  class="search-availability-container portfolio-container" >
	<?php } else { ?>
		<div  class="search-availability-container" >
	<?php } ?>
	
		<div class="Text-Blue">
			<?php the_content(); ?>
		</div>
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
<!-- featured properties sidebar -->
<?php if( $posts ): ?>
	<div class="services-sidebar-container">
		<h3 class="side-property-header side-property-header-availability"><span>F</span>eatured <span>P</span>roperties</h3>
	    
	    <?php foreach( $posts as $post): 
	    	$images = get_field('property_gallery', $property->ID);
			$image_1 = $images[0]; 
	    ?>
	        <?php setup_postdata($post); ?>
	        <p class="featured-property">
	            <a href="<?php the_permalink(); ?>">
	            	<?php if( $images ) { ?>
    		            <img src="<?php echo $image_1['url']; ?>" alt="<?php echo $image_1['alt']; ?>" class="featured-property-image" />
					<?php } else { ?>
						<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "featured-property-image") ); ?>
					<?php 	} ?> 
		            <strong><?php the_title(); ?></strong>
	            </a>
	            <?php the_field('address'); ?>
            </p>
            <?php $agents = get_field('agent');	?>
			<?php if($agents) { ?>
				<?php foreach($agents as $agent): 
				$image = get_field('picture', $agent->ID); ?>
					<div class="single-property-agent-container">
						<strong class="result-item-agent"><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?></a></strong>
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


<style type="text/css">

.acf-map {
	width: 100%;
	height: 300px;
	border: #ccc solid 1px;
	margin-bottom: .5em;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
(function($) {
 
/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/
 
function render_map( $el ) {
 
	// var
	var $markers = $el.find('.marker');
 
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.HYBRID
	};
 
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
 
	// add a markers reference
	map.markers = [];
 
	// add markers
	$markers.each(function(){
 
    	add_marker( $(this), map );
 
	});
 
	// center map
	center_map( map );
 
}
 
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
 
function add_marker( $marker, map ) {
 
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	var color = $marker.attr('data-col');

	 if(color === "available") { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png'; }
	 else { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-RedDot.png'; }

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: $icon
		});
 
	// add to array
	map.markers.push( marker );
 
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
 
		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {
 
			infowindow.open( map, marker );
 
		});
	}
 
}
 
/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/
 
function center_map( map ) {
 
	// vars
	var bounds = new google.maps.LatLngBounds();
 
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
 
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
 
		bounds.extend( latlng );
 
	});
 
	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 14 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}
 
}
 
/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
 
$(document).ready(function(){
 
	$('.acf-map').each(function(){
 
		render_map( $(this) );
 
	});
 
});
 
})(jQuery);
</script>

<?php get_footer(); ?>