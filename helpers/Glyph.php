<?php

    namespace albertborsos\yii2lib\helpers;

    /**
     * Date: 20.11.13
     * Time: 23:00
     * Class Glyph
     * Create a Glyphicon
     *
     * For example,
     *
     *twig
     * {{ glyph.icon( constant( '\\common\\helpers\\Glyph::ICON_BELL')) )|raw }}
     *
     * ```php
     * echo Glyph::icon(Glyph::ICON_BELL);
     * ```
     *
     * @author: Pascal Brewing < pascalbrewing@googlemail.com >
     * @see http://getbootstrap.com/components/#glyphicons
     * @since 2.0
     */
    use Yii;
    use yii\helpers\Html;

    class Glyph {

        /**
         * @param string $icon
         * ```php'['class'] => 'glyphicon '.$icon'```
         * @param string $tag
         * ```php 'span' ```
         * @param string $content
         * ```php '' ```
         * @param array $htmlOptions
         * ```php [] ```
         * @return string
         */
        public static function icon($icon = '', $tag = 'span', $content = '', $htmlOptions = [])
        {
            $token = uniqid($icon);
            //This method is faster than 2ms Html::addCssClass($htmlOptions,'glyphicon '.$icon);
            $htmlOptions['class'] = isset($htmlOptions['class']) ? $htmlOptions['class'] . ' glyphicon ' . $icon : 'glyphicon ' . $icon;

            return Html::tag($tag, $content, $htmlOptions);
        }

        public static function iconsDataContent(){
            $icons = self::icons();
            $array = [];
            foreach($icons as $icon){
                $array[$icon] =['data-content' => '<i class="glyphicon '.$icon.'"></i> '.str_replace('glyphicon-', '', $icon)];
            }

            return $array;
        }

        public static function icons()
        {
            return [
                'glyphicon-adjust'                 => 'glyphicon-adjust',
                'glyphicon-align-center'           => 'glyphicon-align-center',
                'glyphicon-align-justify'          => 'glyphicon-align-justify',
                'glyphicon-align-left'             => 'glyphicon-align-left',
                'glyphicon-align-right'            => 'glyphicon-align-right',
                'glyphicon-arrow-down'             => 'glyphicon-arrow-down',
                'glyphicon-arrow-left'             => 'glyphicon-arrow-left',
                'glyphicon-arrow-right'            => 'glyphicon-arrow-right',
                'glyphicon-arrow-up'               => 'glyphicon-arrow-up',
                'glyphicon-asterisk'               => 'glyphicon-asterisk',
                'glyphicon-backward'               => 'glyphicon-backward',
                'glyphicon-ban-circle'             => 'glyphicon-ban-circle',
                'glyphicon-barcode'                => 'glyphicon-barcode',
                'glyphicon-bell'                   => 'glyphicon-bell',
                'glyphicon-bold'                   => 'glyphicon-bold',
                'glyphicon-book'                   => 'glyphicon-book',
                'glyphicon-bookmark'               => 'glyphicon-bookmark',
                'glyphicon-briefcase'              => 'glyphicon-briefcase',
                'glyphicon-bullhorn'               => 'glyphicon-bullhorn',
                'glyphicon-calendar'               => 'glyphicon-calendar',
                'glyphicon-camera'                 => 'glyphicon-camera',
                'glyphicon-certificate'            => 'glyphicon-certificate',
                'glyphicon-check'                  => 'glyphicon-check',
                'glyphicon-chevron-down'           => 'glyphicon-chevron-down',
                'glyphicon-chevron-left'           => 'glyphicon-chevron-left',
                'glyphicon-chevron-right'          => 'glyphicon-chevron-right',
                'glyphicon-chevron-up'             => 'glyphicon-chevron-up',
                'glyphicon-circle-arrow-down'      => 'glyphicon-circle-arrow-down',
                'glyphicon-circle-arrow-left'      => 'glyphicon-circle-arrow-left',
                'glyphicon-circle-arrow-right'     => 'glyphicon-circle-arrow-right',
                'glyphicon-circle-arrow-up'        => 'glyphicon-circle-arrow-up',
                'glyphicon-cloud'                  => 'glyphicon-cloud',
                'glyphicon-cloud-download'         => 'glyphicon-cloud-download',
                'glyphicon-cloud-upload'           => 'glyphicon-cloud-upload',
                'glyphicon-cog'                    => 'glyphicon-cog',
                'glyphicon-collapse-down'          => 'glyphicon-collapse-down',
                'glyphicon-collapse-up'            => 'glyphicon-collapse-up',
                'glyphicon-comment'                => 'glyphicon-comment',
                'glyphicon-compressed'             => 'glyphicon-compressed',
                'glyphicon-copyright-mark'         => 'glyphicon-copyright-mark',
                'glyphicon-credit-card'            => 'glyphicon-credit-card',
                'glyphicon-cutlery'                => 'glyphicon-cutlery',
                'glyphicon-dashboard'              => 'glyphicon-dashboard',
                'glyphicon-download'               => 'glyphicon-download',
                'glyphicon-download-alt'           => 'glyphicon-download-alt',
                'glyphicon-earphone'               => 'glyphicon-earphone',
                'glyphicon-edit'                   => 'glyphicon-edit',
                'glyphicon-eject'                  => 'glyphicon-eject',
                'glyphicon-envelope'               => 'glyphicon-envelope',
                'glyphicon-euro'                   => 'glyphicon-euro',
                'glyphicon-exclamation-sign'       => 'glyphicon-exclamation-sign',
                'glyphicon-expand'                 => 'glyphicon-expand',
                'glyphicon-export'                 => 'glyphicon-export',
                'glyphicon-eye-close'              => 'glyphicon-eye-close',
                'glyphicon-eye-open'               => 'glyphicon-eye-open',
                'glyphicon-facetime-video'         => 'glyphicon-facetime-video',
                'glyphicon-fast-backward'          => 'glyphicon-fast-backward',
                'glyphicon-fast-forward'           => 'glyphicon-fast-forward',
                'glyphicon-file'                   => 'glyphicon-file',
                'glyphicon-film'                   => 'glyphicon-film',
                'glyphicon-filter'                 => 'glyphicon-filter',
                'glyphicon-fire'                   => 'glyphicon-fire',
                'glyphicon-flag'                   => 'glyphicon-flag',
                'glyphicon-flash'                  => 'glyphicon-flash',
                'glyphicon-floppy-disk'            => 'glyphicon-floppy-disk',
                'glyphicon-floppy-open'            => 'glyphicon-floppy-open',
                'glyphicon-floppy-remove'          => 'glyphicon-floppy-remove',
                'glyphicon-floppy-save'            => 'glyphicon-floppy-save',
                'glyphicon-floppy-saved'           => 'glyphicon-floppy-saved',
                'glyphicon-folder-close'           => 'glyphicon-folder-close',
                'glyphicon-folder-open'            => 'glyphicon-folder-open',
                'glyphicon-font'                   => 'glyphicon-font',
                'glyphicon-forward'                => 'glyphicon-forward',
                'glyphicon-fullscreen'             => 'glyphicon-fullscreen',
                'glyphicon-gbp'                    => 'glyphicon-gbp',
                'glyphicon-gift'                   => 'glyphicon-gift',
                'glyphicon-glass'                  => 'glyphicon-glass',
                'glyphicon-globe'                  => 'glyphicon-globe',
                'glyphicon-hand-down'              => 'glyphicon-hand-down',
                'glyphicon-hand-left'              => 'glyphicon-hand-left',
                'glyphicon-hand-right'             => 'glyphicon-hand-right',
                'glyphicon-hand-up'                => 'glyphicon-hand-up',
                'glyphicon-hd-video'               => 'glyphicon-hd-video',
                'glyphicon-hdd'                    => 'glyphicon-hdd',
                'glyphicon-header'                 => 'glyphicon-header',
                'glyphicon-headphones'             => 'glyphicon-headphones',
                'glyphicon-heart'                  => 'glyphicon-heart',
                'glyphicon-heart-empty'            => 'glyphicon-heart-empty',
                'glyphicon-home'                   => 'glyphicon-home',
                'glyphicon-import'                 => 'glyphicon-import',
                'glyphicon-inbox'                  => 'glyphicon-inbox',
                'glyphicon-indent-left'            => 'glyphicon-indent-left',
                'glyphicon-indent-right'           => 'glyphicon-indent-right',
                'glyphicon-info-sign'              => 'glyphicon-info-sign',
                'glyphicon-italic'                 => 'glyphicon-italic',
                'glyphicon-leaf'                   => 'glyphicon-leaf',
                'glyphicon-link'                   => 'glyphicon-link',
                'glyphicon-list'                   => 'glyphicon-list',
                'glyphicon-list-alt'               => 'glyphicon-list-alt',
                'glyphicon-lock'                   => 'glyphicon-lock',
                'glyphicon-log-in'                 => 'glyphicon-log-in',
                'glyphicon-log-out'                => 'glyphicon-log-out',
                'glyphicon-magnet'                 => 'glyphicon-magnet',
                'glyphicon-map-marker'             => 'glyphicon-map-marker',
                'glyphicon-minus'                  => 'glyphicon-minus',
                'glyphicon-minus-sign'             => 'glyphicon-minus-sign',
                'glyphicon-move'                   => 'glyphicon-move',
                'glyphicon-music'                  => 'glyphicon-music',
                'glyphicon-new-window'             => 'glyphicon-new-window',
                'glyphicon-off'                    => 'glyphicon-off',
                'glyphicon-ok'                     => 'glyphicon-ok',
                'glyphicon-ok-circle'              => 'glyphicon-ok-circle',
                'glyphicon-ok-sign'                => 'glyphicon-ok-sign',
                'glyphicon-open'                   => 'glyphicon-open',
                'glyphicon-paperclip'              => 'glyphicon-paperclip',
                'glyphicon-pause'                  => 'glyphicon-pause',
                'glyphicon-pencil'                 => 'glyphicon-pencil',
                'glyphicon-phone'                  => 'glyphicon-phone',
                'glyphicon-phone-alt'              => 'glyphicon-phone-alt',
                'glyphicon-picture'                => 'glyphicon-picture',
                'glyphicon-plane'                  => 'glyphicon-plane',
                'glyphicon-play'                   => 'glyphicon-play',
                'glyphicon-play-circle'            => 'glyphicon-play-circle',
                'glyphicon-plus'                   => 'glyphicon-plus',
                'glyphicon-plus-sign'              => 'glyphicon-plus-sign',
                'glyphicon-print'                  => 'glyphicon-print',
                'glyphicon-pushpin'                => 'glyphicon-pushpin',
                'glyphicon-qrcode'                 => 'glyphicon-qrcode',
                'glyphicon-question-sign'          => 'glyphicon-question-sign',
                'glyphicon-random'                 => 'glyphicon-random',
                'glyphicon-record'                 => 'glyphicon-record',
                'glyphicon-refresh'                => 'glyphicon-refresh',
                'glyphicon-registration-mark'      => 'glyphicon-registration-mark',
                'glyphicon-remove'                 => 'glyphicon-remove',
                'glyphicon-remove-circle'          => 'glyphicon-remove-circle',
                'glyphicon-remove-sign'            => 'glyphicon-remove-sign',
                'glyphicon-repeat'                 => 'glyphicon-repeat',
                'glyphicon-resize-full'            => 'glyphicon-resize-full',
                'glyphicon-resize-horizontal'      => 'glyphicon-resize-horizontal',
                'glyphicon-resize-small'           => 'glyphicon-resize-small',
                'glyphicon-resize-vertical'        => 'glyphicon-resize-vertical',
                'glyphicon-retweet'                => 'glyphicon-retweet',
                'glyphicon-road'                   => 'glyphicon-road',
                'glyphicon-save'                   => 'glyphicon-save',
                'glyphicon-saved'                  => 'glyphicon-saved',
                'glyphicon-screenshot'             => 'glyphicon-screenshot',
                'glyphicon-sd-video'               => 'glyphicon-sd-video',
                'glyphicon-search'                 => 'glyphicon-search',
                'glyphicon-send'                   => 'glyphicon-send',
                'glyphicon-share'                  => 'glyphicon-share',
                'glyphicon-share-alt'              => 'glyphicon-share-alt',
                'glyphicon-shopping-cart'          => 'glyphicon-shopping-cart',
                'glyphicon-signal'                 => 'glyphicon-signal',
                'glyphicon-sort'                   => 'glyphicon-sort',
                'glyphicon-sort-by-alphabet'       => 'glyphicon-sort-by-alphabet',
                'glyphicon-sort-by-alphabet-alt'   => 'glyphicon-sort-by-alphabet-alt',
                'glyphicon-sort-by-attributes'     => 'glyphicon-sort-by-attributes',
                'glyphicon-sort-by-attributes-alt' => 'glyphicon-sort-by-attributes-alt',
                'glyphicon-sort-by-order'          => 'glyphicon-sort-by-order',
                'glyphicon-sort-by-order-alt'      => 'glyphicon-sort-by-order-alt',
                'glyphicon-sound-5-1'              => 'glyphicon-sound-5-1',
                'glyphicon-sound-6-1'              => 'glyphicon-sound-6-1',
                'glyphicon-sound-7-1'              => 'glyphicon-sound-7-1',
                'glyphicon-sound-dolby'            => 'glyphicon-sound-dolby',
                'glyphicon-sound-stereo'           => 'glyphicon-sound-stereo',
                'glyphicon-star'                   => 'glyphicon-star',
                'glyphicon-star-empty'             => 'glyphicon-star-empty',
                'glyphicon-stats'                  => 'glyphicon-stats',
                'glyphicon-step-backward'          => 'glyphicon-step-backward',
                'glyphicon-step-forward'           => 'glyphicon-step-forward',
                'glyphicon-stop'                   => 'glyphicon-stop',
                'glyphicon-subtitles'              => 'glyphicon-subtitles',
                'glyphicon-tag'                    => 'glyphicon-tag',
                'glyphicon-tags'                   => 'glyphicon-tags',
                'glyphicon-tasks'                  => 'glyphicon-tasks',
                'glyphicon-text-height'            => 'glyphicon-text-height',
                'glyphicon-text-width'             => 'glyphicon-text-width',
                'glyphicon-th'                     => 'glyphicon-th',
                'glyphicon-th-large'               => 'glyphicon-th-large',
                'glyphicon-th-list'                => 'glyphicon-th-list',
                'glyphicon-thumbs-down'            => 'glyphicon-thumbs-down',
                'glyphicon-thumbs-up'              => 'glyphicon-thumbs-up',
                'glyphicon-time'                   => 'glyphicon-time',
                'glyphicon-tint'                   => 'glyphicon-tint',
                'glyphicon-tower'                  => 'glyphicon-tower',
                'glyphicon-transfer'               => 'glyphicon-transfer',
                'glyphicon-trash'                  => 'glyphicon-trash',
                'glyphicon-tree-conifer'           => 'glyphicon-tree-conifer',
                'glyphicon-tree-deciduous'         => 'glyphicon-tree-deciduous',
                'glyphicon-unchecked'              => 'glyphicon-unchecked',
                'glyphicon-upload'                 => 'glyphicon-upload',
                'glyphicon-usd'                    => 'glyphicon-usd',
                'glyphicon-user'                   => 'glyphicon-user',
                'glyphicon-volume-down'            => 'glyphicon-volume-down',
                'glyphicon-volume-off'             => 'glyphicon-volume-off',
                'glyphicon-volume-up'              => 'glyphicon-volume-up',
                'glyphicon-warning-sign'           => 'glyphicon-warning-sign',
                'glyphicon-wrench'                 => 'glyphicon-wrench',
                'glyphicon-zoom-in'                => 'glyphicon-zoom-in',
                'glyphicon-zoom-out'               => 'glyphicon-zoom-out',
            ];
        }

        //
        // ICONS
        // --------------------------------------------------
        const ICON_ADJUST                 = 'glyphicon-adjust';
        const ICON_ALIGN_CENTER           = 'glyphicon-align-center';
        const ICON_ALIGN_JUSTIFY          = 'glyphicon-align-justify';
        const ICON_ALIGN_LEFT             = 'glyphicon-align-left';
        const ICON_ALIGN_RIGHT            = 'glyphicon-align-right';
        const ICON_ARROW_DOWN             = 'glyphicon-arrow-down';
        const ICON_ARROW_LEFT             = 'glyphicon-arrow-left';
        const ICON_ARROW_RIGHT            = 'glyphicon-arrow-right';
        const ICON_ARROW_UP               = 'glyphicon-arrow-up';
        const ICON_ASTERISK               = 'glyphicon-asterisk';
        const ICON_BACKWARD               = 'glyphicon-backward';
        const ICON_BAN_CIRCLE             = 'glyphicon-ban-circle';
        const ICON_BARCODE                = 'glyphicon-barcode';
        const ICON_BELL                   = 'glyphicon-bell';
        const ICON_BOLD                   = 'glyphicon-bold';
        const ICON_BOOK                   = 'glyphicon-book';
        const ICON_BOOKMARK               = 'glyphicon-bookmark';
        const ICON_BRIEFCASE              = 'glyphicon-briefcase';
        const ICON_BULLHORN               = 'glyphicon-bullhorn';
        const ICON_CALENDAR               = 'glyphicon-calendar';
        const ICON_CAMERA                 = 'glyphicon-camera';
        const ICON_CERTIFICATE            = 'glyphicon-certificate';
        const ICON_CHECK                  = 'glyphicon-check';
        const ICON_CHEVRON_DOWN           = 'glyphicon-chevron-down';
        const ICON_CHEVRON_LEFT           = 'glyphicon-chevron-left';
        const ICON_CHEVRON_RIGHT          = 'glyphicon-chevron-right';
        const ICON_CHEVRON_UP             = 'glyphicon-chevron-up';
        const ICON_CIRCLE_ARROW_DOWN      = 'glyphicon-circle-arrow-down';
        const ICON_CIRCLE_ARROW_LEFT      = 'glyphicon-circle-arrow-left';
        const ICON_CIRCLE_ARROW_RIGHT     = 'glyphicon-circle-arrow-right';
        const ICON_CIRCLE_ARROW_UP        = 'glyphicon-circle-arrow-up';
        const ICON_CLOUD                  = 'glyphicon-cloud';
        const ICON_CLOUD_DOWNLOAD         = 'glyphicon-cloud-download';
        const ICON_CLOUD_UPLOAD           = 'glyphicon-cloud-upload';
        const ICON_COG                    = 'glyphicon-cog';
        const ICON_COLLAPSE_DOWN          = 'glyphicon-collapse-down';
        const ICON_COLLAPSE_UP            = 'glyphicon-collapse-up';
        const ICON_COMMENT                = 'glyphicon-comment';
        const ICON_COMPRESSED             = 'glyphicon-compressed';
        const ICON_COPYRIGHT_MARK         = 'glyphicon-copyright-mark';
        const ICON_CREDIT_CARD            = 'glyphicon-credit-card';
        const ICON_CUTLERY                = 'glyphicon-cutlery';
        const ICON_DASHBOARD              = 'glyphicon-dashboard';
        const ICON_DOWNLOAD               = 'glyphicon-download';
        const ICON_DOWNLOAD_ALT           = 'glyphicon-download-alt';
        const ICON_EARPHONE               = 'glyphicon-earphone';
        const ICON_EDIT                   = 'glyphicon-edit';
        const ICON_EJECT                  = 'glyphicon-eject';
        const ICON_ENVELOPE               = 'glyphicon-envelope';
        const ICON_EURO                   = 'glyphicon-euro';
        const ICON_EXCLAMATION_SIGN       = 'glyphicon-exclamation-sign';
        const ICON_EXPAND                 = 'glyphicon-expand';
        const ICON_EXPORT                 = 'glyphicon-export';
        const ICON_EYE_CLOSE              = 'glyphicon-eye-close';
        const ICON_EYE_OPEN               = 'glyphicon-eye-open';
        const ICON_FACETIME_VIDEO         = 'glyphicon-facetime-video';
        const ICON_FAST_BACKWARD          = 'glyphicon-fast-backward';
        const ICON_FAST_FORWARD           = 'glyphicon-fast-forward';
        const ICON_FILE                   = 'glyphicon-file';
        const ICON_FILM                   = 'glyphicon-film';
        const ICON_FILTER                 = 'glyphicon-filter';
        const ICON_FIRE                   = 'glyphicon-fire';
        const ICON_FLAG                   = 'glyphicon-flag';
        const ICON_FLASH                  = 'glyphicon-flash';
        const ICON_FLOPPY_DISK            = 'glyphicon-floppy-disk';
        const ICON_FLOPPY_OPEN            = 'glyphicon-floppy-open';
        const ICON_FLOPPY_REMOVE          = 'glyphicon-floppy-remove';
        const ICON_FLOPPY_SAVE            = 'glyphicon-floppy-save';
        const ICON_FLOPPY_SAVED           = 'glyphicon-floppy-saved';
        const ICON_FOLDER_CLOSE           = 'glyphicon-folder-close';
        const ICON_FOLDER_OPEN            = 'glyphicon-folder-open';
        const ICON_FONT                   = 'glyphicon-font';
        const ICON_FORWARD                = 'glyphicon-forward';
        const ICON_FULLSCREEN             = 'glyphicon-fullscreen';
        const ICON_GBP                    = 'glyphicon-gbp';
        const ICON_GIFT                   = 'glyphicon-gift';
        const ICON_GLASS                  = 'glyphicon-glass';
        const ICON_GLOBE                  = 'glyphicon-globe';
        const ICON_HAND_DOWN              = 'glyphicon-hand-down';
        const ICON_HAND_LEFT              = 'glyphicon-hand-left';
        const ICON_HAND_RIGHT             = 'glyphicon-hand-right';
        const ICON_HAND_UP                = 'glyphicon-hand-up';
        const ICON_HD_VIDEO               = 'glyphicon-hd-video';
        const ICON_HDD                    = 'glyphicon-hdd';
        const ICON_HEADER                 = 'glyphicon-header';
        const ICON_HEADPHONES             = 'glyphicon-headphones';
        const ICON_HEART                  = 'glyphicon-heart';
        const ICON_HEART_EMPTY            = 'glyphicon-heart-empty';
        const ICON_HOME                   = 'glyphicon-home';
        const ICON_IMPORT                 = 'glyphicon-import';
        const ICON_INBOX                  = 'glyphicon-inbox';
        const ICON_INDENT_LEFT            = 'glyphicon-indent-left';
        const ICON_INDENT_RIGHT           = 'glyphicon-indent-right';
        const ICON_INFO_SIGN              = 'glyphicon-info-sign';
        const ICON_ITALIC                 = 'glyphicon-italic';
        const ICON_LEAF                   = 'glyphicon-leaf';
        const ICON_LINK                   = 'glyphicon-link';
        const ICON_LIST                   = 'glyphicon-list';
        const ICON_LIST_ALT               = 'glyphicon-list-alt';
        const ICON_LOCK                   = 'glyphicon-lock';
        const ICON_LOG_IN                 = 'glyphicon-log-in';
        const ICON_LOG_OUT                = 'glyphicon-log-out';
        const ICON_MAGNET                 = 'glyphicon-magnet';
        const ICON_MAP_MARKER             = 'glyphicon-map-marker';
        const ICON_MINUS                  = 'glyphicon-minus';
        const ICON_MINUS_SIGN             = 'glyphicon-minus-sign';
        const ICON_MOVE                   = 'glyphicon-move';
        const ICON_MUSIC                  = 'glyphicon-music';
        const ICON_NEW_WINDOW             = 'glyphicon-new-window';
        const ICON_OFF                    = 'glyphicon-off';
        const ICON_OK                     = 'glyphicon-ok';
        const ICON_OK_CIRCLE              = 'glyphicon-ok-circle';
        const ICON_OK_SIGN                = 'glyphicon-ok-sign';
        const ICON_OPEN                   = 'glyphicon-open';
        const ICON_PAPERCLIP              = 'glyphicon-paperclip';
        const ICON_PAUSE                  = 'glyphicon-pause';
        const ICON_PENCIL                 = 'glyphicon-pencil';
        const ICON_PHONE                  = 'glyphicon-phone';
        const ICON_PHONE_ALT              = 'glyphicon-phone-alt';
        const ICON_PICTURE                = 'glyphicon-picture';
        const ICON_PLANE                  = 'glyphicon-plane';
        const ICON_PLAY                   = 'glyphicon-play';
        const ICON_PLAY_CIRCLE            = 'glyphicon-play-circle';
        const ICON_PLUS                   = 'glyphicon-plus';
        const ICON_PLUS_SIGN              = 'glyphicon-plus-sign';
        const ICON_PRINT                  = 'glyphicon-print';
        const ICON_PUSHPIN                = 'glyphicon-pushpin';
        const ICON_QRCODE                 = 'glyphicon-qrcode';
        const ICON_QUESTION_SIGN          = 'glyphicon-question-sign';
        const ICON_RANDOM                 = 'glyphicon-random';
        const ICON_RECORD                 = 'glyphicon-record';
        const ICON_REFRESH                = 'glyphicon-refresh';
        const ICON_REGISTRATION_MARK      = 'glyphicon-registration-mark';
        const ICON_REMOVE                 = 'glyphicon-remove';
        const ICON_REMOVE_CIRCLE          = 'glyphicon-remove-circle';
        const ICON_REMOVE_SIGN            = 'glyphicon-remove-sign';
        const ICON_REPEAT                 = 'glyphicon-repeat';
        const ICON_RESIZE_FULL            = 'glyphicon-resize-full';
        const ICON_RESIZE_HORIZONTAL      = 'glyphicon-resize-horizontal';
        const ICON_RESIZE_SMALL           = 'glyphicon-resize-small';
        const ICON_RESIZE_VERTICAL        = 'glyphicon-resize-vertical';
        const ICON_RETWEET                = 'glyphicon-retweet';
        const ICON_ROAD                   = 'glyphicon-road';
        const ICON_SAVE                   = 'glyphicon-save';
        const ICON_SAVED                  = 'glyphicon-saved';
        const ICON_SCREENSHOT             = 'glyphicon-screenshot';
        const ICON_SD_VIDEO               = 'glyphicon-sd-video';
        const ICON_SEARCH                 = 'glyphicon-search';
        const ICON_SEND                   = 'glyphicon-send';
        const ICON_SHARE                  = 'glyphicon-share';
        const ICON_SHARE_ALT              = 'glyphicon-share-alt';
        const ICON_SHOPPING_CART          = 'glyphicon-shopping-cart';
        const ICON_SIGNAL                 = 'glyphicon-signal';
        const ICON_SORT                   = 'glyphicon-sort';
        const ICON_SORT_BY_ALPHABET       = 'glyphicon-sort-by-alphabet';
        const ICON_SORT_BY_ALPHABET_ALT   = 'glyphicon-sort-by-alphabet-alt';
        const ICON_SORT_BY_ATTRIBUTES     = 'glyphicon-sort-by-attributes';
        const ICON_SORT_BY_ATTRIBUTES_ALT = 'glyphicon-sort-by-attributes-alt';
        const ICON_SORT_BY_ORDER          = 'glyphicon-sort-by-order';
        const ICON_SORT_BY_ORDER_ALT      = 'glyphicon-sort-by-order-alt';
        const ICON_SOUND_5_1              = 'glyphicon-sound-5-1';
        const ICON_SOUND_6_1              = 'glyphicon-sound-6-1';
        const ICON_SOUND_7_1              = 'glyphicon-sound-7-1';
        const ICON_SOUND_DOLBY            = 'glyphicon-sound-dolby';
        const ICON_SOUND_STEREO           = 'glyphicon-sound-stereo';
        const ICON_STAR                   = 'glyphicon-star';
        const ICON_STAR_EMPTY             = 'glyphicon-star-empty';
        const ICON_STATS                  = 'glyphicon-stats';
        const ICON_STEP_BACKWARD          = 'glyphicon-step-backward';
        const ICON_STEP_FORWARD           = 'glyphicon-step-forward';
        const ICON_STOP                   = 'glyphicon-stop';
        const ICON_SUBTITLES              = 'glyphicon-subtitles';
        const ICON_TAG                    = 'glyphicon-tag';
        const ICON_TAGS                   = 'glyphicon-tags';
        const ICON_TASKS                  = 'glyphicon-tasks';
        const ICON_TEXT_HEIGHT            = 'glyphicon-text-height';
        const ICON_TEXT_WIDTH             = 'glyphicon-text-width';
        const ICON_TH                     = 'glyphicon-th';
        const ICON_TH_LARGE               = 'glyphicon-th-large';
        const ICON_TH_LIST                = 'glyphicon-th-list';
        const ICON_THUMBS_DOWN            = 'glyphicon-thumbs-down';
        const ICON_THUMBS_UP              = 'glyphicon-thumbs-up';
        const ICON_TIME                   = 'glyphicon-time';
        const ICON_TINT                   = 'glyphicon-tint';
        const ICON_TOWER                  = 'glyphicon-tower';
        const ICON_TRANSFER               = 'glyphicon-transfer';
        const ICON_TRASH                  = 'glyphicon-trash';
        const ICON_TREE_CONIFER           = 'glyphicon-tree-conifer';
        const ICON_TREE_DECIDUOUS         = 'glyphicon-tree-deciduous';
        const ICON_UNCHECKED              = 'glyphicon-unchecked';
        const ICON_UPLOAD                 = 'glyphicon-upload';
        const ICON_USD                    = 'glyphicon-usd';
        const ICON_USER                   = 'glyphicon-user';
        const ICON_VOLUME_DOWN            = 'glyphicon-volume-down';
        const ICON_VOLUME_OFF             = 'glyphicon-volume-off';
        const ICON_VOLUME_UP              = 'glyphicon-volume-up';
        const ICON_WARNING_SIGN           = 'glyphicon-warning-sign';
        const ICON_WRENCH                 = 'glyphicon-wrench';
        const ICON_ZOOM_IN                = 'glyphicon-zoom-in';
        const ICON_ZOOM_OUT               = 'glyphicon-zoom-out';
    }