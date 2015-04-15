<?php
/*
Template Name: About Pages
*/
?>

<?php get_header(); ?>

<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?> 
<div id="content" class="static-container" >
	<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="about-container" >
		

		<h1 class="static-pages-title"><?php the_title(); ?></h1>

		<div class="static-pages-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php dynamic_sidebar( 'about' ); ?>
</div>


<?php get_footer(); ?>