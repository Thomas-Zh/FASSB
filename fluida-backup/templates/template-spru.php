<?php
/**
 * Template Name: SPRU
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
						<h5> Systems Planning and Resource Unit</h5>
						<p> Senior Manager: Robert Macvicar</p>
						<div class="hard-separator"></div>

						<div class="units-description-text">
							<h6> Purpose:</h6>
							<p> To analyze and disseminate timely, reliable and accurate EO program and financial data and tools for sound financial management and insight discovery</p>
						</div>
					</div>
					<div class="units-image">
						<img src="http://142.144.0.11/wp-content/uploads/2019/03/spru.png" style="width:478px;">
					</div>

				</section>

				<section class ="units-bottom-content">

					<h6>Areas of focus:</h6>
					<ul style="padding-bottom: 1em; margin: 0;">
						<li>Plan, coordinate and manage an EO system-wide operating and capital budget and provide financial forecasting and planning expertise</li>
						<li>Develop financial management analysis tools to identify spending patterns and trends in the EO system</li>
						<li>Manage the distribution of financial and program data to consumers across the ministry and division</li>
						<li>Provide analysis and strategic and expert advice on divisional program data for planning and monitoring of past and present business performance</li>
						<li>Improve the processes, tools, and technology used to manage and report on program data</li>
										

					</ul>
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