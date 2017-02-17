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

		$do_special_header = false;
		if (is_category() || is_single() ){
			if (is_category()  ) {
				$thisCat = get_category(get_query_var('cat'),false);
			}
			if ( is_single() ) {
				echo "<p>single</p>";
				$thiscat = get_post_meta( get_the_id(), '_yoast_wpseo_primary_category', true ); // yoast's primary category
				if (!$thiscat) {
					echo "<p>No primary</p>";
					$cats = get_the_category();
					echo "<pre>"; var_dump($cats); echo "</pre>";
					if (is_array($cats)) {
						$thiscat = $cats[0]->term_id;
					}
				}
			}
			if ($thisCat) {
				echo "<p> thisCat is:".$thisCat."</p>";
				if (function_exists('wp_get_terms_meta'))  {
					$cat_background_image = wp_get_terms_meta($thisCat, 'blog-image' ,true);
					$cat_subtitle = wp_get_terms_meta($thisCat, 'subtitle' ,true);
					$do_special_header = true;
				} else {
					echo "<p>no function</p>";
				}
			}
		}
		if ($do_special_header) {
			echo "<p>yep</p>";
		} else {
			echo "<p>nope.<p>";
		}

	}
