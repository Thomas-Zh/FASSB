<?php
/**
 * Template Name: Who are we
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

			<div class="entry-content">
				<h2 class="who-we-are-headers">Our mandate</h2>
<section class="mandate-banner-content">
<div class="mandate-banner-caption">
Lead Employment Ontario’s digital transformation by developing people-centered solutions to deliver services and oversight and maximize investments on behalf of all Ontarians</div>
<div class="mandate-banner-image"><img style="vertical-align: bottom;" src="http://142.144.0.11/wp-content/uploads/2019/03/business-people-no-bckgrnd.png" sizes="(max-width: 800px) 100vw, 612px" alt="" width="800" height="auto"></div>
</section>
<section class="core-functions-banner">
<h2 style="color: #fff; text-align: center;">Core functions</h2>
<p style="text-align: center; color: #fff;">We aim to achieve our mandate by providing:</p>

<div class="who-we-are-icon">
<figure><img title="" src="http://142.144.0.11/wp-content/uploads/2019/03/WWA-icon-1.png" alt="">
<p></p>
<p>Financial and program reporting, planning, and analysis</p></figure>
<figure><img title="" src="http://142.144.0.11/wp-content/uploads/2019/03/WWA-icon-2.png" alt="">
<p></p>
<p>Financial management and accountability</p></figure>
<figure><img title="" src="http://142.144.0.11/wp-content/uploads/2019/03/WWA-icon-3.png" alt="">
<p></p>
<p>Digital transformation and service design</p></figure>
<figure><img title="" src="http://142.144.0.11/wp-content/uploads/2019/03/WWA-icon-4.png" alt="">
<p></p>
<p>Information management and business analytics<p></figure>
<figure><img title="" src="http://142.144.0.11/wp-content/uploads/2019/03/WWA-icon-5.png" alt="">
<p></p>
<p>Business systems management and support</p></figure>
</div>
</section>
<section class="text-area-2">
<div><img class="top-half-lightbulb" src="http://142.144.0.11/wp-content/uploads/2019/03/logo-top-half.png"></div>
<div class="text-area-2-caption">
<h2 class="who-we-are-headers">About us</h2>
<p>The Finance, Analysis and Systems Support Branch (FASSB) is a key branch which supports the delivery of Employment Ontario (EO) programs and services in the Employment and Training Division (ETD) of the Ministry of Training, Colleges and Universities (MTCU). FASSB ensures that systems, financial management processes, and accountability tools and methodologies are up-to-date, integrated, and relevant for program and service delivery. FASSB works to provide program data and analysis support for digitally-driven and evidence-based decision making to meet the EO vision. For more information about the Employment and Training Division, please visit <u><a href="https://intra.ontario.ca/tcu-etd#!">InsideOps</a></u></p>

</div>
</section>
<section class="text-area-3">
<div><img class="bottom-half-lightbulb" src="http://142.144.0.11/wp-content/uploads/2019/03/logo-bottom-half.png"></div>
<div class="text-area-3-caption">
<h2 class="who-we-are-headers">Who we serve</h2>
<p>FASSB works in partnerships across the branch, division and ministry with key internal and external stakeholders in support of a service design and user-centric methodology for information sharing, process and practice establishment, and solution design and implementation. Key partnership activities for FASSB include leading ETD responses to corporate reporting and management exercises, working in partnership with a third-party network of system users for program delivery, building a community of controllership practice, and collaborating with the I&amp;IT cluster for ETD systems planning needs.
</p>
</div>
</section>

				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fluida' ), 'after' => '</div>' ) ); ?>
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