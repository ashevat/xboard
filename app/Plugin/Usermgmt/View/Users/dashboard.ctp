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
<div class="span9">
 <div class="hero-unit">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('Dashboard'); ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Home",true),"/") ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid">
				Hello <?php echo h($var['User']['first_name']).' '.h($var['User']['last_name']); ?><br/><br/>
		<?php  if ($this->UserAuth->isAdmin()) { ?>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Add User",true),"/addUser") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("All Users",true),"/allUsers") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Add Group",true),"/addGroup") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("All Groups",true),"/allGroups") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Permissions",true),"/permissions") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("All Settings",true),"/allSettings") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Online Users",true),"/usersOnline") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Delete Cache",true),"/deleteCache") ?></div>
		<?php  } else if($this->UserAuth->isLogged()){
					if (ALLOW_DELETE_ACCOUNT) {
						echo "<div class='umstyle6 left'>".$this->Form->postLink("Delete Account", array('action' => 'deleteAccount', $this->UserAuth->getUserId()), array('escape' => false, 'confirm' => __('Are you sure you want to delete your account?')))."</div>";
					}
				} ?>
					<!-- <div class="umstyle6 left"><?php echo $this->Html->link(__("Change Password",true),"/changePassword") ?></div> -->
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Profile",true),"/myprofile") ?></div>
					<div class="umstyle6 left"><?php echo $this->Html->link(__("Edit Profile",true),"/editProfile") ?></div>
					<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
	</div>
</div>