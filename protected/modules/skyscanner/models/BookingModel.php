<?php
class BookingModel extends CActiveRecord
{
	public function tableName()
	{
		return 'booking';
	}

	public function rules()
	{
		return array(
			array('departure_date, departure_airport, arrival_airport, aviacompany, price', 'required'),
			array('departure_date, departure_airport, arrival_airport, aviacompany', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>20),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'departure_date' => 'Departure Date',
			'departure_airport' => 'Departure Airport',
			'arrival_airport' => 'Arrival Airport',
			'aviacompany' => 'Aviacompany',
			'price' => 'Price',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function sendEmail($departure_date, $departure_airport, $arrival_airport, $aviacompany, $price)
	{
		$subject = 'McOwkin: New Order #'.time('now');

		$message = '
			<div>
				<p><strong>Departure date:</strong> '.date('d M, Y (l) H:i', $departure_date).'</p>
				<p><strong>Departure airport:</strong> '.$departure_airport.'</p>
				<p><strong>Arrival airport:</strong> '.$arrival_airport.'</p>
				<p><strong>Avia carrier:</strong> '.$aviacompany.'</p>
				<p><strong>Price:</strong> '.$price.'</p>
			</div>
		';
        $mail = Yii::app()->Smtpmail;
        $mail->SetFrom(Yii::app()->params['emailFrom'], Yii::app()->params['emailFromName']);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        // $mail->AddAddress(Yii::app()->params['emailFrom']);
        $mail->AddAddress(Yii::app()->params['emailTo']);
        if(!$mail->Send())
        {
            Yii::log("Confirm order EMAIL error",'mailerror','system.*');
            return false;
        }
        $mail->ClearAddresses();

		return true;
	}
}
