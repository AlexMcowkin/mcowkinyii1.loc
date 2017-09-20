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
				$locale = SkyscannerHelper::getLocaleFromBrowser();
				$country = SkyscannerHelper::getCountryCodeByClientIp();

				$result = $this->actionGetdata($country, $model->flycurrency, $locale, $model->flyfromhid, $model->flytohid, $model->flydatedep, $model->flydatearr);

				if(isset($result->ValidationErrors))
				{
					throw new CException($result->ValidationErrors[0]->Message);
				}
				else{
					echo '<pre>';
					var_dump($result);
				}
			}
		}

		$this->render('index', ['model'=>$model]);
	}

	// https://skyscanner.github.io/slate/#flights-browse-prices
	protected function actionGetdata($country, $currency, $locale, $originPlace, $destinationPlace, $outboundPartialDate, $inboundPartialDate)
	{
        $link = "http://partners.api.skyscanner.net/apiservices/browsequotes/v1.0/{$country}/{$currency}/{$locale}/{$originPlace}/{$destinationPlace}/{$outboundPartialDate}/{$inboundPartialDate}?apiKey=".Yii::app()->params['skyscannerApiKey'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

    	return json_decode($output);    
	}

	public function actionCityjson()
	{
		header('Content-type: application/json; charset=utf-8');
		echo City::getCityList();
		Yii::app()->end();
	}
}