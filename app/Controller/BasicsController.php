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
    
    private $inviteSalt = "54235646fgbdfghfghdf36h5y53h53h35jmn45jm";

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
	
	
	public function invited($invitationId, $hash){
		$intiveIdHash = md5($invitationId.$this->inviteSalt);
		if($intiveIdHash != $hash){
			//looks like a hack
			$this->set('inviteStatus', -1);
			$this->set('inviteStatusText', "Invalid Invitation");
		}else{
			$invite = $this->StartupInvites->find('first', array(
        				'conditions' => array('StartupInvites.id' => $invitationId)
    				));
    		if(isset($invite) && !empty($invite) &&  $invite["StartupInvites"]["active"]){
				if(isset($this->user['User'])){
					
					if(!$invite["StartupInvites"]["accepted"]){
						$starupId = $invite["StartupInvites"]["startup_id"];
						$startup  = $this->Startup->read(null,$starupId );
						$userId = $this->UserAuth->getUserId();
						
						if( $invite["StartupInvites"]["inviter_id"] == $userId){
							// inviter activated his own invitation 
						
							$this->set('inviteStatus', -5);
							$this->set('inviteStatusText', "Signed-in as inviter");
						}else if(empty($startup)){
							
							// startup not found
							$this->set('inviteStatus', -3);
							$this->set('inviteStatusText', "Invalid Startup Invitation");
							
							
						}else{
							
							// all is well!!!
							$this->Session->write('User.'.$userId.'.startup_id',$starupId );
							$this->set('startup', $startup);
							$this->startup = $startup;
							
							$startup_user = array(
								"StartupUsers"=>array(
									"startup_id" => $this->Startup->id,
									"user_id" => $this->UserAuth->getUserId(),
									"role_id" => $invite["StartupInvites"]["invitee_role_id"],
								)
							);
					
							$this->StartupUsers->create();
							$this->StartupUsers->save($startup_user);
							
							// mark invitation as accepted 
							$invite["StartupInvites"]["accepted"] = 1;
							$this->StartupInvites->create();
							$this->StartupInvites->save($invite);
							
							$this->set('inviteStatus', 1);
						}
							
					}else{
						$this->set('inviteStatus', -4);
						$this->set('inviteStatusText', "Invitation already accepted");
					}
					
				}else{
					$this->set('inviteStatus', 2);
				}
    			
    			
    		}else{
    			// bad invite
    			$this->set('inviteStatus', -2);
    			$this->set('inviteStatusText', "Invalid Invitation state".isset($invite));
    		}		
    				
			
		}
		
		
		
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
			$intiveIdHash = md5($intiveId.$this->inviteSalt);
			// send email invite
			$email = new CakeEmail("gmail");
			$email->from(array('starthub1@gmail.com' => 'StartHub Support'));
			$email->emailFormat('html');
			$email->template('invitemate', 'invites');
			$email->viewVars(array('link' => "http://xboard.co/basics/invited/".$intiveId."/".$intiveIdHash));
			$email->viewVars(array('invitee_name' => $mateName));
			$email->viewVars(array('inviter_name' => $this->user['User']['first_name']));
			$email->to($mateEmail);
			$email->subject('Join our startup at StartHub');
			$email->send();
			
			$this->data = null;
		}
		
		
		if(isset($this->startup)){
			$invites = $this->StartupInvites->find('all', array(
        				'conditions' => array('StartupInvites.startup_id' => $this->startup["Startup"]["id"])
    				));
    				
    		$this->set('invites', $invites);
			
		}
		
		
		if(isset($this->startup)){
			$this->StartupUsers->bindModel(
		        array('belongsTo' => array(
		                'User' => array(
		                    'className' => 'User'
		                )
		            )
		        )
		    );
			$team = $this->StartupUsers->find('all', array(
        				'conditions' => array('StartupUsers.startup_id' => $this->startup["Startup"]["id"])
    				));
    				
    		$this->set('team', $team);
			
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
