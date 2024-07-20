<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    function encrypt_url($string) {
        $output = false;
        /*
            * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
        */        
        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];
        // hash
        $key    = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv     = substr(hash("sha256", $secret_iv), 0, 16);
        //do the encryption given text/string/number
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }
    function decrypt_url($string) {
        $output = false;
        /*
            * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
        */
        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];
        // hash
        $key    = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        //do the decryption given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
    
    function maskString($text){
		
		$mask_number =  substr_replace($text, '**********', 5, 10);
		
		return $mask_number;
    }	    
    
    if ( ! function_exists('xss_filter'))
	{
		/**
			* - Fungsi untuk memfilter string dari karakter berbahaya.
			*   Contoh : xss_filter("foo bar bass", 'xss')
			* 
			* @param 	string 	$str
			* @param 	string 	$type  xss|sql
			* @return 	string 	
		*/
		function xss_filter($str, $type = '')
		{
			switch($type)
			{
				default:
				$str = stripcslashes(htmlspecialchars($str, ENT_QUOTES));
				return $str;
				break;
				
				case 'sql':
				$x = array('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','&','*','=','?','+');
				$str = str_replace($x, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);				
				$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
				return intval($str);
				break;
				
				case 'xss':
				$x = array ('\\','#',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','*','=','?','+');
				$str = str_replace($x, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);
				return $str;
				break;
				
				case 'folder':
				$x = array ('#',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','*','=','?','+');
				$str = str_replace($x, '\\', $str);
				return $str;
				break;
			}
		}
		
	}