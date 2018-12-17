<?php
	namespace app\modules\calendarEvents\models;
	
	use app\models\User;
	use yii\db\ActiveRecord;

	class Events extends ActiveRecord {

	    public function rules() {
	        return [
	            [['title','description'], 'required'],
	            [['startDay', 'endDay'], 'date', 'format' => 'yyyy-mm-dd'],
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