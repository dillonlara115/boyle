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
			
					<option class="filter" data-filter="<?php echo $name; ?>" value="<?php echo $name; ?>"><?php echo $name; ?></option>
			
				<?php endforeach; ?>
				</select>
				
				</div>



			</div>

		</div>
		<div class="search-availability-results">
			<h3>Search Results</h3>
			<?php echo the_title(); ?>
		</div>
	</div>


</div>
<script type="text/javascript">
(function($) {
	
	// change
	$('#archive-filters').on('change', 'select', function(){

		// vars
		var url = '<?php echo home_url('search-availability'); ?>';
			args = {};
			
		console.log(url);
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
			
			url += '=' + value + '&';
			
		});
		
		
		// remove last &
		url = url.slice(0, -1);
		
		
		// reload page
		window.location.replace( url );
		

	});

})(jQuery);
</script>

<?php get_footer(); ?>