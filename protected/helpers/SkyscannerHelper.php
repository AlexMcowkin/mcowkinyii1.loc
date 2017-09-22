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
        elseif(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        elseif(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        elseif(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        elseif(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        elseif(getenv('REMOTE_ADDR'))
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

    public static function skyscannerGetBrowsequotes(
        $country,
        $currency,
        $locale,
        $originPlace,
        $destinationPlace,
        $outboundPartialDate,
        $inboundPartialDate
    )
    {
        $link = "http://partners.api.skyscanner.net/apiservices/browsequotes/v1.0/{$country}/{$currency}/{$locale}/{$originPlace}/{$destinationPlace}/{$outboundPartialDate}/{$inboundPartialDate}?apiKey=".Yii::app()->params['skyscannerApiKey'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        
        // $output = '{"Quotes":[{"QuoteId":1,"MinPrice":2721.0,"Direct":true,"OutboundLeg":{"CarrierIds":[1717],"OriginId":63446,"DestinationId":82495,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-20T20:31:50"},{"QuoteId":2,"MinPrice":2425.0,"Direct":true,"OutboundLeg":{"CarrierIds":[242],"OriginId":63446,"DestinationId":88879,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-20T20:31:50"},{"QuoteId":3,"MinPrice":1954.0,"Direct":true,"OutboundLeg":{"CarrierIds":[1687],"OriginId":63446,"DestinationId":47493,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-21T06:03:00"}],"Places":[{"PlaceId":47493,"IataCode":"DME","Name":"Москва Домодедово","Type":"Station","SkyscannerCode":"DME","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"},{"PlaceId":63446,"IataCode":"KIV","Name":"Кишинёв","Type":"Station","SkyscannerCode":"KIV","CityName":"Кишинёв","CityId":"KIVA","CountryName":"Молдавия"},{"PlaceId":82495,"IataCode":"SVO","Name":"Москва Шереметьево","Type":"Station","SkyscannerCode":"SVO","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"},{"PlaceId":88879,"IataCode":"VKO","Name":"Москва Внуково","Type":"Station","SkyscannerCode":"VKO","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"}],"Carriers":[{"CarrierId":242,"Name":"Fly One"},{"CarrierId":469,"Name":"Air Moldova"},{"CarrierId":1687,"Name":"S7 Airlines"},{"CarrierId":1717,"Name":"Aeroflot"}],"Currencies":[{"Code":"MDL","Symbol":"lei","ThousandsSeparator":",","DecimalSeparator":".","SymbolOnLeft":false,"SpaceBetweenAmountAndSymbol":true,"RoundingCoefficient":0,"DecimalDigits":2}]}';

        return json_decode($output);
    }

    public static function browsequotesOutput($responce)
    {
        // air carrier
        foreach($responce->Carriers as $carrier)
        {
            $aircarrier[$carrier->CarrierId] = $carrier->Name; // 242 => Fly One
        }

        // airport
        foreach($responce->Places as $place)
        {
            $airport[$place->PlaceId] = $place->Name.', '.$place->CityName.', '.$place->CountryName; // 47493 => Москва Домодедово, Москва, Россия
        }

        // collect main info
        $i=1;
        foreach($responce->Quotes as $quote)
        {
            $dest[$i]['price']  = self::getGoodPrice(
                                    $quote->MinPrice,
                                    $responce->Currencies[0]->Symbol,
                                    $responce->Currencies[0]->SymbolOnLeft
                                );
            
            $dest[$i]['aircarrier']     = $aircarrier[$quote->OutboundLeg->CarrierIds[0]];
            $dest[$i]['aircarrier_id']  = $quote->OutboundLeg->CarrierIds[0]; // 242

            $dest[$i]['departure_airport']      = $airport[$quote->OutboundLeg->OriginId];
            $dest[$i]['departure_airport_id']   = $quote->OutboundLeg->OriginId; // 63446

            $dest[$i]['arrival_airport']    = $airport[$quote->OutboundLeg->DestinationId];
            $dest[$i]['arrival_airport_id'] = $quote->OutboundLeg->DestinationId; // 82495

            $dest[$i]['departure_date'] = strtotime($quote->OutboundLeg->DepartureDate); // 2017-09-24T00:00:00

            $dest[$i]['timetofly']  = 'undefined';
            
            $i++;
        }

        return $dest;
    }
}
