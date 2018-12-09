<?php
	namespace app\modules\calendarEvents\controllers;
	use app\modules\calendarEvents\models\UserEvents;
	use app\modules\calendarEvents\models\Day;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {
		public $eventsUser;
	    /**
	     * Renders the index view for the module
	     * @return string
	     */
	    public function actionIndex() {
	    	$this -> getEventsUser();

	        return $this->render('index', ['eventsUser' => $this -> eventsUser]);
	    }

	    public function getEventsUser() {
	    	$eventsUser = [
	    		new UserEvents([], [
	    			'title' => 'Event 1',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '2018-11-30',
	    			'endDay' => '2018-12-10'
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 2',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '2018-12-07',
	    			'endDay' => '2018-12-12'
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 3',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => '2018-12-23',
	    			'endDay' => '2018-12-31'
	    		])
	    	];

	    	$this -> eventsUser = $eventsUser;
	    }

	    public function actionDay() {
	    	$selectedDate = date('Y-m-d');
	    	$day = new Day;
	    	$day -> getSelectedDate($selectedDate);
	    	$this -> getEventsUser();
	    	$day -> getEventsDay($this -> eventsUser);

	    	return $this->render('viewDay', 
	    		[
	    		'day' => $day -> selectedDay,
	    		'eventsDay' => $day -> eventsDay
	    		]);
	    }
	}
?>