<?php 
	$news = get_posts(array(
		'post_type' => 'News',
		'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'key'		=> 'property_tags',
					'value'		=>  '"' . get_the_ID() . '"',
					'compare'	=> 'LIKE'
				),
			)
	));

?>
<?php if( $news ): ?>
	<div>
	<?php foreach( $news as $item ): ?>
		<div class="property-news-item">
			<?php if(get_field('date', $item->ID)) { ?>
				<strong class="news-date"><?php the_field('date', $item->ID); ?></strong>
			<?php } ?>
			<a href="<?php echo get_permalink( $item->ID ); ?>">
				<?php echo get_the_title( $item->ID ); ?>
			</a>
			<p class="news-item-p"><?php the_field('abstract', $item->ID); ?></p>
				<a href="<?php echo get_permalink( $item->ID ); ?>">
				» More
			</a>
			<hr>
		</div>
	<?php endforeach; ?>
	</div>

<?php endif; ?>