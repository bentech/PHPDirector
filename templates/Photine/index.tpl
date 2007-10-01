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


		<b>{$LAN_7}</b>:
		<a href="?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Most Viewed</a>&nbsp;| &nbsp;
		<a href="?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Least Viewed</a>&nbsp;| &nbsp;
		<a href="?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Newest Videos</a>
		<p>{paginate_prev}&nbsp;| &nbsp; {paginate_next}</p>

 <br />

{* Alligning *}
<div align="left">
<table width="1" border="0">


{* Change max = for rows *}
	 {section name=i loop=$videos step=6 max=4}

	 
{* Change max = below for columns and step = above *}
	<tr>
    {section name=videos loop=$videos start=$smarty.section.i.index max=4}
	
	

		<td> 

{*This table is so the image is aligned at the top*}


<table width="132" border="0" align="left">
  <tr>
    <td><a href="videos.php?id={$videos[videos].id}"><img src="{$videos[videos].picture}" alt="Image Error" width="130" height="97" border="0" align="top" {if $firefox eq "1"}class="reflect rheight20 ropacity50"{/if} /></a></td>
  </tr>
  <tr>
    <td height="60" align="top" valign="top"><a href="videos.php?id={$videos[videos].id}">{$videos[videos].name|truncate:128:'..'}</a></td>
  </tr>
</table>



		</td>
	  {/section} </tr>

	{/section}
</table>
</div>


	
{* display pagination info *}

	<p>&nbsp;&nbsp;{paginate_prev}&nbsp;&nbsp;{paginate_next} <br />{paginate_middle page_limit="20"} </p>
	


{include file="footer.tpl"}