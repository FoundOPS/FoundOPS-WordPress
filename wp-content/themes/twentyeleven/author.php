<?php
/* The template for displaying Author Archive pages.
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0 */
 
//Generate a random number too be used to pick a color for the title
$randNum = rand(1,3);
$color = "";
if($randNum == 1){
	$color = "#D9591E";
}else if($randNum == 2){
	$color = "#991A36";
}else{
	$color = "#659A41";
}

get_header(); 
	the_post();
	// If a user has filled out their description, show a bio on their entries.
	if ( get_the_author_meta( 'description' ) ) : ?>
	<div id="author-info">
		<div id="author-avatar">
			<?php echo the_author_image(); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h2 style="color:<?php echo $color;?>;"><?php echo get_the_author(); echo " "; echo get_the_author_meta( 'last_name' ); ?></h2>
			<h3><?php echo get_the_author_meta( 'title' ); ?></h3>
			<?php 
			$desc = apply_filters("the_excerpt",get_the_author_meta('description'));
			echo $desc; ?>
		</div><!-- #author-description -->
	</div><!-- #entry-author-info -->
	<?php endif; ?>

	<section id="primary">
		<div id="content" role="main">
			<header class="page-header">
				<h4 class="page-title author"><?php printf( __( 'Recent Posts' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h4>
			</header>

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>
			<script type="text/javascript">
				var title = document.getElementById("blogTitleBlock");
				title.style.visibility = "hidden";
			</script>

			<?php /* Start the Loop */ 
			while ( have_posts() ) : the_post(); 
				/* Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
			endwhile; 

			twentyeleven_content_nav( 'nav-below' ); ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>