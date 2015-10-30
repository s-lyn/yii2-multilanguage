<?php

namespace pjhl\multilanguage\components;
use Yii;

trait BackendModelTrait {
    
    public function getContentCacheDependencyKey() {
        
        $key = 'id';
        if (property_exists($this, 'contentCacheDependency') && $this->contentCacheDependency) {
            $key = $this->contentCacheDependency;
        }
        return $this->{$key};
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentAll() {
        $contentModelName = $this->getContentModelName();
        if ($contentModelName)
            return $this->hasMany($contentModelName::className(), ['parent_id' => 'id']);
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if (!$insert) {
            $cache = Yii::$app->cache;
            foreach (Yii::$app->params['languages'] as $lang_id => $lang) {
                $cacheKey = static::getContentCacheKey($this->getContentCacheDependencyKey(), $lang_id);
                $res = $cache->delete($cacheKey);
            }
        }
    }
    
}