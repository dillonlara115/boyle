<?php get_header(); ?>
	<div class="outer-image-container">
		<div class="static-header-image-container">
			<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?>
		</div> 
	</div>

<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="single-property-sub-navigation">
	<?php $image = get_field('property_logo');
	if( !empty($image) ): ?>
		<div class="property-logo">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		</div>
	<?php endif; ?>
	<div class="single-property-bucket-container">
		<div class="bucket bucket-availability"><a href="#"><span>A</span>vailability <span>R</span>eport</a></div>
	</div>
	<div class="single-property-bucket-container bucket-gallery-container">
		<div class="bucket bucket-gallery"><a href=""><span>G</span>allery</a></div>
	</div>
	<div class="single-property-bucket-container">
		<div class="bucket bucket-news"><a href=""><span>C</span>ommunity <span>N</span>ews</a></div>
	</div>
	<div class="single-property-bucket-container bucket-contact-container">
		<div class="bucket bucket-contact "><a href=""><span>C</span>ontact</a></div>
	</div>
</div>

<div id="content" class="static-container single-properties-container">
	<div class="properties-sidebar-container">
		

		<?php if(get_field('site_plan')) {
			$attachment_id = get_field('field_name');
			$url = wp_get_attachment_url( $attachment_id );
			$title = get_the_title( $attachment_id );
			$planimg = get_field('site_plan_image');
		 ?>
		 	<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-site-plan"><a href="<?php echo $url; ?>"><span>V</span>iew <span>S</span>ite <span>P</span>lan</a></h3>
				<p><a href="<?php echo $url; ?>"><img src="<?php echo $planimg['url']; ?>" alt="<?php echo $planimg['alt']; ?>" /></a></p>
			</div>
		<?php } ?>
		<?php if(get_field('availability')) { ?>
			<h3 class="side-property-header side-property-header-availability"><span>A</span>vailability</h3>
				        <table width="100%" cellpadding="0" cellspacing="0" border="0">
			    <tbody><tr>
			        <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle; font-weight: bold;">Lot#</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Acres</td>
			        <td class="Text-Black" style="text-align: center; vertical-align: middle; font-weight: bold;">Price</td>

			    </tr>   
			<?php

				// check if the repeater field has rows of data
				if( have_rows('suite_information') ):


			         
				 	// loop through the rows of data
				    while ( have_rows('suite_information') ) : the_row();
						$attachment = get_sub_field('lot_file'); ?>

        

			<tr>
			    <td class="Text-Black" style="height: 20px; text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_title'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_size'); ?></td>
			    <td class="Text-Black" style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>

			</tr>



				 <?php   endwhile;

				else :

				    // no rows found

				endif;

				?>
							</tbody></table>
		<?php } ?>
		
		<?php if(get_field('add_a_document')) { 
			$attachment_id = get_field('field_name');
			$url = wp_get_attachment_url( $attachment_id );
			$title = get_the_title( $attachment_id );
		?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-documents"></span>D</span>ocuments</h3>
				<p><a href="<?php echo $url; ?>"><?php echo $title; ?></a></p>
			</div>
			
		<?php } ?>

		<?php if(get_field('price_list')) { 
			$attachment_id = get_field('field_name');
			$url = wp_get_attachment_url( $attachment_id );
			$title = get_the_title( $attachment_id );
		?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-price-list"><a href="<?php echo $url; ?>"><span>P</span>rice <span>L</span>ist</a></h3>
			</div>
		<?php } ?>
		<?php if(get_field('featured_builders')) { 	?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-featured-builders"><span>F</span>eatured <span>B</span>uilders</h3>
				<b><?php echo the_field('featured_builders'); ?></b>
			</div>
		<?php } ?>
		<?php if(get_field('community_news')) { 	?>
			<div class="side-property-inner-container">
				<h3 class="side-property-header side-property-header-community-news"><span>C</span>ommunity <span>N</span>ews</h3>
				<b><?php echo the_field('community-news'); ?></b>
			</div>
		<?php } ?>
		
	</div>
	<div class="services-container">

			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> <?php if(in_array('This property is a community', get_field('community_property'))){ echo '/ Community'; } ?> / <a href="<?php echo the_permalink(); ?>"><?php the_title();?></a></p>
		
		<div class="report-container inner-container is-hidden">
			<?php get_template_part('templates/property-portfolio-availability-report'); ?>
		</div>
		<div class="gallery-container inner-container is-hidden">
			<?php get_template_part('templates/property-portfolio-gallery'); ?>
		</div>
		<div class="inner-container home-container">
		<?php if(get_field('description')) { ?>
			<p><?php echo the_field('description'); ?></p>
		<?php } ?>
		<?php if(get_field('address')) { ?>
			<p><strong>Address: </strong><?php echo the_field('address'); ?></p>
		<?php } ?>
		<?php if(get_field('property_type')) { ?>
			<p><strong>Property Type: </strong><?php echo the_field('property_type'); ?></p>
		<?php } ?>
		<?php if(get_field('home_price_max')) { ?>
			<p><strong>Home Price Range: </strong>$<?php echo the_field('home_price_min'); ?> - $<?php echo the_field('home_price_max'); ?></p>
		<?php } ?>
		<?php if(get_field('lot_price_max')) { ?>
			<p><strong>Lot Price Range: </strong>$<?php echo the_field('lot_price_min'); ?> - $<?php echo the_field('lot_price_max'); ?></p>
		<?php } ?>
		<?php if(get_field('schools')) { ?>
			<p><strong>Schools: </strong><?php echo the_field('schools'); ?></p>
		<?php } ?>
		<?php if(get_field('amenities')) { ?>
			<p><strong>Amenities: </strong><?php echo the_field('amenities'); ?></p>
		<?php } ?>
		
		<?php if(get_field('parent_property')) { ?>
			<p><strong>Parent Properties: </strong><?php echo the_field('parent_property'); ?></p>
		<?php } ?>

		<?php 

		$agents = get_field('agent');

		?>
		<?php if($agents) { ?>
			<?php foreach($agents as $agent): 
			$image = get_field('picture', $agent->ID); ?>
				<div class="single-property-agent-container">
					<img src="<?php echo $image['url'];?>"/>
					<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></strong>
					<ul>
						<li><a href="<?php echo get_permalink( $agent->ID ); ?>"><?php echo get_the_title( $agent->ID ); ?>'s Biography</a></li>
						<li><a href="#"><?php echo get_the_title( $agent->ID ); ?>'s Properties</a></li>
					</ul>
				</div>
			<?php endforeach; ?>
		<?php } ?>
		</div>
		



	</div>

		<div class="properties-sidebar-container property-map-sidebar">
			<a href="javascript:window.print()" class="single-property-print"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2015/06/Icon-Print.gif"></a>
			<?php $location = get_field('location');
			if( !empty($location) ): ?>
				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
				<p><?php echo the_field('address'); ?></p>
			<?php endif; ?>
		</div>
	

</div>
<div style="clear: both;"></div>
</div>

<?php comments_template('', false); ?>


<style type="text/css">

.acf-map {
	width: 100%;
	height: 300px;
	border: #ccc solid 1px;
	margin: 20px 0 10px;
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
		mapTypeId	: google.maps.MapTypeId.ROADMAP
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

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
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
	    map.setZoom( 16 );
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