<?php
/* @var $this NoteController */
/* @var $data Note */
?>

<?php if (Yii::app()->user->getState('is_admin')) echo CHtml::checkBox('deleteNote[' . $data->id . ']'); ?>
<div id="iconBerkas">
<?php echo CHtml::image($data->getTypeIcon(), 'note icon', array('class' => 'note-icon',"width"=>50,"height"=>50)); ?>
</div>
<br />
<?php echo CHtml::link(CHtml::encode($data->title), array('noteDetails/index', 'id'=>$data->id)); ?>
<br />

<i class="icon icon-user"></i> <?php echo CHtml::encode($data->student->username); ?>
<br />

<i class="icon icon-briefcase"></i> <?php echo CHtml::encode($data->course->faculty->name); ?>
<br />

<i class="icon icon-book"></i> <?php echo CHtml::encode($data->course->name); ?>
<br />

<?php // TO-DO: set locale ?>
<i class="icon icon-time"></i> <?php echo CHtml::encode(strftime('%A, %e %B %Y, %T', strtotime($data->upload_timestamp))); ?>
<br />