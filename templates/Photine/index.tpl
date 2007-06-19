{include file="header.tpl"}
<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total}
*}-->

<div id="right"> <br />
	<div class="boxtop"></div>
	<div class="box">
	
		<p align="center">
		<b>{$LAN_7}</b>		</p>
		<p align="center"><a href="?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Most Viewed</a></p>
		<p align="center"><a href="?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Least Viewed</a></p>
		<p align="center"><a href="?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Newest Videos</a></p>
		<p align="center">	    {paginate_prev}&nbsp;&nbsp;{paginate_next}</p>
  </div>
	
</div>

<div align="left">

{section name=mysec loop=$videos}

	<div class="left">
	
		<div class="left_articles">
		
			<div class="buttons">
			
				<div> <a href="videos.php?id={$videos[mysec].id}" class="bluebtn">{$LAN_14}</a> <a href="videos.php?KeepThis=true&amp;height=530&amp;width=430&amp;id={$videos[mysec].id}&amp;pop=1" class="greenbtn thickbox" title="{$videos[mysec].name|truncate:60:'...'}">{$LAN_15}</a></div>
				
			</div>
			
			<div class="calendar">
				<p>{$videos[mysec].month}<br />
					{$videos[mysec].day}</p>
			</div>
			
			<h2><a href="videos.php?id={$videos[mysec].id}">{$videos[mysec].name|truncate:32:'...'}</a></h2>
			
			<div class="description"><b>{$LAN_16}:</b>{$videos[mysec].creator|truncate:20:'...'}</div>
			<br />
	<table width="0" border="0" cellspacing="0" height="0">		
<td><a href="videos.php?id={$videos[mysec].id}"><img height='89' width='120' src="{$videos[mysec].picture}" class="thumbnail" alt="thumbnail" /></a></td>
		<td>{$videos[mysec].description|truncate:580:'...'}</td>		</tr>

	</table>		
		</div>
		
	</div>
	
	{sectionelse}
	
	No Results
	
	{/section}
	

</div>
	
<div class="left"> {* display pagination info *}

	<p align="center">&nbsp;&nbsp;{paginate_prev}&nbsp;&nbsp;{paginate_next} <br />{paginate_middle page_limit="20"} </p>
	
</div>

{include file="footer.tpl"}