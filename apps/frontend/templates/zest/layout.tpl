<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	{include_http_metas}
  {include_metas}
  {include_stylesheets}
  {include_title}
</head>
<body>
	<div id="content">
		<div id="top_info">
			<p>Welcome to <b>PHPDirector</b> <span id="loginbutton"><a href="#" title="Log In">&nbsp;</a></span><br />
			<b>You are not Logged in!</b> <a href="#">Log in</a> to check your messages.</p>
		</div>
		
		<div id="logo">

    <h1>
      <a href="index.php" title="home">
        {if $sf_config->get('app_site_image')}
          {image_tag source=$sf_config->get('app_site_image') options=array('alt'=>$sf_config->get('app_site_name'), 'border'=>'0')}
        {else}
          {$sf_config->get('app_site_name')}
        {/if}
        </a>
    </h1>


			{if $sf_config->get('app_site_slogan')}<p id="slogan">{$sf_config->get('app_site_slogan')}</p>{/if}
		</div>
				
		<ul id="tablist">
			<li>
        {link_to name="<span class='key'>Featured</span>" internal_uri="video/featured"}
      </li>
      <li>
        {link_to name="<span class='key'>All</span>" internal_uri="video/all"}
      </li>
      <li>
        {link_to name="<span class='key'>Categories</span>" internal_uri="video/categories"}
      </li>
      <li>
        {link_to name="<span class='key'>Images</span>" internal_uri="video/images"}
      </li>
      <li>
        {link_to name="<span class='key'>Random</span>" internal_uri="video/random"}
      </li>
      <li>
        {link_to name="<span class='key'>Submit</span>" internal_uri="video/submit"}
      </li>
		</ul>
		
		<div id="topics">
			<div class="thirds">
				<p><br />Welcome to the Main Page:</p>
			</div>
            
			<div class="thirds">
				<ul>
					<li><a href="index.php?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Most Viewed</a></li>
					<li><a href="index.php?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Newest Videos</a></li>
					<li><a href="#">Heighest Rated</a></li>
				</ul>
			</div>
			<div class="thirds">
				<ul>
					<li><a href="index.php?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Least Watched</a></li>
					<li><a href="">Lowest Rated</a></li>
					<li><a href="index.php?sort=date&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Oldest Videos</a></li>
				</ul>
			</div>
		</div>
<div id="search">
			<form method="get" action="index.php" name="search1">
				<p><input type="text" name="search" class="search" /> <input type="submit" value="Search" class="button" /></p>
			</form>
</div>

    	<div id="left">
        {if $news ne ""}
			<div class="subheader">
		
        		<p>{$news}</p>
       
</div>         {/if}

{$sf_data->getRaw('sf_content')}

</body>
</html>
