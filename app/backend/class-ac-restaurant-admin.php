<?php

/**
 * The admin-specific functionality of the template.
 *
 * @link       https://awesomecoder.org/
 * @since      1.0.0
 *
 * @package    Ac_Restaurant
 * @subpackage Ac_Restaurant/admin
 */

/**
 * The admin-specific functionality of the template.
 *
 * Defines the template name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ac_Restaurant
 * @subpackage Ac_Restaurant/admin
 * @author     Md Ibrahim Kholil <awesomecoder.org@gmail.com>
 *
 *                                                              _           
 *                                                             | |          
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __ 
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |   
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|   
 *
 */
class Ac_Restaurant_Admin
{

	/**
	 * The ID of this template.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $template_name    The ID of this template.
	 */
	private $template_name;

	/**
	 * The version of this template.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this template.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $template_name       The name of this template.
	 * @param      string    $version    The version of this template.
	 */
	public function __construct($template_name, $version)
	{

		$this->template_name = $template_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_Restaurant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_Restaurant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->template_name, AC_RESTAURANT_THEME_URL . 'admin/css/ac-restaurant-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_Restaurant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_Restaurant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->template_name, AC_RESTAURANT_THEME_URL . 'admin/js/ac-restaurant-admin.js', array('jquery'), $this->version, false);

		// Some local vairable to get ajax url
		wp_localize_script($this->template_name, 'ac_restaurant', array(
			"name"		=> "awesomeCoder",
			"author" 	=>	"MD Ibrahim Kholil",
			"url" 		=> get_bloginfo('url'),
			"ajaxurl"	=> admin_url("admin-ajax.php")
		));

		// wp enqueue mediea
		wp_enqueue_media();
	}

	/**
	 * After setup theme Function
	 *
	 * @since    1.0.0
	 */
	public function ac_restaurant_after_setup_theme()
	{
		/**
		 * Register the nav menu for the admin area.
		 *
		 * @since    1.0.0
		 */
		register_nav_menus(array(
			'primary' => __('( Restaurant ) Primary Menu', 'ac-restaurant'),
		));

		/**
		 * Register custom class for nav items.
		 *
		 * @since    1.0.0
		 */
		function add_class_on_nav_menu_list_items($classes, $item, $args)
		{
			if ('primary' === $args->theme_location) {
				$classes[] = "nav__item " . "nav_" . strtolower($item->title);
			}

			if (!in_array('active-link', $classes)) {
				if (!in_array('current-menu-item', $classes)) {
					if (in_array('current_page_item', $classes)) {
						$classes[] = 'active-link ';
					}
				} else {
					$classes[] = 'active-link ';
				}
			}

			return $classes;
		}
		add_filter("nav_menu_css_class", "add_class_on_nav_menu_list_items", 10, 3);

		/**
		 * Register custom class for nav links.
		 *
		 * @since    1.0.0
		 */
		function add_class_on_nav_menu_list_items_link($classes, $item, $args)
		{
			if ('primary' === $args->theme_location) {

				$classes["class"] = "nav__link ";
			}
			return $classes;
		}
		add_filter("nav_menu_link_attributes", "add_class_on_nav_menu_list_items_link", 10, 3);

		/**
		 * ======================================================================================
		 * 		Theme Support Functions
		 * ======================================================================================
		 */

		/**
		 * Register dynamic title.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('title-tag');


		/**
		 * Register dynamic logo.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('custom-logo', array(
			'height'               => 50,
			'width'                => 180,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array('site-title', 'site-description'),
			'unlink-homepage-logo' => true,
		));


		/**
		 * Register the thumbnail theme support for the admin area.
		 *
		 * @since    1.0.0
		 */
		add_theme_support("post-thumbnail");


		/**
		 * Register the background theme support for the admin area.
		 *
		 * @since    1.0.0
		 */
		// add_theme_support("custom-background");


		/**
		 * Register the header theme support for the admin area.
		 *
		 * @since    1.0.0
		 */
		add_theme_support("custom-header");

		/**
		 * Register the sidebar theme support for the admin area.
		 *
		 * @since    1.0.0
		 */
		function awesomecoder_custom_sidebar()
		{
			register_sidebar(array(
				'name'          => 'Restaurant Sidebar',
				'id'            => 'awesomecoder_sidebar',
				'description'   => 'Widgets in this area will be shown on all posts and pages.',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
			));
		}
		add_action('widgets_init', 'awesomecoder_custom_sidebar');

		/**
		 * ======================================================================================
		 * 		Woocommerce Theme Support Functions
		 * ======================================================================================
		 */

		/**
		 * Register the woocommerce theme support for the admin area.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('woocommerce', array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 3,
				'max_rows'        => 5,
				'default_columns' => 4,
				'min_columns'     => 3,
				'max_columns'     => 4,
			),
		));


		/**
		 * Enable single product zoom.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('wc-product-gallery-zoom');


		/**
		 * Enable single product lightbox.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('wc-product-gallery-lightbox');


		/**
		 * Enable single product slider.
		 *
		 * @since    1.0.0
		 */
		add_theme_support('wc-product-gallery-slider');
	}


	/**
	 * Register the Dashboard Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function ac_restaurant_admin_menu()
	{

		/**
		 * This function is provided Dashboard Menu for the admin area.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ac_product_compare_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ac_product_compare_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// add menu on adminbar
		add_menu_page('Restaurant', 'Restaurant', 'manage_options', 'ac_restaurant',  array($this, 'ac_restaurant_activator_callback'), 'dashicons-podio', 50); //dashicons-share-alt

		// add submenu on adminbar
		add_submenu_page('ac_restaurant', 'Dashboard', 'Dashboard', 'manage_options', 'ac_restaurant',   array($this, 'ac_restaurant_dashboard_callback'));
		add_submenu_page('ac_restaurant', 'User Inbox', 'User Inbox', 'manage_options', 'ac_restaurant_inbox_user',   array($this, 'ac_restaurant_inbox_user_callback'));
	}

	/**
	 * Register Admin Menu Activator CallBack Function
	 *
	 * @since    1.0.0
	 */
	public function ac_restaurant_activator_callback()
	{
		// Default function for activate admin menu
	}

	/**
	 * Register Dashboard menu callback function
	 *
	 * @since    1.0.0
	 */
	public function ac_restaurant_dashboard_callback()
	{
		ob_start();
		include_once AC_RESTAURANT_THEME_PATH . 'admin/partials/ac-restaurant-admin-dashboard.php';
		$dashboard = ob_get_contents();
		ob_end_clean();
		echo $dashboard;
	}

	/**
	 * handel admin ajax requests
	 *
	 * @since    1.0.0
	 */
	public function handel_ac_restaurant_admin_ajax_requests()
	{
		$response = $_REQUEST["ac_action"];

		if ($response == "cart_count") {
			global $woocommerce;
			echo $woocommerce->cart->cart_contents_count;
		}
		//end ajax
		wp_die();
	}
}
