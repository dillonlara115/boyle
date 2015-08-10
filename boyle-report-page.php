<?php
/*
Template Name: Boyle Report Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container news-page" >
	<?php the_post(); ?>
	<div  class="search-availability-container" >
		<?php the_title(); ?>
		<?php the_content(); ?>
		<div class="search-availability-content">
			
			<div class="property-type-list-content news-list-container">

				<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// args for residential property types
				$args = array(
					'post_type'		=> 'news',
					'meta_key'		=> 'boyle_report',
					'meta_value'	=> 'Yes'

					);
		// query
				$the_query = new WP_Query( $args );
				?>
				<?php if( $the_query->have_posts() ): ?>
					<ul>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 

						?>
						<li>
							<h3><a class="Title-Blue" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<strong class="news-date"><?php echo the_field('date'); ?></strong>
							<p><?php echo the_field('abstract'); ?></p>
							<p><a href="<?php the_permalink(); ?>">» Read More</a></p>
							<hr>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p>No news articles have been found.</p>
			<?php endif; ?>
			<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>


			<?php
			if($the_query->max_num_pages>1){?>
			<p class="navrechts">
				<?php
				if ($paged > 1) { ?>
				<a href="<?php echo '?paged=' . ($paged -1); //prev link ?>"><</a>
				<?php }
				for($i=1;$i<=$the_query->max_num_pages;$i++){?>
				<a href="<?php echo '?paged=' . $i; ?>" <?php echo ($paged==$i)? 'class="selected"':'';?>><?php echo $i;?></a>
				<?php
			}
			if($paged < $the_query->max_num_pages){?>
			<a href="<?php echo '?paged=' . ($paged + 1); //next link ?>">></a>
			<?php } ?>
		</p>
		<?php } ?>

	</div>
</div>

</div>


</div>


<?php get_footer(); ?>