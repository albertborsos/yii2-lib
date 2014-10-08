<?php
    /**
     * Created by PhpStorm.
     * User: borsosalbert
     * Date: 2014.07.01.
     * Time: 14:53
     */

    namespace albertborsos\yii2lib\wrappers;


    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use yii\web\JsExpression;

    class Select2 {

        /**
         * htmlOptions like id, class, placeholder etc...
         *
         * @param $name
         * @param $url
         * @param array $htmlOptions
         */
        public static function ajaxAutocomplete($name, $value, $url, $htmlOptions)
        {
            // The controller action that will render the list
            $url = Url::to($url);

            // Script to initialize the selection based on the value of the select2 element
            $initScript = <<< SCRIPT
        function (element, callback) {
            var id=\$(element).val();
            if (id !== "") {
                \$.ajax("{$url}?id=" + id, {
                    dataType: "json",
                }).done(function(data) { callback(data.results);});
            }
        }
SCRIPT;
            $pluginOptions = [
                'ajax'               => [
                    'url'      => $url,
                    'dataType' => 'json',
                    'data'     => new JsExpression('function(term,page) { return {search:term}; }'),
                    'results'  => new JsExpression('function(data,page) { return {results:data.results}; }'),
                ],
                'initSelection'      => new JsExpression($initScript)
            ];

            return self::baseWidget($name, $value, [], $htmlOptions, $pluginOptions);

        }

        public static function baseWidget($name, $value, $sourceArray, $htmlOptions = [], $pluginOptions = []){

            return \kartik\widgets\Select2::widget([
                'name'          => $name,
                'language'      => 'hu',
                'options'       => $htmlOptions,
                'value'         => $value,
                'data'          => $sourceArray,
                'pluginOptions' => ArrayHelper::merge([
                    'allowClear'         => true,
                    'minimumInputLength' => 3,
                ], $pluginOptions),
            ]);
        }
    }