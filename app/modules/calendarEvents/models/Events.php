<?php
	namespace app\modules\calendarEvents\models;
	
	use app\models\User;
	use yii\db\ActiveRecord;

	class Events extends ActiveRecord {

	    public function rules() {
	        return [
	            [['title','description'], 'required'],
	            [['startDay','endDay'], 'date', 'format' => 'yyyy-mm-dd'],
	            ['id_user', 'integer'],
	            ['isBlock', 'boolean']
	        ];
	    }

	    public function getUser() {
	        return $this->hasOne(User::class, ['id' => 'id_user']);
	    }
	}
?>