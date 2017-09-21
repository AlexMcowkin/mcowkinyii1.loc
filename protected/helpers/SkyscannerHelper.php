<?php

class SkyscannerHelper
{
    public static function getLocaleFromBrowser()
    {
		$locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
		return $locale; // returns "en_US"
    }

    public static function getClientIpAddr()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        if($ipaddress == '127.0.0.1')
			$ipaddress = '94.176.119.253';
        	
        return $ipaddress;
    }

    public static function getCountryCodeByClientIp()
    {
    	$ip = self::getClientIpAddr();
		$geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
		return $geoplugin["geoplugin_countryCode"]; // MD
    }

    public static function getGoodPrice($price, $symbol, $position)
    {
        // true == left
        return ($position) ? $symbol.' '.$price : $price.' '.$symbol ;
    }
}
