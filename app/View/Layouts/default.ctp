<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>xBoard! By entrepreneurs for entrepreneurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<?php echo $this->Html->script('jquery'); ?>
<script src = "https://domainsbot.blob.core.windows.net/javascript/jquery.domainsbot-1.0.min.js"></script>
    <!-- Le styles -->
    <?php echo $this->Html->css('bootstrap.css'); ?>
    <?php echo $this->Html->css('umstyle.css'); ?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      
      
    </style>
    <?php echo $this->Html->css('bootstrap-responsive.css');
		  //echo $this->Html->css('/usermgmt/css/umstyle.css');	
    ?>
    
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
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">xBoard</a>
          
          <div class="btn-group pull-right">
          <?php if(!empty($user['User']) ){?>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo $user['User']['first_name']?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><?php echo $this->Html->link('Profile', '/myprofile', array()); ?></li>
              <li class="divider"></li>
              <li><?php echo $this->Html->link('Sign Out', '/logout', array()); ?></li>
            </ul>
            <?php }else{?>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Anonymous 
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#"><?php echo $this->Html->link('Login', '/login', array()); ?></a></li>
              <li class="divider"></li>
              <li><a href="#"><?php echo $this->Html->link('Register', '/login', array()); ?></a></li>
            </ul>
            <?php }?>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Basics</li>
              <li class="active"> <?php echo $this->Html->link('<i class="icon-ok"></i> 
    Overview', '/basics/', array('escape' => false)); ?></li>
    		  <li><?php echo $this->Html->link('Team', '/basics/team', array()); ?></li>
              <li><?php echo $this->Html->link('Name', '/basics/name', array()); ?></li>
              
              <li><a href="#">Vision</a></li>
              <li><a href="#">Description/Profile</a></li>
              <li><a href="#">Recommended reading</a></li>
              <li class="nav-header">Marketing</li>
              <li><a href="#">MVP definition</a></li>
              <li><a href="#">Logo/Graphics</a></li>
              <li><a href="#">Tag Line</a></li>
              <li><a href="#">Pitch</a></li>
              <li><a href="#">Business cards</a></li>
              <li class="nav-header">Development</li>
              <li><a href="#">Development stack</a></li>
              <li><a href="#">UX/UI guidelines and resources</a></li>
              <li><a href="#">Source control </a></li>
              <li><a href="#">Production environment</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
          <?php echo $this->fetch('content'); ?>

      <hr>
      
    

      <footer>
        <p>&copy; xBoard 2012</p>
      </footer>

    </div><!--/.fluid-container-->
    


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <?php echo $this->Html->script('bootstrap-transition'); ?>
    <?php echo $this->Html->script('bootstrap-alert'); ?>
    <?php echo $this->Html->script('bootstrap-modal'); ?>
    <?php echo $this->Html->script('bootstrap-dropdown'); ?>
    <?php echo $this->Html->script('bootstrap-scrollspy'); ?>
    <?php echo $this->Html->script('bootstrap-tab'); ?>
    <?php echo $this->Html->script('bootstrap-tooltip'); ?>
    <?php echo $this->Html->script('bootstrap-popover'); ?>
    <?php echo $this->Html->script('bootstrap-button'); ?>
    <?php echo $this->Html->script('bootstrap-collapse'); ?>
    <?php echo $this->Html->script('bootstrap-carousel'); ?>
    <?php echo $this->Html->script('bootstrap-typeahead'); ?>
        
    
   

  </body>
</html>
