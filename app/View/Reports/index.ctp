<html lang="en-us">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="css/fullcalendar.css">
<link rel="stylesheet" href="css/unicorn.main.css">
<script type="text/javascript" src="js/unicorn.interface.js"></script>
<script type="text/javascript" src="js/unicorn.dashboard.js"></script>
<script type="text/javascript" src="js/jquery.peity.js"></script>
<script type="text/javascript" src="js/jquery.peity.min.js"></script>
</head>

<body>
	<div class="row-fluid">
		<h1>StartHub</h1>
		<table width="100%">
			<tr>
				<td>

					<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-file"></i> </span>
							<h5>Marketing</h5>
						</div>
						<div class="widget-content nopadding">
							<ul class="recent-posts">
								<li><img width="20" height="20" alt="User"
									src="img/exclamation.jpg"> <span class="user-info"> ARPU: $65
										(Target:$79) </span></li>
								<li><img width="20" height="20" alt="User"
									src="img/arrow_up.jpg"> <span class="user-info"> Funnel: </span>
									<span class="right peity_bar_good"> <span> <span
											style="display: none;">2,4,9,7,12,10,12</span> <canvas
												width="50" height="24"></canvas> </span> +20% </span></li>
								<li><img width="20" height="20" alt="User"
									src="img/arrow_up.jpg"> <span class="user-info"> Site Activity: </span>
									<span class="right peity_bar_good"> <span> <span
											style="display: none;">54,32,45,78,99,110,129</span> <canvas
												width="50" height="24"></canvas> </span> +34% </span></li>

								<li class="viewall"><a class="tip-top"
									href="/xboard/reports/marketing_report" data-original-title="Show More">
										Show More </a></li>
							</ul>
						</div>
					</div>
				</td>
				<td>
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-file"></i> </span>
							<h5>Product</h5>
						</div>
						<div class="widget-content nopadding">
							<ul class="recent-posts">
								<li><img width="20" height="20" alt="User"
									src="img/on_target.jpg"> <span class="user-info"> Roadmap Highlights: </span>
									<ul>
									<li>
									<ontarget>Alpha release (1/1/2013)</ontarget>
									</li>
									<li>
									<delayed>Integration with Google Analytics (2/1/2013)</delayed> 
									</li>
									<li>
									<red>Beta release (1/4/2013)</red> 
									</li>
									</ul>
									
								</li>
								<li class="viewall"><a class="tip-top"
									href="/xboard/reports/product_report" data-original-title="Show More">
										Show More </a></li>
							</ul>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-file"></i> </span>
							<h5>Finance</h5>
						</div>
						<div class="widget-content nopadding">
							<ul class="recent-posts">
								<li><img width="20" height="20" alt="User"
									src="img/exclamation.jpg"> <span class="user-info"> Available
										Cash: </span>
									<table>
										<tr>
											<td>USA:</td>
											<td>$1,500,023</td>
										</tr>
										<tr>
											<td>Israel:</td>
											<td>$602,765</td>
										</tr>
										<tr>
											<td><b>Total Cash Available:</b>
											</td>
											<td><b>$2,102,788</b>
											</td>
										</tr>

									</table>
								</li>
								<li><img width="20" height="20" alt="User"
									src="img/arrow_up.jpg"> <span class="user-info"> Booking up to
										Dec 2012: </span> <span class="right peity_bar_good"> <span> <span
											style="display: none;">60,469,580,920,2100,2600,3090</span> <canvas
												width="50" height="24"></canvas> </span> </span></li>
								<li class="viewall"><a class="tip-top"
									href="/xboard/reports/finance_report" data-original-title="Show More">
										Show More </a></li>
							</ul>
						</div>
					</div>
				</td>
				<td>

					<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-file"></i> </span>
							<h5>Operations</h5>
						</div>
						<div class="widget-content nopadding">
							<ul class="recent-posts">
								<li>Server Count:
									<table border="1">
										<tr>
											<td><Strong>AWS US</Strong></td>
											<td><Strong>AWS EU</Strong></td>
											<td><Strong>Rackspace</Strong></td>
										</tr>
										<tr>
											<td>17</td>
											<td>9</td>
											<td>11</td>
										</tr>
										<tr>
											<td>63GB</td>
											<td>23GB</td>
											<td>13GB</td>
										</tr>
									</table>
								</li>
								<li><span class="user-info"> Total Number of Servers: </span> <span
									class="right peity_bar_good"> <span> <span
											style="display: none;">10,4,3</span> <canvas width="50"
												height="24"></canvas> </span> </span></li>
								<li class="viewall"><a class="tip-top"
									href="/xboard/reports/operations_report" data-original-title="Show More">
										Show More </a></li>
							</ul>
						</div>
					</div>
				</td>

			</tr>

		</table>
	</div>
	<?php echo $this->Html->script('dashboard'); ?>
</body>
</html>
