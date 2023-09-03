<?php

namespace AwesomeCoder\Lumi;

class Frontend
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
	 * @param      string    $template_name       The name of the template.
	 * @param      string    $version    The version of this template.
	 */
	public function __construct($template_name, $version)
	{

		$this->template_name = $template_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style("$this->template_name-font-awesome", 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css', array(), $this->version, 'all');
		wp_enqueue_style("$this->template_name-box-icon", 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css', array(), $this->version, 'all');

		wp_enqueue_style("$this->template_name-style", LUMI_THEME_URL . 'assets/css/styles.css', array(), $this->version, 'all');
		wp_enqueue_style("$this->template_name-lumi-public", LUMI_THEME_URL . 'assets/frontend/css/lumi-public.css', array(), lami_version("assets/frontend/css/lumi-public.css", $this->version), 'all');
		wp_enqueue_style($this->template_name, LUMI_THEME_URL . 'assets/frontend/css/frontend.css', array(), lami_version("assets/frontend/css/frontend.css", $this->version), 'all');

		wp_enqueue_style($this->template_name . '-style', LUMI_THEME_URL . 'style.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->template_name . "-jquery", LUMI_THEME_URL . 'assets/js/jquery.js', array('jquery', 'wp-embed'), $this->version, true);
		wp_enqueue_script($this->template_name . "-sweetalert", LUMI_THEME_URL . 'assets/js/sweetalert.min.js', array('jquery', 'wp-embed'), $this->version, true);
		wp_enqueue_script($this->template_name . "-validate", LUMI_THEME_URL . 'assets/js/jquery.validate.min.js', array('jquery', 'wp-embed'), $this->version, true);

		wp_enqueue_script($this->template_name . "-scrollreveal", LUMI_THEME_URL . 'assets/js/scrollreveal.js', array('jquery', 'wp-embed'), $this->version, true);
		wp_enqueue_script($this->template_name . "-main", LUMI_THEME_URL . 'assets/js/main.js', array('jquery', 'wp-embed'), $this->version, true);
		wp_enqueue_script($this->template_name, LUMI_THEME_URL . 'public/js/ac-restaurant-public.js', array('jquery'), $this->version, true);

		// Some local vairable to get ajax url
		wp_localize_script($this->template_name, 'lumi', array(
			"author"  	=> [
				"author" 	=>	"Mohammad Ibrahim Kholil",
				"email" 	=>	"awesomecoder.dev@gmail.com",
				"url" 	=>	"https://www.awesomecoder.dev",
			],
			"url" 		=> trailingslashit(get_bloginfo('url')),
			"carturl" 	=> trailingslashit(get_bloginfo('url')) . "?wc-ajax=add_to_cart",
			"ajaxurl"	=> admin_url("admin-ajax.php")
		));
	}


	// handel public ajax requests
	public function handel_lumi_public_ajax_requests()
	{
		$response = $_REQUEST["ac_action"];

		if ($response == "cart_count") {
			global $woocommerce;
			echo $woocommerce->cart->cart_contents_count;
		}
		// print_r($_REQUEST);

		//end ajax
		wp_die();
	}
}
