<?php

use yii\helpers\Url;
use pjhl\multilanguage\Start;

/* @var $this yii\web\View */

$this->title = 'yii2-multilanguage test page';

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Index page works.</td>
                        </tr> 
                        <tr>
                            <td>Locale: <?php echo Yii::$app->language ?>;</td>
                        </tr> 
                        <tr>
                            <td>Url::home: <?php echo Url::home() ?>;</td>
                        </tr> 
                        <tr>
                            <td>Url::current: <?php echo Url::current() ?>;</td>
                        </tr> 
                        <tr>
                            <td>Url::to: <?php echo Url::to('/') ?>;</td>
                        </tr> 
                        <tr>
                            <td>Url::toRoute: <?php echo Url::toRoute('index') ?>;</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>path info:</td>
                            <td><?php echo Yii::$app->request->getPathInfo() ?></td>
                        </tr>
                        <tr>
                            <td>Start::detectLinkLang:</td>
                            <td><?php echo Start::detectLinkLang()['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Start::redirectLink(detectExpectLang):</td>
                            <td><?php echo Start::redirectLink(Start::detectExpectLang()) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-4 col-xs-offset-6">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" <?php if ($mode==0) echo 'class="active"'; ?>>
                        <a href="<?php echo Url::current(['mode'=>0]); ?>">Pretty url</a>
                    </li>
                    <li role="presentation" <?php if ($mode==1) echo 'class="active"'; ?>>
                        <a href="<?php echo Url::current(['mode'=>1]); ?>">With script filename</a>
                    </li>
                    <li role="presentation" <?php if ($mode==2) echo 'class="active"'; ?>>
                        <a href="<?php echo Url::current(['mode'=>2]); ?>">Not pretty url</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
