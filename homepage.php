<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<div id="content">    

    <div class="hp-ss">
        <img id="ctl00_ContentPlaceHolderMain_SlideshowLogo" class="logo" src="<?php bloginfo('template_directory'); ?>/Media/Images/Logo-Boyle.png" >
		<?php putRevSlider("home-page","homepage") ?>
	</div>
    <div class="bucket-container">
        <div class="homepage-sub">
           
        <div class="homepage-sub-section" >
            <div class="homepage-sub-section-image">
                <a href="#">
                    <img src="<?php the_permalink(); ?>wp-content/themes/boyle/images/Icons/Icon-Trees.png" alt="Company History" />
                </a>
            </div>
            <div class="Text-Black-Small homepage-sub-section-content">
                <div class="hidden-mobile">
                    <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">M</span>EMPHIS:</div>
                    <div>
                        <div class="homepage-sub-section-content-text">View our Memphis properties.</div>
                    </div>
                </div>
                <a href="<?php echo get_permalink( 2580 ); ?>" class="visible-mobile">
                    <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">M</span>EMPHIS:</div>
                    <div>
                        <div class="homepage-sub-section-content-text">View our Memphis properties.</div>
                    </div>
                </a>
                <a href="<?php echo get_permalink( 2580 ); ?>" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                
            </div> 
            <a href="<?php echo get_permalink( 2580 ); ?>"><i class="mobile-icon"></i>   </a>            
        </div>
                
        <div class="homepage-sub-section" >

            <div class="homepage-sub-section-image">
                <a href="#">
                    <img src="<?php the_permalink(); ?>wp-content/themes/boyle/images/Icons/Icon-Trees.png" alt="Company History" />
                </a>
            </div>
            <div class="Text-Black-Small homepage-sub-section-content">
                <div class="hidden-mobile">
                    <div class="Title-Blue-Small homepage-sub-section-content-title">
                        <span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">N</span>ASHVILLE:
                    </div>
                    <div class="homepage-sub-section-content-text">View our Nashville Properties.<br />
                    </div>
                </div>
                <a href="<?php echo get_permalink( 2583 ); ?>"  class="visible-mobile">
                    <div class="Title-Blue-Small homepage-sub-section-content-title">
                        <span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">N</span>ASHVILLE:
                    </div>
                    <div class="homepage-sub-section-content-text">View our Nashville Properties.<br />
                    </div>
                </a>
                <a href="<?php echo get_permalink( 2583 ); ?>" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                                    
            </div>  
          <a href="<?php echo get_permalink( 2583 ); ?>"><i class="mobile-icon"></i> </a>
        </div>
        <div class="homepage-sub-section" >
            <div class="homepage-sub-section-image">
                <a href="#">
                    <img src="<?php the_permalink(); ?>wp-content/themes/boyle/images/Icon-Book.png" alt="Availability Report" />
                </a>
            </div>
            <div class="Text-Black-Small homepage-sub-section-content">
                <div class="hidden-mobile">
                     <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">A</span>VAILABILITY <span style="font-size: 9pt;">R</span>EPORT:</div>
                    <div class="homepage-sub-section-content-text">View our availability report.<br />   
                    </div>  
                </div>
                <a href="<?php echo get_permalink( 985 ); ?>"  class="visible-mobile">
                    <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">A</span>VAILABILITY <span style="font-size: 9pt;">R</span>EPORT:</div>
                    <div class="homepage-sub-section-content-text">View our availability report.<br />   
                    </div>  
                </a>
                <a href="<?php echo get_permalink( 985 ); ?>" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                                  
            </div>
            <a href="<?php echo get_permalink( 985 ); ?>"><i class="mobile-icon"></i>  </a>
        </div>
    </div>    
              
    <div class="homepage-divider"></div>
    </div>


    </div>            
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>