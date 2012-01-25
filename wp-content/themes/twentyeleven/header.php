<?php ?><!DOCTYPE html>
<!--Copyright FoundOPS 2012. All rights reserved.
FoundOPS and Cloud Dispatched are trademarks of FoundOPS LLC.-->
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 6]>
        <style>#container {height: 100%;}</style>
    <![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="wp-includes/images/favicon.ico" />
<title></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<title>FoundOPS - Field Service Management</title>
<meta name="description" content="Manage your field service company with GPS technician tracking, drag & drop dispatching, 
    and intuitive customer management in one easy-to-use system." />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes" />
<meta name="google-site-verification" content="gMZQUTO8tOdyGEtehqnkS-fgjy5eMu5UHLKPL_cjn48" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/BlogStyle.css" />
<?php if(is_home() || is_single() || is_author() || is_archive()){ ?>
<meta name="keywords" content="FoundOPS, dis-patch, SaaS, service management, field service management, service dispatching, technician dispatch" />
<?php }else{ ?>
<meta name="keywords" content="Field Service GPS Tracking Dispatch Operations Software Mobile Application Route Vehicles FoundOPS
	Cloud Solution Efficiency SaaS Lean Customer Management Technology Integration" />
<?php if(is_page(624)){ ?>
	<script type="text/javascript" src="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/js/jquery.easing.1.3.min.js" defer></script>
    <script type="text/javascript" src="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/js/jquery.wt-rotator.js" defer></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/home.css" />
    <script type="text/javascript" src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function () {
            $(".container").wtRotator({
                width: 1000,
                height: 450,
                cpanel_align: "BC",
                mouseover_pause: true,
                transition: "h.slide"
            });
        });
        $(function () {
            $("#SubmitBtn").click(function () {
                var checkedA = $("#group_1").attr("checked");
                var checkedB = $("#group_2").attr("checked");
                if (checkedA) {
                    window.trackEvent("Form Signup", "Signed Up", "Subscribe to FoundOPS", 1);
                } else if (checkedB) {
                    window.trackEvent("Form Signup", "Signed Up", "Beta Program", 1);
                } else { }
            });
        });
    </script>
<?php } ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/style.css" />
<?php if(is_page(21)){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $GLOBALS["blogLink"]; ?>/wp-content/themes/twentyeleven/aboutstyle.css" />
<?php }} ?>
<link rel="apple-touch-icon" href="<?php echo $GLOBALS["foundopsLink"]; ?>/Content/TouchIcon.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- <script type="text/javascript">
	$(document).ready(function(){
		var frame = document.getElementById("myFrame");
		if(frame.src == "")
		{
			hide();
		}
		if(!(frame.onload)){
			document.getElementById("myFrame").style.visibility = "hidden";
		}
		frame.error= function () {
			document.getElementById("myFrame").style.visibility = "hidden";
		}
	});
	function hide(){
		document.getElementById("myFrame").style.visibility = "hidden";
	}
</script> -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25857232-1']);
  _gaq.push(['_setDomainName', 'foundops.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<?php flush(); ?>
<body <?php body_class(); ?>>
<div id="container">
    <div id="page" class="hfeed">
    	<div id="top">
            <div id="SiteLogo"><a href="<?php echo $GLOBALS["foundopsLink"];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
            <iframe id="myFrame" src="<?php echo $GLOBALS["foundopsLink"];?>/Account/BlogLogin" width="500px" height="70" frameborder="2" scrolling="no"></iframe>
            <div id="nav">
                <ul>
                    <li class="hoverGreen" id="home"><a href="<?php echo $GLOBALS["blogLink"]; ?>/home">&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li class="hoverRed" id="featuresNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/features" >&nbsp;Features&nbsp;</a></li>
                    <li class="hoverBlue" id="customersNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/customers">Customers</a></li>
                    <li class="hoverGreen" id="pricingNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/pricing">&nbsp;&nbsp;&nbsp;Pricing&nbsp;&nbsp;&nbsp;</a></li>
                    <li class="hoverRed" id="aboutUsNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/aboutUs">&nbsp;About Us&nbsp;</a></li>
                    <li class="hoverBlue" id="blogNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blog&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li></li><li></li><li style="width:121px;"></li>
                    <li class="hoverOrange" id="freeTrialNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/pricing">Free Trial</a></li>
                </ul>
            </div>
        </div>
        <?php if(is_home() || is_single() || is_author() || is_archive()){ ?>
        <div id="blogTitleBlock">
        </div>
		<?php } global $more; $more = 0;?>
        <div id="main">