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
        if ($file && file_exists(file_exists(get_template_directory("$file")))) {
            $version = filemtime(file_exists(get_template_directory("$file")));
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
            $path = "$path?";
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
