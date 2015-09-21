<?php get_header(); ?>
<article id="content">
<?php the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 
$news = get_posts(array(
	'post_type' => 'News',
	'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'staff_tags',
				'value'		=>  '"' . get_the_ID() . '"',
				'compare'	=> 'LIKE'
			),
		)
));

?>
<?php if( $news ): ?>
<div class="entry-content entry-col-content">
<?php else : ?>
<div class="entry-content">
<?php endif; ?>
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

<?php if( $news ): ?>
	<div class="news-col-sidebar">
		<h3 class="side-property-header side-property-header-community-news"><span>C</span>ommunity <span>N</span>ews</h3>
		<ul>
		<?php foreach( $news as $item ): ?>
			<li>
				<?php if(get_field('date', $item->ID)) { ?>
					<strong class="news-date"><?php the_field('date', $item->ID); ?></strong>
				<?php } ?>
				<a href="<?php echo get_permalink( $item->ID ); ?>">
					<?php echo get_the_title( $item->ID ); ?>
				</a>
				
				<hr>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

</div>

<?php comments_template('', false); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>