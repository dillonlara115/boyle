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

		<div class="search-availability-content">
			
			<?php wp_nav_menu( array('menu' => 'Search Availability Menu' )); ?>
			<div class="property-type-list-content" id="search-houses">
				<?php the_title(); ?>
				<?php the_content(); ?>
				<strong>Region</strong>
				<?php 
				/*
					*  Get a field object and create a select form element
					*/

					$field_key = "field_5571a83579318";
					$field = get_field_object($field_key);

					if( $field )
					{
						echo '<select class="region-filter filter" data-filter="' . $field['key'] . '"" name="' . $field['key'] . '">';
							foreach( $field['choices'] as $k => $v )
							{
								echo '<option value="' . $k . '">' . $v . '</option>';
							}
						echo '</select>';
					}

					?>
				<strong>Metro Area</strong>
				<?php if (strstr($_SERVER['REQUEST_URI'], "greaterMemphis")){ ?>

				<?php 
				/*
					*  Get a field object and create a select form element
					*/

					$field_key = "field_55929f284c5fd";
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


</div>
<script type="text/javascript">
(function($) {
	
	// change
	$('#search-houses').on('change', '.region-filter', function(){

		// vars
		var url = '<?php echo home_url('search-availability'); ?>';
			args = {};

		
		// loop over filters
		$('#search-houses').each(function(){
			
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
			
			url +=value + '&';
			
		});
		
		// remove last &
		url = url.slice(0, -1);
		
	
		// reload page
		window.location.replace( url );
		

	});

})(jQuery);
</script>

<?php get_footer(); ?>