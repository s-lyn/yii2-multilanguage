<?php

namespace pjhl\multilanguage\components;
use Yii;

trait BackendModelTrait {
    
    /**
     * Returns list af all language versions
     * @return \yii\db\ActiveQuery
     */
    public function getContentAll() {
        $contentModelName = $this->getContentModelName();
        if ($contentModelName)
            return $this->hasMany($contentModelName::className(), ['parent_id' => 'id']);
    }
    
}