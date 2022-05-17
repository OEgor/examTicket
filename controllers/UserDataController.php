<?php

namespace app\controllers;

use app\models\UserData;
use app\models\UserDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;


/**
 * UserDataController implements the CRUD actions for UserData model.
 */
class UserDataController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['delete'],
                    'rules' => [
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'matchCallback' => function($rule, $action)
                            {
                                $access = false;
                                if(!Yii::$app->user->isGuest)
                                {
                                    $user = Yii::$app->user->identity;
                                    $status = $user->getStatusCode();
                                    if($status == "ADMINISTRATOR")
                                    {
                                        $access = true;
                                    }
                                }
                                    
                                    
                                return $access;
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserData models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserData model.
     * @param int $user_data_id User Data ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_data_id=-1)
    {
        $model = new UserData();
        if(Yii::$app->user->identity->getStatusCode() != "ADMINISTRATOR")
        {
                $user_data_id = UserData::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one();
                if(is_object($user_data_id))
                {
                    return $this->render('view', [
                        'model' => $user_data_id,
                    ]);
                }
                else
                {
                    return $this->redirect(['create']);
                }
            
        }
        else
        {
            return $this->render('view', [
                'model' => $this->findModel($user_data_id),
            ]);
        }
    }

    /**
     * Creates a new UserData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserData();

        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'user_data_id' => $model->user_data_id]);
            }
        } 
        else 
        {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_data_id User Data ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_data_id)
    {
        $model = $this->findModel($user_data_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_data_id' => $model->user_data_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPdf()
    {
        $searchModel = new UserDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $value = $dataProvider->getModels();
        //$html = $this->renderPartial('pdf_view', ['dataProvider'=>$dataProvider]);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors = true;
        $mpdf->setDisplayMode('fullpage', 'two');
        $mpdf->list_indent_first_level = 0;
        $html = '<!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style type="text/css">
                h3 { 
                 font-size: 12; 
                 text-align: center;
                 font-family: Times New Roman; 
                 color: #000000;
                }
                h4{
                font-size: 12; 
                 text-align: left;
                 font-family: Times New Roman; 
                 color: #000000;
                }
               </style>
        </head>
        <body>
            <div class="container">
                <h3 clss="">ФГБОУ ВО «Бурятский государственный университет»</h3>
                <h3>Институт математики и информатики</h3>
                <h3>'.$value[0]->user_name.'</h3>
                <br>
                <h3>Предмет: Web-разработка</h3>
                <h3>Экзаменационный билет № 1</h3>
                <br>
                <br>
                <br>
                <h4>Составитель: ст. преп. каф. ИТ             __________________           Хабитуев Б.В.</h4>
                <br>
                <h4>Согласовано: зав. каф. ИТ                     __________________           Цыбиков А.С.     </h4>
            </div>
        </body>
        
        </html>';
        
        $mpdf->writeHTML($html);
       // $mpdf->writeHTML($html);
        $mpdf->Output();
        exit;
    }

    /**
     * Deletes an existing UserData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_data_id User Data ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_data_id)
    {
        $this->findModel($user_data_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_data_id User Data ID
     * @return UserData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_data_id)
    {
        if (($model = UserData::findOne(['user_data_id' => $user_data_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
