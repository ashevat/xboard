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
class BasicsController extends AppController {
	
	var $helpers = array('Form', 'Html', 'Session', 'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
    public $components = array('Session','RequestHandler', 'Usermgmt.UserAuth');
    
    public $defaultStartupName = "Great Idea";
    Public $defaultRole = 5;

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Basics';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array("Role", "Startup","StartupInvites","StartupUsers");

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function index() {
		$this->set('openActive','menu-home');
	}
	
	public function name() {
		
	}
	
	public function team() {
		if (!empty($this->data)) {
			$mateName = $this->data["Basic"]["Mate Name"];
			$mateEmail = $this->data["Basic"]["Mate Email"];
			$mateRoleId = $this->data["Basic"]["Mate Role"];
			
			// create a default startup if needed
			$this->createDefaultStartup();
			//save and send the invite
			$invite = array(
				"StartupInvites" => array(
					"startup_id" =>$this->startup["Startup"]["id"],
					"inviter_id"=>$this->UserAuth->getUserId(),
					"invitee_email"=>$mateEmail,
					"invitee_name"=>$mateName,
					"invitee_role_id"=>$mateRoleId,
					"active"=>1
					
			    )
			);
			//save invite
			$this->StartupInvites->create();
			$this->StartupInvites->save($invite);
			
			$intiveId  = $this->StartupInvites->id;
			$intiveIdHash = md5($intiveId."44364634612116ggg");
			// send email invite
			$email = new CakeEmail();
			$email->from(array('me@example.com' => 'My Site'));
			$email->emailFormat('html');
			$email->template('invitemate', 'invites');
			$email->viewVars(array('link' => "http://xboard.co/basic/team/invite/".$intiveId."/".$intiveIdHash));
			$email->to($mateEmail);
			$email->subject('Join our startup at StartHub');
			//$email->send();
			
			$this->data = null;
		}
		
		
		if(isset($this->startup)){
			$invites = $this->StartupInvites->find('all', array(
        				'conditions' => array('StartupInvites.startup_id' => $this->startup["Startup"]["id"])
    				));
    				
    		$this->set('invites', $invites);
			
		}
		
    	
		$roles  = $this->Role->find('all');
		$this->set('roles', $roles);
	}
	
	private function createDefaultStartup(){
			if(!isset($this->startup)){
		
				$startup = array(
					"Startup"=>array(
						"name" => $this->defaultStartupName,
					)
				);
				$this->Startup->create();
				$this->Startup->save($startup);
				$startup["Startup"]["id"] = $this->Startup->id;
				$this->startup = $startup;
				
				// connect user to the default startup
				$startup_user = array(
					"StartupUsers"=>array(
						"startup_id" => $this->Startup->id,
						"user_id" => $this->UserAuth->getUserId(),
					)
				);
				
				$this->StartupUsers->create();
				$this->StartupUsers->save($startup_user);
			}
	}
	
	public function overview() {
	
	}

	function beforeFilter(){
		
		parent::beforeFilter();
		$this->set('openActive','menu-basics');
	}
	
}
