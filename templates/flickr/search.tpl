{extends file="layout.tpl"}
{block name=title}{/block}
{block name=body}
	<div id="flickr-results">
		<div id="flickr-thumbs">
			{foreach $images as $image}
				<a href="/flickr/display/?owner={$image.photo.owner}&id={$image.photo.id}&farm={$image.photo.farm}&server={$image.photo.server}&secret={$image.photo.secret}"><img src="{$image.thumbnail}"/></a>
			{/foreach}
		</div>
		
		{if $prevPage > 0}
		<span id="prevPage"><a href="/flickr/search/?search={$search}&page={$prevPage}&per_page={$perPage}{$license}">Prev</a></span>
		{/if}
		
		<span id="nextPage"><a href="/flickr/search/?search={$search}&page={$nextPage}&per_page={$perPage}{$license}">Next</a></span>
	</div>
{/block}
