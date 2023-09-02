<?php

/**
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           lumi
 *
 * Theme Name:        Lumi
 * Theme URI:         https://awesomecoder.dev/
 * Description:       Lumi is fast, fully customizable & beautiful WordPress theme suitable for business website and WooCommerce storefront.
 * Version:           1.0.0
 * Author:            Md Ibrahim Kholil
 * Author URI:        https://www.fiverr.com/mkholilulla
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Lumi
 * Domain Path:       /languages
 * Tags: custom-menu, custom-logo, entertainment, one-column, two-columns, left-sidebar, e-commerce, right-sidebar, custom-colors, editor-style, featured-images, full-width-template, microformats, post-formats, rtl-language-support, theme-options, threaded-comments, translation-ready, blog
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently template version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your template and update it as you release new versions.
 */
define('LUMI_VERSION', '1.0.0');
define('LUMI_THEME_URL', trailingslashit(esc_url(get_template_directory_uri())));
define('LUMI_THEME_PATH', trailingslashit(get_template_directory()));
