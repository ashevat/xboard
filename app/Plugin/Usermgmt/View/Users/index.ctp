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
<?php if(!$this->request->isAjax) { ?>
<?php echo $this->Html->script(array('/usermgmt/js/jquery-1.7.2.min','/usermgmt/js/um.autocomplete.js?q='.QRDN)); ?>
<div class="span9">
 <div class="hero-unit">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('All Users'); ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Home",true),"/") ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="index">
				<div id="updateUserIndex">
<?php } ?>
					<?php echo $this->Search->searchForm('User', array('legend' => 'Search', "updateDivId" => "updateUserIndex")); ?>
					<?php echo $this->element('paginator', array("useAjax" => true, "updateDivId" => "updateUserIndex")); ?>
					<div class="tableContainer">
						<table cellspacing="0" cellpadding="0" width="100%" border="0" class="umtable colored">
							<thead>
								<tr>
									<th><?php echo __('SL');?></th>
									<th><?php echo $this->Paginator->sort('User.id', __('User Id')); ?></th>
									<th><?php echo $this->Paginator->sort('User.first_name', __('Name')); ?></th>
									<th><?php echo $this->Paginator->sort('User.username', __('Username')); ?></th>
									<th><?php echo $this->Paginator->sort('User.email', __('Email')); ?></th>
									<th><?php echo __('Groups(s)');?></th>
									<th><?php echo $this->Paginator->sort('User.email_verified', __('Email Verified')); ?></th>
									<th><?php echo $this->Paginator->sort('User.active', __('Status')); ?></th>
									<th><?php echo $this->Paginator->sort('User.created', __('Created')); ?></th>
									<th style="width:150px;"><?php echo __('Action');?></th>
								</tr>
							</thead>
							<tbody>
					<?php       if (!empty($users)) {
									$page = $this->request->params['paging']['User']['page'];
									$limit = $this->request->params['paging']['User']['limit'];
									$i=($page-1) * $limit;
									foreach ($users as $row) {
										$i++;
										echo "<tr id='rowId".$row['User']['id']."'>";
										echo "<td>".$i."</td>";
										echo "<td>".$row['User']['id']."</td>";
										echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name'])."</td>";
										echo "<td>".h($row['User']['username'])."</td>";
										echo "<td>".h($row['User']['email'])."</td>";
										echo "<td>".h($row['UserGroup']['name'])."</td>";
										echo "<td id='emailVerified".$row['User']['id']."'>";
										if ($row['User']['email_verified']==1) {
											echo "Yes";
										} else {
											echo "No";
										}
										echo"</td>";
										echo "<td id='activeInactive".$row['User']['id']."'>";
										if ($row['User']['active']==1) {
											echo "Active";
										} else {
											echo "Inactive";
										}
										echo"</td>";
										echo "<td>".date('d-M-Y',strtotime($row['User']['created']))."</td>";
										echo "<td class='action'>";
											echo "<a href='".$this->Html->url('/viewUser/'.$row['User']['id'].'/page:'.$page)."'><img src='".SITE_URL."usermgmt/img/view.png' border='0' alt='View' title='View'></a>";
											echo "<a href='".$this->Html->url('/editUser/'.$row['User']['id'].'/page:'.$page)."'><img src='".SITE_URL."usermgmt/img/edit.png' border='0' alt='Edit' title='Edit'></a>";
											//echo "<a href='".$this->Html->url('/changeUserPassword/'.$row['User']['id'].'/page:'.$page)."'><img src='".SITE_URL."usermgmt/img/password.png' border='0' alt='Change Password' title='Change Password'></a>";
											if ($row['User']['id']!=1 && $row['User']['username']!='Admin') {
												echo "<div style='display:inline' id='makeActiveInactiveId".$row['User']['id']."'>";
												if ($row['User']['active']==0) {
													echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/dis-approve.png', array("alt" => __('Make Active'), "title" => __('Make Active'))), array('action' => 'makeActiveInactive', $row['User']['id'], 1), array('update' => '#makeActiveInactiveId'.$row['User']['id'], 'escape' => false, 'confirm' => __('Are you sure you want to make this user active?')));
												} else {
													echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/approve.png', array("alt" => __('Make Inactive'), "title" => __('Make Inactive'))), array('action' => 'makeActiveInactive', $row['User']['id'], 0), array('update' => '#makeActiveInactiveId'.$row['User']['id'], 'escape' => false, 'confirm' => __('Are you sure you want to make this user inactive?')));
												}
												echo "</div>";
											}
											if ($row['User']['id']!=1 && $row['User']['username']!='Admin') {
												if ($row['User']['email_verified']==0) {
													echo "<div style='display:inline' id='doEmailVerifyId".$row['User']['id']."'>";
													echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/email-verify.png', array("alt" => __('Verify Email'), "title" => __('Verify Email'))), array('action' => 'verifyEmail', $row['User']['id']), array('update' => '#doEmailVerifyId'.$row['User']['id'], 'escape' => false, 'confirm' => __('Are you sure you want to verify email of this user?')));
													echo "</div>";
												}
											}
											if ($row['User']['id']!=1 && $row['User']['username']!='Admin') {
												echo "<div style='display:inline' id='doDeleteId".$row['User']['id']."'>";
												echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array("alt" => __('Delete'), "title" => __('Delete'))), array('action' => 'deleteUser', $row['User']['id']), array('update' => '#doDeleteId'.$row['User']['id'], 'escape' => false, 'confirm' => __('Are you sure you want to delete this user?')));
												echo "</div>";
											}
											echo "<a href='".$this->Html->url('/viewUserPermissions/'.$row['User']['id'].'/page:'.$page)."'><img src='".SITE_URL."usermgmt/img/view-permission.png' border='0' alt='View Permissions' title='View Permissions'></a>";
										echo "</td>";
										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan=10><br/><br/>No Data</td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<?php if(!empty($users)) { echo $this->element('pagination', array("totolText" => "Number of Users")); } ?>
<?php if(!$this->request->isAjax) { ?>
				</div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
</div>
<?php } ?>