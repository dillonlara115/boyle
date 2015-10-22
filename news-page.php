<?php
/*
Template Name: News Page
*/
?>

<?php get_header(); ?>
	<div class="news-header">
			<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/06/Icon-Radio.png" alt="Boyle News" title="Boyle News" class="header-image">
			<h1 class="contact-page-title">Boyle News:</h1>
			<p class="contact-page-text">Browse the many articles below to learn more about Boyle.</p>
		</div>
	<div id="post-<?php the_ID(); ?>" class="property-sub-navigation portfolio-sub-navigation">
		<?php wp_nav_menu( array('menu' => 'News Regions Menu' )); ?>
	</div>
	<div class="visible-mobile boyle-news-mobile">
	<strong>Select a Region: </strong>
	<?php
    	wp_nav_menu( array(
	    	'menu' => 'News Regions Menu',
	        'theme_location' => 'mobile-nav',
	        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
	        'walker'  => new Walker_Nav_Menu_Dropdown())
        );
	?>
</div>
<div id="content" class="static-container static-contact-container news-page" >
	<?php the_post(); ?>
	<!-- featured properties sidebar -->
	<?php 

	// args
	$args = array(
		'numberposts'	=> -1,
		'post_type'		=> 'News',
		'meta_key'		=> 'featured_news',
		'meta_value'	=> 'Yes'
	);


	// query
	$the_query = new WP_Query( $args );

	?>
	<?php if( $the_query->have_posts() ): ?>
	<div class="services-sidebar-container news-sidebar">

		<div class="featured-news-item">
	           
	        	<h3><a class="Title-Blue" href="<?php echo get_permalink( 2397 ); ?>">Boyle Report</a>	</h3>
	        	<img width="150" height="150" src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/07/2014COVER_6-26-14-150x150.jpg" class="featured-news-image wp-post-image" alt="The grand opening for The Carrington at Schilling
Farms in Collierville was held in June. The project
consists of 111 above-market boutique flats,
town homes, and corner retail."> 
	            <p>This section contains Boyle Reports from Spring of 1994 to the Present</p>
	            
	            <p><a href="http://www.maxtestdomain.com/boyle/news/boyle-report/" class="pull-right">» Read More</a></p>
            </div>
	    
	    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
	        
	        <div class="featured-news-item">
	           
	        	<h3><a class="Title-Blue" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>	</h3>
	        	<?php if ( has_post_thumbnail() ) {
	        		the_post_thumbnail( 'thumbnail', array('class' => 'featured-news-image') ); 
	        	} ?> 
	            <p><?php the_field('abstract'); ?></p>
	            
	            <p><a href="<?php the_permalink(); ?>" class="pull-right">» Read More</a></p>
            </div>
            
	    <?php endwhile; ?>
	    
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
		<div  class="search-availability-container portfolio-container news-container" >
	
	
		
		<?php the_content(); ?>
		<div class="search-availability-content">
			<?php if ( is_page( 1894 ) || is_page(1913) || is_page(1907) || is_page(1905) || is_page(1910) || is_page(1897)|| is_page(1899) || is_page(1903) || is_page(1901) ) {     ?>

			    <?php get_template_part('templates/news/all-regions'); ?>

			<?php } else if (is_page(1914) || is_page(1931) || is_page(1926) || is_page(2019) || is_page(1928) || is_page(1917)|| is_page(1919) || is_page(1922) || is_page(1921) ) { ?>

			    <?php get_template_part('templates/news/memphis'); ?>

			<?php } else if (is_page(1933) || is_page(1949) || is_page(1944) || is_page(1942) || is_page(1947) || is_page(1935)|| is_page(1934) || is_page(2024) || is_page(1937) ) { ?>

				<?php get_template_part('templates/news/nashville'); ?>

			<?php } else if (is_page(1952) || is_page(1968) || is_page(1964) || is_page(1961) || is_page(1965) || is_page(1953)|| is_page(2017) || is_page(1960) || is_page(1957) ) { ?>

				<?php get_template_part('templates/news/other-regions'); ?>

			<?php } ?>
		</div>

	</div>

	
</div>


<?php get_footer(); ?>