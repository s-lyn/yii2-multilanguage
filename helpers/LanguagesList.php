<?php

namespace pjhl\multilanguage\helpers;
use Yii;

class LanguagesList {
    
    private $languages = [];
    
    public function __construct() {
        $languages = Yii::$app->params['languages'];
        if (is_array($languages)) {
            foreach ($languages as $lang) {
                if (!isset($lang['id'])) {
                    throw new Exception ('Key "id" not found in Yii::$app->params["languages"][...].');
                } else {
                    $id = intval($lang['id']);
                    if (isset($this->languages[$id])) {
                        throw new Exception ('Dublicate key "id" in Yii::$app->params["languages"][...].');
                    }
                    $this->languages[$id] = [
                        'id' => $id,
                        'url' => $lang['url'],
                        'locale' => $lang['locale'],
                        'name' => $lang['name'],
                        'default' => isset($lang['default']) && $lang['default'] ? true : false,
                    ];
                }
            }
        } else {
            throw new Exception ('Yii::$app->params["languages"] is not set.');
        }
    }
    
    /**
     * Получить настройки языка по его ID
     * @param integer $id   Language id
     * @return array|null   Config array or NULL
     */
    public function getConfigById($id) {
        if (isset($this->languages[$id])) {
            return $this->languages[$id];
        } else
            return null;
    }
    
    /**
     * Получение настроек стандартного языка
     * @return array|null   Config array or NULL
     */
    public function getConfigDefault() {
        return $this->getConfigByParam('default', true);
    }
    
    /**
     * Получение настроек текущего языка
     * @return array|null   Config array or NULL
     */
    public function getConfigCurrent() {
        return $this->getConfigByParam('locale', Yii::$app->language);
    }
    
    
    
    /**
     * Получить настройки языка по значению его параметра
     * @param string $name   Name
     * @param mixed $value   Value
     * @return array|null   Config array or NULL
     */
    public function getConfigByParam($name, $value) {
        foreach ($this->languages as $lang) {
            if (isset($lang[ $name ]) && $lang[ $name ] == $value) {
                return $lang;
            }
        }
        return null;
    }
    
    public function getConfig() {
        return $this->languages;
    }
    
    public function pattern() {
        $list = [];
        foreach ($this->languages as $lang) {
            if ($lang['url']) {
                $list[] = '('.preg_quote($lang['url'], '/').')';
            }
        }
        return implode('|',$list);
    }
    
    public function dropdownData() {
        $data = [];
        foreach ($this->languages as $lang) {
            $data[ $lang['id'] ] = $lang['name'];
        }
        return $data;
    }
    
}