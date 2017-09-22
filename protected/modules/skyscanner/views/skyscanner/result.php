<div class="col-md-12 col-sm-12">
	<div class="card card-signup">

			<div class="header header-primary text-center">
				<h4>Results...</h4>
			</div>

			<div class="content">
				<table class="table">
				    <thead>
				        <tr>
				            <th class="text-center">#</th>
				            <th>Departure Airport</th>
				            <th>Departure Date</th>
				            <th>Arrival Airport</th>
				            <th>Air Carier</th>
				            <th>Time</th>
				            <th class="text-center">Price</th>
				            <th class="text-center">Order</th>
				        </tr>
				    </thead>
				    <tbody>
					<?php foreach ($result as $key => $value):?>
				        <tr>
				            <td class="text-center"><?=$key;?></td>
				            <td><p><?=$value['departure_airport'];?></p></td>
				            <td><p><?=date('d M, Y (l) H:i', $value['departure_date']);?></p></td>
				            <td><p><?=$value['arrival_airport'];?></p></td>
				            <td><p class="text-info"><?=$value['aircarrier'];?></p></td>
				            <td><p class="text-default"><small><em>(<?=$value['timetofly'];?>)</em></small></p></td>
				            <td class="text-center text-danger"><p><strong><?=$value['price'];?></strong></p></td>
				            <td class="text-center">
								<form action="submit" method="post" id="order-form-<?=$key;?>">
									<input type="hidden" name="departure_date" value="<?=$value['departure_date'];?>" />
									<input type="hidden" name="price" value="<?=$value['price'];?>" />
									<input type="hidden" name="aircarrier_id" value="<?=$value['aircarrier_id'];?>" />
									<input type="hidden" name="departure_airport_id" value="<?=$value['departure_airport_id'];?>" />
									<input type="hidden" name="arrival_airport_id" value="<?=$value['arrival_airport_id'];?>" />
									<?php echo CHtml::submitButton('order now', ['class'=>'btn btn-info btn-xs', 'id'=>'submit-'.$key]);?>
								</form>
				            </td>
				        </tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="footer text-center">
				<!-- <a class="btn btn-primary btn-round" id="submit-more">load more...</a> -->
			</div>

	</div>
</div>
