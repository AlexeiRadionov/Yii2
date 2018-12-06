<?php
	namespace app\modules\calendarEvents\controllers;
	use app\modules\calendarEvents\models\UserEvents;
	use app\modules\calendarEvents\models\Day;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {
	    /**
	     * Renders the index view for the module
	     * @return string
	     */
	    public function actionIndex() {
	    	$events = [
	    		new UserEvents([], [
	    			'title' => 'Event 1',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => date('Y.m.d H:i:s'),
	    			'endDay' => date('Y.m.d H:i:s', time() + 3 * 24 * 3600)
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 2',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => date('Y.m.d H:i:s'),
	    			'endDay' => date('Y.m.d H:i:s', time() + 3 * 24 * 3600)
	    		]),
	    		new UserEvents([], [
	    			'title' => 'Event 3',
	    			'description' => 'Lorem ipsum dolor.',
	    			'startDay' => date('Y.m.d H:i:s'),
	    			'endDay' => date('Y.m.d H:i:s', time() + 3 * 24 * 3600)
	    		])
	    	];
	        return $this->render('index', ['events' => $events]);
	    }

	    public function actionDay() {
	    	$day = new Day;
	    	$day -> getCurrentDay();
	    	$event = 'Event 4';

	    	return $this->render('viewDay', 
	    		[
	    		'day' => $day -> typeDay,
	    		'event' => $event
	    		]);
	    }
	}
?>