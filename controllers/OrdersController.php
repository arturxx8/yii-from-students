<?php

namespace app\controllers;

use app\models\Departments;
use app\models\Employees;
use app\models\Events;
use app\models\EventsSearch;
use app\models\EventsSearchin;
use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\OrdersSearchOut;
use app\models\OrderedItemsSearch;
use app\models\OrdersSearchOwn;
use app\models\OrderedItems;
use app\models\Items;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Employees::findOne(yii::$app->user->id)->role_id>=2) {
            $searchModel = new OrdersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionIndexout()
    {
        if (Employees::findOne(yii::$app->user->id)->role_id>=2) {
            $searchModel = new OrdersSearchOut();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            return $this->render('indexout', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionIndexown()
    {
        $searchModel = new OrdersSearchOwn();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexown', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new EventsSearchin();
        $dataProvider = $searchModel->search(['order_id'=>$id]);
        $comments= $items = $this->renderPartial('/events/index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        $searchModel = new OrderedItemsSearch();
        $dataProvider = $searchModel->search(['order_id'=>$id]);

        $items = $this->renderPartial('/ordereditems/index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items,
            'comments' => $comments,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (isset(Yii::$app->request->post()['Orders'])) {
            $order=Orders::find()->where(['order_id'=>Yii::$app->request->post()['Orders']['order_id']])->one();
            $order->comment=Yii::$app->request->post()['Orders']['comment'];
            $order->department_id=Yii::$app->request->post()['Orders']['department_id'];
            $order->save();
            return $this->render('order',['model'=>$order]);//$this->renderPartial('_order',['model'=>$order]);
        }
        if (\Yii::$app->user->isGuest) {
            return $this->render('//site/error', [
                'message' => 'Вы не авторизованы',
                'name' => 'Error'
            ]);
        }
        $order = new Orders();
        //$user = Employees::findIdentity(Yii::$app->user->id);
        $order->employee_id = $user->getId();
        //$order->save();
        return $this->render('create',[
            'model'=>$order,
            '_order'=>$this->renderPartial('_order',['model'=>$order,'deps' => ArrayHelper::map(Departments::find()->all(), 'department_id', 'department_name'),
            ])
        ]);
    }
    public function actionCreate2()
    {
        if (Yii::$app->request->isAjax) {
            return $this->actionAddorderitem();

        }


        return Yii::$app->end();
    }
    public function actionAddorderitem()
    {
        
            $data = Yii::$app->request->post();
            if (isset($data['id'])) {
                $items = ArrayHelper::map(Items::find()->where(['department_id'=>Orders::findOne(['order_id'=>$data['id']])->department_id])->all(), 'item_id', 'item_name');

                $ord_items = new OrderedItems();
                $ord_items->order_id = $data['id'];
                $ord_items->save();

                return $this->renderPartial('item', [
                    'items' => $items,
                    'model' => $ord_items
                ]);
            } else {
                Yii::info("Pjax1", 'binary');
                $ord_items = OrderedItems::findByID($data['OrderedItems']['id']);
                $ord_items->load($data);
                if ($ord_items->validate()){
                    $ord_items->update();}
                return $this->renderPartial('item', [
                    'items' => $items,
                    'model' => $ord_items
                ]);
            } 
    }
    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->request->post()['Orders']['order_id']);
        $model -> status = $model -> status+1;
        $model->save();
        $event = new Events();
        $event->employee_id = Yii::$app->user->id;
        $event->order_id = $model->order_id;
        $event->status_id = $model -> status;
        $event->date = (new \DateTime())->format('Y-m-d H:i:s');
        $event->save();
        return $this->renderPartial('_comment',[
            'model' => $event,
        ]);

    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = $this->findModel(Yii::$app->request->post()['Orders']['order_id']);
        $model -> status = -1;
        $model->save();
        $event = new Events();
        $event->employee_id = Yii::$app->user->id;
        $event->order_id = $model->order_id;
        $event->status_id = -1;
        $event->date = (new \DateTime())->format('Y-m-d H:i:s');
        $event->save();
        return $this->renderPartial('_comment',[
            'model' => $event,
        ]);
    }
    public function actionEvent()
    {
        $data = Yii::$app->request->post();
        $event = Events::findOne(['event_id'=>$data['Events']['event_id']]);
        $event->comment = $data['Events']['comment'];
        $event->save();
        return $this->goHome();
    }

    public function actionReady()
    {
        $data=Yii::$app->request->post();
        $model=$this->findModel($data['id']);
        $model->status=1;
        $model->save();
        $event = new Events();
        $event->employee_id = Yii::$app->user->id;
        $event->order_id = $model->order_id;
        $event->status_id = $model -> status;
        $event->date = (new \DateTime())->format('Y-m-d H:i:s');
        $event->comment=$model->comment;
        $event->save();
        return $this->redirect(['/general']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
