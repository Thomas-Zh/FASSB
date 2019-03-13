<?php
/**
 * Template Name: AU
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
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'pad-container' ); ?>>
			<header>
				<?php cryout_breadcrumbs_hook(); ?>
				<?php $fluida_heading_tag = ( is_front_page() ) ? 'h2' : 'h1';
				 the_title( '<' . $fluida_heading_tag . ' class="entry-title" ' . cryout_schema_microdata( 'entry-title', 0 ) . '>', '</' . $fluida_heading_tag . '>' ); ?>
				<span class="entry-meta" >
					<?php edit_post_link( __( 'Edit', 'fluida' ) . '<em class="screen-reader-text">"' . get_the_title() . '"</em>', '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
				</span>
			</header>

			<div class="entry-content">

				<section class="units-top-content">

					<div class="units-description">
						<h5> Analytics Unit</h5>
						<p> Senior Manager: Rob Coleman</p>
						<div class="hard-separator"></div>

						<div class="units-description-text">
							<h6> Purpose:</h6>
							<p> To transform data into insights that enable evidenced-based decision-making and to increase data literacy across the division</p>
						</div>
					</div>
					<div class="units-image">
						<img src="http://localhost/wordpress/wp-content/uploads/2019/03/DBU.png">
					</div>

				</section>

				<section class ="units-bottom-content">

					<h6>Areas of focus</h6>
					<ul>
						<li>Create people-centered analytical and decision support tools to deliver key insights and interactive, operational products</li>
						<li>Build analytical capacity by leading knowledge mobilization efforts across the division, acting as a center of excellence by piloting new tools and analytical approaches and by engaging divisional staff in a community of practice</li>
						<li>Collaborate with external partners on shared priorities and improve our ability to respond to emerging and complex service delivery needs</li>
						<li>Lead the open data initiative for the division</li>

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
