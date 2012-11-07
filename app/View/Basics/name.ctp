<ul class="nav nav-tabs" id="top-tabs">
		<li>
			<a href="#tips" data-toggle="tab">Tips and tricks</a>
		</li>
		<li><a href="#name" data-toggle="tab">Name and Domain</a></li>
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
							<p>You can always return to this stage and update your list based
								on your evolving understanding of the company and the ecosystem.</p>
							<p>
								If nothing interesting comes up you can use <a
									href="http://www.leandomainsearch.com/">http://www.leandomainsearch.com/</a>
								to check if there are any interesting word combinations
								available or <a href="http://wordoid.com/">http://wordoid.com/</a>
								to generate some made-up words.
							</p>
						</div>
					</div>
		</div>
		<div class="tab-pane" id="name">
			<div class="span4">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-star-empty"></i> </span>
						<h5>Name and domain</h5>
					</div>
					<div class="widget-content">
						<h3>1) Startup Name:</h3>
						<input type="text" id="name" /><br />
						<h3>2) Domain Keywords:</h3>
						<input type="text" id="search_box" /> <br /> <input
							class="btn btn-primary btn-large" type="button"
							id="search_button" value="Search" /> <input
							class="btn btn-success btn-large" type="button" id="save"
							value="Save" />
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-star-empty"></i> </span>
						<h5>Available Domains</h5>
					</div>
					<div class="widget-content">
						<div id="loader">
							<img
								src="http://domainsbot.blob.core.windows.net/img/loading.gif"
								alt="Loading..">
						</div>
						<div id="checking">
							<img
								src="http://domainsbot.blob.core.windows.net/img/checking.gif"
								alt="Checking..">
						</div>
						<div id="results"></div>
					</div>
				</div>
			</div>
		</div>
		
	
	

	
	<div class="tab-pane" id="guide">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon"><i class="icon-tag"></i> </span>
							<h5>Step 2: Pick a cool name for your startup</h5>
							<div class="buttons">
								<a href="#" class="btn btn-mini"><i class="icon-question-sign"></i>
								</a>
							</div>
						</div>
						<div class="widget-content" style="padding-top: 20px">
							<p>Your name is the first thing people hear when you talk, pitch
								or mention your company. In a sense it's your catch phrase
								business card. A good name will keep your audience focused on
								your message. A mediocre name will not catch anyone’s
								attention and a bad name will hurt you, and there’s no reason
								to go down that path when you can avoid it.</p>
							<p>Coming up with a name is a relatively simple process. Before
								you begin open a scratchpad and compile a list of keywords that
								you like, best describe your company, the market, what makes
								your company unique, and what your value proposition is. Often
								times it is helpful to use a thesaurus or dictionary in order to
								translate an English word into other languages like Latin.</p>
							<p>Once your list is compiled enter in into the startup name text
								box below in order to check the domain availability</p>
						</div>
					</div>
				</div>
</div>

<script>
    $(document).ready(function ()
    {
   		$('#tabbed-content').css('visibility','visible');
   		$('#top-tabs a:last').tab('show');
        var client = $().domainsbot({
	     parameters : {
				"pageSize" : 5,
				"auth-token": "baa86e2cd6707d6c61be78f7d1c2422d",
				"tlds" : "com,co,net,me"
				},
            results: "#results",
            loading: "#loader",
            checking: "#checking",
            searchTextbox : "#search_box",
            searchSubmit : "#search_button",
            searchParameter: "domain",
            autoComplete: true,
            // Events
            urlCheckout: "http://domainsbot.com/d/%domain%", //Replace with your check out url!
            //onCheckout: function(domain,evt){alert(domain.Domain);}

            //onSuccess: function(data){alert(data)},
            //onError: function(err){alert(err.message);}

        });
        $("#name").change(function() {
            if(!$("#search_box").val())
        		$("#search_box").val($("#name").val())  ;  
        });
    });
</script>
