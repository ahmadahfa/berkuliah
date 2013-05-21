<?php
/* @var $this StudentController */
/* @var $model Student */

?>

<div class="row-fluid">
	<div class="span12">

	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'<i class="icon icon-user"></i> <strong>PROFIL ' .$model->name . '</strong>',
	)); ?>

	<table class="table table-hover">

		<tr align="center">
			<th rowspan="6" width="200px">
				<?php
				$photo = ($model->photo === null) ? 'user.png' : $model->photo;
				echo CHtml::image(Yii::app()->baseUrl . '/photos/' . $photo, CHtml::encode($model->name), array('width'=>200));
				?>
			</th>
		</tr>

		<tr>
			<td>
				<i class="icon icon-align-justify"></i><?php echo $model->getAttributeLabel('username'); ?>
			</td>
			<td>:</td>
			<td><?php echo CHtml::encode($model->username); ?></td>
		</tr>

		<tr>
			<td>
				<i class="icon icon-user"></i><?php echo $model->getAttributeLabel('name'); ?>
			</td>
			<td>:</td>
			<td><?php echo CHtml::encode($model->name); ?></td>
		</tr>

		<tr>
			<td>
				<i class="icon icon-book"></i><?php echo $model->getAttributeLabel('faculty_id'); ?>
			</td>
			<td>:</td>
			<td><?php echo CHtml::encode($model->faculty->name); ?></td>
		</tr>

		<tr>
			<td>
				<i class="icon icon-pencil"></i><?php echo $model->getAttributeLabel('bio'); ?>
			</td>
			<td>:</td>
			<td><?php echo CHtml::encode($model->bio); ?></td>
		</tr>

		<tr>
			<td>
				<i class="icon icon-time"></i><?php echo $model->getAttributeLabel('last_login_timestamp'); ?>
			</td>
			<td>:</td>
			<td><?php echo Yii::app()->format->datetime($model->last_login_timestamp); ?></td>
		</tr>

	</table>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- span12 -->
</div><!-- row-fluid -->
