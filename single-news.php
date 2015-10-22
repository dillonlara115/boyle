<?php get_header(); ?>
<article id="content">
<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content news-container">
<?php 

$posts = get_posts(array(
    'post_type'		=> 'news',
	'meta_key'		=> 'boyle_report',
	'meta_value'	=> 'Yes'
));

if( get_field('boyle_report') == 'Yes' ) { ?>
    <h1 class="Title-Blue"><?php the_title(); ?></h1>
    <div class="pull-left report-left">
    	<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "report-image") ); ?>
    	<i><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?> </i>
	</div>
	<div class="report-content-container">
		<?php the_content(); ?>
	</div>
<?php } else { ?>

	<h1 class="agent-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>

<?php }	?>

	
</div>

</div>


</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>