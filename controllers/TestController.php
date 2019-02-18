<?php
/**
 * Created by PhpStorm.
 * User: imor
 * Date: 19-1-29
 * Time: 上午10:40
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\UserSystem;

class TestController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        var_dump(\Yii::$app->test->getSystemIdsByUserId(1));
        var_dump(\Yii::$app->params['adminEmail']);
    }

    public function actionInvoice()
    {
//        $this->layout = false;
        $str = trim(\Yii::$app->request->post('invoice_money'));
        $arr = array_filter(explode(' ', $str));


        var_dump($arr);

        $back = $this->getInvoice($arr, 440);


        return $this->render('invoice');
    }

    private function getInvoice($money_arr, $total)
    {

    }
}