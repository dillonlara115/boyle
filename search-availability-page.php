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
				$transaction = $$_GET['transaction']; 

		?>
		<div class="search-availability-content">
			<?php wp_nav_menu( array('menu' => 'Search Availability Menu' )); ?>
			<div class="property-type-list-content" id="search-houses">
				<h2><?php the_title(); ?></h2>	
				<?php the_content(); ?>
				<div class="left-content">
				<form class='search-availability-form' action="" method="post">
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
								<option class="filter" name="region" data-filter="<?php echo $name; ?>" value="<?php echo $name; ?>"><?php echo $key; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<br>
					
						<?php if (strstr($_SERVER['REQUEST_URI'], "memphis_metro_area")){ 
							$regionName = 'Greater Memphis';
							?>
						<div class="metro-filters search-filters">
						<strong>Metro Area</strong>
							<?php 
							/*
							*  Get a field object and create a select form element
							*/

							$field_key = "field_55929f284c5fd";
							$field = get_field_object($field_key);

							if( $field ) {
								echo '<select size="5" name="metroarea">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option class="filter" name="metroarea" data-filter="' . $k . '"  value="' . $k . '">' . $v . '</option>';
									}
								echo '</select>';
							} ?>
							</div>
						<br>
						<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'nashville_metro_area')){ 
								$regionName = 'Greater Nashville';
							?>
							
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
									echo '<select size="5" name="metroarea">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option name="metroarea" value="' . $k . '">' . $v . '</option>';
									}
									echo '</select>';
								}
								?>
								</div>
						<br>
						<?php } elseif (strstr($_SESSION['metroarea'], 'other')){ 
							$regionName = 'Other';
							?>
								
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
									echo '<select size="5" name="metroarea">';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option name="metroarea" value="' . $k . '">' . $v . '</option>';
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
									echo '<input type="checkbox" name="transaction[' . $k . ']"  class="filter" data-filter="' . $k . '"  value="' . $k . '"/><small>' . $v . '</small>';
								}
									
							} ?>
						</div>
						<br>
						<?php if (is_page(312) ){ ?>
								
							<div class="search-filters">
								<strong>Community</strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/


								
								$community_property = array(
									'post_type' 	=> 'properties',
								    'meta_query' => array(
								        array(
								            'key' => 'community_property', // name of custom field
								            'value' => '"This property is a community"', // matches exaclty "red", not just red. This prevents a match for "acquired"
								            'compare' => 'LIKE'
								        )
								    )
								);

									$the_query = new WP_Query( $community_property );
							?>
							<?php if( $the_query->have_posts() ): ?>
								<select name="community">
									<option name="community" value="...">...</option>
									<?php	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<option name="community" value="<?php echo the_title(); ?>"><?php echo the_title(); ?></option>
									<?php endwhile;?>
								</select>
							<?php endif;?>
							</div>
							<br>
							<div class="search-filters">
								<strong>Type</strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55491064e5755";
								$field = get_field_object($field_key);

								if( $field )
								{
									echo '<select name="residentialType">';
									echo '<option name="residentialType" value="...">...</option>';
									foreach( $field['choices'] as $k => $v )
									{
										echo '<option name="residentialType" value="' . $k . '">' . $v . '</option>';
									}
									echo '</select>';
								}
								?>
							</div>
						<?php } ?>
						<br>
						<?php if ( is_page(308) || is_page(310) || is_page(314)) { ?>
							<div class="search-filters">
							<strong>Square Ft.: </strong>
								<select name="squareFeet">
									<option class="filter" name="squareFeet" data-filter=""  value="...">...</option>
									<option class="filter" name="squareFeet" data-filter=""  value="0 - 5000">0 - 5000</option>
									<option class="filter" name="squareFeet" data-filter=""  value="5000 - 10000">5000 - 10000</option>
									<option class="filter" name="squareFeet" data-filter=""  value="10,000 - 15,000">10,000 - 15,000</option>
									<option class="filter" name="squareFeet" data-filter=""  value="15,000 - 20,000">15,000 - 20,000</option>
									<option class="filter" name="squareFeet" data-filter=""  value="20,000 - 25,000">20,000 - 25,000</option>
									<option class="filter" name="squareFeet" data-filter=""  value="25,000+">25,000+</option>
								</select>
							</div>
							<br>
							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="lotSize">
									<option class="filter" name="lotSize" data-filter=""  value="...">...</option>
									<option class="filter" name="lotSize" data-filter=""  value="2 or less">2 or less</option>
									<option class="filter" name="lotSize" data-filter=""  value="2 - 5">2 - 5</option>
									<option class="filter" name="lotSize" data-filter=""  value="5 - 10">5 - 10</option>
									<option class="filter" name="lotSize" data-filter=""  value="10 - 20">10 - 20</option>
									<option class="filter" name="lotSize" data-filter=""  value="greater than 20">greater than 20</option>
								</select>
								<span>(Acres)</span>
							</div>
						<?php } ?>
						<?php if ( is_page(312)) { ?> 
							<div class="search-filters">
								<strong>Lot Price: </strong>
								<select name="lotPrice">
									<option class="filter" name="lotPrice" data-filter=""  value="...">...</option>
									<option class="filter" name="lotPrice" data-filter=""  value="less than $80,000">less than $80,000</option>
									<option class="filter" name="lotPrice" data-filter=""  value="$80,000 - 150,000">$80,000 - 150,000</option>
									<option class="filter" name="lotPrice" data-filter=""  value="$150,000 - 300,000">$150,000 - 300,000</option>
									<option class="filter" name="lotPrice" data-filter=""  value="Greater than $300,000">Greater than $300,000</option>
								</select>
							</div>
							<br>
							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="lotSize">
									<option class="filter" name="lotSize" data-filter=""  value="...">...</option>
									<option class="filter" name="lotSize" data-filter=""  value="2 or less">2 or less</option>
									<option class="filter" name="lotSize" data-filter=""  value="2 - 5">2 - 5</option>
									<option class="filter" name="lotSize" data-filter=""  value="5 - 10">5 - 10</option>
									<option class="filter" name="lotSize" data-filter=""  value="10 - 20">10 - 20</option>
									<option class="filter" name="lotSize" data-filter=""  value="greater than 20">greater than 20</option>
								</select>
								<span>(Acres)</span>
							</div>
						<?php }?>
						<hr>
						<input type="submit" name="submit" value="search">	
						</form>
					</div>
					<?php 

					 // starting the session
					 session_start();

				 	 $_SESSION = array();
					 if (isset($_POST['submit'])) { 
					 	 $_SESSION['region'] = $_POST['region'];
						 $_SESSION['metroarea'] = $_POST['metroarea'];
						 $_SESSION['transaction'] = $_POST['transaction'];
						 $_SESSION['residentialType'] = $_POST['residentialType'];
						 $_SESSION['community'] = $_POST['community'];
						 $_SESSION['squareFeet'] = $_POST['squareFeet'];
						 $_SESSION['lotSize'] = $_POST['lotSize'];
						 $_SESSION['lotPrice'] = $_POST['lotPrice'];
					 } 
					?> 

					<strong>region: <?php echo $region; ?></strong>
					<strong>metro area: <?php echo $_SESSION['metroarea'];?></strong>
					<strong>session transaction: 
						<?php 
							foreach ($_SESSION['transaction'] as $key => $transaction_value) {
						 	 echo $transaction_value;
						 }?>
						 
					 </strong>
					<strong> community: <?php echo $_SESSION['community']; ?></strong>
					<strong> Lot Size: <?php echo $_SESSION['lotSize']; ?></strong>
					<strong> Square Feet: <?php echo $_SESSION['squareFeet']; ?></strong>

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

					
					<?php if( $_SESSION['squareFeet'] == '0 - 5000') { 
						$sqValue = array(0, 5000);
					} elseif( $_SESSION['squareFeet'] == '5000 - 10000') { 
						$sqValue = array(5000, 10000);
					} elseif( $_SESSION['squareFeet'] == '10,000 - 15,000') {
						$sqValue = array(10000, 15000);
					} elseif( $_SESSION['squareFeet'] == '15,000 - 20,000') { 
						$sqValue = array(15000, 20000);
				    } elseif( $_SESSION['squareFeet'] == '20,000 - 25,000') { 
						$sqValue = array(20000, 25000);
					} elseif( $_SESSION['squareFeet'] == '25,000+') { 
						$sqValue = array(25000, 2500000);
				    } ?>


			    	<?php if( $_SESSION['lotSize'] == '2 or less') { 
						$lotValue = array(0, 2);
					} elseif( $_SESSION['lotSize'] == '2 - 5') { 
						$lotValue = array(2, 5);
					} elseif( $_SESSION['lotSize'] == '5 - 10') {
						$lotValue = array(5, 10);
					} elseif( $_SESSION['lotSize'] == '10 - 20') { 
						$lotValue = array(10, 20);
				    } elseif( $_SESSION['lotSize'] == 'greater than 20') { 
						$lotValue = array(20, 2500000);
				    } ?>

			    	<?php if( $_SESSION['lotPrice'] == 'less than $80,000') { 
						$lotPrice = array(0, 80000);
					} elseif( $_SESSION['lotPrice'] == '$80,000 - 150,000') { 
						$lotPrice = array(80000, 150000);
					} elseif( $_SESSION['lotPrice'] == '$150,000 - 300,000') {
						$lotPrice = array(150000, 300000);
					} elseif( $_SESSION['lotPrice'] == 'Greater than $300,000') { 
						$lotPrice = array(300000, 3000000000);
				    } ?>
					
					<?php 

						$transactionQuery = array();
						if(isset($transaction_value)){
							$transactionQuery[] = array(
								'key'		=> 'transaction_type',
								'value'		=>  $transaction_value,
								'compare'	=> 'LIKE'
							);
						};
						$squareFeetQuery = array();
						if(isset($sqValue)){
							$squareFeetQuery[] = array(
								'key'		=> 'total_square_feet',
								'value'		=>  $sqValue,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$lotSizeQuery = array();
						if(isset($lotValue)){
							$lotSizeQuery[] = array(
								'key'		=> 'lot_size_max_acres',
								'value'		=>  $lotValue,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$lotPriceQuery = array();
						if(isset($lotPrice)){
							$lotPriceQuery[] = array(
								'key'		=> 'lot_price_min',
								'value'		=>  $lotPrice,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$residentialTypeQuery = array();
						if(isset($_SESSION['residentialType'])){
							echo 'residential type has been set';
							$residentialTypeQuery[] = array(
								'key'		=> 'residential_type',
								'value'		=>  $_SESSION['residentialType'],
								'compare'	=> 'LIKE'
							);
						};
						$mapposts = new WP_Query( array( 
							'post_type' 	=> 'properties',
							'orderby' => 'title',
							'order'   => 'ASC',
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
									'key'		=> 'region_name',
									'value'		=> $regionName,
									'compare'	=> 'LIKE'
									),
								array(
									'key'		=> $region,
									'value'		=> $_SESSION['metroarea'],
									'compare'	=> 'LIKE'
									),
								$residentialTypeQuery,
								$transactionQuery,
								$squareFeetQuery,
								$lotSizeQuery,
								$lotPriceQuery,

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



<div class="search-availability-results property-list-container">
	<h3>Search Results</h3>	
	<hr>

	<?php 
	$args = array(
		'post_type'		=> 'properties',
		'meta_query'	=> array(
			'relation'		=> 'AND',
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
				'value'		=> $_SESSION['metroarea'],
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'transaction_type',
				'value'		=>  $transaction_value,
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'residential_type',
				'value'		=>  $_SESSION['residentialType'],
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'community',
				'value'		=>  $_SESSION['community'],
				'compare'	=> 'LIKE'
				),
			array(
				'key'		=> 'total_square_feet',
				'value'		=>  $sqValue,
				'type'		=> 'numeric',
				'compare'	=> 'BETWEEN'
				),
			array(
				'key'		=> 'lot_size_max_acres',
				'value'		=>  $lotValue,
				'type'		=> 'numeric',
				'compare'	=> 'BETWEEN'
				),
			array(
				'key'		=> 'lot_price_min',
				'value'		=>  $lotPrice,
				'type'		=> 'numeric',
				'compare'	=> 'BETWEEN'
				),
			),
		);
					// query
	$the_query = new WP_Query( $mapposts );
	?>
	<?php if( $mapposts->have_posts() ): ?>
		<p>Found <strong><?php echo $mapposts->post_count ?></strong> property(s) matching your search criteria.</p>
		<ul>
			<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); 
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
	<?php else :
		echo 'no results found';
	 endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<hr>
</div>
<script type="text/javascript">
	(function($) {

	// change
	$('#archive-filters').on('change', 'select', function(){
		// vars
		var url = '<?php the_permalink() ?>';
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