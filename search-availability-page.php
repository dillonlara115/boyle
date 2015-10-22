<?php
/*
Template Name: Search Availability Page
*/
?>
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
		 $_SESSION['residentialLotPrice'] = $_POST['residentialLotPrice'];
		 $_SESSION['residentialLotSize'] = $_POST['residentialLotSize'];
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
		 $_SESSION['type'] = $_POST['type'];
		 $_SESSION['hotelType'] = $_POST['hotelType'];
		 $_SESSION['hotelLotSize'] = $_POST['hotelLotSize'];
		 $_SESSION['industrialLotSize'] = $_POST['industrialLotSize'];
	 } 
	
?> 

<?php get_header(); ?>


<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	<?php the_content(); ?>
	<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Icon-MagnifyingGlass.gif" alt="Search Availability" title="Search Availability" class="header-image">
	
	<h1 class="contact-page-title">Search Availability:</h1>
	<p class="contact-page-text">Select the tab of the property type you are interested in searching. Then use the fields to specify your search criteria. Enter more search criteria for a smaller list of results.</p>
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<?php 	$region = $_GET['region']; 
				//$transaction = $_GET['transaction']; 
				//$designatedUses = $_GET['designatedUses']; 
				$propertyType = $_GET['type'];
		?>

		<div class="search-availability-content">
<!-- 			<?php wp_nav_menu( array('menu' => 'Search Availability Menu', 'container_class' => 'hidden-mobile' )); ?>
 -->			

