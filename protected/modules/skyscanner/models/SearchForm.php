<?php
class SearchForm extends CFormModel
{
	public $flyfrom;
	public $flyto;
	public $flyfromhid;
	public $flytohid;
	public $flydatedep;
	public $flydatearr;
	public $flycurrency;

	public function rules()
	{
		return array(
			array('flyfrom, flyto, flydatedep, flycurrency', 'required'),
			array(
			  'flyto',
			  'compare',
			  'compareAttribute'=>'flyfrom',
			  'operator'=>'!=', 
			  'allowEmpty'=>false , 
			  'message'=>'"Departure City" must not be equal "Arrival City"'
			),
			array('flyfromhid, flytohid, flydatearr', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
			'flyfrom' => 'Fly From',
			'flyto' => 'Fly To',
			'flydatedep' => 'Departure Date',
			'flydatearr' => 'Arrival Date',
			'flycurrency' => 'Currency',
		);
	}
}