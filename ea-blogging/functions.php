<?php
  require_once(get_stylesheet_directory().'/custom/branding.php');
  require_once(get_stylesheet_directory().'/custom/custom.php');
  add_action('after_setup_theme', 'ea_setup');
  function ea_setup() {
    /* add the topnav menu block */
    register_nav_menu('top_nav', 'Top Nav');

    if ( function_exists('register_sidebar') ){

      /* add top banner ad widget */
     register_sidebar(array(
      'name' => 'Top Banner Ad',
      'id' => 'topbanner',
      'description' => 'Widget for a targetted banner ad.',
      'before_widget' => '<div class="prl-span-12"><div id="%1$s" class=" %2$s ad-container">',
      'after_widget'  => '</div></div>'

      ));

      register_sidebar(array(
        'name' => 'Biz Today Ads',
        'id' => 'biztoday',
        'description' => 'Widget for Business today.',
        'before_widget' => '<div class="prl-span-12"><div id="%1$s" class=" %2$s biztoday-container">',
        'after_widget'  => '</div></div>'

      ));
    }

  } // end of ea_setup()


?>
