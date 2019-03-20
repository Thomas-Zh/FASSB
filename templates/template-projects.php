<?php
/**
 * Template Name: What
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

			<div class="entry-content" style="display: flex; flex-direction: row; padding:0;">
				<div class="project-page">
				<?php
			$projects_posts= new WP_Query(array('post_type'=>'projects','posts_per_page'=>-1));?>
			<?php $sid=0;?>
			<?php while ( $projects_posts->have_posts() ) : $projects_posts->the_post(); ?>
					<section id="project-wrap-<?php echo $sid?>">
						<?php $sid+=1;?>
				<div class="project-title">
					<?php the_title(); ?> 
				</div>
				<div class="project-content">
					<?php the_content(); ?>
				</div>
			</section>
			<?php endwhile; ?>
			</div>
			<div class="highlight-nav">
				<?php $sid=0;?>
				<?php while ( $projects_posts->have_posts() ) : $projects_posts->the_post(); ?>
					<div class="list-title active" id="<?php echo $sid?>">	
					<a href="#project-wrap-<?php echo $sid?>"><?php the_title(); ?></a>
					<?php $sid+=1;?>
				</div>
				<?php endwhile; ?>
				<button>Return the vertical position of the scrollbar</button>
			</div>
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