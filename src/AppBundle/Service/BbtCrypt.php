<?php
namespace AppBundle\Service;



class BbtCrypt
{

	 function __construct() {
    }
  // *********************************
    public static function encrypt($cad) {
    	$app = new \stdClass();
        $app->encrypt_method = "aes128";
        $app->secret_key = "d2ae49e3b63ed418b9fc25105cd964d4";
        $app->secret_iv = "fb68e879fab1db2a2ce30dbf6f9b3743";
        $app->key = hash('sha256', $app->secret_key);
        $app->iv = substr(hash('sha256', $app->secret_iv), 0, 16);
        return base64_encode(openssl_encrypt($cad, $app->encrypt_method,  $app->key, 0, $app->iv));
    }
    
    // *********************************
    public static function decrypt( $cad) {
        $app->encrypt_method = "aes128";
        $app->secret_key = "d2ae49e3b63ed418b9fc25105cd964d4";
        $app->secret_iv = "fb68e879fab1db2a2ce30dbf6f9b3743";
        $app->key = hash('sha256', $app->secret_key);
        $app->iv = substr(hash('sha256', $app->secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($cad), $app->encrypt_method,  $app->key, 0, $app->iv);
    }
}