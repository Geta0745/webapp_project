<?php

namespace frontend\controllers;

use app\models\OrderCart;
use app\models\OrderCartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use Yii;
/**
 * OrderCartController implements the CRUD actions for OrderCart model.
 */
class OrderCartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all OrderCart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderCartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBill(){
        return $this->render('bill');
    }

    public function actionCashBill(){
        $cart = OrderCart::find()->where(['user_id'=>Yii::$app->user->identity->id])->all();
        foreach($cart as $row){
            $row->delete();
        }
        Yii::$app->session->setFlash('success', 'ขอบคุณที่ใช้บริการ ครับ/ค่ะ');
        return $this->redirect(['site/index']);
    }

    /**
     * Displays a single OrderCart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderCart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new OrderCart();
        $product = Product::find()->where(['id'=>$id])->one();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $product->current_amount -= $model->amount;
                if($product->save()){
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,'id'=>$id,'product'=>$product,
        ]);
    }

    /**
     * Updates an existing OrderCart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = Product::find()->where(['id'=>$model->product_id])->one();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,'id'=>$model->product_id,'product'=>$product,
        ]);
    }*/

    /**
     * Deletes an existing OrderCart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $product = Product::find()->where(['id'=>$model->product_id])->one();
        $product->current_amount += $model->amount;
        $product->save();
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderCart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrderCart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderCart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
