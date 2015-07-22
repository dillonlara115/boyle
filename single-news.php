<?php get_header(); ?>
<article id="content">
<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content">
<h1 class="agent-title"><?php the_title(); ?></h1>
<?php the_content(); ?>
	
</div>

</div>


</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>