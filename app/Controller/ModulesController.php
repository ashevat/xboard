<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ModulesController extends AppController {

	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
	public $components = array('Session','RequestHandler', 'Usermgmt.UserAuth');

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Modules';

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array("Plugin","PluginCategories","PluginAuthors", "PluginsStartups");

	
	public function admin() {

		//$this->set("starupId",$starupId);

		//iterate over all plugin folders and load them into the plugin tables
		//note: this has nothing to do with the assigment of a plugin to a user or startup
		chdir('../plugin');

		//path to directory to scan
		//Note: this should be sortable eventually
		$directory = getcwd();
		$dirs = array_filter(glob('*'), 'is_dir');
		$numberOPlugins = sizeof($dirs);

		$domInput = new DOMDocument();
		$filename = 'description.xml';

		//dummy info
		$categoryID = '1';
		$authorID = '1';
		$username = 'root';
		$password = '';
		$dbHostName = 'localhost';

		$connection = mysqli_connect($dbHostName, $username, $password, "xboard");

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}//if




		//mysql_select_db("xboard", $con);


		for ($i = 0; $i < $numberOPlugins; $i++) {

			chdir($dirs[$i]);

			if (file_exists($filename)) {

				$domInput->load($filename);

				foreach ($domInput->getElementsByTagName('plugin_info') as $entry) {
					$name = $entry->getElementsByTagName('name')->item(0)->textContent;
					$version = $entry->getElementsByTagName('version')->item(0)->textContent;
					$category = $entry->getElementsByTagName('category')->item(0)->textContent;
					$tag_line = $entry->getElementsByTagName('tag_line')->item(0)->textContent;
					$description = $entry->getElementsByTagName('description')->item(0)->textContent;
					$author = $entry->getElementsByTagName('author')->item(0)->textContent;
					$expiration = $entry->getElementsByTagName('expiration')->item(0)->textContent;
					$cost = $entry->getElementsByTagName('cost')->item(0)->textContent;


					//todo: get category id from category table
					//todo: get author id from authors table


					$connection = mysqli_connect("localhost", "root", "", "xboard");


					//build the category information
					//				$result = mysqli_query($connection,"SELECT ID FROM plugin_categories WHERE name='$category'");
					$row = array();


					if ($result = mysqli_query($connection,"SELECT ID FROM plugin_categories WHERE name='$category'")){
						if ($row = mysqli_fetch_row($result)){
							$categoryID =  $row[0] ;
							/* free result set */
							mysqli_free_result($result);
						}//if
						else{
							mysqli_query($connection,"INSERT INTO plugin_categories (name, description) VALUES ('$category', 'some category description')");
							$categoryID =  mysqli_insert_id($connection) ;
						}//else
					}//if


					//build the author information
					if ($result = mysqli_query($connection,"SELECT ID FROM plugin_authors WHERE name='$author'")){
						if ($row = mysqli_fetch_row($result)){
							$authorID =  $row[0] ;
							/* free result set */
							mysqli_free_result($result);
						}//if
						else{
							mysqli_query($connection,"INSERT INTO plugin_authors (name, info) VALUES ('$author', 'some author description')");
							$authorID =  mysqli_insert_id($connection) ;
						}//else
					}//if


					$sql_q = "INSERT INTO plugins (name, version, category,tag_line,description,author,expiration,cost) VALUES ('$name', '$version',$categoryID,'$tag_line','$description',$authorID,'$expiration','$cost')";
					mysqli_query($connection,$sql_q);

					mysqli_close($connection);
				}//foreach
			}//if
			chdir('..');
		}//for

		//get active plugins
		$this->PluginCategories->bindModel(
				array('hasMany' => array(
				 'Plugin' => array(
					 'className' => 'Plugin',
					 'foreignKey'   => 'plugin_category_id'
			
					 //need to add condition / filter
					)
				)
			)
		);
		$pluginCat = $this->PluginCategories->find("all");
		$this->set("activePluginCategoties",$pluginCat);
		
		$startupid= $this->startup["Startup"]["id"];
		$curStartupPlugins = $this->PluginsStartups->find("all", array(
        				'conditions' => array('PluginsStartups.startup_id' => $startupid)
			)
		);
		
		/*
		//get non active plugins
		$this->PluginCategories->bindModel(
		array('hasMany' => array(
		 'Plugin' => array(
		 'className' => 'Plugin',
		 'foreignKey'   => 'categoryID'
		 //need to add condition / filter
		)
		)
		)
		);
		$pluginCat = $this->PluginCategories->find("all");
		$this->set("NonActivePluginCategoties",$pluginCat );
		*/

		//$this->Startup->bindModel(array('hasAndBelongsToMany'=>array('Plugin')));
		//$this->Startup->recursive = 2;

	}
	
	public function index(){
		//get active plugins
		/*
		$this->PluginCategories->bindModel(
				array('hasMany' => array(
				 'Plugin' => array(
					 'className' => 'Plugin',
					 'foreignKey'   => 'plugin_category_id'
					
					 //need to add condition / filter
					)
				)
			)
		);
		*/
		
		$startupid= $this->startup["Startup"]["id"];
		$curStartupPlugins = $this->PluginsStartups->find("all", array(
        				'conditions' => array('PluginsStartups.startup_id' => $startupid)
			)
		);
		//$startupPluginsId = Set::classicExtract($curStartupPlugins, '{n}.PluginsStartups.plugin_id');
		
		$this->set("curStartupPlugins",$curStartupPlugins);
		
		
		$pluginCat = $this->PluginCategories->find("all", array('recursive' => 2));
		$this->set("pluginCategoties",$pluginCat);
		
		
		$this->set("curStartupPlugins",$curStartupPlugins);
	
	}


	public function details($moduleID) {

	}

	public function install($moduleID) {

	}

	public function uninstall($moduleID) {

	}


	function beforeFilter(){
		parent::beforeFilter();
		$this->set('openActive','menu-marketing');
	}

}
