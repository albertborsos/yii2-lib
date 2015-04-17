<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.07.30.
 * Time: 10:53
 */

namespace albertborsos\yii2lib\wrappers;


use albertborsos\yii2lib\helpers\S;
use yii\helpers\HtmlPurifier;
use Yii;

class Mailer {

    /**
     * @param $to string(email) or ['email' => 'name']
     * @param $subject
     * @param $content
     * @param null $from string(email) or ['email' => 'name']
     * @return bool
     */
    public static function sendMail($to, $subject, $content, $from = null){

        $from    = self::setSender($from);
        $subject = self::setSubject($subject);

        return Yii::$app->mailer->compose()
            ->setSubject($subject)
            ->setHtmlBody($content)
            ->setTextBody(HtmlPurifier::process($content))
            ->setFrom($from)
            ->setReplyTo($from)
            ->setTo($to)
            ->send();
    }

    public static function sendMailByView($template, $params, $to, $subject, $from = null){
        $content = Yii::$app->getView()->renderFile($template, $params);

        return self::sendMail($to, $subject, $content, $from);
    }

    private static function setSender($from){
        if (is_null($from)){
            $from = S::get(Yii::$app->params, 'cms.email.owner');
            if (is_null($from)){
                $from = self::getDefaultSenderAddress();
            }
        }
        return $from;
    }

    private static function getDefaultSenderAddress(){
        $domain = Yii::$app->getUrlManager()->getHostInfo();
        $needle = ['http://', 'https://', 'www'];
        $domain = str_replace($needle, '', $domain);

        return 'noreply@'.$domain;
    }

    private static function setSubject($subject){
        return '['.Yii::$app->name.'] '.$subject;
    }

} 