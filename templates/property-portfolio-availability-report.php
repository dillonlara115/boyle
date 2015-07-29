
<?php
$subproperties = get_posts(
	array(
		'post_type' => 'properties',
		'numberposts'	=> -1,
		'orderby'	=> 'title',
		'order'		=> 'ASC',
		'meta_query' => array(
			'relation'		=> 'AND',
			array(
				'key' => 'community', // name of custom field
				'value' => '"' . get_the_ID() . '"',
				'compare' => 'LIKE'
			),
			array(
				'key'		=> 'activate_property',
				'value'		=> 'This property is active',
				'compare'	=> 'LIKE'
			)
		)
	)
);
?>
<?php $communities = get_field('community'); ?>
<?php if($communities) { ?>
<?php if ( ! empty( $subproperties ) ) { ?>
	<ul>
		<?php foreach($subproperties as $property) : ?>
			<?php 
				$images = get_field('property_gallery', $property->ID);
				$image_1 = $images[0];  
				$agents = get_field('agent', $property->ID);
			?>
			<li>
				<img src="<?php echo $image_1['sizes']['thumbnail']; ?>" alt="<?php echo $image_1['alt']; ?>" class="availability-report-image"/>
				<strong><a href="<?php echo get_permalink( $property->ID ); ?>"><?php echo get_the_title( $property->ID ); ?></a></strong>
					<?php if($agents) { ?>
						<?php foreach($agents as $agent): ?>
							<strong class="pull-right"><a href="mailto:<?php echo the_field('email', $agent->ID); ?>">Contact <?php echo get_the_title( $agent->ID ); ?></a></strong>
						<?php endforeach; ?>
					<?php } ?>
				<p><?php echo the_field('description', $property->ID); ?></p>
				<?php
				// check if the repeater field has rows of data
				if( have_rows('suite_information_acres', $property->ID) ): ?>
					<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
					    <tbody><tr class="Header">
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
					    </tr>
							    
				  <?php  while ( have_rows('suite_information_acres', $property->ID) ) : the_row();
						$attachment = get_sub_field('lot_file', $property->ID); ?>

				         <tr class="Item">
					        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title', $property->ID); ?></td>
					        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size', $property->ID); ?></td>
					        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price', $property->ID); ?></td>
					    </tr> 

				 <?php  endwhile; ?>
								
				</tbody></table>

				<?php elseif( have_rows('suite_information_feet', $property->ID) ): ?>
					<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
					    <tbody><tr class="Header">
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Sq. Ft.</td>
					        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
					    </tr>
							    
				  <?php  while ( have_rows('suite_information_feet', $property->ID) ) : the_row();
						$attachment = get_sub_field('lot_file', $property->ID); ?>

				         <tr class="Item">
					        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title', $property->ID); ?></td>
					        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size', $property->ID); ?></td>
					        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price', $property->ID); ?></td>
					    </tr> 

				 <?php  endwhile; ?>
								
				</tbody></table>
				<?php else :
					// no rows found
				endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php } ?>
<?php } ?>

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
	        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Sq. Ft.</td>
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