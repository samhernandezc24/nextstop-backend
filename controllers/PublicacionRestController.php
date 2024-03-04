<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class PublicacionRestController extends ActiveController
{
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
      'class' => Cors::class,
      'cors' => [
        'Origin'                            => ['http://localhost:8100'],
        'Access-Control-Request-Method'     => ['GET', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers'    => ['*'],
        'Access-Control-Allow-Credentials'  => true,
        'Access-Control-Max-Age'            => 600,
      ],
    ];
    return $behaviors;
  }

  public $modelClass = 'app\models\Publicacion';
}
