<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.10.16.
 * Time: 12:36
 */

namespace albertborsos\yii2lib\web;

use albertborsos\yii2lib\helpers\S;
use albertborsos\yii2lib\wrappers\Mailer;
use Yii;
use yii\helpers\VarDumper;

class ErrorHandler extends \yii\web\ErrorHandler {

    public $emails = [];

    protected function renderException($exception){
		if(!strpos(Yii::$app->getUrlManager()->getBaseUrl(), 'localhost')){
        	$this->sendErrorMessageToDevelopers($exception);
		}
        parent::renderException($exception);
    }

    /**
     * @param $exception \Exception
     */
    private function sendErrorMessageToDevelopers($exception){
        $errors = $this->convertExceptionToArray($exception);

        $userIdentity = Yii::$app->getUser()->getIdentity();
		if (!is_null($userIdentity)){
        	$sender = [$userIdentity->getEmail() => $userIdentity->getFullname()];
		}else{
			$sender = ['noreply@'.Yii::$app->getRequest()->getServerName() => 'Web User'];
		}
		$status = S::get($errors, 'status');
		$status = is_null($status) ? S::get($errors, 'code') : $status;

		$subject = '#'.$status.' '.S::get($errors, 'name');

        $content  = '<h3>'.Yii::$app->name.' alkalmazásban hiba történt!</h3>';;

        $absoluteUrl = Yii::$app->getRequest()->absoluteUrl;
        $content .= '<p><b>URL:</b> '. $absoluteUrl . '</p>';

        $referrer = Yii::$app->getRequest()->getReferrer();
        $content .= '<p><b>Előző/Hivatkozó oldal:</b> ' . ($referrer !== null ? $referrer : 'direkt link') . '</p>';

        $content .= '<p><b>Fájl:</b> <code>'.$exception->getFile().'</code></p>';
        $content .= '<p><b>Sor:</b> <code>'.$exception->getLine().'</code></p>';
        $content .= '<p><b>Hibaüzenet</b> <code>'.$exception->getMessage().'</code></p>';
        $content .= '<p><b>Részetesen:</b> '.\yii\helpers\VarDumper::dumpAsString($errors, 10, true).'</p>';
        $content .= '<p><b>GET paraméterek</b> '.VarDumper::dumpAsString(Yii::$app->request->get(), 10, true).'</p>';
        $content .= '<p><b>POST paraméterek</b> '.VarDumper::dumpAsString(Yii::$app->request->post(), 10, true).'</p>';

        foreach($this->emails as $recipient){
            Mailer::sendMail($recipient, $subject, $content, $sender);
        }
    }
} 