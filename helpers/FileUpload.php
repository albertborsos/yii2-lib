<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.08.12.
 * Time: 16:08
 */

namespace albertborsos\yii2lib\helpers;


use dosamigos\fileupload\BaseUpload;
use dosamigos\fileupload\FileUploadUI;
use dosamigos\fileupload\FileUploadUIAsset;
use dosamigos\gallery\GalleryAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class FileUpload extends FileUploadUI{
    public function init()
    {
        parent::init();
        $this->formView = '@vendor/albertborsos/yii2-lib/views/fileupload/form';

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

        FileUploadUIAsset::register($view);

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