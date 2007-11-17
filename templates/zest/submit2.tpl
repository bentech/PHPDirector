	{include file="header.tpl"}
			<div class="left_articles">
{literal}
<script>
function checkform()
{
	if (document.video.titletext.value == '') {
	alert('Please Enter A Title');
	return false;
	}	
	else if (document.video.descriptiontext.value == '')
	{
	alert('Please Enter A description');
	return false;
	}
	else if (document.video.authortext.value == '')
	{
	alert('Please Enter A Author');
	return false;
	}
	else if(!document.video.picture[0].checked && !document.video.picture[1].checked && !document.video.picture[2].checked) {
	alert('Please Choose A Screenshot');
	return false;
}
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}</script>
{/literal}

	<!--Center Page-->
		<div align="center">

<form action="submit.php?pt=submit&amp;part=3" method="post" name="video" onSubmit="return checkform()">


	<!--Source Of Media-->
	<b>Choose Default Screenshot</b><br />
	<input name="videoid" type="hidden" value="{$videoid}" />
	<input name="vidtype" type="hidden" value="{$vidtype}" />
	<input name="file2" type="hidden" value="{$file2}" />
	
		<table width="100" border="0">
			<!--Shows All The Images-->
			<tr> 
		{if $image eq ""}
			<textarea name="picture" cols="50" rows="1" style="text-align:center;"></textarea>	
		{else}
			
			{section name=default loop=$image}
				<td  align="center" width="100"><img src="{$image[default]}" alt="{$title}" width="130" height="97" /> </td>
				{/section}
		{/if}
			</tr>
			
			
			
			<tr> {section name=default loop=$image}
				<td align="center"><input name="picture" type="radio" value="{$image[default]}" checked="checked" />
				</td>
				{/section} </tr>
				
		</table>
        
        	<p><br />
        	  
        	  <!-- END - Shows All The Images-->
        	          <b>Title</b><br />
        	  <textarea name="titletext" cols="50" rows="1" id="titletext" style="text-align:center; text-shadow:#990000">{$title}
		        </textarea>	
        	  <br />
        	  
       	        <b>Author/b><br />
        	  <textarea name="authortext" cols="50" rows="1" style="text-align:center;">{$author}
        	    </textarea>	
        	  <br />
        	  
        	       <b>Description</b><br />
        	  <textarea name="descriptiontext" cols="50" rows="6" style="text-align:center;">{$description}
                </textarea>
               <br />  
                   <b>Tags</b><br />
        	       <input name="tagstext1" type="text" id="tagstext1" style="text-align:center;" size="15" />
       	           <input name="tagstext2" type="text" id="tagstext2" style="text-align:center;" size="15" />
       	           <input name="tagstext3" type="text" id="tagstext3" style="text-align:center;" size="15" />
              <input name="tagstext4" type="text" id="tagstext4" style="text-align:center;" size="15" />
   	          <input name="tagstext5" type="text" id="tagstext5" style="text-align:center;" size="15" />
       	  </p>
       	  <p><b>Category</b><br />
            <select name="category" size="6">
                
                
              {section name=cat loop=$cat}
              <option value="{$cat[cat].id}" {if $cat[cat].id eq "1"}selected="selected"{/if}>
              {$cat[cat].name}
                      </option>
              {/section}
            </select>	
            {$player_code}
          </p>
       	  <h3><b>Source</b>:{$source}
	</h3>
		<p align="center">
			<input type="submit" value="Submit">
		</p>
	</form>
		</div>
</div>
</div>
{include file="footer.tpl"}