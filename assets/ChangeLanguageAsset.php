<?php

namespace pjhl\multilanguage\assets;

use yii\web\AssetBundle;

class ChangeLanguageAsset extends AssetBundle {

    public $sourcePath = '@pjhl/multilanguage/assets/static';
    
    public $css = [
        
    ];
    
    public $js = [
        'ChangeLanguage.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
        'pjhl\multilanguage\assets\JQueryCookieAsset',
    ];

}
