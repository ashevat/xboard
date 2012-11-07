<ul class="nav nav-tabs" id="top-tabs">
	<li>
		<a href="#tips" data-toggle="tab">Tips and tricks</a>
	</li>
	<li><a href="#tasks" data-toggle="tab">My tasks</a></li>
	<li>
		<a href="#guide" data-toggle="tab">Guidance</a>
	</li>
</ul>
<div class="tab-content" style="visibility:hidden" id="tabbed-content">
	<div class="tab-pane" id="tips">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-star-empty"></i> </span>
				<h5>Tips and tricks</h5>
			</div>
			<div class="widget-content">
				<p>bla bla</p>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="tasks">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-time"></i> </span>
				<h5>My Tasks</h5>
				<span class="label label-info">1/4</span>
			</div>
			<div class="widget-content ">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Description</th>
							<th>Status</th>
							<th>Opts</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="taskDesc"><i class="icon-ok"></i> Thinking of a brilient idea</td>
							<td class="taskStatus"><span class="done">done</span></td>
							<td class="taskOptions"><a href="#" class="tip-top"
								data-original-title="Done"><i class="icon-ok"></i> </a> </td>
						</tr>
						<tr>
							<td class="taskDesc"><i class="icon-exclamation-sign"></i> Assemble a team</td>
							<td class="taskStatus"><span class="pending">pending</span></td>
							<td class="taskOptions"><a href="#" class="tip-top"
								data-original-title="Start"><i class="icon-arrow-right"></i> </a> </td>
						</tr>
						<tr>
							<td class="taskDesc"><i class="icon-exclamation-sign"></i> Set startup name and vision</td>
							<td class="taskStatus"><span class="pending">pending</span></td>
							<td class="taskOptions"><a href="#" class="tip-top"
								data-original-title="Pending above task"><i class="icon-arrow-up"></i> </a></td>
						</tr>
						<tr>
							<td class="taskDesc"><i class="icon-exclamation-sign"></i> Profile your startup</td>
							<td class="taskStatus"><span class="pending">pending</span></td>
							<td class="taskOptions"><a href="#" class="tip-top"
								data-original-title="Pending above task"><i class="icon-arrow-up"></i> </a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="guide">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-tag"></i> </span>
				<h5>Cover Your Basic</h5>
				<div class="buttons">
					<a href="#" class="btn btn-mini"><i class="icon-question-sign"></i></a>
				</div>
			</div>
			<div class="widget-content" style="padding-top: 20px">
				<p>In this section we will cover the basics, fundamental, aspects of your startup. Follow the tasks listed in this page to cover all your basics</p>
				<p><b>Team:</b> Assembeling a winning team is key to the success of your startup. In the first section you will login and add your team. 
					At a later stage each team member will be assigned responsibilities in the startup.</p>
				<p><b>Name and vision:</b> A startup aims to solve a problem, make a change - your name and company vision are essential to becoming a successful startup.</p>
				<p><b>Profile:</b> Startups usually fall into categories (mobile, web, B2B, B2C etc.) The more information you add about your startup the better the system will be fine tuned to address your needs</p>
			</div>
		</div>
	</div>		
</div>
<script>
$(function () {
	$('#tabbed-content').css('visibility','visible');
	$('#top-tabs a:last').tab('show');
});
</script>



