<?php
class EventsController extends CController
{
    public $page;
    
    
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }
    
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                    'users'=>array('@'),
            ),
            array('deny',  // allow all users to access 'index' and 'view' actions.
                    'actions'=>array('create', 'edit'),
                    'users'=>array('*'),
            ),
        );
    }
    
    
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Events', array(
            'criteria'=>array(
                'condition'=>'date >= NOW()',
                'with'=>'crew',
                'order'=>'date ASC',
            ),
            
            'pagination'=>array(
                'pageSize'=>10,
            ),

        ));

        $this->render('view',array(
                'dataProvider'=>$dataProvider,
        ));
    }
    
    public function actionView()
    {
        $data = Events::model()->findByPK($_GET['id']);
	
        if($data != null)
        {
	    $form = new EventRequest;
	    if(isset($_POST['EventRequest']))
	    {
		$form->attributes = $_POST['EventRequest'];
		
		if($form->validate())
		{
		    $form->ID_USER = Yii::app()->user->id;
		    $form->ID_EVENT = $data->ID;
		    $form->date_sent = date ("Y-m-d H:i:s");
		    $form->ip = $_SERVER['REMOTE_ADDR'];
		    
		    $form->save();
		    $form = true;
                    
                    $subject = 'Contact request for event "'. $data->title . '"';
                    $body = 'You have recieved a contact request for your event "'. $data->title . "\n\n".
                            'Title: ' . $form->title . "\nMessage:\n".
                            wordwrap($form->body, 70) . "\n-----------------------------------------\n\n".
                            'You may view this event on http://www.crew2040.com/events/' . $data->ID;
                    
                    $this->sendEmail($subject, $data->contact_email, $body);
                    
		    
		}
	    }
	    
            $this->render('request', array('model' => $data, 'form' => $form));
        }
        else
        {
            throw new CHttpException(404, "The requested event was not found");
        }
    }
    
    public function actionCreate()
    {
	
	$model = new Events;
	$model->contact_email = Yii::app()->user->email;
        
        if(isset($_POST['Events']))
        {
                $model->attributes=$_POST['Events'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
		{
		    $dt = explode('/', $model->attributes['date']);
		    $model->date = "{$dt[2]}-{$dt[0]}-{$dt[1]}";
		    $model->ID_CREW = Yii::app()->user->crew->ID;
                    $model->ID_USER = Yii::app()->user->id;
		    $model->save();
		}
        }
        
        $this->render('create', array('model' => $model));
    }
    
    public function actionEdit()
    {
	$model = Events::model()->with('crew')->findByPK($_GET['id']);
	
	if($model == null)
	    throw new CHttpException(404, 'The event could not be found');
	
	if(!$model->canEdit() && !Yii::app()->user->isAdmin())
	    throw new CHttpException(403, 'You are not allowed to edit this event');
	
	$dt = explode('-', $model->attributes['date']);
	$model->date = "{$dt[1]}/{$dt[2]}/{$dt[0]}";
        
        if(isset($_POST['Events']))
        {
                $model->attributes=$_POST['Events'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
		{
		    $dt = explode('/', $model->attributes['date']);
		    $model->date = "{$dt[2]}-{$dt[0]}-{$dt[1]}";
		    $model->ID_CREW = Yii::app()->user->crew->ID;
		    $model->save();
		}
        }
        
        $this->render('edit', array('model' => $model));
    }
    
    public function actionDelete()
    {
        $event = Events::model()->findByPK($_GET['id']);
        
        if(empty($event))
            throw new CHttpException(404, 'The requested event was not found.');
        
        if(!$event->canEdit() && !Yii::app()->user->isAdmin())
            throw new CHttpException(403, 'You do not have permission to delete this event');
        
        $event->delete();
        
        $this->redirect('../../../events');
    }
    
    public function sendEmail($subject, $email, $body)
    {
        $headers = 'From: donotreply@grandcanyonvoa.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        mail($email, $subject, $body, $headers);
    }
}

?>