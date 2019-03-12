<?php
/**
 * Template Name: DBU
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

				<section class="dbu-top-content">

					<div class="dbu-description">
						<h5> Digital Business Unit</h5>
						<p> Senior Manager: Peter O'Keefe</p>
						<div class="hard-separator"></div>

						<div class="dbu-description-text">
							<h6> Purpose:</h6>
							<p> To lead digital transformation across the division and ensure that the solution we create support are always people-centred</p>
						</div>
					</div>
					<div class="dbu-image">
						<img src="http://localhost/wordpress/wp-content/uploads/2019/03/DBU.png">
					</div>

				</section>

				<section class ="dbu-bottom-content">

					<h6>Areas of focus</h6>
					<ul>
						<li>Lead the long-term planning and project management for the division’s I&IT systems</li>
						<li>Co-design digital solutions with our users in partnership with the I&IT cluster</li>
						<li>Provide a holistic view of EO programs and systems that supports the business in making strategic decisions </li>
						<li>Lead the discovery, design and user acceptance testing for all the applications in the EOIS platform</li>
						<li>Lead the support, training and communications for all the applications in the EOIS platform</li>

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
