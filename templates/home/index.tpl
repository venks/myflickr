{extends file="layout.tpl"}
{block name=title}{/block}
{block name=body}
<div>
	<div id="search-box">
		<b>Search Flickr</b>
		<br/><br/>
		<form action="/flickr/search/" method="GET">
			
			<input type="text" name="search" value="Enter your search term here..." size="50" onClick="this.value=''"/><br/><br/>
			
			<fieldset>
			<legend>Choose your license</legend>
				<input type="checkbox"name="license[]" value="0" id="license_0"><label for="license_0">All Rights Reserved</label><br/>
				<input type="checkbox"checked="checked"  name="license[]" value="4" id="license_4"><label for="license_4">Attribution License</label> <a href="http://creativecommons.org/licenses/by/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" checked="checked" name="license[]" value="6" id="license_6"><label for="license_6">Attribution-NoDerivs License</label> <a href="http://creativecommons.org/licenses/by-nd/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" name="license[]" value="3" id="license_3"><label for="license_3">Attribution-NonCommercial-NoDerivs License <a href="http://creativecommons.org/licenses/by-nc-nd/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" name="license[]" value="2" id="license_2"><label for="license_2">Attribution-NonCommercial License</label> <a href="http://creativecommons.org/licenses/by-nc/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" name="license[]" value="1" id="license_1"><label for="license_1">Attribution-NonCommercial-ShareAlike License</label> <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" checked="checked" name="license[]" value="5" id="license_5"><label for="license_5">Attribution-ShareAlike License</label> <a href="http://creativecommons.org/licenses/by-sa/2.0/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" checked="checked" name="license[]" value="7" id="license_7"><label for="license_7">No known copyright restrictions</label> <a href="http://www.flickr.com/commons/usage/"><img src="/images/information-icon.png"></a><br/>
				<input type="checkbox" name="license[]" value="8" id="license_8"><label for="license_8">United States Government Work</label> <a href="http://www.usa.gov/copyright.shtml"><img src="/images/information-icon.png"></a><br/>
			</fieldset>
			<br/>
			
			Display 
			<select name="per_page">
				<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="25">25</option>
				<option value="50">50</option>	
				<option value="100">100</option>
			</select>
			results per page<br/>
			<br/>
			<input type="submit" value="Go!"/>
		</form>
	</div>
</div>
{/block}
