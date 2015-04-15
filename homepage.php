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
                <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">M</span>EMPHIS:</div>
                <div>
                    <input type="hidden" name="ctl00$ContentPlaceHolderDefault$HiddenFieldAvailabilityReportContentCategoryId" id="ctl00_ContentPlaceHolderDefault_HiddenFieldAvailabilityReportContentCategoryId" value="981" />
                    <div class="homepage-sub-section-content-text">Here is some placeholder text.</div>
                </div>
                <a href="#" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                
            </div> 
            <i class="mobile-icon"></i>               
        </div>
                
        <div class="homepage-sub-section" >

            <div class="homepage-sub-section-image">
                <a href="#">
                    <img src="<?php the_permalink(); ?>wp-content/themes/boyle/images/Icons/Icon-Trees.png" alt="Company History" />
                </a>
            </div>
            <div class="Text-Black-Small homepage-sub-section-content">
                <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">G</span>REATER <span style="font-size: 9pt;">N</span>ASHVILLE:</div>
                <input type="hidden" name="ctl00$ContentPlaceHolderDefault$HiddenFieldCompanyHistoryContentCategoryId" id="ctl00_ContentPlaceHolderDefault_HiddenFieldCompanyHistoryContentCategoryId" value="30" />
                <div class="homepage-sub-section-content-text">Here is some placeholder text.<br />
                    
                     
                </div>
                <a href="#" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                                    
            </div>  
          <i class="mobile-icon"></i> 
        </div>
        <div class="homepage-sub-section" >
            <div class="homepage-sub-section-image">
                <a href="#">
                    <img src="<?php the_permalink(); ?>wp-content/themes/boyle/images/Icon-Book.png" alt="Availability Report" />
                </a>
            </div>
            <div class="Text-Black-Small homepage-sub-section-content">
                <div class="Title-Blue-Small homepage-sub-section-content-title"><span style="font-size: 9pt;">A</span>VAILABILITY <span style="font-size: 9pt;">R</span>EPORT:</div>
                <input type="hidden" name="ctl00$ContentPlaceHolderDefault$HiddenFieldCompanyHistoryContentCategoryId" id="ctl00_ContentPlaceHolderDefault_HiddenFieldCompanyHistoryContentCategoryId" value="30" />
                <div class="homepage-sub-section-content-text">Here is some placeholder text.<br />
                    
                     
                </div>  
                <a href="#" class="Text-Blue-Small bucket-cta">&raquo&nbsp;Click here to read</a>
                                  
            </div>
            <i class="mobile-icon"></i>  
        </div>
    </div>    
              
    <div class="homepage-divider"></div>
    </div>


    </div>            
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>