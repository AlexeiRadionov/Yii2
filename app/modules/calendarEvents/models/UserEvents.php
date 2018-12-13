<?php
	namespace app\modules\calendarEvents\models;
	use yii\base\Model;

	class UserEvents extends Model {
	    public $title;
	    public $startDay;
	    public $endDay;
	    public $id_user;
	    public $description;
	    public $isBlock;

	    public function __construct($config=[], $attributes=[]) {
	    	parent::__construct($config);
	    	$this -> setAttributes($attributes, false);
	    }

	    public function rules() {
	        return [
	            [['title','description'], 'required'],
	            [['startDay','endDay'], 'date', 'format' => 'yyyy-mm-dd'],
	            ['isBlock', 'boolean']
	        ];
	    }
	}
?>