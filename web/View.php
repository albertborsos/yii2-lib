<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 14. 12. 28.
 * Time: 13:43
 */

namespace albertborsos\yii2lib\web;


class View extends \yii\web\View{
    /**
     * @var string path alias to web base
     */
    public $base_path = '@app/web';

    /**
     * @var string path alias to save minify result
     */
    public $minify_path = '@app/web/minify';

    /**
     * @var array positions of js files to be minified
     */
    public $js_position = [self::POS_END, self::POS_HEAD];

    /**
     * @var bool|string charset forcibly assign, otherwise will use all of the files found charset
     */
    public $force_charset = false;

    /**
     * @var bool whether to change @import on content
     */
    public $expand_imports = true;

    /**
     * @var int
     */
    public $css_linebreak_pos = 2048;

    /**
     * @var int|bool chmod of minified file. If false chmod not set
     */
    public $file_mode = 0664;

    /**
     * @var array schemes that will be ignored during normalization url
     */
    public $schemas = ['//', 'http://', 'https://', 'ftp://'];

    /**
     * @var bool do I need to compress the result html page.
     */
    public $compress_output = false;
}