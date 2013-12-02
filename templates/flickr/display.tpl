{extends file="layout.tpl"}
{block name=title}{/block}
{block name=body}
	<script type="text/javascript">
		function reloadPage (e) {
			var query = location.search.replace(/&size=.*/, '');
		    window.location = "/flickr/display/" + query + "&size=" + e.value;
		};	
	</script>
	
	<div id="flickr-photo">
		{html_options name="size" options=$options selected=$selected id="mysize" onchange="reloadPage(this);"}
		<br/>
		<br/>
		Image URL: <a href="{$img}" target="_blank">{$img}</a>
		<br/>
		<br/>
		Flickr URL: <a href="http://www.flickr.com/photos/{$photo.owner}/{$photo.id}/" target="_blank">http://www.flickr.com/photos/{$photo.owner}/{$photo.id}/</a>
		<br/>
		<br/>
		Wiki Markup : [[flickr|{$photo.owner}:{$photo.id}:{$photo.farm}:{$photo.server}:{$photo.secret}|{$photo.size}]]

	{literal}
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
			        width="110"
			        height="14"
			        id="clippy" >
			<param name="movie" value="/flash/clippy.swf"/>
			<param name="allowScriptAccess" value="always" />
			<param name="quality" value="high" />
			<param name="scale" value="noscale" />
			<param NAME="FlashVars" value="text=#{text}">
			<param name="bgcolor" value="#{bgcolor}">
			<embed src="/flash/clippy.swf"
			       width="110"
			       height="14"
			       name="clippy"
			       quality="high"
			       allowScriptAccess="always"
			       type="application/x-shockwave-flash"
			       pluginspage="http://www.macromedia.com/go/getflashplayer"
			       FlashVars="text={/literal}[[flickr|{$photo.owner}:{$photo.id}:{$photo.farm}:{$photo.server}:{$photo.secret}|{$photo.size}]]{literal}"
			       bgcolor="white"
			/>
			</object>		
	{/literal}
		<br/>
		<br/>
		
		<img src="{$img}"/><br/>
		<a href="javascript:history.go(-1)">Back</a>
	</div>
{/block}
