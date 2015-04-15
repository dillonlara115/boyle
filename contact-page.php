<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container" >
	<?php the_post(); ?>
	<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Phone.png" alt="Contact Us" title="Contact Us" class="header-image">

	<h1 class="contact-page-title"><?php the_title(); ?></h1>
	<p class="contact-page-text">Send us a message using the form below.</p>
	<div id="post-<?php the_ID(); ?>" class="services-container" >

		<div class="static-pages-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php dynamic_sidebar( 'contact' ); ?>
</div>


<?php get_footer(); ?>