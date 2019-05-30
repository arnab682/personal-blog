<?php

namespace App\Facade;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal
{
    public static function apiContext(){

      // Suppress DateTime warnings, if not set already
      date_default_timezone_set(@date_default_timezone_get());
      // Adding Error Reporting for understanding errors properly
      error_reporting(E_ALL);
      ini_set('display_errors', '1');
      // Replace these values by entering your own ClientId and Secret by visiting https://developer.paypal.com/developer/applications/
      $clientId = 'AaqYOCN4TGpT20ByU9IQKsDvm_JLH76m8ShigRXzKvzwdb1hwMjp4EEfUJVa_apbKqZ0mhhLf78na0FM';
      $clientSecret = 'EGdgh6R-UvUth0WHH9xCX6VhHoc6IB7qaDvWjtOp6KuG6qRpxVwUW8arr_iMAFZ30cku7OrsCAaoyB8d';
      /**
       * All default curl options are stored in the array inside the PayPalHttpConfig class. To make changes to those settings
       * for your specific environments, feel free to add them using the code shown below
       * Uncomment below line to override any default curl options.
       */
      // \PayPal\Core\PayPalHttpConfig::$defaultCurlOptions[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1_2;
      /** @var \Paypal\Rest\ApiContext $apiContext */
      $apiContext = self::getApiContext($clientId, $clientSecret);
      return $apiContext;

      }

      public static function getApiContext($clientId, $clientSecret)
      {

          $apiContext = new ApiContext(
              new OAuthTokenCredential(
                  $clientId,
                  $clientSecret
              )
          );

          $apiContext->setConfig(
              array(
                  'mode' => 'sandbox',
                  'log.LogEnabled' => true,
                  'log.FileName' => '../PayPal.log',
                  'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                  'cache.enabled' => true,
                  //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
                  // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                  // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                  //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
              )
          );
          // Partner Attribution Id
          // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
          // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
          // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');
          return $apiContext;
      }

}
