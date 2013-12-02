{config_load file='smarty.conf'}
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <title>MyFlickr</title>
  <link rel="stylesheet" type="text/css" href="/styles/index.css"/>
</head>
<body>
	<div id="main">
		<div id="navigation_bar">
			<ul id="nav"> 
				<li><a href="/">MyFlickr</a></li>
			</ul>
 		</div><!-- end navigation_bar -->

		<div id="messages">
		{foreach from=$messages key=k item=msgs}
			<div id="messages_{$k}">
			{foreach from=$messages.$k item=infoMsg}
				{$infoMsg}<br/>
			{/foreach}
			</div>
		{/foreach}
		</div><!-- end messages -->

 		{block name=body}{/block}

	 	<div id="footer">
		&copy; 2012 MyFlickr.com All rights reserved.
		</div>
	</div><!-- end main -->
</body>
</html>