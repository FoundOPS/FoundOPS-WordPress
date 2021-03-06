<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<html <?php if(is_page(63)){ ?> style="background-image: url('wp-content/themes/twentyeleven/images/homeBg.png');"<?php } ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes" />
<meta name="google-site-verification" content="gMZQUTO8tOdyGEtehqnkS-fgjy5eMu5UHLKPL_cjn48" />
<meta name="keywords" content="Field Service GPS Tracking Dispatch Operations Software Mobile Application 
Route Vehicles FoundOPS	Cloud Solution Efficiency SaaS Lean Customer Management Technology Integration" />
<link rel="shortcut icon" href="/wp-includes/images/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet/less" type="text/css" href="/wp-content/themes/twentyeleven/BlogStyle.less" />
<?php if(is_page(69)){ ?><!-- About Us -->
<link rel="stylesheet/less" type="text/css" href="/wp-content/themes/twentyeleven/aboutstyle.less" />
<title>Field Service Management Software From The Cloud - About Us</title>
<meta name="description" content="Discover the FoundOPS Team, Advisors, and Core Values" />
<?php }else if(is_page(63)) { ?><!-- Home -->
<link rel="stylesheet/less" type="text/css" href="/wp-content/themes/twentyeleven/style.less" />
<title>Field Service Management Software From The Cloud</title>
<meta name="description" content="Manage your Field Service Company with GPS Technician Tracking, Drag & Drop Dispatching, and Intuitive Customer Management in one easy-to-use system." />
<?php }else if(is_page(66)) { ?><!-- Features -->
<link rel="stylesheet/less" type="text/css" href="/wp-content/themes/twentyeleven/style.less" />
<title>Field Service Management Software From The Cloud - Features</title>
<meta name="description" content="We offer features such as GPS Tracking, QuickBooks Integration, and Automatic Service Generation, just to name a few" />
<?php }else if(is_page(462)) { ?><!-- Customers -->
<link rel="stylesheet/less" type="text/css" href="/wp-content/themes/twentyeleven/style.less" />
<title>Field Service Management Software From The Cloud - Customers</title>
<meta name="description" content="We customize Operations Software for many different Field Service Industries" />
<?php } else { ?>
<title>Field Service Management Software From The Cloud - Blog</title>
<meta name="description" content="Follow the FoundOPS Blog to learn more about Lean Customer Management, Operations Software, and Cloud-Based Software Solutions" />
<?php } ?>
<link rel="apple-touch-icon" href="/wp-content/themes/twentyeleven/images/TouchIcon.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="/wp-content/themes/twentyeleven/js/less-1.3.0.min.js" type="text/javascript"></script>
<script src="http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js" type="text/javascript"></script>
<script type="text/javascript">
// Get twitter feed
function twitter(){
	getTwitters('tweet',{
                        id: 'FoundOPS',
                        count: 3,
                        enableLinks: true,
                        ignoreReplies: true,
                        clearContents: true,
                        template: '"%text%" <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/">%time%</a>'
                    });
}</script>
<script type="text/javascript">
// Google Analytics
(function (){
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

try {
var pageTracker = _gat._getTracker("UA-25857232-1");
pageTracker._initData();
pageTracker._trackPageview();
function trackEvent(category, action, label, value){
	pageTracker._trackEvent(category, action, label, value);
}
} catch(err) {}
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

<body <?php body_class(); ?>>
<div id="container">
	<div id="backgroundTop"></div>
    <div id="backgroundBottom"></div>
    <div id="page" class="hfeed">
    	<div id="top">
            <div id="SiteLogo"><a href="<?php echo $GLOBALS["blogLink"];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
            <div id="mainLoginContent">
				<form action="<?php echo $GLOBALS["foundopsLink"];?>/Account/Login" method="post">
                	<div id="email">
                        <label for="EmailAddress">Email Address</label><br />
                        <input id="EmailAddress" name="EmailAddress" type="text" value="" />
                    </div>
                    <div id="pass">
                        <label for="Password">Password</label><br />
                        <input id="Password" name="Password" type="password" />
                    </div>
                    <input id="loginBtn" type="submit" value="Login" />
				</form>
            </div>
            <div id="nav">
                <ul>
                    <li class="hoverGreen" id="home"><a href="<?php echo $GLOBALS["blogLink"]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li class="hoverRed" id="featuresNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/features" >&nbsp;Features&nbsp;</a></li>
                    <li class="hoverBlue" id="customersNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/customers">Customers</a></li>
                    <li class="hoverGreen" id="aboutUsNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/aboutUs">&nbsp;About Us&nbsp;</a></li>
                    <li class="hoverRed" id="blogNav"><a href="<?php echo $GLOBALS["blogLink"]; ?>/blog">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blog&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                    <li></li><li></li><li></li><li style="width:124px;"></li>
                    <li class="hoverOrange" id="freeTrialNav"><a href="http://www.formstack.com/forms/foundops-free_trial" 
                    	onclick="_gaq.push(['_trackEvent', 'Beta Form Signup', 'Page Viewed']);">Free Trial</a></li>
                </ul>
            </div>
        </div>
        <?php if(is_home() || is_single() || is_author() || is_archive()){ ?>
        <div id="blogTitleBlock">
        </div>
		<?php } global $more; $more = 0;?>
        
	<div id="main">
