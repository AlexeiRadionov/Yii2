<?php
	namespace app\modules\calendarEvents\controllers;

	use Yii;
	use app\modules\calendarEvents\models\UserEvents;
	use app\modules\calendarEvents\models\Day;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {
		public $eventsUser;

		public function getEventsUser() {
	    	$eventsUser = [
	    		new UserEvents([], [
	    			'title' => 'Event 1',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '07-11-2018',
	    			'endDay' => '15-12-2018'
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 2',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '07-12-2018',
	    			'endDay' => '12-12-2018'
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 3',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '23-12-2018',
	    			'endDay' => '31-12-2018'
	    		])
	    	];

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
	    	$currentDate = date('d-m-Y');
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

		    if ($model->load(Yii::$app->request->post())) {
		        if ($model->validate()) {
		            return $this -> redirect(['success']);
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