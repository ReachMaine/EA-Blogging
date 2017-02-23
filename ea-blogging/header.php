<?php /*
	Mods:
		13Feb16 zig - copy from EA for blogging spoke of multisite
		14Feb16 zig - move top banner to above masthead
*/
global $theme_url, $prl_data; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home('', 'https') || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'PressLayer' ), max( $paged, $page ) );
	?></title>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php if($prl_data['site_fav']!='') {?>
	<link rel="shortcut icon" href="<?php echo trim($prl_data['site_fav']);?>">
	<?php } ?>
<link href="https://fonts.googleapis.com/css?family=Buenard:400,700" rel="stylesheet">
<script data-cfasync="false" type="text/javascript" src="//cdn.broadstreetads.com/init.js"></script>
<?php
	if (!is_singular('post') ) { 	?>
		<script data-cfasync="false" type="text/javascript" >var ta_cat = "not_post"; </script>
	<?php }  ?>
   <script data-cfasync="false" type="text/javascript" src="http://ellsworthamerican.me.pw.newsmemory.com/include.php?service=onstop"></script>
	<script data-cfasync="false" type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<?php wp_head();?>
	<?php if ( is_home() || is_front_page() )  { ?>
    	<meta http-equiv='Cache-Control' content='no-cache'>
    <?php }  ?>
	<?php /* zig 17Mar15 trying to add meta name=thumbnail to post */
		if (is_single() ) {
			global $post;
			$image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			echo '<!-- is single -->';
			if ($image_thumbnail) {
				echo '<meta name="thumbnail" content="'.$image_thumbnail[0].'">';
			} else {
				echo '<meta name="thumbnail" content="http://www.ellsworthamerican.com/wp-content/themes/origmag-ea/images/ogi-ea.jpg">';
				echo '<meta property="og:image" content="http://www.ellsworthamerican.com/wp-content/themes/origmag-ea/images/ogi-ea.jpg">';
			}
		}
	?>

</head>
<?php
$body_class = array('Boxed'=>'site-boxed', 'Wide'=>'site-wide');
?>
<body <?php body_class($body_class[$prl_data['site_style']]); ?>>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<?php /* 29Aug16 zig - put technavia script here....*/ ?>
<?php /* <script data-cfasync="false" type="text/javascript" src="http://ellsworthamerican.me.pw.newsmemory.com/include.php"></script> */ ?>
<div class="site-wrapper">
    <!--<div class="prl-container">-->

		<header id="masthead" class="clearfix">
			<div class="prl-container">
				<?php  /* move banner ad to top */
				 	if (isset($prl_data['banner_top_cat']) && $prl_data['banner_top_cat']!='') echo '<div id="archive-top-ad" class=prl-span-12> <div class="ads_top ad-container">'.stripslashes($prl_data['banner_top_cat']).'</div></div>';  ?>
				<?php /* search box moved to top  hidden at tablet size*/ ?>
				<?php if($prl_data['header_search_btn']!='Disable'):?>
				<div class="prl-nav-flip-top hidden-tablet">
					<?php /*  <div class="right"><a href="#" id="search_btn" class="prl-nav-toggle prl-nav-toggle-search search_zoom" title="Search"></a></div> */ ?>

					<div id="search_form-top" class="nav_search">
						<form class="prl-search" action="<?php echo home_url('', 'https');?>">
							<input type="text" id="s" name="s" value="" placeholder="&#xF002;" class="nav_search_input" />
							<?php /* <input type="text" id="s" name="s" value="" placeholder="<?php _e('Search ...','presslayer');?>" class="nav_search_input" /> */ ?>
						</form>
					</div>

				</div>
				<?php endif;?>
				<?php /* add top nav menu  - added by zig */ ?>
				<nav id="topnav" class="hidden-tablet">
					<div class="nav-wrapper clearfix">
					<?php if ( has_nav_menu( 'top_nav' ) ) :
						wp_nav_menu( array (
							'theme_location' => 'top_nav',
							'container' => false,
							'menu_class' => 'sf-menu eai-menu',
							'menu_id' => 'top-menu',
							'depth' => 2,
							'fallback_cb' => false) );
					endif; ?>
					</div>
				</nav>

			</div> <?php /* end pr1-container for top menu & search */ ?>
			<nav id="nav" class="prl-navbar" role="navigation">
				<div class="prl-container">
					<div class="nav-wrapper clearfix centered-menu">
					<?php
					// Main Menu
					if ( has_nav_menu( 'main_nav' ) ) :

						$args = array (
							'theme_location' => 'main_nav',
							'container' => false,
							'container_class' => 'prl-navbar',
							'menu_class' => 'sf-menu',
							'menu_id' => 'sf-menu',
							'depth' => 4,
							'fallback_cb' => false

						 );
						if($prl_data['megamenu']!='Disable'):
							$mega = array ('walker' => new TMMenu());
							$args = array_merge($mega, $args);
						endif;
						wp_nav_menu($args);
					 else:
						echo '<div class="message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site main menu', 'presslayer' ) . '</div>';
					 endif;

					?>

					<div class="nav_menu_control"><a href="#" data-prl-offcanvas="{target:'#offcanvas'}"><span class="prl-nav-toggle prl-nav-menu"></span><span class="nav_menu_control_text"><?php _e('','presslayer');?></span></a>
					</div>
					<?php if($prl_data['header_search_btn']!='Disable'):?>
					<div class="prl-nav-flip show-tablet">
						<?php /*  <div class="right"><a href="#" id="search_btn" class="prl-nav-toggle prl-nav-toggle-search search_zoom" title="Search"></a></div> */ ?>

						<div id="search_form" class="nav_search show-tablet">
							<form class="prl-search" action="<?php echo home_url('', 'https');?>">
								<input type="text" id="s" name="s" value="" placeholder="&#xF002;" class="nav_search_input" />
								<?php /* <input type="text" id="s" name="s" value="" placeholder="<?php _e('Search ...','presslayer');?>" class="nav_search_input" /> */ ?>
							</form>
						</div>

					</div>
					<?php endif;?>

					</div>
				</div>
			</nav>
			<div class="masthead-bg clearfix">
				<?php  $customheader = ea_header_logo(); /* display appropiate header */ ?>
			</div>
			<div class="prl-container top-header">
				<div class="prl-header-left">
					<?php  if($prl_data['header_custom_text']!=''){?>
						<span class="prl-header-custom-text"><?php echo trim($prl_data['header_custom_text']);?></span>
					<?php  } ?>

				</div>
				<div class="prl-header-mid">
				</div>
				<?php if ($customheader) { ?>
				<div class="prl-header-right">
						<a href="//www.ellsworthamerican.com/"><img class="ea-powered" src="<?php bloginfo('url')?>/wp-content/themes/ea-blogging/images/powered-by-EA.png"></a>
				</div><?php } ?>
			</div>
		</header>


		<script>
			var $ = jQuery.noConflict();
			$(document).ready(function() {
				var example = $('#sf-menu').superfish({
					delay:       100,
					animation:   {opacity:'show',height:'show'},
					dropShadows: false,
					autoArrows:  false
				});
			});

		</script>

    <!--</div>-->
	<?php $offstr = get_template_directory().'/offcanvas.php'; require_once ($offstr);?>
