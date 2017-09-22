<?php
class CurrencyModel extends CActiveRecord
{
	public function tableName()
	{
		return 'currency';
	}

	public function rules()
	{
		return array(
			array('code', 'required'),
			array('code', 'length', 'max'=>5),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getCurrencyArr()
	{
		$query = self::model()->findAll(['select'=>'code']);
		return CHtml::listData($query, 'code', 'code');
	}
}
