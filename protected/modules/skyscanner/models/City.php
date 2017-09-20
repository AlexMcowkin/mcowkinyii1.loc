<?php
class City extends CActiveRecord
{
	public function tableName()
	{
		return 'city';
	}

	public function rules()
	{
		return array(
			array('name, code', 'required'),
			array('name', 'length', 'max'=>30),
			array('code', 'length', 'max'=>5),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getCityList()
	{
		$query = new CDbCriteria;
		$query->select = '`name`, `code`';
		$result = self::model()->findAll($query);

		foreach ($result as $key => $value)
		{
			$return[] = [ 'data'=>$value['code'], 'value'=>$value['name'] ];
		}

		return json_encode($return);
	}
}
