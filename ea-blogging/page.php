<?php /*
	mods:
    13Feb16 zig - copy from EA
    14Feb16 zig - remove header add (moved to header)
*/
?>
<?php get_header();?>
<div id="content" class="prl-container">
    <div class="prl-grid prl-grid-divider">
            <section id="main" class="prl-span-9">
		   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		   <article id="post-<?php the_ID(); ?>" <?php post_class('article-single clearfix'); ?>>
			   <?php if ( has_post_thumbnail() && (get_post_meta($post->ID, 'pl_post_thumb', true)!='disable') ):?>
				<div class="space-bot">
				  <?php the_post_thumbnail(''); ?>
				</div>
				<?php endif; ?>
				<?php if(get_post_meta($post->ID, 'pl_page_title', true)!='disable'){?>
				<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1><?php } ?>

			  <div class="prl-entry-content clearfix">
			  <?php the_content(); ?>
			   <?php wp_link_pages(array('before' => __('Pages','presslayer').': ', 'next_or_number' => 'number')); ?>
			   <?php edit_post_link(__('Edit','presslayer'),'<p>','</p>'); ?>
			   </div>
		   </article>
		   <?php endwhile; endif; ?>
			<?php if(isset($prl_data['banner_after_single_content']) && $prl_data['banner_after_single_content']!='') echo '<div class="hide-mobile"><center class="ad-container ad-in-content">'.stripslashes($prl_data['banner_after_single_content']).'</center></div>';?>
			<?php if (is_active_sidebar('biztoday')) { echo '<div class="biz-today horizontal">'; dynamic_sidebar('biztoday'); echo '</div>'; } ?>
        </section>

        <aside id="sidebar" class="prl-span-3">
            <?php get_sidebar('custom');?>
        </aside>
    </div>
</div>
<?php get_footer();?>
