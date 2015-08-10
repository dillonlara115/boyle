<?php
/*
Template Name: Staff Property Page
*/
?>
<?php get_header(); ?>
<article id="content">
<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content">

<?php the_content(); 
$image = get_field('picture'); ?>
<?php $agents = get_field('staff_member');	?>
	<?php if($agents) { ?>
		<?php foreach($agents as $agent): 
		$image = get_field('picture', $agent->ID); ?>
			<div class="single-property-agent-container agent-property-page-agent-container">
				<h1><?php echo get_the_title( $agent->ID ); ?></h1>
				<img src="<?php echo $image['url'];?>"/>
				<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo get_field('email', $agent->ID ); ?></a></strong>
				<span><?php echo the_field('phone_number', $agent->ID ); ?></span>
				<ul>
					<li><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></li>
					<li><a href="<?php echo get_permalink( $agent->ID ); ?>">About <?php echo get_the_title( $agent->ID ); ?></a></li>
				</ul>
			</div>
		<?php endforeach; ?>
	<?php } ?>
	<?php 
	// args for residential property types
	$args = array(
		'post_type'		=> 'properties',
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'agent',
				'value'		=> $agent->ID,
				'compare'	=> 'LIKE'
			),
		)
	);
	// query
	$the_query = new WP_Query( $args );
?>

	<?php if( $the_query->have_posts() ): ?>
		<div class="acf-map">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php
					$location = get_field('location');
					$gtemp = explode (',',  implode($location));
					$coord = explode (',', implode($gtemp));
				?>

				<div class="marker" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>">
					<p class="address"><?php the_title(); ?></p>		
				</div>		
			<?php endwhile; ?>
		</div>
		<?php endif; ?>

</div>
<div style="clear:both;"></div>
<hr>
Properties
<hr>



	<?php if( $the_query->have_posts() ): ?>
		<div class="property-type-list-content property-list-container">
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
				$images = get_field('property_gallery');
				$image_1 = $images[0];  
				$agents = get_field('agent');	
			?>
				<li>
				<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
					<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
						<?php if($agents) { ?>
							<?php foreach($agents as $agent): ?>
								<strong class="pull-right"><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></strong>
							<?php endforeach; ?>
						<?php } ?>
						<p><?php echo the_field('description'); ?></p>

						<?php
						// check if the repeater field has rows of data
						if( have_rows('suite_information_acres') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_acres') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>

						<?php elseif( have_rows('suite_information_feet') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_feet') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>
						<?php else :
							// no rows found
						endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>
			</div>
		<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>


</div>


</article>
<?php get_sidebar(); ?>


<style type="text/css">

.acf-map {
	width: 500px;
	height: 300px;
	border: #ccc solid 1px;
	display: inline-block;
	float: right;
}
@media (max-width: 48em) {
	float: none;
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
	var color = '#466989';
	var pincolor = '#466989';

	// if(color === "YOUR_ACF_VARIABLE") { var pincolor = 'teal'; }
	// else if(color === "YOUR_ACF_VARIABLE") { var pincolor = 'red'; }

	function pinSymbol(color) {
		return {
			path: 'm56.9631,0.75c-31.05667,0 -56.2131,25.16236 -56.2131,56.20168c0,31.05099 56.2131,135.79832 56.2131,135.79832s56.19011,-104.74733 56.19011,-135.79832c0,-31.03931 -25.15656,-56.20168 -56.19011,-56.20168zm0,83.06174c-14.84224,0 -26.87169,-12.01827 -26.87169,-26.86006s12.02945,-26.85426 26.87169,-26.85426s26.84848,12.02344 26.84848,26.85426s-12.0293,26.86006 -26.84848,26.86006z',
			fillColor: color,
			fillOpacity: 1,
			strokeColor: '#000',
			strokeWeight: 1,
			scale: .2,
			};
		}

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: pinSymbol(pincolor)
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