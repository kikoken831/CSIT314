<?php


function check_name($string)
{
	if (preg_match("/^([A-Za-z ])+$/", $string))
	{
		return TRUE;
	}
	return FALSE;
}

function check_password($string)
{
	// Password must be at least 8 characters and at least one upper case, one lower case, one digit
	if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $string))
	{
		return TRUE;
	}
	return FALSE;
}

function check_email($string)
{
	if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $string)){
		return true;
	}
	else{
		return false;
	}
}

function str_encryptaesgcm($plaintext, $password, $encoding = null) {
    if ($plaintext != null && $password != null) {
        $keysalt = openssl_random_pseudo_bytes(16);
        $key = hash_pbkdf2("sha512", $password, $keysalt, 20000, 32, true);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));
        $tag = "";
        $encryptedstring = openssl_encrypt($plaintext, "aes-256-gcm", $key, OPENSSL_RAW_DATA, $iv, $tag, "", 16);
        return $encoding == "hex" ? bin2hex($keysalt.$iv.$encryptedstring.$tag) : ($encoding == "base64" ? base64_encode($keysalt.$iv.$encryptedstring.$tag) : $keysalt.$iv.$encryptedstring.$tag);
    }
}

function str_decryptaesgcm($encryptedstring, $password, $encoding = null) {
    if ($encryptedstring != null && $password != null) {
        $encryptedstring = $encoding == "hex" ? hex2bin($encryptedstring) : ($encoding == "base64" ? base64_decode($encryptedstring) : $encryptedstring);
        $keysalt = substr($encryptedstring, 0, 16);
        $key = hash_pbkdf2("sha512", $password, $keysalt, 20000, 32, true);
        $ivlength = openssl_cipher_iv_length("aes-256-gcm");
        $iv = substr($encryptedstring, 16, $ivlength);
        $tag = substr($encryptedstring, -16);
        return openssl_decrypt(substr($encryptedstring, 16 + $ivlength, -16), "aes-256-gcm", $key, OPENSSL_RAW_DATA, $iv, $tag);
    }
}

function strip_tag($string)
{
	$string = preg_replace ('/<[^>]*>/', ' ',$string);
	$string = str_replace("\r",'',$string);
	$string = str_replace("\n",'',$string);
	$string = str_replace("\t",'',$string);
	$string = trim(preg_replace('/ {2,}/', ' ',$string));
	return $string;
}


?>