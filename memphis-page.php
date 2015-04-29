<?php
/*
Template Name: Memphis Team Pages
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
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Executive management", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							<!-- show pagination here -->
							</div>
						
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Office Division</h3>
					<div class="toggle-content is-hidden">
						<p class="content-left">Meet our Boyle office properties team.  From elegant ‘Class-A’ office buildings in the heart of East Memphis to custom headquarters for companies like Thomas & Betts, Baptist Memorial Health Care, ServiceMaster, and Helena Chemical, these seasoned real estate pros have been providing tenants with unparalleled service and attention for a combined two centuries.  No team combines world-class service with local knowledge and expertise like the management and leasing specialists at Boyle.  Make your next office lease as simple and seamless as possible by calling Mark Halperin and his team of experts at Boyle</p><img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/BoyleOfficeTeam.png" class="image-right" />
						<div class="agent-container staff-container">
				
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Office Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Retail Division</h3>
					<div class="toggle-content is-hidden">
						<p>Boyle knows that in the retail business, location is vital. The key to a successful retail location is high visibility, high traffic counts and excellent demographics. Boyle also believes that the success of a retail environment is based on our hands-on, long-term ownership approach, which supports the retailers and enables our properties to actually improve with time. At Boyle, we go the extra mile to provide retailers with every opportunity for success. Meet your retail experts:  </p> 

							<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
								if( in_array( "Retail Division", get_field('memphis_tags')) ) { 
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
					<h3 data-toggle-title="closed">Residential Division</h3>
					<div class="toggle-content is-hidden">
						<div class="content-left"><p>Boyle’s residential development team has years of experience in creating some of Memphis’ finest neighborhoods.  Boyle knows that finding the perfect home begins with finding the perfect neighborhood.  Our strong residential track record dates all the way back to 1906 when Boyle family ancestor, Edward Boyle, developed the iconic Belvedere Boulevard in midtown Memphis.  Since then, our residential team has developed elegant neighborhoods that have all stood the test of time, from River Oaks to The Cloisters to Blue Heron.  With our attention to detail and strict covenants, you can rest assured that your home will be a sound financial investment.  Let us welcome you to one of our neighborhoods.<br><br>Gary Thompson, 901-766-4246, <a href="mailto:garyt@boyle.com">garyt@boyle.com</a></p></div>
						<img src="http://www.maxtestdomain.com/boyle/wp-content/uploads/2015/04/BoyleResTeamTwinLakesHorz.png" class="image-right" />
						<div class="agent-container staff-container">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
							
											<?php 	
										if( in_array( "Residential Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Industrial Division</h3>
					<div class="toggle-content is-hidden">
						<p>
							Boyle’s industrial team has leased, managed and developed industrial properties for more than 50 years and has participated in transactions involving the Sharp Manufacturing Plant, Coors Brewery, Hunter Fan Company national distribution center as well as distribution centers throughout the Mid-South region. Led by Joel Fulmer, the only real estate professional in the country to hold the MAI, SIOR, CCIM and CRE designations, Boyle continues to provide real estate services that have made it the leader in commercial-industrial real estate for over 75 years.
						</p>
						<div class="staff-container">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
											<?php	
										if( in_array( "Industrial Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>

					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Mixed-Use Division</h3>
					<div class="toggle-content is-hidden">
						<p>
							Mixing it up makes sense! Boyle’s mixed use team pioneered the development of complex, large-scale mixed-use communities. In 1972, Boyle paved the way for the city of Memphis’ eastward growth with the development of the 204-acre Ridgeway Center, the city’s first true mixed-use community at Poplar and I-240 in the heart of the Poplar corridor.   In 1986, Boyle began development of the 300-acre Humphreys Center, now East Memphis’ bustling hub for medical and office tenants. More recent mixed-use communities include Schilling Farms and Price Farms in Collierville and Meridian Cools Springs and Berry Farms in Franklin. 
						</p>
						<div class="staff-container">

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								<?php
										if( in_array( "Mixed-Use Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
	
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Land Division</h3>
					<div class="toggle-content is-hidden">
						<p>
							Whatever your needs, Boyle’s land team offers strategic sites with the demographics and accessibility that are so essential to a property’s success. Current land resources in the Memphis and Nashville regions include thousands of developable acres. From zoning to full occupancy, Boyle’s land team has the expertise needed to handle truly complex projects. Boyle: Building sustainable communities that stand the test of time.
						</p>
						<div class="staff-container">
	
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Land Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
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
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Accounting Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
					<hr>
				</li>
				<li>
					<h3 data-toggle-title="closed">Property Management Division</h3>
					<div class="toggle-content is-hidden">
						<p>Boyle believes in maintaining and managing our properties with the strictest of standards. This translates to the tenant in our commitment to provide impeccable, personable, and efficient property management services. We never want a tenant in a Boyle managed property to leave unless we can no longer accommodate their space needs because the highest expense in property ownership is turn over and vacancy. Our property managers are in the business of building relationships with each and every tenant, which means you won’t just see us when you place a maintenance request. These are the faces that you will see in your building each and every week:</p>
						<div class="staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Property Management Division", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
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
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Human Resources", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
					</div>
						<hr>
					</li>
					<li>
						<h3 data-toggle-title="closed">Marketing Team</h3>
						<div class="toggle-content is-hidden">
							<p>We are not your typical marketing department. We are actually in the business of challenging ourselves and delivering great ideas. That is what it took to navigate this market for more than 75 years. We view everyone within Boyle as our client, and are committed to serving them with new and innovative ideas and approaches to advertising, as well as community and media relations. This doesn’t end at the first sign of a good idea, or at the close of a business day. It is an on-going process that starts with the desire to keep pushing ourselves for results that serve you.</p>
							<div class="staff-container">
						
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Marketing Team", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
							<?php endwhile; wp_reset_postdata(); ?>
							</div>
						</div>
						<hr>
					</li>
					<li>
						<h3 data-toggle-title="closed">Boyle Insurance</h3>
						<div class="toggle-content is-hidden">
							<div class="agent-container staff-container">
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	
								
												<?php
										if( in_array( "Boyle Insurance", get_field('memphis_tags')) )
										{
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

									<?php	}	
									?>
								
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