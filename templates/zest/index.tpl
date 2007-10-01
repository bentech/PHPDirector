	{include file="header.tpl"}

 
			<div class="left_articles">
            
				<h2>Featured Videos</h2>
                
{section name=videos loop=$videos}
				<p class="date">{$videos[videos].day} &nbsp; {$videos[videos].month}</p><a href="videos.php?id={$videos[videos].id}">
				<img class="bigimage" src="{$videos[videos].picture}" alt="{$videos[videos].name|truncate:12:'..'}" width="122" height="100"/></a>
			  <h3><a href="videos.php?id={$videos[videos].id}">{$videos[videos].name|truncate:64:'..'}</a></h3>
		      <p>{$videos[videos].description|truncate:128:'..'}</p>		     
              <p>&nbsp;</p>
              <br />
              	{/section}   
		  </div>
          
          
			<div class="left_box">
			    	<p>&nbsp;&nbsp;{paginate_prev}&nbsp;&nbsp;{paginate_next} <br />{paginate_middle page_limit="20"} </p>
			</div>
            
            
	           </div>	
	

{include file="footer.tpl"}