<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model app\modules\calendarEvents\models\UserEvents */
	/* @var $form ActiveForm */

    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents', 'label' => 'List events'];
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/default/day', 'label' => 'Events today'];
?>

<div class="default-form">
    
    <?php $form = ActiveForm::begin(); ?>
		<?php echo $form -> field($model, 'title'); ?>
		<?php echo $form -> field($model, 'description') -> textarea(); ?>
		<?php echo $form -> field($model, 'startDay') -> textinput(['type'=>'date']); ?>
		<?php echo $form -> field($model, 'endDay') -> textinput(['type'=>'date']); ?>
		<?php echo $form -> field($model, 'isBlock') -> checkbox(); ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- default-form -->
