{include file="header.tpl"}
<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total}
*}-->

	<div id="right">
	<br />
<div class="boxtop"></div>
			<div class="box">
				<p align="center"><b>{$LAN_7}</b><br /><br />
&nbsp;{$LAN_31}<!--Sort By Rating-->
<a href="?sort=rating&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=rating&amp;order=down&amp;next={$next}&amp;pt={$pagetype}" ><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a><br />
&nbsp;{$LAN_32}<!--Sort By Views-->
<a href="?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a><br />
&nbsp;{$LAN_33}<!--Sort By Name-->
<a href="?sort=name&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=name&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a><br />
&nbsp;{$LAN_34}<!--Sort By Date-->
<a href="?sort=date&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"> <img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a><br />
{paginate_prev}&nbsp;&nbsp;{paginate_next}</p>
							</div>
		</div>	
<div align="left">


{section name=mysec loop=$videos}
		<div class="left">
			<div class="left_articles">
				<div class="buttons"><p>
				<a href="videos.php?id={$videos[mysec].id}" class="bluebtn">{$LAN_14}</a>
				<a href="videos.php?KeepThis=true&amp;height=530&amp;width=430&amp;id={$videos[mysec].id}&amp;pop=1" class="greenbtn thickbox" title="{$videos[mysec].name|truncate:60:'...'}">{$LAN_15}</a></p></div>
								<div class="calendar"><p>{$videos[mysec].month}<br />{$videos[mysec].day}</p></div>
					
					
					<h2><a href="videos.php?id={$videos[mysec].id}">{$videos[mysec].name|truncate:32:'...'}</a></h2>
					<p class="description"><b>{$LAN_16}:</b>{$videos[mysec].creator|truncate:20:'...'}</p>
					<p><img height='89' width='120' src="{$videos[mysec].picture}" class="thumbnail" alt="thumbnail" />
					{$videos[mysec].description|truncate:580:'...'}</p>
	</div></div>
{sectionelse}
	No Results
{/section}
<div class="left">
	{* display pagination info *}
<p>&nbsp;&nbsp;{paginate_prev} {paginate_middle} {paginate_next}</p>
</div>
{include file="footer.tpl"}