<div class="hidden-mobile">
	<ul id="menu-search-availability-menu" class="menu property-type-selection">
		<li class="menu-item menu-item-type-post_type <?php if ('all' == $_GET['type'] || empty($_GET))  print 'current-menu-item'; ?>"><a href="type=all">All</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('mixed-use' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=mixed-use">Mixed-Use</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('office' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=office">Office</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('retail' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=retail">Retail</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('residential' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=residential">Residential</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('industrial' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=industrial">Industrial</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('hotels' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=hotels">Hotels</a></li>
		<li class="menu-item menu-item-type-post_type <?php if ('land' == $_GET['type']) print 'current-menu-item'; ?>" ><a href="type=land">Land</a></li>
	</ul>
</div>

<?php if ( 'all' == $_GET['type']) {  
	$value = array('Residential', 'Hotels', 'Land', 'Mixed-Use', 'Industrial', 'Retail', 'Office');
} else { 
	$value = $_GET['type'];
} ?>

			<form class='search-availability-form' name="searchform" id="searchform" action="" method="post">
			<div class="property-type-list-content" id="search-houses">
				<div class="left-content">
					<div class="visible-mobile">
						<strong>Property Type: </strong>
						<select id="drop-nav">
							<option value="?type=all" <?php if ('all' == $_GET['type'] || empty($_GET))  print 'selected'; ?>>All</option>
							<option value="?type=mixed-use" <?php if ('mixed-use' == $_GET['type']) print 'selected'; ?> >Mixed-Use</option>
							<option value="?type=office" <?php if ('office' == $_GET['type']) print 'selected'; ?> >Office</option>
							<option value="?type=retail" <?php if ('retail' == $_GET['type']) print 'selected'; ?> >Retail</option>
							<option value="?type=residential" <?php if ('residential' == $_GET['type']) print 'selected'; ?> >Residential</option>
							<option value="?type=industrial" <?php if ('industrial' == $_GET['type']) print 'selected'; ?> >Industrial</option>
							<option value="?type=hotels" <?php if ('hotels' == $_GET['type']) print 'selected'; ?> >Hotels</option>
							<option value="?type=land" <?php if ('land' == $_GET['type']) print 'selected'; ?> >Land</option>

						</select>
						<br>
					</div>
					
					<div id="archive-filters" class="search-filters">
						<strong>Region: </strong>
						<select>
							<?php 

							foreach( $GLOBALS['my_query_filters'] as $key => $name ): 	
								// get the field's settings without attempting to load a value
								$field = get_field_object($key, false, false);

								// set value if available
								if( isset($_GET[ $name ]) ) {
									$field['value'] = explode(',', $_GET[ $name ]);
								}
								// create filter
								?>
								<option class="filter" name="region" data-filter="<?php echo $name; ?>" value="<?php echo $name; ?>" <?php if ($name == $_GET['region']) print 'selected'; ?>><?php echo $key; ?></option>
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
								echo '<select size="5" name="metroarea" multiple="multiple"><option name="metroarea" value="All Regions" >All Metro Areas</option>';
									foreach( $field['choices'] as $k => $v )
									{ ?>
										<option class="filter" name="metroarea" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if ($k == $_SESSION['metroarea']) print 'selected'; ?>> <?php echo $v ?> </option>
									<?php } ?>
								</select>

							<?php } ?>
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

								if( $field ) {
								echo '<select size="5" name="metroarea" multiple="multiple"><option name="metroarea" value="All Regions" >All Metro Areas</option>';
									foreach( $field['choices'] as $k => $v )
									{ ?>
										<option class="filter" name="metroarea" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if ($k == $_SESSION['metroarea']) print 'selected'; ?>> <?php echo $v ?> </option>
									<?php } ?>
								</select>

							<?php } ?>
								</div>
						<br>
						<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'other')){ 
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

								if( $field ) {
								echo '<select size="5" name="metroarea" multiple="multiple"><option name="metroarea" value="All Regions" >All Metro Areas</option>';
									foreach( $field['choices'] as $k => $v )
									{ ?>
										<option class="filter" name="metroarea" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if ($k == $_SESSION['metroarea']) print 'selected'; ?>> <?php echo $v ?> </option>
									<?php } ?>
								</select>

							<?php } ?>
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
									'key'		=> 'availability',
									'value'		=> 'available',
									'compare'	=> '='
									),
								array(
									'key'		=> 'region_name',
									'value'		=> $regionName,
									'compare'	=> 'LIKE'
									),
								$metroTypeQuery,
								$residentialTypeQuery,
								$residentialLotPriceQuery,
								$residentialLotSizeQuery,
								$lotSizeQuery,
								$lotPriceQuery,
								$designatedUsesQuery,
								$landLotSizeQuery,
								$landLotPriceQuery,
								$numberOfRoomsQuery,
								$industrialTypeQuery,
								$homePriceQuery,
								$lotNumberQuery,
								$lotAddressQuery,
								$hotelTypeQuery,
								$hotelLotSizeQuery,
								$industrialLotSizeQuery,
								array(
										'relation' => 'AND',
										$squareFeetQuery,
										$squareFeetMaxQuery
									),  
										$transactionQuery
									
								),
							) 
						);?>
							<div class="search-filters">
								<strong>Property:</strong>
								<select class="property-select">
								<option name="property" value="..." >...</option>
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
						<?php if ('retail' == $_GET['type'] || 'mixed-use' == $_GET['type'] || 'office' == $_GET['type'] || 'industrial' == $_GET['type'] ){ ?> 
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
								{ ?>
									<input type="checkbox" name="transaction['<?php echo $k ?>']"  class="filter" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if (in_array($k, $_SESSION['transaction'])) {print 'checked';}  ?>/><small><?php echo $v ?></small>
								<?php }
									
							} ?>
							
						</div>
						<br>
						<?php } ?>
						<?php if ('industrial' == $_GET['type'] ){ ?> 
						
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
								{ ?>
									<input type="checkbox" name="industrialType['<?php echo $k ?>']"  class="filter" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if (in_array($k, $_SESSION['industrialType'])) {print 'checked';}  ?>/><small> <?php echo $v ?></small>	
								<?php 
								}
							} ?>
							
							</div>
							<br>
							
						<?php } ?>
						<?php if ('residential' == $_GET['type'] ){ ?>
								
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
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<option name="community" value="<?php echo the_title(); ?>" <?php if (get_the_title() == $_SESSION['community']) print 'selected'; ?>><?php echo the_title(); ?></option>
									<?php endwhile;?>
								</select>
							<?php endif;?>
							</div>
							<br>
<!-- 							<div class="search-filters">
								<strong>Type</strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55491064e5755";
								$field = get_field_object($field_key);

								if( $field )
								{ ?>
									<select name="residentialType">
										<option name="residentialType" value="...">...</option>
										<?php foreach( $field['choices'] as $k => $v )
										{ ?>
											<option name="residentialType" value="<?php echo $k; ?>" class="filter"  data-filter="<?php echo $k; ?>"  <?php if ($k == $_SESSION['residentialType']) print 'selected'; ?>><?php echo $v; ?></option>
										<?php } ?> 
									</select>
								<?php } ?>
							</div> -->
						<?php } ?>
						
						<?php if ( 'office' == $_GET['type'] || 'retail' == $_GET['type'] || 'industrial' == $_GET['type']) { ?>
							<div class="search-filters">
							<strong>Square Ft.: </strong>
								<select name="squareFeet">
									<option class="filter" name="squareFeet" data-filter="" <?php if ('...' == $_SESSION['squareFeet']) print 'selected'; ?>  value="...">...</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('0 - 5000' == $_SESSION['squareFeet']) print 'selected'; ?>  value="0 - 5000">0 - 5,000</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('5000 - 10000' == $_SESSION['squareFeet']) print 'selected'; ?>  value="5000 - 10000">5,000 - 10,000</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('10,000 - 15,000' == $_SESSION['squareFeet']) print 'selected'; ?>  value="10,000 - 15,000">10,000 - 15,000</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('15,000 - 20,000' == $_SESSION['squareFeet']) print 'selected'; ?>  value="15,000 - 20,000">15,000 - 20,000</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('20,000 - 25,000' == $_SESSION['squareFeet']) print 'selected'; ?>  value="20,000 - 25,000">20,000 - 25,000</option>
									<option class="filter" name="squareFeet" data-filter="" <?php if ('25,000+' == $_SESSION['squareFeet']) print 'selected'; ?>  value="25,000+">25,000+</option>
								</select>
							</div>
							<br>
						<?php } ?>
						<?php if ( 'office' == $_GET['type'] || 'retail' == $_GET['type']) { ?>
							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="lotSize">
									<option class="filter" name="lotSize" data-filter="" <?php if ('...' == $_SESSION['lotSize']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="lotSize" data-filter="" <?php if ('2 or less' == $_SESSION['lotSize']) print 'selected'; ?> value="2 or less">2 or less</option>
									<option class="filter" name="lotSize" data-filter="" <?php if ('2 - 5' == $_SESSION['lotSize']) print 'selected'; ?> value="2 - 5">2 - 5</option>
									<option class="filter" name="lotSize" data-filter="" <?php if ('5 - 10' == $_SESSION['lotSize']) print 'selected'; ?> value="5 - 10">5 - 10</option>
									<option class="filter" name="lotSize" data-filter="" <?php if ('10 - 20' == $_SESSION['lotSize']) print 'selected'; ?> value="10 - 20">10 - 20</option>
									<option class="filter" name="lotSize" data-filter="" <?php if ('greater than 20' == $_SESSION['lotSize']) print 'selected'; ?> value="greater than 20">greater than 20</option>
								</select>
								<span>(Acres)</span>
							</div>
							<br>
						<?php } ?>
						<?php if ( 'residential' == $_GET['type']) { ?> 
							<div class="search-filters">
								<strong>Lot Price: </strong>
								<select name="residentialLotPrice">
									<option class="filter" name="residentialLotPrice" data-filter="" <?php if ('...' == $_SESSION['residentialLotPrice']) print 'selected'; ?> value="...">Any</option>
									<option class="filter" name="residentialLotPrice" data-filter="" <?php if ('less than $80,000' == $_SESSION['residentialLotPrice']) print 'selected'; ?> value="less than $80,000">less than $80,000</option>
									<option class="filter" name="residentialLotPrice" data-filter="" <?php if ('$80,000 - 150,000' == $_SESSION['residentialLotPrice']) print 'selected'; ?> value="$80,000 - 150,000">$80,000 - 150,000</option>
									<option class="filter" name="residentialLotPrice" data-filter="" <?php if ('$150,000 - 300,000' == $_SESSION['residentialLotPrice']) print 'selected'; ?> value="$150,000 - 300,000">$150,000 - 300,000</option>
									<option class="filter" name="residentialLotPrice" data-filter="" <?php if ('Greater than $300,000' == $_SESSION['residentialLotPrice']) print 'selected'; ?> value="Greater than $300,000">Greater than $300,000</option>
								</select>
							</div>
							<br>
							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="residentialLotSize">
									<option class="filter" name="residentialLotSize" data-filter="" <?php if ('...' == $_SESSION['residentialLotSize']) print 'selected'; ?> value="...">Any</option>
									<option class="filter" name="residentialLotSize" data-filter="" <?php if ('0 - .25' == $_SESSION['residentialLotSize']) print 'selected'; ?> value="0 - .25">Zero Lot Line - 1/4 acre</option>
									<option class="filter" name="residentialLotSize" data-filter="" <?php if ('.25 - .75' == $_SESSION['residentialLotSize']) print 'selected'; ?> value=".25 - .75">1/4 - 3/4 acre</option>
									<option class="filter" name="residentialLotSize" data-filter="" <?php if ('.75 - 2' == $_SESSION['residentialLotSize']) print 'selected'; ?> value=".75 - 2">3/4 - 2 acres</option>
									<option class="filter" name="residentialLotSize" data-filter="" <?php if ('gt2' == $_SESSION['residentialLotSize']) print 'selected'; ?> value="gt2">Greater than 2 acres</option>
								</select>
								<span>(Acres)</span>
							</div>
							<br>
						<?php }?>
						<?php if ( 'hotels' == $_GET['type']) { ?> 
							<div class="search-filters">
								<strong>Type: </strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55490f1d7d603";
								$field = get_field_object($field_key);
								if( $field ) {
									foreach( $field['choices'] as $k => $v )
									{ ?>
										<input type="checkbox" name="hotelType['<?php echo $k ?>']"  class="filter" data-filter="<?php echo $k ?>"  value="<?php echo $k ?>" <?php if (in_array($k, $_SESSION['hotelType'])) {print 'checked';}  ?>/><small> <?php echo $v ?></small>
									<?php 
									}
								} ?>
							</div>
							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="hotelLotSize">
									<option class="filter" name="hotelLotSize" data-filter="..." <?php if ('...' == $_SESSION['hotelLotSize']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="hotelLotSize" data-filter="lt3" <?php if ('lt3' == $_SESSION['hotelLotSize']) print 'selected'; ?> value="lt3">less than 3</option>
									<option class="filter" name="hotelLotSize" data-filter="3 - 5" <?php if ('3 - 5' == $_SESSION['hotelLotSize']) print 'selected'; ?> value="3 - 5">3 - 5 acres</option>
									<option class="filter" name="hotelLotSize" data-filter="gt5" <?php if ('gt5' == $_SESSION['hotelLotSize']) print 'selected'; ?> value="gt5">Greater than 5 acres</option>
								</select>
								<span>(Acres)</span>
							</div>
							<div class="search-filters">
								<strong># Rooms: </strong>
								<select name="numberOfRooms">
									<option class="filter" name="numberOfRooms" data-filter="" <?php if ('...' == $_SESSION['numberOfRooms']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="numberOfRooms" data-filter="" <?php if ('100 - 150' == $_SESSION['numberOfRooms']) print 'selected'; ?> value="100 - 150">100 - 150</option>
									<option class="filter" name="numberOfRooms" data-filter="" <?php if ('150 - 250' == $_SESSION['numberOfRooms']) print 'selected'; ?> value="150 - 250">150 - 250</option>
									<option class="filter" name="numberOfRooms" data-filter="" <?php if ('Greater than 250' == $_SESSION['numberOfRooms']) print 'selected'; ?> value="Greater than 250">Greater than 250</option>
								</select>
							</div>
							<br>
							
						<?php }?>
						<?php if ( 'land' == $_GET['type']) { ?> 
							<div class="search-filters">
								<strong>Designated Uses: </strong>
								<?php 
								/*
								*  Get a field object and create a select form element
								*/

								$field_key = "field_55491037e5754";
								$field = get_field_object($field_key);

								if( $field ) {
									
									foreach( $field['choices'] as $k => $v ) 
									{ ?>
										<small><input type="checkbox" name="designatedUses[<?php echo $k; ?>]"  class="filter" data-filter="<?php echo $k; ?>"  value="<?php echo $k; ?>" <?php if (in_array($k, $_SESSION['designatedUses'])) {print 'checked';}  ?>/><?php echo $v; ?></small>
									<?php }
										
								} ?>
							</div>
							<div class="search-filters">
								<strong>Lot Price: </strong>
								<select name="landLotPrice">
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('...' == $_SESSION['landLotPrice']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('less than $5,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="less than $5,000">less than $5,000</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('$5,000 - 10,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="$5,000 - 10,000">$5,000 - $10,000</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('10,000 - 15,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="10,000 - 15,000">$10,000 - $15,000</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('15,000 - 20,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="15,000 - 20,000">$15,000 - $20,000</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('20,000 - 25,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="20,000 - 25,000">$20,000 - $25,000</option>
									<option class="filter" name="landLotPrice" data-filter="" <?php if ('Greater than 25,000' == $_SESSION['landLotPrice']) print 'selected'; ?> value="Greater than 25,000">Greater than $25,000</option>
								</select>
							</div>
							<br>
							
						<?php }?>
						<?php if ('land' == $_GET['type'] ) { ?> 

							<div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="landLotSize">
									<option class="filter" name="landLotSize" data-filter="" <?php if ('...' == $_SESSION['landLotSize']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="landLotSize" data-filter="" <?php if ('lt2' == $_SESSION['landLotSize']) print 'selected'; ?> value="lt2">2 or less</option>
									<option class="filter" name="landLotSize" data-filter="" <?php if ('2 - 5' == $_SESSION['landLotSize']) print 'selected'; ?> value="2 - 5">2 - 5</option>
									<option class="filter" name="landLotSize" data-filter="" <?php if ('5 - 10' == $_SESSION['landLotSize']) print 'selected'; ?> value="5 - 10">5 - 10</option>
									<option class="filter" name="landLotSize" data-filter="" <?php if ('10 - 20' == $_SESSION['landLotSize']) print 'selected'; ?> value="10 - 20">10 - 20</option>
									<option class="filter" name="landLotSize" data-filter="" <?php if ('gt20' == $_SESSION['landLotSize']) print 'selected'; ?> value="gt20">greater than 20</option>
								</select>
								<span>(Acres)</span>
							</div>
							<br>
						<?php } ?>
						<?php if ('industrial' == $_GET['type'] ) { ?>
							 <div class="search-filters">
							<strong>Lot Size: </strong>
								<select name="industrialLotSize">
									<option class="filter" name="industrialLotSize" data-filter="..." <?php if ('...' == $_SESSION['industrialLotSize']) print 'selected'; ?> value="...">...</option>
									<option class="filter" name="industrialLotSize" data-filter="lt2" <?php if ('lt2' == $_SESSION['industrialLotSize']) print 'selected'; ?> value="lt2">less than 2</option>
									<option class="filter" name="industrialLotSize" data-filter="gt2" <?php if ('gt2' == $_SESSION['industrialLotSize']) print 'selected'; ?> value="gt2">Greater than 2 acres</option>
								</select>
								<span>(Acres)</span>
							</div>
							<br>
						<?php } ?>
						<?php if ( 'residential' == $_GET['type']) { ?> 
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
									<option class="filter" name="homePrice" data-filter="" <?php if ('Any' == $_SESSION['homePrice']) print 'selected'; ?> value="Any">Any</option>
									<option class="filter" name="homePrice" data-filter="" <?php if ('less than 250000' == $_SESSION['homePrice']) print 'selected'; ?> value="less than 250000">less than $250,000</option>
									<option class="filter" name="homePrice" data-filter="" <?php if ('250000 - 500000' == $_SESSION['homePrice']) print 'selected'; ?> value="250000 - 500000">$250,000 - $500,000</option>
									<option class="filter" name="homePrice" data-filter="" <?php if ('500000 - 1000000' == $_SESSION['homePrice']) print 'selected'; ?> value="500000 - 1000000">$500,000 - $1,000,000</option>
									<option class="filter" name="homePrice" data-filter="" <?php if ('greater than 1000000' == $_SESSION['homePrice']) print 'selected'; ?> value="greater than 1000000">greater than $1,000,000</option>
								</select>
							</div>
							<br>
							<div class="search-filters">
							<strong>MLS #: </strong>
								<input type="text" name="mlsInput" />
							</div>
							<br>
						<?php } ?>

							
						<hr class="hidden-mobile">
						<input type="submit" name="submit" class="search-availability-button" value="search">	
					
					</div>

				
					<?php if( $_SESSION['hotelLotSize'] == 'lt3') { 
						$hotelLotSizeValue = 3;
						$hotelLotSizeValueMax = .1;
					} elseif( $_SESSION['hotelLotSize'] == '3 - 5') { 
						$hotelLotSizeValue = 5;
						$hotelLotSizeValueMax = 3;
					} elseif( $_SESSION['hotelLotSize'] == 'gt5') {
						$hotelLotSizeValue = 15000;
						$hotelLotSizeValueMax = 5.1;
				    } ?>

				    <?php if( $_SESSION['industrialLotSize'] == 'lt2') { 
						$industrialLotSizeValue = 2;
						$industrialLotSizeValueMax = 0.1;
					} elseif( $_SESSION['industrialLotSize'] == 'gt2') {
						$industrialLotSizeValue = 15000000;
						$industrialLotSizeValueMax = 2;
				    } ?>

					<?php if( $_SESSION['squareFeet'] == '0 - 5000') { 
						$sqValue = 5000;
						$sqValueMax = 1;
					} elseif( $_SESSION['squareFeet'] == '5000 - 10000') { 
						$sqValue = 10000;
						$sqValueMax = 5000;
					} elseif( $_SESSION['squareFeet'] == '10,000 - 15,000') {
						$sqValue = 15000;
						$sqValueMax = 10000;
					} elseif( $_SESSION['squareFeet'] == '15,000 - 20,000') { 
						$sqValue = 20000;
						$sqValueMax = 15000;
				    } elseif( $_SESSION['squareFeet'] == '20,000 - 25,000') { 
						$sqValue = 25000;
						$sqValueMax = 20000;
					} elseif( $_SESSION['squareFeet'] == '25,000+') { 
						$sqValue = 9999999;
						$sqValueMax = 25000;
				    } ?>


					<?php if( $_SESSION['residentialLotPrice'] == 'less than $80,000') { 
						$residentalLotPriceMin = 80000;
						$residentalLotPriceMax = 1;
					} elseif( $_SESSION['residentialLotPrice'] == '$80,000 - 150,000') { 
						$residentalLotPriceMin = 150000;
						$residentalLotPriceMax = 80000;
					} elseif( $_SESSION['residentialLotPrice'] == '$150,000 - 300,000') {
						$residentalLotPriceMin = 300000;
						$residentalLotPriceMax = 150000;
					} elseif( $_SESSION['residentialLotPrice'] == 'Greater than $300,000') { 
						$residentalLotPriceMin = 3000000000;
						$residentalLotPriceMax = 300000;
				    } ?>



			    	<?php if( $_SESSION['lotSize'] == '0 - .25') { 
						$lotValue = array(.01, .25);
					} elseif( $_SESSION['lotSize'] == '.25 - .75') { 
						$lotValue = array(.25, .75);
					} elseif( $_SESSION['lotSize'] == '.75 - 2') {
						$lotValue = array(.75, 2);
					} elseif( $_SESSION['lotSize'] == 'gt2') { 
						$lotValue = array(2, 200000);
				    } ?>

					<?php if( $_SESSION['residentialLotSize'] == '0 - .25') { 
						$residentialLotValueMin = 0.25;
						$residentialLotValueMax = 0;
					} elseif( $_SESSION['residentialLotSize'] == '.25 - .75') { 
						$residentialLotValueMin = 0.75;
						$residentialLotValueMax = 0.25;
					} elseif( $_SESSION['residentialLotSize'] == '.75 - 2') {
						$residentialLotValueMin = 2;
						$residentialLotValueMax = 0.75;
					} elseif( $_SESSION['residentialLotSize'] == 'gt2') { 
						$residentialLotValueMin = 200000;
						$residentialLotValueMax = 2;
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
						$lotValue = array(20, 2000000000);
				    }?>




			    	

				    <?php if( $_SESSION['landLotSize'] == 'lt2') { 
						$landLotSize = array(0, 2);
					} elseif( $_SESSION['landLotSize'] == '2 - 5') { 
						$landLotSize = array(2, 5);
					} elseif( $_SESSION['landLotSize'] == '5 - 10') {
						$landLotSize = array(5, 10);
					} elseif( $_SESSION['landLotSize'] == '10 - 20') { 
						$landLotSize = array(10, 20);
				    } elseif( $_SESSION['landLotSize'] == 'gt20') { 
						$landLotSize = array(20, 2500000000);
				    } ?>

			    	<?php if( $_SESSION['landLotPrice'] == 'less than $5,000') { 
						$landLotPrice = array(1, 5000);
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
						$homePrice = 250000;
						$homePriceMax = 1;
					} elseif( $_SESSION['homePrice'] == '250000 - 500000') { 
						$homePrice = 500000;
						$homePriceMax = 250000;
					} elseif( $_SESSION['homePrice'] == '500000 - 1000000') { 
						$homePrice = 1000000;
						$homePriceMax = 500000;
					} elseif( $_SESSION['homePrice'] == 'greater than 1000000') { 
						$homePrice = 30000000000;
						$homePriceMax = 1000001;
				    } ?>


				    <?php if( $_SESSION['orderResults'] == 'ASC') { 
						$orderResults = 'title';
						$orderValue = 'ASC';
					} elseif( $_SESSION['orderResults'] == 'DESC') { 
						$orderResults = 'title';
						$orderValue = 'DESC';
					} elseif( $_SESSION['orderResults'] == 'sqfootage') { 
						$orderResults = 'total_square_feet';
						$orderValue = 'ASC';
					} elseif( $_SESSION['orderResults'] == 'acreage') {
						$orderResults = 'lot_size_min_acres';
						$orderValue = 'ASC';
					} elseif( $_SESSION['orderResults'] == 'newest') { 
						$orderResults = 'year_built';
						$orderValue = 'ASC';
				    } elseif( $_SESSION['orderResults'] == 'priceLow') { 
						$orderResults = 'lot_price_min';
						$orderValue = 'ASC';
				    } elseif( $_SESSION['orderResults'] == 'priceHigh') { 
						$orderResults = 'lot_price_max';
						$orderValue = 'ASC';
				    } else {
				    	$orderResults = 'title';
				    	$orderValue = 'ASC';
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
						if(isset($_SESSION['transaction'])){
							$transactionQuery['relation'] = 'OR';
							foreach($_SESSION['transaction'] as $transQuery) :
								$transactionQuery[] = array(
									'key'		=> 'transaction_type',
									'value'		=>  $transQuery,
									'compare'	=> 'LIKE'
								);
							endforeach;
						};
						$hotelTypeQuery = array();
						if(isset($_SESSION['hotelType'])){
							foreach($_SESSION['hotelType'] as $hotelQuery) :
								$hotelTypeQuery[] = array(
									'key'		=> 'hotel_type',
									'value'		=>  $hotelQuery,
									'compare'	=> 'LIKE'
								);
							endforeach;
						};

						$hotelLotSizeQuery = array();
						if(isset($hotelLotSizeValue)){
							$hotelLotSizeQuery['relation'] = 'AND';
							$hotelLotSizeQuery[] = array(
								'key'		=> 'lot_size_min_acres',
								'value'		=>  $hotelLotSizeValue,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
							$hotelLotSizeQuery[] = array(
								'key'		=> 'lot_size_max_acres',
								'value'		=>  $hotelLotSizeValueMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
							);
						};

						$industrialLotSizeQuery = array();
						if(isset($industrialLotSizeValue)){
							$industrialLotSizeQuery['relation'] = 'AND';
							$industrialLotSizeQuery[] = array(
								'key'		=> 'lot_size_min_acres',
								'value'		=>  $industrialLotSizeValue,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
							$industrialLotSizeQuery[] = array(
								'key'		=> 'lot_size_max_acres',
								'value'		=>  $industrialLotSizeValueMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
							);
						};

						$squareFeetQuery = array();
						if(isset($sqValue)){
							$squareFeetQuery[] = array(
								'key'		=> 'square_feet_min',
								'value'		=>  $sqValue,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
						};

						$squareFeetMaxQuery = array();
						if(isset($sqValueMax)){
							$squareFeetMaxQuery[] = array(
								'key'		=> 'square_feet_max',
								'value'		=>  $sqValueMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
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


						$residentialLotSizeQuery = array();
						if(isset($residentialLotValueMin)){
							$residentialLotSizeQuery['relation'] = 'AND';
							$residentialLotSizeQuery[] = array(
								'key'		=> 'lot_size_min_acres',
								'value'		=>  $residentialLotValueMin,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
							$residentialLotSizeQuery[] = array(
								'key'		=> 'lot_size_max_acres',
								'value'		=>  $residentialLotValueMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
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


						$residentialLotPriceQuery = array();
						if(isset($residentalLotPriceMin)){
							$residentialLotPriceQuery['relation'] = 'AND';
							$residentialLotPriceQuery[] = array(
								'key'		=> 'lot_price_min',
								'value'		=>  $residentalLotPriceMin,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
							$residentialLotPriceQuery[] = array(
								'key'		=> 'lot_price_max',
								'value'		=>  $residentalLotPriceMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
							);
						}; 

						$landLotSizeQuery = array();
						if(isset($landLotSize)){
							$landLotSizeQuery[] = array(
								'key'		=> 'lot_size_max_acres',
								'value'		=>  $landLotSize,
								'type'		=> 'numeric',
								'compare'	=> 'BETWEEN'
							);
						};
						$landLotPriceQuery = array();
						if(isset($landLotPrice)){
							$landLotPriceQuery[] = array(
								'key'		=> 'lot_price_max',
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
							$homePriceQuery['relation'] = 'AND';
							$homePriceQuery[] = array(
								'key'		=> 'home_price_min',
								'value'		=>  $homePrice,
								'type'		=> 'numeric',
								'compare'	=> '<='
							);
							$homePriceQuery[] = array(
								'key'		=> 'home_price_max',
								'value'		=>  $homePriceMax,
								'type'		=> 'numeric',
								'compare'	=> '>='
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

						$metroTypeQuery = array();
						if(isset($_SESSION['metroarea']) && $_SESSION['metroarea'] !== 'All Regions'){
							$metroTypeQuery[] = array(
								'key'		=> $region,
								'value'		=> $_SESSION['metroarea'],
								'compare'	=> 'LIKE'
							);
							
						};

						$designatedUsesQuery = array();
						if(isset($_SESSION['designatedUses'])){
							$designatedUsesQuery['relation'] = 'OR';
							foreach ($_SESSION['designatedUses'] as $designatedUse) {
								$designatedUsesQuery[] = array(
									'key'		=> 'land_type',
									'value'		=>  $designatedUse,
									'compare'	=> 'LIKE'
								);
							}
							
						};


						$industrialTypeQuery = array();
						if(isset($_SESSION['industrialType'])){
							foreach($_SESSION['industrialType'] as $industrialQuery) :
								$industrialTypeQuery[] = array(
									'key'		=> 'industrial_type',
									'value'		=>  $industrialQuery,
									'compare'	=> 'LIKE'
								);
							endforeach;
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

						if($_SESSION['orderResults'] == 'sqfootage' || $_SESSION['orderResults'] == 'acreage' || $_SESSION['orderResults'] == 'newest' || $_SESSION['orderResults'] == 'priceLow' || $_SESSION['orderResults'] == 'priceHigh') {
							//	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$mapposts = new WP_Query( array( 
								'post_type' 	=> 'properties',
								'meta_key' 	=> $orderResults,
								'orderby' => 'meta_value_num',
								'posts_per_page'	=> -1,
								//'paged'		=> $paged,
								'order'   => 	$orderValue,
								'meta_query'	=> array(
									'relation'	=> 'AND',
									array(
										'key'		=> 'property_type',
										'value'		=> $value,
										'compare'	=> 'LIKE'
										),
									array(
										'key'		=> 'availability',
										'value'		=> 'available',
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
									$metroTypeQuery,
									$residentialTypeQuery,
									$residentialLotPriceQuery,
									$residentialLotSizeQuery,
									$lotSizeQuery,
									$lotPriceQuery,
									$designatedUsesQuery,
									$landLotSizeQuery,
									$landLotPriceQuery,
									$numberOfRoomsQuery,
									$industrialTypeQuery,
									$homePriceQuery,
									$lotNumberQuery,
									$lotAddressQuery,
									$hotelTypeQuery,
									$hotelLotSizeQuery,
									$industrialLotSizeQuery,
									array(
										'relation' => 'AND',
										$squareFeetQuery,
										$squareFeetMaxQuery
									), 
									$transactionQuery
									
									),
								) 
							);

							$mapposts2 = new WP_Query( array( 
								'post_type' 	=> 'properties',
								'meta_key' 	=> $orderResults,
								'orderby' => 'meta_value_num',
								'posts_per_page'	=> -1,
								//'paged'		=> $paged,
								'order'   => $orderValue,
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
										'key'		=> 'availability',
										'value'		=> 'available',
										'compare'	=> '='
										),
									array(
										'key'		=> 'region_name',
										'value'		=> $regionName,
										'compare'	=> 'LIKE'
										),
									$metroTypeQuery,
									$residentialTypeQuery,
									$residentialLotPriceQuery,
									$residentialLotSizeQuery,
									$lotSizeQuery,
									$lotPriceQuery,
									$designatedUsesQuery,
									$landLotSizeQuery,
									$landLotPriceQuery,
									$numberOfRoomsQuery,
									$industrialTypeQuery,
									$homePriceQuery,
									$lotNumberQuery,
									$lotAddressQuery,
									$hotelTypeQuery,
									$hotelLotSizeQuery,
									$industrialLotSizeQuery,
									array(
										'relation' => 'AND',
										$squareFeetQuery,
										$squareFeetMaxQuery
									), 
										$transactionQuery
									
									),
								) 
							);
						} else {
							//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$mapposts = new WP_Query( array( 
								'post_type' 	=> 'properties',
								'orderby' => 'title',
								'posts_per_page'	=> -1,//$resultsPerPage,
								//'paged'		=> $paged,
								'order'   => 	$orderValue,
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
										'key'		=> 'availability',
										'value'		=> 'available',
										'compare'	=> '='
										),
									array(
										'key'		=> 'region_name',
										'value'		=> $regionName,
										'compare'	=> 'LIKE'
										),
									$metroTypeQuery,
									$residentialTypeQuery,
									$residentialLotPriceQuery,
									$residentialLotSizeQuery,
									$lotSizeQuery,
									$lotPriceQuery,
									$designatedUsesQuery,
									$landLotSizeQuery,
									$landLotPriceQuery,
									$numberOfRoomsQuery,
									$industrialTypeQuery,
									$homePriceQuery,
									$lotNumberQuery,
									$lotAddressQuery,
									$hotelTypeQuery,
									$hotelLotSizeQuery,
									$industrialLotSizeQuery,
									array(
										'relation' => 'AND',
										$squareFeetQuery,
										$squareFeetMaxQuery
									),  
										$transactionQuery
									
									),
								) 
							);

							$mapposts2 = new WP_Query( array( 
								'post_type' 	=> 'properties',
								'orderby' => $orderResults,
								'posts_per_page'	=> -1,
								//'paged'		=> $paged,
								'order'   => $orderValue,
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
										'key'		=> 'availability',
										'value'		=> 'available',
										'compare'	=> '='
										),
									array(
										'key'		=> 'region_name',
										'value'		=> $regionName,
										'compare'	=> 'LIKE'
										),
									$metroTypeQuery,
									$residentialTypeQuery,
									$residentialLotPriceQuery,
									$residentialLotSizeQuery,
									$lotSizeQuery,
									$lotPriceQuery,
									$designatedUsesQuery,
									$landLotSizeQuery,
									$landLotPriceQuery,
									$numberOfRoomsQuery,
									$industrialTypeQuery,
									$homePriceQuery,
									$lotNumberQuery,
									$lotAddressQuery,
									$hotelTypeQuery,
									$hotelLotSizeQuery,
									$industrialLotSizeQuery,
									array(
										'relation' => 'AND',
										$squareFeetQuery,
										$squareFeetMaxQuery
									), 
										$transactionQuery
									
									),
								) 
							);
						}

						

					?>

					
					
					
					<?php if(!isset($_GET['region'])) { ?>

						<div class="map">
					    	<ul class="map-markers">
						      <li class="map-marker map-marker-nashville">
						        <a href="region=nashville_metro_area">NA</a>
						        <div class="map-marker-info">
						          <header>
						            <h2>Greater Nashville</h2>
						          </header>
						          <main>
						            <p>(Click to Select)</p>
						          </main>
						        </div>
						      </li>
						      <li class="map-marker map-marker-birmingham">
						        <a href="region=other">OR</a>
						        <div class="map-marker-info">
						          <header>
						            <h2>Greater Birmingham</h2>
						          </header>
						          <main>
						            <p>(Click to Select)</p>
						          </main>
						        </div>
						      </li>
						      <li class="map-marker map-marker-other">
						        <a href="region=other">OR</a>
						        <div class="map-marker-info">
						          <header>
						            <h2>Other Regions</h2>
						          </header>
						          <main>
						            <p>(Click to Select)</p>
						          </main>
						        </div>
						      </li>
						      <li class="map-marker map-marker-memphis">
						        <a href="region=memphis_metro_area">ME</a>
						        <div class="map-marker-info">
						          <header>
						            <h2>Greater Memphis</h2>
						          </header>
						          <main>
						            <p>(Click to Select)</p>
						          </main>
						        </div>
						      </li>
					    	</ul>
						    <img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/09/search-availability-map.png" alt="" />
						  </div>
						</div>
					<?php } else { ?> 
						<div class="acf-map">
							<?php if( $mapposts2->have_posts() ): ?>
								<?php while ( $mapposts2->have_posts() ) : $mapposts2->the_post(); ?>
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
						</div><!-- .acf-map -->
					<?php } ?>
  
			
			</div>



<div class="search-availability-results property-list-container">
<div class="search-results-container">
	<h3 class="Title-Blue">Search Results:</h3>	
	<!-- <div class="search-inner-form">
	<strong>Results Per Page:</strong>
	<select name="resultsPerPage" class="resultsPerPageForm">
		<option class="filter" name="resultsPerPage" value="15" <?php if ('15' == $_SESSION['resultsPerPage']) print 'selected'; ?>>15</option>
		<option class="filter" name="resultsPerPage" value="25" <?php if ('25' == $_SESSION['resultsPerPage']) print 'selected'; ?>>25</option>
		<option class="filter" name="resultsPerPage" value="50" <?php if ('50' == $_SESSION['resultsPerPage']) print 'selected'; ?>>50</option>
	</select>
	</div> -->
	<div class="search-inner-form order-by">
	<strong>Order By:</strong>
	<select name="orderResults" class="orderResultsForm">
		<option class="filter" name="orderResults" value="ASC" <?php if ('ASC' == $_SESSION['orderResults']) print 'selected'; ?>>Property (A-Z)</option>
		<option class="filter" name="orderResults" value="DESC" <?php if ('DESC' == $_SESSION['orderResults']) print 'selected'; ?>>Property (Z-A)</option>
		<option class="filter" name="orderResults" value="sqfootage" <?php if ('sqfootage' == $_SESSION['orderResults']) print 'selected'; ?>>Square Footage</option>
		<option class="filter" name="orderResults" value="acreage" <?php if ('acreage' == $_SESSION['orderResults']) print 'selected'; ?>>Acreage</option>
		<option class="filter" name="orderResults" value="newest" <?php if ('newest' == $_SESSION['orderResults']) print 'selected'; ?>>Newest</option>
		<option class="filter" name="orderResults" value="priceLow" <?php if ('priceLow' == $_SESSION['orderResults']) print 'selected'; ?>>Price (Lowest-Highest)</option>
		<option class="filter" name="orderResults" value="priceHigh" <?php if ('priceHigh' == $_SESSION['orderResults']) print 'selected'; ?>>Price (Highest-Lowest)</option>
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
		<div class="search-results-container">
		<p class="pull-left result-summary">Found <strong><?php echo $mapposts->found_posts ?></strong> property(s) matching your search criteria.</p>
		<?php
			if($mapposts->max_num_pages>1){?>
		    <p class="navrechts navigation pull-right">
		    Page 1 of <?php echo $mapposts->max_num_pages; ?>: 
		    <?php
		      if ($paged > 1) { ?>
		        <a href="<?php echo '?paged=' . ($paged -1) .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; //prev link ?>">«</a>
		                        <?php }
		    for($i=1;$i<=$mapposts->max_num_pages;$i++){?>
		        <a href="<?php echo '?paged=' . $i .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
		        <?php
		    }
		    if($paged < $mapposts->max_num_pages){?>
		        <a href="<?php echo '?paged=' . ($paged + 1) .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; //next link ?>">»</a>
		    <?php } ?>
		    </p>
		<?php } ?>
		</div>
		<ul>
			<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); 
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
							        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
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
<?php
if($mapposts->max_num_pages>1){?>
    <p class="navrechts navigation">
    Page 1 of <?php echo $mapposts->max_num_pages; ?>: 
    <?php
      if ($paged > 1) { ?>
        <a href="<?php echo '?paged=' . ($paged -1) .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; //prev link ?>">«</a>
                        <?php }
    for($i=1;$i<=$mapposts->max_num_pages;$i++){?>
        <a href="<?php echo '?paged=' . $i .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
        <?php
    }
    if($paged < $mapposts->max_num_pages){?>
        <a href="<?php echo '?paged=' . ($paged + 1) .'/&type=' . $_GET["type"] .'&region=' . $_GET["region"]; //next link ?>">»</a>
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
		
			var $link = $(".property-select option:selected").attr('data-permalink')
			window.location = $link;
		});

	




	function GetURLParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}

	var type = GetURLParameter('type');
	var region = GetURLParameter('region');

	console.log('type: ' + type);
	console.log('region: ' + region);


	// change
	$('#archive-filters').on('change', 'select', function(){
		// vars
		var url = 'http://www.maxtestdomain.com/boyle/search-availability/';
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
		
		

		// loop over args
		$.each(args, function( name, value ){
			if(type !== undefined) {
				url += '?region=' + value + '&type=' + type;
			} else {
				url += '?region=' + value + '&type=all';
			}
			
		});

		
		// reload page
		window.location.replace( url );
	});

	$('.property-type-selection a').on('click', function(e){
		e.preventDefault();
		var propertyType = $(this).attr('href');
		console.log('property type selected');
		var url = 'http://www.maxtestdomain.com/boyle/search-availability/';
		if(region == undefined){
			url += '?' + propertyType
		} else {
			url += '?region=' + region + '&' + propertyType;
		}
		
		window.location.replace( url );
	});

	$('.map-marker a').on('click', function(e){
		e.preventDefault();
		var regionType = $(this).attr('href');
		console.log('property type selected');
		var url = 'http://www.maxtestdomain.com/boyle/search-availability/';
		if(type == undefined){
			url += '?' + regionType + '&type=all';
		} else {
			url += '?' + regionType + '&type=' + type;
		}
		
		window.location.replace( url );
	});
	
	
		// var $href = $('.navrechts a').attr('href');
		// if(type !== undefined) {
		// 	$('.navrechts a').attr('href', $href + '&type=' +type);
		// }

		// if(region !== undefined) {
		// 	$('.navrechts a').attr('href', $href + '&region=' +region);
		// }
		
	

})(jQuery);
</script>
<style type="text/css">

.acf-map {
	width: 400px;
	height: 400px;
	border: #ccc solid 1px;
	float: left;
}

.map {
	max-width: 400px;
	max-height: 400px;
	float: right;
	
}

.map img {
	border: 3px solid #616d77;
}

@media (max-width: 960px) {
	.acf-map {
		width: 100%;
		height: 200px;
	}
	.map {
		float: left;
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