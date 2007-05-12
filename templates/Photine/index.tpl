{include file="header.tpl"}
<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total} //tota
*}-->

<div align="left">
<p> <b>&nbsp;&nbsp;{$LAN_7}:</b>
&nbsp;{$LAN_31}<!--Sort By Rating-->
<a href="?sort=rating&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=rating&amp;order=down&amp;next={$next}&amp;pt={$pagetype}" ><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a>
&nbsp;{$LAN_32}<!--Sort By Views-->
<a href="?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a>
&nbsp;{$LAN_33}<!--Sort By Name-->
<a href="?sort=name&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=name&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a>
&nbsp;{$LAN_34}<!--Sort By Date-->
<a href="?sort=date&amp;order=up&amp;next={$next}&amp;pt={$pagetype}"> <img src="templates/Photine/images/arrowup.gif" border="0" alt="error"/></a>
<a href="?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}"><img src="templates/Photine/images/arrowdown.gif" border="0" alt="error"/></a>
<!--&nbsp;&nbsp;&nbsp;{paginate_prev}&nbsp;&nbsp;{paginate_next}--><!--Prev and Next at top just remove the comments.-->
</p>
	
</div>
<div class='left'>
<table border="0" cellspacing="0" cellpadding="0">
{section name=mysec loop=$videos}
	<tr><td>
	<div class="left_articles">
		<div class="calendar">
			<p>{$videos[mysec].month}<br />
				{$videos[mysec].day}</p>
		</div>
		<div class="buttons">
			<p><a href="videos.php?id={$videos[mysec].id}" class="bluebtn">{$LAN_14}</a> <a href="videos.php?KeepThis=true&amp;height=530&amp;width=430&amp;id={$videos[mysec].id}&amp;pop=1" class="thickbox greenbtn"
		rel="gallery-videos" title="{$videos[mysec].name|truncate:60:'...'}">{$LAN_15}</a></p>
		</div>
		<h2><a href="videos.php?id={$videos[mysec].id}">{$videos[mysec].name|truncate:32:'...'}</a></h2>
		<p class="description"><b>{$LAN_16}: </b> {$videos[mysec].creator|truncate:20:'...'}</p>
		<p><img height='97' width='130' src="{$videos[mysec].picture}" class="thumbnail" alt="{$videos[mysec].name}" /> {$videos[mysec].description|truncate:580:'...'}</p>
	</div>
	</td></tr>
{sectionelse}
	No Results
{/section}
</table>
<br /><br />
	{* display pagination info *}
&nbsp;&nbsp;{paginate_prev} {paginate_middle} {paginate_next}
{include file="footer.tpl"}

