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
		<?php 	$region = $_GET['region']; 
				$metro_area = $_GET['metroarea']; 
		?>
		<div class="search-availability-content">
			<?php wp_nav_menu( array('menu' => 'Search Availability Menu' )); ?>
			<div class="property-type-list-content" id="search-houses">
				<h2><?php the_title(); ?></h2>	
				<?php the_content(); ?>
				<div class="left-content">
					<div id="archive-filters" class="search-filters">
						<strong>Region</strong>
						<select>
							<?php foreach( $GLOBALS['my_query_filters'] as $key => $name ): 	
								// get the field's settings without attempting to load a value
								$field = get_field_object($key, false, false);

								// set value if available
								if( isset($_GET[ $name ]) ) {
									$field['value'] = explode(',', $_GET[ $name ]);
								}
								// create filter
								?>
								<option class="filter" data-filter="<?php echo $name; ?>" value="<?php echo $name; ?>"><?php echo $key; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<br>
					
						<?php if (strstr($_SERVER['REQUEST_URI'], "memphis_metro_area")){ ?>
						
						<div class="metro-filters search-filters">
						<strong>Metro Area</strong>
							<?php 
							/*
							*  Get a field object and create a select form element
							*/

							$field_key = "field_55929f284c5fd";
							$field = get_field_object($field_key);

							if( $field ) {
								echo '<select size="5" name="' . $field['key'] . '">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option class="filter" data-filter="' . $k . '"  value="' . $k . '">' . $v . '</option>';
									}
								echo '</select>';
							} ?>
							</div>
						<br>
						<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'nashville_metro_area')){ ?>
							
							<div class="metro-filters search-filters">
							<strong>Metro Area</strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55929e4b4c5fc";
								$field = get_field_object($field_key);

								if( $field )
								{
									echo '<select size="5" name="' . $field['key'] . '">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option value="' . $k . '">' . $v . '</option>';
									}
									echo '</select>';
								}
								?>
								</div>
						<br>
						<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'other')){ ?>
								
								<div class="metro-filters search-filters">
								<strong>Metro Area</strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55929fc74c5fe";
								$field = get_field_object($field_key);

								if( $field )
								{
									echo '<select size="5" name="' . $field['key'] . '">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option value="' . $k . '">' . $v . '</option>';
									}
									echo '</select>';
								}
								?>
								</div>
						<br>
						<?php } ?>
						<div class="search-filters">
							<strong>Transaction:</strong>
							<?php 
							/*
							*  Get a field object and create a select form element
							*/

							$field_key = "field_55490ec27d601";
							$field = get_field_object($field_key);

							if( $field ) {
								
								foreach( $field['choices'] as $k => $v )
								{
									echo '<input type="checkbox" class="filter" data-filter="' . $k . '"  value="' . $k . '"/><small>' . $v . '</small>';
								}
									
							} ?>
						</div>
					</div>
					<?php if ( is_page( 1059) ) {  
						$value = array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office');
					} elseif ( is_page( 316) ) { 
						$value = 'Hotels';
					} elseif ( is_page( 314) ) {  
						$value = 'Industrial';
					} elseif ( is_page( 318) ) { 
					 $value = 'Land';
					} elseif ( is_page( 306) ) {  
						$value = 'Mixed-Use';
					} elseif ( is_page( 308) ) { 
					$value = 'Office';
					} elseif ( is_page( 312) ) {
						$value = 'Residential';
					} elseif ( is_page( 310) ) { 
						$value = 'Retail';
					} ?>
					<?php 
						$mapposts = new WP_Query( array( 
							'post_type' 	=> 'properties',
							'meta_query'	=> array(
								'relation'	=> 'AND',
								array(
									'key'		=> 'property_type',
									'value'		=> $value,
									'compare'	=> 'LIKE'
									),
								array(
									'key'		=> 'activate_property',
									'value'		=> 'This property is active',
									'compare'	=> 'LIKE'
									),
								array(
									'key'		=> $region,
									'value'		=> $metro_area,
									'compare'	=> 'LIKE'
									)
								), 
							) 
						);
					?>
					
					<div class="acf-map">

						<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); ?>
						<?php
							$location = get_field('location');
							$gtemp = explode (',',  implode($location));
							$coord = explode (',', implode($gtemp));
						?>

							<div class="marker" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>">
								<p class="address"><?php the_title(); ?></p>		
							</div>

									
						<?php endwhile; ?>
					
					</div><!-- .acf-map -->
				</div>
			</div>
			<?php if ( is_page( 1059) ) {   ?>

			    <?php get_template_part('templates/search-availability/all-search-availability'); ?>

			<?php } elseif ( is_page( 316) ) {  ?>

				<?php get_template_part('templates/search-availability/hotels-search-availability'); ?>

			<?php } elseif ( is_page( 314) ) {  ?>
					
				<?php get_template_part('templates/search-availability/industrial-search-availability'); ?>

			<?php } elseif ( is_page( 318) ) {  ?>

				<?php get_template_part('templates/search-availability/land-search-availability'); ?>

			<?php } elseif ( is_page( 306) ) {  ?>

				<?php get_template_part('templates/search-availability/mixed-use-search-availability'); ?>

			<?php } elseif ( is_page( 308) ) { ?>

				<?php get_template_part('templates/search-availability/office-search-availability'); ?>

			<?php } elseif ( is_page( 312) ) {  ?>

				<?php get_template_part('templates/search-availability/residential-search-availability'); ?>
			<?php } elseif ( is_page( 310) ) { ?>
				<?php get_template_part('templates/search-availability/retail-search-availability'); ?>

			<?php } ?>

