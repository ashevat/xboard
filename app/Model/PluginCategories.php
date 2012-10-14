<?php
class PluginCategories extends AppModel {
	public $name = 'PluginCategories';

	 public $hasMany = array(
        'CatPlugins' => array(
            'className'    => 'Plugin',
            "foreignKey" =>"plugin_category_id"
        )
    );
}
?>