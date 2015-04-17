<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 01. 15.
 * Time: 13:45
 */

namespace albertborsos\yii2lib\helpers;


use Yii;

class Seo {

	const TYPE_CANONICAL = 'canonical';
	const TYPE_KEYWORDS = 'keywords';
	const TYPE_DESCRIPTION = 'description';
	const TYPE_TITLE = 'title';
	const TYPE_ROBOTS = 'robots';

    const TYPE_FB_TITLE = 'og:title';
    const TYPE_FB_SITE_NAME = 'og:site_name';
    const TYPE_FB_DESCRIPTION = 'og:description';
    const TYPE_FB_IMAGE = 'og:image';
    const TYPE_FB_TYPE = 'og:type';
    const TYPE_FB_LOCALE = 'og:locale';
    const TYPE_FB_SHARE_URL = 'og:url';
    const TYPE_FB_APP_ID = 'og:app_id';

    const FB_TYPE_PAGE = 'article';
    const FB_TYPE_PRODUCT = 'product';
    const FB_TYPE_PRODUCT_GROUP = 'product.group';

	const INDEX = 'INDEX';
	const NOINDEX = 'NOINDEX';

	public static function registerTag($type, $content){
		$view = Yii::$app->getView();
        if(!is_null($content) && $content !== false){
            switch($type){
                case self::TYPE_TITLE:
                    $appName = ' | ' . Yii::$app->name;
                    if(strpos($content, $appName)){
                        $view->title = $content;
                    }else{
                        $view->title = $content . $appName;
                    }
                    if(strlen($view->title) >= 55){
                        $view->title = str_replace($appName, '', $view->title);
                    }
                    break;
                case self::TYPE_CANONICAL:
                        $url = is_array($content) ? Yii::$app->getUrlManager()->createAbsoluteUrl($content) : $content;
                        $view->registerLinkTag([
                            'rel' => $type,
                            'href' => $url,
                        ],$type);
                    break;
                case self::TYPE_KEYWORDS:
                case self::TYPE_DESCRIPTION:
                case self::TYPE_ROBOTS:
                    $view->registerMetaTag([
                        'name' =>$type,
                        'content' => $content,
                    ], $type);
                    break;
                case self::TYPE_FB_TITLE:
                case self::TYPE_FB_SITE_NAME:
                case self::TYPE_FB_TYPE:
                case self::TYPE_FB_SHARE_URL:
                case self::TYPE_FB_LOCALE:
                case self::TYPE_FB_DESCRIPTION:
                case self::TYPE_FB_IMAGE:
                case self::TYPE_FB_APP_ID:
                    $view->registerMetaTag([
                        'property' => $type,
                        'content' => $content,
                    ]);
                    break;
            }
        }
	}

	public static function noIndex(){
		$view = Yii::$app->getView();

		self::removeItemFromMetaTags(Seo::TYPE_ROBOTS);

		$view->registerMetaTag([
			'name' =>Seo::TYPE_ROBOTS,
			'content' => Seo::NOINDEX,
		]);
	}

	public static function removeItemFromMetaTags($needle){
		$metaTags = Yii::$app->getView()->metaTags;
		if(!is_null($metaTags)){
			$results = array_filter($metaTags, function ($item) use ($needle) {
				if (stripos($item, $needle) !== false) {
					return true;
				}
				return false;
			});

			foreach($results as $key => $value){
				if(isset($metaTags[$key])){
					unset(Yii::$app->getView()->metaTags[$key]);
				}
			}
		}

	}
}