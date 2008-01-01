<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    {include_http_metas}
    {include_metas}
    {include_stylesheets}
    {include_title}
  </head>
  <body>
    <div id='content'>
      <div id='header'>
        <p id="top_info">{link_to name='Login' internal_uri='login/index'}</p>
        <div id="logo">
          {if $sf_config->get('app_site_image')}
            {image_tag source=$sf_config->get('app_site_image') options=array('alt'=>$sf_config->get('app_site_name'), 'border'=>'0')}
          {else}
            <h1>{$sf_config->get('app_site_name')}</h1>
          {/if}
        </div>
      </div>
      <div id='tabs'>
        <ul>
          <li>
            {if $sf_request->getPathInfo() eq '/video/featured'}
              {link_to name="<span class='key'>Featured</span>" internal_uri="video/featured" options=array('class'=>'current')}
            {else}
              {link_to name="<span class='key'>Featured</span>" internal_uri="video/featured"}
            {/if}
          </li>
          <li>
            {if $sf_request->getPathInfo() eq '/video/all'}
              {link_to name="<span class='key'>All</span>" internal_uri="video/all" options=array('class'=>'current')}
            {else}
              {link_to name="<span class='key'>All</span>" internal_uri="video/all"}
            {/if}  
          </li>
          <li>
            {if $sf_request->getPathInfo() eq '/video/categories'}
              {link_to name="<span class='key'>Categories</span>" internal_uri="video/categories" options=array('class'=>'current')}
            {else}
              {link_to name="<span class='key'>Categories</span>" internal_uri="video/categories"}
            {/if}
          </li>
          <li>
            {if $sf_request->getPathInfo() eq '/video/images'}
              {link_to name="<span class='key'>Images</span>" internal_uri="video/images" options=array('class'=>'current')}
            {else}
              {link_to name="<span class='key'>Images</span>" internal_uri="video/images"}
            {/if}
          </li>
          <li>
            {if $sf_request->getPathInfo() eq '/video/random'}
              {link_to name="<span class='key'>Random</span>" internal_uri="video/random" options=array('class'=>'current')}
            {else}
              {link_to name="<span class='key'>Random</span>" internal_uri="video/random"}
            {/if}
          </li>
          <li>
          {if $sf_request->getPathInfo() eq '/video/submit'}
            {link_to name="<span class='key'>Submit</span>" internal_uri="video/submit" options=array('class'=>'current')}
          {else}
            {link_to name="<span class='key'>Submit</span>" internal_uri="video/submit"}
          {/if}
          </li>
        </ul>
        <div id="search">
          <form method="get" action="index.php" name="search1">
            <p>
              <input type="text" name="search" class="search"/>
              <input type="submit" value="Search"  class="button"/>
            </p>
          </form>
        </div>
      </div>
      <BR>
      <BR>
      {$sf_data->getRaw('sf_content')}
    </div>
    
    <div class="footer">
      <p class="right">&copy; 2007 PHPDirector - Ben Swanson</p><!-- There is no obligtion to keep this notice here -->
      <p>
        <a href="#">RSS Feed</a> &middot; 
        <a href="#">Contact</a> &middot; 
        <a href="#">Accessibility</a> &middot; 
        <a href="#">Products</a> &middot; 
        <a href="#">Disclaimer</a> &middot; 
        <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a>
        <br />
      </p>
    </div>
    
  </body>
</html>