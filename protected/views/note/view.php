<?php
/* @var $this NoteController */
/* @var $model Note */
/* @var $dataProvider CActiveDataProvider */
/* @var $review Review */

$this->breadcrumbs=array(
	'Daftar Berkas' => array('home/index'),
	$model->title,
);

?>

<div class="page-header"></div>

<div class="row-fluid">
	<div class="span9">

		<?php $this->renderPartial('_view', array('model'=>$model)); ?>

		<?php $this->renderPartial('_reviews', array('model'=>$model,'dataProvider'=>$dataProvider)); ?>

		<?php $this->renderPartial('_reviewForm', array('note'=>$model,'model'=>$review)); ?>

	</div><!-- span9 -->
</div><!-- row-fluid -->