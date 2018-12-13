<?php
	namespace app\modules\calendarEvents\controllers;

	use Yii;
	use app\modules\calendarEvents\models\UserEvents;
	use app\modules\calendarEvents\models\EventsDAO;
	use app\modules\calendarEvents\models\Day;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {
		public $eventsUser;
		public $id_user = 1;

		public function getEventsUser() {
			$objectEventsDAO = new EventsDAO;
			$eventsUser = $objectEventsDAO -> getEvents();

	    	$this -> eventsUser = $eventsUser;
	    }

	    /**
	     * Renders the index view for the module
	     * @return string
	     */
	    public function actionIndex() {
	    	$this -> getEventsUser();

	        return $this->render('index', ['eventsUser' => $this -> eventsUser]);
	    }

	    public function actionDay() {
	    	$currentDate = date('Y-m-d');
	    	$day = new Day;
	    	$day -> getCurrentDate($currentDate);
	    	$this -> getEventsUser();
	    	$day -> getEventsDay($this -> eventsUser);

	    	return $this->render('viewDay', 
	    		[
	    		'day' => $day -> currentDay,
	    		'eventsDay' => $day -> eventsDay
	    		]);
	    }

	    public function actionForm() {
		    $model = new \app\modules\calendarEvents\models\UserEvents();
		    if (isset($_GET['id'])) {
		        $id_events = (int)strip_tags($_GET['id']);
		    } else {
		    	$id_events = 0;
		    }

		    if ($model->load(Yii::$app->request->post())) {
		        if ($model->validate()) {
		        	$event = new EventsDAO;
		        	
		        	if ($event -> createEvent($model, $this -> id_user, $id_events)) {
		        		return $this -> redirect(['success']);
		        	}
		        }
		    }

		    return $this->render('form', [
		        'model' => $model,
		    ]);
		}

		public function actionSuccess() {
			return $this->render('submit');
		}
	}
?>