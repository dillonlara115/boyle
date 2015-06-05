( function( $ ) {

$('.bucket-availability').on('click', function(e){
	e.preventDefault();
	$(this).addClass('is-active');
	toggleViews();
	$('.report-container').removeClass('is-hidden');
	
});

$('.bucket-gallery').on('click', function(e){
	e.preventDefault();
	$(this).addClass('is-active');
	toggleViews();
	$('.gallery-container').removeClass('is-hidden');
});

$('.bucket-contact').on('click', function(e){
	e.preventDefault();
	$(this).addClass('is-active');
	toggleViews();
	$('.contact-container').removeClass('is-hidden');
});

$('.bucket-news').on('click', function(e){
	e.preventDefault();
	$(this).addClass('is-active');
	toggleViews();
	$('.community-news-container').removeClass('is-hidden');
});


//gallery
$('.thumb').on('click', function(){
	var largeSrc = $(this).attr('data-swap');
	console.log(largeSrc);
	$('.main-image').attr('src', largeSrc);
});



function toggleViews() {
	$('.services-container').addClass('full-width');
	$('.property-map-sidebar').hide();
	$('.inner-container').addClass('is-hidden');
}



} )( jQuery );