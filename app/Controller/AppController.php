<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $uses = array('Usermgmt.User', 'Usermgmt.UserGroup','Startup', 'StartupUsers','Plugin',"PluginCategories","PluginAuthors", "PluginsStartups");

	public $startup;
	public $user;
	public $starupIdGlobal;
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
	public $components = array('Session','RequestHandler', 'Usermgmt.UserAuth');
	
	
	
	function beforeFilter(){
		$this->userAuth();
			
		$userId = $this->UserAuth->getUserId();
		$user = $this->User->read(null, $userId);
		$this->user = $user;
		$user['UserGroup']['name']=$this->UserGroup->getGroupsByIds($user['User']['user_group_id']);
		$this->set('user', $user);
		if(isset($user['User'])){
			$starupId = $this->Session->read('User.'.$userId.'.startup_id');

			//echo "got here".$starupId;
			$this->startup  =  $starupId;
			if(!$starupId){
				// find startup
				$startupRef = $this->StartupUsers->find('first', array(
        				'conditions' => array('StartupUsers.user_id' => $userId)
				));

				if(!empty($startupRef)){
					$starupId = $startupRef["StartupUsers"]["startup_id"];
					$this->Session->write('User.'.$userId.'.startup_id',$starupId );
				}
			}

			if($starupId){
				$startup  = $this->Startup->read(null, $starupId);
				if(!empty($startup)){
					$this->set('startup', $startup);
					$this->startup = $startup;


				}else{
					// startup was deleted
					$this->Session->delete('User.'.$userId.'.startup_id');
				}
					
			}


			$startupid = $this->startup["Startup"]["id"];

			$curStartupPlugins = $this->PluginsStartups->find("all", array(
			'conditions' => array('PluginsStartups.startup_id' => $startupid)
			)
			);
			//$startupPluginsId = Set::classicExtract($curStartupPlugins, '{n}.PluginsStartups.plugin_id');

			$this->set("curStartupPlugins",$curStartupPlugins);


			$pluginCat = $this->PluginCategories->find("all", array('recursive' => 2));
			$this->set("pluginCategories",$pluginCat);


			$this->set("curStartupPlugins",$curStartupPlugins);
			
		}
		
	}


	private function userAuth(){
		$this->UserAuth->beforeFilter($this);
	}

	//Info / Warn / Error - will give the relevant classes.
	public function notify($message, $type="Info") {
		$this->Session->setFlash(h($message,"flash$type"));	
	}
	
}
