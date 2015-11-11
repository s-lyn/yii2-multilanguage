<?php

namespace pjhl\multilanguage\assets;

use yii\web\AssetBundle;

class JQueryCookieAsset extends AssetBundle {

    public $sourcePath = '@bower/jquery-cookie';
    
    public $css = [
        
    ];
    
    public $js = [
        'src/jquery.cookie.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
