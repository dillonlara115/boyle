<?php
/*
Template Name: Availability Report Page
*/
?>

<?php get_header(); ?>

<div id="content" class="static-container static-contact-container" >
	<?php the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" class="search-availability-container" >
		<?php the_content(); ?>
		<div class="availability-report pull-left">
			<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/05/Icon-Report.png" alt="Availability Report" title="Availability Report" class="header-image">
			<h1 class="contact-page-title">Availability Report:</h1>
			<p class="contact-page-text">Select the tab of the property type for which you are interested in seeing properties.</p>
		</div>
		<a href="javascript:window.print()" class="single-property-print pull-right"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2015/06/Icon-Print.gif"></a>
		<div class="property-sub-navigation">

			<?php wp_nav_menu( array('menu' => 'Availability Report Regions Menu', 'container_class' => 'hidden-mobile'  )); ?>

		</div>
		<div class="visible-mobile">
			<strong>Select a Region: </strong>
			<?php
		    	wp_nav_menu( array(
			    	'menu' => 'Availability Report Regions Menu',
			        'theme_location' => 'mobile-nav',
			        'items_wrap'     => '<select class="drop-nav"><option value="">Select a page...</option>%3$s</select>',
			        'walker'  => new Walker_Nav_Menu_Dropdown())
		        );
			?>
			<br>
		</div>

		<div class="search-availability-content">

			<?php if ( is_page( 'all-regions' ) || is_page(606) || is_page(604) || is_page(608) || is_page(595) || is_page(597)|| is_page(601) || is_page(599) || is_page(985) ) {     ?>

			    <?php get_template_part('templates/availability-report/all-regions'); ?>

			<?php } else if (is_page( 'greater-memphis' ) || is_page(621) || is_page(624) || is_page(619) || is_page(610) || is_page(612)|| is_page(617) || is_page(614) || is_page(987) ) { ?>

			    <?php get_template_part('templates/availability-report/memphis'); ?>

			<?php } else if (is_page( 'greater-nashville') || is_page(636) || is_page(634) || is_page(638) || is_page(626) || is_page(628)|| is_page(632) || is_page(630) || is_page(989) ) { ?>

				<?php get_template_part('templates/availability-report/nashville'); ?>

			<?php } else if (is_page( 'other-regions' ) || is_page(650) || is_page(648) || is_page(652) || is_page(640) || is_page(642)|| is_page(646) || is_page(644) || is_page(991) ) { ?>

				<?php get_template_part('templates/availability-report/other-regions'); ?>

			<?php } ?>

		</div>

	</div>

	
</div>
<script type="text/javascript">
(function($) {

var found = {};

$("[data-title]").each(function(){
    var $this = $(this);
    var rel = $this.attr("data-title");

    if(found[rel]){
        $this.remove();
    }else{
        found[rel] = true;
    }
});


})(jQuery);
</script>

<?php get_footer(); ?>