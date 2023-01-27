<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class phive_booking_admin{
	public function __construct() {

    add_filter('register_post_type_args', array($this, 'remove_default_post_type'), 0, 2);

    add_action('init',array($this, 'unregister_post_type'));

    add_action( 'wp_dashboard_setup', array($this, 'remove_draft_widget'), 999 );

		add_action( 'admin_menu', array($this,'remove_links_from_sidebar_admin_bar') );
    add_action( 'admin_bar_menu', array($this, 'remove_links_from_top_admin_bar'), 999 );
	}

  public function remove_default_post_type($args, $postType) {
    if ($postType === 'post') {
        $args['public']                = false;
        $args['show_ui']               = false;
        $args['show_in_menu']          = false;
        $args['show_in_admin_bar']     = false;
        $args['show_in_nav_menus']     = false;
        $args['can_export']            = false;
        $args['has_archive']           = false;
        $args['exclude_from_search']   = true;
        $args['publicly_queryable']    = false;
        $args['show_in_rest']          = false;
    }
    return $args;
  }

  public function unregister_post_type(){
    unregister_post_type( 'project' );
	}

  public function remove_links_from_sidebar_admin_bar() {
    remove_menu_page( 'edit-comments.php' );
  }

  public function remove_links_from_top_admin_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu('comments');
  }

  public function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

}
new phive_booking_admin();
