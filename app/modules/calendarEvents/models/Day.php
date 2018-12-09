<?php
	namespace app\modules\calendarEvents\models;
	use app\modules\calendarEvents\models\UserEvents;

	class Day extends UserEvents {
		public $selectedDate;
		public $eventsDay = [];
		public $selectedDay;

		public function __construct($config=[]) {
	    	parent::__construct($config);
	    }

		public function isWork() {
			$w = date_create($this -> selectedDate) -> format('w');
			
			return !in_array($w, [0, 6]);
		}

		public function isWeekend() {
			return !$this -> isWork();
		}

		public function getselectedDate($selectedDate) {
			$this -> selectedDate = $selectedDate;
			if ($this -> isWeekend()) {
				$this -> selectedDay = 'выходной день';
			} else {
				$this -> selectedDay = 'рабочий день';
			}
		}

		public function getEventsDay($eventsUser) {
			foreach ($eventsUser as $key => $value) {
				if ($value['startDay'] <= $this -> selectedDate && $this -> selectedDate <= $value['endDay']) {
					array_push($this -> eventsDay, $value);
				}
			}
		}
	}
?>