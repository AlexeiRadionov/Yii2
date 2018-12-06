<?php
	namespace app\modules\calendarEvents\models;
	use app\modules\calendarEvents\models\UserEvents;

	class Day extends UserEvents {
		public $typeDay;
		public $event;

		public function getCurrentDay() {
			if (date('N') >= 6) {
				$this -> typeDay = 'выходной день';
			} else {
				$this -> typeDay = 'рабочий день';
			}
		}
	}
?>