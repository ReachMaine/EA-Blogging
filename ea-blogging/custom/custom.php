<?php

/* replacing social_share in original theme /inc/custom_functions.php */
function ea_social_share(){
global $theme_url, $image;
?>

<ul class="prl-list prl-list-sharing">
	<li><a href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" target="_blank" title="facebook"><i class="fa fa-facebook-square"></i> </a></li>
	<li><a href="http://twitter.com/home?status=<?php the_title_attribute();?> - <?php the_permalink();?>" target="_blank" title="twitter"><i class="fa fa-twitter-square"></i> </a></li>
	<li><a href="https://plus.google.com/share?url=<?php the_permalink();?>" onClick="javascript:window.open(this.href,&#39;&#39;, &#39;menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=620&#39;);return false;" title="Google+"><i class="fa fa-google-plus-square"></i></a></li>
	<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo $image[0];?>" class="pin-it-button" count-layout="horizontal" onClick="javascript:window.open(this.href,&#39;&#39;, &#39;menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=620&#39;);return false;" title="Pinterest"><i class="fa fa-pinterest-square"></i></a></li>
	<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title_attribute();?>" target="_blank"><i class="fa fa-linkedin-square" title="LinkedIn"></i></a></li>
	<li><a href="mailto:?subject=<?php the_title_attribute();?>&body=<?php the_permalink();?>" target="_blank" title="E-mail"><i class="fa fa-envelope"></i></a></li>
	<li><a href="#" onclick="window.print();" id="print-page" title="Print" ><i class="fa fa-print"></i></a></li>
</ul>

<?php
}
// next & previous navigation on single posts //
if (!function_exists('ea_blog_nav')) {
	function ea_blog_nav() {

		$prevPost = get_previous_post(true);
		$nextPost = get_next_post(true);
		echo "<!-- <p>next is: ".$nextPost->ID."</p> -->";
		echo "<!-- <p>prev is: ".$prevPost->ID."</p> -->";
		if ($prevPost || $nextPost) {
			echo '<hr class="prl-grid-divider">';
			echo '<div id="ea-blog-nav" class="navigation">';
			if ($prevPost) {
				echo'<div class="nav-box previous">' ;
					$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );
				echo previous_post_link('%link',$prevthumbnail.'<h6>%title</h6><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>', TRUE /* in category */);
				echo '</div>';

		 	}

			if ($nextPost) {
				echo '<div class="nav-box next" >';
					$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100) );
				echo next_post_link('%link',$nextthumbnail.'<h6>%title</h6><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>', TRUE /* in category */);
				echo '</div>';
 			}
			echo '</div><!--#cooler-nav div -->';
		} else { echo '<!-- nothing next or previous -->'; }
		return $html_out;
	}  // end function ea_blog_nav()
}

	function ea_header_logo() {
		$thisCatID = 0;
		$do_special_header = false;
		if (is_category() || is_single() ){
			if (is_category()  ) {
				$thisCat = get_category(get_query_var('cat'),false);
				$thisCatID = $thisCat->term_id;
				$thisCatTitle = $thisCat->name;
			}// end is_cat.

			if ( is_single() ) {
				$thisCatID = get_post_meta( get_the_id(), '_yoast_wpseo_primary_category', true ); // yoast's primary category
				if (!$thisCatID) {
					$cats = get_the_category();
					if ($cats) {
						$thisCatID = $cats[0]->term_id;
						$thisCatTitle = $cats[0]->name;
					}
				} else {
					$thisCatTitle = get_cat_name($thisCatID);
				}
			} // end is_single

			if ($thisCatID) {
				if (function_exists('wp_get_terms_meta'))  {
					$cat_background_image = wp_get_terms_meta($thisCatID, 'blog-image' ,true);
					$cat_subtitle = wp_get_terms_meta($thisCatID, 'subtitle' ,true);
					$do_special_header = true;
				}
			}
		}
		// ok what do we do???
		if ($do_special_header) {
			echo '<div class="prl-header-logo header-logo-custom" style="background-image:url('.$cat_background_image.')">';
			echo '<div class="header-logo-wrap">';
				echo '<a href="'.get_home_url().'" title="'.get_bloginfo('name').'"><h1 class="ea-blog-title">'.$thisCatTitle.'</h1></a>';
				//echo '<a href="'.get_home_url().'" title="'.get_bloginfo('name').'"><img src="'.$cat_background_image.'" alt="'.get_bloginfo('name').'" /></a>';
				if ($cat_subtitle) {
					echo '<div class="ea-blog-subtitle">';
					echo '<h3>'.$cat_subtitle.'</h3>';
					echo '</div>';
				}
				echo '</div>'; // header-logo-wrap
			echo '</div>';
		} else {
			echo '<div class="prl-header-logo">';
				echo '<a href="'.get_home_url().'" title="'.get_bloginfo('name').'"><img src="'.sitelogo().'" alt="'.get_bloginfo('name').'" /></a>';
			echo '</div>';
		}
		return $do_special_header;
	} // end of ea_header_logo
