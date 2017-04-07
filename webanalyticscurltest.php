<?php

/* * *****************************************************************************
 * File Name: webanalyticscurltest.php
 * Project: WebAnalytics
 * Author: Matt Nutsch
 * Date Created: 4-7-17
 * Description: This code sends analytics data using PHP.
 * Notes: 
 * **************************************************************************** */

//==================================================================== BEGIN PHP

//DEV NOTE: for debug purposes
$debugging = 0; //set this to 1 to see debugging output

$t=time(); //variable used for obtaining the current time

//display information if we are in debugging mode
if($debugging == 1)
{
  echo "The current Linux user is: ";
  echo exec('whoami');
  echo "<br/>";
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  echo "<strong>Debugging Enabled</strong><br/>";  
  echo "Start time: ";
  echo(date("Y-m-d H:i:s",$t));
  echo "<br/>";
}

function post_to_url($url, $data) 
{
  $fields = '';
  foreach ($data as $key => $value) {
    $fields .= $key . '=' . $value . '&';
  }
  $fields = rtrim($fields, '&');
  
  $post = curl_init();
  
  curl_setopt($post, CURLOPT_URL, $url);
  curl_setopt($post, CURLOPT_POST, count($data));
  curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($post, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($post, CURLOPT_VERBOSE, true);

  //set port, may be unnecessary
  curl_setopt($post, CURLOPT_PORT, 443);
  
  // Blindly accept the certificate
  curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
  
  //set user agent, may be unnecessary
  curl_setopt($post, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); // set browser/user agent    
  
  //ignore an error in the SSL configuration on the development server
  curl_setopt($post, CURLOPT_SSL_VERIFYHOST, 0);
  
  //code needed to verify an SSL certificate with the Certificate Authority
  //curl_setopt($post, CURLOPT_SSL_VERIFYPEER, true);
  //curl_setopt($post, CURLOPT_SSL_VERIFYHOST, 2);
  //curl_setopt($post, CURLOPT_CAINFO, getcwd() . "/CAcerts/BuiltinObjectToken-EquifaxSecureCA.crt"); //Dev Note: change this to the address of the CA

  $result = curl_exec($post);
  
  if (FALSE === $result)
        throw new Exception(curl_error($post), curl_errno($post));
  
  curl_close($post);
  return $result;
}

$jsonStr = '{"UserID":23,"UserDepartment":"Production"}';

//custom action
$data = array(
  "token_id" => "987654321",
  "event_type" => "custom_action",
  "action_name" => "PHP Web Analytics Action Test",
  "action_values" => $jsonStr
);

//page load
$data = array(
  "token_id" => "987654321",
  "event_type" => "page_load",
  "page_url" => "PHP Web Analytics Page Load Test",
  "page_values" => $jsonStr
);

$surl = 'https://ws-test.vistasand.com/sites/sandbox/Includes/analyticswebservice.php';

try 
{
  echo post_to_url($surl, $data);
}
catch (Exception $e) 
{
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}


//====================================================================== END PHP
?>