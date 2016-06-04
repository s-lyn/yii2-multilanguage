<?php

namespace pjhl\multilanguage\components\grid;
use yii\grid\DataColumn;
use pjhl\multilanguage\helpers\Languages;
use yii\helpers\Html;

class LanguageColumn extends DataColumn {
    
    public $header = 'Edit';
    public $format = 'html';
    // Use short names in button`s text
    public $useShortNames = false;
    // Action for links
    public $useAction = 'update';
    // Link`s styles
    public $linkActiveClass = 'btn btn-primary btn-xs';
    public $linkInactiveClass = 'btn btn-default btn-xs';
    
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
            $isContentIsset = $this->issetContent($model, $lang['id']);
            $text = $this->useShortNames
                    ? $lang['locale']
                    : $lang['name'];
            $options = [
                'class'=> $isContentIsset
                        ? $this->linkActiveClass
                        : $this->linkInactiveClass,
            ];
            $link = [
                $this->useAction,
                'id' => $model->id,
                'lang_id' => $lang['id'],
            ];
            $items[] = Html::a($text, $link, $options);
        }
        return implode(' ', $items);
    }
    
}