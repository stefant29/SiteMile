<?php

namespace frontend\controllers;

use Yii;
use common\models\Message;
use common\models\MessageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $message = $this->findModel(Yii::$app->request->get('id'));

                            return $message->to === Yii::$app->user->id || $message->from === Yii::$app->user->id;
                        }
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->to === Yii::$app->user->id) {
            $model->read_at = time();
            $model->save();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();
        $model->from = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // send email to recipient
            if ($this->sendEmail(['message' => $model, 'user' => $model->to0], 'new-message-received-html', 'new-message-received-text', $model->to0->email, "New Message Received")) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Your message was delivered successfully.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending your message.'));
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public static function sendEmail($params, $html, $text, $email, $subject)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => $html, 'text' => $text],
                $params
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($email)
            ->setSubject($subject)
            ->send();
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
