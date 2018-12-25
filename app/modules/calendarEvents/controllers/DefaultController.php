<?php
	namespace app\modules\calendarEvents\controllers;

	use Yii;
	use app\modules\calendarEvents\models\Events;
	use yii\filters\AccessControl;
	use app\modules\calendarEvents\models\EventsDAO;
	use app\modules\calendarEvents\models\Day;
	use yii\web\Controller;

	/**
	 * Default controller for the `calendarEvents` module
	 */
	class DefaultController extends Controller {

		public function behaviors() {
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only'  => ['form'],
					'rules' => [
						[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['@']
						],
						[
						'actions' => ['form'],
						'allow' => true,
						'roles' => ['admin', 'simple'],
						],
					],
				]
			];
		}

	    /**
	     * Renders the index view for the module
	     * @return string
	     */
	    public function actionIndex() {
	    	$isAdmin = Yii::$app->user->can('admin');
	        $find = Events::find();
	        
	        if(!$isAdmin) {
	            $find = $find->where([
	                'id_user' => Yii::$app->user->id,
	            ]);
	        }

	    	$eventsUser = $find->all();
	    	if (!isset($_SESSION['calendarDate'])) {
	    		$calendarDate = date('Y-m-01');
	    	} else {
	    		$calendarDate = $_SESSION['calendarDate'];
	    	}
	    	
	        return $this->render('index',
	        	[
	        		'eventsUser' => $eventsUser,
	        		'date' => Yii::$app->params['dateFormatView'],
	        		'calendarDate' => $calendarDate,
	    		]);
	    }

	    public function actionDay() {
	    	$currentDate = Yii::$app->params['currentDate'];
	    	$day = new Day;
	    	$day -> getCurrentDay($currentDate);
	    	$eventsUser = Events::findAll([
	    		'id_user' => Yii::$app -> user -> id
	    	]);
	    	$day -> getEventsDay($eventsUser);

	    	return $this->render('viewDay', 
	    		[
	    			'day' => $day -> currentDay,
	    			'eventsDay' => $day -> eventsDay,
	    			'date' => Yii::$app->params['dateFormatView'],
	    		]);
	    }

	    public function actionForm() {
		    $model = new \app\modules\calendarEvents\models\Events();
		    if (isset($_GET['id'])) {
		        $id_events = (int)strip_tags($_GET['id']);
		    } else {
		    	$id_events = 0;
		    }

		    if ($model->load(Yii::$app->request->post())) {
		    	$model -> id_user = Yii::$app -> user -> id;
		        if ($model->validate()) {
		        	$event = new EventsDAO;
		        	
		        	if ($event -> createEvent($model, $model -> id_user, $id_events)) {
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

		public function actionMonth() {

			if (isset($_SESSION['calendarDate'])) {
				$calendarDate = $_SESSION['calendarDate'];
			}
						
			if (isset($_GET['month'])) {
				$month = $_GET['month'];
			}

			if ($month == 'prev') {
				$calendarDate = date('Y-m-01', strtotime($calendarDate . '-1 month'));
			} else if ($month == 'next') {
				$calendarDate = date('Y-m-01', strtotime($calendarDate . '+1 month'));
			}

			$_SESSION['calendarDate'] = $calendarDate;
		
			return $this -> redirect(['index']);
		}
	}
?>