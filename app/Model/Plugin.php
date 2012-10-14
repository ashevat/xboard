<?php
class Plugin extends AppModel {
	public $name = 'Plugin';

	 public $belongsTo = array(
        'OfAuthor' => array(
            'className'    => 'PluginAuthors',
            "foreignKey" =>"plugin_author_id"
        )//,
         //'OfCategory' => array(
        //    'className'    => 'PluginCategories',
       //     "foreignKey" =>"plugin_category_id"
       // )
    );
}
?>