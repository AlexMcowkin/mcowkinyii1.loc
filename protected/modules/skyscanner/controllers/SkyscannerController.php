<?php
class SkyscannerController extends Controller
{
	// set variables for METAdata
	public $pageTitle = '';
	public $metaDescription = '';
    public $metaKeywords = '';

	public function actionIndex()
	{
		$this->pageTitle = 'Search';
		$this->metaDescription = 'Search Search';
		$this->metaKeywords = 'Search Search Search';

		if(isset($_GET['error']))
		{
			$errorMsgs = $_GET['error'];
		}
		else
		{
			$errorMsgs = '';
		}

		$model = new SearchForm();

		if(isset($_POST['ajax']))
		{
		  if($_POST['ajax']=='form-search')
		  {
		    echo CActiveForm::validate($model);
		  }
		  Yii::app()->end();
		}

		if(isset($_POST['SearchForm']))
		{
			$model->attributes = $_POST['SearchForm'];
			if($model->validate())
			{
				$redirectLink = Yii::app()->createUrl("skyscanner/skyscanner/result",[
					'country' 				=> SkyscannerHelper::getCountryCodeByClientIp(),
					'currency' 				=> $model->flycurrency,
					'locale' 				=> SkyscannerHelper::getLocaleFromBrowser(),
					'originPlace' 			=> $model->flyfromhid,
					'destinationPlace' 		=> $model->flytohid,
					'outboundPartialDate' 	=> $model->flydatedep,
					'inboundPartialDate' 	=> $model->flydatearr,
				]);

				$this->redirect($redirectLink);
			}
		}

		$this->render('index', ['model'=>$model, 'errorMsgs'=>$errorMsgs]);
	}

	// https://skyscanner.github.io/slate/#flights-browse-prices
	public function actionResult()
	{
		$this->pageTitle = 'Result';
		$this->metaDescription = 'Result Result';
		$this->metaKeywords = 'Result Result Result';

		$country 				= $_GET['country'];
		$currency 				= $_GET['currency'];
		$locale 				= $_GET['locale'];
		$originPlace 			= $_GET['originPlace'];
		$destinationPlace 		= $_GET['destinationPlace'];
		$outboundPartialDate 	= $_GET['outboundPartialDate'];
		$inboundPartialDate 	= $_GET['inboundPartialDate'];

		$link = "http://partners.api.skyscanner.net/apiservices/browsequotes/v1.0/{$country}/{$currency}/{$locale}/{$originPlace}/{$destinationPlace}/{$outboundPartialDate}/{$inboundPartialDate}?apiKey=".Yii::app()->params['skyscannerApiKey'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

    	$result = json_decode($output);
    	// var_dump($result);
    	// die();

		if(isset($result->ValidationErrors))
		{
			$this->redirect(['/skyscanner/skyscanner/index', 'error' => $result->ValidationErrors[0]->Message]);
		}
		elseif(count($result->Quotes) == 0)
		{
			$this->redirect(['/skyscanner/skyscanner/index', 'error' => 'There are no offers by your request']);
		}
		else
		{

			// $responce = '{"Quotes":[{"QuoteId":1,"MinPrice":2721.0,"Direct":true,"OutboundLeg":{"CarrierIds":[1717],"OriginId":63446,"DestinationId":82495,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-20T20:31:50"},{"QuoteId":2,"MinPrice":2425.0,"Direct":true,"OutboundLeg":{"CarrierIds":[242],"OriginId":63446,"DestinationId":88879,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-20T20:31:50"},{"QuoteId":3,"MinPrice":1954.0,"Direct":true,"OutboundLeg":{"CarrierIds":[1687],"OriginId":63446,"DestinationId":47493,"DepartureDate":"2017-09-24T00:00:00"},"QuoteDateTime":"2017-09-21T06:03:00"}],"Places":[{"PlaceId":47493,"IataCode":"DME","Name":"Москва Домодедово","Type":"Station","SkyscannerCode":"DME","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"},{"PlaceId":63446,"IataCode":"KIV","Name":"Кишинёв","Type":"Station","SkyscannerCode":"KIV","CityName":"Кишинёв","CityId":"KIVA","CountryName":"Молдавия"},{"PlaceId":82495,"IataCode":"SVO","Name":"Москва Шереметьево","Type":"Station","SkyscannerCode":"SVO","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"},{"PlaceId":88879,"IataCode":"VKO","Name":"Москва Внуково","Type":"Station","SkyscannerCode":"VKO","CityName":"Москва","CityId":"MOSC","CountryName":"Россия"}],"Carriers":[{"CarrierId":242,"Name":"Fly One"},{"CarrierId":469,"Name":"Air Moldova"},{"CarrierId":1687,"Name":"S7 Airlines"},{"CarrierId":1717,"Name":"Aeroflot"}],"Currencies":[{"Code":"MDL","Symbol":"lei","ThousandsSeparator":",","DecimalSeparator":".","SymbolOnLeft":false,"SpaceBetweenAmountAndSymbol":true,"RoundingCoefficient":0,"DecimalDigits":2}]}';
		   
		    // $result = json_decode($responce);

			// air carrier
			foreach ($result->Carriers as $carrier)
			{
				$aircarrier[$carrier->CarrierId] = $carrier->Name; // 242 => Fly One
			}

			// airport
			foreach ($result->Places as $place)
			{
				$airport[$place->PlaceId] = $place->Name.', '.$place->CityName.', '.$place->CountryName; // 47493 => Москва Домодедово, Москва, Россия
			}

			// collect main info
			$i=0;
			foreach ($result->Quotes as $quote)
			{
				$dest[$i]['price'] = SkyscannerHelper::getGoodPrice($quote->MinPrice, $result->Currencies[0]->Symbol, $result->Currencies[0]->SymbolOnLeft);
				$dest[$i]['aircarrier'] = $aircarrier[$quote->OutboundLeg->CarrierIds[0]]; // 242
				$dest[$i]['departure_airport'] = $airport[$quote->OutboundLeg->OriginId]; // 63446
				$dest[$i]['arrival_airport'] = $airport[$quote->OutboundLeg->DestinationId]; // 82495
				$dest[$i]['departure_date'] = date('d M, Y (l) H:i', strtotime($quote->OutboundLeg->DepartureDate)); // 2017-09-24T00:00:00
				$dest[$i]['timetofly'] = 'undefined';
				$i++;
			}

			// echo '<pre>';
			// var_dump($dest);

			$this->render('result', ['result'=>$dest]);
		}
	}
	
	public function actionCityjson()
	{
		header('Content-type: application/json; charset=utf-8');
		echo City::getCityList();
		// Yii::app()->end();
	}

}
