<?php
	namespace app\modules\calendarEvents\models;
	
	use yii\base\Model;
	use Yii;

	class EventsDAO extends Model {
		
		public function createEvent($event, $id_user, $id_events) {
			$db = Yii::$app -> db;

			if ($id_events == 0) {
				$result = $db -> createCommand() -> insert('events', [
					'title' => $event -> title,
					'startDay' => $event -> startDay,
					'endDay' => $event -> endDay,
					'id_user' => $id_user,
					'description' => $event -> description,
					'isBlock' => $event -> isBlock
				]) -> execute();
			} else {
				if ($this -> editEvent($event, $id_events)) {
				 	$result = 1;
				}
			}

			return $result > 0;
		}

		public function getEvents() {
			$db = Yii::$app -> db;

			$result = [];
			$result = $db -> createCommand('SELECT * FROM events') -> queryAll();
			
			return $result;
		}

		public function editEvent($event, $id_events) {
			$db = Yii::$app -> db;

			$result = Yii::$app->db->createCommand() -> update('events', [
				'title' => $event -> title,
				'startDay' => $event -> startDay,
				'endDay' => $event -> endDay,
				'description' => $event -> description,
				'isBlock' => $event -> isBlock
			], "id_events = $id_events") -> execute();
			
			return $result > 0;
		}
	}
?>