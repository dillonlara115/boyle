<table class="List" width="100%" cellpadding="5" cellspacing="1" border="0">
    <tbody><tr class="Header">
        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Lot</td>
        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Acres</td>
        <td style="text-align: center; vertical-align: middle; font-weight: bold;" class="Text-White">Price</td>
    </tr>
			<?php

				// check if the repeater field has rows of data
				if( have_rows('suite_information') ):


			         
				 	// loop through the rows of data
				    while ( have_rows('suite_information') ) : the_row();
						$attachment = get_sub_field('lot_file'); ?>

         <tr class="Item">
	        <td style="text-align: left; vertical-align: top; width: auto;"><?php echo the_sub_field('lot_title'); ?></td>
	        <td style="text-align: center; vertical-align: top; width: 125px;"><?php echo the_sub_field('lot_size'); ?></td>
	        <td style="text-align: center; vertical-align: middle;"><?php echo the_sub_field('lot_price'); ?></td>
	    </tr> 

				 <?php   endwhile;

				else :

				    // no rows found

				endif;

				?>
</tbody></table>