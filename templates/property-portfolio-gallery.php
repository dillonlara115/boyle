<?php 

$images = get_field('property_gallery');
$image_1 = $images[0]; 
if( $images ): ?>
<img src="<?php echo $image_1['sizes']['large']; ?>" alt="<?php echo $image_1['alt']; ?>" class="main-image"/>
<hr>
<small>Click on an individual photo to see the larger version.</small>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" data-swap="<?php echo $image['sizes']['large']; ?>" class="thumb"/>
                <p class="gallery-caption"><?php echo $image['caption']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?> 