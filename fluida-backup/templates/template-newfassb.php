<?php
/**
 * Template Name: New to FASSB
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
                
            <h2 class="newfassb-headers">Welcome to FASSB!</h2>
			<div class="newfassb-container">
                <p>FASSB ensures that new employees are effectively orientated 
                    to their positions and develop the knowledge, skills and 
                    attributes that are necessary to work in a safe and healthy 
                    environment. FASSB continuously updates all policies, procedures 
                    and resources to ensure all organizational information is update-to-date 
                    for new employees. New employees will be provided with an orientation package 
                    to help get them started in their jobs.</p>
			</div>
                
            <h2 class="newfassb-headers">How do I...?</h2>
            <button class="closeall">View All</button>
            <div class="accordion-container">
            <?php $newfassb_posts= new WP_Query(array('post_type'=>'newfassb','posts_per_page'=>-1, 'order' => 'ASC'));?>
            	<?php while ( $newfassb_posts->have_posts() ) : $newfassb_posts->the_post(); ?>
                    <button class="accordion"><?php the_title(); ?></button>
                    <div class="panel">
                    <p><?php the_content(); ?></p>
                    </div>

                    <?php endwhile; ?>

            <h2 class="newfassb-headers">Other links</h2>

                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fluida' ), 'after' => '</div>' ) ); ?>
            </div>
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
