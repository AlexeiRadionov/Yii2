<?php
	namespace app\modules\calendarEvents\models;
	use app\modules\calendarEvents\models\Events;

	class Day extends Events {
		public $currentDate;
		public $eventsDay = [];
		public $currentDay;

		public function __construct($config=[]) {
	    	parent::__construct($config);
	    }

		public function isWork() {
			$w = date_create($this -> currentDate) -> format('w');
			
			return !in_array($w, [0, 6]);
		}

		public function isWeekend() {
			return !$this -> isWork();
		}

		public function getCurrentDay($currentDate) {
			$this -> currentDate = $currentDate;
			if ($this -> isWeekend()) {
				$this -> currentDay = 'weekend';
			} else {
				$this -> currentDay = 'work day';
			}
		}

		public function getEventsDay($eventsUser) {
			foreach ($eventsUser as $key => $value) {
				if (strtotime($value['startDay']) <= strtotime($this -> currentDate) && strtotime($this -> currentDate) <= strtotime($value['endDay'])) {
					array_push($this -> eventsDay, $value);
				}
			}
		}
	}
?>