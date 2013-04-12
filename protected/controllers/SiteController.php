<?php

class SiteController extends Controller
{
	public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		Yii::import('application.vendors.CAS.*');

		include_once('CAS/Autoload.php');
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		spl_autoload_register(array('YiiBase', 'autoload'));
		include_once('CAS.php');

		phpCAS::setDebug();
		phpCAS::client(CAS_VERSION_2_0, 'sso.ui.ac.id', 443, 'cas');
		phpCAS::setNoCasServerValidation();
		phpCAS::forceAuthentication();
		phpCAS::checkAuthentication();
		
		$username = phpCAS::getUser();
		$identity = new UserIdentity($username);

		if ($identity->authenticate())
			Yii::app()->user->login($identity);

		$this->redirect(array('home/index'));
	}

	/**
	 * Displays the dummy login page
	 */
	public function actionDummyLogin()
	{
		$identity = new DummyUserIdentity();

		if ($identity->authenticate())
			Yii::app()->user->login($identity);

		$this->redirect(array('home/index'));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::import('application.vendors.CAS.*');
		
		include_once('CAS/Autoload.php');
		spl_autoload_unregister(array('YiiBase', 'autoload'));
		spl_autoload_register(array('YiiBase', 'autoload'));
		include_once('CAS.php');

		phpCAS::setDebug();
		phpCAS::client(CAS_VERSION_2_0, 'sso.ui.ac.id', 443, 'cas');
		phpCAS::setNoCasServerValidation();
		phpCAS::logout();
		
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionDummyLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}