<?php
	namespace app\modules\calendarEvents\models;
	
	use app\models\User;
	use yii\db\ActiveRecord;
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
	            ['id_user', 'integer'],
	            ['isBlock', 'boolean']
	        ];
	    }

	    public function getUser() {
	        return $this->hasOne(User::class, ['id_user' => 'id_user']);
	    }
	}
?>