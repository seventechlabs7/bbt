<?php
namespace AppBundle\Service;



class CustomCrypt
{

	  public function __construct($key)
	{
	    $this->key = $key;
	}
   public function encrypt($valueToencrypt)
   {
   		return $encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $valueToencrypt, MCRYPT_MODE_CBC, md5(md5($this->key))));
   }
	
	public function decrypt($valueTodecrypt)
	{	
		return $decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($valueTodecrypt), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
		  
	}
}