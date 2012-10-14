


<div class="span9">
	<div class="hero-unit">
		<div class="row-fluid">


			<h2>Pick Your Modules</h2>
			<p>Not every startup is the same: Some do B2B some while others do
				B2C. Some choose MVP and some pick waterfall.</p>
			<p>xBoard lets you pick the right set of marketing, product, and
				development modules that suites your need.</p>



		</div>
	</div>

	<h2>Installed Plugins</h2>
	
	
	<?php foreach ($pluginCategoties as $pluginCategotry){?>
	<h3>
	<?php echo $pluginCategotry["PluginCategories"]["name"]; ?>
	</h3>
	
	<div class="row-fluid">

	<?php foreach ($pluginCategotry["CatPlugins"] as $plugin){?>
	
		<?php 
		if(Set::matches('/PluginsStartups[plugin_id='.$plugin["id"].']', $curStartupPlugins)) {
		
		 ?> 
		<div class="span4">
			<h4>
			<?php echo $plugin["name"] ?>
			</h4>
			<p>
			<?php echo $plugin["description"] ?>
				<br> <small>Author <?php echo $plugin["OfAuthor"]["name"] ?> </small> <br> <small>Version
				<?php echo $plugin["version"] ?> </small>
			</p>
			<p>
				<a class="btn btn-warning" href="#">Uninstall &raquo;</a>
			</p>
		</div>
		<?php } } ?>
	</div>
	<hr>
	<?php } ?>


	<h2>Avilable Plugins</h2>
	
	
	<?php foreach ($pluginCategoties as $pluginCategotry){?>
	<h3>
	<?php echo $pluginCategotry["PluginCategories"]["name"]; ?>
	</h3>
	
	<div class="row-fluid">

	<?php foreach ($pluginCategotry["CatPlugins"] as $plugin){?>
	
		<?php 
		if(!Set::matches('/PluginsStartups[plugin_id='.$plugin["id"].']', $curStartupPlugins)) {
		
		 ?> 
		<div class="span4">
			<h4>
			<?php echo $plugin["name"] ?>
			</h4>
			<p>
			<?php echo $plugin["description"] ?>
				<br> <small>Author <?php echo $plugin["OfAuthor"]["name"] ?> </small> <br> <small>Version
				<?php echo $plugin["version"] ?> </small>
			</p>
			<p>
				<a class="btn btn-success" href="#">Install &raquo;</a>
			</p>
		</div>
		<?php } } ?>
	</div>
	<hr>
	<?php } ?>
	