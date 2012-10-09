<?php
class Plugin extends AppModel {
	public $name = 'Plugin';

	public $belongsTo = array('PluginAuthor','PluginCategory');
}
?>