</div>
<?php if ( is_front_page()) {  ?> 
<div id="footer" class="footer-home">
<?php } else { ?> 
<div id="footer">
<?php } ?>
	<div class="container-footer">                   

    <ul class="footer-nav">
        <li class="BottomNav"><a href="<?php echo home_url(); ?>" >home</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 985 ); ?>" >availability report</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 1059 ); ?>" >search availability</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 1512 ); ?>" >property portfolio</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 13 ); ?>" >services</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 1894 ); ?>" >news</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 2 ); ?>" >about</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 25 ); ?>" >contact</a></li>
        <li class="BottomNav"><a href="<?php echo get_permalink( 11 ); ?>" >disclaimer</a></li>
        <li class="BottomNav"><a href="#" >site map</a></li>
    </ul>

	<div class="BottomNav BottomNav-office">Memphis Office <a href="tel:9017670100">(901) 767-0100</a></div>
    <div class="BottomNav BottomNav-office"> Nashville Office <a href="tel:6155505575">(615) 550-5575</a></div>
	<div class="BottomNav">Boyle is a Memphis and Nashville based real estate development, sales, leasing and management company specializing in commercial and residential properties.</div>
	<div class="BottomNav copy-nav">&copy;&nbsp;2015 <a href="#" style="font-size: 7pt;">Boyle Investment Company</a>. All Rights Reserved. </div>
	<div ><a href="#" target="_blank">Boyle FTP Site</a></div>
              
         <?php if ( !is_front_page()) {  ?> 
            <div style="padding-top: 15px;">
                <a href="http://www.facebook.com/?ref=logo#!/pages/Memphis-TN/Boyle-Investment-Company/73372158561" target="_blank" >
                    <img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Facebook-Small.png" alt="Follow Us on Facebook" title="Follow Us on Facebook" style="border-width: 0px; width: 22px; height: 22px;">
                </a>
                <input type="image" name="ctl00$ImageButtonTwitter" id="ctl00_ImageButtonTwitter" src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Twitter-Small.png" style="border-width:0px;margin-left: 11px;" />
                <a href="http://blog.boyle.com/" style="text-decoration:none; margin-left: 11px;" target="_blank">
                    <img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Wordpress-Small.png" alt="Read our Blog" style="border:0; width:22px; height:22px;" title="Read our Blog" />
                </a>
                <a href="https://plus.google.com/118331241103122481499?prsrc=3" style="text-decoration:none; margin-left: 11px;" target="_blank">
                    <img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-GooglePlus-Small.png" alt="Follow us on Google+" style="border:0; width:22px; height:22px;" title="Follow us on Google+" />
                </a>
            </div>
        <?php } ?>

	</div>
   

</div>

<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/common.js"></script>
<!-- Include the Sidr JS -->

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.sidr.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/navigation.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>

</body>
</html>