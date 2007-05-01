{include file="header.tpl"}

<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total} //tota
*}-->
<div align="left">
<p>
<b>&nbsp;&nbsp;&nbsp;{$LAN_7}:&nbsp;</b>
{$LAN_31}
<a href="?sort=rating&amp;order=up">
<img src="templates/Photine/images/arrowup.gif" name="rateup" border="0" id="rateup" title="{$LAN_8}" alt="arrow up" /></a>

<a href="?sort=rating&amp;order=down" ><img src="templates/Photine/images/arrowdown.gif" name="ratedwn" border="0" id="ratedwn" title="{$LAN_9}" alt="arrow down" /></a>

&nbsp;
{$LAN_32}

<a href="?sort=views&amp;order=up">
<img src="templates/Photine/images/arrowup.gif" name="viewup" border="0" id="viewup" title="{$LAN_10}" alt="arrow up" /></a>

<a href="?sort=views&amp;order=down"><img src="templates/Photine/images/arrowdown.gif" name="viewdwn" border="0" id="viewdwn" title="{$LAN_11}" alt="arrow down" /></a>

&nbsp;
{$LAN_33}

<a href="?sort=name&amp;order=up">
<img src="templates/Photine/images/arrowup.gif" name="nameup" border="0" id="nameup" title="A-Z" alt="arrow up" /></a>

<a href="?sort=name&amp;order=down"><img src="templates/Photine/images/arrowdown.gif" name="namedwn" border="0" id="namedwn" title="Z-A" alt="arrow down" /></a>

&nbsp;
{$LAN_34}

<a href="?sort=date&amp;order=up"> <img src="templates/Photine/images/arrowup.gif" name="dateup" border="0" id="dateup" title="{$LAN_12}" alt="arrow up" /></a>

<a href="?sort=date&amp;order=down"><img src="templates/Photine/images/arrowdown.gif" name="datedown" border="0" id="datedown" title="{$LAN_13}" alt="arrow down" /></a>
</p>
</div>


<div class='left'>		
		{section name=mysec loop=$videos}

<div class="left_articles">
		<div class="calendar"><p>{$videos[mysec].month}<br />{$videos[mysec].day}</p></div>
		<div class="buttons"><p><a href="videos.php?id={$videos[mysec].id}" class="bluebtn">{$LAN_14}</a>	
		<a href="videos.php?KeepThis=true&amp;height=530&amp;width=430&amp;id={$videos[mysec].id}&amp;pop=1"class="thickbox greenbtn"
		rel="gallery-videos" title="{$videos[mysec].name}">{$LAN_15}</a></p>
		</div>
		<h2><a href="videos.php?id={$videos[mysec].id}">{$videos[mysec].name}</a></h2>
		<p class="description"><b>{$LAN_16}: </b> {$videos[mysec].creator} - <b>{$LAN_17}: </b> {$videos[mysec].views}</p>
		<p><img height='97' width='130' src="{$videos[mysec].picture}" class="thumbnail" alt="{$videos[mysec].name}" />
		{$videos[mysec].description}{$videos[mysec].br}</p>
</div>
{sectionelse}
No Results
{/section}
<br />

    {* display pagination info *}
    {paginate_prev} {paginate_middle} {paginate_next}
{include file="footer.tpl"}

