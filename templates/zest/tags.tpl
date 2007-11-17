
{include file="header.tpl"}
{literal}
    <style type="text/css">
<!--
.xxlarge {
	font-size: xx-large;
	color: #990000;
}
.Xlarge {
	font-size: x-large;
	color: #FF9900;
}
.Large {
	font-size: medium;
	color: #669900;
}
.Medium {
	font-size: medium;
	color: #00CCFF;
}
.normal {color: #0066FF}
-->
</style>
{/literal}
    <div class="left_articles">
      <h2>Tags</h2>
      <p>&nbsp;</p>
 
      {section name=tags loop=$tags}
   {if $tags[tags].number gte $number[1]}
      <a href="index.php?pt=videos&tag={$tags[tags].name}" class="xxlarge">
   {elseif $tags[tags].number gte $number[2]}
      <a href="index.php?pt=videos&tag={$tags[tags].name}" class="Xlarge">
    {elseif $tags[tags].number gte $number[3]}
     <a href="index.php?pt=videos&tag={$tags[tags].name}" class="Large">
   {elseif $tags[tags].number gte $number[4]}
     <a href="index.php?pt=videos&tag={$tags[tags].name}" class="Medium">
   {else}
      <a href="index.php?pt=videos&tag={$tags[tags].name}" class="normal">
    {/if}
      
      {$tags[tags].name}
     </a> &nbsp;
      {/section}
    </div>
    <div class="thirds"></div>
  </div>
  {include file="footer.tpl"}