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


function rpthem_enqueue_style(){
wp_enqueue_style( 'bootstrapcss','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false,null );
}
add_action( 'wp_enqueue_scripts', 'rpthem_enqueue_style' );

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

			<div class="entry-content" style="display: flex; flex-direction: row-reverse;">

				<!-- project content begins -->

				<div class="project-page" style="display:flex; flex-direction: column;">

					<div class="container-fluid">
						<div class="project-table">
							<div class="row project-header">
								<div class="col-md-2 cell cell-one">Project Name</div>
								<div class="col-md-5 cell cell-two">Project Description</div>
								<div class="col-md-2 cell cell-three">Leads</div>
								<div class="col-md-2 cell cell-four">Timeline</div>
								<div class="col-md-1 cell cell-five">Units</div>
							</div>
				<?php
			$projects_posts= new WP_Query(array('post_type'=>'projects','posts_per_page'=>-1));?>
			<?php $sid=0;?>
			<?php while ( $projects_posts->have_posts() ) : $projects_posts->the_post(); ?>
				<?php 
				  $id = get_the_ID();
				  $terms = wp_get_post_terms($id,'application');
				  $arr=array();
				?>
				<?php foreach($terms as $term){ ?>
					<?php $arr[]=$term->name; ?>
				<?php } ?>

					
	                 <section class="project-block <?php echo implode(" ",$arr); ?>" id="project-wrap" count="<?php echo $sid?>">

	                 	<div class="container-fluid">
							<div class="row project-block">
								<div class="col-md-2 cell cell-one" data-title="project-name"><?php the_title(); ?>
							</div>
						
							<div class="col-md-5 cell cell-two" data-title="project-description"><?php the_content(); ?></div>

							<div class="col-md-2 cell cell-three" data-title="project-lead"><?php echo get_post_meta($id, 'leads', true); ?></div>

							<div class="col-md-2 cell cell-four" data-title="project-timeline"><?php echo get_post_meta($id, 'timeline', true); ?></div>
								<?php $sid+=1;?>

								<div class="col-md-1 cell" data-title="project-units">
							
								<?php foreach($terms as $term){ ?>

									<div class="row cell project-unit-tags" data-title="project-units"><?php echo $term->name; ?></div>
									<?php } ?>
						
								</div>


							
			  	    
						</section>
					<?php endwhile; ?>
						</div>
					</div>
				</div> <!-- end of projects-page -->

			
			<!-- sidebar begins-->

				<div class="projects-sidebar">
					<div class="highlight-units">
						<ul id="units-sidebar-list">
							<li><a href="#ALL">ALL</a></li>
							<li><a href="#DBU">DBU</a></li>
							<li><a href="#SPRU">SPRU</a></li>
							<li><a href="#RMAU">RMAU</a></li>
							<li><a href="#AU">AU</a></li>
						</ul>
					</div>
					<div class="highlight-nav">
		 				<?php $sid=0;?>
						<?php while ( $projects_posts->have_posts() ) : $projects_posts->the_post(); ?>
							<?php 
						  $id = get_the_ID();
						  $terms = wp_get_post_terms($id,'application');
						  $arr=array();
						?>
						<?php foreach($terms as $term){ ?>
							<?php $arr[]=$term->name; ?>
						<?php } ?>
							<div class="list-title active <?php echo implode(" ",$arr); ?>" count="<?php echo $sid?>">	
		                        <a href="#project-wrap"><?php the_title() ?></a>
							    <?php $sid+=1;?>
						</div>
						<?php endwhile; ?>
					</div>
				</div> <!-- END OF ENTRY CONTENT -->


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
