<?php
/**
 * Plugin Name: Furniture Rental for WooCommerce
 * Description:	Bookings and Rental solution for furniture companies.
 * Version: 1.3.2
 * Author: Alf Fonti
 * WC requires at least: 2.6
 * WC tested up to: 5.0.0
 * Text Domain: furniture-rental-for-woocommerce
*/

class furniture_rental_initialize {

  public function __construct() {

    add_action( 'wp_enqueue_scripts', array( $this, 'furniture_rental_scripts' ) );
    add_filter( 'admin_enqueue_scripts', array( $this, 'furniture_admin_scripts' ) );

    include_once('includes/class-ph-booking-cron-manager.php');
    include_once('includes/class-ph-bookings-appointments-woocommerce.php');
    include_once('includes/class-ph-booking-product-manager.php');
    include_once('includes/class-ph-booking-ajax-manager.php');
    include_once('includes/class-ph-booking-admin.php');

    load_plugin_textdomain( 'furniture-rental-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n/' );
  }

  public function furniture_admin_scripts() {

    wp_enqueue_style( 'wc-common-style', plugins_url( '/resources/css/admin_style.css', __FILE__ ));
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'jquery-ui-css', plugins_url( '/resources/css/jquery-ui.min.css', __FILE__ ) );
    wp_enqueue_script( 'ph_booking_admin_script', plugins_url( '/resources/js/ph-booking-admin.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'ph_booking_calendar_style', plugins_url( '/resources/css/ph_calendar.css', __FILE__ ));

  }

  function furniture_rental_scripts(){

    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'ph_booking_general_script', plugins_url( '/resources/js/ph-booking-genaral.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'ph_booking_product', plugins_url( '/resources/js/ph-booking-ajax.js', __FILE__ ), array('jquery') );

    $localization_arr = array(
      'ajaxurl' 	=> admin_url( 'admin-ajax.php' ),
      'security' 	=> wp_create_nonce( 'phive_change_product_price' )
    );

    wp_localize_script( 'ph_booking_general_script', 'phive_booking_locale', $this->phive_get_string_translation_arr() );
    wp_localize_script( 'ph_booking_product', 'phive_booking_ajax', array_merge( $localization_arr, $this->phive_get_string_translation_arr() ) );
    wp_enqueue_style( 'jquery-ui-css', plugins_url( '/resources/css/jquery-ui.min.css', __FILE__ ) );
    wp_enqueue_style( 'ph_booking_style', plugins_url( '/resources/css/ph_booking.css', __FILE__ ));

    $ph_calendar_color 			= get_option('ph_booking_settings_calendar_color') ;
    $ph_calendar_month_color 	= isset($ph_calendar_color['ph_calendar_month_color'])?$ph_calendar_color['ph_calendar_month_color']:'' ;
    $ph_calendar_design=isset($ph_calendar_color['ph_calendar_design'])?$ph_calendar_color['ph_calendar_design']:'';

    wp_enqueue_style( 'ph_booking_calendar_style', plugins_url( '/resources/css/ph_calendar.css', __FILE__ ));


  }

  private function phive_get_string_translation_arr(){
    return array(
      'months'			=> array(
        __('January', 'furniture-rental-for-woocommerce'),
        __('February', 'furniture-rental-for-woocommerce'),
        __('March', 'furniture-rental-for-woocommerce'),
        __('April', 'furniture-rental-for-woocommerce'),
        __('May', 'furniture-rental-for-woocommerce'),
        __('June', 'furniture-rental-for-woocommerce'),
        __('July', 'furniture-rental-for-woocommerce'),
        __('August', 'furniture-rental-for-woocommerce'),
        __('September', 'furniture-rental-for-woocommerce'),
        __('October', 'furniture-rental-for-woocommerce'),
        __('November', 'furniture-rental-for-woocommerce'),
        __('December', 'furniture-rental-for-woocommerce'),
      ),
      'months_short'			=> array(
        __('Jan', 'furniture-rental-for-woocommerce'),
        __('Feb', 'furniture-rental-for-woocommerce'),
        __('Mar', 'furniture-rental-for-woocommerce'),
        __('Apr', 'furniture-rental-for-woocommerce'),
        __('May', 'furniture-rental-for-woocommerce'),
        __('Jun', 'furniture-rental-for-woocommerce'),
        __('Jul', 'furniture-rental-for-woocommerce'),
        __('Aug', 'furniture-rental-for-woocommerce'),
        __('Sep', 'furniture-rental-for-woocommerce'),
        __('Oct', 'furniture-rental-for-woocommerce'),
        __('Nov', 'furniture-rental-for-woocommerce'),
        __('Dec', 'furniture-rental-for-woocommerce'),
      ),
      'booking_cost' 		=> __('Item cost', 'furniture-rental-for-woocommerce'),
      'booking_date' 		=> __('Booking', 'furniture-rental-for-woocommerce'),
      'is_not_avail' 		=> __('is not available.', 'furniture-rental-for-woocommerce'),
      'are_not_avail' 	=> __('are not available.', 'furniture-rental-for-woocommerce'),
      'pick_later_date'	=> __('Pick a later end date', 'furniture-rental-for-woocommerce'),
      'max_limit_text'	=> __('Max no of blocks available to book is', 'furniture-rental-for-woocommerce'),
      'pick_booking'		=> __('Please pick a booking period', 'furniture-rental-for-woocommerce'),
      'Please_Pick_a_Date'=> __( 'Please Pick a Date', 'furniture-rental-for-woocommerce' ),
      'ajaxurl' 	=> admin_url( 'admin-ajax.php' )
    );
  }

}
new furniture_rental_initialize;
