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
				<h1 class="agent-property-page-name Title-Blue"><?php echo get_the_title( $agent->ID ); ?></h1>
				<img src="<?php echo $image['url'];?>"/>
				
				<strong><a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo get_field('email', $agent->ID ); ?></a></strong>
				<span><?php echo the_field('phone_number', $agent->ID ); ?></span>
				<ul>
					<li><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact Me</a></li>
					<li><a href="<?php echo get_permalink( $agent->ID ); ?>">About Me</a></li>
				</ul>
			</div>
		<?php endforeach; ?>
	<?php } ?>
	<?php 
	// args for residential property types
	$args = array(
		'post_type'		=> 'properties',
		'orderby'	=> 'title',
		'order'		=> 'ASC',
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
		<div class="outer-map">
		<div class="acf-map">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php
							$location = get_field('location');
							$gtemp = explode (',',  implode($location));
							$coord = explode (',', implode($gtemp));
							$images = get_field('property_gallery');
							$image_1 = $images[0]; 
						?>

							<div class="marker" style="display: none;" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>" data-col="available">
								<a href="<?php the_permalink(); ?>" class="map-image">
									<?php if( $images ) { ?>
					            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
									<?php } elseif (has_post_thumbnail()) { ?>
										<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
									<?php 	} else { ?>
										<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/09/No-Photo-Available.gif" class="availability-report-image"/>
									<?php } ?> 
								</a>
								<p class="address map-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
								<p class="map-text black-text"><?php the_field('address'); ?>, <?php the_field('city'); ?>, <?php the_field('zip_code'); ?></p>		
							</div>

									
						<?php endwhile; ?>
					<?php endif; ?>

</div>
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
				<li class="result-item">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>">
						<?php if( $images ) { ?>
		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
						<?php } elseif (has_post_thumbnail()) { ?>
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
						<?php 	} else { ?>
							<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/09/No-Photo-Available.gif" class="availability-report-image"/>
						<?php } ?> 
					</a>
					<?php if($agents) { ?>
					<?php foreach($agents as $agent): ?>
						<p class="result-item-agent-info">
							<strong class="result-item-agent"><a href="<?php echo the_field('agent_property_page', $agent->ID); ?>"><?php echo get_the_title( $agent->ID ); ?></a></strong><br>
							<?php echo the_field('phone_number', $agent->ID); ?><br>
							<a href="mailto:<?php echo the_field('email', $agent->ID); ?>"><?php echo the_field('email', $agent->ID); ?></a>
						</p>
					<?php endforeach; ?>
					<?php } ?>
				</div>	
				<div class="result-content">
				<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
				
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
							        <td style="text-align: center; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>

						<?php elseif( have_rows('suite_information_feet') ): ?>
							<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
							    <tbody><tr class="Header">
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Suite</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Sq. Feet</td>
							        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
							    </tr>
									    
						  <?php  while ( have_rows('suite_information_feet') ) : the_row();
								$attachment = get_sub_field('lot_file'); ?>

						         <tr class="Item">
							        <td style="text-align: center; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
							        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
							        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
							    </tr> 

						 <?php  endwhile; ?>
										
						</tbody></table>
						<?php else :
							// no rows found
						endif; ?>
					</div>
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
	width: 100%;
	height: 250px;
	border: #ccc solid 1px;
	
}

.outer-map {
	border-left: 1px dashed #ccc;
	padding-left: 1em;
	width: 65%;
	display: inline-block;
	float: right;
}
@media (max-width: 48em) {
	.acf-map {
		float: none;
	}
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
		zoom		: 8,
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
 
// create info window outside of each - then tell that singular infowindow to swap content based on click
var infowindow = new google.maps.InfoWindow({
	content		: '' 
});


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
	 if(color === "available") { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-RedDot.png'; }
	 else if(color === "not-available") { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png'; }

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png'

		});
 
	// add to array
	map.markers.push( marker );
 
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
// show info window when marker is clicked & close other markers
	google.maps.event.addListener(marker, 'click', function() {
		//swap content of that singular infowindow
				infowindow.setContent($marker.html());
		        infowindow.open(map, marker);
	});
	
	// close info window when map is clicked
	     google.maps.event.addListener(map, 'click', function(event) {
	        if (infowindow) {
	            infowindow.close(); }
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
 	if( map.markers.length == 0 )
	{
		map.setCenter({lat: 35.496456, lng: -89.165039});
		map.setZoom(5);
	}
	// only 1 marker?
	else if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 8 );
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