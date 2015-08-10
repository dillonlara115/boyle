<?php
/*
Template Name: Search Availability Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Icon-MagnifyingGlass.gif" alt="Search Availability" title="Search Availability" class="header-image">

	<h1 class="contact-page-title">Search Availability:</h1>
	<p class="contact-page-text">Select the tab of the property type you are interested in searching. Then use the fields to specify your search criteria. Enter more search criteria for a smaller list of results.</p>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<?php 	$region = $_GET['region']; 
				$metro_area = $_GET['metroarea']; 
				$transaction = $_GET['transaction']; 
				$designatedUses = $_GET['designatedUses']; 
				$industrialType = $_GET['industrialType']; 
		?>
		<div class="search-availability-content">
			<?php wp_nav_menu( array('menu' => 'Search Availability Menu' )); ?>
			<form class='search-availability-form' name="searchform" action="" method="post">
			<div class="property-type-list-content" id="search-houses">
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
						<?php if (is_page(306) || is_page(308) || is_page(310) || is_page(314) || is_page(316) || is_page(318)){ ?>  
							<?php
							$propertyPosts = new WP_Query( array( 
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
								$designatedUsesQuery,
								$landLotSizeQuery,
								$landLotPriceQuery,
								$numberOfRoomsQuery,
								$industrialTypeQuery,
								$homePriceQuery,
								$lotNumberQuery,
								$lotAddressQuery
								),
							) 
						);?>
							<div class="search-filters">
								<strong>Property:</strong>
								<select class="property-select">
								<?php $the_query = new WP_Query( $propertyPosts ); ?>
									<?php if( $propertyPosts->have_posts() ): ?>
										<?php while ( $propertyPosts->have_posts() ) : $propertyPosts->the_post(); ?>
											<option data-permalink="<?php the_permalink(); ?>"><?php the_title(); ?> </option>
										<?php endwhile; ?>
									<?php endif; ?>
								</select>
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
						<?php if (is_page(314) ){ ?> 
						<div class="search-filters">
							<strong>Type: </strong>
							<?php 
							/*
							*  Get a field object and create a select form element
							*/

							$field_key = "field_55491012e5753";
							$field = get_field_object($field_key);

							if( $field ) {
								
								foreach( $field['choices'] as $k => $v )
								{
									echo '<input type="checkbox" name="industrialType[' . $k . ']"  class="filter" data-filter="' . $k . '"  value="' . $k . '"/><small>' . $v . '</small>';
								}
									
							} ?>
							</div>
							<br>
						<?php } ?>
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
						<?php } ?>
						<?php if ( is_page(308) || is_page(310)) { ?>
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
							<br>
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
							<br>
						<?php }?>
						<?php if ( is_page(316)) { ?> 
							<div class="search-filters">
								<strong># Rooms: </strong>
								<select name="numberOfRooms">
									<option class="filter" name="numberOfRooms" data-filter=""  value="...">...</option>
									<option class="filter" name="numberOfRooms" data-filter=""  value="100 - 150">100 - 150</option>
									<option class="filter" name="numberOfRooms" data-filter=""  value="150 - 250">150 - 250</option>
									<option class="filter" name="numberOfRooms" data-filter=""  value="Greater than 250">Greater than 250</option>
								</select>
							</div>
							<br>
							
						<?php }?>
						<?php if ( is_page(318)) { ?> 
							<div class="search-filters">
								<strong>Designated Uses: </strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55490ee27d602";
								$field = get_field_object($field_key);

								if( $field ) {
									
									foreach( $field['choices'] as $k => $v )
									{
										echo '<input type="checkbox" name="designatedUses[' . $k . ']"  class="filter" data-filter="' . $k . '"  value="' . $k . '"/><small>' . $v . '</small>';
									}
										
								} ?>
							</div>
							<div class="search-filters">
								<strong>Lot Price: </strong>
								<select name="landLotPrice">
									<option class="filter" name="landLotPrice" data-filter=""  value="...">...</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="less than $5,000">less than $5,000</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="$5,000 - 10,000">$5,000 - $10,000</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="10,000 - 15,000">$10,000 - $15,000</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="15,000 - 20,000">$15,000 - $20,000</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="20,000 - 25,000">$20,000 - $25,000</option>
									<option class="filter" name="landLotPrice" data-filter=""  value="Greater than 25,000">Greater than $25,000</option>
								</select>
							</div>
							<br>
							
						<?php }?>
						<?php if ( is_page(316) || is_page(318) || is_page(314)) { ?> 

							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="landLotSize">
									<option class="filter" name="landLotSize" data-filter=""  value="...">...</option>
									<option class="filter" name="landLotSize" data-filter=""  value="100000 or less">100,000 or less</option>
									<option class="filter" name="landLotSize" data-filter=""  value="100000 - 500000">100,000 - 500,000</option>
									<option class="filter" name="landLotSize" data-filter=""  value="500000 - 1000000">500,000 - 1,000,000</option>
									<option class="filter" name="landLotSize" data-filter=""  value="1000000 - 2000000">1,000,000 - 2,000,000</option>
									<option class="filter" name="landLotSize" data-filter=""  value="greater than 2000000">greater than 2,000,000</option>
								</select>
								<span>(Sq. Ft.)</span>
							</div>
							<br>
						<?php } ?>
						<?php if ( is_page(312)) { ?> 
							<div class="search-filters">
							<strong>Lot Number: </strong>
								<input type="text" name="lotNumberInput" />
							</div>
							<br>
							<div class="search-filters">
							<strong>Lot Address: </strong>
								<input type="text" name="lotAddressInput" />
							</div>
							<br>
							<div class="search-filters">
							<strong>Home Price: </strong>
								<select name="homePrice">
									<option class="filter" name="homePrice" data-filter=""  value="Any">Any</option>
									<option class="filter" name="homePrice" data-filter=""  value="less than 250000">less than $250,000</option>
									<option class="filter" name="homePrice" data-filter=""  value="250000 - 500000">$250,000 - $500,000</option>
									<option class="filter" name="homePrice" data-filter=""  value="500000 - 1000000">$500,000 - $1,000,000</option>
									<option class="filter" name="homePrice" data-filter=""  value="greater than 1000000">greater than $1,000,000</option>
								</select>
							</div>
							<br>
							<div class="search-filters">
							<strong>MLS #: </strong>
								<input type="text" name="mlsInput" />
							</div>
							<br>
						<?php } ?>


						<hr>
						<input type="submit" name="submit" class="search-availability-button" value="search">	
					
					</div>
					<?php 

					 // starting the session
					 session_start();
					 	
				 	  $_SESSION = array();
					 if (isset($_POST['submit'])) { 
					 	 $_SESSION['search-form'] = $_POST;
						 $_SESSION['metroarea'] = $_POST['metroarea'];
						 $_SESSION['transaction'] = $_POST['transaction'];
						 $_SESSION['residentialType'] = $_POST['residentialType'];
						 $_SESSION['community'] = $_POST['community'];
						 $_SESSION['squareFeet'] = $_POST['squareFeet'];
						 $_SESSION['lotSize'] = $_POST['lotSize'];
						 $_SESSION['lotPrice'] = $_POST['lotPrice'];
						 $_SESSION['landLotSize'] = $_POST['landLotSize'];
						 $_SESSION['landLotPrice'] = $_POST['landLotPrice'];
						 $_SESSION['orderResults'] = $_POST['orderResults'];
						 $_SESSION['resultsPerPage'] = $_POST['resultsPerPage'];
						 $_SESSION['designatedUses'] = $_POST['designatedUses'];
						 $_SESSION['numberOfRooms'] = $_POST['numberOfRooms'];
						 $_SESSION['industrialType'] = $_POST['industrialType'];
						 $_SESSION['homePrice'] = $_POST['homePrice'];
						 $_SESSION['lotNumberInput'] = $_POST['lotNumberInput'];
						 $_SESSION['lotAddressInput'] = $_POST['lotAddressInput'];
					 } 
					?> 

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

				    <?php if( $_SESSION['landLotSize'] == '100000 or less') { 
						$landLotSize = array(0, 100000);
					} elseif( $_SESSION['landLotSize'] == '100000 - 500000') { 
						$landLotSize = array(100000, 500000);
					} elseif( $_SESSION['landLotSize'] == '500000 - 1000000') {
						$landLotSize = array(500000, 1000000);
					} elseif( $_SESSION['landLotSize'] == '1000000 - 2000000') { 
						$landLotSize = array(1000000, 2000000);
				    } elseif( $_SESSION['landLotSize'] == 'greater than 2000000') { 
						$landLotSize = array(2000000, 25000000);
				    } ?>

			    	<?php if( $_SESSION['landLotPrice'] == 'less than $5,000') { 
						$landLotPrice = array(0, 5000);
					} elseif( $_SESSION['landLotPrice'] == '5,000 - 10,000') { 
						$landLotPrice = array(5000, 10000);
					} elseif( $_SESSION['landLotPrice'] == '10,000 - 15,000') {
						$landLotPrice = array(10000, 15000);
					} elseif( $_SESSION['landLotPrice'] == '15,000 - 20,000') {
						$landLotPrice = array(15000, 20000);
					} elseif( $_SESSION['landLotPrice'] == '20,000 - 25,000') {
						$landLotPrice = array(20000, 25000);
					} elseif( $_SESSION['landLotPrice'] == 'Greater than 25,000') { 
						$landLotPrice = array(25000, 3000000000);
				    } ?>

				    <?php if( $_SESSION['numberOfRooms'] == '100 - 150') { 
						$numberOfRooms = array(100, 150);
					} elseif( $_SESSION['numberOfRooms'] == '150 - 250') { 
						$numberOfRooms = array(150, 250);
					} elseif( $_SESSION['numberOfRooms'] == 'Greater than 250') { 
						$numberOfRooms = array(250, 3000000000);
				    } ?>

				     <?php if( $_SESSION['homePrice'] == 'less than 250000') { 
						$homePrice = array(0, 250000);
					} elseif( $_SESSION['homePrice'] == '250000 - 500000') { 
						$homePrice = array(250000, 500000);
					} elseif( $_SESSION['homePrice'] == '500000 - 1000000') { 
						$homePrice = array(500000, 1000000);
					} elseif( $_SESSION['homePrice'] == 'greater than 1000000') { 
						$homePrice = array(1000000, 30000000000);
				    } ?>


				    <?php if( $_SESSION['orderResults'] == 'ASC') { 
						$orderResults = 'title';
					} elseif( $_SESSION['orderResults'] == 'sqfootage') { 
						$orderResults = 'total_square_feet';
					} elseif( $_SESSION['orderResults'] == 'acreage') {
						$orderResults = 'lot_size_min_acres';
					} elseif( $_SESSION['orderResults'] == 'newest') { 
						$orderResults = 'year_built';
				    } elseif( $_SESSION['orderResults'] == 'priceLow') { 
						$orderResults = 'lot_price_min';
				    } elseif( $_SESSION['orderResults'] == 'priceHigh') { 
						$orderResults = 'lot_price_max';
				    } else {
				    	$orderResults = 'title';
				    } ?>



				    <?php if( $_SESSION['resultsPerPage'] == 15) { 
						$resultsPerPage = 15;
					} elseif( $_SESSION['resultsPerPage'] == 25) { 
						$resultsPerPage = 25;
					} elseif( $_SESSION['resultsPerPage'] == 50) {
						$resultsPerPage = 50;
				    } else {
				    	$resultsPerPage = 15;
			    	}?>
					
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
						$landLotSizeQuery = array();
						if(isset($landLotValue)){
							$landLotSizeQuery[] = array(
								'key'		=> 'lot_size_max_feet',
								'value'		=>  $landLotValue,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$landLotPriceQuery = array();
						if(isset($landLotPrice)){
							$landLotPriceQuery[] = array(
								'key'		=> 'lot_price_min',
								'value'		=>  $landLotPrice,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$numberOfRoomsQuery = array();
						if(isset($numberOfRooms)){
							$numberOfRoomsQuery[] = array(
								'key'		=> 'rooms/units',
								'value'		=>  $numberOfRooms,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$homePriceQuery = array();
						if(isset($homePrice)){
							$homePriceQuery[] = array(
								'key'		=> 'home_price_max',
								'value'		=>  $homePrice,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$residentialTypeQuery = array();
						if(isset($_SESSION['residentialType'])){
							$residentialTypeQuery[] = array(
								'key'		=> 'residential_type',
								'value'		=>  $_SESSION['residentialType'],
								'compare'	=> 'LIKE'
							);
						};

						$designatedUsesQuery = array();
						if(isset($designatedUses)){
							$designatedUsesQuery[] = array(
								'key'		=> 'property_type',
								'value'		=>  $designatedUses,
								'compare'	=> 'LIKE'
							);
						};
						$industrialTypeQuery = array();
						if(isset($industrialType)){
							$industrialTypeQuery[] = array(
								'key'		=> 'industrial_type',
								'value'		=>  $industrialType,
								'compare'	=> 'LIKE'
							);
						};
						$lotNumberQuery = array();
						if(isset($_SESSION['lotNumberInput'])){
							$lotNumberQuery[] = array(
								'key'		=> 'total_lots',
								'value'		=>  $_SESSION['lotNumberInput'],
								'compare'	=> 'LIKE'
							);
						};
						$lotAddressQuery = array();
						if(isset($_SESSION['lotAddressInput'])){
							$lotAddressQuery[] = array(
								'key'		=> 'address',
								'value'		=>  $_SESSION['lotAddresInput'],
								'compare'	=> 'LIKE'
							);
						};


						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$mapposts = new WP_Query( array( 
							'post_type' 	=> 'properties',
							'orderby' => $orderResults,
							'posts_per_page'	=> $resultsPerPage,
							'paged'		=> $paged,
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
								$designatedUsesQuery,
								$landLotSizeQuery,
								$landLotPriceQuery,
								$numberOfRoomsQuery,
								$industrialTypeQuery,
								$homePriceQuery,
								$lotNumberQuery,
								$lotAddressQuery
								),
							) 
						);
					?>
					
					<div class="acf-map">
					<?php if( $mapposts->have_posts() ): ?>
						<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); ?>
						<?php
							$location = get_field('location');
							$gtemp = explode (',',  implode($location));
							$coord = explode (',', implode($gtemp));
						?>

							<div class="marker" data-lat="<?php echo $location[lat]; ?>" data-lng="<?php echo $location[lng]; ?>" data-col="available">
								<p class="address"><?php the_title(); ?></p>		
							</div>

									
						<?php endwhile; ?>
					<?php endif; ?>
					
					</div><!-- .acf-map -->
				</div>
			</div>



<div class="search-availability-results property-list-container">
<div class="search-results-container">
	<h3 class="Title-Blue">Search Results:</h3>	
	<div class="search-inner-form">
	<strong>Results Per Page:</strong>
	<select name="resultsPerPage" class="resultsPerPageForm">
		<option class="filter" name="resultsPerPage" value="...">...</option>
		<option class="filter" name="resultsPerPage" value="15">15</option>
		<option class="filter" name="resultsPerPage" value="25">25</option>
		<option class="filter" name="resultsPerPage" value="50">50</option>
	</select>
	</div>
	<div class="search-inner-form">
	<strong>Order By:</strong>
	<select name="orderResults" class="orderResultsForm">
		<option class="filter" name="orderResults" value="ASC">Property (A-Z)</option>
		<option class="filter" name="orderResults" value="sqfootage">Square Footage</option>
		<option class="filter" name="orderResults" value="acreage">Acreage</option>
		<option class="filter" name="orderResults" value="newest">Newest</option>
		<option class="filter" name="orderResults" value="priceLow">Price (Lowest-Highest)</option>
		<option class="filter" name="orderResults" value="priceHigh">Price (Highest-Lowest)</option>
	</select>
	</div>
	</div>
	</form>
	<hr>

	<?php 
					// query
	$the_query = new WP_Query( $mapposts );
	?>
	<?php if( $mapposts->have_posts() ): ?>
		<p class="pull-left">Found <strong><?php echo $mapposts->found_posts ?></strong> property(s) matching your search criteria.</p>
		<?php
			if($mapposts->max_num_pages>1){?>
		    <p class="navrechts pull-right">
		    Page 1 of <?php echo $mapposts->max_num_pages; ?>: 
		    <?php
		      if ($paged > 1) { ?>
		        <a href="<?php echo '?paged=' . ($paged -1); //prev link ?>"><</a>
		                        <?php }
		    for($i=1;$i<=$mapposts->max_num_pages;$i++){?>
		        <a href="<?php echo '?paged=' . $i; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
		        <?php
		    }
		    if($paged < $mapposts->max_num_pages){?>
		        <a href="<?php echo '?paged=' . ($paged + 1); //next link ?>">></a>
		    <?php } ?>
		    </p>
		<?php } ?>
		<ul>
			<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); 
			$images = get_field('property_gallery');
			$image_1 = $images[0];  
			$agents = get_field('agent');	
			?>
			<li>
				<div class="pull-left">
					<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
				</div>	
				<div class="result-content">
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
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else :
		echo 'no results found';
	 endif; ?>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<hr>
<?php
if($mapposts->max_num_pages>1){?>
    <p class="navrechts">
    Page 1 of <?php echo $mapposts->max_num_pages; ?>: 
    <?php
      if ($paged > 1) { ?>
        <a href="<?php echo '?paged=' . ($paged -1); //prev link ?>"><</a>
                        <?php }
    for($i=1;$i<=$mapposts->max_num_pages;$i++){?>
        <a href="<?php echo '?paged=' . $i; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
        <?php
    }
    if($paged < $mapposts->max_num_pages){?>
        <a href="<?php echo '?paged=' . ($paged + 1); //next link ?>">></a>
    <?php } ?>
    </p>
<?php } ?>
	
</div>
</div>
</form>
</div>
<script type="text/javascript">
	(function($) {
		$(".resultsPerPageForm").change(function(){
			$('.search-availability-button').click();
		});
		$(".orderResultsForm").change(function(){
			$('.search-availability-button').click();
		});



		var $property = $(".property-select");

		$property.change(function(){
			console.log($(".property-select option:selected").attr('data-permalink'));
			var $link = $(".property-select option:selected").attr('data-permalink')
			window.location = $link;
		});

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
@media (max-width: 960px) {
	.acf-map {
		width: 100%;
		height: 200px;
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

	 if(color === "available") { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-RedDot.png'; }
	 else if(color === "not-available") { var $icon = 'http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/08/GoogleMaps-Marker-GreenDot.png'; }

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