<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.05.01.
 * Time: 11:17
 */

namespace albertborsos\yii2lib\web;

use yii\base\Action;
use yii\web\BadRequestHttpException;
use \yii\web\Controller as WebController;
use Yii;


class Controller extends WebController{

    public $name = 'Controller Neve';
    public $defaultAction = 'admin';
    public $actionName    = array(
        'index'    => 'Kezdőlap',
        'view'     => 'Nézet',
        'create'   => 'Létrehozás',
        'update'   => 'Módosítás',
        'delete'   => 'Törlés',
        'admin'    => 'Áttekintés',
        'error'    => 'Hiba',
        'overview' => 'Előnézet',
        'preview'  => 'Előnézet',
    );

    public $layout = '//center';

    public $breadcrumbs;

    public function beforeAction($action)
    {
        if (WebController::beforeAction($action)){
            $this->setBreadcrumbs($action);
            return true;
        }else{
            return false;
        }
    }

    private function setBreadcrumbs(Action $action){
        $view = Yii::$app->getView();
        if (isset($this->module)){
            $module = $this->module;
            $controller = $this;
            switch($controller->id){
                case 'default':
                    $this->breadcrumbs = [
                        ['label' => $module->name , 'url' => ['/'.$module->id.'/']],
                        ['label' => $this->getActionName($action)],
                    ];

                    $view->title = $this->getActionName($action).' | '.Yii::$app->name;
                    break;
                default:
                    $this->breadcrumbs = [
                        ['label' => $module->name, 'url' => ['/'.$module->id.'/']],
                        ['label' => $this->name, 'url' => ['/'.$module->id.'/'.$this->id.'/'.$this->defaultAction]],
                        ['label' => $this->getActionName($action)],
                    ];
                    $view->title = $this->getActionName($action).' - '.$this->name.' | '.Yii::$app->name;
                    break;
            }
        }else{
            $this->breadcrumbs = [
                ['label' => $this->name, 'url' => ['/'.$this->id.'/'.$this->defaultAction]],
                ['label' => $this->getActionName($action)],
            ];
            $view->title = $this->getActionName($action).' - '.$this->name.' | '.Yii::$app->name;
        }
    }

    public function getActionName(Action $action){
        if (isset($this->actionName[$action->id])){
            return $this->actionName[$action->id];
        }else{
            return 'Action név';
        }
    }

    public function addActionNames($names){
        $this->actionName = array_merge($this->actionName, $names);
    }

    public function setTheme($type){
        Yii::$app->view->theme->pathMap = ['@app/views' => '@common/themes/'.$type.'/views'];
    }
} 