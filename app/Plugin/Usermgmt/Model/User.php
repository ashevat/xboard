<?php

/*

Cakephp 2.x User Management Premium Version
Copyright (c) 2012 EktaSoftwares
Website- http://EktaSoftwares.com/
Demo- http://umpremium.ektasoftwares.com/

UMPremium is a copyrighted work of authorship. EktaSoftwares
retains ownership of the product and any copies of it, regardless of the
form in which the copies may exist. This license is not a sale of the
original product or any copies.

By installing and using UMPremium on your server, you agree to the following
terms and conditions. Such agreement is either on your own behalf or on behalf
of any corporate entity which employs you or which you represent
('Corporate Licensee'). In this Agreement, 'you' includes both the reader
and any Corporate Licensee and EktaSoftwares.Com

The Product is licensed only to you. You may not rent, lease, sublicense, sell,
assign, pledge, transfer or otherwise dispose of the Product in any form, on
a temporary or permanent basis, without the prior written consent of EktaSoftwares.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, EktaSoftwares reserves the right
to action against you.

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN
THE PRODUCT.

*/

App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');

class User extends UserMgmtAppModel {

	/**
	 * This model has following models
	 *
	 * @var array
	 */
	var $hasMany = array('LoginToken'=>array('className'=>'Usermgmt.LoginToken','limit' =>1));
	var $hasOne = array('Usermgmt.UserDetail');
	/**
	 * model validation array
	 *
	 * @var array
	 */
	var $validate = array();
	/**
	 * UsetAuth component object
	 *
	 * @var object
	 */
	var $userAuth;
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function LoginValidate() {
		$validate1 = array(
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email or username')
					),
				'password'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter password')
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function RegisterValidate() {
		$validate1 = array(
				"user_group_id" => array(
					'rule' => array('multiple', array('min' => 1)),
					'message'=> 'Please select group'),
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter username',
						'last'=>true),
					'mustAlphaNumeric'=>array(
						'rule' => 'alphaNumericDashUnderscore',
						'message'=> 'Username must be alphaNumeric',
						'last'=>true),
					'mustAlpha'=>array(
						'rule' => 'alpha',
						'message'=> 'Username must contain any letter',
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This username already taken',
						'last'=>true),
					'mustNotBanned'=>array(
						'rule' =>'isBanned',
						'message' =>'',
						'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 4),
						'message'=> 'Username must be greater than 3 characters',
						'last'=>true),
					),
				'first_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter first name',
						'last'=>true),
					'mustAlphaNumeric'=>array(
						'rule' => 'alphaNumericDashUnderscoreSpace',
						'message'=> 'Please enter valid first name',
						'last'=>true),
					'mustAlpha'=>array(
						'rule' => 'alpha',
						'message'=> 'Please enter valid first name',
						'last'=>true),
					),
				'last_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter last name',
						'last'=>true),
					'mustAlphaNumeric'=>array(
						'rule' => 'alphaNumericDashUnderscoreSpace',
						'message'=> 'Please enter valid last name',
						'last'=>true),
					'mustAlpha'=>array(
						'rule' => 'alpha',
						'message'=> 'Please enter valid last name',
						'last'=>true),
					),
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter email',
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => 'Please enter valid email',
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						/* Please note if you want to change this message then also change this in change_password.ctp */
						'message' =>'This email is already registered'
						)
					),
				'oldpassword'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter old password',
						'last'=>true),
					'mustMatch'=>array(
						'rule' => array('verifyOldPass'),
						'message' => 'Please enter correct old password'),
					),
				'password'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter password',
						'on' => 'create',
						'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 6),
						'message'=> 'Password must be greater than 5 characters',
						'on' => 'create',
						'last'=>true),
					'mustMatch'=>array(
						'rule' => array('verifies'),
						'message' => 'Both passwords must match'),
					),
				'captcha'=>array(
					'mustMatch'=>array(
						'rule' => array('recaptchaValidate'),
						'message' => ''),
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	/**
	 * Used to validate captcha
	 *
	 * @access public
	 * @return boolean
	 */
	public function recaptchaValidate() {
		App::import("Vendor", "Usermgmt.recaptcha/recaptchalib");
		$recaptcha_challenge_field = (isset($_POST['recaptcha_challenge_field'])) ? $_POST['recaptcha_challenge_field'] : "";
		$recaptcha_response_field = (isset($_POST['recaptcha_response_field'])) ? $_POST['recaptcha_response_field'] : "";
		$resp = recaptcha_check_answer(PRIVATE_KEY_FROM_RECAPTCHA, $_SERVER['REMOTE_ADDR'], $recaptcha_challenge_field, $recaptcha_response_field);
		$error = $resp->error;
		if(!$resp->is_valid) {
			$this->validationErrors['captcha'][0]=$error;
		}
		return true;
	}
	/**
	 * Used to validate banned usernames
	 *
	 * @access public
	 * @return boolean
	 */
	public function isBanned() {
		$bannedUsers= explode(',', strtolower(BANNED_USERNAMES));
		$bannedUsers = array_map('trim', $bannedUsers);
		$checkMore=true;
		if(!empty($bannedUsers)) {
			if(isset($this->data['User']['id'])) {
				$oldUsername= $this->getUserNameById($this->data['User']['id']);
			}
			if(!isset($oldUsername) || $oldUsername !=$this->data['User']['username']) {
				if(in_array(strtolower($this->data['User']['username']), $bannedUsers)) {
					$this->validationErrors['username'][0]="You cannot set this username";
					$checkMore=false;
				}
			}
		}
		if($checkMore) {
			App::import("Component", "Usermgmt.ControllerList");
			$contList = new ControllerListComponent(new ComponentCollection());
			$conts = $contList->getControllers();
			unset($conts[-2]);
			unset($conts[-1]);
			$conts = array_map('strtolower', $conts);
			$usernameTmp =strtolower(str_replace(' ','',ucwords(str_replace('_',' ',$this->data['User']['username']))));
			if(in_array($usernameTmp, $conts)) {
				$this->validationErrors['username'][0]="You cannot set this username";
				$checkMore=false;
			}
			if($checkMore) {
				$plugins = App::objects('plugins');
				$plugins = array_map('strtolower', $plugins);
				if(in_array($usernameTmp, $plugins)) {
					$this->validationErrors['username'][0]="You cannot set this username";
					$checkMore=false;
				}
				if($checkMore) {
					$customRoutes = Router::$routes;
					$usernameTmp ='/'.$this->data['User']['username'];
					foreach($customRoutes as $customRoute) {
						if(strpos(strtolower($customRoute->template),strtolower($usernameTmp)) !==false) {
							$this->validationErrors['username'][0]="You cannot set this username";
							break;
						}
					}
				}
			}
		}
		return true;
	}
	/**
	 * Used to match old password
	 *
	 * @access public
	 * @return boolean
	 */
	public function verifyOldPass() {
		$userId = $this->userAuth->getUserId();
		$user = $this->findById($userId);
		$oldpass=$this->userAuth->makePassword($this->data['User']['oldpassword'], $user['User']['salt']);
		return ($user['User']['password']===$oldpass);
	}
	/**
	 * Used to send registration mail to user
	 *
	 * @access public
	 * @param array $user user detail array
	 * @return void
	 */
	public function sendRegistrationMail($user) {
		// send email to newly created user
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = EMAIL_FROM_ADDRESS;
		$fromNameConfig = EMAIL_FROM_NAME;
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject('Your registration is complete');
		//$email->transport('Debug');
		$body="Welcome ".$user['User']['first_name'].", Thank you for your registration on ".SITE_URL." \n\n Thanks,\n".SITE_NAME;
		try{
			$result = $email->send($body);
		} catch (Exception $ex) {
			// we could not send the email, ignore it
			$result="Could not send registration email to userid-".$userId;
			$this->log($result, LOG_DEBUG);
		}
	}
	/**
	 * Used to send email verification mail to user
	 *
	 * @access public
	 * @param array $user user detail array
	 * @return void
	 */
	public function sendVerificationMail($user) {
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = EMAIL_FROM_ADDRESS;
		$fromNameConfig = EMAIL_FROM_NAME;
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject('Email Verification Mail');
		$activate_key = $this->getActivationKey($user['User']['password']);
		$link = Router::url("/userVerification?ident=$userId&activate=$activate_key",true);
		$body="Hi ".$user['User']['first_name'].", Click the link below to confirm your email address \n\n ".$link;
		try{
			$result = $email->send($body);
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send verification email to userid-".$userId;
			$this->log($result, LOG_DEBUG);
		}
	}
	/**
	 * Used to send email verification code to user
	 *
	 * @access public
	 * @param array $user user detail array
	 * @return void
	 */
	public function sendVerificationCode($userId, $emailadd, $code) {
		$name = $this->getNameById($userId);
		$email = new CakeEmail();
		$fromConfig = EMAIL_FROM_ADDRESS;
		$fromNameConfig = EMAIL_FROM_NAME;
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($emailadd);
		$email->subject('Email Verification Code');
		$body="Hi ".$name.", \n\n Your email verification code is ".$code;
		try{
			$result = $email->send($body);
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send verification code email to userid-".$userId;
			$this->log($result, LOG_DEBUG);
		}
	}
	/**
	 * Used to generate activation key
	 *
	 * @access public
	 * @param string $password user password
	 * @return hash
	 */
	public function getActivationKey($password) {
		$salt = Configure::read ( "Security.salt" );
		return md5(md5($password).$salt);
	}
	/**
	 * Used to send forgot password mail to user
	 *
	 * @access public
	 * @param array $user user detail
	 * @return void
	 */
	public function sendForgotPasswordMail($user) {
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = EMAIL_FROM_ADDRESS;
		$fromNameConfig = EMAIL_FROM_NAME;
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject(SITE_NAME.': Request to   Reset Your Password');
		$activate_key = $this->getActivationKey($user['User']['password']);
		$link = Router::url("/activatePassword?ident=$userId&activate=$activate_key",true);
		$body= "Welcome ".$user['User']['first_name'].", let's help you get signed in

You have requested to have your password reset on ".SITE_NAME.". Please   click the link below to reset your password now :

".$link."


If above link does not work please copy and paste the URL link (above) into your browser address bar to get to the Page to reset password

Choose a password you can remember and please keep it secure.

Thanks,\n".

SITE_NAME;
		try{
			$result = $email->send($body);
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send forgot password email to userid-".$userId;
			$this->log($result, LOG_DEBUG);
		}
	}
	/**
	 * Used to send change password mail to user
	 *
	 * @access public
	 * @param array $user user detail
	 * @return void
	 */
	public function sendChangePasswordMail($user) {
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = EMAIL_FROM_ADDRESS;
		$fromNameConfig = EMAIL_FROM_NAME;
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject(SITE_NAME.': Change Password Confirmation');
		$body= "Hey ".$user['User']['first_name'].", You recently changed your password on ".date('Y M d h:i:s', time()).".

As a security precaution, this notification has been sent to your email addresse associated with your account.

Thanks,\n".

SITE_NAME;
		try{
			$result = $email->send($body);
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send change password email to userid-".$userId;
			$this->log($result, LOG_DEBUG);
		}
	}
	/**
	 * Used to mark cookie used
	 *
	 * @access public
	 * @param string $type
	 * @param string $credentials
	 * @return array
	 */
	public function authsomeLogin($type, $credentials = array()) {
		switch ($type) {
			case 'guest':
				// You can return any non-null value here, if you don't
				// have a guest account, just return an empty array
				return array();
			case 'cookie':
				$loginToken=false;
				if(strpos($credentials['token'], ":") !==false) {
					list($token, $userId) = split(':', $credentials['token']);
					$duration = $credentials['duration'];

					$loginToken = $this->LoginToken->find('first', array(
						'conditions' => array(
							'user_id' => $userId,
							'token' => $token,
							'duration' => $duration,
							'used' => false,
							'expires <=' => date('Y-m-d H:i:s', strtotime($duration)),
						),
						'contain' => false
					));
				}
				if (!$loginToken) {
					return false;
				}
				$loginToken['LoginToken']['used'] = true;
				$this->LoginToken->save($loginToken);

				$conditions = array(
					'User.id' => $loginToken['LoginToken']['user_id']
				);
			break;
			default:
				return array();
		}
		return $this->find('first', compact('conditions'));
	}
	/**
	 * Used to generate cookie token
	 *
	 * @access public
	 * @param integer $userId user id
	 * @param string $duration cookie persist life time
	 * @return string
	 */
	public function authsomePersist($userId, $duration) {
		$token = md5(uniqid(mt_rand(), true));
		$this->LoginToken->create(array(
			'user_id' => $userId,
			'token' => $token,
			'duration' => $duration,
			'expires' => date('Y-m-d H:i:s', strtotime($duration)),
		));
		$this->LoginToken->deleteAll(array('user_id'=>$userId),false);
		$this->LoginToken->save();
		return "${token}:${userId}";
	}
	/**
	 * Used to get name by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return string
	 */
	public function getNameById($userId) {
		$this->unbindModel(array('hasMany' => array('LoginToken'), 'hasOne' => array('UserDetail')));
		$res = $this->findById($userId);
		$name=(!empty($res)) ? ($res['User']['first_name'].' '.$res['User']['last_name']) : '';
		return $name;
	}
	/**
	 * Used to get username by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return string
	 */
	public function getUserNameById($userId) {
		$this->unbindModel(array('hasMany' => array('LoginToken'), 'hasOne' => array('UserDetail')));
		$res = $this->findById($userId);
		$name=(!empty($res)) ? ($res['User']['username']) : '';
		return $name;
	}
	/**
	 * Used to get email by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return string
	 */
	public function getEmailById($userId) {
		$this->unbindModel(array('hasMany' => array('LoginToken'), 'hasOne' => array('UserDetail')));
		$res = $this->findById($userId);
		$email=(!empty($res)) ? ($res['User']['email']) : '';
		return $email;
	}
	/**
	 * Used to get user by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return string
	 */
	public function getUserById($userId) {
		$res = $this->findById($userId);
		return $res;
	}
	/**
	 * Used to get gender array
	 *
	 * @access public
	 * @return string
	 */
	public function getGenderArray($select=true) {
		$gender = array();
		if($select) {
			$gender['']="Select Gender";
		}
		$gender['male']="Male";
		$gender['female']="Female";
		return $gender;
	}
	/**
	 * Used to get gender array
	 *
	 * @access public
	 * @return string
	 */
	public function getMaritalArray($select=true) {
		$rel = array();
		if($select) {
			$rel['']="Select Status";
		}
		$rel['single']="Single";
		$rel['married']="Married";
		$rel['divorced']="Divorced";
		$rel['widowed']="Widowed";
		return $rel;
	}
	/**
	 * Used to check user by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return boolean
	 */
	public function isValidUserId($userId) {
		$this->unbindModel(array('hasMany' => array('LoginToken'), 'hasOne' => array('UserDetail')));
		$res = $this->findById($userId);
		if(!empty($res)) {
			return true;
		}
		return false;
	}
	/**
	 * Used to check users by group id
	 *
	 * @access public
	 * @param integer $groupId user id
	 * @return boolean
	 */
	public function isUserAssociatedWithGroup($groupId) {
		$res = $this->find('count', array('conditions'=>array('User.user_group_id'=>$groupId)));
		if(!empty($res)) {
			return true;
		}
		return false;
	}
}