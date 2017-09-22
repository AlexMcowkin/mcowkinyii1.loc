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

		$country 				=  Yii::app()->input->xssClean($_GET['country']);
		$currency 				=  Yii::app()->input->xssClean($_GET['currency']);
		$locale 				=  Yii::app()->input->xssClean($_GET['locale']);
		$originPlace 			=  Yii::app()->input->xssClean($_GET['originPlace']);
		$destinationPlace 		=  Yii::app()->input->xssClean($_GET['destinationPlace']);
		$outboundPartialDate 	=  Yii::app()->input->xssClean($_GET['outboundPartialDate']);
		$inboundPartialDate 	=  Yii::app()->input->xssClean($_GET['inboundPartialDate']);

		$responce = SkyscannerHelper::skyscannerGetBrowsequotes($country, $currency, $locale, $originPlace, $destinationPlace, $outboundPartialDate, $inboundPartialDate);

		if(isset($responce->ValidationErrors))
		{
			Yii::log("Problems with API",'mailerror','system.*');
			$this->redirect(Yii::app()->homeUrl, ['error' => $responce->ValidationErrors[0]->Message]);
		}
		elseif(count($responce->Quotes) == 0)
		{
			$this->redirect(Yii::app()->homeUrl, ['error' => 'There are no offers on your request']);
		}
		else
		{
			$result = SkyscannerHelper::browsequotesOutput($responce);

			$this->render('result', ['result'=>$result]);
		}
	}

	public function actionSubmit()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = new BookingModel();
			
			// save to DB
			$model->departure_date 		= Yii::app()->input->xssClean(Yii::app()->request->getPost('departure_date'));
			$model->departure_airport 	= Yii::app()->input->xssClean(Yii::app()->request->getPost('departure_airport_id'));
			$model->arrival_airport 	= Yii::app()->input->xssClean(Yii::app()->request->getPost('arrival_airport_id'));
			$model->aviacompany 		= Yii::app()->input->xssClean(Yii::app()->request->getPost('aircarrier_id'));
			$model->price 				= Yii::app()->input->xssClean(Yii::app()->request->getPost('price'));
			$model->save();

			// send Msg
			$result = $model->sendEmail(
				$model->departure_date,
				$model->departure_airport,
				$model->arrival_airport,
				$model->aviacompany,
				$model->price
			);

			if($result)
			{
				$this->render('thankyou');
			}
			else
			{
				$this->redirect(Yii::app()->homeUrl, ['error' => 'Something went wrong. Please try latter!!!']);
			}
		}
		else
		{
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	
	public function actionCityjson()
	{
		header('Content-type: application/json; charset=utf-8');
		echo CityModel::getCityList();
	}
}
