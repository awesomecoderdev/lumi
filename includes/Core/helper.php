<?php

/**
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           lumi
 *
 *
 * ======================================================================================
 * 		The Core Function of Helpers
 * ======================================================================================                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

use AwesomeCoder\Lumi\Core\Lumi;

/**
 * The loader of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lami')) {
    function lami()
    {
        $instance = new Lumi();
        return $instance;
    }
}


/**
 * The loader of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lami_version')) {
    function lami_version($file, $version)
    {
        if ($file && file_exists(get_template_directory("$file"))) {
            $version = filemtime(get_template_directory("$file"));
        }
        return $version;
    }
}



/**
 * The url builder.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string|null  $path
     * @param  mixed  $parameters
     */
    function url($path = null, $parameters = [])
    {
        $params = http_build_query($parameters);

        if (!is_null($path)) {
            if (defined("LUMI_THEME_URL")) {
                $path = LUMI_THEME_URL . "assets/$path";
            } else {
                $path = "wp-content/themes/lumi/$path";
            }
        } else {
            $path = "wp-content/themes/lumi/";
        }

        if (strpos($path, "?") !== false) {
            $path = "$path&";
        } else {
            $path = $params ? "$path?" : $path;
        }

        return $path . $params;
    }
}


/**
 * The dump and die function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('dd')) {
    /**
     * @return never
     */
    function dd(...$vars): void
    {
        if (!in_array(\PHP_SAPI, ['cli', 'phpdbg'], true) && !headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        foreach ($vars as $v) {
            echo "<pre>";
            print_r($v);
            echo "</pre>";
        }

        exit(1);
    }
}


/**
 * The lumi_resource function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lumi_resource')) {
    function lumi_resource(string $view = null, bool $echo = true, array $atts = [])
    {

        $path = LUMI_THEME_PATH . "app/Backend/partials/$view.php";
        if ($view != null && file_exists($path)) {
            ob_start();
            include_once $path;
            $output = ob_get_contents();
            ob_end_clean();
        } else {
            $output = '<div id="lumiLoadingScreen" class="fixed inset-0 z-[99999999999] h-screen overflow-hidden block bg-white duration-500"></div>';
            // $output .= '<script>const lumiLoadingScreen=document.getElementById("lumiLoadingScreen"),plStyles=document.querySelectorAll("link"),plScripts=document.querySelectorAll("script"),plStyleTags=document.querySelectorAll("style");plStyles.forEach((e=>{const t=e.getAttribute("rel"),l=e.getAttribute("id");"stylesheet"==t&&"wp-plagiarism-backend-css"!=l&&e.remove()})),plStyleTags.forEach((e=>{e.remove()})),plScripts.forEach((e=>{e.getAttribute("src")&&e.remove()})),setTimeout((()=>{lumiLoadingScreen&&(lumiLoadingScreen.classList.add("opacity-0"),lumiLoadingScreen.remove())}),1e3);</script>';
        }

        if ($echo) {
            echo $output;
            die;
        } else {
            return $output;
            die;
        }
    }
}

/**
 * The is_shop function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('is_shop')) {
    function is_shop()
    {
        return is_front_page();
    }
}

/**
 * The is_cart function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('is_cart')) {
    function is_cart()
    {
        return false;
    }
}


/**
 * The wp_is_tablet function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('wp_is_tablet')) {
    function wp_is_tablet()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Check for common tablet User-Agent strings
        $tabletUserAgents = array(
            'iPad',
            'Android',
            'Kindle',
            'SamsungTablet',
            'Nexus 7',
            // Add more tablet user agents as needed
        );

        foreach ($tabletUserAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }
}

/**
 * The lumi_path function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lumi_path')) {
    function lumi_path($path = false)
    {
        $url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : (isset($_SERVER["PHP_SELF"]) ? $_SERVER["PHP_SELF"] : "/");
        $slug = explode("/", $url, 3);
        $slug = isset($slug[0]) && !empty($slug[0]) ? $slug[0] : (isset($slug[1]) && !empty($slug[1]) ? $slug[1] : $url);

        return $path ? ($slug == $path) : $slug;
    }
}


/**
 * The get_lumi_categories function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_lumi_categories')) {
    function get_lumi_categories($args = [])
    {
        $default = array(
            'taxonomy'      => 'product_cat', // Taxonomy for product categories
            'title_li'      => '', // Remove the default title
            'orderby'       => 'count', // Order by the number of products
            'order'         => 'DESC',  // Descending order (most products first)
            // 'child_of'      => 0,
            // 'parent'        => 0,
            'fields'        => 'all',
            'hide_empty'    => false,
            'number'        => 4,
        );

        $args = array_merge($default, $args);

        $categories = new \WP_Term_Query($args);
        // $terms = get_terms($args);
        $terms = $categories->terms;
        // $terms = $categories;

        return $terms;
    }
}


/**
 * The lumi_get_wishlist function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lumi_get_wishlist')) {
    function lumi_get_wishlist($extra = "")
    {
        // $items = [];
        // foreach (range(1, 10) as $key => $item) {
        //     $session_wishlist = isset($_SESSION["lumi_wishlist"]) ? $_SESSION["lumi_wishlist"] : [];
        //     $items[] = $item;
        // }
        // $_SESSION["lumi_wishlist"] = $items;
        // $_SESSION["lumi_wishlist"] = [33, 34, 26];

        $session_wishlist = isset($_SESSION["lumi_wishlist"]) && is_array($_SESSION["lumi_wishlist"]) ? $_SESSION["lumi_wishlist"] : [];

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $wishlist = get_option("lumi_wishlist_$user_id", $session_wishlist);
            $wishlist = is_array($wishlist) ? $wishlist : $session_wishlist;

            $new_wishlist = array_unique(array_values($wishlist));
            update_option("lumi_wishlist_$user_id", $new_wishlist);
        } else {
            $wishlist = is_array($session_wishlist) ? $session_wishlist : [];
            $new_wishlist = array_unique(array_values($session_wishlist));
        }

        return $new_wishlist;
    }
}


/**
 * The get_lumi_categories_image function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('get_lumi_categories_image')) {
    function get_lumi_categories_image($id = false)
    {
        if ($id) {
            $thumbnail_id = get_term_meta($id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);

            if (!empty($image)) {
                return $image;
            }
        }

        return url('img/category/lumi.png');
    }
}


/**
 * The lumi_container function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lumi_container')) {
    function lumi_container($extra = "")
    {
        $default = "relative container prose dark:prose-invert min-h-[calc(60vh-112px)] lg:px-8 sm:px-7 xs:px-5 px-4 xl:overflow-visible overflow-hidden";

        return "$default $extra";
    }
}


/**
 * The lumi_response function.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 *
 */
if (!function_exists('lumi_response')) {
    function lumi_response(array $contents = [], $status = 200, array $headers = [])
    {
        $response = [
            "success" => true,
            "status" => $status,
            "message" => "Successfully Authorized.",
        ];

        $response = array_merge($response, $contents);

        // Set the HTTP response code
        http_response_code($status);

        // Set the response headers
        foreach ($headers as $header) {
            header($header);
        }

        // Encode the content as JSON and send it as the response body
        header('Content-Type: application/json');
        echo json_encode($response);
        wp_die();
    }
}
