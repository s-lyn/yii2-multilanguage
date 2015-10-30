<?php

namespace pjhl\multilanguage\components\grid;
use yii\grid\DataColumn;
use pjhl\multilanguage\helpers\Languages;
use yii\helpers\Html;

class LanguageColumn extends DataColumn {
    
    public $header = 'Edit Language';
    public $format = 'html';
    
    private function issetContent($model, $lang_id) {
        if ($model && $model->contentAll && is_array($model->contentAll)) {
            foreach ($model->contentAll as $modelContent) {
                if ($modelContent && $modelContent->lang_id === $lang_id) {
                    return true;
                }
            }
        }
        return false;
    }
    
    public function getDataCellValue($model, $key, $index) {
        
        $list = Languages::all()->getConfig();
        $items = [];
        foreach ($list as $id => $lang) {
            $items[] = Html::a($lang['name'], ['update', 'id'=>$model->id, 'lang_id'=>$lang['id']], [
                'class'=> $this->issetContent($model, $lang['id']) 
                        ? 'btn btn-primary' 
                        : 'btn btn-default'
                ]);
        }
        return implode(' ', $items);
    }
    
}