<?php
class ErrorsController extends Controller
{
	// set variables for METAdata
	public $pageTitle = '';
	public $metaDescription = '';
    public $metaKeywords = '';
	
	public function actionIndex()
	{
		$this->render('error404');
	}
	
	public function actionPagenotfound()
	{
		$this->render('error404');
	}
}