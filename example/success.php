<?php

/**
 * Instagram PHP API
 * 
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */

require_once 'instagram.class.php';
require_once __DIR__.'/../../../cron/instagram_config.php';

// initialize class
$instagram = new Instagram(array(
		'apiKey'      => INSTAGRAM_API_KEY,
		'apiSecret'   => INSTAGRAM_API_SECRET,
		'apiCallback' => INSTAGRAM_API_CALLBACK
));

// receive OAuth code parameter
$code = $_GET['code'];

// check whether the user has granted access
if (isset($code)) {

  // receive OAuth token object
  $data = $instagram->getOAuthToken($code);
  $username = $username = $data->user->username;
  // store user access token
  $instagram->setAccessToken($data);

  echo "Username: " . $username . "Access token: " . $data;
  
} else {

  // check whether an error occurred
  if (isset($_GET['error'])) {
    echo 'An error occurred: ' . $_GET['error_description'];
  }

}

?>

