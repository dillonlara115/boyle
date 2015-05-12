<?php get_header(); ?>
<article id="content">
<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content">
<h1 class="agent-title"><?php the_title(); ?>, <?php the_field('title'); ?>, <?php the_field('office'); ?></h1>
<?php the_content(); 
$image = get_field('picture'); ?>
	<div class="content-pull-left">
		<?php if(get_field('responsibilities')) { ?>
			<p><strong>Responsibilities: </strong><?php echo the_field('responsibilities'); ?></p>
		<?php } ?>
		<?php if(get_field('professional_record')) { ?>
			<p><strong>Professional Record: </strong><?php echo the_field('professional_record'); ?></p>
		<?php } ?>
		<?php if(get_field('education')) { ?>
			<p><strong>Education: </strong><?php echo the_field('education'); ?></p>
		<?php } ?>
		<?php if(get_field('professional_affiliations')) { ?>
			<p><strong>Professional Affiliations: </strong><?php echo the_field('professional_affiliations'); ?></p>
		<?php } ?>
		<?php if(get_field('civic_and_community_involvement')) { ?>
			<p><strong>Civic and Community Involvement: </strong><?php echo the_field('civic_and_community_involvement'); ?></p>
		<?php } ?>
		<?php if(get_field('honors_and_awards')) { ?>
			<p><strong>Honors and Awards: </strong><?php echo the_field('honors_and_awards'); ?></p>
		<?php } ?>
		
		<div class="staff-item-content-contact">

			<p>Contact:<br>
				Office: <?php echo the_field('phone_number'); ?><br>
				Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
		</div>
	</div>
	<div class="pull-left">
		<img src="<?php echo $image['url'];?>"/>
	</div>
	
	


</div>

</div>

<?php comments_template('', false); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>