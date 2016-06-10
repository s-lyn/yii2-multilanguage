<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'yii2-multilanguage functional test';

?>
<div class="site-index">

    <div class="body-content">

        <p id="test1">
            Language: <?php echo Yii::$app->language; ?>.
        </p>

    </div>
</div>
