<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 28.08.2019
 * Time: 15:49
 */
namespace api\controllers\demo;

use Yii;
use yii\rest\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

use core\entities\Demo\AiroClient;
use core\entities\Demo\AiroTrip;
use core\entities\Demo\AiroOrder;
use core\entities\Demo\AiroItem as AiroProduct;

class AiroController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Max-Age' => 3600,
                    'Access-Control-Expose-Headers' => ['*'],
                    'Access-Control-Allow-Origin' => ['*'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['get-orders', 'create-order', 'get-products'],
                        'allow' => true,
                        'roles' => ['?', 'user'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    //'create' => ['POST'],
                ],
            ],
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'languages' => [
                    'en', 'ru'
                ],
            ],
        ]);
    }

    public function actionGetOrders() {
        return AiroOrder::find()->all();
    }

    public function actionGetProducts() {
        return AiroProduct::find()->all();
    }

    public function actionCreateOrder() {
        $data = Yii::$app->request->getBodyParams();
        $name = $data['name'];
        $phone = $data['phone'];
        $address = $data['address'];
        $tripFrom = $data['tripFrom'];
        $tripTo = $data['tripTo'];
        $items = $data['products'];

        $client = new AiroClient();
        $client->name = $name;
        $client->phone = $phone;

        $trip = new AiroTrip();
        $trip->address = $address;
        $trip->date_from = date("Y-m-d H:i:s", strtotime($tripFrom));
        $trip->date_to = date("Y-m-d H:i:s", strtotime($tripTo));

        if ($client->save() && $trip->save()) {
            $order = new AiroOrder();
            $order->created_at = date("Y-m-d H:i:s");
            $order->client_id = $client->id;
            $order->trip_id = $trip->id;
            $order->items = $items;

            if ($order->save()) {
                return $order->id;
            }
        }

        return $items;
    }
}
