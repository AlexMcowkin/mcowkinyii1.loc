<div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">

	<?php if(Yii::app()->user->hasFlash('error')):?>
		<div class="alert alert-danger">
		    <div class="container-fluid">
			  <div class="alert-icon">
			    <i class="material-icons">error_outline</i>
			  </div>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="material-icons">clear</i></span>
			  </button>
		      <b>Error Alert:</b> <?=Yii::app()->user->getFlash('error');?>
		    </div>
		</div>
	<?php endif;?>

	<div class="card card-signup">
		<?php
		  $form = $this->beginWidget('CActiveForm', array(
		    'id'=>'form-search',
		    'enableAjaxValidation'=>true,
		    'clientOptions'=>array(
		    	'validateOnSubmit'=>true,
		    ),
		 ));
		?>

			<div class="header header-primary text-center">
				<h4>Search...</h4>
			</div>
			<div class="content">
				
				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">flight_takeoff</i>
							</span>
							<?php echo $form->textField($model,'flyfrom', ['class'=>' form-control', 'placeholder'=>'Place of departure...']); ?>
							<?php echo $form->error($model, 'flyfrom', ['style'=>'font-size:11px;color:#f00;']); ?>
							<?php echo $form->hiddenField($model,'flyfromhid'); ?>
						</div>						
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">flight_land</i>
							</span>
							<?php echo $form->textField($model,'flyto', ['class'=>' form-control', 'placeholder'=>'Place of arrival...']); ?>
							<?php echo $form->error($model, 'flyto', ['style'=>'font-size:11px;color:#f00;']); ?>
							<?php echo $form->hiddenField($model,'flytohid'); ?>
						</div>						
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">today</i>
							</span>
							<?php echo $form->textField($model,'flydatedep', ['class'=>' datepickerD form-control', 'placeholder'=>'Departure Date...']); ?>
							<?php echo $form->error($model, 'flydatedep', ['style'=>'font-size:11px;color:#f00;']); ?>
						</div>						
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">today</i>
							</span>
							<?php echo $form->textField($model,'flydatearr', ['class'=>' datepickerA form-control', 'placeholder'=>'Arrival Date...']); ?>
							<?php echo $form->error($model, 'flydatearr', ['style'=>'font-size:11px;color:#f00;']); ?>
						</div>						
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">monetization_on</i>
							</span>
							<?php echo $form->dropDownList($model,'flycurrency', CurrencyModel::getCurrencyArr(), ['empty'=>'Choose currency...', 'class'=>'form-control']); ?>
							<?php echo $form->error($model, 'flycurrency', ['style'=>'font-size:11px;color:#f00;']); ?>
						</div>						
					</div>
				</div>
			</div>

			<div class="footer text-center">
				<?php echo CHtml::submitButton('SEARCH', ['class'=>'btn btn-primary btn-round', 'id'=>'submit-search']);?>
			</div>

		<?php $this->endWidget(); ?>
	</div>
</div>