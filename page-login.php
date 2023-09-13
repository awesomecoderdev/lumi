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

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.

}

?>

<?php get_header(); ?>


<main id="main" class="<?php echo lumi_container("py-10 not-prose"); ?>">

    <?php
    /************************************************
     * The redirect URI is to the current page, e.g:
     * http://localhost:8080/simple-file-upload.php
     ************************************************/
    $redirect_uri = site_url("/login");
    $oauth_credentials = LUMI_THEME_PATH . "/assets/client_secret_200589975125-e24lmvjsme0sprt2dl83tkr5tjecb579.apps.googleusercontent.com.json";
    $client = new Google\Client();
    $client->setAuthConfig($oauth_credentials);
    $client->setRedirectUri($redirect_uri);

    // $client->setClientId($client_id);
    // $client->setClientSecret($client_secret);
    // $client->setRedirectUri($redirect_uri);
    $client->addScope("email");
    $client->addScope("profile");

    // add "?logout" to the URL to remove a token from the session
    if (isset($_REQUEST['logout'])) {
        unset($_SESSION['upload_token']);
    }

    /************************************************
     * If we have a code back from the OAuth 2.0 flow,
     * we need to exchange that with the
     * Google\Client::fetchAccessTokenWithAuthCode()
     * function. We store the resultant access token
     * bundle in the session, and redirect to ourself.
     ************************************************/
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code'], $_SESSION['code_verifier']);
        $client->setAccessToken($token);

        // store in the session also
        $_SESSION['upload_token'] = $token;

        // redirect back to the example
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }

    // set the access token as part of the client
    if (!empty($_SESSION['upload_token'])) {
        $client->setAccessToken($_SESSION['upload_token']);
        if ($client->isAccessTokenExpired()) {
            unset($_SESSION['upload_token']);
        }
    } else {
        $_SESSION['code_verifier'] = $client->getOAuth2Service()->generateCodeVerifier();
        $authUrl = $client->createAuthUrl();
    }

    ?>

    <div class="box">
        <?php if (isset($authUrl)) : ?>
            <div class="request">
                <a class='login' href='<?= $authUrl ?>'>Connect Me!</a>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
            <div class="shortened">
                <p>Your call was successful! Check your drive for the following files:</p>
                <ul>
                    <li><a href="https://drive.google.com/open?id=<?= $result->id ?>" target="_blank"><?= $result->name ?></a></li>
                    <li><a href="https://drive.google.com/open?id=<?= $result2->id ?>" target="_blank"><?= $result2->name ?></a></li>
                </ul>
            </div>
        <?php else : ?>
            <form method="POST">
                <input type="submit" value="Click here to upload two small (1MB) test files" />
            </form>
        <?php endif ?>
    </div>

    <a href="#"> <?php _e('Google', 'lumi'); ?></a>
</main>


<?php get_footer(); ?>