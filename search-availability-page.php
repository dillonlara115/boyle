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
				<?php the_title(); ?>
				<?php the_content(); ?>
				<strong>Region</strong>
				<div id="archive-filters">
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
				<strong>Metro Area</strong>
				<div class="metro-filters">
					<?php if (strstr($_SERVER['REQUEST_URI'], "memphis_metro_area")){ ?>
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
						<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'nashville_metro_area')){ ?>
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
							<?php } elseif (strstr($_SERVER['REQUEST_URI'], 'other')){ ?>
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
						<?php } ?>
					</div>
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

})(jQuery);
</script>

<?php get_footer(); ?>