<?php

namespace albertborsos\yii2lib\helpers;

use albertborsos\yii2lib\assets\BlueimpLoadImageAsset;
use dosamigos\fileupload\FileUploadUI;
use dosamigos\gallery\GalleryAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class FileUpload extends FileUploadUI{

    const LIB_PATH = '@vendor/albertborsos/yii2-lib/views/fileupload/';
    const PARENT_PATH = '@vendor/2amigos/yii2-file-upload-widget/src/views/';

    /**
     * @var string the form view path to render the JQuery File Upload UI
     */
    public $formView = self::LIB_PATH . 'form';
    /**
     * @var string the upload view path to render the js upload template
     */
    public $uploadTemplateView = self::PARENT_PATH . 'upload';
    /**
     * @var string the download view path to render the js download template
     */
    public $downloadTemplateView = self::PARENT_PATH . 'download';
    /**
     * @var string the gallery
     */
    public $galleryTemplateView = self::PARENT_PATH . 'gallery';
    
    public function init()
    {
        parent::init();

        $this->fieldOptions['id'] = ArrayHelper::getValue($this->options, 'id');

        $this->options['id'] .= '-form';
        $this->options['enctype'] = 'multipart/form-data';
        $this->options['uploadTemplateId'] = $this->uploadTemplateId ? : '#template-upload';
        $this->options['downloadTemplateId'] = $this->downloadTemplateId ? : '#template-download';
    }

    public function registerClientScript()
    {
        $view = $this->getView();

        if ($this->gallery) {
            GalleryAsset::register($view);
        }

        \albertborsos\yii2lib\assets\FileUploadUIAsset::register($view);

        $options = Json::encode($this->clientOptions);
        $id = isset($this->clientOptions['formId']) ? $this->clientOptions['formId'] : $this->options['id'];

        $js[] = ";jQuery('#$id').fileupload($options);";
        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
        }
        $view->registerJs(implode("\n", $js));
    }
}
