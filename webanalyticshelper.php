<?php

/* * *****************************************************************************
 * File Name: webanalyticshelper.php
 * Project: WebAnalytics
 * Author: Matt Nutsch
 * Date Created: 4-7-17
 * Description: This code contains a function to help with logging web analytics from PHP
 * Notes: 
 * **************************************************************************** */

//==================================================================== BEGIN PHP

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



//====================================================================== END PHP
?>