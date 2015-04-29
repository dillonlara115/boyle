<?php
/*
Template Name: Nashville Team Page
*/
?>

<?php get_header(); ?>

<?php echo get_the_post_thumbnail( $page->ID, 'large', array( 'class'	=> "static-header-image") ); ?> 
<div id="content" class="static-container" >
	<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="about-container" >
		

		<h1 class="static-pages-title"><?php the_title(); ?></h1>

		<div class="static-pages-content">
			<?php the_content(); ?>
			<?php	$query = new WP_Query( array( 'post_type' => 'staff_directory' ) );
				if ( $query->have_posts() ) : ?>	
			<ul class="static-expandable-content">
				<li>
					<h3 data-toggle-title="closed">Executive Management</h3>
					<div class="toggle-content is-hidden">
						<p>Boyle’s conservative management style has given the company the long-term financial stability needed to take advantage of opportunities regardless of market conditions. Our experienced management team is comprised of Boyle family members and a deep bench of experts who have been with the company for more than 35 years. The result has been long-term organizational stability and steady, sustained growth that is exceptional in the changing real estate industry. </p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Executive Management", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Office Division</h3>
					<div class="toggle-content is-hidden">
						<p class="content-left">Meet our Boyle Nashville office properties team. We believe that anyone can find space, but we take pride in finding the right space at the right time. In order to do this, we bring a strong portfolio of our own properties to the table, with a broad range of locations and price ranges to suit every need. Each client is treated with the same level of importance, from an elegant Class-A office building, or custom headquarters, to a 1,500-square-foot user with a specific need. Boyle combines world-class service with local knowledge and expertise in management and leasing, so make your next office lease as simple and seamless as possible by calling Jeff or Thomas.</p><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Office-Team_Jeff-Haynes_Thomas-McDaniel.jpg" class="image-right" />
						<div class="agent-container staff-container">
													
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Office Division", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							
						</div>

					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Retail Division</h3>
					<div class="toggle-content is-hidden">
						<p class="content-left">Boyle knows that in the retail business, location is vital. The key to a successful retail location is high visibility, high traffic counts and excellent demographics. Boyle also believes that the success of a retail environment is based on our hands-on, long-term ownership approach, which supports retailers and enables our properties to actually improve with time. At Boyle, we go the extra mile to provide retailers with every opportunity for success. Meet your retail experts: </p><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Retail-Team_Grant-Kinnett_Phil-Fawcett_Mark-Traylor.jpg" class="image-right" />
						
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Retail Division", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Development/Land Division</h3>
					<div class="toggle-content is-hidden">
						<p>Boyle's development and land team offers planning, design, entitlement, and execution of site and building improvements across Boyle's commercial portfolio of properties. Additionally, Ballash oversees Boyle Nashville's growing residential land development market, and continuously works with ownership to analyze new commercial, mixed-use and residential development opportunities.</a></p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Development/Land Division", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Property Management Division</h3>
					<div class="toggle-content is-hidden">
						<p class="content-left">Boyle believes in maintaining and managing our properties with the strictest of standards. This translates to the tenant in our commitment to provide impeccable, personable, and efficient property management services. We never want a tenant in a Boyle managed property to leave, unless we can no longer accommodate their space needs, because the highest expense in property ownership is turnover and vacancy. Our property managers are in the business of building relationships with each and every tenant, which means you won’t just see us when you place a maintenance request. These are the faces that you will see in your building each and every week:</p><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/Prop-Mgmt-Team_Logan-Hughes_John-Harlin_Kent-Smith.jpg" class="image-right" />
					<div class="agent-container staff-container">
													
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Property Management Division", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							
					</div>
				</div>
				<hr>
			</li>
			<li>
				<h3 data-toggle-title="closed">Accounting Division</h3>
				<div class="toggle-content is-hidden">
					<p>Accounting isn’t just about crunching numbers. It is about security, peace of mind, and accuracy, which we take very seriously. The accounting department at Boyle is responsible for all financial accounting and reporting, tax planning, and compliance for Boyle, as well as its subsidiaries and partnerships. The result is timely and accurate results, highly customized reports, and specialized planning methods that allow Boyle’s management, customers, lenders, joint venture partners, and tenants to breathe easier and move forward with confidence.</p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Accounting Division", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
				</div>
				<hr>
			</li>
			<li>
				<h3 data-toggle-title="closed">Human Resources</h3>
				<div class="toggle-content is-hidden">
					<p>The sign out front of our offices defines our culture because the Boyle name is synonymous with integrity, longevity, and our client relationships.  It means that every time we meet or speak with a client, we are going to ask them how they are doing, and how their families are, without thinking twice. It means that we value our own internal diversity and what each person brings to the table to make Boyle Investment Company successful.  All of this translates into our internal culture. How many companies have executives who have been with them for 35 years or more? This is a testament to how we operate and our values.</p> 
					
					<p>Getting the job done right the first time, a commitment to excellence, and a down-to-earth approach.   Boyle Investment Company.</p>
					
					<p>If you are interested in a job opportunity, please contact Theresa Locastro, Director of Human Resources, at
						<a href="mailto:theresal@boyle.com">theresal@boyle.com</a> or <a href="tel:9017664250">(901) 766-4250</a>.</p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Human Resources", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Marketing Team</h3>
					<div class="toggle-content is-hidden">
						<p> We are not your typical marketing department. We are in the business of challenging ourselves and delivering great ideas. That is what it took to navigate this market for more than 78 years. We view everyone within Boyle as our client, and are committed to serving them with new and innovative ideas and approaches to advertising, as well as public, community and media relations. This doesn’t end at the first sign of a good idea or at the close of a business day. It is an on-going process with a desire to keep pushing ourselves for results that serve you.</p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Marketing Team", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Customer Service</h3>
					<div class="toggle-content is-hidden">
						<p>As the customer service guru for Boyle Nashville, Joan is the voice on the other end of the phone when you call, and the first face you see when you visit our office. She has extensive knowledge regarding the Boyle Nashville portfolio, and brings a wealth of experiece to the table as someone who has been in the commercial real estate industry for over twenty years.</p>
							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Customer Service", get_field('nashville_tags')) ) { 
									$image = get_field('picture'); ?>
										<div class="staff-item">
											<div class="staff-item-image">
												<img src="<?php echo $image['url'];?>"/>
											</div>
											<div class="staff-item-content">
												<h3><?php echo the_title(); ?></h3>
												<a href="<?php echo get_permalink(); ?>">Click for Biography</a>
												<div class="staff-item-content-contact">
													<p>Office: <?php echo the_field('phone_number'); ?></p>
													<p>Email: <a href="mailto:<?php echo the_field('email'); ?>"><?php echo the_field('email'); ?></a></p>
												</div>
											</div>
										</div>

									<?php	}	?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
			</ul>

			<?php else : ?>
				<!-- show 404 error here -->
			<?php endif; ?>
		</div>
	</div>

	<?php dynamic_sidebar( 'about' ); ?>
</div>


<?php get_footer(); ?>