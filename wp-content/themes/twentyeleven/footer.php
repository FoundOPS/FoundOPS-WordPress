<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="clearfooter"></div>
</div><!-- #container -->
<?php wp_footer(); ?>
<div id="footer">
    <table id="footerList">
    	<tr>
            <td style="color:#ccc; top:4px; padding-right: 5px">Connect&nbsp;&nbsp;&nbsp;</td>
            <td id="facebook"><a href="https://www.facebook.com/pages/FoundOPS/202962066405323">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
            <td id="linkedin"><a href="http://www.linkedin.com/company/foundops">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
            <td id="twitter"><a href="http://twitter.com/#!/FoundOPS">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
        </tr>
    </table>
    <br />
    <div>
    	<table id="bottomTable" class="tabs">
            <tr>
            	<td style="vertical-align:middle;"><div id="navLogo"><a style="line-height:50px;font-size:50px;" href="<?php echo $GLOBALS["blogLink"];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div></td>
                <td style="vertical-align:top;">
                	<table id="col1">
                    	<tr><td class="bigFooterText"><a href="<?php echo $GLOBALS["blogLink"];?>/features" style="font-size:13px;">Features</a></td></tr>
                        <tr><td class="bigFooterText"><a href="<?php echo $GLOBALS["blogLink"];?>/customers" style="font-size:13px;">Customers</a></td></tr>
                        <tr><td class="bigFooterText"><a style="font-size:13px;" href="<?php echo $GLOBALS["blogLink"];?>/blog">Blog</a></td></tr>
                    </table>
                </td>
                <td style="vertical-align:top;">
                	<table id="col2">
                    	<tr><td class="bigFooterText"><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs" style="font-size:13px;">About Us</a></td></tr>
                        <tr><td><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs">The Team</a></td></tr>
                        <tr><td><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs?id=advisors">Advisors</a></td></tr>
                        <tr><td><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs?id=values">Our Values</a></td></tr>
                        <tr><td><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs?id=jobs">Jobs</a></td></tr>
                        <tr><td><a href="<?php echo $GLOBALS["blogLink"];?>/aboutUs?id=contactUs">Contact Us</a></td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div style="font-size:12px;">&copy;2012&nbsp;FOUNDOPS&nbsp;LLC</div><br/>
    <div id="site-generator">
		<?php do_action( 'twentyeleven_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a>
	</div>
</div>
</body>
</html>