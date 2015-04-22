<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <html> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>>  <!--<![endif]-->

<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title(' | ', true, 'right'); ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://maxtestdomain.com/reinhardt/wp-content/themes/reinhardt/sidr/jquery.sidr.dark.css">
<?php wp_head(); ?>
</head>
<body class="container" <?php body_class(); ?>>


    <div class="header-nav-primary" > 
    
		<?php if (! is_front_page()) {  ?> 
		<ul class="header-nav-primary-sub">
			<li class="nav-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo"><img src="<?php bloginfo('template_directory'); ?>/images/boyle-blue-logo.gif"></a></li>
			<li class="TopNav TopNav-sub"><a href="#">REGISTER/LOGIN</a></li>
	    	<li class="TopNav TopNav-sub"><a href="#">BOYLE BLOG</a></li>
	    	<li class="TopNav TopNav-sub"><a href="http://www.boyleinsuranceagency.com/">BOYLE INSURANCE AGENCY</a></li>
    	</ul>
		<?php } else { ?> 
		<ul>
	    	<li class="TopNav"><a href="#">REGISTER/LOGIN</a></li>
	    	<li class="TopNav"><a href="#">BOYLE BLOG</a></li>
	    	<li class="TopNav"><a href="http://www.boyleinsuranceagency.com/">BOYLE INSURANCE AGENCY</a></li>
    	</ul>
    	<?php } ?>
    
	    <div class="Text-Gray header-nav-subsection">
	        <div style="padding-bottom: 5px;">
	        	<a href="http://www.facebook.com/?ref=logo#!/pages/Memphis-TN/Boyle-Investment-Company/73372158561" target="_blank" style="margin-left: 5px;">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Facebook-Small.png" alt="Follow Us on Facebook" title="Follow Us on Facebook" style="border-width: 0px; width: 22px; height: 22px;">
	        	</a>
	        	<input type="image" name="ctl00$ImageButtonTwitter" id="ctl00_ImageButtonTwitter" src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Twitter-Small.png" style="border-width:0px;margin-left: 10px;" />
	        	<a href="http://blog.boyle.com/" style="text-decoration:none; margin-left: 10px;" target="_blank">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Wordpress-Small.png" alt="Read our Blog" style="border:0; width:22px; height:22px;" title="Read our Blog" />
	        	</a>
	        	<a href="https://plus.google.com/118331241103122481499?prsrc=3" style="text-decoration:none; margin-left: 10px;" target="_blank">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-GooglePlus-Small.png" alt="Follow us on Google+" style="border:0; width:22px; height:22px;" title="Follow us on Google+" />
	    		</a>
	    	</div>
	        <div id="ctl00_PanelSearch" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'ctl00_ImageButtonSearch')" style="padding-bottom: 5px;">
				<input name="ctl00$TextBoxSearch" type="text" value="SEARCH BOYLE" id="ctl00_TextBoxSearch" class="Text-Gray" OnFocus="return ClearKeywordTextBox(this);" OnBlur="return ClearKeywordTextBox(this);" style="width:100px;padding-left: 3px; padding-top: 3px; padding-bottom: 3px;" />&nbsp;
				<input type="image" name="ctl00$ImageButtonSearch" id="ctl00_ImageButtonSearch" src="<?php bloginfo('template_directory'); ?>/images/Button-Search-Off.gif" align="absmiddle" style="border-width:0px;" />
			</div>
		</div>  
    </div>
	
<div class="header-nav-1" >
 
    <?php wp_nav_menu( array( 'menu' => 'main-menu', 'container_class' => 'header-main-menu')); ?>

</div>

<!-- Mobile Navigation Label -->
<div class="mobile-header">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-logo"><img src="<?php bloginfo('template_directory'); ?>/images/boyle-blue-logo.gif"></a>
    <a id="simple-menu" href="#sidr"></a>
</div>
    
	<div id="sidr" data-mobile="nav">
		<!-- Responsive Menu Content -->
		<ul class="mobile-nav">
            <li id="ctl00_PanelSearch" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'ctl00_ImageButtonSearch')" style="padding-bottom: 5px;">
                
                <input name="ctl00$TextBoxSearch" type="text" placeholder="SEARCH BOYLE" id="ctl00_TextBoxSearch" class="Text-Gray" OnFocus="return ClearKeywordTextBox(this);" OnBlur="return ClearKeywordTextBox(this);"/>&nbsp;
                <input type="image" name="ctl00$ImageButtonSearch" id="ctl00_ImageButtonSearch" src="<?php bloginfo('template_directory'); ?>/images/Button-Search-Off.gif" align="absmiddle" class="mobile-search-button" />
           
            </li>
			<li><a href="#">Search Availability</a></li>
			<li><a href="#">Property Portfolio</a></li>
			<li><a href="<?php echo get_permalink( 13 ); ?>">Services</a></li>
			<li><a href="#">News</a></li>
			<li><a href="<?php echo get_permalink( 2 ); ?>">About Us</a></li>
			<li><a href="<?php echo get_permalink( 25 ); ?>">Contact</a></li>
            <li><a href="#">Register/Login</a></li>
            <li><a href="#">Boyle Blog</a></li>
            <li><a href="http://www.boyleinsuranceagency.com/">Boyle Insurance Agency</a></li>
			<li class="simple-menu-social">
	        	<a href="http://www.facebook.com/?ref=logo#!/pages/Memphis-TN/Boyle-Investment-Company/73372158561" target="_blank">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Facebook-Small.png" alt="Follow Us on Facebook" title="Follow Us on Facebook" style=" width: 22px; height: 22px;">
	        	</a>
	        	<input type="image" name="ctl00$ImageButtonTwitter" id="ctl00_ImageButtonTwitter" src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Twitter-Small.png"/>
	        	<a href="http://blog.boyle.com/" style="text-decoration:none;" target="_blank">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-Wordpress-Small.png" alt="Read our Blog" style="width:22px; height:22px;" title="Read our Blog" />
	        	</a>
	        	<a href="https://plus.google.com/118331241103122481499?prsrc=3" style="text-decoration:none;" target="_blank">
	        		<img src="<?php bloginfo('template_directory'); ?>/Media/Images/Icons/Icon-GooglePlus-Small.png" alt="Follow us on Google+" style=" width:22px; height:22px;" title="Follow us on Google+" />
	    		</a>
	    	</li>
			
		</ul>
	</div>


<div id="page">