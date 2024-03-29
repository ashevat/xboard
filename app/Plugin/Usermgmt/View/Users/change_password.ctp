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

?>
<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('Change Password'); ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Home",true),"/") ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="changepass">
				<?php echo $this->Form->create('User', array('action' => 'changePassword')); ?>
				<?php if(!$this->Session->check('UserAuth.FacebookChangePass') && !$this->Session->check('UserAuth.TwitterChangePass') && !$this->Session->check('UserAuth.GmailChangePass') && !$this->Session->check('UserAuth.LinkedinChangePass') && !$this->Session->check('UserAuth.FoursquareChangePass') && !$this->Session->check('UserAuth.YahooChangePass')){ ?>
				<div>
					<div class="umstyle3"><?php echo __('Old Password');?></div>
					<div class="umstyle4"><?php echo $this->Form->input("oldpassword" ,array("type"=>"password",'label' =>  false,'div' => false,'class'=>"umstyle5" ))?></div>
					<div style="clear:both"></div>
				</div>
				<?php } ?>
				<?php if($this->Session->check('UserAuth.TwitterChangePass') || $this->Session->check('UserAuth.LinkedinChangePass')){ ?>
				<div>
					<div class="umstyle3"><?php echo __('Email');?></div>
					<div class="umstyle4"><?php echo $this->Form->input("email" ,array('label' => false,'div'=> false,'class'=>"umstyle5" ))?></div>
				<?php if(($this->Session->check('UserAuth.TwitterChangePass') || $this->Session->check('UserAuth.LinkedinChangePass')) && isset($this->validationErrors['User']['email']) && $this->validationErrors['User']['email'][0]=='This email is already registered') { ?>
					<div class="umstyle9"><?php echo __('If this email is yours please verify');?> <?php echo $this->Form->Submit(__('Verify'), array('div'=>false, 'name'=>'verify'));?></div>
				<?php if($this->Session->check('UserAuth.EmailVerifyCode')) {?>
					<div class="umstyle10"><?php echo __('Verification Code');?></div>
					<div class="umstyle11"><?php echo $this->Form->input("emailVerifyCode" ,array('label' => false,'div'=> false,'class'=>"umstyle5", 'style'=>'width:50px;'))?></div>
				<?php } }?>
					<div style="clear:both"></div>
				</div>
				<?php } ?>
				<div>
					<div class="umstyle3"><?php echo __('New Password');?></div>
					<div class="umstyle4"><?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
					<div style="clear:both"></div>
				</div>
				<div>
					<div class="umstyle3"><?php echo __('Confirm Password');?></div>
					<div class="umstyle4"><?php echo $this->Form->input("cpassword" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
					<div style="clear:both"></div>
				</div>
				<div>
					<div class="umstyle3"></div>
					<div class="umstyle4"><?php echo $this->Form->Submit(__('Change'), array('name'=>'submit'));?></div>
					<div style="clear:both"></div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>