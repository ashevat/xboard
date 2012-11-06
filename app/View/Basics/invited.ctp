
<?php if($inviteStatus == 2){ // user not login in ?>
<div class="row-fluid">
		<div class="span10">
				<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-star-empty"></i> </span>
							<h5>Please sign-in to accept the invitation</h5>
						</div>
						<div class="widget-content">
							<p>In order to join your team please connect:</p>
							<br />
							<ul>
								<li id="linkedin" class="" title='Linkedin Connect'
									onclick="javascript:login_popup('ldn');return false;"><?php echo $this->Html->image('linked-js-signin.png', array('alt' => 'linked in'))?>
								</li>
							</ul>
						</div>
					</div>
		</div>
	</div>
<?php }else if($inviteStatus == 1){ // success! ?>
		<div class="row-fluid">
				<div class="span10">
						<div class="widget-box">
								<div class="widget-title">
									<span class="icon"><i class="icon-star-empty"></i> </span>
									<h2>Congratulations!</h2>
								</div>
								<div class="widget-content">
									<p>
									You have succesfuly accepted the invitation.
									</p>
									<p>
									Here is some of the things you can do on StartHub:
									<ul>
									<li>something</li>
									<li>other</li>
									<li>and</li>
									<li>that</li>
									</ul>
									 
									</p>
								</div>
							</div>
				</div>
			</div>

<?php }else{ // OMG something went wrong! ?>
	<div class="row-fluid">
		<div class="span10">
				<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-star-empty"></i> </span>
							<h2>OMG something went wrong!</h2>
						</div>
						<div class="widget-content">
							<p> Your invitation request failed to process - reason: <?php echo $inviteStatusText ?></p>
						</div>
					</div>
		</div>
	</div>
<?php } ?>

<script>
var newwindow;
function login_popup(url) {
	var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
	screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
	outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
	outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
	width    = 500,
	height   = 500,
	left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
	top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
	features = (
		'width=' + width +
		',height=' + height +
		',left=' + left +
		',top=' + top+
		',scrollbars=yes'
	);
	newwindow=window.open('../../../login/'+url,'',features);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}
</script>
