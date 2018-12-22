<?php
	namespace app\modules\calendarEvents\models;
	
	use app\models\User;
	use yii\db\ActiveRecord;
	use yii\behaviors\TimestampBehavior;
	use yii\db\Expression;
	use Yii;

	class Events extends ActiveRecord {

	    public function rules() {
	        return [
	            [['title','description', 'startDay'], 'required'],
	            [['startDay', 'endDay'], 'date', 'format' => Yii::$app->params['dateFormatModel']],
	            ['endDay', 'compare', 'compareAttribute' => 'startDay', 'operator' => '>=', 'enableClientValidation' => false],
	            ['endDay', 'default', 'value' => function($model) {
	            		return $model -> startDay;
	            }],
	            ['id_user', 'default', 'value' => Yii::$app -> user -> id],
	            ['isBlock', 'boolean']
	        ];
	    }

	    public function getUser() {
	        return $this->hasOne(User::class, ['id_user' => 'id_user']);
	    }

	    public function behaviors() {
			return [
				[
				'class' => TimestampBehavior::className(),
				'attributes' => [
				ActiveRecord::EVENT_BEFORE_INSERT => ['created_at',
				'updated_at'],
				ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
				'value' => new Expression('NOW()')
				],
			];
		}
	}
?>