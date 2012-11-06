<?php echo $this->Html->docType('html5'); ?>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout.' | StartHub';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php echo $this->Html->css('bootstrap.min'); ?>
    <?php echo $this->Html->css('bootstrap-responsive.min'); ?>
    <?php echo $this->Html->css('umstyle'); ?>
    <?php echo $this->Html->css('unicorn.main'); ?>
    <?php echo $this->Html->css('starthub-0.1'); ?>    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('excanvas.min'); ?>

  
  </head>
  <body>
	<header id="header">
		<div class="container" id="logo-container">
			<h1 class="logo">
				<a href="/">StartHub</a>
			</h1>
			<div id="search">
				<input type="text" placeholder="search here..." class="span2">
				<button class="tip-right" type="submit" data-original-title="Search">
					<i class="icon-search icon-white"></i>
				</button>
			</div>
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
      				<img src="<?php echo $this->Image->resize("img/".IMG_DIR, $user["UserDetail"]["photo"], 16, null, true) ?>"/> 
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
   	</header>
   <section id="hero">
   		<div class="container">
   		<div class="span12">
			<h1>StartHub - {Great Ideas Starts Here}</h1>
		</div></div>
	</section>
	<section id="main-site">
		<div class="container">
		    <div id="sidebar" class="span2">
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
					<?php 
						/* This needs to be automated  
							1. go over all catagories
							2. if there's a plugin in the category -> 
							3. display the category
							4. display the plugin 
					 	*/ ?>   		
				 	<?php 
				 	if(isset($pluginCategoties) && $pluginCategoties){
				 		
				 	
				 	foreach ($pluginCategoties as $pluginCategotry){
				 		$firstTime = true;
						foreach ($pluginCategotry["CatPlugins"] as $plugin){
							if($firstTime && Set::matches('/PluginsStartups[plugin_id='.$plugin["id"].']', $curStartupPlugins)) {
							?>
								
							<li class="submenu top" id="menu-<?php echo $pluginCategotry["PluginCategories"]["name"];?>">
							
							<?php 
								echo $this->Html->link('<i class="icon icon-th"></i><span class="text">'.$pluginCategotry["PluginCategories"]["name"].'</span><span class="label">'.count($pluginCategotry["CatPlugins"]).'</span>', '/'.$pluginCategotry["PluginCategories"]["name"], array('escape'=>false)); 
							    echo '<ul class="leaf">';
								$firstTime = false;
							}//if ($firstTime &&
						}//foreach $pluginCategotry
				
						foreach ($pluginCategotry["CatPlugins"] as $plugin){
							if(Set::matches('/PluginsStartups[plugin_id='.$plugin["id"].']', $curStartupPlugins)) {?>
				 				<li><?php echo $this->Html->link($plugin["name"],'/'.$pluginCategotry["PluginCategories"]["name"].'/'.$plugin["name"]); ?></li>
							<?php }//if
				 		}//foreach ?>
					<li><?php echo $this->Html->link('Edit Modules','/modules'); ?></li>
			    		
				<?php  	}//foreach 
				 	}//if
				?>    		
				<?php // End of this needs to be automated ?>    		
		    		<li class="leaf top"  id="menu-dashboard">
		    			<?php echo $this->Html->link('<i class="icon icon-signal"></i> Dashboard', '/reports', array('escape'=>false)); ?>
		    		</li>
		    	</ul>
		    </div>
	    	<div id="content" class="span8 offset1">
				<?php echo $this->fetch('content'); ?>
			</div>
  		</div>
  	</section>
  	<footer>
  	 	<div class="row">
			<div id="footer">
				<p>&copy; StartHub 2012</p>
			</div>
		</div>
	</footer>
   
     <?php echo $this->Html->script('jquery.ui.custom'); ?>
     <?php echo $this->Html->script('bootstrap.min'); ?>
    
     <?php echo $this->Html->script('jquery.flot'); ?>
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
