<div class="row-fluid">
<div class="span12 widget-box">
	<div class="widget-title">
		<span class="icon"><i class="icon-tag"></i></span>
		<h5>Step 1: Assemble a team</h5>
		<div class="buttons">
			<a href="#" class="btn btn-mini"><i class="icon-question-sign"></i></a>
		</div>
	</div>
	<div class="widget-content">
		<p>bla bla bla </p>
	</div>
</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-user"></i></span>
				<h5>You</h5>
				<div class="buttons">
					<a href="#" class="btn btn-mini"><i class="icon-cog"></i></a>
				</div>
			</div>
			<div class="widget-content">
				<?php if(!empty($user['User']) ){?>
					<p>	            
		              <i class="icon-tag"></i> <?php echo $user['User']['first_name']?> <?php echo $user['User']['last_name']?><br/>
		              <i class="icon-tag"></i> Roles: CEO
		             </p>
		              <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
				      <script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/<?php echo $user['User']['username']?>" data-format="inline" data-related="false"></script>
		          
		        <?php }else{?>
		        	  <p>In order to create/update your team please connect:</p><br/>
		        	  <ul>
						 <li id="linkedin" class="" title='Linkedin Connect' onclick="javascript:login_popup('ldn');return false;">
							<?php echo $this->Html->image('linked-js-signin.png', array('alt' => 'linked in'))?>
						</li>
		            	</ul>
		        <?php }?>
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-user"></i></span>
				<h5>Team mates</h5>
				<div class="buttons">
					<a href="#" class="btn btn-mini"><i class="icon-cog"></i></a>
				</div>
			</div>
			<div class="widget-content">
			<?php
			    echo $this->Form->create('Comment', array('action' => 'invite'));
			    echo $this->Form->input('Mate Name');
			    echo $this->Form->input('Mate Email');
			    echo $this->Form->input('Mate Role');
			    if(empty($user['User']) ){
				   	echo $this->Form->end(array("label"=>__('Login to invite'),"disabled"=>true,"class"=>"btn btn-warning btn-large"));
				}else{
					echo $this->Form->end(array("label"=>__('Invite'),"class"=>"btn btn-success btn-large"));
				}
			?>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-star-empty"></i></span>
				<h5>Tips and tricks</h5>
			</div>
			<div class="widget-content">			
				<p>What is this the first on the list?</p>
			</div>
		</div>
	</div>
</div>

			
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
	newwindow=window.open('../login/'+url,'',features);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}
</script>
			