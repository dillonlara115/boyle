<?php
/*
Template Name: Memphis Landing Page
*/
?>

<?php get_header(); ?>
	<div class="outer-image-container property-image-container">
		<div class="static-header-image-container">
			<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?> 
		</div> 
		<h2><?php echo the_title(); ?></h2>
	</div>
    <div class="bucket-container">
        <div class="homepage-sub">
           
        <div class="homepage-sub-section landing-page-sub-section" >
        	<img src="http://maxtestdomain.com/boyle/wp-content/themes/boyle/images/Icons/Icon-Trees.png" alt="Company History" />
        	<div class="Text-Black-Small">
	            <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">S</span>EARCH <span style="font-size: 9pt;">M</span>EMPHIS:</div>
	            <div>
	                <div class="homepage-sub-section-content-text">Search our Memphis properties.</div>
	            </div>
	            <a href="<?php echo get_permalink( 1059 ); ?>?region=memphis_metro_area" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to search</a>
            </div>
            <i class="mobile-icon"></i>
        </div>
                
        <div class="homepage-sub-section landing-page-sub-section" >
        	<img src="http://maxtestdomain.com/boyle/wp-content/themes/boyle/images/Icons/Icon-Trees.png" alt="Company History" />
            <div class="Text-Black-Small">
                <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">P</span>ROPERTY <span style="font-size: 9pt;">P</span>ORTFOLIO:</div>
                <div class="homepage-sub-section-content-text">View our Memphis Properties.<br />
                </div>
                <a href="<?php echo get_permalink( 1506 ); ?>" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                                    
            </div>  
          <i class="mobile-icon"></i> 
        </div>
        <div class="homepage-sub-section landing-page-sub-section" >
        <img src="http://maxtestdomain.com/boyle/wp-content/themes/boyle/images/Icon-Book.png" alt="Company History" />
            <div class="Text-Black-Small">
                <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">M</span>EMPHIS <span style="font-size: 9pt;">T</span>EAM:</div>
                <div class="homepage-sub-section-content-text">Meet our Memphis Team.<br />
                </div>  
                <a href="<?php echo get_permalink( 70 ); ?>" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
            </div>
            <i class="mobile-icon"></i>  
        </div>
    </div>    
              
    <div class="homepage-divider"></div>
    </div>
<div id="content" class="static-container static-contact-container landing-page-content"  >
	<?php the_post(); ?>
	
	<div class="property-type-list-content property-list-container">
		<div class="Text-Blue">
			<?php the_content(); ?>
		</div>
		<hr>
		<div class="landing-page-bucket-container">
			<div class="bucket">
				<h4>All <?php echo the_title(); ?> Properties</h4>
				<a href="<?php echo get_permalink( 1059 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View All Properties</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Mixed-Use Properties</h4>
				<a href="<?php echo get_permalink( 306 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Mixed-Use Properties</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Office Space</h4>
				<a href="<?php echo get_permalink( 308 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Office Space</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Retail Properties</h4>
				<a href="<?php echo get_permalink( 310 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Retail Properties</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Residential Properties</h4>
				<a href="<?php echo get_permalink( 312 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Residential Properties</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Industrial Properties</h4>
				<a href="<?php echo get_permalink( 314 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Industrial Properties</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Hotels</h4>
				<a href="<?php echo get_permalink( 316 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Hotels</a>
			</div>
			<div class="bucket">
				<h4><?php echo the_title(); ?> Land</h4>
				<a href="<?php echo get_permalink( 318 ); ?>?region=memphis_metro_area" class="Text-Blue-Small">&raquo&nbsp;View Land</a>
			</div>
		</div>

		<hr>


		<h3><?php echo the_title(); ?> News</h3>
				<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// args for residential property types
		$args = array(
			'post_type'		=> 'news',
			'meta_key'	=> 'date',
			'orderby'		=> 'meta_value_num title',
			'order'			=> 'DESC',
			'posts_per_page'	=> 5,
			'paged'		=> $paged,
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'tag_a_region',
					'value'		=> 'greater Memphis',
					'compare'	=> 'LIKE'
				),
				
			)
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
		    	<a href="<?php echo get_permalink( 1914 ); ?>">View More News Articles</a>
		    </p>
		<?php } ?>
	</div>

	
</div>


<?php get_footer(); ?>