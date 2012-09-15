

		<!--/span-->
		<div class="span9">
			<div class="well">
				<h2>Step 1: Assemble a team</h2>

				<p>bla bla bla </p>
			</div>
			<div class="row-fluid">
				<div class="span4">
				<?php if(!empty($user['User']) ){?>
            
              <i class="icon-user"></i> <?php echo $user['User']['first_name']?> <?php echo $user['User']['last_name']?>. Roles: CEO
              <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		      <script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/<?php echo $user['User']['username']?>" data-format="inline" data-related="false"></script>
             
            <?php }else{?>
            	In order to create update your team please connect:
				 <li id="linkedin" class="" title='Linkedin Connect' onclick="javascript:login_popup('ldn');return false;">
					<?php echo $this->Html->image('linked-js-signin.png', array('alt' => 'linked in'))?>
				</li>
            
            <?php }?>
				

				</div>

				<div class="span4">
					<h3>team mates</h3>
					
				</div>
				<div class="span4">
					<div class="well">
						<h2>Tips and tricks</h2>

						<p>bla bla bla</p>
					</div>
				</div>
			</div>


			
<script language="JavaScript">
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
	newwindow=window.open('../login/'+url,'',features);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}
</script>
			