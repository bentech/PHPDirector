<h2>Featured Videos</h2>
{if $MediaList}
  {foreach from=$MediaList item=media}
    {include_partial templateName='video/videolistingblock' vars=array('media'=>$media)}
  {/foreach}
{else}
   No Video Avaliable.
{/if}