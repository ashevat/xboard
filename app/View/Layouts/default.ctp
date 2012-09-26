<?php echo $this->Html->docType('html5'); ?>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout.' | xBoard';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php echo $this->Html->css('bootstrap.min.css'); ?>
    <?php echo $this->Html->css('bootstrap-responsive.min.css'); ?>
    <?php echo $this->Html->css('umstyle.css'); ?>
    <?php echo $this->Html->css('unicorn.main.css'); ?>
    <?php echo $this->Html->css('unicorn.grey.css'); ?>    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    
     <?php echo $this->Html->script('excanvas.min'); ?>
    <?php echo $this->Html->script('jquery.min'); ?>
  
  </head>

  <body>
	<div id="header">
		<h1>
			<a href="/">xBoard</a>
		</h1>
	</div>
	<div id="search">
		<input type="text" placeholder="search here...">
		<button class="tip-right" type="submit" data-original-title="Search">
			<i class="icon-search icon-white"></i>
		</button>
	</div>
    <div class="navbar" id="user-nav">
    <!-- 
    	 <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><?php echo $this->Html->link('Module Market', '/modules', array()); ?></li>
              
            </ul>
          </div><!--/.nav-collapse -->
    	<ul class="nav btn-group">
    		<?php if (!isset($user['User'])) { ?>
				<li class="btn btn-inverse">
	      			<?php echo $this->Html->link('<i class="icon icon-user"></i><span class="text">Anonymous</span>','/login', array('escape'=>false)); ?>
	      				
	      			
	      		</li>
    		<?php } else { ?>
    		<li class="btn btn-inverse">
      			<a href="#" title="">
      				<i class="icon icon-user"></i>
      				<span class="text"><?php echo  $user['User']['first_name']?></span>
      			</a>
      		</li>
      		<li class="btn btn-inverse dropdown" id="menu-messages">
      			<a class="dropdown-toggle" data-target="#menu-messages" data-toggle="dropdown" href="#">
      				<i class="icon icon-envelope"></i>
      				<span class="text">Messages</span>
      				<span class="label label-important">15</span>
      				<b class="caret"></b>
      			</a>
      			<ul class="dropdown-menu">
      				<li><a class="sAdd" href="#" title="">New message</a></li>
      				<li><a class="sAdd" href="#" title="">Inbox</a></li>
      				<li><a class="sAdd" href="#" title="">Sent</a></li>
      				<li><a class="sAdd" href="#" title="">Trash</a></li>
      			</ul>
      		</li>
      		<li class="btn btn-mini btn-inverse">
      			<a href="#" title="">
					<i class="icon icon-cog"></i>
					<span class="text">Settings</span>
				</a>
      		</li>
      		<li class="btn btn-mini btn-inverse">
      			<?php echo $this->Html->link('<i class="icon icon-off"></i><span class="text">Logout</span>', '/logout', array('escape'=>false)); ?>
      		</li>
    		<?php } ?>
      	</ul>
        
    </div>
    <div id="sidebar">
    <a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    	<ul>
    		<li class="leaf top" id="menu-home">
    			<?php echo $this->Html->link('<i class="icon icon-home"></i><span>Home</span>', '/', array('escape'=>false)); ?>
    		</li>
    		<li class="submenu top"  id="menu-basics">
    			<?php echo $this->Html->link('<i class="icon icon-th-list"></i><span>Basics</span><span class="label">5</span>', '/basics', array('escape'=>false)); ?>
    			<ul class="leaf">
    				<li><?php echo $this->Html->link('Overview',array('controller'=>'basics', 'action'=>'overview')); ?></li>
    				<li><?php echo $this->Html->link('Team',array('controller'=>'basics', 'action'=>'team')); ?></li>
    				<li><?php echo $this->Html->link('Name & Domain',array('controller'=>'basics', 'action'=>'name')); ?></li>
    				<li><?php echo $this->Html->link('Description / Profile',array('controller'=>'basics', 'action'=>'desc')); ?></li>
    				<li><?php echo $this->Html->link('Recommended reading',array('controller'=>'basics', 'action'=>'reading')); ?></li>
    			</ul>
    		</li>
    		
    		<li class="submenu top" id="menu-marketing">
    			<?php echo $this->Html->link('<i class="icon icon-th"></i><span class="text">Marketing</span><span class="label">1</span>', '/marketing', array('escape'=>false)); ?>
    			<ul class="leaf">
    				<li><?php echo $this->Html->link('Pick Marketing Modules','/modules'); ?></li>
    				<!--  <li><?php echo $this->Html->link('Logo / Graphics','/marketing/assets'); ?></li>
    				<li><?php echo $this->Html->link('Tag line','/marketing/tagline'); ?></li>
    				<li><?php echo $this->Html->link('Pitch','/marketing/mvp'); ?></li>
    				<li><?php echo $this->Html->link('Business cards','/marketing/business-cards'); ?></li>-->
    			</ul>
    		</li>
    		<li class="submenu top"  id="menu-development">
    			<?php echo $this->Html->link('<i class="icon icon-pencil"></i><span class="text">Development</span><span class="label">1</span>', '/development', array('escape'=>false)); ?>
    			<ul class="leaf">
    				<li><?php echo $this->Html->link('Pick Development Modules','/modules'); ?></li>
    				<!--  <li><?php echo $this->Html->link('Development Stack','/development/stack'); ?></li>
    				<li><?php echo $this->Html->link('UI/UX guidelines and resources','/development/uiux'); ?></li>
    				<li><?php echo $this->Html->link('Source control','/development/scm'); ?></li>
    				<li><?php echo $this->Html->link('Production environment','/development/production'); ?></li>-->
    				
    			</ul>
    		</li>
    		
    		<li class="submenu top" id="menu-product">
    			<?php echo $this->Html->link('<i class="icon icon-pencil"></i><span class="text">Product Management</span><span class="label">1</span>', '/development', array('escape'=>false)); ?>
    			<ul class="leaf">
    				<li><?php echo $this->Html->link('Pick Product Modules','/modules'); ?></li>
    				
    				
    			</ul>
    		</li>
    		
    		<li class="leaf top"  id="menu-dashboard">
    			<?php echo $this->Html->link('<i class="icon icon-signal"></i><span>Dashboard</span>', '/reports', array('escape'=>false)); ?>
    		</li>
    	</ul>
    </div>
    
    <?php 
    $whereWeAre = $this->here; 
    //echo $whereWeAre;
    ?>
    <div id="content">
		<div id="content-header">
	   		<h1>XBoard</h1>
	   		<div class="btn-group">
	   			<a class="btn btn-large tip-bottom" data-original-title="Files"><i class="icon-file"></i></a>
	   			<a class="btn btn-large tip-bottom" data-original-title="Users"><i class="icon-user"></i></a>
	   		</div>
	   	</div>
	   	<div id="breadcrumb">
	   		<a class="tip-bottom" href="#" data-original-title="Go to Home">
				<i class="icon-home"></i>Home</a>
			<a class="current" href="#">Dashboard</a>
	   	</div>
	   	<div class="container-fluid" id="xboard-main">
			<?php echo $this->fetch('content'); ?>
		    <div class="row-fluid">
		    	<div id="footer">
		    		<p>&copy; xBoard 2012</p>
		       	</div>
		    </div>
		</div>  
	</div>
  	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
     <?php echo $this->Html->script('jquery.ui.custom'); ?>
     <?php echo $this->Html->script('bootstrap.min'); ?>
    
     <?php echo $this->Html->script('jquery.flot.min'); ?>
     <?php echo $this->Html->script('jquery.flot.pie.min'); ?>
     <?php echo $this->Html->script('jquery.flot.resize.min'); ?>
     
       
     
    <?php echo $this->Html->script('unicorn'); ?>
    <script src = "https://domainsbot.blob.core.windows.net/javascript/jquery.domainsbot-1.0.min.js"></script>
      <script type="text/javascript">
   $(document).ready(function() {
		$('#<?php echo $openActive?>').addClass('open active');
		$('ul.leaf li a[href="<?php echo $this->here; ?>"]').parent().addClass('active');
	});
   </script>
  </body>
</html>
