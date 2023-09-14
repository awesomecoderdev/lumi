<?php


/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           lumi
 *
 */

use Google\Service\Oauth2;
use AwesomeCoder\Lumi\Hooks\Authorization;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<?php get_header(); ?>


<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">
    <a href="<?php echo (new Authorization())->getOauthLoginUrl() ?>"> <?php _e('Google', 'lumi'); ?></a>
    <?php


    $client = new Google\Client();
    $client->setAccessToken($_SESSION['upload_token']);

    // Create a Google_Service_Oauth2 instance to access user info
    $oauth2Service = new Google\Service\Oauth2($client);
    $userInfo = $oauth2Service->userinfo->get();
    $userEmail = $userInfo->getEmail();
    $userName = $userInfo->getName();
    $userPicture = $userInfo->getPicture();

    echo "<pre>";
    print_r($userInfo);
    echo "</pre>";

    // Display user data
    echo "Welcome back, $userName!";
    echo "<img src='$userPicture' alt='$userName'>";

    ?>
</main>


<?php get_footer(); ?>