<?php
/**
 * Created by PhpStorm.
 * User: borsosalbert
 * Date: 2014.10.05.
 * Time: 16:49
 */

namespace albertborsos\yii2lib\helpers;


use yii\helpers\Html;

class Modal {
    /**
     * Modal box for ajax requests
     * 
     * @param $id
     * @param $header
     * @param $content
     * @param null $footer
     * @param null $style
     * @return string
     */
    public static function frame($id, $header, $content, $footer = null, $style = null){
        if (is_null($footer)){
            $footer = Html::button('Bezárás', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
        }
        if (!is_null($header)) $header = '<h4 class="modal-title">'.$header.'</h4>';
        return '<div id="myModalBox'.$id.'" class="fade modal" role="dialog" tabindex="-1" style="'.$style.'">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            '.$header.'
                          </div>
                          <div class="modal-body">
                            '.$content.'
                          </div>
                          <div class="modal-footer">
                            '.$footer.'
                          </div>
                        </div><!-- /.modal-content -->
                  </div>
                </div>';
    }
} 