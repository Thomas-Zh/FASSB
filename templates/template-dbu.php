<?php
/**
 * Template Name:"units
  *
 * A custom page template for showing posts on a chosen category.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package Fluida
 */

get_header(); ?>

<div id="container" class="<?php echo fluida_get_layout_class(); ?>">
	<main id="main" role="main" class="main">
	<?php cryout_before_content_hook(); ?>

	 <?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'pad-container' ); ?>style="padding: 0;border-top: 0;">
			<header style="background-image:url('http://142.144.0.11/wp-content/uploads/2019/03/Banner-Head-4.png');">
				<?php cryout_breadcrumbs_hook(); ?>
				<?php $fluida_heading_tag = ( is_front_page() ) ? 'h2' : 'h1';
				 the_title( '<' . $fluida_heading_tag . ' class="entry-title" ' . cryout_schema_microdata( 'entry-title', 0 ) . '>', '</' . $fluida_heading_tag . '>' ); ?>
				<span class="entry-meta" >
					<?php edit_post_link( __( 'Edit', 'fluida' ) . '<em class="screen-reader-text">"' . get_the_title() . '"</em>', '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
				</span>
			</header>
			<div class="entry-content" style="padding:0;">

				<section class="units-top-content">

					<div class="units-description">
						<h5 style ="padding-right: 2em;">Digital Business Unit</h5>
						<p> Senior Manager: Peter O'Keefe</p>
						<div class="hard-separator"></div>

						<div class="units-description-text">
							<h6> Purpose:</h6>
							<p>To analyze and disseminate timely, reliable and accurate EO program and financial data and tools for sound financial management and insight discovery</p>
						</div>
					</div>
					<div class="units-image">
						<img src="http://142.144.0.11/wp-content/uploads/2019/03/DBU.png" style="width:650px;">
					</div>

				</section>

				<section class ="units-bottom-content">

					<h6>Areas of focus</h6>
					<ul style="padding-bottom: 1em; margin: 0;">

						<li>Lead the long-term planning and project management for the division’s I&IT systems</li>
						<li>Co-design digital solutions with our users in partnership with the I&IT cluster</li>
						<li>Provide a holistic view of EO programs and systems that supports the business in making strategic decisions</li>
						<li>Lead the discovery, design and user acceptance testing for all the applications in the EOIS platform</li>
						<li>Lead the support, training and communications for all the applications in the EOIS platform</li>


					</ul>
				</section>

				<div class="units-teams">

					<h5 style ="padding-right: 2em;"> Teams</h5>

					<section class="units-teams-content">

						<div class ="units-BSCM">

							<h6> Business System Change Management</h6> 

							<p>Manager: Kaye Lawrence-Haye</p>

							<div class="hard-separator"></div>

							<p>The Business System Change Management unit provides the leadership and expertise in the digital transformation and service design to ensure business needs and user needs are met through the planning, development and implementation of digital solutions for the employment and training programs and services in Ontario.</p>
							<p>The unit manages internal (including FASSB) and external stakeholder groups, taking a human centered design approach to recommend opportunities to expand and enhance service delivery using emerging technology and new digital solutions.</p>
							<p>BSCM also leads the user acceptance testing process and the implementation of system changes, working closely with the I&IT cluster partners to ensure that there is limited disruption to programs and services to support the roll-out of the system changes.</p>

						</div>

						<div class="units-BSSA">

							<h6> Business Systems Support Alignment</h6>

							<p>Manager: Tricia Dorman</p>

							<div class="hard-separator"></div>

							<p>The Business System and Support Alignment unit  provides support in three areas: Training and Communications, Production issues, and Service desk </p>
							<p>The units leads the development of communication and training products for the suite  of integrated business systems that support the delivery of employment and training programs and services across the province.  
							The unit ensures that issues related to our business systems are prioritized and escalated to the cluster for resolution.  The unit also manages the monthly production patch to resolve system issues.</p>
							<p>BSSA manages the service desk function which processes over 5000 tickets annually and provides support to the entire division (just under 1,000 users) as well as support to over 5,000 external users </p>

						</div>

					</section>

				</div>
		</article>

		<?php
		$cryout_single = true;
		$cryout_slug = basename( esc_url( get_permalink() ) );
		$cryout_meta_slug = get_post_meta( get_the_ID(), "slug", $cryout_single ); // slug custom field
		$cryout_meta_catid = get_post_meta( get_the_ID(), "catid", $cryout_single ); // category_id custom field
		$cryout_key = get_post_meta( get_the_ID(), "key", $cryout_single ); // either slug or category_id custom field
		$cryout_slug = ( $cryout_key ? $cryout_key : ( $cryout_meta_catid ? $cryout_meta_catid : ( $cryout_meta_slug ? $cryout_meta_slug : ( $cryout_slug ? $cryout_slug : 0 ) ) ) ); // select one value out of the custom fields
		?>
	<?php endwhile; ?>

		<?php 
		fluida_pagination();

		wp_reset_query();	

		$wp_query = NULL;
		$wp_query = $cryout_saved_query; 
		?>

	<?php cryout_after_content_hook(); ?>
	</main><!-- #main -->

	<?php fluida_get_sidebar(); ?>
</div><!-- #container -->

<?php get_footer(); ?>