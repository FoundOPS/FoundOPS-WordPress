<?php ?>
<div id="articleWeekday"><?php echo strtoupper(get_post_time('D')); ?></div>
<div id="articleDate"><?php echo strtoupper(get_post_time('M j')); ?></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    	<?php //the_author_image();?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php twentyeleven_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
			if ( '' != $tag_list ) {
				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			} elseif ( '' != $categories_list ) {
				$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			} else {
				$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
			}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' ),
				get_the_author(),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			);
		?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
        
        <!-- tweet button -->
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <center><table><tr><td width="130px" style="padding-left:0px;"><a href="http://twitter.com/share" class="twitter-share-button"
             data-url="<?php the_permalink(); ?>"
             data-text="<?php echo "Check out this @FoundOPS blog post, "; the_title(); echo ", by "; the_author(); echo " at "; ?>"
             data-count="horizontal">Tweet</a></td>
        
        <!-- +1 button -->
        <td><g:plusone size="medium" href="<?php the_permalink(); ?>" width="60"></g:plusone>
        <script type="text/javascript">
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script></td>
        
        <!-- Facebook share button -->
        <td width="110px" style="vertical-align:top;padding-top:10px;"><?php if (function_exists('fbshare_manual')) echo fbshare_manual();?></td>
        
        <!-- Linkedin share button -->
        <td><div style="padding-top:5px;"><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
        <script type="IN/Share" data-url="http://www.linkedin.com/company/2130457" data-counter="right"></script></div>
        </td></tr></table></center>
        
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
