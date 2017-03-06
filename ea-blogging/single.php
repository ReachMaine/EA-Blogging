<?php  /* template mods:
    13Feb17 zig - copy'd from EA
    22Feb17 zig - put title first, move thumbnail into content. cleanup obit stuff.
 */
?>
<?php get_header();?>
<div id="content" class="prl-container">
    <div class="prl-grid prl-grid-divider">
    	<?php /* if(isset($prl_data['banner_before_single_title']) && $prl_data['banner_before_single_title']!='') echo '<div id="single-top-ad" class="prl-span-12"> <div class="ads_top ad-container">'.stripslashes($prl_data['banner_before_single_title']).'</div></div>'; */ ?>
    	<?php if (is_active_sidebar('topbanner')) {
			dynamic_sidebar( 'topbanner' );
    	} ?>
        <section id="main" class="prl-span-9"> <!-- single -->
		   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		   <article id="post-<?php the_ID(); ?>" <?php post_class('article-single'); ?>>
			   <h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			   <hr class="prl-grid-divider">
				<div class ="single-meta">
			   		<?php
			   			if (get_user_meta( $authordata->ID, 'ts_fab_user_hide', false )) {
				   			post_meta(true/*date*/, false/* author */, false /* comment */, true /*cat*/, false /* view */ ) ;
				   		} else {
				   			post_meta(true, true, false, true, false);
				   		} /* date, author, comments, cat, view, updated? */
				    ?>
			   		<?php ea_social_share();?>
				</div>
			   <hr class="prl-grid-divider">
			   <div class="prl-grid">
					<div class="prl-span-12 prl-span-flip">
						<div class="prl-entry-content clearfix">

                            <?php if ( has_post_thumbnail() ) { /* set meta image for google custom search */
            		   			$gimgatts = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full-size');
            		   			echo '<meta itemprop="image" content="'.$gimgatts[0].'"></meta>';
            		   		} ?>
        					<?php if( has_post_thumbnail() && get_post_meta($post->ID, 'pl_post_thumb', true)!='Disable') { ?>
        						<div class="single-post-thumbnail">
        							<?php
        							/* the_post_thumbnail('ea_featuredimg');  */
        							/* the_post_thumbnail('');  */
        							/* post_thumb(get_the_ID(), 500); */
        							the_post_thumbnail('ea_featuredimg');
        							$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full-size'); // For pinterest sharing
        							?>
        						</div>
                                <?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) {
                                    echo '<div class="single-post-thumbnail-caption space-bot">'.$caption.'</div>';
    							} ?>
        					<?php } /* end if has_post_thumbnail */ ?>


						   <?php/*  if($prl_data['show_excerpt']=='Enable') {?><strong><?php the_excerpt(); ?></strong><?php } */ ?>
						   <?php /* zig 23Aug16 ++ */ the_content(); ?>
                           <?php if (function_exists('ea_blog_nav')) { ea_blog_nav(); } ?>
						   <?php wp_link_pages(array('before' => __('Pages','presslayer').': ', 'next_or_number' => 'number')); ?>
						   <?php edit_post_link(__('Edit','presslayer'),'<p>','</p>'); ?>

						   <?php if(isset($prl_data['banner_after_single_content']) && $prl_data['banner_after_single_content']!='') echo '<div class="hide-mobile"><center class="ad-container ad-in-content">'.stripslashes($prl_data['banner_after_single_content']).'</center></div>';?>

						</div>
					</div>

			   </div>

		   </article>

		   <?php endwhile; endif; ?>

		   <?php if($prl_data['post_author']!='Disable'):?>
		   <div id="article_author" class="prl-article-author clearfix">
		   		<hr class="prl-grid-divider">
		   		<span class="author-avatar"><?php echo get_avatar(get_the_author_meta('email'), '100'); ?></span>
				<div class="author-info">
					<h4><?php _e('About the author', 'presslayer'); ?>:  <?php the_author_posts_link(); ?></h4>
					<p><?php the_author_meta("description"); ?></p>
				</div>
			</div>
			<?php endif;?>
		   <?php comments_template(); ?>

			<?php
			$single_id = $post->ID;
			if(get_post_meta($post->ID, 'pl_related', true)=='default' or get_post_meta($post->ID, 'pl_related', true)==''){
				$related = $prl_data['related_post'];
			}else{
				$related = get_post_meta($post->ID, 'pl_related', true);
			}
			/* zig - comment out related posts stuff
			if($related!='Disable') get_template_part( 'related-post'); */
			?>
			<?php if (is_active_sidebar('biztoday')) { echo '<div class="biz-today horizontal">'; dynamic_sidebar('biztoday'); echo '</div>'; } ?>
        </section>

        <aside id="sidebar" class="prl-span-3">

            <?php get_sidebar('single');?>
        </aside>
    </div>
</div>


<?php get_footer();?>
