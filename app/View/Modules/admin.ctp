
<?php

$s = $this->Startup->findById(1);
debug ($s);

?>

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

	<h2>Avilable Plugins</h2>
	<?php foreach ($activePluginCategoties as $pluginCategotry){?>
	<h2>
	<?php echo $pluginCategotry["PluginCategories"]["name"]; ?>
	</h2>

	<div class="row-fluid">

	<?php foreach ($pluginCategotry["Plugin"] as $plugin){?>
	<?php// print_r($plugin);?>

		<div class="span4">
			<h3>
			<?php echo $plugin["name"] ?>
			</h3>
			<p>
			<?php echo $plugin["description"] ?>
				<br> <small>Author <?php echo $plugin["Author"] ?> </small> <br> <small>Version
				<?php echo $plugin["version"] ?> </small>
			</p>
			<p>
				<a class="btn btn-success" href="#">Install &raquo;</a>
			</p>
		</div>
		<?php } ?>
	</div>
	<hr>
	<?php } ?>


	<h2>Installed Plugins</h2>
	<?php echo $starupId;?>