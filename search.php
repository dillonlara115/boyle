<?php get_header(); ?>
<div class="Title-Blue search-title" style="text-align: left;margin: 10px 0 15px;"><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Icon-MagnifyingGlass.gif" alt="Search Properties">Search Boyle.com:</div>
<div id="content" class="property-type-list-content property-list-container">
	<?php if(have_posts()) : ?>

		<?php   
		$last_type="";
		$typecount = 0;
		while (have_posts()) :
			the_post();
		if ($last_type != $post->post_type){
			$typecount = $typecount + 1;
			if ($typecount > 1){
        echo '</div><!-- close container -->'; //close type container
    }
    // save the post type.
    $last_type = $post->post_type;
    //open type container
    switch ($post->post_type) {
    	case 'properties':
    	echo "<p class=\"Title-Blue property-search-results\">Property Search Results:</p>";
    	break;
    	case 'page':
    	echo "<div class=\"Title-Blue\"><h2>Web Page Search Results:</h2>";
    	break;

    }
} 
?>

<?php if('properties' == get_post_type()) : ?>
	<?php 
		$images = get_field('property_gallery');
		$image_1 = $images[0];  
		$agents = get_field('agent');	
	?>
	<li class="result-item">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>">
						<?php if( $images ) { ?>
		            		<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
						<?php } else { ?>
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail', array( 'class'	=> "availability-report-image") ); ?>
						<?php 	} ?> 
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
<?php endif; ?>

<?php if('page' == get_post_type()) : ?>
	<div class="page-result">
	<a href="<?php the_permalink(); ?>" class="SubTitle-Blue"><?php the_title(); ?></a>
	<?php the_excerpt( __( 'continue reading <span class="meta-nav">&raquo;</span>', 'blankslate' )  ); ?>
	<a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
	<hr>
	</div>
<?php endif; ?>


<?php endwhile; ?>

<?php else : ?>
	<div class="open-a-div">
		<p>No results found.</p>    

	<?php endif; ?>       

</div><!-- throw a closing div in --> 
</div>

<?php get_footer(); ?>