</div>
<script type="text/javascript">
	(function($) {

	// change
	$('#archive-filters').on('change', 'select', function(){
		// vars
		var url = window.location.href;
		args = {};

		// loop over filters
		$('#archive-filters').each(function(){
			// vars
			var filter = $(this).data('filter'),
			vals = [];
			
			// find checked inputs
			$(this).find('option:selected').each(function(){
				vals.push( $(this).val() );
			});
			
			// append to args
			args[ filter ] = vals.join(',');
		});
		
		// update url
		url += '?';

		// loop over args
		$.each(args, function( name, value ){
			url += 'region=' + value + '&';
		});
		
		
		
		// reload page
		window.location.replace( url );

	});

	// change
	$('.metro-filters').on('change', 'select', function(){
		// vars
		var url = window.location.href;
		args = {};

		// loop over filters
		$('.metro-filters').each(function(){
			// vars
			var filter = $(this).data('filter'),
			vals = [];
			
			// find checked inputs
			$(this).find('option:selected').each(function(){
				vals.push( $(this).val() );
			});
			
			// append to args
			args[ filter ] = vals.join(',');
		});
		
		
		
		// loop over args
		$.each(args, function( name, value ){
			url += '&metroarea=' + value + '&';
		});
		
		
		
		// reload page
		window.location.replace( url );

	});

	// change
	$('search-filters').on('change', 'input[type="checkbox"]', function(){

		// vars
		var url = window.location.href;
			args = {};
			
		
		// loop over filters
		$('search-filters .filter').each(function(){
			
			// vars
			var filter = $(this).data('filter'),
				vals = [];
			
			
			// find checked inputs
			$(this).find('input:checked').each(function(){
	
				vals.push( $(this).val() );
	
			});
			
			
			// append to args
			args[ filter ] = vals.join(',');
			
		});
		
		
		// update url
		url += '?';
		
		
		// loop over args
		$.each(args, function( name, value ){
			
			url += name + '=' + value + '&';
			
		});
		
		
		// remove last &
		url = url.slice(0, -1);
		
		
		// reload page
		window.location.replace( url );
		

	});

})(jQuery);
</script>
<style type="text/css">

.acf-map {
	width: 400px;
	height: 400px;
	border: #ccc solid 1px;
	
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
		mapTypeId	: google.maps.MapTypeId.mapTypeId
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